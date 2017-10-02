<?php 
include('../connexion.php');



if(isset($_GET['q']))
{
	$q=$_GET['q'];	
	if($q==1)
	{
		
	$client1=$_GET['client'];
//die($client);
	$souche=$_GET['souche'];
	
	$sqlsouche='select * from P_SOUCHEVENTE where CbIndice='.$souche;
				                    $rq = odbc_exec($connection,$sqlsouche);
                    if ($rep=odbc_fetch_array($rq)) {
						$souche=$rep['S_Intitule'];
					}
					
	$sqldepot='select * from f_depot where de_no='.$_SESSION['depot'];
				                    $rqdepot = odbc_exec($connection,$sqldepot);
                    if ($repdepot=odbc_fetch_array($rqdepot)) {
						$depot=$repdepot['DE_Intitule'];
					}					
					
					
						$client = new nusoap_client($wsdl,true);
	$err = $client->getError();
	if ($err) 
	{
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
			exit();
	}
	// Exécution de la Methode 
	/*$result = $client->call('creation_document',
	array('num'=>$client1,
	'souche'=>$souche,
	'type'=>0,
	'depot'=>$depot
	));*/
	
	$result = $client->call('creation_devis',
	array('num'=>$client1,
	'souche'=>$souche
	));
 
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
		//echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
			$do_piece=$result;
		}
	}
	
//echo htmlspecialchars($do_piece);	
					
					
	
	
	
	


$sql='select * from F_Docentete where DO_Piece=\''.$do_piece.'\'';

				                    $rq = odbc_exec($connection,$sql);
                    if ($rep=odbc_fetch_array($rq)) {
						$date=$rep['DO_Date'];
						$Statut=$rep['DO_Statut'];
		
					}
					
$sqlclient='select * from f_comptet where ct_num=\''.$client1.'\'';

				                    $rqclient = odbc_exec($connection,$sqlclient);
                    if ($repclient=odbc_fetch_array($rqclient)) {
						$intitule_client=$repclient['CT_Intitule'];
						$adresse_client=$repclient['CT_Adresse'];
						$complement_client=$repclient['CT_Complement'];
						$ville_client=$repclient['CT_Ville'];
		
					}

echo '			

				<div class="row">
					
<!--						<div class="col-lg-4">
						<div class="form-group">
													<label class="form-label" for="desgination">Quantité</label>

							<input id="demo3" type="text" value="1" name="demo3">
						</div>-->
					</div>
				</div><!--.row-->


							<section class="card">
				<header class="card-header card-header-lg">
					Devis
				</header>
				<div class="card-block invoice">
					<div class="row">
						<div class="col-lg-6 company-info">
							<h5>'.$client1.'</h5>
							<p>'.$intitule_client.'</p>

							<div class="invoice-block">
								<div>'.utf8_encode($adresse_client).'</div>
								<div>'.utf8_encode($complement_client).'</div>
								<div>'.utf8_encode($ville_client).'</div>
							</div>

						
						
						</div>
						<div class="col-lg-6 clearfix invoice-info">
							<div class="text-lg-right">
								<h5>DEVIS #'.$do_piece.'</h5>
								<div>Date: '.$date.'</div>
								<div>Dépôt: '.$depot.'</div>
							</div>

						</div>
					</div>
					
					<div class="row table-details">
					<div class="col-lg-4">
							<label class="form-label" for="exampleInputEmail1">Reference</label>
							<input name="ref" onchange="Modification_ref()" type="text" class="form-control" id="ref"  >
					</div>
					<div class="col-lg-4">
							<label class="form-label" for="exampleInputEmail1">Coord</label>
							<input name="coord" width="10" onchange="Modification_coord()" type="text" class="form-control" id="coord"  >
					</div>
					</div>
					
					<div class="row table-details">

			                            <form action="#" method="post" class="main" enctype="multipart/form-data" id="ligne_form">
											
										
								<div class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label" for="exampleInputEmail1">Article</label>
							<input name="article" onchange="validation_article()" type="text" class="form-control" id="article"  >
						</fieldset>
					</div>
					<div id="designation" class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label" for="desgination">Designation</label>
							<input name="designation" type="text" disabled class="form-control"  >
						</fieldset>
					</div>
										<div class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label" for="Quantité">Quantité</label>
							<input name="quantity" type="text"  class="form-control"  value="1" >
						</fieldset>
					</div>			
					<input type="hidden" id="piece" name="piece" value="'.$do_piece.'" />
					<div id="ref" class="col-lg-4">
					</div>
                            <a style="float:right;" class="btn btn-rounded btn-inline" onclick="validation_ligne()">Valider</a>
					

					
							<id id="loading" style="text-align:center;display:none;">
				<img src="img/fancybox_loading@2x.gif" alt="loading"/>
				</id>		
					
					</form>

					<div id="modif_qte" >
