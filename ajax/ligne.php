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
//			$Lig->InfoLibre->Item('Colisage')='Remis sur place';
            $Lig->SetDefault();
            $Lig->Write();					
					
			
} catch (Exception $e) {
    echo 'Exception reçue : ',  utf8_encode($e->getMessage()), "\n";
}


$conn->Close();

$conn = null;

							$sqlligne='update f_docligne set Commentaires=\'Remis sur place\' where DO_Piece=\''.$num_piece.'\' and AR_Ref=\''.$article.'\' and DL_Ligne=(select max(DL_Ligne) from f_docligne where DO_Piece=\''.$num_piece.'\' and AR_Ref=\''.$article.'\') ';
										odbc_exec($connection,$sqlligne);
		
	
	echo '					<div class="col-lg-12">
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
										<th>Action</th>
									</tr>
								</thead>
								<tbody>';
						$totalqte=0;		
						$totalht=0;		
						$totalttc=0;		
								$sqlligne='select * from f_docligne where DO_Piece=\''.$num_piece.'\'';
								    $rqligne = odbc_exec($connection,$sqlligne);
                    while ($repligne=odbc_fetch_array($rqligne)) {
						$totalqte=$totalqte+$repligne['DL_Qte'];
						$totalht=$totalht+$repligne['DL_MontantHT'];
						$totalttc=$totalttc+$repligne['DL_MontantTTC'];
						echo'
									<tr>
										<td>#</td>
										<td>'.$repligne['AR_Ref'].'</td>
										<td>'.$repligne['DL_Design'].'</td>
										<td>'.$repligne['DL_Qte'].'</td>
										<td>'.$repligne['DL_PrixUnitaire'].'</td>
										<td>'.$repligne['DL_Remise01REM_Valeur'].'</td>
										<td>'.$repligne['Commentaires'].'</td>
										<td>Total</td>
									</tr>';
		
					}
						
											echo'
								</tbody>
							</table>
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
									<button class="btn btn-rounded btn-inline">Valider</button>
									<button class="btn btn-inline btn-secondary btn-rounded">Imprimer</button>
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