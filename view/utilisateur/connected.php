<?php 
$utilisateur = ModelUtilisateur::select($_SESSION['login']);

$uNom = htmlspecialchars($utilisateur->getNom());
$uPrenom = htmlspecialchars($utilisateur->getPrenom());


echo '<div class="littlemsg" > Bonjour ' . $uNom . ' ' . $uPrenom;

if (isset($_COOKIE['panier'])) {
	setcookie('panier','',time()-1);
	header("refresh:2; url= http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/?action=afficherPanier&controller=utilisateur");
}

else {
header("refresh:2; url= http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce");
}
?>