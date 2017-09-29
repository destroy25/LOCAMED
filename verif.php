<?php
if(!isset($_SESSION['compte_login']) || $_SESSION['compte_logged']!='on'){
	
echo "<script type='text/javascript'>document.location.replace('login.php?error=1');</script>";



}

?>