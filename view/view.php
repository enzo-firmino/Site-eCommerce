<?php
    File::build_path(array("lib", "Session"));
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="icon" type="image/png" href="img/logo_icon.ico"/>
        <link rel="stylesheet" type="text/css" href="styles.css"/>
   
        <link rel="stylesheet" type="text/css" href="stylesviewlist.css"/>
        <link rel="stylesheet" type="text/css" href="stylesviewdetailproduit.css"/>
        <link rel="stylesheet" type="text/css" href="stylesviewpanier.css"/>
        <link rel="stylesheet" type="text/css" href="stylesviewdetail.css"/>
        <link rel="stylesheet" type="text/css" href="stylesviewconnect.css"/>
        <link rel="stylesheet" type="text/css" href="stylesviewconnectedcreatedupdated.css"/>
        <link rel="stylesheet" type="text/css" href="stylesviewcompte.css"/>
        <link href="https://fonts.googleapis.com/css?family=Cormorant+Upright&display=swap" rel="stylesheet"/> 
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet"/>
        <title>Eau'Plaisir</title>
    </head>

    
    <header>
        <div id="myNavbar">
            <div id="logo">
                <a href="#ancre_haut" class="navitem"></a>
                <img src="img/logo.png" alt="logo">
                <h1>Eau'Plaisir</h1>
            </div>
            <div id="myMenu">
                <a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/" class="nav_section">NOS PRODUITS</a>
                <a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce?action=afficherPanier&controller=utilisateur" class="nav_section">PANIER</a>
                <?php 
                if (!Session::connect()) {
                    echo'<a href="index.php?action=create&controller=utilisateur" class="nav_section">S\'INSCRIRE</a>';
                    echo '<a href="index.php?action=connect&controller=utilisateur" class="nav_section">SE CONNECTER</a>';
                }
                else {
                    echo '<a href="index.php?action=afficherCompte&controller=utilisateur" class="nav_section">VOTRE COMPTE</a>';
                    echo '<a href="index.php?action=deconnect&controller=utilisateur" class="nav_section">SE DECONNECTER</a>';
                }
                ?>
            </div>
        </div>
    </header>

    <body>
		<?php
		// Si $controleur='eau' et $view='list',
		// alors $filepath="/chemin_du_site/view/eau/list.php"
		$filepath = File::build_path(array("view", $controller, "$view.php"));
		require $filepath;
		?>
    </body>

</html>