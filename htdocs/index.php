<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="PM演習.css">
		<script type="text/javascript">
		var now = new Date();
    function LoadProc() {
      var target = document.getElementById("DateTimeDisp");

      var Year = now.getFullYear();
      var Month = now.getMonth()+1;
      var Date = now.getDate();
      var Hour = now.getHours();
      var Min = now.getMinutes();
      var Sec = now.getSeconds();

      target.innerHTML = Year + "年" + Month + "月" + Date + "日" + Hour + ":" + Min + ":" + Sec;
    }

  </script>
	</head>
	<body onload = "LoadProc();">
   

		<title>学生食堂</title>
		<div class="titlebar">
		<div class="subject"><p>学生食堂</p></div>
		<br>
		<div class="subject2"><input type="button" onclick="location.href='kanri.php'" value="管理者"></div>
        </br>
        </div>
	</head>
	<body>		
			    <a href="count.php">
				<div class="box1">
	            <?php
		        print '<br />';
		        print '<form action="count.php" method="post">';
		        print '<input type="submit" name="count" value="利用希望者カウント" />';
				print '</form>';
		        print '<br />';
                ?>
				</div><br />
				
				
				<br />
				<div class="box2">
				<a href="syokudou.php">
	            <?php
		        print '<br />';
		        print '<form action="syokudou.php" method="post">';
		        print '<input type="submit" name="syokudou" value="食堂メニュー" />';
				print '</form>';
		        print '<br />';
                ?>
				</div><br />

				<br />
				<div class="box3">
				<a href="obentou.php">
	            <?php
		        print '<br />';
		        print '<form action="obentou.php" method="post">';
		        print '<input type="submit" name="obentou" value="お弁当メニュー" />';
				print '</form>';
		        print '<br />';
                ?>
			    </div><br />
			
		
		


	</body>
</html>
