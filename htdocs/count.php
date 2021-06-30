<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>利用希望者カウント</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';
			//プルダウンメニュー
			require_once '_common.php';

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

				print '利用希望者カウント<br /><br />';

				
//-------------------------------------------------------------------------------------------------------

$dsn='mysql:dbname=_project;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,time,konn FROM thudakonn WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;


$dsn='mysql:dbname=_project;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,time,konn FROM shinkon WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

print '<br /><br /><br />';
print '新習志野キャンパスの混雑度<br /><br />';



//検索キーワード代入
//$keyword=$_GET['keyword'];//$keywordが空のときエラー
if (isset($_GET['keyword'])){
	$keyword=$_GET['keyword'];
}
else{
	$keyword='';
}
print '<br />';


while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	//検索処理
	if (($keyword==='')||(strpos($rec['code'],$keyword)!==false)){
	//if (strpos($rec['name'],$keyword)!==false){//$keywordが空のときエラー
		print $rec['code'].' ';
        print $rec['time'].' ';
        print $rec['konn'].' %';

		
		print '<br />';
	}
}


//------------------------------------------------------------------------------------------------------------------



}



catch (Exception $e)
{
	 print 'ただいま障害により大変ご迷惑をお掛けしております。';
	 exit();
}

?>

<form method="post" action="add_check.php">
            日時<input type="date" name="time" value="" />

            混雑度<select name="konn">
            <option value="100">100</option>
            <option value="90">90</option>
            <option value="80">80</option>
            <option value="70">70</option>
            <option value="60">60</option>
            <option value="50">50</option>
            <option value="40">40</option>
            <option value="30">30</option>
            <option value="20">20</option>
            <option value="10">10</option>
            <option value="0">0</option>
            </select>％
            <input type="submit" name="send" value="送信" />
            <br/><br/><br/>
           
</form>

<?php
print '<br /><br /><br />';
print '津田沼キャンパスの混雑度<br /><br />';



//検索キーワード代入
//$keyword=$_GET['keyword'];//$keywordが空のときエラー
if (isset($_GET['keyword'])){
	$keyword=$_GET['keyword'];
}
else{
	$keyword='';
}
print '<br />';


while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	//検索処理
	if (($keyword==='')||(strpos($rec['code'],$keyword)!==false)){
	//if (strpos($rec['name'],$keyword)!==false){//$keywordが空のときエラー
		print $rec['code'].' ';
        print $rec['time'].' ';
        print $rec['konn'].'% ';

		
		print '<br />';
	}
}


//------------------------------------------------------------------------------------------------------------------






?>

<form method="post" action="add_check.php">
            日時<input type="date" name="time" value="" />

            混雑度<select name="konn">
            <option value="100">100</option>
            <option value="90">90</option>
            <option value="80">80</option>
            <option value="70">70</option>
            <option value="60">60</option>
            <option value="50">50</option>
            <option value="40">40</option>
            <option value="30">30</option>
            <option value="20">20</option>
            <option value="10">10</option>
            <option value="0">0</option>
            </select>％
            <input type="submit" name="send" value="送信" />
            <br/><br/><br/>
           
</form>
			
							
	   
		<a href="index.php">戻る</a>
	</body>
</html>
