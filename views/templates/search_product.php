<?php

if($product->__get('id') !== null) {
        ?>
        <h2> "<?= $product->__get('name'); ?>" </h2>
    <?php }
    else {
        ?>  <h2>Erreur : Produit non trouvé</h2> <?php }
}?>

