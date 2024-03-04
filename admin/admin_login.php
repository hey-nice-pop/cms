<?php 
session_start();
session_regenerate_id(true);
$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>管理画面ログイン</title>
</head>

<body>
	
	管理画面ログイン<br/>
	<br/>
	<form method="post" action="admin_logincheck.php">
		管理者名<br/>
		<input type="text" name="name"><br/>
		パスワード<br/>
		<input type="password" name="password"><br/>
		<br />
		<input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token']) ?>">
		<input type="submit" value="ログイン">
	</form>
</body>
</html>