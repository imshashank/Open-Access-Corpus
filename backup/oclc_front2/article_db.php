<?php 
include('./includes/db.php');
class Article_db { 
    
    function get_authors($article_id){
	$q = "select author_id from author_article where article_id = $article_id;";
	//echo $q;
	$auth_result = mysql_query($q);
	$auth_ids = [];
	while($row = mysql_fetch_array($auth_result))
	{
    $auth_ids[] = $row['author_id'];
	}
 	
	return $auth_ids;
    }

    function get_author_names($author_id) { 
    	$auth_names = [];
    	if (is_array($author_id)){
    		foreach ($author_id as $value){
			$q = "select author_name from authors where author_id = $value;";
			//echo $q;
			$auth_result = mysql_query($q);
			while($row = mysql_fetch_array($auth_result))
			{
			$auth_names[] = $row['author_name'];
			}
    		}
    
    	}
    	else {
    		$q = "select author_name from authors where author_id = $author_id;";
    		$auth_result = mysql_query($q);
			while($row = mysql_fetch_array($auth_result))
			{
			$auth_names = $row['author_name'];
			}
    	}
    	//var_dump($auth_names);
    	return $auth_names;
    } 

} 

?> 