<div id="content" class="col-xs-12 col-sm-10">

<?php

 if (empty($_GET)) {
    echo "<h2>Please check the query</h2>";
 }

 if (!empty($_GET)) {

  echo "<h2>Searching for: ".($_GET["query"]). "</h2>";

  $search_query = $_GET["query"]; }

if (!empty($_GET)) {
require 'search/vendor/autoload.php';
$params = array();
$params['hosts'] = array (
//    '54.243.49.73:9200'        // IP + Port
  'open-academia.org:9200'
);

$client = new Elasticsearch\Client($params);


$searchParams['index'] = 'corpus_index';
    $searchParams['type']  = 'article';
    $searchParams['body']['from'] = 0;
    $searchParams['body']['size'] = 15;

    $searchParams['body']['query']['match']['_all'] = $search_query;

    $queryResponse = $client->search($searchParams);

    $result = $queryResponse['hits']['hits'];
   # echo count($result);
    echo '<div class="row">
    <div class="col-xs-10">';
    #   echo ' <p class="small">About 3,870,000,000 results (0.28 seconds)</p>';
    foreach ($result as $article){

        echo '<div class="one-result">';
        echo '<a class="large" href="http://open-academia.org/singles.php?id='.$article['_source']['article_id'].'">'.$article['_source']['title'].'</a>';

        echo '<p class="txt-primary">http://open-academia.org/singles.php?id='.$article['_source']['article_id'].'</p>';
        $text = substr($article['_source']['abstract'],0,220).'...';
        echo  '<p>'.$text.'</p>';
        echo '</div>';
    }
    #var_dump( $queryResponse['hits']['hits'][0]['_source']); // Outputs 'abc'
    #echo ' <ul class="pagination"><li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#">Next → </a></li></ul>';
    echo '</div>

</div>';
}


?>
</div>
