<?php
session_start();
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>管理者追加確認</title>
<link rel="stylesheet" href="blog.css">
</head>

<body>
	
<?php
	include '../common.php';
	

   $staff_name =$staff_pass = '';
   if(isset($_POST['name'])) $staff_name=$_POST['name'];
	if(isset($_POST['password'])) $staff_pass=$_POST['password'];

	if($staff_name==''){
		print 'スタッフ名が入力されていません。<br>';
	}
	
	if($staff_pass==''){
		print 'パスワードが入力されていません。<br>';
	}

	if(!isset($_SESSION['token'],$_REQUEST['token'])){
      print '外部サイトからの直接アクセスは禁止されています。<br>';
     }elseif ($_SESSION['token'] !== $_REQUEST['token']){
      print 'トークン不一致エラー<br>';
     }

	if($staff_name == '' || $staff_pass == '' || !isset($_SESSION['token'],$_REQUEST['token'])){
		print '<form>';
		print '<input type="button" onclick="history.back()" value="戻る">';
		print '</form>';
	}elseif($_SESSION['token'] !== $_REQUEST['token']){
      print '<form>';
		print '<input type="button" onclick="history.back()" value="戻る">';
		print '</form>';
   }
	else{
      try{
      $staff_pass=password_hash($staff_pass,PASSWORD_DEFAULT);
      include 'dbsetting.php';
      $sql = "INSERT INTO staff(name,password) VALUES(?,?)";
      $st = $pdo->prepare($sql);
      $st->bindValue(1,$staff_name);
		$st->bindValue(2,$staff_pass);
      $st->execute();
      $pdo = null;

      print "<p>追加完了しました。</p><br>";
      print '<a href="admin_top.php">[戻る]</a>';

      }
      catch(Exception $e){
         print 'ただいま障害により大変ご迷惑をお掛けしております。';
         exit();
      }

   }
	
	?>
</body>
</html>