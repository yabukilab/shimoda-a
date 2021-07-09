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
				$sql='SELECT * FROM table1';
				$prepare=$db->prepare($sql);
				$prepare->execute();

				$db=null;

				print '商品一覧<br /><br />';

		 		while(true)
				{
					$rec=$prepare->fetch(PDO::FETCH_ASSOC);
					if($rec==false)
					{
						break;
					}
					print h($rec['code']).' ';
					print h($rec['name']).' ';
					print h($rec['price']);

//					print h($rec['id']).' ';
//					print h($rec['varcharA']).' ';
//					print h($rec['intA']);
//					print h($rec['intB']);
//					print '<br />';
				}
			}
			catch (Exception $e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>
	</body>
</html>
