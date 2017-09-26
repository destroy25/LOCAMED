<?php

/*Validation Devis : Changement de Staut DO_Statut */

include('../connexion.php');


$q=$_GET['q']; //Num piece


		$sqlligne="update f_docentete set DO_Statut=2 where DO_Piece='".$q."'";
	    odbc_exec($connection,$sqlligne);


/*$sql='update f_docentete
set DO_Statut=2
 where DO_Piece=\''.$q.'\'';
 odbc_exec($connection,$sql);*/
 
 echo '<div class="alert alert-info" role="alert">
							<strong>Succes !</strong><br>
							Document Validé
						</div>';
						
 echo "<script type='text/javascript'>document.location.replace('devis.php?q='".$q.");</script>";

/* echo "<script>	
	function redirection(".$q."){
		    var a =".$q.";
                $.ajax({
					
                    url: 'devis.php?q='+a,
                    context: document.body,
                    complete: function() {
                
                    }
                });
            };
			document.location.replace(redirection(".$q."));
			
</script>";
      */
 


?>