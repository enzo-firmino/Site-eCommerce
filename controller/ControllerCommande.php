<?php
$array = array('model', 'ModelCommande.php');
require_once File::build_path($array); // chargement du modèle
$array2 = array('model', 'ModelCommandeEau.php');
require_once File::build_path($array2); // chargement du modèle

class ControllerCommande {
    public static function readAll() {
        if(Session::is_admin()) {
            $controller = 'commande';
            $view = 'list';
            $pagetitle='Liste des commandes';
            $tab_c = ModelCommande::SelectAll();
            require File::build_path(array('view','commande','view.php'));
        }
        else {
            $controller = 'eau';
            $view = 'refus';
            $pagetitle='Accès refusé';
            $tab_c = ModelCommande::SelectAll();
            require File::build_path(array('view','eau','view.php'));
        }
    }

    public static function read() {
        $id_commande = myGet('id_commande');
        $c = ModelCommande::select($id_commande);
        if ($c == NULL) {
            $controller = 'commande';
            $view = 'error';
            $pagetitle='Erreur';
            require File::build_path(array('view','eau','view.php'));
        }
        else {
            $controller = 'commande';
            $view = 'detail';
            $pagetitle='Détail commande';
            require File::build_path(array('view','commande','view.php'));
        }
    }

    public static function create() {
        if(Session::is_admin()||Session::is_user($_SESSION['login'])) {
            $test = 'required';
            $test2 = 'created';
            $cId_commande = '';
            $eId_utilisateur = '';
            $eDate_commande = '';
            $controller = 'commande';
            $view = 'update';
            $pagetitle='Ajouter nouvelle commande';
            require File::build_path(array('view','commande','view.php'));
        }
        else {
            ControllerUtilisateur::connect();
        }
    
    }

    public static function created() {
        if(Session::is_admin()) {
            $id_utilisateur = myGet('id_utilisateur');
            $commande = new ModelCommande($id_utilisateur);
            $test = $commande->save();
            $controller = 'commande';
            $view = 'created';
            $pagetitle='Commande créée';
            require File::build_path(array('view','commande','view.php'));
        }
        else {
            ControllerUtilisateur::connect();
        }
    }

    public static function delete() {
        if(Session::is_admin()) {
            ModelCommande::delete(myGet('id_commande'));
            $controller = 'commande';
            $view = 'deleted';
            $pagetitle='Commande supprimée';
            require File::build_path(array('view','commande','view.php'));
        }
        else {
            ControllerUtilisateur::connect();
        }
    }

    public static function update() {
        if(Session::is_admin()) {
            $test = 'readonly';
            $test2 = 'updated';
            $controller = 'commande';
            $view = 'update';
            $pagetitle='Update commande';
            require File::build_path(array('view','commande','view.php'));
        }
        else {
            ControllerUtilisateur::connect();
        }
    }

    public static function updated() {
        $data = array(
            'id_utilisateur' => myGet('id_utilisateur')
        );
        ModelCommande::update($data);
        $controller = 'commande';
        $view = 'updated';
        $pagetitle='commande update';
        require File::build_path(array('view','commande','view.php'));
    }

    public static function detailProduits() {
        $controller = 'commande';
        $view = 'detailProduits';
        $pagetitle='Detail produit commande';
        require File::build_path(array('view','commande','view.php'));
    }

    public static function validerCommande(){
        if(isset($_SESSION['login'])) {
            $utilisateur = ModelUtilisateur::select($_SESSION['login']);
            $id_utilisateur = $utilisateur->getId();
            $commande = new ModelCommande($id_utilisateur);
            $commande->save();
            $listePanier = myGet('listePanier');
            
            $id_commande  = $commande->getIdCommande();
            $listeIdEau2 = str_split($listePanier);
            foreach ($listeIdEau2 as $IdEau) {
                if(strcmp($IdEau, '.') == 0) {

                }
                else {
                    $eau = ModelEau::select($IdEau);
                    $nomEau = $eau->getNom();
                    $nom = str_replace(' ','-', $nomEau);

                    $qtt = $_COOKIE['Qtt' . $nom];
                    $commande_eau = new ModelCommandeEau($id_commande, $IdEau, $qtt);
                    $commande_eau->save();
                    setcookie($nom, NULL, -1);
                    setcookie('Qtt' . $nom, NULL, -1);
                }
            }
            $controller = 'commande';
            $view = 'validerCommande';
            $pagetitle='Commande validée';
            require File::build_path(array('view','commande','view.php'));
        }
        else {
            setcookie('panier','test',time()+30);
            ControllerUtilisateur::connect();
        }

    }
}