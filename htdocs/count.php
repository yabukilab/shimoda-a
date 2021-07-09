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
		try
		{
			$db = new PDO($dsn, $dbUser, $dbPass);
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			//A班
			if((isset($_POST['count']))&&($_POST['count']=="利用希望者カウント")) {

				//現在時刻
				date_default_timezone_set('Asia/Tokyo');
				//データ取得
				$timedata = time();
				//文字列を作る
				$timetext = date('Y/m/d' ,$timedata);
				$timetext2 = date('h:i:s',$timedata);

				//表示
				print '現在時刻　';
				echo "$timetext";
				print '<br />';

				//登録
				$sql='INSERT INTO acount_data(date) VALUES (:date)';
				$prepare=$db->prepare($sql);
				$prepare->bindValue(':date', $timetext, PDO::PARAM_STR);
				$prepare->execute();


				$sql='INSERT INTO acount_data(time) VALUES (:time)';
				$prepare=$db->prepare($sql);
				$prepare->bindValue(':time', $timetext2, PDO::PARAM_STR);
				$prepare->execute();





				//検索
				print '検索条件　';

				$year = date ( 'Y' );
				$month = date ( 'm' );
				$day = date ( 'd' );
				$hour = date ( 'h' );
				$minute = date ( 'i' );
				$second = date ('s');

//test
//					$date_start = '2021/06/30';
//					$date_end = '2021/07/02';
//					$time_start = '9:00:00';
//					$time_end = '18:00:00';


              //date_start
				$timedata = mktime ( 00, 00, 00, $month, $day - 7, $year );
				$date_start = date('Y/m/d',$timedata);
				echo 'date_start ';
				echo $date_start;

				//date_end
				$timedata = mktime ( 00, 00, 00, $month, $day, $year );
				$date_end = date('Y/m/d',$timedata);
				echo ' date_end ';
				echo $date_end;

				//time_start
				$hour = '09';
				$minute = '00';
				$second ='00';
				
				$timedata = mktime ( $hour, $minute, $second );
				$time_start = date('H:i:s',$timedata);
				echo ' time_start ';
				echo $time_start;

              /*$timedata = mktime ( $hour, $minute, $second );
				$time_end = date('H:i:s',$timedata);
				echo ' time_end ';
				echo $time_end;*/
				
				//time_start
				$hour = '10';
				$minute = '00';
				$second ='00';
				
              //time_end
				$timedata = mktime ( $hour, $minute, $second );
				$time_end = date('H:i:s',$timedata);
				echo ' time_end ';
				echo $time_end;
				print '<br />';

				$timedata = mktime ( $hour, $minute, $second );
				$time_start = date('H:i:s',$timedata);
				echo ' time_start ';
				echo $time_start;

              //time_start
				$hour = '11';
				$minute = '00';
				$second ='00';
				
              //time_end
				$timedata = mktime ( $hour, $minute, $second );
				$time_end = date('H:i:s',$timedata);
				echo ' time_end ';
				echo $time_end;
				print '<br />';

              //time_start
				$hour = '12';
				$minute = '00';
				$second ='00';
			
              //time_end
				$timedata = mktime ( $hour, $minute, $second );
				$time_end = date('H:i:s',$timedata);
				echo ' time_end ';
				echo $time_end;
				print '<br />';

              //time_start
				$hour = '13';
				$minute = '00';
				$second ='00';
			
              //time_end
				$timedata = mktime ( $hour, $minute, $second );
				$time_end = date('H:i:s',$timedata);
				echo ' time_end ';
				echo $time_end;
				print '<br />';

              //time_start
				$hour = '14';
				$minute = '00';
				$second ='00';
				
              //time_end
				$timedata = mktime ( $hour, $minute, $second );
				$time_end = date('H:i:s',$timedata);
				echo ' time_end ';
				echo $time_end;
				print '<br />';

              //time_start
				$hour = '15';
				$minute = '00';
				$second ='00';
				
              //time_end
				$timedata = mktime ( $hour, $minute, $second );
				$time_end = date('H:i:s',$timedata);
				echo ' time_end ';
				echo $time_end;
				print '<br />';

              //time_start
				$hour = '16';
				$minute = '00';
				$second ='00';
				
              //time_end
				$timedata = mktime ( $hour, $minute, $second );
				$time_end = date('H:i:s',$timedata);
				echo ' time_end ';
				echo $time_end;
				print '<br />';

              //time_start
				$hour = '17';
				$minute = '00';
				$second ='00';
				
              //time_end
				$timedata = mktime ( $hour, $minute, $second );
				$time_end = date('H:i:s',$timedata);
				echo ' time_end ';
				echo $time_end;
				print '<br />';

              //time_start
				$hour = '18';
				$minute = '00';
				$second ='00';
				
              //time_end
				$timedata = mktime ( $hour, $minute, $second );
				$time_end = date('H:i:s',$timedata);
				echo ' time_end ';
				echo $time_end;
				print '<br />';

              //time_start
				$hour = '19';
				$minute = '00';
				$second ='00';
				
              //time_end
				$timedata = mktime ( $hour, $minute, $second );
				$time_end = date('H:i:s',$timedata);
				echo ' time_end ';
				echo $time_end;
				print '<br />';





				$sql='SELECT * FROM acount_data WHERE
					(DATE(date) BETWEEN :date_start AND :date_end)
					AND (TIME(time) BETWEEN :time_start AND :time_end)';
				$prepare=$db->prepare($sql);
				$prepare->bindValue(':date_start', $date_start, PDO::PARAM_STR);
				$prepare->bindValue(':date_end', $date_end, PDO::PARAM_STR);
				$prepare->bindValue(':time_start', $time_start, PDO::PARAM_STR);
				$prepare->bindValue(':time_end', $time_end, PDO::PARAM_STR);
				$prepare->execute();
				$count = $prepare -> rowCount();
				print '検索結果';
				echo $count.'件';
				print '<br />';

			}
			$sql='SELECT * FROM acount_data';
			$prepare=$db->prepare($sql);
			$prepare->execute();

			$db=null;


		
			

				print '商品一覧<br /><br />';
			print '<br />DBの中身<br />';

			while(true)
			{
				$rec=$prepare->fetch(PDO::FETCH_ASSOC);
				if($rec==false)
				{
					break;
				}
				print h($rec['date']);
				print h($rec['time']);
				print '<br />';
			}
		}
		catch (Exception $e)
		{
			echo 'エラーが発生しました。内容: ' . h($e->getMessage());
			 exit();
		}
	?>


	   
		<a href="index.php">戻る</a>
	</body>
</html>
