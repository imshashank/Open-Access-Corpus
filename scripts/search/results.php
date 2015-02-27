<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Skeleton: Beautiful Boilerplate for Responsive, Mobile-Friendly Development</title>
	<meta name="description" content="Skeleton: Beautiful Boilerplate for Responsive, Mobile-Friendly Development">
	<meta name="author" content="Dave Gamache">
	<meta property="twitter:account_id" content="17346623" />
	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="stylesheets/base.css">
	<link rel="stylesheet" href="stylesheets/skeleton.css">
	<link rel="stylesheet" href="stylesheets/layout.css">
	<link rel="stylesheet" href="documentation-assets/docs.css">

	<!-- Favicon
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" sizes="57x57" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

</head>
<body>

<?php
if (empty($_GET)) { 
    echo "<h2>Please check the query</h2>";
 }

 if (!empty($_GET)) { 

  #echo "<h2>Searching for: ".($_GET["query"]). "</h2>";

  $search_query = $_GET["query"]; }

  ?>
			<div class="container">
				<div class="three columns sidebar">
					<nav>
						<h3 id="logo"><a href="http://search.open-academia.org">Open Academia</a></h3>
						<p>The Open Access Academia Corpus is a project to make an online database of all freely available research journals and articles.

						</p>
						<p>The project is under active development  and any feedback is appreciated.</p>
					</nav>
					&nbsp;
				</div>

				<div class="twelve columns offset-by-one content">
					<form action='results.php' method='get'>
    <div class="row">

    <div class="eight columns omega"><input style="width: 90%;height: 21px;" type="text" id="query" name="query" value="<?php echo $search_query; ?>"></div>
    
    <div class="four columns alpha"><button style = "width: 113px;" type="submit">Search</button></div>

  </form>
</div>

					<header>
						<h3>Search Results for <?php echo $search_query; ?></h3>
					</header>
					<div class="doc-section" id="whatAndWhy">
						<div id="content" class="col-xs-12 col-sm-10">

<?php

 

if (!empty($_GET)) { 

require 'vendor/autoload.php';
$params = array();
$params['hosts'] = array (
    'open-academia.org:9200'        // IP + Port
  
);

$client = new Elasticsearch\Client($params);


    $searchParams['index'] = 'corpus_index';
    $searchParams['type']  = 'article';
    $searchParams['body']['from'] = 0;
    $searchParams['body']['size'] = 20;

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
        $text = substr($article['_source']['abstract'],0,180).'...';
        echo  '<p style="font-size: 16px;">'.$text.'</p>';
        echo '</div>';
    }
    #var_dump( $queryResponse['hits']['hits'][0]['_source']); // Outputs 'abc'
    #echo ' <ul class="pagination"><li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#">Next → </a></li></ul>';
    echo '</div>
   
</div>';
}


?>
</div>
					</div>
				</div>
			</div>
</body>
</html>