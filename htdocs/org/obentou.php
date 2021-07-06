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

//				$sql='SELECT * FROM mst_product';
				$sql='SELECT * FROM mst_product WHERE flag = :flag ';
//				$sql='SELECT code,name,price FROM mst_product WHERE price > 100';
//				$sql='SELECT code,name,price FROM mst_product ORDER BY price DESC';
				$prepare=$db->prepare($sql);
				$prepare->bindValue(':flag', 2, PDO::PARAM_INT);
				$prepare->execute();

				$db=null;

				print '商品一覧<br /><br />';

				$i=1;

				while(true)
				{
					$rec=$prepare->fetch(PDO::FETCH_ASSOC);
					if($rec==false)
					{
						break;
					}
//					print h($rec['code']).' ';
                    print h($i).' ';
					print h($rec['name']).' ';
					print h($rec['price']);
					//画像
					if($rec['gazou']=='')
					{
						$disp_gazou='';
					}
					else{
						$disp_gazou='<img src="./gazou/'.$rec['gazou'].'" height="50">';
					}
					print $disp_gazou;
					print '<br />';
					$i++;
				}
			}
			catch (Exception $e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
			{
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			}
		?>
	</body>
</html>