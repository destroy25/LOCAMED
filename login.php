<?php include('connexion.php');

if (isset($_POST['MM_Insert'])) {
	
	
	
		/*Login */
	$client = new nusoap_client($wsdl,true);
	$err = $client->getError();
	if ($err) 
	{
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
			exit();
	}
	// Exécution de la Methode : Création Document
	$souche='N° Pièce';
	$result = $client->call('connexion_om');
 
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
//			echo $result;
		}
	}
	
 // $loginUsername=mysql_real_escape_string($_POST['login']);
  
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginFailed = "login.php?error=2";
  $MM_redirecttoReferrer = true;
 // mysql_select_db($database, $db);
  
  
  
  //$LoginRS__query=sprintf("SELECT * FROM compte WHERE login = %s AND mdp = %s ",
    //GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
	
	$sql='SELECT * FROM INTERFACE_USER WHERE login =\''.$_POST['login'].'\' AND mdp = \''.md5($_POST['mdp']).'\'';
	
		                $rq = odbc_exec($connection,$sql);
	

  
//  $LoginRS = mysql_query($sql, $database) or die(mysql_error()) ;
  //$loginFoundUser = mysql_num_rows($LoginRS);
  
		$i=0;
			if ($row=odbc_fetch_array($rq)) {


		$i=1;
	
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
	$_SESSION['compte_logged']='on';
    $_SESSION['compte_login'] = $row['login'];
    $_SESSION['compte_profil'] = $row['id_profil'];
    $_SESSION['depot'] = $row['depot'];

	
	/*Evenement Historique - */


/*Fin Evenement Historique*/
	
	
	
	
	
		 $MM_redirectLoginSuccess = "index.php";

  

  }
  
  if($i)
  {
	  header("Location: " . $MM_redirectLoginSuccess );
  }
  else
  {
	  header("Location: ". $MM_redirectLoginFailed );
  }
	  
      
  /*else 
    header("Location: ". $MM_redirectLoginFailed );*/
  
}


?>


<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>LOCAMED</title>

	<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="img/favicon.png" rel="icon" type="image/png">
	<link href="img/favicon.ico" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
<link rel="stylesheet" href="css/separate/pages/login.min.css">
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

    <div class="page-center">
        <div class="page-center-in">

		<div class="container-fluid">
                <form class="sign-box" action="login.php" method="post">
                    <div class="sign-avatar">
                        <img src="img/avatar-sign.png" alt="">
                    </div>
                    <header class="sign-title">INTERFACE LOCAMED</header>
                    <div class="form-group">
                        <input name="login" type="text" class="form-control" placeholder="Login"/>
                    </div>
                    <div class="form-group">
                        <input name="mdp" type="password" class="form-control" placeholder="Mot de Passe"/>
                    </div>
                    <!--<div class="form-group">
                        <div class="checkbox float-left">
                            <input type="checkbox" id="signed-in"/>
                            <label for="signed-in">Keep me signed in</label>
                        </div>
                        <div class="float-right reset">
                            <a href="reset-password.html">Reset Password</a>
                        </div>
                    </div>-->
						  <input type="hidden" name="MM_Insert" />

                    <input type="submit" class="btn btn-rounded" value="Connexion">
<!--                    <p class="sign-note">New to our website? <a href="sign-up.html">Sign up</a></p>-->
                    <!--<button type="button" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>-->
					
							  	            <?php if(isset($_GET['error']) && $_GET['error']==2){
				echo'<div class="alert alert-danger" style="text-align:center;">
                <p>Login ou mot de passe incorrect !</p>
            </div>';}?>
			            <?php if(isset($_GET['error']) && $_GET['error']==1){
				echo'<div class="alert alert-danger" style="text-align:center;">
                <p>Merci de vous identifier !</p>
            </div>';}?>

					
                </form>
            </div>
        </div>
    </div><!--.page-center-->


<script src="js/lib/jquery/jquery.min.js"></script>
<script src="js/lib/tether/tether.min.js"></script>
<script src="js/lib/bootstrap/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
    <script type="text/javascript" src="js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>
<script src="js/app.js"></script>
</body>
</html>