<?php 
include('verif.php');
include('connexion.php');

/*Récuperétion des infos*/
$depot=$_SESSION['depot'];


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
	<link rel="stylesheet" href="css/lib/datatables-net/datatables.min.css">
<link rel="stylesheet" href="css/separate/vendor/datatables-net.min.css">

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
							<h2>Clients</h2>
						</div>
					</div>
				</div>
			</header>
			<div id="modif">
										<id id="loading" style="text-align:center;display:none;">
				<img src="img/fancybox_loading@2x.gif" alt="loading"/>
				</id>		

			</div>
			<section class="card">
				<div class="card-block">
					<table id="example" class="display table table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>N° Client</th>
							<th>Intitule Client</th>
							<th>Adresse</th>
							<th>Téléphone</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$sql='select * from f_comptet
						';
		                $rq = odbc_exec($connection,$sql);
						while ($rep=odbc_fetch_array($rq)) {
							

								/*Conversion de date*/
//								$d=date_create($rep['DO_Date']);
								
								echo '<tr id="'.$rep['CT_Num'].'">
								<td>'.$rep['CT_Num'].'</td>
								<td>'.$rep['CT_Intitule'].'</td>
								<td>'.utf8_encode($rep['CT_Adresse']).'</td>
								<td>'.$rep['CT_Telephone'].'</td>
								<td>
</td>
								</tr>';
		
						}?>
		
											</tbody>
					</table>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->

<!--.page-content-->

	<script src="js/lib/jquery/jquery.min.js"></script>
	<script src="js/lib/tether/tether.min.js"></script>
	<script src="js/lib/bootstrap/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/lib/datatables-net/datatables.min.js"></script>

	<script>
		$(function() {
			$('#example').DataTable({
				responsive: true
			});
		});
	</script>

	
	
                <script type="text/javascript">
// delete row in a table
jQuery('.transformation_devis').click(function(){
 var y = $(this).closest('tr').attr('id');
if (confirm("Voulez vous transformer le devis N° "+y+" en facture ?") == true) {
		
//		 var x = $(this).closest('tr').attr('id');
 
 $.ajax({
                    url: "ajax/transformation_devis.php?&q="+y,
                    context: document.body,
                    success: function(responseText) {


                        //$("#txtHint22").html(responseText);
                        $("#modif").html(responseText);

                    },
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.

                    }
                });
 
} 
 // return false;
});     </script>




<script type="text/javascript">
/*JS Loading*/
            function hideLoadingImage()
            {
                $("#loading").css("display", "none");

            }

            function showLoadingImage(){
                $("#loading").css("display", "block");
            }

        </script>	
	


	
	
<script src="js/app.js"></script>
</body>
</html>