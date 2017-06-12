

<?php
include('../connexion.php');

$q=$_GET['q'];

$sql='select * from f_docligne where cbMarq='.$q;


				                    $rq = odbc_exec($connection,$sql);
                    if ($rep=odbc_fetch_array($rq)) {
//echo 'Article '. $rep['AR_Ref'].' Condtion Enlevement '.$rep['condition_enlevement'];
					}




?>

							<div class="form-group">
					
								<label class="form-label" for="date-mask-input">Date Enlevement</label>
								<input name="date_enlevement" type="text" class="form-control" id="date-mask-input">
								<small class="text-muted">Format Date: dd/mm/yyyy</small>
							</div>
<input type="hidden" name="cbMarq" value="<?php echo $q;?>"/>						
						
							<script src="js/lib/input-mask/jquery.mask.min.js"></script>
	<script src="js/lib/input-mask/input-mask-init.js"></script>

						

                <script type="text/javascript">
// delete row in a table
jQuery('.modifrow').click(function(){
 
		 var y = $(this).closest('tr').attr('id');
//		 var x = $(this).closest('tr').attr('id');
  str1=document.forms['modif_condition'].date_enlevement.value;

  alert(str1);
/* 
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
  // return false;*/
});     </script>