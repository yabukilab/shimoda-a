<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="PM演習.css">
		<title>学生食堂</title>
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

				$sql='SELECT * FROM mst_product';
//				$sql='SELECT code,name,price FROM mst_product WHERE price > 100';
//				$sql='SELECT code,name,price FROM mst_product ORDER BY price DESC';
				$prepare=$db->prepare($sql);
				$prepare->execute();

				$db=null;

				print '学生食堂';

				print '<a href="kanri.php"><h1>管理者</h1></a><br />';

				
				print '<br />';
				print '<div class="box1"><h2><a href="count.php">利用希望者カウント</a></h2></div><br />';
				
				
				print '<br />';
				print '<div class="box2"><a href="obentou.php"><h3>お弁当メニュー</h3></a></div><br />';
				

				print '<br />';
				print '<div class="box3"><a href="syokudou.php"><h4>食堂メニュー</h4></a></div><br />';
			}
			catch (Exception $e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>
	</body>
</html>
