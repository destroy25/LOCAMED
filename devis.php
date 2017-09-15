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

	<?php include('menu.php');?>	
    </ul>
	
	</nav><!--.side-menu-->

	<div class="page-content">
	
			<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Devis</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Gestion Devis</a></li>
								<li><a href="#">Création Devis</a></li>
							</ol>
						</div>
					</div>
				</div>
			</header>


			
<?php
if(isset($_GET['q']))
{
	$q=$_GET['q'];	

				


$sql='select * from F_Docentete where DO_Piece=\''.$q.'\'';

				                    $rq = odbc_exec($connection,$sql);
                    if ($rep=odbc_fetch_array($rq)) {
						$date=$rep['DO_Date'];
						$client1=$rep['DO_Tiers'];
						$DO_Statut=$rep['DO_Statut'];
		
					}
					
$sqlclient='select * from f_comptet where ct_num=\''.$client1.'\'';

				                    $rqclient = odbc_exec($connection,$sqlclient);
                    if ($repclient=odbc_fetch_array($rqclient)) {
						$intitule_client=$repclient['CT_Intitule'];
						$adresse_client=$repclient['CT_Adresse'];
						$complement_client=$repclient['CT_Complement'];
						$ville_client=$repclient['CT_Ville'];
		
					}

echo '			

				<div class="row">
				

			
					
		
					
<!--						<div class="col-lg-4">
						<div class="form-group">
													<label class="form-label" for="desgination">Quantité</label>

							<input id="demo3" type="text" value="1" name="demo3">
						</div>-->
					</div>
				</div><!--.row-->


							<section class="card">
				<header class="card-header card-header-lg">
					Devis
				</header>
				<div class="card-block invoice">
					<div class="row">
						<div class="col-lg-6 company-info">
							<h5>'.$client1.'</h5>
							<p>'.$intitule_client.'</p>

							<div class="invoice-block">
								<div>'.utf8_encode($adresse_client).'</div>
								<div>'.utf8_encode($complement_client).'</div>
								<div>'.utf8_encode($ville_client).'</div>
							</div>

						
						
						</div>
						<div class="col-lg-6 clearfix invoice-info">
							<div class="text-lg-right">
								<h5>DEVIS #'.$q.'</h5>
								<div>Date: '.$date.'</div>';
								if ($DO_Statut==1)
									echo '<h5>Non Validé</h5>';
								elseif ($DO_Statut==2)
								    echo '<h5>Validé</h5>';
							echo '</div>


						</div>
					
					
					
					
					</div>
					
					
					<div class="row table-details">

			                            
<div id="ligne_devis">

<input type="hidden" id="num_piece" value="'.$q.'"/>

	<div class="col-lg-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="10"><a  class="SelectModif_2" href="#" data-toggle="modal" data-target="#myModal">Modifier</a> / <a class="suppression_list_lignes_2">Supprimer</a></th>
										<th>Article</th>
										<th>Désignation</th>
										<th>Quantité</th>
										<th>Prix Unitaire</th>
										<th>Remise</th>
										<th>Condition Enlevement</th>
										<th>Statut Stock</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>';
								/*Affichage des Lignes du document */
						$totalqte=0;		//Total Quantité
						$totalht=0;			//Totat HT
						$totalttc=0;		//Tota TTC
								$sqlligne='select AR_Ref,DL_Design,DL_Qte,DL_PrixUnitaire,DL_Remise01REM_Valeur,DL_MontantHT,DL_MontantTTC,condition_enlevement,cbMarq
								from f_docligne where DO_Piece=\''.$q.'\'';
								    $rqligne = odbc_exec($connection,$sqlligne);
									while ($data[] = odbc_fetch_array($rqligne));
									
									
									$val=count($data);
									$val2=0;
									$id=0;
									foreach($data as $dat)
									{
										$val2++;
										if($val2==$val) continue;
										
										$totalqte=$totalqte+$dat['DL_Qte'];
										$totalht=$totalht+$dat['DL_MontantHT'];
										$totalttc=$totalttc+$dat['DL_MontantTTC'];
										
						//odbc_close($connection);
						/*Statut du Stock */
						$stock=0;
						$sqlstock='select * from f_artstock where de_no=1 and ar_ref=\''.$dat['AR_Ref'].'\'';
						$rqstock = odbc_exec($connection,$sqlstock);
						if ($repstock=odbc_fetch_array($rqstock)) {
						$stock=$repstock['AS_QteSto'];
						}
						
						if($dat['DL_Qte']<=$stock)
						{
							$infostock='<span class="label label-success">Livrable</span>';
						}
						else
						{
							$infostock='<span class="label label-danger">Non Livrable</span>';
						}
						
						/*Fin Statut du Stock */
						$id++;
						echo'
									<tr id="'.$dat['cbMarq'].'" class="'.$id.'" >
										<td><input type="checkbox" class="'.$dat['cbMarq'].'" value="'.$dat['cbMarq'].'" id="choix"/></td>
										<td>'.$dat['AR_Ref'].'</td>
										<td>'.$dat['DL_Design'].'</td>
										<td><input type="text" onchange="Modification_Qte_2('.$id.')" id="'.$id.'" value='.number_format($dat['DL_Qte'],0,',',' ').' /></td>
										<td>'.number_format($dat['DL_PrixUnitaire'],2,',',' ').'</td>
										<td>'.number_format($dat['DL_Remise01REM_Valeur'],2,',',' ').'%</td>
										<td id="id'.$dat['cbMarq'].'">'.$dat['condition_enlevement'].'</td>
										<td>'.$infostock.'</td>
										<td><a class="modifrow" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></a> 
										<a class="suppression_ligne_2"><i class="fa fa-remove"></i> </a></td>
										</tr>';
										
									}
						
											echo'
								</tbody>
							</table>

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
							<form id="modif_condition2">
							<div id="modif">
							</div>
							</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
								<a class="modifcondition2"  class="btn btn-rounded btn-primary">Valider</a>
							</div>
						</div>
					</div>
				</div><!--.modal-->
							
						</div>
					
	<div class="payment-details">
								<strong>Récapitulatif</strong>
								<table>
									<tr>
										<td>Total Quantité :</td>
										<td>'.$totalqte.'</td>
									</tr>
									<tr>
										<td>Total HT :</td>
										<td>'.number_format($totalht,2,',',' ').'</td>
									</tr>
									<tr>
										<td>Total TTC :</td>
										<td>'.number_format($totalttc,2,',',' ').'</td>
									</tr>
								</table>
							</div>
					<div class="row">
					
						<div class="col-lg-12 clearfix">
							<div class="total-amount">
								<div class="actions">';
								
								if ($DO_Statut==1)
									echo '<a onclick="validation_devis()" class="btn btn-rounded btn-inline">Valider</a>';
								
									
									
									echo '<button  class="btn btn-inline btn-secondary btn-rounded">Imprimer</button>
								</div>
							</div>
						</div>
					</div>
					</div>
	
						</div>
			
					</div>
					<div id="validation"></div>
				</div>
			</section>
</div>
';




	
}	?>			


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
 
