<?php
include('./includes/aws_db.php');
include('./article_class.php');
include('host.php');
require_once("models/config.php");

if (isset($_GET["id"])){
	$id = $_GET["id"];
}

$obj = new Article_db;
$article = $obj->get_article_by_id($id);

//var_dump($article);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo strip_tags($article['title']); ?></title>
		<meta name="keywords" content="<?php foreach ($article['tags'] as $x ) {echo $x.",";} ?>">
  		<meta name="description" content="<?php echo substr(strip_tags($article['abstract']),0,160); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- facebook -->
		<meta property="og:title" content="<?php echo $article['title']; ?>"/>
		<meta property="og:url" content="<?php echo "http://" . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>"/>
		<meta property="og:site_name" content="Open Access Journals Corpus"/>
		<meta property="og:type" content="article"/>
		<meta property="og:description" content="<?php echo substr(strip_tags($article['abstract']),0,160); ?>"/>

		<link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="plugins/select2/select2.css" rel="stylesheet">
		
		<link href="css/style.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
						<script src="http://code.jquery.com/jquery-1.11.1.min.js">
</script>
<script>
$(document).ready(function(){
$(".vote_up").click(function(){ 

	var vote_r =  $(this).attr('value');
	var article_id_r =  $(this).find(".article_id").attr('value');
	var user_id_r = $(this).find(".user_id").attr('value');
	event.preventDefault();
                $.ajax({
                        type: 'POST',
                        url: 'ajax_vote.php',
                        data: {article_id:article_id_r, user_id:user_id_r,vote:vote_r},
                        dataType: 'json',
                        success: function (data) {
                        	$("#vote_article_"+article_id_r).text(data);
                        	
                                console.log(data);
                                
                        }
                });

});
$(".vote_down").click(function(){ 
	var vote_r =  $(this).attr('value');
	var article_id_r =  $(this).find(".article_id").attr('value');
	var user_id_r = $(this).find(".user_id").attr('value');
	event.preventDefault();
                $.ajax({
                        type: 'POST',
                        url: 'ajax_vote.php',
                        data: {article_id:article_id_r, user_id:user_id_r,vote:vote_r},
                        dataType: 'json',
                        success: function (data) {
                    $("#vote_article_"+article_id_r).text(data);

                                console.log(data);
                                
                        }
                });

});
});
</script>
	</head>
	<body>
<!--Start Header-->
<div id="screensaver">
	<canvas id="canvas"></canvas>
	<i class="fa fa-lock" id="screen_unlock"></i>
</div>
<div id="modalbox">
	<div class="devoops-modal">
		<div class="devoops-modal-header">
			<div class="modal-header-name">
				<span>Welcome,</span>
			</div>
			<div class="box-icons">
				<a class="close-link">
					<i class="fa fa-times"></i>
				</a>
			</div>
		</div>
		<div class="devoops-modal-inner">
		</div>
		<div class="devoops-modal-bottom">
		</div>
	</div>
</div>