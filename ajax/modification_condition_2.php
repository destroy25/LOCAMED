

<?php

include('../connexion.php');


$q=$_GET['q']; //Date
$q2=$_GET['q2']; //CbMarq ID Unique Table F_docligne

if ($q =='Remis sur place')
{
    $condition='Remis sur place';
	$dateL=date("d-m-Y");
	
}
else
{
	$condition='A Livrer Le '.$q;
	$dateL=$q;
	
}

$elements = explode(';', $q2);

if (count($elements) ==1)
{
$sql='update f_docligne
set condition_enlevement=\''.$condition.'\', DO_DateLivr=\''.$dateL.'\', statut_livraison=\'En instance de livraison\'
 where cbMarq='.$elements[0];
 odbc_exec($connection,$sql);
 echo 'Mise à jour reussie';
}
elseif (count($elements) >1)
{
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