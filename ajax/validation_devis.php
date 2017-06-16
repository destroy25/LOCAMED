

<?php

/*Validation Devis : Changement de Staut DO_Statut */

include('../connexion.php');


$q=$_GET['q']; //Num piece


$sql='update f_docentete
set DO_Statut=2,DO_Cloture=1
 where DO_Piece=\''.$q.'\'';
 odbc_exec($connection,$sql);
 
 echo '<div class="alert alert-info" role="alert">
							<strong>Succes !</strong><br>
							Document Validé
						</div>';
 
 


?>