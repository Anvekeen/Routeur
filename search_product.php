<?php
include './classes/Product.php';
include './classes/ProductManager.php';

$product_manager = new ProductManager();

if(isset($_GET) && isset($_GET['PKprod'])) {
    $product = $product_manager->fetchProduct($_GET['PKprod']);
    if($product->__get('pk') !== null) {
        ?>
        <h2> "<?= $product->__get('name'); ?>" </h2>
    <?php }
    else {
        ?>  <h2>Erreur : Produit non trouvé</h2> <?php }
}?>

