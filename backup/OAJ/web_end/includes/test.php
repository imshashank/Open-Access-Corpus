<?php

include('./includes/db.php');

$query = "SELECT * FROM articles";
$result = mysql_query($query);

if(!$result) die ("Could not query: " . mysql_error());
$rows = mysql_num_rows($result);

for($j = 0; $j < $rows; ++$j)
{
    echo 'Author: ' . mysql_result($result, $j, 'author') . '</br>';
    echo 'Title: ' . mysql_result($result, $j, 'title'). '</br>';
    echo 'ISBN: '.mysql_result($result, $j, 'isbn').'</br>';
}
?>