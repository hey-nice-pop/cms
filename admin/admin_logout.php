<?php
session_start();
$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ログアウト</title>
<link rel="stylesheet" href="blog.css">
</head>
<body>
<p>ログアウトしました。</p>
<a href="admin_login.php">ログインへ</a>
</body>
</html>