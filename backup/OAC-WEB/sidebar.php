<?php

include('host.php');
?>
<!--Start Container-->
<div id="main" class="container-fluid">
	<div class="row">
		<div id="sidebar-left" class="col-xs-2 col-sm-2">
			<ul class="nav main-menu">
				<li>
					<a href="<?php echo $host;?>index.php" >
						<i class="fa fa-dashboard"></i>
						<span class="hidden-xs">Dashboard</span>
					</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-bar-chart-o"></i>
						<span class="hidden-xs">Corpus</span>
					</a>
					<ul class="dropdown-menu">
						<li><a  href="article.php">Articles</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-bar-chart-o"></i>
						<span class="hidden-xs">Settings</span>
					</a>
					<ul class="dropdown-menu">
						<li><a  href="./voting.php">Voting Template</a></li>
					</ul>
				</li>
				
			</ul>
		</div>