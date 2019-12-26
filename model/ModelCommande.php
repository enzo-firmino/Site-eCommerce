<?php
require_once File::build_path(array('model','Model.php'));
class ModelCommande extends Model{
	private $id_commande;
	private $id_utilisateur;
	private $date_commande;

	protected static $object = 'commande';
	protected static $object2 = 'commande';
  	protected static $primary = 'id_commande';

  	public function getIdCommande() {
  		return $this->id_commande;
  	}

  	public function getIdUtilisateur() {
  		return $this->id_utilisateur;
  	}

  	public function getDateCommande() {
  		return $this->date_commande;
  	}

	public function __construct($u = NULL) {
    	if (!is_null($u)) {
      		$this->id_commande = ModelCommande::maxId() + 1;
      		$this->id_utilisateur = $u;
      		$this->date_commande = date(DATE_ATOM,time());      	
    	}
  	}

  	public static function maxId() {
	    $sql = "Select MAX(id_commande) from commande";
	    try {
	      $req_prep = Model::$pdo->prepare($sql);
	      $req_prep->execute();
	      $id = $req_prep->fetch(PDO::FETCH_NUM);
	    } catch (PDOException $e) {
	      if (Conf::getDebug()) {
	        echo $e->getMessage(); 
	      }
	      die();
	    }
	 	    
	    if (empty($id)) {
	      return NULL;
	    }
	    else {
	      return $id[0];
	    }
	}

	public static function recupererProduit($idcommande) {
		$sql = "select c.id_commande, c.id_utilisateur, c.date_commande, ce.id_produit, ce.qtt from commande c join commande_eau ce on c.id_commande = ce.id_commande where c.id_commande =:idcommande";
		$array = array (
			'idcommande' => $idcommande
		);
	    try {
	      $req_prep = Model::$pdo->prepare($sql);
	      $req_prep->execute($array);
	      $tab_produit = $req_prep->fetchAll(PDO::FETCH_ASSOC);
	    } catch (PDOException $e) {
	      if (Conf::getDebug()) {
	        echo $e->getMessage(); 
	      }
	      die();
	    }
	    if (empty($tab_produit)) {
	      return NULL;
	    }
	    else {
	      return $tab_produit;
	    }
	}

}