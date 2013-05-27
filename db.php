<?php

//DO NOT EDIT THE GLOBALS

global $table_name;
global $mysqli;
global $param1;
global $param2;
global $param3;
global $param4;

//SET UP YOUR DATABASE CONNECTION

$host = "";
$user = "";
$pass = "";
$db_name = "";
$table_name = "";

//DEFINE UP TO FOUR PARAMTERS THAT YOU WOULD LIKE TO TRACK. LEAVE THE ONES YOU DON'T USE AS ""

$param1 = "";
$param2 = "";
$param3 = "";
$param4 = "";

//DO NOT EDIT BELOW THIS LINE

$mysqli = mysqli_connect($host, $user, $pass, $db_name);
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

?>