<?php

      echo '<div id="form_create">
      <form method="post" action="index.php">
        <fieldset>
          <legend>Changer mot de passe</legend>
          <p>
            <label for="mdp_id">Ancien mot de passe</label> 
            <br>
            <input type="password" name="mdp" value="';
            if(myGet('mdp')) {
              echo htmlspecialchars(myGet('mdp'));
            }
            echo '" id="mdp_id" required/>
          </p>
          <p>
            <label for="new_mdp">Nouveau mot de passe</label>
            <input type="password" name="newmdp" value="';
            if(myGet('newmdp')) {
              echo htmlspecialchars(myGet('newmdp'));
            }
            echo '" id="new_mdp">
          <p>
          <p>
            <label for="vnew_mdp">Vérifier nouveau mot de passe</label>
            <input type="password" name="vnewmdp" value="';
            if(myGet('vnewmdp')) {
              echo htmlspecialchars(myGet('vnewmdp'));
            }
            echo '" id="vnew_mdp">
          <p>
            <input type="submit" value="Confirmer" />
            <input type="hidden" name="action" value="passwordChanged">
            <input type="hidden" name="login" value="';
            echo htmlspecialchars($_SESSION['login']) . '">
            <input type="hidden" name="controller" value="utilisateur">
          </p>
        </fieldset> 
      </form>

      </div>';
?>   