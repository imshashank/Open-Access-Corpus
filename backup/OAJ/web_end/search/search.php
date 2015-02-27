<?php
require 'vendor/autoload.php';


$params = array();
$params['hosts'] = array (
    '54.243.49.73:9200'        // IP + Port

);

$client = new Elasticsearch\Client($params);

#$indexParams['index']  = 'corpus_index';    //index

#$client->indices()->create($indexParams);

$param = array();

$start= 76043;

for ($m = 0; $m < 10000; $m++){


$start = $start+100;

$data = json_decode(get_url("http://open-academia.org/rest/get_articles/".$start."/100"));


foreach ($data as $article){
        var_dump($article);

$param['body']  = $article;
$param['index'] = 'corpus_index';
$param['type']  = 'article';
#$param['id']    = 'my_id';

// Document will be indexed to my_index/my_type/my_id

$ret = $client->index($param);

}

}
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
