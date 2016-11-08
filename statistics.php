<?php

	require_once("connect.php");

	$db_connect = new mysqli($host, $db_user, $db_password, $db_name);

  $resultRed1 = $db_connect->query(
		sprintf("SELECT Count(*) as StatRed1 FROM `question1` WHERE Red = 'True'",
		mysqli_real_escape_string($db_connect,$db_user)));
  $resultBlue1 = $db_connect->query(
		sprintf("SELECT Count(*) as StatBlue1 FROM `question1` WHERE Blue = 'True'",
		mysqli_real_escape_string($db_connect,$db_user)));
  $resultGreen1 = $db_connect->query(
		sprintf("SELECT Count(*) as StatGreen1 FROM `question1` WHERE Green = 'True'",
		mysqli_real_escape_string($db_connect,$db_user)));
  $resultYellow1 = $db_connect->query(
		sprintf("SELECT Count(*) as StatYellow1 FROM `question1` WHERE Yellow = 'True'",
		mysqli_real_escape_string($db_connect,$db_user)));
  $resultWhite1 = $db_connect->query(
		sprintf("SELECT Count(*) as StatWhite1 FROM `question1` WHERE White = 'True'",
		mysqli_real_escape_string($db_connect,$db_user)));
  $resultBlack1 = $db_connect->query(
		sprintf("SELECT Count(*) as StatBlack1 FROM `question1` WHERE Black = 'True'",
		mysqli_real_escape_string($db_connect,$db_user)));

	$rowRed1 = $resultRed1->fetch_assoc();
  $rowBlue1 = $resultBlue1->fetch_assoc();
  $rowGreen1 = $resultGreen1->fetch_assoc();
  $rowYellow1 = $resultYellow1->fetch_assoc();
  $rowWhite1 = $resultWhite1->fetch_assoc();
  $rowBlack1 = $resultBlack1->fetch_assoc();

$stat["StatRed1"] = $rowRed1["StatRed1"];
$stat["StatBlue1"] = $rowBlue1["StatBlue1"];
$stat["StatGreen1"] = $rowGreen1["StatGreen1"];
$stat["StatYellow1"] = $rowYellow1["StatYellow1"];
$stat["StatWhite1"] = $rowWhite1["StatWhite1"];
$stat["StatBlack1"] = $rowBlack1["StatBlack1"];




  $response= json_encode($stat);
  echo($response);
?>
