<?php
include('connexion.php');

if (!isset($_SESSION)) session_start();
    $_SESSION['compte_logged']=NULL;
    $_SESSION['comptelogin']=NULL;
	$_SESSION['compte_profil'] = NULL;
    unset($_SESSION['compte_logged']);
    unset($_SESSION['comptelogin']);
    unset($_SESSION['compte_profil']);
    session_destroy();
//    unset($_COOKIE['page']);
  //  setcookie("page",$page,-1);  // on l'envoi
    
	
	
		/*Delog */
	$client = new nusoap_client($wsdl,true);
	$err = $client->getError();
	if ($err) 
	{
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
			exit();
	}
	// Exécution de la Methode : Création Document
	$result = $client->call('deconnexion_om');
 
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
	//	echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
			echo $result;
		}
	}
	
	
header("Location: login.php");

	
		
	
	?>