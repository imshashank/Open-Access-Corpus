	<!--Start Content-->
		<div id="content" class="col-xs-12 col-sm-10">
			<?php
include('../article_class.php');
include('../includes/db.php');

$obj = new Article_db();

?>

<!--Start Breadcrumb-->
<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<ol class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li><a href="#">Dashboard</a></li>
		</ol>
	</div>
</div>
<!--End Breadcrumb-->
<!--Start Dashboard 1-->
<div id="dashboard-header" class="row">
	<div class="col-xs-10 col-sm-2">
		<h3>HELLO, DASHBOARD!</h3>
	</div>
	<div class="col-xs-2 col-sm-1 col-sm-offset-1">
		<div id="social" class="row">
			<a href="#"><i class="fa fa-google-plus"></i></a>
			<a href="#"><i class="fa fa-facebook"></i></a>
			<a href="#"><i class="fa fa-twitter"></i></a>
			<a href="#"><i class="fa fa-linkedin"></i></a>
			<a href="#"><i class="fa fa-youtube"></i></a>
		</div>
	</div>
	<div class="clearfix visible-xs"></div>
	<div class="col-xs-12 col-sm-8 col-md-7 pull-right">
		<div class="row">
			<div class="col-xs-4">
				<div class="sparkline-dashboard" id="sparkline-1"></div>
				<div class="sparkline-dashboard-info">
					<!--<i class="fa fa-usd"></i>756.45M
					<span class="txt-primary">EBITDA</span>
				-->
				</div>
			</div>
			<div class="col-xs-4">
				<div class="sparkline-dashboard" id="sparkline-2"></div>
				<div class="sparkline-dashboard-info">
					<!--<i class="fa fa-usd"></i>245.12M
					<span class="txt-info">OIBDA</span>
				-->
				</div>
			</div>
			<div class="col-xs-4">
				<div class="sparkline-dashboard" id="sparkline-3"></div>
				<div class="sparkline-dashboard-info">
					<!--<i class="fa fa-usd"></i>107.83M
					<span>REVENUE</span>
				-->
				</div>
			</div>
		</div>
	</div>
</div>
<!--End Dashboard 1-->
<!--Start Dashboard 2-->
<div class="row-fluid">
	<div id="dashboard_links" class="col-xs-12 col-sm-2 pull-right">
		<ul class="nav nav-pills nav-stacked">
			<li class="active"><a href="#" class="tab-link" id="overview">Overview</a></li>
			<li><a href="#" class="tab-link" id="clients">Top Journals</a></li>
			<!--
			<li><a href="#" class="tab-link" id="graph">Statistics</a></li>
			<li><a href="#" class="tab-link" id="servers">Servers</a></li>
		-->
		</ul>
	</div>
	<div id="dashboard_tabs" class="col-xs-12 col-sm-10">
		<!--Start Dashboard Tab 1-->
		<div id="dashboard-overview" class="row" style="visibility: visible; position: relative;">
			<div id="ow-marketplace" class="col-sm-12 col-md-6">
				<div id="ow-setting">
					<a href="#"><i class="fa fa-folder-open"></i></a>
					<a href="#"><i class="fa fa-credit-card"></i></a>
					<a href="#"><i class="fa fa-ticket"></i></a>
					<a href="#"><i class="fa fa-bookmark-o"></i></a>
					<a href="#"><i class="fa fa-globe"></i></a>
				</div>
				<h4 class="page-header">Top Authors</h4>
				<table id="ticker-table" class="table m-table table-bordered table-hover table-heading">
					<thead>
						<tr>
							<th>Author</th>
							<th>No. of articles</th>
							
						</tr>
					</thead>
					<tbody>
						<?php

