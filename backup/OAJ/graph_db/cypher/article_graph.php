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


$query = "SELECT * from articles  ;"; 
echo $query;
$rs = mysql_query($query);

$articles=array();

while ($row = mysql_fetch_array($rs)){
  //echo $row[0];	
	$articles[$row[1]]['article_id']=$row['article_id'];
	$articles[$row[1]]['alternate_id']=$row['alternate_id'];
	$articles[$row[1]]['title']=$row['title'];
	$articles[$row[1]]['abstract']=$row['abstract'];
	$articles[$row[1]]['url']=$row['url'];
	$articles[$row[1]]['doi']=$row['doi'];
	$articles[$row[1]]['language']=$row['language'];
	$articles[$row[1]]['year']=$row['year'];
	$articles[$row[1]]['page']=$row['page'];
	$articles[$row[1]]['is_published']=$row['is_published'];
	#$publishers[$row[1]]['alts']=$row['alts'];
}



require('vendor/autoload.php');

$config = array(
    'default' => array(
        'host' => 'http://54.172.23.136:7474',
        'driver' => \EndyJasmi\Neo4j\Connection::CURL
    ),
);



$neo4j = new \EndyJasmi\Neo4j($config);
/*
$neo4j->connection('default')
    ->statement('CREATE CONSTRAINT ON (article:Article) ASSERT article.id IS UNIQUE;')
    ->execute();
$neo4j->statement('CREATE CONSTRAINT ON (article:Article) ASSERT article.url IS UNIQUE;');
$neo4j->statement('CREATE CONSTRAINT ON (article:Article) ASSERT article.title IS UNIQUE;')
    ->execute();

*/
// is the same with

foreach ($articles as $key ){
try{
	$key['title'] = str_replace('\'', '', $key['title']);
	$key['title'] = addslashes(str_replace('"', '', $key['title']));

	$key['abstract'] = str_replace('\'', '', $key['abstract']);
	$key['abstract'] = addslashes(str_replace('"', '', $key['abstract']));
	

	echo $value;
	 $query ='CREATE (n:Article { id:"'.$key['article_id'].'",title:"'.$key['title'].'" ,alternate_id:"'.$key['alternate_id'].'",
	 	abstract:"'.$key['abstract'].'",url:"'.$key['url'].'",
	 doi:"'.$key['doi'].'",language:"English",year:"'.$key['year'].'",page:"'.$key['page'].'",is_published:"'.$key['is_published'].'" })';
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






?>