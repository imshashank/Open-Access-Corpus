<header class="navbar">
	<div class="container-fluid expanded-panel">
		<div class="row">
			<div id="logo" class="col-xs-12 col-sm-2">
				<a href="index.php">OAC</a>
			</div>
			<div id="top-panel" class="col-xs-12 col-sm-10">
				<div class="row">
					<div class="col-xs-8 col-sm-4">
						<a href="#" class="show-sidebar">
						  <i class="fa fa-bars"></i>
						</a>
						<form action='requests.php' method="get">
	                        <div id="search_box">
		                        <input type="text" name="query" placeholder="search"/>
		                        <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"/>
	                        </div>
                        </form>
					</div>
					<div class="col-xs-4 col-sm-8 top-panel-right">
						<ul class="nav navbar-nav pull-right panel-menu">
							<li class="hidden-xs">
								<a href="index.html" class="modal-link">
									<i class="fa fa-bell"></i>
									<span class="badge">7</span>
								</a>
							</li>
							<li class="hidden-xs">
								<a class="ajax-link" href="ajax/calendar.html">
									<i class="fa fa-calendar"></i>
									<span class="badge">7</span>
								</a>
							</li>
							<li class="hidden-xs">
								<a href="ajax/page_messages.html" class="ajax-link">
									<i class="fa fa-envelope"></i>
									<span class="badge">7</span>
								</a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle account" data-toggle="dropdown">
									<div class="avatar">
										<img src="img/avatar1.jpg" class="img-rounded" alt="avatar" />
									</div>
									<i class="fa fa-angle-down pull-right"></i>
									<div class="user-mini pull-right">
										<span class="welcome">Welcome,</span>
										<span><?php if(isUserLoggedIn()) echo $loggedInUser->username; else echo "Login/Register";?></span>
									</div>
								</a>
								<ul class="dropdown-menu">
									<?php if(isUserLoggedIn()) { echo '
									<li>
										<a href="account.php">
											<i class="fa fa-user"></i>
											<span class="hidden-sm text">Profile</span>
										</a>
									</li>
									<li>
										<a href="logout.php">
											<i class="fa fa-power-off"></i>
											<span class="hidden-sm text">Logout</span>
										</a>
									</li>';}
									if(!isUserLoggedIn()) {echo '
										<li>
										<a href="login.php" >
											<i class="fa fa-envelope"></i>
											<span class="hidden-sm text">Login</span>
										</a>
									</li>
									<li>
										<a href="register.php" >
											<i class="fa fa-picture-o"></i>
											<span class="hidden-sm text">Register</span>
										</a>
									</li>';}
									?>
									<!--
									<li>
										<a href="ajax/page_messages.html" class="ajax-link">
											<i class="fa fa-envelope"></i>
											<span class="hidden-sm text">Messages</span>
										</a>
									</li>
									<li>
										<a href="ajax/gallery_simple.html" class="ajax-link">
											<i class="fa fa-picture-o"></i>
											<span class="hidden-sm text">Albums</span>
										</a>
									</li>
									<li>
										<a href="ajax/calendar.html" class="ajax-link">
											<i class="fa fa-tasks"></i>
											<span class="hidden-sm text">Tasks</span>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fa fa-cog"></i>
											<span class="hidden-sm text">Settings</span>
										</a>
									</li>
								-->
									
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!--End Header-->
