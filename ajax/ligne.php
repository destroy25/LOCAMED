<?php

include('../connexion.php');

if(isset($_GET['q']))
{

$num_piece=$_GET['piece'];
$article=$_GET['article'];
$qte=$_GET['quantity'];

/*Chaine de connexion*/		
$conn = new COM('Objets100.Cial.Stream.3') or die("Impossible de démarrer");
$nom=$conn->Name = "C:\wamp\www\Sage\BIJOU.gcm";
$user=$conn->loggable->userName="<Administrateur>";
$mdp=$conn->loggable->userPwd="";
$conn->Open();

if ($conn->IsOpen) 
{
	
	try {

 $Ent = $conn->FactoryDocumentVente->ReadPiece(0, $num_piece);
            $Ent->CouldModified();

            $Lig = $Ent->FactoryDocumentLigne->Create;
            $Lig->SetDefaultArticleReference($article,$qte);
            $Lig->SetDefault();
            $Lig->Write();					
					
			
} catch (Exception $e) {
	echo'
	
	
	
	<div class="alert alert-danger alert-icon alert-close alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<i class="font-icon font-icon-warning"></i>
							Exception reçue : '.utf8_encode($e->getMessage()).' 
						</div>';

}


$conn->Close();

$conn = null;

							$sqlligne='update f_docligne set condition_enlevement=\'Remis sur place\' where DO_Piece=\''.$num_piece.'\' and AR_Ref=\''.$article.'\' and DL_Ligne=(select max(DL_Ligne) from f_docligne where DO_Piece=\''.$num_piece.'\' and AR_Ref=\''.$article.'\') ';
										odbc_exec($connection,$sqlligne);
	
	echo '			
<input type="hidden" id="num_piece" value="'.$num_piece.'"/>
	<div class="col-lg-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="10">#</th>
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
								from f_docligne where DO_Piece=\''.$num_piece.'\'';
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
						$rqstock = odbc_exec($connection2,$sqlstock);
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
						
						echo'
									<tr id="'.$dat['cbMarq'].'" >
										<td>#</td>
										<td>'.$dat['AR_Ref'].'</td>
										<td>'.$dat['DL_Design'].'</td>
										<td>'.number_format($dat['DL_Qte'],2,',',' ').'</td>
										<td>'.number_format($dat['DL_PrixUnitaire'],2,',',' ').'</td>
										<td>'.number_format($dat['DL_Remise01REM_Valeur'],2,',',' ').'%</td>
										<td id="id'.$dat['cbMarq'].'">'.$dat['condition_enlevement'].'</td>
										<td>'.$infostock.'</td>
										<td><a class="modifrow" href="#" data-toggle="modal"data-target="#myModal"><i class="fa fa-pencil"></i></a> <a href="#"><i class="fa fa-remove"></i> </a></td>
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
								<button class="modifcondition" type="button" class="btn btn-rounded btn-primary">Valider</button>
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
									<a href="list_devis.php" class="btn btn-rounded btn-inline">Fin de Saisie</a>
									<a onclick="validation_devis()" class="btn btn-rounded btn-inline">Valider</a>
									<button  class="btn btn-inline btn-secondary btn-rounded">Imprimer</button>
								</div>
							</div>
						</div>
					</div>
					</div>';
	
	
	
	
	
	}
else 
{
	echo "Erreur d ouverture \n";
}

}

?>



                <script type="text/javascript">
// delete row in a table
jQuery('.modifrow').click(function(){
 
		 var y = $(this).closest('tr').attr('id');
//		 var x = $(this).closest('tr').attr('id');
 
 $.ajax({
                    url: "ajax/modification_ligne.php?&q="+y,
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
  // return false;
});     </script>





                <script type="text/javascript">
// delete row in a table
jQuery('.modifcondition').click(function(){
 
  str1=document.forms['modif_condition'].date_enlevement.value;
  str2=document.forms['modif_condition'].cbMarq.value;

 
 $.ajax({
                    url: "ajax/modification_condition.php?&q="+str1+"&q2="+str2,
                    context: document.body,
                    success: function(responseText) {


                        //$("#txtHint22").html(responseText);
                        $("#modif").html(responseText);

                    },
                    complete: function() {
						
	 document.getElementById('id'+str2+'').innerHTML='A Livrer Le '+str1+''; 
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.
                    }
                });
  // return false;*/
});     </script>


	<script>

	
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