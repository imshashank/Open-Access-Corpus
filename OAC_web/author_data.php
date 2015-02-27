<?php
//Include the code
require_once './graph/phplot.php';
include('./includes/aws_db.php');

//Define the object
$plot = new PHPlot();

//Define some data

$query ="SELECT author_id, COUNT(*) c FROM author_article GROUP BY author_id HAVING c > 0 and c < 10 ORDER BY `c` DESC ;";
$result = mysql_query($query);
$data=[];
         while($info = mysql_fetch_array( $result )) 
        { 
        	//$random = array($info['0'], $info['1']);
        	$random =  $info['1'];
        	$data[]= $random;
        }
//var_dump($data);
        $out = (data($data));
//var_dump($out);
      
$plot->SetDataValues($out);

//Turn off X axis ticks and labels because they get in the way:
$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');

//Draw it
$plot->DrawGraph();



function data($data){
	//var_dump($data);
	$i ='10';
	$max = $data['0'];
//	echo $max ."max";
	$min = end($data);
//	echo $min ."min";
	$diff = $max - $min;
	$interval = ($diff + $i - ($diff % $i))/$i;
//	echo $interval;
	$final= [];
		$n =0;

	while ($n < $i){
		$final[$n]='0';
		$n++;
	}

	$n =0;
	while($n < $i){
		foreach ($data as $value){
			if(($value <= ($n+1)*$interval) && ($value >= $n* $interval)){
				$final[$n] ++;
			}
		}
		$n++;
	}
	$result = [];
	$n=0;
	while ($n < $i){
		$term = strval(($n)* $interval) ."to ". strval(($n+1)* $interval) ;
		$random = array($term,$final[$n]);
		$result[] = $random;
		$n++;
	}
	return($result);
	
}





?>