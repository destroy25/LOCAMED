

<?php

include('../connexion.php');


$q=$_GET['q']; //Date
$q2=$_GET['q2']; //CbMarq ID Unique Table F_docligne

$condition='A Livrer Le '.$q;

$sql='update f_docligne
set condition_enlevement=\''.$condition.'\',statut_livraison=\'En instance de livraison\'
 where cbMarq='.$q2;
 odbc_exec($connection,$sql);
 
 echo 'Mise à jour reussie';
 
 


?>