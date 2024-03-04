<?php
include 'common.php';

try{
   $reqcode='';
   if(isset($_GET['no']))$reqcode=$_GET['no'];

   include 'admin/dbsetting.php';
   $sql = "SELECT * FROM post WHERE no=?";
   $st = $pdo->prepare($sql);
   $st->bindValue(1,$reqcode);
   $st->execute();

   $post = $st->fetch(PDO::FETCH_ASSOC);

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
<title>記事詳細</title>
<link rel="stylesheet" href="blog.css">
</head>
<body>

<h1>記事詳細</h1>

  <div class="post">
    <h2><?php if(isset($post['title'])){echo sanitize($post['title']);}
     else{echo "存在しない記事です。";}
     ?></h2>
    <p><?php if(isset($post['content'])){echo nl2br(sanitize($post['content']));} ?></p>
    <p class="commment_link">
      投稿日：<?php if(isset($post['time'])){echo sanitize($post['time']);} ?>
    </p>
  </div>

  <div class="bottomlink">
  <a href="javascript:history.back()">[戻る]</a>
  </div>

</body>
</html>