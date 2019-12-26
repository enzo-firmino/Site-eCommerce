<?php

echo '<div id="list_all_eau">';
foreach ($tab_e as $e) {
    $eId2 = rawurlencode($e->getId()); 
    $eLienImg = htmlspecialchars($e->getLienImage());
    $eNom = htmlspecialchars($e->getNom());
    echo '<div class="eau"> 
     <a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=read&id=' . $eId2 . '"><img src="' . $eLienImg . '" alt="image eau"></a>
     <br>
     <a href="http://webinfo.iutmontp.univ-montp2.fr/~firminoe/eCommerce/index.php?action=read&id=' . $eId2 . '">' . $eNom . '</a>
     </div>';
    
}
echo '</div>';

?>