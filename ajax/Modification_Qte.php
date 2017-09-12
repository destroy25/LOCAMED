<?php
include('../connexion.php');

$Qte=$_GET['Qte'];
$num=$_GET['num'];
$item=$_GET['item'];

//$designation=0;
$client = new nusoap_client($wsdl,true);
	$err = $client->getError();
	if ($err) 
	{
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
			exit();
	}
	// Exécution de la Methode 
	$result = $client->call('Modification_Qte',
	array('num'=>$num,'type'=>0,'item'=>$item,'Qte'=>$Qte));
 
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
			$msg=$result;
			echo '<script>alert("la Quantité est Bien Modifier")</script>';
		}
	}

?>