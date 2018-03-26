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
	<link rel="stylesheet" href="css/separate/vendor/bootstrap-select/bootstrap-select.min.css">
	<link rel="stylesheet" href="css/separate/vendor/select2.min.css">
	<link rel="stylesheet" href="css/separate/pages/invoice.min.css">
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
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
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Bon de Livraison</h3>
						</div>
					</div>
				</div>
			</header>


			
<?php


				

				
if(isset($_POST['aa']))
{
  if ($_POST['aa']<>null)
  {
	$q1=$_POST['aa'];
	
	$sql='select * from f_docligne where DL_PieceBL=\''.$q1.'\'';

				                    $rq = odbc_exec($connection,$sql);
                    if ($rep=odbc_fetch_array($rq)) {
						
						if ($rep['statut_livraison']=='En instance de livraison')
						{
						
						//update statut_livraison
                        $liv='Livré';
                        $sql='update F_DOCLIGNE set statut_livraison=\''.$liv.'\'where DL_PieceBL=\''.$q1.'\'';
                        odbc_exec($connection,$sql);
                        echo '<div class="alert alert-info" role="alert">
							<strong>Succes !</strong><br>
							Document Validé
						    </div>';
						}
						else 
							echo '<div class="alert alert-info" role="alert">
							<strong>Attention !</strong><br>
							Ce document est déja validé 
						    </div>';
		
					}
					else 
						echo '<div class="alert alert-info" role="alert">
							<strong>Attention !</strong><br>
							Ce document n\'existe pas 
						    </div>';
	
	
	
  }
}
				


					
	
	

echo '			

		<div class="row">
				

			
					
		
					


	<section class="card">
	   <form id="modif_condition" action="validation_bl.php" method="POST">
					
				<header class="card-header card-header-lg">
					Bon de Livraison
				</header>
				<div class="card-block invoice">
					
					
					
					<div class="row table-details">
                     <label class="form-label semibold" for="exampleInput">Scaner ici</label>
			         <input type="text" name="aa" class="form-control input-sm">
					 
                    <div id="ligne_devis">


	<div class="col-lg-12">
							
				<div class="modal fade"
					 id="myModal"
					 tabindex="-1"
					 role="dialog"
					 aria-labelledby="myModalLabel"
					 aria-hidden="true">
					<div class="modal-dialog" role="document">
					 	<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
									<i class="font-icon-close-2"></i>
								</button>
								<h4 class="modal-title" id="myModalLabel">Modification Condition Enlevement</h4>
							</div>
							<div class="modal-body">
							
							<div id="modif">
							</div>
							
							</div>
							
						</div>
						
					</div>
				</div><!--.modal-->
							
						</div>
					</div>

					<div class="row">
					
						<div class="col-lg-12 clearfix">
							<div class="total-amount">
								<div class="actions">
								    
								    <button type="submit" id="btnValid" style="float:right;" class="btn btn-rounded btn-inline">Valider</button>
									
								</div>
							</div>
						</div>
					</div>
					</div>
	
						</div>
			
					</div>
				</div>
				</form>
			</section>

';
	
	?>			


				</div><!--.box-typical-->

				
	</div><!--.container-fluid-->
	
	
	
	
	</div><!--.page-content-->


	
		<script src="js/lib/jquery/jquery.min.js"></script>
	<script src="js/lib/tether/tether.min.js"></script>
	<script src="js/lib/bootstrap/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>
<script src="js/lib/datatables-net/datatables.min.js"></script>
		<script src="js/lib/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="js/lib/select2/select2.full.min.js"></script>

	<script src="js/lib/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
	<script>
		$(document).ready(function() {
			$("input[name='demo1']").TouchSpin({
				min: 0,
				max: 100,
				step: 0.1,
				decimals: 2,
				boostat: 5,
				maxboostedstep: 10,
				postfix: '%'
			});
		});
	</script>
	<script>
		$(document).ready(function(){
			$("input[name='demo2']").TouchSpin({
				min: -1000000000,
				max: 1000000000,
				stepinterval: 50,
				maxboostedstep: 10000000,
				prefix: '$'
			});
		});
	</script>
	<script>
		$(document).ready(function(){
			$("input[name='demo_vertical']").TouchSpin({
				verticalbuttons: true
			});
		});
	</script>
	<script>
		$(document).ready(function(){
			$("input[name='demo_vertical2']").TouchSpin({
				verticalbuttons: true,
				verticalupclass: 'glyphicon glyphicon-plus',
				verticaldownclass: 'glyphicon glyphicon-minus'
			});
		});
	</script>
	<script>
		$(document).ready(function(){
			$("input[name='demo3']").TouchSpin();
		});
	</script>
	<script>
		$(document).ready(function(){
			$("input[name='demo4']").TouchSpin({
				postfix: "a button",
				postfix_extraclass: "btn btn-default"
			});
		});
	</script>
	<script>
		$(document).ready(function(){
			$("input[name='demo4_2']").TouchSpin({
				postfix: "a button",
				postfix_extraclass: "btn btn-default"
			});
		});
	</script>
	<script>
		$(document).ready(function(){
			$("input[name='demo6']").TouchSpin({
				buttondown_class: "btn btn-default-outline",
				buttonup_class: "btn btn-default-outline"
			});
		});
	</script>
	<script>
		$(document).ready(function(){
			$("input[name='demo5']").TouchSpin({
				prefix: "pre",
				postfix: "post"
			});
		});
	</script>
	
	
		<script>
/*Fonction Validation Devis*/
	
	function valider_bl() {
		    var x = document.getElementById("num_piece").value;
           
                $.ajax({
                    url: "ajax/valider_bl.php?q="+x,
                    context: document.body,
                    success: function(responseText) {

                        $("#ligne_form").html(responseText);

                    },
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.

                       /* hideLoadingImage();*/
                    }
                });
				 
            };
  </script>

	<script src="js/app.js"></script>
</body>
</html>