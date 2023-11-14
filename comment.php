<?php
  $post_no = $error = $name = $content = '';

  if (@$_POST['submit']) {

    $post_no = strip_tags($_POST['post_no']);
    $name = strip_tags($_POST['name']);
    $content = strip_tags($_POST['content']);

    if (!$name) $error .= '名前がありません。<br>';
    if (!$content) $error .= 'コメントがありません。<br>';

    if (!$error) {
      $pdo = new PDO("mysql:dbname=blog", "root"); //データベースに接続
      $st = $pdo->prepare("INSERT INTO comment(post_no,name,content) VALUES(?,?,?)");
      //コメントを "comment" テーブルに挿入
      $st->execute(array($post_no, $name, $content));
      header('Location: home.php');
      exit();
    }

  } else { //コメント」リンクを押されたとき
    $post_no = strip_tags($_GET['no']);
  }

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Post comment | Travel Blog</title>
<link rel="stylesheet" href="style.css">
<link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
</head>
<body>

<header>
    <h3><a href="home.php">LOGO</a></h3>
    <nav>
        <ul class="header-nav">
            <li><a class="home" href="home.php">Home</a></li>
            <li><a class="button-2" href="post.php">Write a Blog</a></li>
        </ul>
    </nav>
</header>

<div class="add-content">
<form method="post" action="comment.php">
  <div class="post">
    <h2>Add comments</h2>
    <p>Name</p>
    <p><input type="text" name="name" size="40" value="<?php echo $name ?>"></p>
    <p>Comment</p>
    <p><textarea name="content" rows="8" cols="40"><?php echo $content ?></textarea></p>
    <p>
      <input type="hidden" name="post_no" value="<?php echo $post_no ?>">
      <input name="submit" type="submit" value="Submit">
    </p>
    <p><?php echo $error ?></p>
  </div>
</form>
</div>
</body>
</html>
