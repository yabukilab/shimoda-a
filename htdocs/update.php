<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>商品修正</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';

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
					print'商品がコードが正しくありません。';
					print'<a href="kanri.php">戻る</a>';
					print '<br />';
					exit();
				}

				$_SESSION['code'] = "$pro_code";

				$pro_name = $rec['name'];
				$pro_price = $rec['price'];

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

		商品修正<br />
		<br />
		商品コード<br />
		<?php print $pro_code; ?><br />

		<form method="post" action="update_check.php" enctype="multipart/form-data">
		商品名<br />
		<input type="text" name="name" style="width:200px" value="<?php print $pro_name; ?>"><br />
		価格<br />
		<input type="text" name="price" style="width:50px" value="<?php print $pro_price; ?>">円<br />
		<!--画像-->
		画像<br />
		<?php print $disp_gazou; ?>
		画像を選んでください。<br />
		<input type="file" name="gazou" style="width:400px"><br />
		<br />
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="ＯＫ">
		</form>

	</body>
</html>