$obj = new Article_db;
$best_authors = ($obj->best_authors());
echo "<tr>";
foreach ($best_authors as $value){
echo "<td>".$obj-> get_author_names($value['0'])."</td>";
echo "<td>".$value['1']."</td>";
echo "</tr>";
}
						?>
					

						
					</tbody>
				</table>
			</div>
			<div class="col-xs-12 col-md-6">
				<!--
				<div id="ow-donut" class="row">
					<div class="col-xs-4">
						<div id="morris_donut_1" style="width:120px;height:120px;"></div>
					</div>
					<div class="col-xs-4">
						<div id="morris_donut_2" style="width:120px;height:120px;"></div>
					</div>
					<div class="col-xs-4">
						<div id="morris_donut_3" style="width:120px;height:120px;"></div>
					</div>
				</div>
			-->
				<div id="ow-summary" class="row">
					<div class="col-xs-12">
						<h4 class="page-header">&Sigma; SUMMARY</h4>
						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-6">Total Articles<b><?php echo $obj->total_articles(); ?></b></div>
									<div class="col-xs-6">Total Authors<b><?php echo $obj->total_authors(); ?></b></div>
								</div>
								<div class="row">
									<div class="col-xs-6">Total Journals<b><?php echo $obj->total_journals(); ?></b></div>
									<div class="col-xs-6">Total Publishers<b><?php echo $obj->total_publishers(); ?></b></div>
								</div>
								<div class="row">
									<div class="col-xs-6">Total Tags <b><?php echo $obj->total_tags(); ?></b></div>
									<div class="col-xs-6">Total DOI<b><?php echo $obj->total_dois(); ?></b></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--
				<div id="ow-activity" class="row">
					<div class="col-xs-2 col-sm-1 col-md-2">
						<div class="v-txt">ACTIVITY</div>
					</div>
					<div class="col-xs-7 col-sm-5 col-md-6">
						<div class="row"><i class="fa fa-code"></i> Release published <span class="label label-default pull-right">01:17:34</span></div>
						<div class="row"><i class="fa fa-cloud-upload"></i> Backup created <span class="label label-default pull-right">03:23:34</span></div>
						<div class="row"><i class="fa fa-camera"></i> Snapshot created <span class="label label-default pull-right">04:22:11</span></div>
						<div class="row"><i class="fa fa fa-money"></i> Invoice pay <span class="label label-default pull-right">05:11:51</span></div>
						<div class="row"><i class="fa fa-briefcase"></i> Project edited <span class="label label-default pull-right">04:52:23</span></div>
						<div class="row"><i class="fa fa-floppy-o"></i> Project saved <span class="label label-default pull-right">07:11:01</span></div>
						<div class="row"><i class="fa fa-bug"></i> Bug fixed <span class="label label-default pull-right">09:10:31</span></div>
					</div>
					<div id="ow-stat" class="col-xs-3 col-sm-4 col-md-4 pull-right">
						<div class="row"><small><b>Ow Stat.:</b></small></div>
						<div class="row">&#37;user <sup>20,43</sup></div>
						<div class="row">&#37;nice <sup>1,01</sup></div>
						<div class="row">&#37;system <sup>27,34</sup></div>
						<div class="row">&#37;iowait <sup>2,02</sup></div>
						<div class="row">&#37;steal <sup>1,22</sup></div>
						<div class="row">&#37;idle <sup>47,98</sup></div>
						<div class="row">tps <sup>296546</sup></div>
					</div>
				</div>
			-->
				
			</div>
		</div>
		<!--End Dashboard Tab 1-->
		<!--Start Dashboard Tab 2-->
		<div id="dashboard-clients" class="row" style="visibility: hidden; position: absolute;">
			<div class="row one-list-message">
				<div class="col-xs-1"><i class="fa fa-users"></i></div>
				<div class="col-xs-2"><b>Journal_id</b></div>
				<div class="col-xs-2">Journal_name</div>
				<div class="col-xs-2">Number of Articles</div>
			</div>
			<?php

