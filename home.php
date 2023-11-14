<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Travel Blog</title>
        <link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
        <link rel="stylesheet" href="style.css">
        <link href='https://fonts.googleapis.com/css?family=Knewave' rel='stylesheet'>
    </head>

    <body>
        <header>
            <h3><a href="home.html">LOGO</a></h3>
            <nav>
                <ul class="header-nav">
                    <li><a class="home" href="home.html">Home</a></li>
                    <li><a class="button-2" href="post.php">Write a Blog</a></li>
                </ul>
            </nav>
        </header>

        <div class="home-bg">
            <div class="home-title">
                <h1>Travel Blog</h1>
                <a class="button" href="post.php">Write a Blog</a>
            </div>
        </div>

        <section class="home-blog">
           
          <?php
          $pdo = new PDO("mysql:dbname=blog", "root");
          $st = $pdo->query("SELECT * FROM post ORDER BY no DESC");
          $posts = $st->fetchAll();

          

          for ($i = 0; $i < count($posts); $i++) {
            $st = $pdo->query("SELECT * FROM comment WHERE post_no={$posts[$i]['no']} ORDER BY no DESC");
            $posts[$i]['comments'] = $st->fetchAll();
            //投稿とコメントを連携してる
          }
          
          foreach ($posts as $post) { ?>
            <div class="post">
                <h2><?php echo $post['title'] ?></h2>
                <p><?php echo nl2br($post['content']) ?></p>

                <?php foreach ($post['comments'] as $comment) { ?>
                    <div class="comment">
                        <h3><?php echo $comment['name'] ?></h3>
                        <p><?php echo nl2br($comment['content']) ?></p>
                    </div>
                <?php } ?>
               
                <div class="date-comment">
                <p class="comment_link">Date of post: <?php echo $post['time'] ?></p>
                <a class="button-2" href="comment.php?no=<?php echo $post['no'] ?>">Comment</a>
                </div>
                
           </div>

        <?php } ?>
        
    </body>


    
</html>
