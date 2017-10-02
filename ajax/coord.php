<?php
include('../connexion.php');


$coord=$_GET['coord'];
$num=$_GET['num'];
//$designation=0;

             $sql='update f_docentete set DO_Coord01=\''.$coord.'\' where do_piece=\''.$num.'\'';
             $rq = odbc_exec($connection,$sql);
                    
				echo '<script>alert("Bien Modification de Coord")</script>';
					

?>