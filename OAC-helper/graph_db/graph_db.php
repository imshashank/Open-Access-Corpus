 <?php
    require('vendor/autoload.php');


function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

use Everyman\Neo4j\Client,
	Everyman\Neo4j\Index\NodeIndex,
	Everyman\Neo4j\Relationship,
	Everyman\Neo4j\Node;

    $client = new Everyman\Neo4j\Client('localhost', 7474);
    print_r($client->getServerInfo());

$json = file_get_contents_curl('http://open-academia.org/rest/get_article_by_id/1');

$json = json_decode($json, true);
var_dump($json);
#$tags = new NodeIndex($client, 'tags');
#$article_index = new NodeIndex($client, 'article');

$article_attr = $client->makeNode();
$article_attr->setProperty('article_id', $json['article_id']);
$article_attr->setProperty('alternate_id', $json['alternate_id']);
$article_attr->setProperty('title', $json['title']);
$article_attr->setProperty('abstract', $json['abstract']);
$article_attr->setProperty('url', $json['url']);
$article_attr->setProperty('language', $json['language']);
$article_attr->setProperty('url', $json['url']);
$article_attr->save();



#foreach ($article['tags'] as $tag){
#$tag_obj = $tags->findOne('tag_name', $tag);

#$article_tags->
#}

/*
article_id
alternate_id
title
abstract
url
language
page

year
authors
journal
tags
publisher

*/
?>
