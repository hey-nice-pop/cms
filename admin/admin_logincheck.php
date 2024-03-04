<?php
session_start();
session_regenerate_id(true);

try{
	include('../common.php');
	
	if(isset($_POST['name'])) $staff_name=$_POST['name'];
	if(isset($_POST['password'])) $staff_pass=$_POST['password'];

	if(!isset($_SESSION['token'],$_REQUEST['token'])){
      print '外部サイトからの直接アクセスは禁止されています。<br>';
		print '<a href="admin_login.php">戻る</a>';
		exit();
     }elseif ($_SESSION['token'] !== $_REQUEST['token']){
      print 'トークン不一致エラー<br>';
		print '<a href="admin_login.php">戻る</a>';
		exit();
     }
	
	include 'dbsetting.php';

	$sql='SELECT password FROM staff WHERE name=?';
	$st=$pdo->prepare($sql);
	$st->bindValue(1,$staff_name);
	$st->execute();
	
	$rec=$st->fetch(PDO::FETCH_ASSOC);
	
	$pdo = null;

	if(!password_verify($staff_pass,$rec['password'],)){
		print '管理者名かパスワードが間違っています。<br />';
		print '<a href="admin_login.php">戻る</a>';
	}
	else{
		
		$_SESSION['login']=1;
		$_SESSION['staff_name']=$staff_name;
		header('Location:admin_top.php');
		exit();
	}
}
catch(Exception $e){
	print '通信エラー';
	exit();
}
?>