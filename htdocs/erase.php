<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>削除画面</title>
		<h>管理者ページ<h><br /><br />
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
					print'商品IDが正しくありません。';
					print'<a href="kanri.php">戻る</a>';
					print '<br />';
					exit();
				}

				$_SESSION['code'] = "$pro_code";

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

		＜削除＞<br /><br />
		以下の内容でよろしいでしょうか？<br /><br />
		商品ID<br />
		<?php print h($rec['code']); ?><br />
		商品名<br />
		<?php print h($rec['name']); ?><br />
		価格<br />
		<?php print h($rec['price']); ?><br />
		説明・販売状況<br />
		<?php print h($rec['letter']); ?><br />
		画像<br />
		<?php print $disp_gazou; ?><br />
		食堂1/お弁当2<br />
		<?php print h($rec['flag']); ?><br />
		<br />
		
		<form method="post" action="erase_done.php">
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="削除">
		</form>

	</body>
</html>