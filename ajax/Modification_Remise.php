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
	array('num'=>$num,'Type'=>0,'item'=>$item,'Remise'=>$Remise,'i'=>$_SESSION['Objet_cnx'],'NameSage'=>$_SESSION['NameSage'],'PwdSage'=>$_SESSION['PwdSage']));
 
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
			
			echo '<script>alert("La remise a été mis à jour avec succés !")</script>';
		}
	}

echo '			
<input type="hidden" id="num_piece" value="'.$num.'"/>
	<div id="modif1">
	<div  class="col-lg-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="10"><a  class="SelectModif" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></a> 
										<a class="suppression_list_lignes"><i class="fa fa-remove"></i></a>
										<input type="checkbox" onclick="cocherTout(this.checked);" /></th>
										<th>Article</th>
										<th>Désignation</th>
										<th width="105">Quantité</th>
										<th>Prix Unitaire</th>
										<th width="110">Remise en %</th>
										<th>Montant</th>
										<th width="180">Condition Enlevement</th>
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
										<td><input class="form-control" type="text" onchange="Modification_Qte('.$id.')" id="'.$id.'" value='.number_format($dat['DL_Qte'],0,',',' ').' /></td>
										<td>'.number_format($dat['DL_PrixUnitaire'],2,',',' ').'</td>
										<td><input class="form-control" type="text" onchange="Modification_Remise('.$id.')" id="Remise'.$id.'" value="'.number_format($dat['DL_Remise01REM_Valeur'],0,'',' ').'" /></td>
										<td>'.number_format($dat['DL_MontantHT'],2,',',' ').'</td>										<td id="id'.$dat['cbMarq'].'">'.$dat['condition_enlevement'].'</td>
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
							<form id="modif_condition" >
							<div id="modif">
							</div>
							</form>
							</div>
							<div class="modal-footer">
							    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
								<button type="button" class="modifcondition btn btn-rounded btn-primary">Valider</button>
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
										<td><div align="right">'.$totalqte.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
									</tr>
									<tr>
										<td>Total HT :</td>
										<td><div align="right">'.number_format($totalht,2,',',' ').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
									</tr>
									<tr>
										<td>Total TTC :</td>
										<td><div align="right">'.number_format($totalttc,2,',',' ').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
									</tr>
								</table>
							</div>
					<div class="row">
					
						<div class="col-lg-12 clearfix">
							<div class="total-amount">
								<div class="actions">
									<a href="list_devis.php" class="btn btn-rounded btn-inline">Fin de Saisie</a>
									<a onclick="validation_devis()" class="btn btn-rounded btn-inline">Valider</a>
									<a href="impression_devis.php?q='.$num.'" class="btn btn-inline btn-secondary btn-rounded">Imprimer</a>
								</div>
							</div>
						</div>
					</div>
					</div>
					</div>
					<div id="validation"></div>
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
		        $("#modif").html(data);
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
                        $("#modif").html(responseText);

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
                    url: "ajax/suppression_ligne.php?&num="+x+"&item="+y,
                    context: document.body,
                    success: function(responseText) {


                        //$("#txtHint22").html(responseText);
                        $("#modif1").html(responseText);

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
                    url: "ajax/suppression_list_lignes.php?&num="+x+"&cbMarq="+checkbox_val,
                    context: document.body,
                    success: function(responseText) {


                        //$("#txtHint22").html(responseText);
                        $("#modif1").html(responseText);

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
	   var verif=1;
  }
  else 
  {
    ////////////////////////////////////////////////////////////////////////////////////////////////
    var datePat = /^(\d{2,2})(\/)(\d{2,2})\2(\d{4}|\d{4})$/;
    var verif=1;
	dateStr=str1;
    var matchArray = dateStr.match(datePat); // is the format ok?
    if (matchArray == null) {
       verif=0;
    }
 
    day = matchArray[1]; // parse date into variables
    month = matchArray[3];
    year = matchArray[4];
    if (month < 1 || month > 12) { // check month range
          verif=0;
     }
    if (day < 1 || day > 31) {
          verif=0;
    }
	var now = new Date();
	
	if (year < now.getFullYear()-1 || year > now.getFullYear()+3) {
         verif=0;
    }
    if ((month==4 || month==6 || month==9 || month==11) && day==31) {
          verif=0;
    }
    if (month == 2) { // check for february 29th
          var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
          if (day>29 || (day==29 && !isleap)) {
             verif=0;
          }
    }
  }
 
 
 if (verif==0)
	 alert("vérifier le format de date")
 else{
   
   

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
 }
  // return false;*/
});     </script>


	<script>
/*Fonction Validation Devis*/
	
	function validation_devis() {
		    var x = document.getElementById("num_piece").value;

 
/*                showLoadingImage();*/
                $.ajax({
                    url: "ajax/validation_devis2.php?q="+x,
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
	function Modification_Qte(y) {
		    var Qte = document.getElementById(y).value;
            var x = document.getElementById("num_piece").value;
			
			if (Qte>0)
			{
 
/*                showLoadingImage();*/
                $.ajax({
					
                    url: "ajax/Modification_Qte.php?&Qte="+Qte+"&num="+x+"&item="+y,
                    context: document.body,
					success: function(responseText) {


                        //$("#txtHint22").html(responseText);
                        //$("#"+y).html(responseText);
						 $("#modif1").html(responseText);

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
	function Modification_Remise(y) {
		    var Remise = document.getElementById('Remise'+y).value;
            var x = document.getElementById("num_piece").value;
			
			
		//	if (Number.isInteger(Qte)==true)
		//	{
 
/*                showLoadingImage();*/
                $.ajax({
					
                    url: "ajax/Modification_Remise.php?&Remise="+Remise+"&num="+x+"&item="+y,
                    context: document.body,
					success: function(responseText) {

                        //$("#txtHint22").html(responseText);
                        //$("#Remise"+y).html(responseText);
						 $("#modif1").html(responseText);

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
<script >
function cocherTout(etat)
{
  var cases = document.getElementsByTagName('input');   // on recupere tous les INPUT
   for(var i=1; i<cases.length; i++)     // on les parcourt
     if(cases[i].type == 'checkbox')     // si on a une checkbox...
         {cases[i].checked = etat;}
             // ... on la coche ou non
 
 
}
</script>