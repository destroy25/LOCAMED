<?php
include('../connexion.php');

$Remise=$_GET['Remise'];
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
	$result = $client->call('Modification_Remise',
	array('num'=>$num,'Type'=>0,'item'=>$item,'Remise'=>$Remise));
 
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
			
			echo '<script>alert("la Remise est Bien Modifier")</script>';
		}
	}

$sql='select * from F_Docentete where DO_Piece=\''.$num.'\'';

				                    $rq = odbc_exec($connection,$sql);
                    if ($rep=odbc_fetch_array($rq)) {
						$DO_Statut=$rep['DO_Statut'];
		
					}
	
		echo '			
<input type="hidden" id="num_piece" value="'.$num.'"/>
	<div id="ligne_devis">
	<div  class="col-lg-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="10"><a  class="SelectModif" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></a>  <a class="suppression_list_lignes"><i class="fa fa-remove"></i></a></th>
										<th>Article</th>
										<th>Désignation</th>
										<th>Quantité</th>
										<th>Prix Unitaire</th>
										<th>Remise en %</th>
										<th>Montant</th>
										<th>Condition Enlevement</th>
										<th>Statut Stock</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>';
								/*Affichage des Lignes du document */
						$totalqte=0;		//Total Quantité
						$totalht=0;			//Totat HT
						$totalttc=0;		//Tota TTC
								$sqlligne='select AR_Ref,DL_Design,DL_Qte,DL_PrixUnitaire,DL_Remise01REM_Valeur,DL_MontantHT,DL_MontantTTC,condition_enlevement,cbMarq
								from f_docligne where DO_Piece=\''.$num.'\'';
								    $rqligne = odbc_exec($connection,$sqlligne);
									while ($data[] = odbc_fetch_array($rqligne));
									
									
									$val=count($data);
									$val2=0;
									$id=0;
									foreach($data as $dat)
									{
										$val2++;
										if($val2==$val) continue;
										
										$totalqte=$totalqte+$dat['DL_Qte'];
										$totalht=$totalht+$dat['DL_MontantHT'];
										$totalttc=$totalttc+$dat['DL_MontantTTC'];
										
						//odbc_close($connection);
						/*Statut du Stock */
						$stock=0;
						$sqlstock='select * from f_artstock where de_no=1 and ar_ref=\''.$dat['AR_Ref'].'\'';
						$rqstock = odbc_exec($connection,$sqlstock);
						if ($repstock=odbc_fetch_array($rqstock)) {
						$stock=$repstock['AS_QteSto'];
						}
						
						if($dat['DL_Qte']<=$stock)
						{
							$infostock='<span class="label label-success">Livrable</span>';
						}
						else
						{
							$infostock='<span class="label label-danger">Non Livrable</span>';
						}
						
						/*Fin Statut du Stock */
						$id++;
						echo'
									<tr id="'.$dat['cbMarq'].'" class="'.$id.'" >
										<td><input type="checkbox" class="'.$dat['cbMarq'].'" value="'.$dat['cbMarq'].'" id="choix"/></td>
										<td>'.$dat['AR_Ref'].'</td>
										<td>'.$dat['DL_Design'].'</td>
										<td><input class="form-control" type="text" onchange="Modification_Qte_2('.$id.')" id="'.$id.'" value='.number_format($dat['DL_Qte'],0,',',' ').' /></td>
										<td>'.number_format($dat['DL_PrixUnitaire'],2,',',' ').'</td>
										<td><input class="form-control" type="text" onchange="Modification_Remise_2('.$id.')" id="Remise'.$id.'" value="'.number_format($dat['DL_Remise01REM_Valeur'],2,'',' ').'" /></td>
										<td>'.number_format((($dat['DL_Qte'] * $dat['DL_PrixUnitaire'])-(($dat['DL_Qte'] * $dat['DL_PrixUnitaire']* $dat['DL_Remise01REM_Valeur'])/100)),2,',',' ').'</td>
										<td id="id'.$dat['cbMarq'].'">'.$dat['condition_enlevement'].'</td>
										<td>'.$infostock.'</td>
										<td><a class="modifrow" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></a> 
										<a class="suppression_ligne"><i class="fa fa-remove"></i> </a></td>
									</tr>';
										
									
										
									}
						
											echo'
								</tbody>
							</table>

				<div class="modal fade"
					 id="myModal"
					 tabindex="-1"
					 role="dialog"
					 aria-labelledby="myModalLabel"
					 aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
									<i class="font-icon-close-2"></i>
								</button>
								<h4 class="modal-title" id="myModalLabel">Modification Condition Enlevement</h4>
							</div>
							<div class="modal-body">
							<form id="modif_condition">
							<div id="modif">
							</div>
							</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
								<a class="modifcondition"  class="btn btn-rounded btn-primary">Valider</a>
							</div>
						</div>
					</div>
				</div><!--.modal-->
							
						</div>
					</div>
	<div class="payment-details">
								<strong>Récapitulatif</strong>
								<table>
									<tr>
										<td>Total Quantité :</td>
										<td>'.$totalqte.'</td>
									</tr>
									<tr>
										<td>Total HT :</td>
										<td>'.number_format($totalht,2,',',' ').'</td>
									</tr>
									<tr>
										<td>Total TTC :</td>
										<td>'.number_format($totalttc,2,',',' ').'</td>
									</tr>
								</table>
							</div>
					<div class="row">
					
						<div class="col-lg-12 clearfix">
							<div class="total-amount">
								<div class="actions">
									<a href="list_devis.php" class="btn btn-rounded btn-inline">Fin de Saisie</a>
									<a onclick="validation_devis()" class="btn btn-rounded btn-inline">Valider</a>
									<button  class="btn btn-inline btn-secondary btn-rounded">Imprimer</button>
								</div>
							</div>
						</div>
					</div>
					</div>
					</div>';
	
	


