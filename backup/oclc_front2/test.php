<?php

include('./includes/aws_db.php');
//include('article_class.php');
include('./vote_class.php');


/*
$obj = new Vote_class();

var_dump($obj->doi_valid ('39'));
*/


//var_dump($obj->author_count('88','1','4'));


$obj = new Article_db;
$best_authors = ($obj->get_articles_by_author('830796'));

var_dump($best_authors);
/*
foreach ($best_authors as $value){
	$name = $obj-> get_article_by_id($value);
	var_dump($name);

}



/*
$articles = $obj->get_articles(0,10);

foreach ($articles as $value){
	var_dump($value);
	echo $value['title'];
	break;
}

var_dump($obj->get_tags('67'));
//$auth_names = $obj->get_authors($article_id);

//$journal_name = $obj->get_jo
*/

?>