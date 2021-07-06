<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>商品一覧</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';
			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='SELECT * FROM mst_product order by flag';
//				$sql='SELECT * FROM mst_product WHERE flag = :flag ';
//				$sql='SELECT code,name,price FROM mst_product ORDER BY price DESC';
				$prepare=$db->prepare($sql);
//				$prepare->bindValue(':flag', 1, PDO::PARAM_INT);
				$prepare->execute();

				$db=null;

				print '＜登録食堂メニュー＞<br /><br />';
				print '■商品ID　■商品名　■値段　■説明・販売状況　■挿入画像<br />';

//				$i=1;
				$sflag = 0;

				while(true)
				{
					$rec=$prepare->fetch(PDO::FETCH_ASSOC);
					if($rec==false)
					{
						break;
					}

					$temp=h($rec['flag']);
					if($temp ==1 && $sflag==0)
		            {
						print '＜登録食堂メニュー＞<br /><br />';
						$sflag=1;
					}

					//print '■'.h($rec['code']).'　　　';
					//print h($i).' ';
					//print '■'.h($rec['name']).' 　　';
					//print '■'.h($rec['price']).'円　　';
					//print '■'.h($rec['letter']);
					//画像
					if($rec['gazou']=='')
					{
						$disp_gazou='';
					}
					else{
						$disp_gazou='<img src="./gazou/'.$rec['gazou'].'" height="50">';
					}
					//print $disp_gazou;
					//print '■'.$temp;
					echo sprintf("%10d %100s %5d %30s %1d",h($rec['code']),h($rec['name']),h($rec['price']),h($rec['letter']),$temp,$disp_gazou);
					print '<br />';
//					$i++;

                }

//				print '<br />';
//				print '<a href="create.php">新規登録</a><br />';
                print '<br />';
				print '<form method="get" action="create.php">';
				print '新規登録：　　　　　';
				print '<input type="submit" value="決定">';
				print '</form>';

				print '<br />';
				print '<form method="get" action="update.php">';
				print '商品修正：商品ID';
				print '<input type="text" name="procode" style="width:20px">';
				print '<input type="submit" value="決定">';
				print '</form>';

				print '<br />';
				print '<form method="get" action="erase.php">';
				print '商品削除：商品ID';
				print '<input type="text" name="procode" style="width:20px">';
				print '<input type="submit" value="決定">';
				print '</form>';
			}
			catch (Exception $e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
//			{
//				print'<a href="index.php">戻る</a>';
//				print '</form>';
//			}
		?>
		<br /><br />
		<input type="button" onclick="location.href='index.php'" value="戻る">
	</body>
</html>
