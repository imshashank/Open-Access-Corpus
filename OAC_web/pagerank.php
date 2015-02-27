<?php 

include('./includes/db.php');
include('./article_class.php');



//get all authors of this article, find all articles on each author and add to article


$obj = new Article_db;

$links = [];

$links[]='';
$links[]='';
$links[]='';

$query = "DELETE from pagerank";
$article_result = mysql_query($query);


$query = "SELECT article_id FROM articles ORDER by article_id ";

$article_result = mysql_query($query);
            while($row = mysql_fetch_array($article_result))
            {
            $article_id = $row['article_id'];
          

$temp=[];


$author_ids = $obj->get_author_ids($article_id);

foreach ($author_ids as $value){

$articles = $obj->get_articles_by_author($value);

foreach($articles as $x){
        $flag = true;

         foreach ($temp as $value){
                if($value == $x ){
                        $flag = false;
                        break;
                }
        }
        if($flag != false && $x != $article_id){
                 $temp[] = intval($x);
               }
        }
}

$links[] = $temp;

}


echo count($links);



$pageranks = calculatePageRank($links);

$c=0;
foreach ($pageranks as $value){

$query ="INSERT into pagerank (`article_id`,`pagerank`) VALUES('$c', '$value');";
$article_result = mysql_query($query);
        $c++;
}


function calculatePageRank($linkGraph, $dampingFactor = 0.15) {
        $pageRank = array();
        $tempRank = array();
        $nodeCount = count($linkGraph); 

        // initialise the PR as 1/n
        foreach($linkGraph as $node => $outbound) {
                $pageRank[$node] = 1/$nodeCount;
                $tempRank[$node] = 0;
        }

        $change = 1;
        $i = 0;
        while($change > 0.00005 && $i < 100) {
                $change = 0;
                $i++;

                // distribute the PR of each page
                foreach($linkGraph as $node => $outbound) {
                        $outboundCount = count($outbound);
                        var_dump($outbound);
                        foreach($outbound as $link) { 
                                $tempRank[$link] += $pageRank[$node] / $outboundCount;
                        }
                }
                
                $total = 0;
                // calculate the new PR using the damping factor
                foreach($linkGraph as $node => $outbound) {
                        $tempRank[$node]  = ($dampingFactor / $nodeCount)
                                                + (1-$dampingFactor) * $tempRank[$node];
                        $change += abs($pageRank[$node] - $tempRank[$node]);
                        $pageRank[$node] = $tempRank[$node];
                        $tempRank[$node] = 0;
                        $total += $pageRank[$node];
                }

                // Normalise the page ranks so it's all a proportion 0-1
                foreach($pageRank as $node => $score) {
                        $pageRank[$node] /= $total;
                }
        }
        
        return $pageRank;
}
?>