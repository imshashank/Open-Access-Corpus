<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

include("models/config.php");
require_once("includes/local_db.php");


if (!securePage($_SERVER['PHP_SELF'])){die();}

if(!isUserLoggedIn()) { header("Location: login.php"); die(); }

$user_id=  $loggedInUser->user_id;

echo $user_id;
$q = "SELECT * from user_votes where user_id = $user_id";
echo $q;

$result = mysql_query($q);
var_dump($result);

if(!$result) die ("Please check the request and try again" );
    $out = [];
    $rows = mysql_num_rows($result);
    while($info = mysql_fetch_array( $result )) 
        {
        var_dump($info); 
        }

?>