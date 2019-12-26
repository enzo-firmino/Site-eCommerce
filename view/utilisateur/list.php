 <?php
foreach ($tab_u as $u) { 
	$uLogin = htmlspecialchars($u->getLogin());
    $uLogin2 = rawurlencode($u->getLogin());
    echo '<p> utilisateur <a href="http://webinfo.iutmontp.univ-montp2.fr/~lhermeniert/PHP/TD8/index.php?action=read&login=' . $uLogin2 . '&controller=utilisateur">' . $uLogin . '</a>' . '<br>';
}
if(Session::is_admin()) {
	echo '<br> <a href="http://webinfo.iutmontp.univ-montp2.fr/~lhermeniert/PHP/TD8/index.php?action=create&controller=utilisateur"> Ajouter un nouvel utilisateur</a>';
}

?>