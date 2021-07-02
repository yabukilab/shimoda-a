<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>新規登録</title>
	</head>
	<body>
		新規登録<br /><br />
		<form method="post" action="create_check.php" enctype="multipart/form-data">
		名前を入力してください。<br />
		<input type="text" name="name" style="width:100px"><br />
		価格を入力してください。<br />
		<input type="text" name="price" style="width:50px"><br />
		<!--画像-->
		画像を選んでください。<br />
		<input type="file" name="gazou" style="width:400px"><br />
		<br />
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="確認">
		</form>

	</body>
</html>
