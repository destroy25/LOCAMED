<?php
include('../connexion.php');

$query = $_GET['query'].'%'; // add % for LIKE query later

$sql='select ar_ref from f_article where ar_ref like \''.$query.'\'';
	$json = [];

               $rq = odbc_exec($connection,$sql);
                    while ($rep=odbc_fetch_array($rq)) {
	     $json[] = $rep['ar_ref'];
					}



	echo json_encode($json);
	
	
	
	
	
?>