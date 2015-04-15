<?php
require 'vendor/autoload.php';


if(isset($_GET['id'])){
$id = $_GET['id'];
//$id =1;

$params = array();
$params['hosts'] = array (
    'open-academia.org:9200'

);




$client = new Elasticsearch\Client($params);

$indexParams['index']  = 'corpus_index';    //index


$param = array();



$query['index'] = 'corpus_index';
$query['type'] = 'article';
$query['id'] = $id;
$query['min_term_freq'] = 1;
//$query['max_query_terms']=1;
$query['mlt_fields'] = 'title';

$ret = $client->mlt($query);
//print_r($ret['hits']['hits'][0]);
$articles = $ret['hits']['hits'];
#print_r($articles[1]);
echo "<ul>";
for ($i=0;$i<count($articles);$i++){


$article = $articles[$i]['_source'];
echo "<li><span>";


echo "<h4><a href='http://console.open-academia.org/singles.php?id=".$article['article_id']."'>".$article['title']."</a></h4>";
//echo $article['article_id']."\n";

echo "</li>";
//    $x =$article["_source"];
 //  print_r($x);

}

echo "</ul>";
//print_r($ret);


}
//$ret = $client->index($param);


/*
$json = '{
    "query" : {
        "match" : {
            "tags" : "Differential geometry"
        }
    }
}';

$param['index'] = 'corpus_index';
$param['type']  = 'article';
$param['body']  = $json;

$results = $client->search($param);
var_dump($results);
*/
/*
$searchParams['index'] = 'corpus_index';
    $searchParams['type']  = 'article';
    $searchParams['body']['query']['match']['_all'] = 'cloud';
    $queryResponse = $client->search($searchParams);

    var_dump( $queryResponse['hits']['hits'][0]['_source']); // Outputs 'abc'

*/
function get_url($url){
	        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);
        return $output;

}
?>
