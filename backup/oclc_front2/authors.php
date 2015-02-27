<?php

include('./includes/aws_db.php');
include('./article_class.php');

if (isset($_GET["author_id"])){
	$author_id = $_GET["author_id"];
}

$obj = new Article_db;

$name = $obj->get_author_names($author_id);
$article = $obj->get_article_by_author_id($author_id);



//var_dump($article);

?>

<div id="content" class="col-xs-12 col-sm-10">
<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">

	<?php echo "<h2>".$name."</h2" ; ?>
					<thead>
						<tr>
							
							<th>Article Id</th>
							<th>Title</th>
							<!--
							<th>doi</th>
							<th>Authors</th>
							<th>Journal</th>
							<th>Tags</th>
							<th>Link</th>
						-->
						</tr>
					</thead>
					<tbody>
	<?php
	//var_dump($article);

	foreach ($article as $random =>$sub){
		foreach ($sub as $key => $value) {
			# code...
	

	//var_dump($value);
	echo "<tr>";
	$article_id = $value['article_id'];
//var_dump($value);
	echo "<td>".$article_id."</td>";
	echo "<td><a href ='".$host."singles.php?id=".$article_id."'>".$value['title']."</a></td>";

	/*
	echo "<td>".$value['title']."</td>";

	echo "<td>".$value['doi']."</td>";

	$auth_names = $obj->get_authors($article_id);
	foreach ($value['authors'] as $x){

	}
	echo "<td><ul>";
	{echo "<li> $x </li>";};
	echo "</ul></td>";

	echo "<td>".$value['journal']."</td>";
	$tag_names = $value['tags'];
	echo "<td><ul>";
	foreach ($tag_names as $x) {echo "<li> $x </li>";}
	echo "</ul></td>";

	echo "<td><a href ='".$value['url']."'>".$value['url']."</a></td>";
*/
	echo "</tr>";
		}
    }
    /*
foreach ($articles as $value){
	echo "<tr>";
	$article_id = $value['article_id'];
//var_dump($value);
	echo "<td>".$value['alternate_id']."</td>";
	echo "<td>".$article_id."</td>";
	echo "<td><a href ='singles.php?id=".$article_id."'>".$value['title']."</a></td>";

	/*
	echo "<td>".$value['title']."</td>";

	echo "<td>".$value['doi']."</td>";

	$auth_names = $obj->get_authors($article_id);
	foreach ($value['authors'] as $x){

	}
	echo "<td><ul>";
	{echo "<li> $x </li>";};
	echo "</ul></td>";

	echo "<td>".$value['journal']."</td>";
	$tag_names = $value['tags'];
	echo "<td><ul>";
	foreach ($tag_names as $x) {echo "<li> $x </li>";}
	echo "</ul></td>";

	echo "<td><a href ='".$value['url']."'>".$value['url']."</a></td>";
*/
	/*
	echo "</tr>";
	//break;
}
*/
/*
		while($row = mysql_fetch_array($result))
		{
	
		// Your while loop here
	
		}
		*/
	?>


</tbody>
					<tfoot>
						<tr>
							<th>Article Id</th>
							<th>Title</th>
							<!--
							<th>doi</th>
							<th>Authors</th>
							<th>Journal</th>
							<th>Tags</th>
							<th>Link</th>
						-->
						</tr>
					</tfoot>
				</table>	

</div>
