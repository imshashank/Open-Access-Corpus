<?php
$page = $_GET["page"];

//echo $page;
include('../article_class.php');
include('../includes/db.php');

?>

<div class="row">
	<div id="breadcrumb" class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="#">Dashboard</a></li>
			<li><a href="#">Tables</a></li>
			<li><a href="#">Data Tables</a></li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-usd"></i>
					<span>The Corpus</span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<thead>
						<tr>
							<th>Votes</th>
							<th>Id</th>
							<th>Title</th>
							<th>doi</th>
							<th>Authors</th>
							<th>Journal</th>
							<th>Tags</th>
							<th>Link</th>
						</tr>
					</thead>
					<tbody>
					<!-- Start: list_row -->
					<?php

$obj = new Article_db;

if (isset($_GET['page'])){
	$start = ($page-1) *10;
	$end = 300;
}
else {
	$start = 0;
	$end =30;
}
$articles = $obj->get_articles($start,$end);

foreach ($articles as $value){
	echo "<tr>";
	$article_id = $value['article_id'];

	echo "<td>".$obj->get_vote($article_id)."</td>";
	echo "<td>".$article_id."</td>";

	echo "<td>".$value['title']."</td>";
	echo "<td>".$value['doi']."</td>";

	$auth_names = $obj->get_authors($article_id);
	echo "<td><ul>";
	foreach ($auth_names as $x) {echo "<li> $x </li>";};
	echo "</ul></td>";

	echo "<td>".$obj->get_journal($article_id)."</td>";
	$tag_names = $obj->get_tags($article_id);
	echo "<td><ul>";
	foreach ($tag_names as $x) {echo "<li> $x </li>";}
	echo "</ul></td>";

	echo "<td><a href ='".$value['url']."'>".$value['url']."</a></td>";

	echo "</tr>";
	//break;
}

//$auth_names = $obj->get_authors($article_id);

//$journal_name = $obj->get_jo
					?>
						
							
						
					<!-- End: list_row -->
					</tbody>
					<tfoot>
						<tr>
							<th>Votes</th>
							<th>Id</th>
							<th>Title</th>
							<th>doi</th>
							<th>Authors</th>
							<th>Journal</th>
							<th>Tags</th>
							<th>Link</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
// Run Datables plugin and create 3 variants of settings
function AllTables(){
	TestTable1();
	//TestTable2();
	//TestTable3();
	LoadSelect2Script(MakeSelect2);
}
function MakeSelect2(){
	$('select').select2();
	$('.dataTables_filter').each(function(){
		$(this).find('label input[type=text]').attr('placeholder', 'Search');
	});
}
$(document).ready(function() {
	// Load Datatables and run plugin on tables 
	LoadDataTablesScripts(AllTables);
	// Add Drag-n-Drop feature
	WinMove();
});
</script>
