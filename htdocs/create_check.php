<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
<<<<<<< HEAD
		<title>登録内容確認画面</title>
		<h>管理者ページ<h><br /><br />
=======
		<title>入力内容チェック</title>
>>>>>>> bc5535487d1f321791403d5eeccecff46ed64181
	</head>
	<body>
		<?php
			require_once '_h.php';

			session_cache_expire(30);// 有効期間30分
			session_start();

			$pro_name=$_POST['name'];
			$pro_price=$_POST['price'];
<<<<<<< HEAD
			$pro_letter=$_POST['letter'];
			$pro_flag=$_POST['flag'];
=======
>>>>>>> bc5535487d1f321791403d5eeccecff46ed64181
			//画像
			$pro_gazou=$_FILES['gazou'];
			//最大画像サイズ
			$max_size=4*1024*1024;//4MB

<<<<<<< HEAD
			print '＜新規登録＞<br/>';
			print '以下の内容でよろしいでしょうか？<br/><br/>';
			print '商品ID：自動で作成されます。<br/>';

			if($pro_name=='')
			{
				print '商品名：入力されていません。<br />';
			}
			else
			{
				print '商品名：';
=======
			if($pro_name=='')
			{
				print '名前が入力されていません。<br />';
			}
			else
			{
				print '名前:';
>>>>>>> bc5535487d1f321791403d5eeccecff46ed64181
				print  h($pro_name);
				print '<br />';
			}

			if($pro_price=='')
			{
<<<<<<< HEAD
				print '価格：入力されていません。<br />';
			}
			else
			{
				print '価格：';
				print h($pro_price);
				print '円<br />';
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
//			if($pro_gazou== 0)
//			{
//				print '画像が選択されていません。<br />';
//			}
//			else
//			{
//				print '画像';
//				print  h($pro_letter);
//				print '<br />';
//			}
//			elseif ($pro_gazou['upload']['size'] === 0)
//			 {
//				 echo 'ファイルを選択してください！';
//			 }
   
//			画像
=======
				print '価格が入力されていません。<br />';
			}
			else
			{
				print '価格:';
				print h($pro_price);
				print '<br />';
			}
			//画像
>>>>>>> bc5535487d1f321791403d5eeccecff46ed64181
			if($pro_gazou['size']>0)
			{
				if($pro_gazou['size']>$max_size)
				{
					print '画像が大き過ぎます';
				}
				else
<<<<<<< HEAD
			{
=======
				{
>>>>>>> bc5535487d1f321791403d5eeccecff46ed64181
					move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
					print '<img src="./gazou/'.$pro_gazou['name'].'">';
					print '<br />';
				}
			}
<<<<<<< HEAD
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
//			if( $pro_name=='' || $pro_letter =='' || $pro_name=='' || $pro_price==0 || $pro_gazou['size']>$max_size)
			if( $pro_name=='' || $pro_letter =='' || $pro_name=='' || $pro_price==0 || $pro_gazou['size']>$max_size)
=======

			//画像追加
			if(($pro_name=='' || $pro_price)==0 || $pro_gazou['size']>$max_size)
>>>>>>> bc5535487d1f321791403d5eeccecff46ed64181
			{
				print '<form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			}
			else
			{
<<<<<<< HEAD
				$_SESSION['name'] = "$pro_name";
				$_SESSION['price'] = "$pro_price";
				$_SESSION['letter'] = "$pro_letter";
				$_SESSION['flag'] = "$pro_flag";
=======
				print '上記の内容を追加します。<br />';
				print '<br />';

				$_SESSION['name'] = "$pro_name";
				$_SESSION['price'] = "$pro_price";
>>>>>>> bc5535487d1f321791403d5eeccecff46ed64181
				//画像
				$_SESSION['gazou'] = $pro_gazou['name'];

				print '<form method="post" action="create_done.php">';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '<input type="submit" value="登録">';
				print '</form>';

			}
		?>
	</body>
</html>
