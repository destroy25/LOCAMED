<?php
include('../connexion.php');

$q=$_GET['q'];


//$designation=0;
$sqlinfo='update F_DOCENTETE set DO_Statut=1 where DO_Piece=\''.$q.'\'';

		                $rqinfo = odbc_exec($connection,$sqlinfo);
						
						echo "<script type='text/javascript'>alert('Document annulé avec succès');</script>";
						
						
						echo "<script type='text/javascript'>document.location.replace('list_devis.php');</script>";
							
						
						echo '<div class="alert alert-info" role="alert">
							<strong>Succes !</strong><br>
							Document annulé avec succès
						</div>';
	
?>
