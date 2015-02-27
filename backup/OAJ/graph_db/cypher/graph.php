<?php

$host = "oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com"; 
$user = "corpus"; 
$pass = "OCLC_123"; 

$r = mysql_connect($host, $user, $pass);


if (!$r) {
    echo "Could not connect to server\n";
    trigger_error(mysql_error(), E_USER_ERROR);
} else {
    echo "Connection established\n"; 
}

$r2 = mysql_select_db('corpus');


$query = "SELECT * from publisher ;"; 
echo $query;
$rs = mysql_query($query);

var_dump($rs);
$authors=array();

while ($row = mysql_fetch_array($rs)){
  //echo $row[0];	
	var_dump($row);
	$authors[$row[0]]=$row[1];
}



$query = "SELECT * from publisher_article ;"; 
echo $query;
$rs = mysql_query($query);

$publishers=array();

while ($row = mysql_fetch_array($rs)){
  //echo $row[0];	
	$publishers[$row[1]]=$row[2];
}



require('vendor/autoload.php');

$config = array(
    'default' => array(
        'host' => 'http://54.172.23.136:7474',
        'driver' => \EndyJasmi\Neo4j\Connection::CURL
    ),
);



$neo4j = new \EndyJasmi\Neo4j($config);

$neo4j->connection('default')
    ->statement('CREATE CONSTRAINT ON (publisher:Publisher) ASSERT publisher.id IS UNIQUE;')
    ->execute();
$neo4j->statement('CREATE CONSTRAINT ON (publisher:Publisher) ASSERT publisher.name IS UNIQUE;')
    ->execute();


// is the same with

foreach ($articles as $key => $value){
try{
	$value = str_replace('\'', '', $value);
	$value = str_replace('"', '', $value);
	echo $value;
	 $query ='CREATE (n:Journal { id:"'.$key.'",name:"'.$value.'" })';
	 echo $query . "\n";
	 $neo4j->statement($query);
     $neo4j->execute();
}
catch (Exception $e){
	echo $e;
}


/*
foreach ($authors as $key => $value){
try{
	$value = str_replace('\'', '', $value);
	$value = str_replace('"', '', $value);

	 $query ='CREATE (n:Publisher { id:"'.$key.'",name:"'.$value.'" })';
	 $publisher_id = $publishers[$key];

	$q ='MATCH (article:Article)
	WHERE article.id = ".'$key'."

	MATCH (publisher:Publisher)
	WHERE publisher.name = "'.$publisher_id.'"
	CREATE (article)-[:PUBLISHED_BY]->(publisher)'

	 echo $q . "\n";

	 $neo4j->statement($query);
	 $neo4j->statement($q);
     $neo4j->execute();
}
catch (Exception $e){
	echo $e;
}





/*
foreach ($authors as $key => $value){
try{
	$value = str_replace('\'', '', $value);
	$value = str_replace('"', '', $value);
	echo $value;
	 $query ='CREATE (n:Journal { id:"'.$key.'",name:"'.$value.'" })';
	 echo $query . "\n";
	 $neo4j->statement($query);
     $neo4j->execute();
}
catch (Exception $e){
	echo $e;
}

*/
#echo $key;
#echo $value;

}





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



?>