</div>
<div id="ligne_devis">
						</div>
			
					</div>
				</div>
			</section>

';




	}
}

?>
		
				<div class="row">
				
					<!--<div class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label" for="article">Article</label>
							<input onchange="myFunction()"  type="text" class="form-control" id="articlxe"  >
						</fieldset>
					</div>
					<div class="col-lg-4" id="designation">
						<fieldset class="form-group">
							<label class="form-label" for="desgination">Designation</label>
							<input type="designation" disabled class="form-control" id="desgination" >
						</fieldset>
					</div>
										<div class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label" for="desgination">Quantité</label>
							<input type="designation"  class="form-control" id="desgination" value="1" >
						</fieldset>
					</div>-->
					
					
<!--						<div class="col-lg-4">
						<div class="form-group">
													<label class="form-label" for="desgination">Quantité</label>

							<input id="demo3" type="text" value="1" name="demo3">
						</div>-->
					</div>
				</div><!--.row-->




	<script>

	
	function validation_ligne() {
		                               str1=document.forms['ligne_form'].article.value;
		                               str2=document.forms['ligne_form'].quantity.value;
		                               str3=document.forms['ligne_form'].piece.value;

 
                showLoadingImage();
                $.ajax({
                    url: "ajax/ligne.php?q=1&article="+str1+"&quantity="+str2+"&piece="+str3,
                    context: document.body,
                    success: function(responseText) {

                        $("#ligne_devis").html(responseText);

                    },
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.

                        hideLoadingImage();
                    }
                });
            };
</script>




	<script>

	
	function validation_article() {
		    var x = document.getElementById("article").value;

 
/*                showLoadingImage();*/
                $.ajax({
                    url: "ajax/article.php?article="+x,
                    context: document.body,
                    success: function(responseText) {

                        $("#designation").html(responseText);

                    },
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.

                       /* hideLoadingImage();*/
                    }
                });
            };
</script>


<script>
	function Modification_ref() {
		   
		    var x = document.getElementById("ref").value;
            var y = document.getElementById("piece").value;
			
            
/*                showLoadingImage();*/
                $.ajax({
				   url: "ajax/reference.php?&num="+y+"&ref="+x,
                    context: document.body,
					 success: function(responseText) {

                        $("#ref").html(responseText);

                    },
                    
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.

                       /* hideLoadingImage();*/
                    }
                });
            };
</script>

<script>
	function Modification_coord() {
		   
		    var x = document.getElementById("coord").value;
            var y = document.getElementById("piece").value;
			
            
/*                showLoadingImage();*/
                $.ajax({
				   url: "ajax/coord.php?&num="+y+"&coord="+x,
                    context: document.body,
					 success: function(responseText) {

                        $("#ref").html(responseText);

                    },
                    
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.

                       /* hideLoadingImage();*/
                    }
                });
            };
</script>


        <script type="text/javascript">

            function hideLoadingImage()
            {
                $("#loading").css("display", "none");

            }

            function showLoadingImage(){
                $("#loading").css("display", "block");
            }

        </script>