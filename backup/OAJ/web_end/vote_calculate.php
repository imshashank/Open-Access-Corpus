<?php

include('./vote_class.php');


$author_select= $_POST['author_select'];
$author_count= $_POST['author_count'];
$author_votes= $_POST['author_votes'];
$tag_select= $_POST['tag_select'];
$tag_count= $_POST['tag_count'];
$tag_votes= $_POST['tag_votes'];
$publish_select= $_POST['publish_select'];
$publish_votes= $_POST['publish_votes'];
$url_select= $_POST['url_select'];
$url_votes= $_POST['url_votes'];
$doi_select= $_POST['doi_select'];
$doi_votes= $_POST['doi_votes'];
$abstract_select= $_POST['abstract_select'];
$abstract_votes= $_POST['abstract_votes'];


$vote_obj = new Vote_class();

//get articles and calc votes
$obj = new Article_db();

$articles = $obj->get_articles('0','900');

echo "Please wait while we calculate votes, you will be redirected shortly";
foreach ($articles as $value){

	$article_id= $value['article_id'];
	$vote = 0;
	//var_dump($value);
	if ($vote_obj->author_count($value['article_id'], $author_select, $author_count)){
	//	echo $author_votes ." author added </br>";
		$vote += $author_votes;
	}

	if ($vote_obj->tag_count($value['article_id'], $tag_select, $tag_count)){
	//	echo $tag_votes ." tags added </br>";
		$vote += $tag_votes;
	}
	

	if ($value['is_published']){
		$vote += $publish_votes;
	}

	if ($value['url'] != 'None' && $value['url'] != ''){
		$vote += $url_votes;
	}

	if ($value['doi'] != 'None' && $value['doi'] != '' ){
		//echo "$article_id has doi -> ".$value['doi'] ."</br>";
		$vote += $doi_votes;
	}

	if ($value['abstract'] != ''){
		$vote += $abstract_votes;
	}
	
	//echo "final vote:" . $vote ." for artilce_id = $article_id</br>";
	$vote_obj->set_vote($article_id,$vote);

	//var_dump($vote_obj->set_vote($article_id,$vote));
}
db.commit();

header( 'Location: index.php#ajax/data.php' ) ;

?>