

<?php


include('../connexion.php');



$q=$_GET['q']; //Num piece


$sqlinfo='select DO_Tiers,do_piece,S_Intitule from f_docentete inner join
P_SOUCHEVENTE on F_DOCENTETE.DO_Souche=(P_SOUCHEVENTE.cbIndice-1) where do_piece=\''.$q.'\'';
		                $rqinfo = odbc_exec($connection,$sqlinfo);
						if ($repinfo=odbc_fetch_array($rqinfo)) {
						$souche=$repinfo['S_Intitule'];
						$client1=$repinfo['DO_Tiers'];
						$devis=$repinfo['do_piece'];
						
						}

						
						/*Mise à Zero des livraisons*/
						$sqlup='update f_docligne
						set DL_QteBC=0
						 where do_piece=\''.$q.'\'';
						odbc_exec($connection,$sqlup);

$sql='select distinct(condition_enlevement) as condition from f_docligne where DO_Piece=\''.$q.'\'';
//$condition[]='';
		                $rq = odbc_exec($connection,$sql);
						while ($rep=odbc_fetch_array($rq)) {
						$condition[]=$rep['condition'];	
						}
						
				
	$client = new nusoap_client($wsdl,true);
	$err = $client->getError();
			
	// Création Facture
	$result = $client->call('creation_facture',
	array('num'=>$client1,'souche'=>$souche));
 
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
			$facture=$result;
		}
	}

	foreach($condition as $cond)
	{
	
	
		$client = new nusoap_client($wsdl,true);
		$err = $client->getError();
	
		// Création BL
		$result = $client->call('creation_bl',
		array('num'=>$client1,'souche'=>$souche));
		if ($err) 
		{
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
			exit();
		}
 
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
			$bl=$result;
			}
		}
	
	
							$sqlup2='update f_docligne
						set DL_QteBC=DL_Qte
						where do_piece=\''.$q.'\' and condition_enlevement=\''.$cond.'\'';
						odbc_exec($connection,$sqlup2);


	
		$client = new nusoap_client($wsdl,true);
	$err = $client->getError();
	if ($err) 
	{
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
			exit();
	}
		
					
	//echo $bl.' '.$cond.'<br/>';
	
	
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
	$result = $client->call('transformation_ligne',
	array('bl'=>$bl,'devis'=>$devis,'item'=>1));
 
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
		//echo 'Transformation : '. $result;
		
		}
	}
	
	
	
	
	
	
			$client2 = new nusoap_client($wsdl,true);
	$err = $client2->getError();
	if ($err) 
	{
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			echo '<h2>Debug</h2><pre>' . htmlspecialchars($client2->getDebug(), ENT_QUOTES) . '</pre>';
			exit();
	}
//	echo 'bl : '.$bl;
	//echo 'Facture : '.$facture;
	
	// Exécution de la Methode 
//	$result = $client->call('HelloUser',$theVariable);
	$result2 = $client2->call('transformation_bl_facture',
	array('bl'=>$bl,'facture'=>$facture));
 
	if ($client2->fault) 
	{
		echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result2); echo '</pre>';
	} 
	else 
	{
		$err = $client2->getError();
		if ($err) 
		{
			echo '<h2>Error</h2><pre>' . $err . '</pre>';
		} 
		else
		{
		//		echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
		//			$do_piece=$result;
	//	echo 'Erreur test '.$result2;
		}
	}
}

 //echo "<script type='text/javascript'>alert('Succes ! Document transformé avec succès');</script>";
							


 
echo "<script type='text/javascript'>document.location.replace('list_devis.php');</script>";

				

	
 
 


?>