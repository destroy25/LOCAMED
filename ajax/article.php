<?php
include('../connexion.php');

$article=$_GET['article'];

//$designation=0;
$sql='select * from f_article where ar_ref=\''.$article.'\'';

				                    $rq = odbc_exec($connection,$sql);
                    if ($rep=odbc_fetch_array($rq)) {
						$designation=$rep['AR_Design'];
					}
					
					$sql2='select * from f_article where ar_codebarre=\''.$article.'\'';

				                    $rq = odbc_exec($connection,$sql2);
                    if ($rep=odbc_fetch_array($rq)) {
						$designation=$rep['AR_Design'];
					}


					if(!isset($designation))
					{
//						echo '<script>alert("Article '.$article.' Inexistant")</script>';
					}
					else
					{
						echo '<fieldset class="form-group">
							<label class="form-label" for="desgination">Designation</label>
							<input type="text" disabled class="form-control" value="'.$designation.'" >
						</fieldset>';
					}

?>