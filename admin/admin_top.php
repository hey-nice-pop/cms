<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false){
	print 'ログインされていません。<br>';
	print '<a href="admin_login.php">ログイン画面へ</a>';
	exit();
}
else{
	$login = htmlspecialchars( $_SESSION['staff_name'], ENT_QUOTES, 'UTF-8' )."さんログイン中<br>";
   $login .= '<a href="admin_logout.php">ログアウト</a>';
}

include '../common.php';

try{
   include 'dbsetting.php';
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
<title>管理画面トップ</title>
<link rel="stylesheet" href="blog.css">
</head>
<body>
   <?php echo $login ?>

<h1>管理画面トップ</h1>
<a href="admin_post.php">新規追加</a>
<?php foreach ($posts as $post) { ?>
  <div class="post">
    
    <h2><?php echo sanitize($post['title']) ?></h2>
    <p><?php echo sanitize(mb_strimwidth($post['content'], 0, 70, '…', 'utf8')) ?></p>
    <p class="commment_link">
      投稿日：<?php echo sanitize($post['time']) ?>　
    </p>
  </div>
  <a href="admin_edit.php?no=<?php echo sanitize($post['no']) ?>">更新</a>
  <a href="admin_delete.php?no=<?php echo sanitize($post['no']) ?>">削除</a>

<?php } ?>

</body>
</html>