
<?php

include('../connexion.php');

$num=$_GET['num'];
$item=$_GET['item'];

	$client = new nusoap_client($wsdl,true);
	$err = $client->getError();
	if ($err) 
	{
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
			exit();
	}
	// Exécution de la Methode 
	$result = $client->call('suppression_ligne',
	array('num'=>$num,'Type'=>4,'item'=>$item));
	
	if ($client->fault) 
	{
		echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
	} 
	else 
	{
		$err = $client->getError();
		if ($err) 
		{
			echo '<h2>Error</h2><pre>' . $err . '</pre>';
		} 
		else
		{
			$msg=$result;
			
		}
	}
	
	
		echo '
	<div id="ligne_devis">

<input type="hidden" id="num_piece" value="'.$num.'"/>
	<div class="col-lg-12">
							<table class="table table-bordered">
								<thead>
									<tr>
									    <th width="10"><a class="suppression_list_lignes_retour"><i class="fa fa-remove"></i></a></th>
									    <th>Article</th>
										<th>Désignation</th>
										<th>Quantité</th>
										<th>Prix Unitaire (HT)</th>
										<th>Montant TTC (HT)</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>';
								/*Affichage des Lignes du document */
						$totalqte=0;		//Total Quantité
						$totalht=0;			//Totat HT
						$totalttc=0;		//Tota TTC
						$id=0;
								$sqlligne='select AR_Ref,DL_Design,DL_Qte,DL_PrixUnitaire,DL_Remise01REM_Valeur,DL_MontantHT,DL_MontantTTC,condition_enlevement,cbMarq
								from f_docligne where DO_Piece=\''.$num.'\'';
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
										$id++;
						
						echo'
									<tr id="'.$dat['cbMarq'].'" class="'.$id.'">
										<td><input type="checkbox" class="'.$dat['cbMarq'].'" value="'.$dat['cbMarq'].'" id="choix"/></td>
										<td>'.$dat['AR_Ref'].'</td>
										<td>'.$dat['DL_Design'].'</td>
										<td><input class="form-control" type="text" onchange="Modification_Qte_retour_2('.$id.')" id="'.$id.'" value='.number_format($dat['DL_Qte']*(-1),0,',',' ').' /></td>
										<td>'.number_format($dat['DL_PrixUnitaire'],2,',',' ').'</td>
										<td>'.number_format((($dat['DL_Qte'] * $dat['DL_PrixUnitaire'])-(($dat['DL_Qte'] * $dat['DL_PrixUnitaire']* $dat['DL_Remise01REM_Valeur'])/100)),2,',',' ').'</td>
										
										<td><a class="suppression_ligne_retour"><i class="fa fa-remove"></i> </a></td>
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
							<form id="modif_condition">
							<div id="modif">
							</div>
							</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
								<a class="modifcondition"  class="btn btn-rounded btn-primary">Valider</a>
							</div>
						</div>
					</div>
				</div><!--.modal-->
							
						</div>
					</div>
	<div class="payment-details">
								<strong>Récapitulatif</strong>
								<table>
									<tr>
										<td>Total Quantité :</td>
										<td>'.($totalqte*(-1)).'</td>
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
								<div class="actions">
									<a href="impression_retour.php?q='.$num.'" class="btn btn-inline btn-secondary btn-rounded">Imprimer</a>
								</div>
							</div>
						</div>
					</div>
					</div>
	

						</div>
			
					</div>
				</div>
			</section>

';




	
	?>			


		
	
	
	<script type="text/javascript">
// Suppresion Ligne retour
jQuery('.suppression_ligne_retour').click(function(){

// var y = $(this).closest('tr').attr('id');
if (confirm("Voulez vous supprimer cet enregistrement ?") == true) {
	
		    var x = document.getElementById("num_piece").value;
			var y = $(this).closest('tr').attr('class');
 
 $.ajax({
                    url: "ajax/suppression_ligne_retour_2.php?&num="+x+"&item="+y,
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
// Suppresion list des Lignes
jQuery('.suppression_list_lignes_retour').click(function(){
	
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
                    url: "ajax/suppression_list_lignes_retour_2.php?&num="+x+"&cbMarq="+checkbox_val,
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

<script>	
	function Modification_Qte_retour_2(y) {
		    var Qte = document.getElementById(y).value; 
			
            var x = document.getElementById("num_piece").value;
		
			
			
			if (Qte>0)
			{

				Qte=Qte*(-1);
 
/*                showLoadingImage();*/
                $.ajax({
					
                    url: "ajax/Modification_Qte_retour_2.php?&Qte="+Qte+"&num="+x+"&item="+y,
                    context: document.body,
                    success: function(responseText) {

                         $("#ligne_devis").html(responseText);

                    },
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.

                       /* hideLoadingImage();*/
                    }
                });
			}
			else 
				alert ("Attention, vérifier la Quantité");
            };
</script>
