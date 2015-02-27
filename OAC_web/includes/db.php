<?php 
//require_once = 'login.php';

$db_database = 'corpus';
$db_hostname = 'localhost:3306';
$db_username = 'corpus';
$db_password = 'have_fun';



$db_database = 'corpus';
$db_hostname = 'oclc.cog483jzmtjb.us-east-1.rds.amazonaws.com:3306';
$db_username = 'corpus';
$db_password = 'have_fun';


$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if(!$db_server) die("Unable to connect to MYSQL: ". mysql_error());

mysql_select_db($db_database, $db_server)
    or die("Unable to connect to database: " . mysql_error());



    /*
$db_database = 'corpus';
$db_hostname = '127.0.0.1:3306';
$db_username = 'corpus';
$db_password = 'PASS_word';


$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if(!$db_server) die("Unable to connect to MYSQL: ". mysql_error());

mysql_select_db($db_database)
    or die("Unable to connect to database: " . mysql_error());
*/

?>
