<?php

if (!isset($_SESSION)) session_start();



 /* $expire = 3600; // on définit la durée du cookie, 1 jour
    $page = substr($_SERVER['PHP_SELF'],10);
    if(substr($page, 0,4)!='ajax' and substr($page, 0,4)!='expor' and substr($page, 0,4)!='logi' ){
        setcookie("page",$page,time()+$expire);  // on l'envoi
    }*/

   // $bdd = new PDO('mysql:host=localhost;dbname=locamed_bdd', 'root', '');

    $server='localhost';
    $user='sa';
    $password='sage';
  
	 $connection = odbc_connect("Driver={SQL Server Native Client 11.0};Server=$server;Database=BIJOU", $user, $password,SQL_CUR_USE_ODBC);
	 
	  
	  // Lib nusoap
require_once('nusoap-0.9.5/lib/nusoap.php');
$wsdl = "http://localhost/WEBSERVICE_LOCAMED/Service1.asmx?wsdl";
//$wsdl = "http://localhost/OM_LOCAMED/Service1.asmx?wsdl";
//ini_set("soap.wsdl_cache_enabled", 0);



?>