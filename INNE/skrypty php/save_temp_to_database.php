<?php
$servername = "localhost";
$username = "esp8266_T";
$password = "esp8266_T#";
$dbname = "cakePHP";
$now = new DateTime();

$sensor_id = $_GET['sensor_id'];
$temp = $_GET['temp'];

if (!$sensor_id || !$temp)
{
	die('Brak danych w komunikacie');
}


$conn = mysql_connect($servername,$username,$password);
if (!$conn)
{
    die('Blad polaczenia z baza danych: ' . mysql_error());
}
$con_result = mysql_select_db($dbname, $conn);
if(!$con_result)
{
	die('Blad polaczenia z konkretna baza danych: ' . mysql_error());	
}

	$select = "SELECT COUNT(*) FROM sensors WHERE id= \"$sensor_id\" ";
	$result = mysql_query($select);
	$count = mysql_result($result, 0) ;
	if($count == 0){
		die('Bledne dane');
	}
	
	$date = $now->format("Y-m-d H:i:s");
	
	$sql = "INSERT INTO `temps`(`sensor_id`, `temp`, `created`) VALUES (\"$sensor_id\", \"$temp\", \"$date\")";
	
	$result = mysql_query($sql);
	if (!$result) {
		die('Bledne zapytanie: ' . mysql_error());
	}
	
	echo "Dane zostały zapisane";
	mysql_close($conn);
?>