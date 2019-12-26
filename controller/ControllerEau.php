<?php
$array = array('model', 'ModelEau.php');
require_once File::build_path($array); // chargement du modèle
class ControllerEau {
    public static function readAll() {
        $controller = 'eau';
        $view = 'list';
        $pagetitle='Liste des eaux';
        $tab_e = ModelEau::SelectAll();
        require File::build_path(array('view','eau','view.php'));
    }

    public static function read() {
        $id = myGet('id');
        $e = ModelEau::select($id);
        if ($e == NULL) {
            $controller = 'eau';
            $view = 'error';
            $pagetitle='Erreur';
            require File::build_path(array('view','eau','view.php'));
        }
        else {
            $controller = 'eau';
            $view = 'detail';
            $pagetitle='Détail eau';
            require File::build_path(array('view','eau','view.php'));
        }
    }

    public static function create() {
        if(Session::is_admin()) {
            $test = 'required';
            $test2 = 'created';
            $eId = '';
            $eNom = '';
            $eType = '';
            $ePrix = '';
            $eDescription = '';
            $eLienImage = '';
            $eQtt = '';
            $controller = 'eau';
            $view = 'update';
            $pagetitle='Ajouter nouvelle eau';
            require File::build_path(array('view','eau','view.php'));
        }
        else {
            ControllerUtilisateur::refus();
        }
    }

    public static function created() {
        if(Session::is_admin()) {
            $nom = myGet('nom');
            $type = myGet('type');
            $prix = myGet('prix');
            $description = myGet('description');
            $qtt = myGet('qtt');
            $lien_image = myGet('lienImage');
            $eau = new ModelEau($nom,$type,$prix,$description,$qtt,$lien_image);
            $test = $eau->save();
            $controller = 'eau';
            $view = 'created';
            $pagetitle='Eau créée';
            require File::build_path(array('view','eau','view.php'));
        }
        else {
            ControllerUtilisateur::refus();
        }
    }

    public static function delete() {
        if(Session::is_admin()) {
            ModelEau::delete(myGet('id'));
            $controller = 'eau';
            $view = 'deleted';
            $pagetitle='Eau supprimée';
            require File::build_path(array('view','eau','view.php'));
        }
        else {
            ControllerUtilisateur::refus();
        }
    }

    public static function error() {
        $controller = 'eau';
        $view = 'error';
        $pagetitle='Erreur';
        require File::build_path(array('view','eau','view.php'));
    }

    public static function update() {
        if(Session::is_admin()) {
            $test = 'readonly';
            $test2 = 'updated';
            $controller = 'eau';
            $view = 'update';
            $pagetitle='Update eau';
            require File::build_path(array('view','eau','view.php'));
        }
        else {
            ControllerUtilisateur::refus();
        }
    }

    public static function updated() {
        if(Session::is_admin()) {
            $data = array(
                'id' => myGet('id'),
                'nom' => myGet('nom'),
                'type' => myGet('type'),
                'prix' => myGet('prix'),
                'description' => myGet('description'),
                'qtt' => myGet('qtt'),
                'lien_image' => myGet('lienImage')
            );
            ModelEau::update($data);
            $controller = 'eau';
            $view = 'updated';
            $pagetitle='Eau update';
            require File::build_path(array('view','eau','view.php'));
        }
        else {
            ControllerUtilisateur::refus();
        }
    }

    public static function ajoutPanier() {
        $id = myGet('id');
        $eau = ModelEau::select($id);
        $nom = str_replace(' ','-', $eau->getNom());
        if (isset($_COOKIE[$nom])) {
            $val = $_COOKIE['Qtt' . $nom];
            setcookie('Qtt' . $nom, $val + 1, time()+1800);
        }
        else {
            setcookie($nom, serialize($eau), time()+1800);
            setcookie('Qtt' . $nom, 1, time()+1800);
        }
        $_SESSION['prixPanier'] = $_SESSION['prixPanier'] + $eau->getPrix();
        ControllerEau::read();
        header("Location: http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=read&id=" . $eau->getId());
        exit;
    }

    public static function ajoutPanierPanier() {
        $id = myGet('id');
        $eau = ModelEau::select($id);
        $nom = str_replace(' ','-', $eau->getNom());
        if (isset($_COOKIE[$nom])) {
            $val = $_COOKIE['Qtt' . $nom];
            setcookie('Qtt' . $nom, $val + 1, time()+1800);
        }
        else {
            setcookie($nom, serialize($eau), time()+1800);
            setcookie('Qtt' . $nom, 1, time()+1800);
        }
        $_SESSION['prixPanier'] = $_SESSION['prixPanier'] + $eau->getPrix();

        header("Location: http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce?action=afficherPanier&controller=utilisateur");
        exit;
    }




    public static function retirerPanier(){
        $id = myGet('id');
        $eau = ModelEau::select($id);
        $nom = str_replace(' ','-', $eau->getNom());
        $val = $_COOKIE['Qtt' . $nom];

        if($_COOKIE['Qtt' . $nom] == 1){
            setcookie($nom, NULL, -1);
            setcookie('Qtt' . $nom, NULL, -1);
        }
        else{
            setcookie('Qtt' . $nom, $val-1, time()+1800);
        }

        
        header("Location: http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce?action=afficherPanier&controller=utilisateur");
        exit;
    }

    public static function supprimerPanier(){
        $id = myGet('id');
        $eau = ModelEau::select($id);
        $nom = str_replace(' ','-', $eau->getNom());
        $val = $_COOKIE['Qtt' . $nom];
        setcookie($nom, NULL, -1);
        setcookie('Qtt' . $nom, NULL, -1);
        
        header("Location: http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce?action=afficherPanier&controller=utilisateur");
        exit;
    }        
}
?>