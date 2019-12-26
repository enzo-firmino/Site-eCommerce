<?php
//$controller = static::$object;
if(Session::is_admin()) {
  if (strcmp('readonly',$test ) == 0) {
    $e = ModelEau::select(myGet('id'));
    $eId = htmlspecialchars($e->getId());
    $eNom = htmlspecialchars($e->getNom());
    $eType = htmlspecialchars($e->getType());
    $ePrix = htmlspecialchars($e->getPrix());
    $eDescription = htmlspecialchars($e->getDescription());
    $eLienImage = htmlspecialchars($e->getLienImage());
    $eQtt = htmlspecialchars($e->getQtt());
  }

        echo '<form method="post" action="index.php">
          <fieldset>
            <legend>Créer eau :</legend>
            <p>
              <label for="nom_id">Nom</label> 
              <input type="text" name="nom" id="nom_id" value="';
              if(myGet('nom')) {
                echo myGet('nom');
              }
              else {
                echo $eNom;
              }
              echo '" required/>
            </p>
            <p>
              <label for="type_id">Type</label> 
              <input type="text" name="type" id="type_id" value="';
              if(myGet('type')) {
                echo myGet('type');
              }
              else {
                echo $eType;
              }
              echo '"required/>
            </p>
            <p>
              <label for="prix_id">Prix</label> 
              <input type="text" name="prix" id="prix_id" value="';
              if(myGet('prix')) {
                echo myGet('prix');
              }
              else {
                echo $ePrix;
              }
              echo '"required/>
            </p>
            <p>
              <label for="description_id">Description</label> 
              <input type="text" name="description" id="description_id" value="';
              if(myGet('description')) {
                echo myGet('description');
              }
              else {
                echo $eDescription;
              }
              echo '"required/>
            </p>
            <p>
              <label for="lienImage_id">Lien Image</label> 
              <input type="text" name="lienImage" id="lienImage_id" value="';
              if(myGet('lienImage')) {
                echo myGet('lienImage');
              }
              else {
                echo $eLienImage;
              }
              echo '"required/>
            </p>
            <p>
              <label for="qtt_id">Quantité</label> 
              <input type="text" name="qtt" id="quantité_id" value="';
              if(myGet('qtt')) {
                echo myGet('qtt');
              }
              else {
                echo $eQtt;
              }
              echo '"required/>
            </p>
            <p>
              <input type="submit" value="Envoyer" />
              <input type="hidden" name="action" value="'. $test2 . '">
              <input type="hidden" name="controller" value="eau">
              <input type="hidden" name="id" value="'. $eId . '">

            </p>
          </fieldset> 
        </form>';
}
?>  