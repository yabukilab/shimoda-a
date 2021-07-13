<<<<<<< HEAD
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="update_done.css">
		<title>修正完了</title>
		<div class="subject"><p>管理者ページ</p></div>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';

			session_start();

			if (isset($_SESSION['code'])) {
				$pro_code=$_SESSION['code'];
			}
			else{
				print'商品IDが受信できません。';
				exit();
			}
			if (isset($_SESSION['name'])) {
				$pro_name=$_SESSION['name'];
			}
			else{
				print'商品名が受信できません。';
				exit();
			}
			if (isset($_SESSION['price'])) {
				$pro_price=$_SESSION['price'];
			}
			else{
				print'価格が受信できません。';
				exit();
			}
			if (isset($_SESSION['letter'])) {
				$pro_letter=$_SESSION['letter'];
			}
			else{
				print'説明・販売状況が受信できません。';
				exit();
			}
			//画像
			if (isset($_SESSION['gazou'])) {
				$pro_gazou=$_SESSION['gazou'];
			}
			else{
				print'画像が受信できません。';
				exit();
			}
			session_unset();// セッション変数をすべて削除
			session_destroy();// セッションIDおよびデータを破棄

			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				//発売日、画像
				$sql='UPDATE mst_product SET name=:name,price=:price,gazou=:gazou,letter=letter,flag=flag WHERE code=:code';
				$prepare=$db->prepare($sql);
				$prepare->bindValue(':name', $pro_name, PDO::PARAM_STR);
				$prepare->bindValue(':price', $pro_price, PDO::PARAM_INT);
				$prepare->bindValue(':gazou', $pro_gazou, PDO::PARAM_STR);
				$prepare->bindValue(':flag', $pro_flag, PDO::PARAM_INT);
				$prepare->bindValue(':letter', $pro_letter, PDO::PARAM_INT);
				$prepare->bindValue(':code', $pro_code, PDO::PARAM_INT);
				$prepare->execute();

				$db=null;

				print '修正しました。<br />';

			}
			catch(Exception$e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>
		<form method="get" action="kanri.php">
		<input type="submit" value="戻る" style="width:40px,height:20px">
	</body>
</html>
=======
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>修正完了</title>
		<h>管理者ページ<h><br /><br />
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';

			session_start();

			if (isset($_SESSION['code'])) {
				$pro_code=$_SESSION['code'];
			}
			else{
				print'商品IDが受信できません。';
				exit();
			}
			if (isset($_SESSION['name'])) {
				$pro_name=$_SESSION['name'];
			}
			else{
				print'商品名が受信できません。';
				exit();
			}
			if (isset($_SESSION['price'])) {
				$pro_price=$_SESSION['price'];
			}
			else{
				print'価格が受信できません。';
				exit();
			}
			if (isset($_SESSION['letter'])) {
				$pro_letter=$_SESSION['letter'];
			}
			else{
				print'説明・販売状況が受信できません。';
				exit();
			}
			if (isset($_SESSION['flag'])) {
				$pro_flag=$_SESSION['flag'];
			}
			else{
				print'食堂・お弁当が受信できません。';
				exit();
			}

			//画像
			if (isset($_SESSION['gazou'])) {
				$pro_gazou=$_SESSION['gazou'];
			}
			else{
				print'画像が受信できません。';
				exit();
			}
			session_unset();// セッション変数をすべて削除
			session_destroy();// セッションIDおよびデータを破棄

			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				//発売日、画像
				$sql='UPDATE mst_product SET name=:name,price=:price,gazou=:gazou,letter=:letter,flag=:flag WHERE code=:code';
				$prepare=$db->prepare($sql);
				$prepare->bindValue(':name', $pro_name, PDO::PARAM_STR);
				$prepare->bindValue(':price', $pro_price, PDO::PARAM_INT);
				$prepare->bindValue(':gazou', $pro_gazou, PDO::PARAM_STR);
				$prepare->bindValue(':flag', $pro_flag, PDO::PARAM_INT);
				$prepare->bindValue(':letter', $pro_letter, PDO::PARAM_STR);
				$prepare->bindValue(':code', $pro_code, PDO::PARAM_INT);
				$prepare->execute();

				$db=null;

				print '修正しました。<br />';

			}
			catch(Exception$e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>
		<form method="get" action="kanri.php">
		<input type="submit" value="戻る" style="width:40px,height:20px">
	</body>
</html>
>>>>>>> 266ab01b256d466a57280852788e76b3bb4c91e9
