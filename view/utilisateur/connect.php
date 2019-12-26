<?php

      echo '<div id="form_create">
      <form method="post" action="index.php">
        <fieldset>
          <legend>Connexion</legend>
          <p>';
          if (isset($panier)) {
            echo $panier;
            echo'Veuillez vous connecter avant de valider le panier';
          }
           echo '<label for="login_id">Login</label>
            <br> 
            <input type="text" placeholder="Ex : firminoe" name="login" id="login_id" value ="';
            if(myGet('login')) {
              echo myGet('login') . '"';
            }
            else{
              echo'" ' ;
            }
            echo 'required/>
          </p>
          <p>
            <label for="mdp_id">Mot de passe</label> 
            <br>
            <input type="password" name="mdp" id="mdp_id" value="';
            if(myGet('mdp')) {
              echo myGet('mdp'). '"';
            }
            else{
              echo'" ' ;
            }
            echo 'required/>
          </p>
          <p>
            <label for="check_remind">Se souvenir</label>
            <input type="checkbox" name="remind" id="check_remind"';
            if(myGet('remind')) {
              if (strcmp(myGet('remind'),'on') == 0) {
              echo 'checked="checked';
              }
            }
            echo '>
          <p>
            <input type="submit" value="Se connecter" />
            <input type="hidden" name="action" value="connected">
            <input type="hidden" name="controller" value="utilisateur">
          </p>
           <div id="div_inscrire"> <a id="inscrire" href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=create&controller=utilisateur"> S\'inscrire </a> </div>
        </fieldset> 
      </form>

      </div>';
?>   