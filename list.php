<?php
include 'common.php';

try{
   include 'admin/dbsetting.php';
   $st = $pdo->query("SELECT * FROM post ORDER BY no DESC");
   $posts = $st->fetchAll();

   $pdo = null;

}
catch(Exception $e){
   print '通信エラー';
	exit();
}
  ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>記事一覧</title>
<link rel="stylesheet" href="blog.css">
</head>
<body>

<h1>記事一覧</h1>
<?php foreach ($posts as $post) { ?>
  <div class="post">
    <a href="detail.php?no=<?php echo sanitize($post['no']) ?>">
    <h2><?php echo sanitize($post['title']) ?></h2>
    <p><?php echo mb_strimwidth(sanitize($post['content']), 0, 70, '…', 'utf8') ?></p>
    <p class="commment_link">
      投稿日：<?php echo sanitize($post['time']) ?>　
    </p>
    </a>
  </div>
<?php } ?>

<div class="bottomlink">
<a href="index.php">[HOME]</a>
</div>

</body>
</html>