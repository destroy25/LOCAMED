<?php 
include('verif.php');
include('connexion.php');

/*Récuperétion des infos*/
$depot=$_SESSION['depot'];

$sql='select DE_Region from f_depot where de_no='.$depot;
		                $rq = odbc_exec($connection,$sql);
						if ($rep=odbc_fetch_array($rq)) {
							$branche_client=$rep['DE_Region'];
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
	<link rel="stylesheet" href="css/separate/vendor/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="css/separate/vendor/bootstrap-daterangepicker.min.css">
<link rel="stylesheet" href="css/lib/clockpicker/bootstrap-clockpicker.min.css">

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
							<h3>Recherche Devis</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Gestion Devis</a></li>
								<li><a href="#">Recherche Devis</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
			

				


				<div class="row">
				                            <form action="#" method="post" class="main" enctype="multipart/form-data" id="entete">


						
							<div class="col-lg-4">
							<label class="form-label semibold" for="exampleInput">Client</label>

				<select name="client" class="select2">
				<?php $sqlclient='select CT_Num,CT_Intitule from F_COMPTET where CT_Type=0 and CT_Num like \''.$branche_client.'%\'';
				                    $rq = odbc_exec($connection,$sqlclient);
                    while ($rep=odbc_fetch_array($rq)) {
								echo '<option value="'.$rep['CT_Num'].'">'.$rep['CT_Num'].' - '.utf8_encode($rep['CT_Intitule']).'</option>';
		
					}
					?>
							</select>
							<br/>
							<br/>
						</div>
						
								<div class="col-lg-4">
						
													<label class="form-label semibold" for="exampleInput">Date Début</label>


							<div class="form-group">
								<div class='input-group date'>
									<input name="date_debut" id="daterange3" type="text"  class="form-control">
									<span class="input-group-addon">
										<i class="font-icon font-icon-calend"></i>
									</span>
								</div>
							</div>

					</div><!--.row-->
					
					
								<div class="col-lg-4">
						
													<label class="form-label semibold" for="exampleInput">Date Fin</label>


							<div class="form-group">
								<div class='input-group date'>
									<input name="date_fin" id="daterange4" type="text"  class="form-control">
									<span class="input-group-addon">
										<i class="font-icon font-icon-calend"></i>
									</span>
								</div>
							</div>

					</div><!--.row-->
			
					
					
					<div class="col-lg-8">
						<fieldset class="form-group">
		<label class="form-label semibold" for="exampleInput">&nbsp;</label>
                            <a style="float:right;" class="btn btn-rounded btn-inline" onclick="recherche_bl()">Rechercher</a>
	
						</fieldset>
					</div>
					</form>
				</div><!--.row-->


				<div id="box">
				
				<id id="loading" style="text-align:center;display:none;">
				<img src="img/fancybox_loading@2x.gif" alt="loading"/>
				</id>
				
				</div>
	

				</div><!--.box-typical-->

				
	</div><!--.container-fluid-->
		
	
	
	</div><!--.page-content-->


	
		<script src="js/lib/jquery/jquery.min.js"></script>
	<script src="js/lib/tether/tether.min.js"></script>
	<script src="js/lib/bootstrap/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>

		<script src="js/lib/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="js/lib/select2/select2.full.min.js"></script>

	<script src="js/lib/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
	
	
	
	
		<script type="text/javascript" src="js/lib/moment/moment-with-locales.min.js"></script>
	<script type="text/javascript" src="js/lib/eonasdan-bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
	<script src="js/lib/clockpicker/bootstrap-clockpicker.min.js"></script>
	<script src="js/lib/clockpicker/bootstrap-clockpicker-init.js"></script>
	<script src="js/lib/daterangepicker/daterangepicker.js"></script>

	<script>
		$(function() {
			function cb(start, end) {
				$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			}
			cb(moment().subtract(29, 'days'), moment());


			$('#daterange2').daterangepicker();

			$('#daterange3').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
				locale: {
            format: 'DD/MM/YYYY'
        }
			});
			
			$('#daterange4').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
						locale: {
            format: 'DD/MM/YYYY'
        }
			});

			$('#daterange').on('show.daterangepicker', function(ev, picker) {
				/*$('.daterangepicker select').selectpicker({
					size: 10
				});*/
			});

		});
	</script>


	
	
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

	
	function recherche_bl() {
                            
                               str1=document.forms['entete'].client.value;
                               str2=document.forms['entete'].date_debut.value;
                               str3=document.forms['entete'].date_fin.value;
 
                showLoadingImage();
				
				window.location.replace("list_devis.php?client="+str1+"&debut="+str2+"&fin="+str3);
				
                /*$.ajax({
                    url: "ajax/recherche_devis.php?client="+str1,
                    context: document.body,
                    success: function(responseText) {

                        $("#box").html(responseText);

                    },
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.
                
                        hideLoadingImage();
                    }
                });*/
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
		

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>  

</body>
</html>