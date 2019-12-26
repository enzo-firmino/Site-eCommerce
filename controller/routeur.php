<?php

$array = array('controller', 'ControllerEau.php');
$array2 = array('controller', 'ControllerUtilisateur.php');
$array3 = array('controller','ControllerCommande.php');
require_once File::build_path($array);
require_once File::build_path($array2);
require_once File::build_path($array3);
$controller_default = "eau";

if (isset($_COOKIE['Preference'])) {
	$controller_default = $_COOKIE['Preference'];
}

if(myGet('controller') == false) {
	$controller_class = 'Controller' . ucfirst($controller_default);
	if(myGet('action') == false) {
		$controller_class::readAll();
	}
	else {
		$test = new $controller_class; //empêche un warning d'apparaître avec get_class_methods
		$method = get_class_methods($test);
		$action = myGet('action');
		if (in_array($action, $method)) {
			$controller_class::$action(); 
		}
		else {
			ControllerEau::error();
		
		}
	}
}
else {
	$controller_class = 'Controller' . ucfirst(myGet('controller'));

	if(class_exists($controller_class)) {
		if(myGet('action') == false) {
			$controller_class::readAll();
		}
		else {
			//$test = new ControllerVoiture; //empêche un warning d'apparaître avec get_class_methods
			$method = get_class_methods($controller_class);
			$action = myGet('action');
			if (in_array($action, $method)) {
				$controller_class::$action(); 
			}
			else {
				ControllerEau::error();
			
			}
		}
	}
	else {
		ControllerEau::error();

	}	
}

function myGet($nomvar) {
	if(isset($_POST[$nomvar])) {
		return $_POST[$nomvar];
	}
	else if(isset($_GET[$nomvar])) {
		return $_GET[$nomvar];
	}
	else {
		return NULL;
	}
}

?>