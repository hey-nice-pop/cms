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
  $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>記事投稿</title>
<link rel="stylesheet" href="blog.css">
</head>
<body>
<?php echo $login ?>
<form method="post" action="admin_postdone.php">
  <div class="post">
    <h2>記事投稿</h2>
    <p>題名</p>
    <input type="text" name="title" size="40">
    <p>本文</p>
    <textarea name="content" rows="8" cols="40"></textarea>
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token']) ?>">
    <input name="submit" type="submit" value="投稿">

  </div>
</form>

<div class="bottomlink">
  <a href="javascript:history.back()">[戻る]</a>
</div>

</body>
</html>