<?php
$array = array('config', 'Conf.php');
require_once File::build_path($array);

class Model {

	public static $pdo;


	public static function Init(){
		$hostname = Conf::getHostname();
		$database_name = Conf::getDatabase();
		$login = Conf::getLogin();
		$password = Conf::getPassword();
		self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name",$login,$password,  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
 		} catch(PDOException $e) {
			  echo $e->getMessage(); // affiche un message d'erreur
			  die();
			}

	}

	public static function selectAll() {
    	$table_name = static::$object2;
    	$class_name = 'Model' . ucfirst(static::$object);
    	$sql = 'Select * FROM ' . $table_name;
    	$rep = Model::$pdo->query($sql);
    	$rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
    	$tab = $rep->fetchAll();
    	return $tab;
  	}

  	public static function select($primary_value) {
    	$table_name = static::$object2;
    	$class_name = 'Model' . ucfirst(static::$object);
    	$primary_key = static::$primary;
    	try{
	    	$sql = "SELECT * from " . $table_name ." WHERE " . static::$primary . "=:nom_tag";
		    $req_prep = Model::$pdo->prepare($sql);

		    $values = array(
		        "nom_tag" => $primary_value,
		    );  
		    $req_prep->execute($values);
		    $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
		    $objet = $req_prep->fetch();
	  	}
	  	catch(PDOException $e) {
	        echo $e->getMessage();
	        die();
	    }
	    if (empty($objet))
	        return false;
	    return $objet;
	}

	public static function delete($primary_value) {
	    $table_name = static::$object2;
	    $class_name = 'Model' . ucfirst(static::$object);
	    $primary_key = static::$primary;
	    try {
	      	$sql = "DELETE FROM " . $table_name . " WHERE " . static::$primary . " =:nom_tag";
	      	$req_prep = Model::$pdo->prepare($sql);
	      	$values = array(
	        "nom_tag" => $primary_value); 
	      	$req_prep->execute($values);
	    }
	    catch(PDOException $e) {
	      	echo $e->getMessage();
	      	die();
	    }
  	}

  	public static function update($data) {
	    $table_name = static::$object2;
	    $class_name = 'Model' . ucfirst(static::$object);
	    $primary_key = static::$primary;
	    $sql = "UPDATE " . $table_name . " SET ";

	    foreach ($data as $key => $value) {
	      	$sauv2 = $key . '=:' . $key . ',';
	      	$sauv = $key . '=:' . $key;
	      	$sql = $sql . $key . '=:' . $key . ', ';
	    }
	    $sql = str_replace($sauv2, $sauv, $sql);
	    $sql = $sql . ' WHERE ' . $primary_key . "='" . $data[$primary_key] . "';";
	    try {
	      	$req_prep = Model::$pdo->prepare($sql);
	    } catch(PDOException $e) {
	      	if (Conf::getDebug()) {
	        echo $e->getMessage(); // affiche un message d'erreur
	      	} 
	      	else {
	        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
	      	}
	      	die();
	    }
	    $req_prep->execute($data);
  	}

  	public function save() {
	    $table_name = static::$object2;
	    $class_name = 'Model' . ucfirst(static::$object);
	    $primary_key = static::$primary;
	    $sql = "INSERT INTO " . $table_name . " (" . static::$primary . ",";
	    if (static::$primary == "id") {
	      	$sql = $sql . " nom, type, prix, description, qtt, lien_image) VALUES (:id, :nom, :type, :prix, :description, :qtt, :lien_image)";
	      	$data = array( 
	      	'id' => $this->getId(),
	      	'nom' => $this->getNom(),
	      	'type' => $this->getType(),
	      	'prix' => $this->getPrix(),
	      	'description' => $this->getDescription(),
	      	'qtt' => $this->getQtt(),
	      	'lien_image' => $this->getLienImage());
	    }
	    else if (static::$primary == "id_produit") {
	    	$sql = $sql . "id_commande, qtt) VALUES (:id_produit, :id_commande, :qtt)";
	    	$data = array(
	    		'id_commande' => $this->getIdCommande(),
	    		'id_produit' => $this->getIdProduit(),
	    		'qtt' => $this->getQtt());
	    
	    }
	    else if (static::$primary == "login"){
	      	$sql = $sql . "nom,prenom,email,mdp,nonce,id) VALUES (:login, :nom, :prenom, :email, :mdp, :nonce, :id)";
	      	$data = array( 
	      	'id' => $this->getId(),
	      	'login' => $this->getLogin(),
	      	'nom' => $this->getNom(),
	      	'prenom' => $this->getPrenom(),
	      	'email' => $this->getEmail(),
	      	'mdp' => $this->getMdp(),
	      	'nonce' => $this->getNonce()
	      	);
	    }
	    else{
	    	$sql = $sql . "id_utilisateur,date_commande) VALUES (:id_commande, :id_utilisateur, :date_commande)";
	    	$data = array(
	    		'id_commande' => $this->getIdCommande(),
	    		'id_utilisateur' => $this->getIdUtilisateur(),
	    		'date_commande' => $this->getDateCommande());
	   		
	    }
	    
	    try {
	      	$req_prep = Model::$pdo->prepare($sql);
	    } catch(PDOException $e) {
	      	if (Conf::getDebug()) {
	        	echo $e->getMessage(); // affiche un message d'erreur
	      	} 
	      	else {
	        	echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
	      	}
	      	die();
	    }
	    $req_prep->execute($data);
  }

}

Model::Init();
?>