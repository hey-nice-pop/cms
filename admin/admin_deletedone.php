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

$kanryo = $error = '';


if(!isset($_SESSION['token'],$_REQUEST['token'])){
   $error .= '外部サイトからの直接アクセスは禁止されています。<br>';
  }elseif ($_SESSION['token'] !== $_REQUEST['token']){
   $error .= 'トークン不一致エラー<br>';
  }else{

try{
      include 'dbsetting.php';
      $sql="DELETE FROM post WHERE no=?";
      $st = $pdo->prepare($sql);
      $st->bindValue(1,$_SESSION['no']);
      $st->execute();

      $pdo = null;

      $_SESSION['no'] = '';
      $kanryo="削除完了しました。";
}
catch(Exception $e){
   print '通信エラー';
	exit();
}

  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>更新確認</title>
<link rel="stylesheet" href="blog.css">
</head>
<body>
<?php echo $login ?>
<p>
<?php 
echo $kanryo;
echo $error;
?></p>

<div class="bottomlink">
  <a href="admin_top.php">[HOME]</a>
</div>

</body>
</html>