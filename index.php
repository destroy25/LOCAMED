<?php 
include('verif.php');
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
	                            <?php echo $_SESSION['compte_login'];?>
								<img src="img/avatar-2-64.png" alt="">
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">

	                            <a class="dropdown-item" href="delog.php"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
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
		
		<?php if($_SESSION['compte_profil']==1)
		{/*Commercial*/
			echo '	<div class="row">
						<div class="col-xs-3">
							<a href="creation_devis.php"><section class="widget widget-simple-sm-fill">
								<div class="widget-simple-sm-icon">
									<i class="fa fa-pencil"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Création Devis</div>
							</section></a>
						</div><!--.widget-simple-sm-fill-->
						
				<a href="recherche_devis_date.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill green">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-search"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Recherche Devis par client</div>
							</section><!--.widget-simple-sm-fill-->
						</div></a>
						
				<a href="recherche_devis_num.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill purple">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-search"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Recherche Devis par Numéro</div>
							</section><!--.widget-simple-sm-fill-->
						</div></a>
					
					<a href="recherche_factures_date.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill red">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-search"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Recherche Facture par client</div>
							</section><!--.widget-simple-sm-fill-->
						</div></a>
						
											<a href="recherche_facture_client.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill orange">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-search"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Recherche Facture par client</div>
							</section><!--.widget-simple-sm-fill-->
						</div></a>
						
					</div><!--.row-->
					


				</div>';

		}
		elseif($_SESSION['compte_profil']==2)
		{
		echo '	<div class="row">

						<a href="recherche_devis_date.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill green">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-search"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Recherche Devis par client</div>
							</section><!--.widget-simple-sm-fill-->
						</div></a>
						
				<a href="recherche_devis_num.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill purple">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-search"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Recherche Devis par Numéro</div>
							</section><!--.widget-simple-sm-fill-->
						</div></a>

				
					
										<a href="recherche_factures_date.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill red">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-search"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Recherche Facture par client</div>
							</section><!--.widget-simple-sm-fill-->
						</div></a>
						
											<a href="recherche_facture_client.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill orange">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-search"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Recherche Facture par client</div>
							</section><!--.widget-simple-sm-fill-->
						</div></a>


				</div>';
	
		}
		elseif($_SESSION['compte_profil']==3)
		{
			echo '	<div class="row">

									<!--.widget-simple-sm-fill-->
								<a href="livraison_encours.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill blue">
								<div class="widget-simple-sm-icon">
									<i class="fa fa-truck"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Livraison en cours</div>
							</section><!--.widget-simple-sm-fill-->
						</div></a>
			
						<!--.widget-simple-sm-fill-->
								<a href="validation_livraison.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill green">
								<div class="widget-simple-sm-icon">
									<i class="fa fa-check-square"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Validation Réception</div>
							</section><!--.widget-simple-sm-fill-->
						</div></a>
						
						<a href="recherche_bl_date.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill red">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-search"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Recherche BL par client</div>
							</section><!--.widget-simple-sm-fill-->
						</div></a>
						
											<a href="recherche_bl_num.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill orange">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-search"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Recherche BL par Numéro</div>
							</section><!--.widget-simple-sm-fill-->
						</div></a>
				
					</div><!--.row-->


				</div>';

		}
		elseif($_SESSION['compte_profil']==4)
		{
			echo '	<div class="row">
						<div class="col-xs-3">
							<a href="creation_devis.php"><section class="widget widget-simple-sm-fill">
								<div class="widget-simple-sm-icon">
									<i class="fa fa-pencil"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Création Devis</div>
							</section></a>
						</div><!--.widget-simple-sm-fill-->
						<a href="creation_retour.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill red">
								<div class="widget-simple-sm-icon">
									<i class="fa fa-sign-in"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Création Retour</div>
							</section>
						</div></a>
						<!--.widget-simple-sm-fill-->
								<a href=""><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill green">
								<div class="widget-simple-sm-icon">
									<i class="fa fa-check-square"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Validation Réception</div>
							</section><!--.widget-simple-sm-fill-->
						</div></a>
						<a href="saisie_reglement.php"><div class="col-xs-3">
							<section class="widget widget-simple-sm-fill orange">
								<div class="widget-simple-sm-icon">
									<i class="fa fa-credit-card"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Saisie des règlements</div>
							</section></a><!--.widget-simple-sm-fill-->
						</div>
				
					</div><!--.row-->

					<div class="row">
						<div class="col-xs-3">
							<section class="widget widget-simple-sm-fill green">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-page"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Documents Devis</div>
							</section><!--.widget-simple-sm-fill-->
						</div>
						<div class="col-xs-3">
							<section class="widget widget-simple-sm-fill orange">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-page"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Documents Bon de Livraison</div>
							</section><!--.widget-simple-sm-fill-->
						</div>
												<div class="col-xs-3">
							<section class="widget widget-simple-sm-fill red">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-page"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Documents Factures</div>
							</section><!--.widget-simple-sm-fill-->
						</div>
										<div class="col-xs-3">
							<section class="widget widget-simple-sm-fill ">
								<div class="widget-simple-sm-icon">
									<i class="font-icon font-icon-page"></i>
								</div>
								<div class="widget-simple-sm-fill-caption">Documents Retour</div>
							</section><!--.widget-simple-sm-fill-->
						</div>
					</div><!--.row-->

				</div>';

		}
				
				?>
		</div><!--.container-fluid-->
	</div><!--.page-content-->

	<script src="js/lib/jquery/jquery.min.js"></script>
	<script src="js/lib/tether/tether.min.js"></script>
	<script src="js/lib/bootstrap/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>

<script src="js/app.js"></script>
</body>
</html>