<?php

$utilisateur = ModelUtilisateur::select($_SESSION['login']);
$arrayCommande = $utilisateur->recupererHistorique();
echo'<div id="liste_commande">';
if(empty($arrayCommande)){
	echo'<div id="liste_commande_vide"> Vous n\'avez pas encore fait de commande </div>';
}
else{
	foreach ($arrayCommande as $key) {
		$commande = ModelCommande::select($key['id_commande']);
		$IdCommande = htmlspecialchars($commande->getIdCommande());
		$DateCommande = htmlspecialchars($commande->getDateCommande());
		$IdCommande2 = rawurlencode($commande->getIdCommande());
		echo '<div id="liste_commande_detail">';
		echo 'Numéro de commande : ' . $IdCommande . '<br>';
		echo 'Date de la commande : ' . $DateCommande . '<br>';
		echo '<a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=detailProduits&controller=commande&idcommande=' . $IdCommande2 . '">Detail commande</a>
		<hr>
		</div>';
	}
}
echo '</div>';


$login = htmlspecialchars($utilisateur->getLogin());
$nom = htmlspecialchars($utilisateur->getNom());
$prenom = htmlspecialchars($utilisateur->getPrenom());
$email = htmlspecialchars($utilisateur->getEmail());
echo'<div id="info_compte"> 
<p> Login : ' . $login . '</p>
<p> Nom : ' . $nom . '</p>
<p> Prenom : ' . $prenom . '</p>
<p> Email : ' . $email . '</p>
<a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=passwordChange&controller=utilisateur">Changer mot de passe</a><br>
<a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=connexionAuto&controller=utilisateur">Enlever reconnexion automatique</a><br>
<a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=update&controller=utilisateur&login='. $_SESSION['login'] .'">Modifier informations</a>';
if (Session::is_admin()) {
	echo '<br> <a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=readAll&controller=commande"> Voir toutes les commandes</a>';
	echo'<br> <a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=create&controller=eau"> Créer une eau </a>';
}
echo '</div>';





?>