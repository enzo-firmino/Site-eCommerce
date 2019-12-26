 <?php
 echo'<div id="liste_commande">';
	foreach ($tab_c as $c) { 
		$cId = htmlspecialchars($c->getIdCommande());
	    $cId2 = rawurlencode($c->getIdCommande());
	    $cIdUtilisateur = htmlspecialchars($c->getIdUtilisateur());
	    $cDate = htmlspecialchars($c->getDateCommande());
	    echo '<div id="detail_commande_commande"> 
	    <p> Commande n° <a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=detailProduits&controller=commande&idcommande=' . $cId . '"> '. $cId2 . ' </a>' . '</p>
	    <p> Id client : ' . $cIdUtilisateur . '</p> 
	    <p> Date commande : ' . $cDate . '</p> </div>';
	}
	echo '</div>';
?>