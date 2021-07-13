<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="update.css">
		<title>修正画面</title>
		<div class="subject"><p>管理者ページ</p></div>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';

//			$_SESSION['code'] = "$pro_code";

			session_cache_expire(30);// 有効期間30分
			session_start();


			try
			{
				$pro_code=$_GET['procode'];

				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='SELECT * FROM mst_product WHERE code = :code';
				$stmt=$db->prepare($sql);
				$stmt->bindValue(':code', $pro_code, PDO::PARAM_INT);
				$stmt->execute();

				$rec=$stmt->fetch(PDO::FETCH_ASSOC);
				$dbh=null;

				if($rec==false)
				{
					print'商品入力が正しくありません。';
					print'<a href="kanri.php">戻る</a>';
					print '<br />';
					exit();
				}

				//$_SESSION['code'] = "$pro_code";
				//print '<form method="post" action="create_done.php">';
				//print '<input type="button" onclick="history.back()" value="戻る">';
				//print '<input type="submit" value="登録">';
				//print '</form>';

				$pro_name = $rec['name'];
				$pro_price = $rec['price'];
				$pro_letter = $rec['letter'];
				$pro_flag = $rec['flag'];
//				$_SESSION["code"]

				//画像

				if($rec['gazou']=='')
				{
					$disp_gazou='';
				}
				else
				{
					$disp_gazou='<img src="./gazou/'.$rec['gazou'].'">';
				}
			}
			catch(Exception $e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>

		＜修正＞<br /><br />
		修正したい項目を入力してください。<br /><br />
		商品ID<br />
		<?php print $pro_code;?>

<!--		<form method="post" action="update_check.php" enctype="multipart/form-data">
-->	
		<?php 
//			$_SESSION['code'] = "$pro_code";
//  		session_start();
//			// 有効期限30日
//  		session_cache_expire(60 * 24 * 30);
//    		$_SESSION["code"]
		?>

		<form method="post" action="update_check.php" enctype="multipart/form-data">
		商品名<br />
		<input type="text" name="name" style="width:200px" value="<?php print $pro_name; ?>"><br />

		価格<br />
		<input type="text" name="price" style="width:50px" value="<?php print $pro_price; ?>">円<br />
		
		説明・販売状況<br />
		<input type="text" name="letter" style="width: 300px" value="<?php print $pro_letter; ?>"><br />

		画像<br />
		<?php print $disp_gazou; ?><br />
		画像を選んでください。<br />
		<input type="file" name="gazou" style="width:400px"><br />

		食堂1/お弁当2<br />
		<input type="radio" name="flag" value="1" checked="checked" />1<br>
		<input type="radio" name="flag" value="2" />2<br>
		<br />

		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="次へ">
		</form>

	</body>
</html>