?>
<script type="text/javascript">
jQuery('.SelectModif').click(function(){

      // Ce tableau javascript va stocker les valeurs des checkbox
      var checkbox_val = [];

      // Parcours de toutes les checkbox checkées avec la classe "choix"
      $('#choix:checked').each(function(){
         // Insertion de la valeur de la checkbox dans le tableau checkbox_val
         checkbox_val.push($(this).val());
      });
      		
			
      $.ajax({ 
		   type: "POST", 
		   url: "ajax/modification_ligne.php", 
		   data: { checkbox_val : checkbox_val}, 
		   context: document.body,
		   success: function(data) { 
		        $("#ligne_devis").html(data);
			} 
	}); 
  
   });
</script>


                <script type="text/javascript">
// Modification Ligne
jQuery('.modifrow').click(function(){
 
		 var y = $(this).closest('tr').attr('id');
		$.ajax({
                    url: "ajax/modification_ligne.php?&q="+y,
                    context: document.body,
                    success: function(responseText) {

                        //$("#txtHint22").html(responseText);
                        $("#ligne_devis").html(responseText);

                    },
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.

                    }
                });
});     </script>



                <script type="text/javascript">
// Suppresion Ligne
jQuery('.suppression_ligne').click(function(){

// var y = $(this).closest('tr').attr('id');
if (confirm("Voulez vous supprimer cet enregistrement ?") == true) {
	
		    var x = document.getElementById("num_piece").value;
			var y = $(this).closest('tr').attr('class');
 
 $.ajax({
                    url: "ajax/suppression_ligne_2.php?&num="+x+"&item="+y,
                    context: document.body,
                    success: function(responseText) {


                        //$("#txtHint22").html(responseText);
                        $("#ligne_devis").html(responseText);

                    },
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.

                    }
                });
 
} 
 // return false;
});     </script>


