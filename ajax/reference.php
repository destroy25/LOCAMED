<?php
include('../connexion.php');


$ref=$_GET['ref'];
$num=$_GET['num'];
//$designation=0;

             $sql='update f_docentete set DO_Ref=\''.$ref.'\' where do_piece=\''.$num.'\'';
             $rq = odbc_exec($connection,$sql);
                    
				echo '<script>alert("Modification de l\'information avec succès !")</script>';
					

?>