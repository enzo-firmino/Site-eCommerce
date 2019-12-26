<?php
	//session_start();
	//require_once('/home/ann2/firminoe/public_html/eCommerce/lib/File.php');

	//require File::build_path(array('model','ModelEau.php'));
	$prixPanierTotal;
	$panier="0";
	$listePanier = array();
	$listePanierId = array();
	
	echo'<h2> Récapitulatif de mon panier </h2>';
	foreach (ModelEau::selectAll() as $eau) {
		$nomEau = htmlspecialchars($eau->getNom());
		$nom = str_replace(' ','-', $nomEau);
		if (isset($_COOKIE[$nom])) {
			array_push($listePanier, $eau);
			array_push($listePanierId, $eau->getId());
		}
	}


	if(empty($listePanier)){
		echo'<div id="panier_vide"> 
		<p> Votre panier est vide </p>
		<a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=readAll"> Retourner aux produits </a></div>';
	}
	else{	
	echo'<div id="panier">';
	echo'<div id="liste_panier">';
	




	foreach ($listePanier as $eau) {
		$eLienImg = htmlspecialchars($eau->getLienImage());
		$eId = htmlspecialchars($eau->getId());
		$nomEau = htmlspecialchars($eau->getNom());
		$prix = htmlspecialchars($eau->getPrix());


		$nom = str_replace(' ','-', $nomEau);
        	echo '<div id="eau_detail_panier"> 
        		<img src="'.$eLienImg.'">
        		<p>'.$nomEau . '<br> ' . $prix . '€</p>

	        	<p><a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=retirerPanier&id='.$eId .'"> - </a>
	        	<a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=ajoutPanierPanier&id='.$eId .'"> + </a>
	        	 ' .$_COOKIE['Qtt' . $nom] . '</p>
	        	<p> Total : ' . $prix * $_COOKIE['Qtt' . $nom] . '€</p>
	        	<p><a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=supprimerPanier&id='.$eId .'"> X </a></p>
	        	</div> ';

           		$_SESSION['prixPanier'] = (float)$_SESSION['prixPanier'] + ((float)$prix * (float)$_COOKIE['Qtt' . $nom]);   

        

	}
	echo'</div>';


	
	
	if(isset($_SESSION['prixPanier'])) {
		$test = implode(".", $listePanierId);
		echo '<div id="prix_panier">
		<p> Total : ' . $_SESSION['prixPanier'] .'€ </p>
		<a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=validerCommande&controller=commande&listePanier=' . $test . '"> Valider commande </a>

		</div>';
	}
	echo'</div>';
	echo'<div id="continuer_achat">
	<a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=readAll"> <- Continuer mes achats </a></div>';
}



?>