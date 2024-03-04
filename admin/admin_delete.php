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
<title>記事削除</title>
<link rel="stylesheet" href="blog.css">
</head>
<body>
<?php echo $login ?>
<form method="post" action="admin_deletedone.php">
  <div class="post">
    <h1>記事削除</h1>
    <?php if(!isset($post['no'])){echo "指定記事は存在しません。";}
    else{
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
      echo '<input type="hidden" name="token" value="';
      echo htmlspecialchars($_SESSION['token']);
      echo '">';
      echo "<p>この記事を削除しますか？</p>";
      echo '<p>タイトル</p><p>';
      echo sanitize($post['title']);
      echo '</p>';
      echo "<p>本文</p><p>";
      echo sanitize($post['content']);
      echo '</p>';
      echo '<input name="submit" type="submit" value="削除する">';
    }
    ?>

  </div>
</form>

<div class="bottomlink">
  <a href="javascript:history.back()">[戻る]</a>
</div>

</body>
</html>