<?php

$host= 'http://localhost/corpus/oclc_project/web_end/get_vote.php?article_id=1';


$variablee = fopen($host, "rb");  
echo stream_get_contents($variablee); 


#require_once("models/config.php");
#if (!securePage($_SERVER['PHP_SELF'])){die();}
#require_once("models/header.php");

/*
include('./includes/aws_db.php');
include('article_class.php');

include('header.php');
include('navbar.php');
include('sidebar.php');
#include('content.php');
include('footer.php');
*/
?>
