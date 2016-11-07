<?php
	
	require_once("connect.php");
       
	$db_connect = new mysqli($host, $db_user, $db_password, $db_name);
	$UserName = $_POST['user'];
	
	//Does user already exist in db?
	$result = $db_connect->query(
		sprintf("SELECT * FROM users WHERE user='$UserName'",
		mysqli_real_escape_string($db_connect,$db_user)));
	$row = $result->fetch_assoc();
	$user_id =$row['id']; 
	
	$number_of_users = $result->num_rows;
	if($number_of_users>0)
	{
		$username =$row['user'];
		
		$value = "1";//$_POST['val'];
		echo "User already exists!<br />";
	}
	else
	{
		
		$db_connect->query("INSERT INTO `users`(`user`) VALUES ('$UserName')");
		
		
		$result = $db_connect->query(
		sprintf("SELECT * FROM users WHERE user='$UserName'",
		mysqli_real_escape_string($db_connect,$db_user)));
		$row = $result->fetch_assoc();
		$user_id =$row['id']; 
		
		$queryQuestion1 = sprintf("INSERT INTO `question1`(`user_id`, `Red`, `Blue`, `Green`, `Yellow`, `White`, `Black`) VALUES (%s,'%s','%s','%s','%s','%s','%s')"
		,$user_id,$_POST['red'],$_POST['blue'],$_POST['green'],$_POST['yellow'],$_POST['white'],$_POST['black']);
		
		$queryQuestion2 = sprintf("INSERT INTO `question2`(`user_id`, `answer1`) VALUES (%s,%s)"
		,$user_id,$_POST['radio']);
		echo($queryQuestion2);
		
		$db_connect->query($queryQuestion1);
		$db_connect->query($queryQuestion2);
		$db_connect->close();
	}
?>