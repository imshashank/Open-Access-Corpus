<?php


#include('article_class.php');
#include('includes/aws_db.php');

class Search_class {


public function get_articles_search_title($token){

$token = str_replace('%20', '%', $token);
$query ="Select article_id from articles where title like '%".$token."%' LIMIT 5 ;";
$result = mysql_query($query);

    if(!$result) die ("Could not query: " . mysql_error());
    $out = [];
    while($article_info = mysql_fetch_array( $result ))
        {
                $obj = new Article_db();
                $out[] =$obj->get_article_by_id($article_info['article_id']);

        }
        return $out;
        }

public function get_alternate_id_search_title($token){

$token = str_replace('%20', '%', $token);
$query ="Select alternate_id from articles where title like '%".$token."%' LIMIT 5 ;";
$result = mysql_query($query);

    if(!$result) die ("Could not query: " . mysql_error());
    $out = [];
    while($article_info = mysql_fetch_array( $result ))
        {
                $obj = new Article_db();
                $out[] =($article_info['alternate_id']);

        }
        return $out;
        }
public function get_articles_search_tags($token){

        $token = str_replace('%20', '%', $token);
        $query ="Select * from tags where tags_name like '%".$token."%' LIMIT 1 ;";
    //echo $query;
        $result = mysql_query($query);

    if(!$result) die ("Could not query: " . mysql_error());
    $out = [];

    while($article_info = mysql_fetch_array( $result ))
        {
                $obj = new Article_db();
                $article_ids = $obj->get_article_id_by_tags_id($article_info['0']);
                foreach ($article_ids as $value){
                $out[] = $obj->get_article_by_id($value);
                }

        }
        return $out;
        }

public function get_alternate_id_search_tags($token){

    $token = str_replace('%20', '%', $token);
        $query ="Select tags_id from tags where tags_name like '%".$token."%' LIMIT 1 ;";
        $result = mysql_query($query);

    if(!$result) die ("Could not query: " . mysql_error());
    $out = [];
    while($article_info = mysql_fetch_array( $result ))
        {

                $obj = new Article_db();
                $article_ids = $obj->get_article_id_by_tags_id($article_info['0']);
                foreach ($article_ids as $value){
                $article = $obj->get_article_by_id($value);
                $out[] = $article['alternate_id'];
                }

        }
        return $out;
        }

}
/*
$obj = new Search_class();
var_dump($obj->get_alternate_id_search_tags('science'));
*/
?>
