<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="update_check.css">
		<title>修正確認画面</title>
		<div class="subject"><p>管理者ページ</p></div>
	</head>
	<body>
		<?php
		require_once '_database_conf.php';
		require_once '_h.php';

		session_cache_expire(30);// 有効期間30分
		session_start();

		try
		{
			//$pro_code=$_POST['procode'];

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

			$pro_name = $rec['name'];
			$pro_price = $rec['price'];
			$pro_letter = $rec['letter'];
			$pro_flag = $rec['flag'];

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
	<?
			//require_once '_h.php';

			$pro_name=$_POST['name'];
			$pro_price=$_POST['price'];
			$pro_letter=$_POST['letter'];
			$pro_flag=$_POST['flag'];
			//画像
			$pro_gazou=$_FILES['gazou'];
			//最大画像サイズ
			$max_size=4*1024*1024;//4MB

			print '＜修正＞<br /><br />';
			print '以下の内容でよろしいでしょうか？<br /><br />';

			session_start();
		
			if (isset($_SESSION["code"])) {
				print "<p>";
				print "商品ID：".$_SESSION["code"];
				print "</p>";
			}
//			if (isset($_SESSION['code'])) {
//				$pro_code=$_SESSION['code'];
//			}
//			else{
//				print'商品IDが受信できません。';
//				exit();
//			}

			print '商品ID：';
			print  h($pro_code);
			print '<br />';

			if($pro_name=='')
			{
				print '商品名：入力されていません。<br />';
			}
			else
			{
				print '商品名：';
				print  h($pro_name);
				print '<br />';
			}

			if($pro_price=='')
			{
				print '価格：入力されていません。<br />';
			}
			else
			{
				print '価格：';
				print h($pro_price);
				print '<br />';
			}

			if($pro_letter=='')
			{
				print '説明・販売状況：記入されていません。<br />';
			}
			else
			{
				print '説明・販売状況：';
				print  h($pro_letter);
				print '<br />';
			}
			//画像
			if($pro_gazou['size']>0)
			{
				if($pro_gazou['size']>$max_size)
				{
					print '画像が大き過ぎます';
				}
				else
				{
					move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
					print '<img src="./gazou/'.$pro_gazou['name'].'">';
					print '<br />';
				}
			}
			
			if($pro_flag=='')
			{
				print '食堂・お弁当が選択されていません。<br />';
			}
			else
			{
				print '食堂1/お弁当2：';
				print  h($pro_flag);
				print '<br />';
			}

			//画像追加
			//if($pro_name=='' || $pro_price ==0 || $pro_gazou['size']>$max_size)
			if( $pro_name=='' || $pro_letter =='' || $pro_name=='' || $pro_price==0 || $pro_gazou['size']>$max_size)
			{
				print '<form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			}
			else
			{
				print '<br />';

				$_SESSION['name'] = "$pro_name";
				$_SESSION['price'] = "$pro_price";
				$_SESSION['letter'] = "$pro_letter";
				$_SESSION['flag'] = "$pro_flag";
				//画像
				$_SESSION['gazou'] = $pro_gazou['name'];

				print '<form method="post" action="update_done.php">';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '<input type="submit" value="修正">';
				print '</form>';

			}
		?>
	</body>
</html>