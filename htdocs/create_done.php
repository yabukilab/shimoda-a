<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
<<<<<<< HEAD
		<title>登録完了画面</title>
		<h>管理者ページ<h><br /><br />
=======
		<title>DB登録</title>
>>>>>>> bc5535487d1f321791403d5eeccecff46ed64181
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';

<<<<<<< HEAD
			print '＜新規登録＞<br/>';

=======
>>>>>>> bc5535487d1f321791403d5eeccecff46ed64181
			session_start();
			if (isset($_SESSION['name'])) {
				$pro_name=$_SESSION['name'];
			}
			else{
<<<<<<< HEAD
				print'商品名が受信できません。';
				exit();
			}

=======
				print'名前が受信できません。';
				exit();
			}
>>>>>>> bc5535487d1f321791403d5eeccecff46ed64181
			if (isset($_SESSION['price'])) {
				$pro_price=$_SESSION['price'];
			}
			else{
				print'価格が受信できません。';
				exit();
			}
<<<<<<< HEAD

			if (isset($_SESSION['letter'])) {
				$pro_letter=$_SESSION['letter'];
			}
			else{
				print'説明・販売状況が受信できません。';
				exit();

			}if (isset($_SESSION['flag'])) {
				$pro_flag=$_SESSION['flag'];
			}
			else{
				print'食堂1/お弁当2が受信できません。';
				exit();
			}

=======
>>>>>>> bc5535487d1f321791403d5eeccecff46ed64181
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
<<<<<<< HEAD
				$sql='INSERT INTO mst_product(name,price,letter,flag,gazou) VALUES (:name, :price, :letter, :flag, :gazou)';
				$prepare=$db->prepare($sql);
				$prepare->bindValue(':name', $pro_name, PDO::PARAM_STR);
				$prepare->bindValue(':price', $pro_price, PDO::PARAM_INT);
				$prepare->bindValue(':letter', $pro_letter, PDO::PARAM_STR);
				$prepare->bindValue(':flag', $pro_flag, PDO::PARAM_INT);
=======
				$sql='INSERT INTO mst_product(name,price,gazou) VALUES (:name, :price, :gazou)';
				$prepare=$db->prepare($sql);
				$prepare->bindValue(':name', $pro_name, PDO::PARAM_STR);
				$prepare->bindValue(':price', $pro_price, PDO::PARAM_INT);
>>>>>>> bc5535487d1f321791403d5eeccecff46ed64181
				$prepare->bindValue(':gazou', $pro_gazou, PDO::PARAM_STR);
				$prepare->execute();

				$db=null;

<<<<<<< HEAD
				/*print '商品名：'.h($pro_name);
				print '<br />';

				print '値段：';
				print h($pro_price);
				print '<br />';

				print '説明・販売状況：';
				print h($pro_letter).'';
				print '<br />';

				print '画像';
				print h($pro_gazou).'';
				print '<br />';

				print '食堂1/お弁当2:';
				print h($pro_flag).'';
				print '<br />';
				*/
				print '登録しました。';
=======
				print h($pro_name).' ';
				print h($pro_price).' ';
				print h($pro_gazou);
				print 'を追加しました。<br />';

>>>>>>> bc5535487d1f321791403d5eeccecff46ed64181
			}
			catch(Exception$e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>
<<<<<<< HEAD
		<form method="get" action="kanri.php">
		<br />
		<input type="submit" value="戻る" style="width:40px,height:20px">
		</form>
=======
		<a href="kanri.php">戻る</a>
>>>>>>> bc5535487d1f321791403d5eeccecff46ed64181
	</body>
</html>
