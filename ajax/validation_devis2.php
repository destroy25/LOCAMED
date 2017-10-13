

<?php

/*Validation Devis : Changement de Staut DO_Statut */

include('../connexion.php');


$q=$_GET['q']; //Num piece


		$client = new nusoap_client($wsdl,true);
	$err = $client->getError();
	if ($err) 
	{
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
			exit();
	}
	// Exécution de la Methode 
//	$result = $client->call('HelloUser',$theVariable);
	$result = $client->call('validation_devis',
array('num'=>$q,'i'=>$_SESSION['Objet_cnx']));
 
	if ($client->fault) 
	{
		echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
	} 
	else 
	{
		$err = $client->getError();
		if ($err) 
		{
			echo '<h2>Error</h2><pre>' . $err . '</pre>';
		} 
		else
		{
//		echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
//			$do_piece=$result;
//echo $result;
		}
	}


/*$sql='update f_docentete
set DO_Statut=2
 where DO_Piece=\''.$q.'\'';
 odbc_exec($connection,$sql);*/
 
 
 
 
echo "<script type='text/javascript'>document.location.replace('devis.php?q=".$q."');</script>";


?>