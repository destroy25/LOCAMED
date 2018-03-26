<?php
include('../connexion.php');

$query = $_GET['query'].'%'; // add % for LIKE query later

$sql='select do_piece from f_docentete where do_domaine=0 and do_type=0 and de_no='.$_SESSION['depot'].' and do_piece like \''.$query.'\'';
	$json = [];

               $rq = odbc_exec($connection,$sql);
                    while ($rep=odbc_fetch_array($rq)) {
	     $json[] = $rep['do_piece'];
					}



	echo json_encode($json);
	
	
	
	
	
?>