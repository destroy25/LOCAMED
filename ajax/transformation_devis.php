

<?php

/*Validation Devis : Changement de Staut DO_Statut */

include('../connexion.php');



/*Chaine de connexion*/		
$conn = new COM('Objets100.Cial.Stream.3') or die("Impossible de démarrer");
$nom=$conn->Name = "C:\wamp\www\Sage\BIJOU.gcm";
$user=$conn->loggable->userName="<Administrateur>";
$mdp=$conn->loggable->userPwd="";
$conn->Open();


$q=$_GET['q']; //Num piece

$sql='select distinct(condition_enlevement) as condition from f_docligne where DO_Piece=\''.$q.'\'';
$condition[]='';
		                $rq = odbc_exec($connection,$sql);
						while ($rep=odbc_fetch_array($rq)) {
						$condition[]=$rep['condition'];	
						}

foreach($condition as $cond)
{

if ($conn->IsOpen) 
{
	
	//echo "Commerciale ouverte '$nom' \n";

	
	
	try {

		
	//echo "compta ouverte '$nom' \n";

//            Ent = base.FactoryDocumentAchat.CreateType(DocumentType.DocumentTypeAchatFacture)

//	$Ent = $conn->FactoryDocumentVente->createType(20);
	//$Frs = $conn->CptaApplication->FactoryTiers->readNumero("BAGUES");
	
	
	
//	echo $_GET['client'];
		$Ent = $conn->FactoryDocumentVente->CreateType(30);
		$Clt = $conn->CptaApplication->FactoryClient->ReadNumero('BAGUES');
		$Ent->SetDefaultClient($Clt);
		            //$Ent->Souche = $conn->FactorySoucheVente->ReadIntitule('N° pièce');
					$Ent->SetDefaultDO_Piece();
					$Ent->SetDefault();
					$Ent->Write();
					$Ent->CouldModified();
					
					$do_piece=$Ent->DO_Piece();

					
				//$DOC_ORIG1 = $conn->FactoryDocumentVente->ReadPiece(10, $do_piece);
				$PROC_TRANS = $conn->Transformation->Vente->CreateProcess_Livrer;
					
	echo $cond.'<br/>';
	$sqlc='select * from f_docligne where do_piece=\''.$q.'\' and condition_enlevement=\''.$cond.'\'';
   $rq = odbc_exec($connection,$sqlc);
						
					while ($rep=odbc_fetch_array($rq)) {
				echo $rep['AR_Ref'].' '.$rep['DL_Ligne'].'<br/>';

				$Ligne=$rep['DL_Ligne']/1000;
				
				echo $Ligne;
				


                $X = $DOC_ORIG1->FactoryDocumentLigne->List->Item($Ligne);

				
				


$PROC_TRANS->AddDocumentLigne($X);

                
				
				
					}

                $DOC_FINAL = $conn->FactoryDocumentVente->ReadPiece(30, "BL00011");

				$PROC_TRANS->AddDocumentDestination($DOC_FINAL);



//$PROC_TRANS->Process();                
					
					
		
	//	echo 'Transofrmation Reussie';

	
} catch (Exception $e) {
	echo'
	<div class="alert alert-danger alert-icon alert-close alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<i class="font-icon font-icon-warning"></i>
							Exception reçue : '.utf8_encode($e->getMessage()).' "\n"
						</div>';

}
}
				
	
	


}				
				//print_r($condition);

 
 


?>