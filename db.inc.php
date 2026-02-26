<?php
$hostname= "localhost";
$username= "bankprog";
$password= "bankprog123";

$dbname = "bankprog";

$con = mysqli_connect($hostname,$username,$password,$dbname);

if(!$con)
{
	die ("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>