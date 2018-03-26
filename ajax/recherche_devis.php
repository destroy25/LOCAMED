<?php
include('../connexion.php');

$q=$_GET['client'];


echo'		
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Devis</h2>
							<div class="subtitle">Devis Client N° - '.$q.'</div>
						</div>
					</div>
				</div>
			</header>
			<div id="modif">
				<id id="loading" style="text-align:center;display:none;">
				<img src="img/fancybox_loading@2x.gif" alt="loading"/>
				</id>		

			</div>
			<form id="entete">
			<section class="card">
				<div class="card-block">
					<table id="example" class="display table table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>N° Devis</th>
							<th>Date</th>
							<th>Num Client</th>
							<th>Intitulé Client</th>
							<th>Statut</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>';
	
						$sql='select DO_Piece,DO_Date,CT_Intitule,DO_Statut,CT_Intitule,DO_Statut,do_tiers from f_docentete 
						inner join f_comptet on f_docentete.do_tiers=f_comptet.ct_num 
						where do_domaine=0 and do_type=0 and F_DOCENTETE.de_no='.$_SESSION['depot'] .' and f_docentete.DO_Tiers=\''.$q.'\'';
		                $rq = odbc_exec($connection,$sql);
						while ($rep=odbc_fetch_array($rq)) {
							
							if($rep['DO_Statut']==1)
							{
								$statut='<span class="label label-warning">En instance de validation</span>';
							}
							elseif($rep['DO_Statut']==2)
							{
								$statut='<span class="label label-success">Validé</span>';
							}
							$exist_ligne=0;
							$sqlligne='select * from f_docligne where DO_Piece=\''.$rep['DO_Piece'].'\'';
						    $rqligne = odbc_exec($connection,$sqlligne);
									if ($data= odbc_fetch_array($rqligne))
										$exist_ligne=1;
									
								/*Conversion de date*/
								$d=date_create($rep['DO_Date']);
								
								echo '<tr id="'.$rep['DO_Piece'].'">
								<td>'.$rep['DO_Piece'].'</td>
								<td>'.date_format($d,'d/m/Y').'</td>
								<td>'.$rep['do_tiers'].'</td>
								<td>'.$rep['CT_Intitule'].'</td>
								<td>'.$statut.'</td>
								<td>
								<a title="Consultation Devis" href="devis.php?q='.$rep['DO_Piece'].'"><span class="fa fa-eye"></span></a>';
								if ($rep['DO_Statut']==2 and $exist_ligne==1)
								echo ' <a title="Transformation en Facture" onclick="transformation_devis('.$rep['DO_Piece'].');"><span class="fa fa-cogs"></span></a>';
							
							   echo ' <a title="Impression" href="impression_devis.php?q='.$rep['DO_Piece'].'"><span class="fa fa-print"></span></a>';
							    if ($rep['DO_Statut']==2)
							    echo ' <a title="Annulation Devis" class="annulation_devis"><span class="fa fa-remove"></span></a>';
							    echo '</td>
								</tr>';
		
						}
		
echo'											</tbody>
					</table>
				</div>
			</section>
			</form>
		</div><!--.container-fluid-->

';
	

