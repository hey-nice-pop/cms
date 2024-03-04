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
   $reqcode='';
   if(isset($_GET['no'])) $reqcode=$_GET['no'];

   include 'dbsetting.php';
   $sql = "SELECT * FROM post WHERE no=?";
   $st = $pdo->prepare($sql);
   $st->bindValue(1,$reqcode);
   $st->execute();
   $post = $st->fetch(PDO::FETCH_ASSOC);

   $pdo = null;

   $_SESSION['no'] = '';
   if(isset($post['no'])){
      $_SESSION['no'] = $post['no'];
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
<title>記事内容更新</title>
<link rel="stylesheet" href="blog.css">
</head>
<body>
<?php echo $login ?>
<form method="post" action="admin_editdone.php">
  <div class="post">
    <h2>記事内容更新</h2>
    <?php if(!isset($post['no'])){echo "指定記事は存在しません。";}
    else{
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
      echo '<input type="hidden" name="token" value="';
      echo htmlspecialchars($_SESSION['token']);
      echo '">';
      echo "<p>題名</p>";
      echo '<input type="text" name="title" size="40" value="';
      echo sanitize($post['title']);
      echo '">';
      echo "<p>本文</p>";
      echo ' <textarea name="content" rows="8" cols="40">';
      echo sanitize($post['content']);
      echo '</textarea>';
      echo '<input name="submit" type="submit" value="更新する">';
    }
    ?>

  </div>
</form>

<div class="bottomlink">
  <a href="javascript:history.back()">[戻る]</a>
</div>

</body>
</html>