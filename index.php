<?php
include 'common.php';

try{
   include 'admin/dbsetting.php';
   $st = $pdo->query("SELECT * FROM post ORDER BY no DESC LIMIT 2");
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
<title>トップページ</title>
<link rel="stylesheet" href="blog.css">
</head>
<body>

<h1>トップページのh1</h1>
<p>いいシステムが書けるといいな〜</p>
<p>これはダミーの文章です。文章ですよ〜〜〜〜〜〜<br>
文章の続きです〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜〜</p>
<h2>お知らせ</h1>

<?php foreach ($posts as $post) { ?>
  <div class="post">
  <a href="detail.php?no=<?php echo sanitize($post['no']) ?>">
    <h2><?php echo sanitize($post['title']) ?></h2>
    <p class="commment_link">
      投稿日：<?php echo sanitize($post['time']) ?>　
    </p>
    </a>
  </div>
<?php } ?>

<div class="bottomlink">
<a href="list.php">一覧はこちら</a>
</div>

</body>
</html>