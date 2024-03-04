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

$error = $title = $content = $kanryo = '';

if(isset($_POST['title'])) $title = $_POST['title'];
if(isset($_POST['content'])) $content = $_POST['content'];

  if (!$title) $error .= 'タイトルがありません。<br>';
  if (mb_strlen($title) > 80) $error .= 'タイトルが長すぎます。<br>';
  if (!$content) $error .= '本文がありません。<br>';
  if(!isset($_SESSION['token'],$_REQUEST['token'])){
    $error .= '外部サイトからの直接アクセスは禁止されています。<br>';
   }elseif ($_SESSION['token'] !== $_REQUEST['token']){
    $error .= 'トークン不一致エラー<br>';
   }

try{
  if (!$error) {
    include 'dbsetting.php';
    $sql = "INSERT INTO post(title,content) VALUES(?,?)";
    $st = $pdo->prepare($sql);
    $st->bindValue(1,$title);
		$st->bindValue(2,$content);
    $st->execute();
    $pdo = null;

    $kanryo="追加完了しました。";
  }
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
<title>投稿確認</title>
<link rel="stylesheet" href="blog.css">
</head>
<body>
<?php echo $login ?>
<p>
<?php 
echo $error;
echo $kanryo;
?></p>

<div class="bottomlink">
  <a href="admin_top.php">[戻る]</a>
</div>

</body>
</html>