<script type="text/javascript">
// Suppresion list des Lignes
jQuery('.suppression_list_lignes').click(function(){
	
	if (confirm("Voulez vous supprimer cet enregistrement ?") == true) {
	
		    var x = document.getElementById("num_piece").value;
	
	// Ce tableau javascript va stocker les valeurs des checkbox
      var checkbox_val = [];

      // Parcours de toutes les checkbox checkées avec la classe "choix"
      $('#choix:checked').each(function(){
         // Insertion de la valeur de la checkbox dans le tableau checkbox_val
         checkbox_val.push($(this).attr('class'));
      });
	  
	 $.ajax({
                    url: "ajax/suppression_list_lignes_2.php?&num="+x+"&cbMarq="+checkbox_val,
                    context: document.body,
                    success: function(responseText) {


                        //$("#txtHint22").html(responseText);
                        $("#ligne_devis").html(responseText);

                    },
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.

                    }
                });


			
			
 
 
 
} 
 // return false;
});     </script>


               <script type="text/javascript">
// Fonction Modification Condition Devis
jQuery('.modifcondition').click(function(){
 
  str1=document.forms['modif_condition'].date_enlevement.value;
  str2=document.forms['modif_condition'].cbMarq.value;
  
   if (document.forms['modif_condition'].sur_place.checked == true) {
	   str1='Remis sur place';
  }
   alert (str1);

 $.ajax({
                    url: "ajax/modification_condition.php?&q="+str1+"&q2="+str2,
                    context: document.body,
                    success: function(responseText) {


                        //$("#txtHint22").html(responseText);
                        $("#modif").html(responseText);

                    },
                    complete: function() {
						
						var chaine=str2;
                        chaine = chaine.split(";");
                        
						for(var i= 0; i < chaine.length; i++)
                           {
							   if (str1=='Remis sur place')
								   document.getElementById('id'+chaine[i]+'').innerHTML=str1;
							   else
	                               document.getElementById('id'+chaine[i]+'').innerHTML='A Livrer Le '+str1+''; 
                            }

	 
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.
                    }
                });
  // return false;*/
});     </script>


	<script>
/*Fonction Validation Devis*/
	
	function validation_devis() {
		    var x = document.getElementById("num_piece").value;

 
/*                showLoadingImage();*/
                $.ajax({
                    url: "ajax/validation_devis.php?q="+x,
                    context: document.body,
                    success: function(responseText) {

                        $("#validation").html(responseText);

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
	function Modification_Qte_2(y) {
		    var Qte = document.getElementById(y).value;
            var x = document.getElementById("num_piece").value;
			
			
			if (Qte>0)
			{
 
/*                showLoadingImage();*/
                $.ajax({
					
                    url: "ajax/Modification_Qte_2.php?&Qte="+Qte+"&num="+x+"&item="+y,
                    context: document.body,
                    success: function(responseText) {

                        $("#ligne_devis").html(responseText);

                    },
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.

                       /* hideLoadingImage();*/
                    }
                });
			}
			else 
				alert ("Attention, il faut.....");
            };
</script>


<script>	
	function Modification_Remise_2(y) {
		    var Remise = document.getElementById('Remise'+y).value;
            var x = document.getElementById("num_piece").value;
			alert (Remise);
			
		//	if (Number.isInteger(Qte)==true)
		//	{
 
/*                showLoadingImage();*/
                $.ajax({
					
                    url: "ajax/Modification_Remise_2.php?&Remise="+Remise+"&num="+x+"&item="+y,
                    context: document.body,
					success: function(responseText) {

                        //$("#txtHint22").html(responseText);
                        //$("#Remise"+y).html(responseText);
						 $("#ligne_devis").html(responseText);

                    },
                    complete: function() {
                        // no matter the result, complete will fire, so it's a good place
                        // to do the non-conditional stuff, like hiding a loading image.

                       /* hideLoadingImage();*/
                    }
                });
			//}
			//else 
			//	alert ("Attention, il faut.....");
            };
</script>