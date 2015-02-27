<?php
	/*
		Place code to connect to your DB here.
	*/


	include('./includes/aws_db.php');
	include('./article_class.php');
	include('./user_vote.php');



	// include your code to connect to DB.

	$tbl_name="articles";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/


	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = $host."article.php"; 	//your file name  (the name of this file)
	$limit = 50; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name LIMIT $start, $limit";
	//echo $sq
	$result = mysql_query($sql);
	//$obj = new Article_db;
	//$articles = $obj->get_articles($start,$limit);
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\"> previous </a>";
		else
			$pagination.= "<span class=\"disabled\"> previous </span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\"> $counter </span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\"> $counter </a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\"> $counter </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\"> $counter </a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\"> $lpm1 </a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\"> $lastpage </a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\"> 1 </a>";
				$pagination.= "<a href=\"$targetpage?page=2\"> 2 </a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\"> $counter </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\"> $counter </a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\"> $lpm1 </a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\"> $lastpage </a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\"> 1 </a>";
				$pagination.= "<a href=\"$targetpage?page=2\"> 2 </a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\"> $counter </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\"> $counter </a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\"> next </a>";
		else
			$pagination.= "<span class=\"disabled\"> next </span>";
		$pagination.= "</div>\n";		
	}
?>

<div id="content" class="col-xs-12 col-sm-10">
<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<thead>
						<tr>
							<th>Vote</th>
							<th>Alternate_id</th>
							<th>Id</th>
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
	$vote_obj = new Vote_class();
    while($value = mysql_fetch_array( $result )) {
//var_dump($info);

    	?>


    	<?php
    echo "<tr>";
	$article_id = $value['article_id'];

	$vote_link= 'http://localhost/oclc/OAJ/web_end/get_vote.php?article_id='.$article_id.'';


#$variablee = fopen($vote_link, "rb");  
//$votes_count =stream_get_contents($variablee); 
$votes_count = '0';
 
	echo '<td><div class="vote_up fa fa-arrow-up" value="up">
<span class="article_id" value="'.$article_id.'" ></span>
<span class="user_id" value="'.$loggedInUser->user_id.'"></span>
</div>
<div class=".votes_count" id= "vote_article_'.$article_id.'" >'.$votes_count.'</div>
<div class="vote_down fa fa-arrow-down" value="down">
<span class="article_id" value="'.$article_id.'"></span>
<span class="user_id" value="'.$loggedInUser->user_id.'"></span>
</div></td>';
//var_dump($value);
	echo "<td>".$value['alternate_id']."</td>";
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
							<th>Alternate_id</th>
							<th>Id</th>
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
				<?=$pagination?>

</div>
