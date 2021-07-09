<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>登録画面</title>
		<h>管理者ページ<h><br /><br />
	</head>
	<body>
		＜新規登録＞<br /><br />
		登録したい項目を入力してください。<br/><br/>
		商品ID<br/>
		自動で作成されます。<br/>
		<form method="post" action="create_check.php" enctype="multipart/form-data">
		商品名<br />
		<input type="text" name="name" style="width:100px"><br />
		価格<br />
		<input type="text" name="price" style="width:50px"><br />
		説明・販売状況<br />
		<!--<!input type="text" name="letter" style="width:200px"><br />-->
		<input type="text" name="letter" style="width:200px"><br />
		<!--画像-->
		画像<br />
		<input type="file" name="gazou" style="width:400px"><br />
		食堂1/お弁当2<br />
		<input type="radio" name="flag" value="1" checked="checked" />1<br>
		<input type="radio" name="flag" value="2" />2<br>
		<br />
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="次へ">
		</form>

	</body>
</html>
