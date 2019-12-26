<?php
$eId = htmlspecialchars($e->getId());
$eType = htmlspecialchars($e->getType());
$eName = htmlspecialchars($e->getNom());
$ePrix = htmlspecialchars($e->getPrix());
$eDescription = htmlspecialchars($e->getDescription());
$eLienImg = htmlspecialchars($e->getLienImage());
$eId2 = rawurlencode($e->getId());
echo '
<div id="eau_detail">
		<div id="eau_partie_gauche">
			<img src="' . $eLienImg . '" alt="image eau">
			<p>' . $eName . '</p> 
		</div>
		<div id="eau_partie_droite">
			<p> ' . $eDescription . ' </p>
			<p> ' . $ePrix . '€ </p>
			<a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=ajoutPanier&id='.$eId2 .'"> Ajouter au panier </a>
			
			<a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=afficherPanier&controller=utilisateur" > Afficher Panier </a> ';
			 if(Session::is_admin()){
			 	echo '<a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=update&controller=eau&id= ' . $eId2 . '" > Modifier eau</a> ';
			 	echo '<a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=delete&controller=eau&id= ' . $eId2 . '" > Supprimer eau</a> ';
			 }

		echo '</div>		
		</div>';
		echo'<div id="continuer_achat">
	<a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=readAll"> Continuer mes achats </a></div>';




?>