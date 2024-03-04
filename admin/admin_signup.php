<?php 
session_start();
session_regenerate_id(true);
$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>管理者追加</title>
<link rel="stylesheet" href="blog.css">
</head>
<body>
<form method="post" action="admin_signupdone.php">
  <div class="post">
    <h1>管理者追加</h2>
    <p>管理者名</p>
    <input type="text" name="name" size="40">
    <p>パスワード</p>
    <input type="password" name="password" size="40">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token']) ?>">
    <p>追加ボタンを押して追加する</p>
    <input name="submit" type="submit" value="追加">

  </div>
</form>

</body>
</html>