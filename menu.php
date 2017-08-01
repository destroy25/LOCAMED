						<?php
			$query = "SELECT * FROM menu where id_parent=0";

				                    $reponse = odbc_exec($connection,$query);
                    while ($row=odbc_fetch_array($reponse)) {
			

			if($row['uniq']==1)
			{
				
				 echo '<li class="blue">
	            <a href="'.$row['link'].'">
	                <i class="'.$row['icon'].'"></i>
	                <span class="lbl">'.$row['menu'].'</span>
	            </a>
	        </li>';

				
			}
			else
			{
								 echo '<li class="blue with-sub">
			<span>
	                <i class="'.$row['icon'].'"></i>
	                <span class="lbl">'.$row['menu'].'</span>
	            </span>	          
				<ul>
	        ';
				$query2='select * from menu where id_parent='.$row['id_menu'];
		                    $reponse2 = odbc_exec($connection,$query2);
                    while ($row2=odbc_fetch_array($reponse2)) {
			
				echo '    <li><a href="'.$row2['link'].'">
				<span class="lbl">'.$row2['menu'].'</span></a>
				</li>';
				}
				echo '</ul></li>';
			}
								
}

// echo afficher_menu(0, 0, $categories);
?>