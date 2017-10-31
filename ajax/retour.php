<?php 
include('../connexion.php');

if(isset($_GET['q']))
{
	$q=$_GET['q'];	
	if($q==1)
	{
		
	$client1=$_GET['client'];
	$souche=$_GET['souche'];
	$num_depot=$_SESSION['depot'];
	
	
	$sqldepot='select * from f_depot where de_no='.$num_depot;
	                $rqdepot = odbc_exec($connection,$sqldepot);
                    if ($repdepot=odbc_fetch_array($rqdepot)) {
						$depot=$repdepot['DE_Intitule'];
					}
	
	
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
//	$result = $client->call('HelloUser',$theVariable);
	$result = $client->call('creation_document',
	array('num'=>$client1,'souche'=>$souche,'type'=>4,'depot'=>$depot,'i'=>$_SESSION['Objet_cnx'],'NameSage'=>$_SESSION['NameSage'],'PwdSage'=>$_SESSION['PwdSage']));
 
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
			$do_piece=$result;
			
		}
	}

					
					
					
					

$sql='select * from F_Docentete where DO_Piece=\''.$do_piece.'\'';

				                    $rq = odbc_exec($connection,$sql);
                    if ($rep=odbc_fetch_array($rq)) {
						$date=$rep['DO_Date'];
		
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
					Retour
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
								<h5>Retour #'.$do_piece.'</h5>
								<div>Date: '.$date.'</div>
							</div>


						</div>
					
					
					
					
					</div>
					
					
					<div class="row table-details">

			                            <form action="#" method="post" class="main" enctype="multipart/form-data" id="ligne_form">

								<div class="col-lg-4">
						<fieldset class="form-group">
							<label class="form-label" for="exampleInputEmail1">Article</label>
							<input name="article" onchange="validation_article()" type="text" class="typeahead form-control" id="article"  >
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
					<input type="hidden" name="piece" value="'.$do_piece.'" />
                            <a style="float:right;" class="btn btn-rounded btn-inline" onclick="validation_ligne()">Valider</a>
					
</form>

				<id id="loading" style="text-align:center;display:none;">
				<img src="img/fancybox_loading@2x.gif" alt="loading"/>
				</id>		


<div id="ligne_retour">
					
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


					<!--		<section class="card">
				<header class="card-header card-header-lg">
					Retour
				</header>
				<div class="card-block invoice">
					<div class="row">
						<div class="col-lg-6 company-info">
							<h5>Company Inc.</h5>
							<p>www.company.com</p>

							<div class="invoice-block">
								<div>1 Infinite loop</div>
								<div>95014 Cuperino, CA</div>
								<div>United States</div>
							</div>

							<div class="invoice-block">
								<div>Telephone: 555-692-7754</div>
								<div>Fax: 555-692-7754</div>
							</div>

							<div class="invoice-block">
								<h5>Invoice To:</h5>
								<div>Rebeca Manes</div>
								<div>
									Normand axis LTD <br>
									3 Goodman street
								</div>
							</div>
						</div>
						<div class="col-lg-6 clearfix invoice-info">
							<div class="text-lg-right">
								<h5>INVOICE #49099</h5>
								<div>Date: January 12, 2015</div>
								<div>Date: January 16, 2015</div>
							</div>

							<div class="payment-details">
								<strong>Payment Details</strong>
								<table>
									<tr>
										<td>Total Due:</td>
										<td>$8,750</td>
									</tr>
									<tr>
										<td>Bank Name:</td>
										<td>Profit Bank Europe</td>
									</tr>
									<tr>
										<td>Country:</td>
										<td>United Kingdom</td>
									</tr>
									<tr>
										<td>City:</td>
										<td>London</td>
									</tr>
									<tr>
										<td>Address:</td>
										<td>3 Goodman street</td>
									</tr>
									<tr>
										<td>IBAN:</td>
										<td>KFHT32565523921540571</td>
									</tr>
									<tr>
										<td>SWIFT Code:</td>
										<td>BPT4E</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row table-details">
						<div class="col-lg-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="10">#</th>
										<th>Article</th>
										<th>Désignation</th>
										<th>Quantité</th>
										<th>Prix Unitaire</th>
										<th>Remise</th>
										<th>Condition Enlevement</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>#</td>
										<td>Description</td>
										<td>Description</td>
										<td>Description</td>
										<td>Quantity</td>
										<td>Unit Cost</td>
										<td>Total</td>
										<td>Total</td>
									</tr>
																		<tr>
										<td>#</td>
										<td>Description</td>
										<td>Description</td>
										<td>Description</td>
										<td>Quantity</td>
										<td>Unit Cost</td>
										<td>Total</td>
										<td>Total</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-7 terms-and-conditions">
							<strong>Terms and Conditions</strong>
							Thank you for your business. We do expect payment within 21 days, so please process this invoice within that time. There will be a 1.5% interest charge per month on late invoices.
						</div>
						<div class="col-lg-5 clearfix">
							<div class="total-amount">
								<div>Sub - Total amount: <b>$4,800</b></div>
								<div>VAT: $35</div>
								<div>Grand Total: <span class="colored">$4,000</span></div>
								<div class="actions">
									<button class="btn btn-rounded btn-inline">Valider</button>
									<button class="btn btn-inline btn-secondary btn-rounded">Imprimer</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

-->


	<script>
	function validation_ligne() {
		                               str1=document.forms['ligne_form'].article.value;
		                               str2=document.forms['ligne_form'].quantity.value;
		                               str3=document.forms['ligne_form'].piece.value;

 
                showLoadingImage();
                $.ajax({
                    url: "ajax/ligne_retour.php?q=1&article="+str1+"&quantity="+str2+"&piece="+str3,
                    context: document.body,
                    success: function(responseText) {

                        $("#ligne_retour").html(responseText);

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

        <script type="text/javascript">

            function hideLoadingImage()
            {
                $("#loading").css("display", "none");

            }

            function showLoadingImage(){
                $("#loading").css("display", "block");
            }

        </script>
		

		<script type="text/javascript">


	$('input.typeahead').typeahead({

	    source:  function (query, process) {

        return $.get('ajax/list_article.php', { query: query }, function (data) {

        		console.log(data);

        		data = $.parseJSON(data);

	            return process(data);

	        });

	    }

	});


</script>