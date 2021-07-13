<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
<<<<<<< HEAD
		<link rel="stylesheet" href="create_check.css">
		<title>登録内容確認画面</title>
		<div class="subject"><p>管理者ページ</p></div><br /><br />
=======
		<title>登録内容確認画面</title>
		<h>管理者ページ<h><br /><br />
>>>>>>> 266ab01b256d466a57280852788e76b3bb4c91e9
	</head>
	<body>
		<?php
			require_once '_h.php';

			session_cache_expire(30);// 有効期間30分
			session_start();

			$pro_name=$_POST['name'];
			$pro_price=$_POST['price'];
			$pro_letter=$_POST['letter'];
			$pro_flag=$_POST['flag'];
			//画像
			$pro_gazou=$_FILES['gazou'];
			//最大画像サイズ
			$max_size=4*1024*1024;//4MB

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
<<<<<<< HEAD
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
=======
//			if($pro_gazou['size']>0)
//			{
//				if($pro_gazou['size']>$max_size)
//				{
//					print '画像が大き過ぎます';
//				}
//				else
//			{
//				move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
//					print '<img src="./gazou/'.$pro_gazou['name'].'">';
//					print '<br />';
//				}
//			}

			//画像
			$img_error=0;
			$img_type=".jpg";
			if($pro_gazou['name']=='')
			{
				print '画像：選択されていません<br />';
				$img_error=1;
			}
			else if(strpos($pro_gazou['name'],$img_type)===false)
			{
				print '画像：jpgファイルではありません<br />';
				$img_error=1;
			}
			else if($pro_gazou['size']>$max_size)
			{
				print '画像：画像が大き過ぎます<br />';
				$img_error=1;
			}
			else
			{
				move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
				print '<img src="./gazou/'.$pro_gazou['name'].'">';
				print '<br />';
			}

>>>>>>> 266ab01b256d466a57280852788e76b3bb4c91e9
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
			//登録ボタン表示
//			if( $pro_name=='' || $pro_letter =='' || $pro_name=='' || $pro_price==0 || $pro_gazou['size']>$max_size)
<<<<<<< HEAD
			if( $pro_name=='' || $pro_letter =='' || $pro_name=='' || $pro_price==0 || $pro_gazou['size']>$max_size)
=======
			if( $pro_name=='' || $pro_letter =='' || $pro_name=='' || $pro_price==0 || $pro_gazou['size']>$max_size || $pro_gazou['name']=='' || strpos($pro_gazou['name'],$img_type)===false || $pro_gazou['size']>$max_size)
>>>>>>> 266ab01b256d466a57280852788e76b3bb4c91e9
			{
				print '<form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			}
			else
			{
				$_SESSION['name'] = "$pro_name";
				$_SESSION['price'] = "$pro_price";
				$_SESSION['letter'] = "$pro_letter";
				$_SESSION['flag'] = "$pro_flag";
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
