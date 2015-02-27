<?php
include('host.php');
require_once("models/config.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Open Access Journal Corpus</title>
		<meta name="description" content="description">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo $host;?>plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="<?php echo $host;?>plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="<?php echo $host;?>plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="<?php echo $host;?>plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="<?php echo $host;?>plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="<?php echo $host;?>plugins/select2/select2.css" rel="stylesheet">
		<link href="<?php echo $host;?>css/style.css" rel="stylesheet">
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