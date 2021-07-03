<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>入力内容チェック</title>
	</head>
	<body>
		<?php
			require_once '_h.php';

			session_cache_expire(30);// 有効期間30分
			session_start();

			$pro_name=$_POST['name'];
			$pro_price=$_POST['price'];
			//画像
			$pro_gazou=$_FILES['gazou'];
			//最大画像サイズ
			$max_size=4*1024*1024;//4MB

			if($pro_name=='')
			{
				print '名前が入力されていません。<br />';
			}
			else
			{
				print '名前:';
				print  h($pro_name);
				print '<br />';
			}

			if($pro_price=='')
			{
				print '価格が入力されていません。<br />';
			}
			else
			{
				print '価格:';
				print h($pro_price);
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

			//画像追加
			if(($pro_name=='' || $pro_price)==0 || $pro_gazou['size']>$max_size)
			{
				print '<form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			}
			else
			{
				print '上記の内容を追加します。<br />';
				print '<br />';

				$_SESSION['name'] = "$pro_name";
				$_SESSION['price'] = "$pro_price";
				//画像
				$_SESSION['gazou'] = $pro_gazou['name'];

				print '<form method="post" action="create_done.php">';
				print '<input type="button" onclick="history.back()" value="戻る">';
//				print '<input type="submit" value="登録">';
				print '</form>';

			}
		?>
	</body>
</html>
