<?php
	session_start();
	$_SESSION['prixPanier'] = 0;
    $DS = DIRECTORY_SEPARATOR;
    require_once 'lib'.$DS.'File.php';
    $array = array('controller', 'routeur.php');
    require_once File::build_path($array);
?>