/*                showLoadingImage();*/
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
                       /* hideLoadingImage();*/
                    }
                });
            };
</script>


	
<script type="text/javascript">
// Modification Ligne
jQuery('.modifrow').click(function(){
 
		 var y = $(this).closest('tr').attr('id');
		 
		$.ajax({
                    url: "ajax/modification_ligne_2.php?&q="+y,
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
});     </script>

<script type="text/javascript">
// Suppresion Ligne
jQuery('.suppression_ligne_2').click(function(){

// var y = $(this).closest('tr').attr('id');
if (confirm("Voulez vous supprimer cet enregistrement ?") == true) {
	
		    var x = document.getElementById("num_piece").value;
			var y = $(this).closest('tr').attr('class');
			
 
 $.ajax({
                    url: "ajax/suppression_ligne_2.php?&num="+x+"&item="+y,
                    context: document.body,
                    success: function(responseText) {


                        //$("#txtHint22").html(responseText);
                        $("#ligne_devis").html(responseText);

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
// Fonction Modification Condition Devis
jQuery('.modifcondition2').click(function(){
 
  str1=document.forms['modif_condition2'].date_enlevement.value;
  str2=document.forms['modif_condition2'].cbMarq.value;
  
   if (document.forms['modif_condition2'].sur_place.checked == true) {
	   str1='Remis sur place';
  }
   alert (str1);

 $.ajax({
                    url: "ajax/modification_condition_2.php?&q="+str1+"&q2="+str2,
                    context: document.body,
                    success: function(responseText) {


                        //$("#txtHint22").html(responseText);
                        $("#modif").html(responseText);

                    },
                    complete: function() {
						
						var chaine=str2;
                        chaine = chaine.split(";");
                        
						for(var i= 0; i < chaine.length; i++)
                           {
							   if (str1=='Remis sur place')
								   document.getElementById('id'+chaine[i]+'').innerHTML=str1;
							   else
	                               document.getElementById('id'+chaine[i]+'').innerHTML='A Livrer Le '+str1+''; 
                            }

	 
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.
                    }
                });
  // return false;*/
});     </script>

<script>
/*Fonction Validation Devis*/
	
	function validation_devis() {
		    var x = document.getElementById("num_piece").value;

 
/*                showLoadingImage();*/
                $.ajax({
                    url: "ajax/validation_devis.php?q="+x,
                    context: document.body,
                    success: function(responseText) {

                        $("#validation").html(responseText);

                    },
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.

                       /* hideLoadingImage();*/
                    }
                });
            };
</script>

<script type="text/javascript">
// Suppresion list des Lignes
jQuery('.suppression_list_lignes_2').click(function(){
	
	if (confirm("Voulez vous supprimer les lignes ces enregistrements ?") == true) {
	
		    var x = document.getElementById("num_piece").value;
	
	// Ce tableau javascript va stocker les valeurs des checkbox
      var checkbox_val = [];

      // Parcours de toutes les checkbox checkées avec la classe "choix"
      $('#choix:checked').each(function(){
         // Insertion de la valeur de la checkbox dans le tableau checkbox_val
         checkbox_val.push($(this).attr('class'));
      });
	  
	 $.ajax({
                    url: "ajax/suppression_list_lignes_2.php?&num="+x+"&cbMarq="+checkbox_val,
                    context: document.body,
                    success: function(responseText) {

                        //$("#txtHint22").html(responseText);
                        $("#ligne_devis").html(responseText);

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
jQuery('.SelectModif_2').click(function(){

      // Ce tableau javascript va stocker les valeurs des checkbox
      var checkbox_val = [];

      // Parcours de toutes les checkbox checkées avec la classe "choix"
      $('#choix:checked').each(function(){
         // Insertion de la valeur de la checkbox dans le tableau checkbox_val
         checkbox_val.push($(this).val());
      });
      		
			
      $.ajax({ 
		   type: "POST", 
		   url: "ajax/modification_ligne_2.php", 
		   data: { checkbox_val : checkbox_val}, 
		   context: document.body,
		   success: function(data) { 
		        $("#modif").html(data);
			} 
	}); 
  
   });
</script>
<script>	
	function Modification_Qte_2(y) {
		    var Qte = document.getElementById(y).value;
            var x = document.getElementById("num_piece").value;
			
			
		//	if (Number.isInteger(Qte)==true)
		//	{
 
/*                showLoadingImage();*/
                $.ajax({
					
                    url: "ajax/Modification_Qte_2.php?&Qte="+Qte+"&num="+x+"&item="+y,
                    context: document.body,
                    success: function(responseText) {

                        $("#designation").html(responseText);

                    },
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.

                       /* hideLoadingImage();*/
                    }
                });
			//}
			//else 
			//	alert ("Attention, il faut.....");
            };
</script>


<script src="js/app.js"></script>
</body>
</html>