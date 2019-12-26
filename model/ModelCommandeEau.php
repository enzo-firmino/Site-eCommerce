<?php
require_once File::build_path(array('model','Model.php'));
class ModelCommandeEau extends Model{
	private $id_commande;
	private $id_produit;
	private $qtt;

	protected static $object = 'commande_eau';
	protected static $object2 = 'commande_eau';
  protected static $primary = "id_produit";

  	public function getIdCommande() {
  		return $this->id_commande;
  	}

  	public function getIdProduit(){
      return $this->id_produit;
    }

  	public function getQtt() {
  		return $this->qtt;
  	}

	public function __construct($idcommande = NULL, $idproduit = NULL, $qtt = NULL) {
    	if (!is_null($idcommande) && !is_null($idproduit) && !is_null($qtt)) {
      		$this->id_commande = $idcommande;
      		$this->id_produit = $idproduit;
      		$this->qtt = $qtt;      		
    	}
  	}
  }