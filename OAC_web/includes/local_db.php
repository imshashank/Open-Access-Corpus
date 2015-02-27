<?php 
//require_once = 'login.php';

$db_database1 = 'users';
$db_hostname1 = 'localhost';
$db_username1 = 'users';
$db_password1 = 'have_fun';


$db_server1 = mysql_connect($db_hostname1, $db_username1, $db_password1);
if(!$db_server1) die("Unable to connect to MYSQL: ". mysql_error());

mysql_select_db($db_database1,$db_server1 ) or die("Unable to connect to database: " . mysql_error());

?>
