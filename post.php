<?php
  $error = $title = $content = '';
  if (@$_POST['submit']) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (!$title) $error .= 'タイトルがありません。<br>';
    if (mb_strlen($title) > 80) $error .= 'タイトルが長すぎます。<br>';
    if (!$content) $error .= '本文がありません。<br>';

    if (!$error) {
      $pdo = new PDO("mysql:dbname=blog", "root");
      $st = $pdo->query("INSERT INTO post(title,content) VALUES('$title','$content')");
      header('Location: home.php');
      exit();
    }
  }
  
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Add New Articles</title>
<link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
<link rel="stylesheet" href="style.css">
</head>

<body>
        <header>
            <h3><a href="home.html">LOGO</a></h3>
            <nav>
                <ul class="header-nav">
                    <li><a class="home" href="home.php">Home</a></li>
                    <li><a class="button-2" href="post.php">Write a Blog</a></li>
                </ul>
            </nav>
        </header>

<div class="add-content">
<form method="post" action="post.php">
  <div class="post">
    <h2>Add New Articles</h2>
    <p>Title</p>
    <p><input type="text" name="title" size="40" value="<?php echo $title ?>"></p>
    <p>Content</p>
    <p><textarea name="content" rows="12" cols="70"><?php echo $content ?></textarea></p>
    <p><input name="submit" type="submit" value="Submit"></p>
    <p><?php echo $error ?></p>
  </div>
</form>
</div>
</body>
</html>
