<?php
   $dsn='mysql:dbname=blog;host=127.0.0.1';//データベース設定
   $user='root';//ユーザ名
   $pass='';//パスワード
   $pdo = new PDO($dsn,$user,$pass);
   $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>