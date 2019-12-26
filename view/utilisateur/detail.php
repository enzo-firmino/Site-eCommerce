<?php
require_once File::build_path(array('lib','Session.php'));
$uLogin = htmlspecialchars($u->getLogin());
$uNom = htmlspecialchars($u->getNom());
$uPrenom = htmlspecialchars($u->getPrenom());
$uLogin2 = rawurlencode($u->getLogin());
echo '<p> Utilisateur <a>' . $uLogin . '</a> de nom ' . $uNom . ' de marque ' . $uPrenom . '.</p>';

if ((Session::is_user($uLogin))||(Session::is_admin())) {
	echo '<a href="http://webinfo.iutmontp.univ-montp2.fr/~lhermeniert/PHP/TD8/index.php?action=delete&login=' . $uLogin2 . '&controller=utilisateur">Supprimer utilisateur</a></p>';
	echo '<a href="http://webinfo.iutmontp.univ-montp2.fr/~lhermeniert/PHP/TD8/index.php?action=update&login=' . $uLogin2 . '&controller=utilisateur">Update utilisateur</a></p>';  
}

?>