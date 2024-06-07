<?php 
// offic ip 
// $serverName = "192.168.13.155";   
// home ip 
// $serverName = "192.168.0.137";
// mobile ip 
// $serverName = "192.168.127.115";
// d ip 
// $serverName = "192.168.1.7";
// aayush ip 
$serverName = "192.168.57.115";

$connectionInfo = array("Database"=>"RMS","UID"=>"sa","PWD"=>"12345","CharacterSet" => "UTF-8");
$Con = sqlsrv_connect($serverName,$connectionInfo);

if($Con) {
		// echo "connection established.<br />";
		
}else{
	echo "connection could not be established.<br />";
	die(print_r(sqlsrv_errors(), true));
	
}
?>