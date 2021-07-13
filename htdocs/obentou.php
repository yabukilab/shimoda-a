<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="obentou.css">
		<title>お弁当メニュー画面</title>
		<div class="titlebar">
		<div class="subject"><p>お弁当メニュー</p></div>
		<br>
		<div class="subject2"><input type="button" onclick="location.href='index.php'" value="HOME"></div>
        </br>
        </div>
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

				print '＜今日のメニュー＞<br /><br />';

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
					//画像
					if($rec['gazou']=='')
					{
						$disp_gazou='';
					}
					else{
						$disp_gazou='<img src="./gazou/'.$rec['gazou'].'" height="50">';
					}
					print $disp_gazou;
					print h($rec['name']).'  ';
					print h($rec['price']).'円  ';
					print h($rec['letter']).'  ';
					print '<br />';
					$i++;
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