<?php 
include('connexion.php');


if (isset($_POST['MM_Insert'])) {
	

		$num=$_POST['num'];
		$intitule=$_POST['intitule'];
		$adresse=$_POST['adresse'];
		$ville=$_POST['ville'];
		$telephone=$_POST['telephone'];
		$email=$_POST['email'];
		$compteg='34210000'; // A récuperer de la base de données dépôt

		
		
	
/*Début méthode création Client Webservice OM*/  



					
	$client = new nusoap_client($wsdl,true);
	$err = $client->getError();
	if ($err) 
	{
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
			exit();
	}
	// Exécution de la Methode creation_client
//	$result = $client->call('HelloUser',$theVariable);
	$result = $client->call('creation_client',
	array('num'=>$num,
	'intitule'=>$intitule,
	'compteg'=>$compteg,
	'adresse'=>$adresse,
	'ville'=>$ville,
	'telephone'=>$telephone,
	'email'=>$email
	));
 
	if ($client->fault) 
	{
		echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
	} 
	else 
	{
		$err = $client->getError();
		if ($err) 
		{			
			$msg='<div class="alert alert-danger" role="alert">
							<strong>Error !</strong><br>
							'.$err.'
						</div>';
		} 
		else
		{
		//echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
			$msg='<div class="alert alert-info" role="alert">
							<strong>Succes !</strong><br>
							'.utf8_encode($result).'
						</div>';
		}
	}
					

/*Fin méthode création Client Webservice OM*/  



}



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
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Création Client</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Gestion Clients</a></li>
								<li><a href="#">Création Client</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			
			
					<div class="box-typical box-typical-padding">
			
			<!--Message de Validation -->
			<?php if(isset($msg))
			{
				echo $msg;
			}?>
			
          <form action="creation_client.php" method="post">

										<div class="">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Numéro Client</label>
						<input type="text" name="num" value="CL0011" readonly class="form-control" id="inputPassword" placeholder="Text Disabled">
						</fieldset>
					</div>
					<div class="">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Intitulé Client</label>
							<input type="text" name="intitule" required="required" class="form-control" id="exampleInput">
						</fieldset>
					</div>
					
									<div class="">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Adresse</label>
							<input name="adresse" type="text" class="form-control" id="exampleInput">
						</fieldset>
					</div>
					
														<div class="">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Ville</label>
							<input name="ville" type="text" class="form-control" id="exampleInput">
						</fieldset>
					</div>
					
																			<div class="">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Téléphone</label>
							<input name="telephone" type="text" class="form-control" id="exampleInput">
						</fieldset>
					</div>
					
																								<div class="">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Email</label>
							<input name="email" type="text" class="form-control" id="exampleInput">
						</fieldset>
					</div>

						  <input type="hidden" name="MM_Insert" />

					
                    <input type="submit" class="btn btn-rounded" value="Valider">


				</form>


			</div><!--.box-typical-->
		</div><!--.container-fluid-->
	
			
	
				
	</div><!--.container-fluid-->
	
	
	
	
	</div><!--.page-content-->


	
		<script src="js/lib/jquery/jquery.min.js"></script>
	<script src="js/lib/tether/tether.min.js"></script>
	<script src="js/lib/bootstrap/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>

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

	
	function validation_entete() {
                               str=document.forms['entete'].souche.value;
                               str1=document.forms['entete'].client.value;
 
                showLoadingImage();
                $.ajax({
                    url: "ajax/devis.php?q=1&client="+str1+"&souche="+str,
                    context: document.body,
                    success: function(responseText) {

                        $("#box").html(responseText);

                    },
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.
                $("#entete").css("display", "none");
                        hideLoadingImage();
                    }
                });
            };
</script>
<script src="js/app.js"></script>


        <script type="text/javascript">

            function hideLoadingImage()
            {
                $("#loading").css("display", "none");

            }

            function showLoadingImage(){
                $("#loading").css("display", "block");

            }

        </script>

</body>
</html>