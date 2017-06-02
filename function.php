<?php


    $bdd = new PDO('mysql:host=localhost;dbname=locamed_bdd', 'root', '');


function menu(){
			$query = "SELECT * FROM menu where id_parent=0";
				$reponse = $bdd->query($query);

			while($row = $reponse->fetch()) {

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
				$reponse2 = $bdd->query($query2);
				while($row2 = $reponse2->fetch()) {
				echo '    <li><a href="'.$row2['link'].'">
				<span class="lbl">'.$row2['menu'].'</span></a>
				</li>';
				}
				echo '</ul></li>';
				
			}
				
				
}

}
	


?>