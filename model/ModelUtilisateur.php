<?php
require_once File::build_path(array('model','Model.php'));
class ModelUtilisateur extends Model{
   
  private $id;
  private $login;
  private $nom;
  private $prenom;
  private $email;
  private $mdp;
  private $nonce;

  protected static $object = 'utilisateur';
  protected static $object2 = 'utilisateur2';
  protected static $primary = 'login';
          
  public function getId() {
    return $this->id;
  }

  public function getLogin() {
    return $this->login;  
  }

  public function getNom() {
    return $this->nom;
  }

  public function getPrenom() {
    return $this->prenom;
  }

  public function getEmail() {
    return $this->email;  
  }

  public function getMdp() {
    return $this->mdp;
  }

  public function getNonce() {
    return $this->nonce;  
  }


  public function setId($id2) {
    $this->id = $id2;
  } 

  public function setLogin($login2) {
    $this->login = $login2;
  }

  public function setNom($nom2) {
    $this->nom = $nom2;
  }

  public function setPrenom($prenom2) {  
    $this->prenom = $prenom2;
  }

  public function setMdp($mpd2) {
    $this->mdp = $prenom2;
  }
      
  /* un constructeur
  public function __construct($m, $c, $i)  {
   $this->marque = $m;
   $this->couleur = $c;
   $this->immatriculation = $i;
  } 
  */
  // constructeur sans paramètre
  public function __construct($l = NULL, $n = NULL, $p = NULL,$e = NULL, $m = NULL, $nonce = NULL) {
    if (!is_null($l) && !is_null($n) && !is_null($p) && !is_null($m) && !is_null($e) && !is_null($nonce)) {
      $test = ModelUtilisateur::maxId();
      $this->id = 1 + $test;
      $this->login = $l;
      $this->nom = $n;
      $this->prenom = $p;
      $this->email = $e;
      $this->mdp = $m;
      $this->nonce = $nonce;
    }
  }      

  public static function maxId() {
    $sql = "Select MAX(id) from utilisateur2";
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

  public static function checkPassword($login,$mot_de_passe_chiffre) {
    $sql = "Select * FROM utilisateur2 where login =:login AND mdp =:mdp";
    try {
      $req_prep = Model::$pdo->prepare($sql);
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
      }
      die();
    }
    $values = array(
      'login' => $login,
      'mdp' => $mot_de_passe_chiffre
    );
    try {
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
      $utilisateur = $req_prep->fetch();
    } catch(PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
        return false;
      } else {
        return true;
      }
    }
    if (!empty($utilisateur)) {
      return true;
    }
    else {
      return false;
    }
  }

  public static function admin($login) {
    $sql = "Select * from utilisateur2 where login=:login AND admin=1";
    try {
      $req_prep = Model::$pdo->prepare($sql);
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
    $values = array(
      'login' => $login
    );
  try {
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
      $utilisateur = $req_prep->fetch();
    } catch(PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
        return false;
      } else {
        return true;
      }
    }
    if (!empty($utilisateur)) {
      return true;
    }
    else {
      return false;
    }
  }

  public static function testNonce($login) {
    $sql = "Select * from utilisateur2 where login=:login";
    try {
      $req_prep = Model::$pdo->prepare($sql);
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
    $values = array(
      'login' => $login,
    );
  try {
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
      $utilisateur = $req_prep->fetch();
    } catch(PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
        return false;
      } else {
        return true;
      }
    }
    if (!empty($utilisateur)) {
      if (strcmp($utilisateur->getNonce(), 'NULL') == 0) {
        return true;
      }
      else {
        return false;
      }
    }
    else {
      return false;
    }
  }

  public static function updateNonce($login,$nonce) {
      
    $sql = "UPDATE utilisateur2 SET nonce = :nonce WHERE login = :login";
    try {
      $req_prep = Model::$pdo->prepare($sql);
    } catch(PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
    $values = array(
      'login' => $login,
      'nonce' => 'NULL'
    );
    $req_prep->execute($values);
  }

  public static function checkLoginEmail($login,$email) {
    $sql = "Select * from utilisateur2 where email=:email
    or login=:login";
    $values = array(
      'email' => $email,
      'login' => $login
    );
    try {
      $req_prep = Model::$pdo->prepare($sql);
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
      $utilisateur = $req_prep->fetch();
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); 
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
    if (!empty($utilisateur)) {
      return false;
    }
    else {
      return true;
    }
  }

  public function recupererHistorique() {
    $sql = "Select id_commande from commande where id_utilisateur=:id";
    $values = array(
      'id' => $this->id
    );
    try {
      $req_prep = Model::$pdo->prepare($sql);
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_ASSOC);
      $commande = $req_prep->fetchAll();
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); 
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
    if (empty($commande)) {
      return NULL;
    }
    else {
      return $commande;
    }
  }

  public static function changePassword($login,$mdp) {
    $sql = "Update utilisateur2 set mdp =:mdp where login=:login";
    $values = array(
      'mdp' => $mdp,
      'login' => $login
    );
    try {
      $req_prep = Model::$pdo->prepare($sql);
      $req_prep->execute($values);
    
    } catch (PDOException $e) {
      if (Conf::getDebug()) {
        echo $e->getMessage(); 
      } else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }
}