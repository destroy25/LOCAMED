<?php

include('../connexion.php');

if(isset($_GET['q']))
{

// Récuperation Données
$num_piece=$_GET['piece'];
$article=$_GET['article'];
$qte=$_GET['quantity'];

/* Début Execution Objéts métiers SAGE */

	$client = new nusoap_client($wsdl,true);
	$err = $client->getError();
	if ($err) 
	{
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
			exit();
	}
	// Exécution de la Methode Ligne Document : Voir Documentaion OM
	$result = $client->call('ligne_document',
	array('num'=>$num_piece,'type'=>4,'article'=>$article,'qte'=>$qte));
 
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
//		echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
			$msg=$result;
		}
	}

/* Fin Execution Objéts métiers SAGE */
	
		
	
	echo '
	<input type="hidden" id="num_piece" value="'.$num_piece.'"/>
<div id="modif1" >
	<div class="col-lg-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="10"><a class="suppression_list_lignes_retour"><i class="fa fa-remove"></i></a></th>
										<th>Article</th>
										<th>Désignation</th>
										<th width="105">Quantité</th>
										<th>Prix Unitaire</th>
										<th>Montant HT</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>';
						$totalqte=0;		
						$totalht=0;		
						$totalttc=0;	
                        $id=0;						
								$sqlligne='select * from f_docligne where DO_Piece=\''.$num_piece.'\'';
								    $rqligne = odbc_exec($connection,$sqlligne);
                    while ($repligne=odbc_fetch_array($rqligne)) {
						$id++;
						$totalqte=$totalqte+($repligne['DL_Qte']*(-1));
						$totalht=$totalht+$repligne['DL_MontantHT'];
						$totalttc=$totalttc+$repligne['DL_MontantTTC'];
						echo'
									<tr id="'.$repligne['cbMarq'].'" class="'.$id.'">
										<td><input type="checkbox" class="'.$repligne['cbMarq'].'" value="'.$repligne['cbMarq'].'" id="choix"/></td>
										<td>'.$repligne['AR_Ref'].'</td>
										<td>'.$repligne['DL_Design'].'</td>

										<td><input class="form-control" type="text" onchange="Modification_Qte_retour('.$id.')" id="'.$id.'" value='.number_format($repligne['DL_Qte']*(-1),0,',',' ').' /></td>
						                <td>'.number_format($repligne['DL_PrixUnitaire'],2,',',' ').'</td>
										<td>'.number_format($repligne['DL_MontantHT'],2,',',' ').'</td>
			                            <td><a class="suppression_ligne_retour"><i class="fa fa-remove"></i> </a></td>
									</tr>';
		
					}
						
											echo'
								</tbody>
							</table>
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
								<div class="actions">
									<a  href="impression_retour.php?q='.$num_piece.'" class="btn btn-inline btn-secondary btn-rounded">Imprimer</a>
								</div>
							</div>
						</div>
					</div>
					
					</div>';
	
	
	
}

?>




                <script type="text/javascript">
// Suppresion Ligne retour
jQuery('.suppression_ligne_retour').click(function(){

// var y = $(this).closest('tr').attr('id');
if (confirm("Voulez vous supprimer cet enregistrement ?") == true) {
	
		    var x = document.getElementById("num_piece").value;
			var y = $(this).closest('tr').attr('class');
 
 $.ajax({
                    url: "ajax/suppression_ligne_retour.php?&num="+x+"&item="+y,
                    context: document.body,
                    success: function(responseText) {


                        //$("#txtHint22").html(responseText);
                        $("#modif1").html(responseText);

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
                    url: "ajax/suppression_list_lignes_retour.php?&num="+x+"&cbMarq="+checkbox_val,
                    context: document.body,
                    success: function(responseText) {


                        //$("#txtHint22").html(responseText);
                        $("#modif1").html(responseText);

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
	function Modification_Qte_retour(y) {
		    var Qte = document.getElementById(y).value; 
			
            var x = document.getElementById("num_piece").value;
			
			if (Qte>0)
			{

				Qte=Qte*(-1);
 
/*                showLoadingImage();*/
                $.ajax({
					
                    url: "ajax/Modification_Qte_retour.php?&Qte="+Qte+"&num="+x+"&item="+y,
                    context: document.body,
                    success: function(responseText) {

                         $("#modif1").html(responseText);

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

