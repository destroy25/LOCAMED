

<?php

include('../connexion.php');


$q=$_GET['q']; //Date
$q2=$_GET['q2']; //CbMarq ID Unique Table F_docligne

if ($q =='Remis sur place')
{
    $condition='Remis sur place';
	
}
else
{
	$condition='A Livrer Le '.$q;
	$dateL=$q;
	
}

$elements = explode(';', $q2);

if (count($elements) ==1)
{
	if ($condition=='Remis sur place')
	{
		$sql="select FORMAT(ent.DO_Date, 'dd/MM/yyyy', 'en-US') as dt from f_docligne as lgn, f_docentete as ent where lgn.DO_Piece=ent.DO_Piece and lgn.CbMarq='".$q2."'";
		                $rq = odbc_exec($connection,$sql);
						if ($rep=odbc_fetch_array($rq)) {
						$dateL=$rep['dt'];
						}
	}
$sql='update f_docligne
set condition_enlevement=\''.$condition.'\', DO_DateLivr=\''.$dateL.'\', statut_livraison=\'En instance de livraison\'
 where cbMarq='.$elements[0];
 odbc_exec($connection,$sql);
 echo 'Mise à jour reussie';
}
elseif (count($elements) >1)
{
	if ($condition == 'Remis sur place')
	{
		$sql="select FORMAT(ent.DO_Date, 'dd/MM/yyyy', 'en-US') as dt from f_docligne as lgn, f_docentete as ent where lgn.DO_Piece=ent.DO_Piece and lgn.CbMarq='".$elements[0]."'";
		                $rq = odbc_exec($connection,$sql);
						if ($rep=odbc_fetch_array($rq)) {
						$dateL=$rep['dt'];
						}
	}
	
	for($ii=0;$ii<count($elements)-1 ;$ii++)
	{
		
		
		$sql='update f_docligne
set condition_enlevement=\''.$condition.'\', DO_DateLivr=\''.$dateL.'\', statut_livraison=\'En instance de livraison\'
 where cbMarq='.$elements[$ii];
 
 
 odbc_exec($connection,$sql);
 
	}
echo 'Mise à jour reussie';
}

?>