$obj = new Article_db;
$best_journals = ($obj->best_journals());
foreach ($best_journals as $value){

echo '<div class="row one-list-message"><div class="col-xs-1"><i class="fa fa-user"></i></div>';

echo '<div class="col-xs-2"><b>'.$value['0'].'</b></div>';
echo '<div class="col-xs-2">'.$obj-> get_journal_name($value['0'])."</div>";
echo '<div class="col-xs-2">'.$value['1'].'</div>';
echo "</div>";
}
											

			?>
			
		</div>
		<!--End Dashboard Tab 2-->
		<!--Start Dashboard Tab 3-->
		<div id="dashboard-graph" class="row" style="width:100%; visibility: hidden; position: absolute;" >
			<div class="col-xs-12">
				<h4 class="page-header">OS Platform Statistics</h4>
				<div id="stat-graph" style="height: 300px;"></div>
			</div>
		</div>
		<!--End Dashboard Tab 3-->
		<!--Start Dashboard Tab 4-->
		<div id="dashboard-servers" class="row" style="visibility: hidden; position: absolute;">
			<div class="col-xs-12 col-sm-6 col-md-4 ow-server">
				<h4 class="page-header text-right"><i class="fa fa-windows"></i>#SRV-APP</h4>
				<small>Application server</small>
				<div class="ow-settings">
					<a href="#"><i class="fa fa-gears"></i></a>
				</div>
				<div class="row ow-server-bottom">
					<div class="col-sm-4">
						<div class="knob-slider">
							<input id="knob-srv-1" class="knob" data-width="60"  data-height="60" data-angleOffset="180" data-fgColor="#6AA6D6" data-skin="tron" data-thickness=".2" value="">CPU Load
						</div>
					</div>
					<div class="col-sm-8">
						<div class="row"><i class="fa fa-windows"></i> Windows 2008</div>
						<div class="row"><i class="fa fa-user"></i> Active users - 49</div>
						<div class="row"><i class="fa fa-bolt"></i> Uptime - 10 days</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 ow-server">
				<h4 class="page-header text-right"><i class="fa fa-windows"></i>#DB-MASTER</h4>
				<small>SQL server</small>
				<div class="ow-settings">
					<a href="#"><i class="fa fa-gears"></i></a>
				</div>
				<div class="row ow-server-bottom">
					<div class="col-sm-4">
						<div class="knob-slider">
							<input id="knob-srv-2" class="knob" data-width="60"  data-height="60" data-angleOffset="180" data-fgColor="#6AA6D6" data-skin="tron" data-thickness=".2" value="">CPU Load
						</div>
					</div>
					<div class="col-sm-8">
						<div class="row"><i class="fa fa-windows"></i> Windows 2013</div>
						<div class="row"><i class="fa fa-user"></i> Active users - 39</div>
						<div class="row"><i class="fa fa-bolt"></i> Uptime - 2 month 1 day</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 ow-server">
				<h4 class="page-header text-right"><i class="fa fa-linux"></i>#DB-WEB</h4>
				<small>MySQL server</small>
				<div class="ow-settings">
					<a href="#"><i class="fa fa-gears"></i></a>
				</div>
				<div class="row ow-server-bottom">
					<div class="col-sm-4">
						<div class="knob-slider">
							<input id="knob-srv-3" class="knob" data-width="60"  data-height="60" data-angleOffset="180" data-fgColor="#6AA6D6" data-skin="tron" data-thickness=".2" value="">CPU Load
						</div>
					</div>
					<div class="col-sm-8">
						<div class="row"><i class="fa fa-linux"></i> CentOS 6.5</div>
						<div class="row"><i class="fa fa-user"></i> Active users - 298</div>
						<div class="row"><i class="fa fa-bolt"></i> Uptime - 9 month 17 day</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 ow-server">
				<h4 class="page-header text-right"><i class="fa fa-linux"></i>#WWW-SRV</h4>
				<small>Web-server</small>
				<div class="ow-settings">
					<a href="#"><i class="fa fa-gears"></i></a>
				</div>
				<div class="row ow-server-bottom">
					<div class="col-sm-4">
						<div class="knob-slider">
							<input id="knob-srv-4" class="knob" data-width="60"  data-height="60" data-angleOffset="180" data-fgColor="#6AA6D6" data-skin="tron" data-thickness=".2" value="">CPU Load
						</div>
					</div>
					<div class="col-sm-8">
						<div class="row"><i class="fa fa-linux"></i> Centos 6.5</div>
						<div class="row"><i class="fa fa-user"></i> Active users - 1989</div>
						<div class="row"><i class="fa fa-bolt"></i> Uptime - 2 years 3 month</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 ow-server">
				<h4 class="page-header text-right"><i class="fa fa-linux"></i>#PHONE-OFFICE</h4>
				<small>Asterisk</small>
				<div class="ow-settings">
					<a href="#"><i class="fa fa-gears"></i></a>
				</div>
				<div class="row ow-server-bottom">
					<div class="col-sm-4">
						<div class="knob-slider">
							<input id="knob-srv-5" class="knob" data-width="60"  data-height="60" data-angleOffset="180" data-fgColor="#6AA6D6" data-skin="tron" data-thickness=".2" value="">CPU Load
						</div>
					</div>
					<div class="col-sm-8">
						<div class="row"><i class="fa fa-linux"></i> Debian 6.4</div>
						<div class="row"><i class="fa fa-phone"></i> Active calls - 86</div>
						<div class="row"><i class="fa fa-bolt"></i> Uptime - 3 month 19 day</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 ow-server">
				<h4 class="page-header text-right"><i class="fa fa-linux"></i>#DEVEL</h4>
				<small>DEV server</small>
				<div class="ow-settings">
					<a href="#"><i class="fa fa-gears"></i></a>
				</div>
				<div class="row ow-server-bottom">
					<div class="col-sm-4">
						<div class="knob-slider">
							<input id="knob-srv-6" class="knob" data-width="60"  data-height="60" data-angleOffset="180" data-fgColor="#6AA6D6" data-skin="tron" data-thickness=".2" value="">CPU Load
						</div>
					</div>
					<div class="col-sm-8">
						<div class="row"><i class="fa fa-linux"></i> CentOS 6.5</div>
						<div class="row"><i class="fa fa-archive"></i> Repositories - 17</div>
						<div class="row"><i class="fa fa-bolt"></i> Uptime - 4 month 21 day</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div id="ow-server-footer">
				<a href="#" class="col-xs-4 col-sm-2 btn-default text-center"><i class="fa fa-sun-o"></i> <b>287</b> <span>Hosts</span></a>
				<a href="#" class="col-xs-4 col-sm-2 btn-default text-center"><i class="fa fa-envelope-o"></i> <b>56</b> <span>Messages</span></a>
				<a href="#" class="col-xs-4 col-sm-2 btn-default text-center"><i class="fa fa-desktop"></i> <b>85</b> <span>Stations</span></a>
				<a href="#" class="col-xs-4 col-sm-2 btn-default text-center"><i class="fa fa-info-circle"></i> <b>33</b> <span>Errors</span></a>
				<a href="#" class="col-xs-4 col-sm-2 btn-default text-center"><i class="fa fa-comments-o"></i> <b>1386</b> <span>Comments</span></a>
				<a href="#" class="col-xs-4 col-sm-2 btn-default text-center"><i class="fa fa-user"></i> <b>19985</b> <span>Clients</span></a>
			</div>
		</div>
		<!--End Dashboard Tab 4-->
	</div>
	<div class="clearfix"></div>
</div>
<!--End Dashboard 2 -->
<div style="height: 40px;"></div>
<script type="text/javascript">
// Array for random data for Sparkline
var sparkline_arr_1 = SparklineTestData();
var sparkline_arr_2 = SparklineTestData();
var sparkline_arr_3 = SparklineTestData();
$(document).ready(function() {
	// Make all JS-activity for dashboard
	DashboardTabChecker();
	// Load Knob plugin and run callback for draw Knob charts for dashboard(tab-servers)
	LoadKnobScripts(DrawKnobDashboard);
	// Load Sparkline plugin and run callback for draw Sparkline charts for dashboard(top of dashboard + plot in tables)
	LoadSparkLineScript(DrawSparklineDashboard);
	// Load Morris plugin and run callback for draw Morris charts for dashboard
	LoadMorrisScripts(MorrisDashboard);
	// Make beauty hover in table
	$("#ticker-table").beautyHover();
});
</script>

		</div>