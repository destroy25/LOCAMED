<?php 
include('connexion.php');

?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>LOCAMED</title>

	<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="img/favicon.png" rel="icon" type="image/png">
	<link href="img/favicon.ico" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/separate/pages/widgets.min.css">

</head>
<body class="with-side-menu">

	<header class="site-header">
	    <div class="container-fluid">
	
	        <a href="#" class="site-logo">
	            <img class="hidden-md-down" src="img/logo-2.png" alt="">
	            <img class="hidden-lg-up" src="img/logo-2-mob.png" alt="">
	        </a>
	
	        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
	            <span>toggle menu</span>
	        </button>
	
	        <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>
	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
	              
	
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            <img src="img/avatar-2-64.png" alt="">
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-user"></span>Profile</a>
	                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-cog"></span>Settings</a>
	                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-question-sign"></span>Help</a>
	                            <div class="dropdown-divider"></div>
	                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
	                        </div>
	                    </div>
	
	                    <button type="button" class="burger-right">
	                        <i class="font-icon-menu-addl"></i>
	                    </button>
	                </div><!--.site-header-shown-->
	
	                <div class="mobile-menu-right-overlay"></div>
</div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header><!--.site-header-->

	<div class="mobile-menu-left-overlay"></div>
	<nav class="side-menu">
	    <ul class="side-menu-list">

						<?php include('menu.php'); ?>
		
    </ul>
	
	</nav><!--.side-menu-->

	<div class="page-content">
		<div class="container-fluid">

		<div>
					<div class="row">
						<div class="col-xs-3">
							<a href="creation_devis.php"><section class="widget widget-simple-sm-fill">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-pencil"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Création Devis</div>
							</section></a>
						</div><!--.widget-simple-sm-fill-->
						<a href="creation_retour.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill red">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-pencil"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Création Retour</div>
							</section>
						</div></a>
						<!--.widget-simple-sm-fill-->
								<a href=""><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill green">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-facebook"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Validation Réception</div>
							</section><!--.widget-simple-sm-fill-->
						</div></a>
						<a href="saisie_reglement.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill yellow">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-facebook"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Saisie des règlements</div>
							</section></a><!--.widget-simple-sm-fill-->
						</div>
				
					</div><!--.row-->

					<div class="row">
						<div class="col-xs-3">
							<section class="widget widget-simple-sm-fill green">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-facebook"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Documents Devis</div>
							</section><!--.widget-simple-sm-fill-->
						</div>
						<div class="col-xs-3">
							<section class="widget widget-simple-sm-fill orange">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-server"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Documents Bon de Livraison</div>
							</section><!--.widget-simple-sm-fill-->
						</div>
												<div class="col-xs-3">
							<section class="widget widget-simple-sm-fill orange">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-server"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Documents Factures</div>
							</section><!--.widget-simple-sm-fill-->
						</div>
					</div><!--.row-->

					<div class="row">
						<div class="col-xs-3">
							<section class="widget widget-simple-sm-fill purple">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-facebook"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">98K Likes</div>
							</section><!--.widget-simple-sm-fill-->
						</div>
						<div class="col-xs-3">
							<section class="widget widget-simple-sm-fill grey">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-server"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">3 Servers</div>
							</section><!--.widget-simple-sm-fill-->
						</div>
					</div><!--.row-->

					<div class="row">
						<div class="col-xs-3">
							<section class="widget widget-simple-sm">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-cloud-download color-green"></i>
								</div>
								<div class="widget-simple-sm-bottom">98K Likes</div>
							</section><!--.widget-simple-sm-->
						</div>
						<div class="col-xs-3">
							<section class="widget widget-simple-sm">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-bookmark color-purple"></i>
								</div>
								<div class="widget-simple-sm-bottom">
									<a href="#">760 Bookmarks</a>
								</div>
							</section><!--.widget-simple-sm-->
						</div>
					</div><!--.row-->
			<div class="row">
						<div class="col-xs-12">
							<section class="widget top-tabs widget-tabs-compact">
								<div class="widget-tabs-nav bordered">
									<ul class="tbl-row" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#w-3-tab-1" role="tab">
												<i class="font-icon font-icon-heart"></i>
												2 719
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#w-3-tab-2" role="tab">
												<i class="font-icon font-icon-users-two"></i>
												5 386
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#w-3-tab-3" role="tab">
												<i class="font-icon font-icon-eye"></i>
												24 953
											</a>
										</li>
									</ul>
								</div>
								<div class="tab-content widget-tabs-content">
									<div class="tab-pane active" id="w-3-tab-1" role="tabpanel">
										<div class="user-card-row">
											<div class="tbl-row">
												<div class="tbl-cell tbl-cell-photo tbl-cell-photo-64">
													<a href="#">
														<img src="img/avatar-1-128.png" alt="">
													</a>
												</div>
												<div class="tbl-cell">
													<p class="user-card-row-name font-16"><a href="#">Gerald Davidson</a></p>
													<p class="user-card-row-mail font-14"><a href="#">Company Founder</a></p>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="w-3-tab-2" role="tabpanel">
										<center>Content 2</center>
									</div>
									<div class="tab-pane" id="w-3-tab-3" role="tabpanel">
										<center>Content 3</center>
									</div>
								</div>
							</section>

							<section class="widget top-tabs widget-tabs-compact">
								<div class="widget-tabs-nav colored">
									<ul class="tbl-row" role="tablist">
										<li class="nav-item">
											<a class="nav-link red active" data-toggle="tab" href="#wt-4-tab-1" role="tab">
												<i class="font-icon font-icon-heart"></i>
												2 719
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link orange" data-toggle="tab" href="#wt-4-tab-2" role="tab">
												<i class="font-icon font-icon-users-two"></i>
												5 386
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link blue" data-toggle="tab" href="#wt-4-tab-3" role="tab">
												<i class="font-icon font-icon-eye"></i>
												24 953
											</a>
										</li>
									</ul>
								</div>
								<div class="tab-content widget-tabs-content">
									<div class="tab-pane active" id="wt-4-tab-1" role="tabpanel">
										<div class="user-card-row">
											<div class="tbl-row">
												<div class="tbl-cell tbl-cell-photo tbl-cell-photo-64">
													<a href="#">
														<img src="img/avatar-1-128.png" alt="">
													</a>
												</div>
												<div class="tbl-cell">
													<p class="user-card-row-name font-16"><a href="#">Gerald Davidson</a></p>
													<p class="user-card-row-mail font-14"><a href="#">Company Founder</a></p>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="wt-4-tab-2" role="tabpanel">
										<center>Content 2</center>
									</div>
									<div class="tab-pane" id="wt-4-tab-3" role="tabpanel">
										<center>Content 3</center>
									</div>
								</div>
							</section>
						</div>
					</div>
				</div>

				
		</div><!--.container-fluid-->
	</div><!--.page-content-->

	<script src="js/lib/jquery/jquery.min.js"></script>
	<script src="js/lib/tether/tether.min.js"></script>
	<script src="js/lib/bootstrap/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>

<script src="js/app.js"></script>
</body>
</html>