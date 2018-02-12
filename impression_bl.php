<?php 
include('connexion.php');
require_once('TCPDF-master/tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Bon de livraison - LOCAMED');
$pdf->SetHeaderData('', '', 'Bon de Livraison - LOCAMED', PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetMargins(PDF_MARGIN_LEFT, 5, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('dejavusans', '', 14);

$pdf->AddPage();
      $content = '
	  <style>
	  div.Totaux {
		position: absolute;
        top: 0px;
        right: 0;
        width: 300px;
        height: 200px;
		text-align: right;
       
    }
	div.rec {
		position: absolute;
        top: 0px;
        right: 100;
		left:900;
        width: 300px;
        height: 200px;
		text-align: left;
       
    }
	img.hidden-md-down {
        top: 0px;
        right: 100;
        width: 200px;
        height: 70px;
		margin-right:0px;
		margin-left:300px;
    }
	
	table.table {
        border-collapse:collapse;
        width:90%;
		text-align:center;
        }
    th.t2{
        border:1px solid black;
        width:20%;
		text-align:center;
        }
    td .t2{
		border:1px solid black;
        width:20%;
        text-align:center;
		
        }
		
	div#conteneur{
	
        width:300px; 
        margin-top:20px; 
        padding-bottom:25px; 
        padding-top:5px;
       }
 
    p#colonne1{
        width:140px; 
        height:100px; 
        float:left;
       }
 
    p#colonne2{
        width:140px; 
        height:100px;  
        float:right;
       }

	
	 </style>';  
     
	 
  if(isset($_GET['q']))
{
	$q=$_GET['q'];	

				

$sql='select distinct(DL_PieceBL) as BL,DO_Piece as Facture,f_docligne.CT_Num,DO_Date,condition_enlevement,DO_DateLivr from f_docligne 
						inner join f_comptet on f_docligne.ct_num=f_comptet.ct_num where do_type=6 and DL_PieceBL=\''.$q.'\'';

				                    $rq = odbc_exec($connection,$sql);
                    if ($rep=odbc_fetch_array($rq)) {
						$date=$rep['DO_Date'];
						$client1=$rep['CT_Num'];
						$DateLivr=$rep['DO_DateLivr'];
						
						$date2 = date_create($date);
$date= date_format($date2, 'd/m/Y');
		
					}
					
$sqlclient="select * from f_comptet where CT_Num='".$client1."'";

				                    $rqclient = odbc_exec($connection,$sqlclient);
                    if ($repclient=odbc_fetch_array($rqclient)) {
						$intitule_client=$repclient['CT_Intitule'];
						$adresse_client=$repclient['CT_Adresse'];
						$complement_client=$repclient['CT_Complement'];
						$ville_client=$repclient['CT_Ville'];
		
					}
					
function int2str($a){ 
$joakim = explode('.',$a); 
if (isset($joakim[1]) && $joakim[1]!=''){ 
return int2str($joakim[0]).' Dirhams '.int2str($joakim[1]).' Centimes.' ; 
} 

if ($a<0) return 'moins '.int2str(-$a); 
if ($a<17){ 
switch ($a){ 
case 0: return 'Zero'; 
case 1: return 'Un'; 
case 2: return 'Deux'; 
case 3: return 'Trois'; 
case 4: return 'Quatre'; 
case 5: return 'Cinq'; 
case 6: return 'Six'; 
case 7: return 'Sept'; 
case 8: return 'Huit'; 
case 9: return 'Neuf'; 
case 10: return 'Dix'; 
case 11: return 'Onze'; 
case 12: return 'Douze'; 
case 13: return 'Treize'; 
case 14: return 'Quatorze'; 
case 15: return 'Quinze'; 
case 16: return 'Seize'; 
} 
} else if ($a<20){ 
return 'dix-'.int2str($a-10); 
} else if ($a<100){ 
if ($a%10==0){ 
switch ($a){ 
case 20: return 'Vingt'; 
case 30: return 'Trente'; 
case 40: return 'Quarante'; 
case 50: return 'Cinquante'; 
case 60: return 'Soixante'; 
case 70: return 'Soixante-Dix'; 
case 80: return 'Quatre-Vingt'; 
case 90: return 'Quatre-Vingt-Dix'; 
} 
} elseif (substr($a, -1)==1){ 
if( ((int)($a/10)*10)<70 ){ 
return int2str((int)($a/10)*10).'-et-un'; 
} elseif ($a==71) { 
return 'Soixante et onze'; 
} elseif ($a==81) { 
return 'Quatre vingt un'; 
} elseif ($a==91) { 
return 'Quatre vingt onze'; 
} 
} elseif ($a<70){ 
return int2str($a-$a%10).'-'.int2str($a%10); 
} elseif ($a<80){ 
return int2str(60).'-'.int2str($a%20); 
} else{ 
return int2str(80).'-'.int2str($a%20); 
} 
} else if ($a==100){ 
return 'Cent'; 
} else if ($a<200){ 
return int2str(100).' '.int2str($a%100); 
} else if ($a<1000){ 
return int2str((int)($a/100)).' '.int2str(100).' '.int2str($a%100); 
} else if ($a==1000){ 
return 'Mille'; 
} else if ($a<2000){ 
return int2str(1000).' '.int2str($a%1000).' '; 
} else if ($a<1000000){ 
return int2str((int)($a/1000)).' '.int2str(1000).' '.int2str($a%1000); 
} 
}				

 $content .=  '			

				<div class="row">
		
					</div>
				</div>


							<section class="card">
				<header class="card-header card-header-lg">
        <img class="hidden-md-down" src="img/logo-2.png" alt="">
	    	
				</header>
				<div>
					<div id="conteneur">
						<p id="colonne1">
						<h4>Client</h4>
							<h5>'.$client1.'</h5>
							
								'.utf8_encode($adresse_client).'
								'.utf8_encode($complement_client).'
								'.utf8_encode($ville_client).'
													
						</p>
						<p style="float:right;" id="colonne2">
								<h5>Bon de Livraison #'.$q.'</h5>
								Date Document : '.$date.'<br>
								Date de livraison: '.$DateLivr.'
								<p><img style="margin-top:20px;height:30px;"  src="http://localhost:8080/interface_locamed/trunk/barcode128.php?text='.$q.'"/></p>
						</p>
					</div>
					
					
					

			                            
                    <div id="ligne_devis">

<input type="hidden" id="num_piece" value="'.$q.'"/>
	<div class="col-lg-12">
							<table class="table">
								<thead>
									<tr class="t3">
										<th class="t3">Article</th>
										<th class="t3">Désignation</th>
										<th class="t3">Quantité</th>
									</tr>
								</thead>
								';
								/*Affichage des Lignes du document */
						$totalqte=0;		//Total Quantité
						$totalht=0;			//Totat HT
						$totalttc=0;		//Tota TTC
								$sqlligne='select AR_Ref,DL_Design,DL_Qte,DL_PrixUnitaire,DL_Remise01REM_Valeur,DL_MontantHT,DL_MontantTTC,cbMarq
								from f_docligne where DL_PieceBL=\''.$q.'\'';
								    $rqligne = odbc_exec($connection,$sqlligne);
									while ($data[] = odbc_fetch_array($rqligne));
									
									
									$val=count($data);
									$val2=0;
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
						
						 $content .=  '<tbody class="table">
									<tr id="'.$dat['cbMarq'].'" >
										
										<td class="t2" style="border:1px solid black" >'.$dat['AR_Ref'].'</td>
										<td class="t2" style="border:1px solid black" >'.$dat['DL_Design'].'</td>
										<td class="t2" style="border:1px solid black" >'.number_format($dat['DL_Qte'],0,',',' ').'</td>
										
									</tr>';
										
									}
									//exec fonction int2str
									$nombre=15.17;
                                    $a = explode('.',$totalttc);
                                    if (!isset($a[1]))
                                    $chiffre=int2str($totalttc).' Dirhams '; 
                                    else
                                    $chiffre=int2str($totalttc);
						
											 $content .=  '
								</tbody>
							</table>

							
						</div>
					
	<div class="payment-details">
					<div class="rec"><strong>Récapitulatif</strong> </div>
					<div class="Totaux">
								<table>
									<tr>
										<td>Total Quantité :</td>
										<td>'.$totalqte.'</td>
									</tr>
<!--									<tr>
										<td>Total HT :</td>
										<td>'.number_format($totalht,2,',',' ').'</td>
									</tr>
									<tr>
										<td>Total TTC :</td>
										<td>'.number_format($totalttc,2,',',' ').'<br> '.$chiffre.'</td>
									</tr>-->
								</table>
							</div>
							</div>
					
					</div>
	
						</div>
			
					</div>
				</div>
			</section>

';


     
     
      $pdf->writeHTML($content);  
      $pdf->Output('sample.pdf', 'I');




	
}	?>			

  

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


	<div >
	
			<div class="container-fluid">
			


			
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


	<script>
/*Fonction Validation Devis*/
	
	function validation_devis() {
		    var x = document.getElementById("num_piece").value;

 
/*                showLoadingImage();*/
                $.ajax({
                    url: "ajax/validation_devis.php?q="+x,
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