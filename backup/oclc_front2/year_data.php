<?php
//Include the code
include('./includes/aws_db.php');

//Define some data

$query ="SELECT year, COUNT(*) c FROM articles GROUP BY year HAVING c > -1 and year > -1 ORDER BY `year` DESC;";
$result = mysql_query($query);
$data=[];
echo "<table>";
         while($info = mysql_fetch_assoc( $result )) 
        { 
        	//var_dump($info);
        	if ($info != ''){
        	echo "<tr><td>";
        	echo $info['year']."</td><td>";
        	echo $info['c']."</td><tr>";
        }
        }
echo "</table>";

//var_dump($data);




?>