<?php
	$tab_produits = ModelCommande::recupererProduit(myGet('idcommande'));
	echo '<div id="detail_produit_commande" > 
	<p> Id commande : ' . myGet('idcommande') . '</p>';

	

	foreach ($tab_produits as $key) {
		$produit = ModelEau::select($key['id_produit']);
		$eLienImg = htmlspecialchars($produit->getLienImage());
		$eNom = htmlspecialchars($produit->getNom());
		echo '<div class="detail_commande_commande">
		<p><img src="'.$eLienImg.'" alt="image eau"></p>
		<p>' . $key['date_commande'] . '</p> 
		<p>' . $eNom . '</p>
		<p> x' . $key['qtt'] . '</p></div>';
	}
	echo '</div>';
?>