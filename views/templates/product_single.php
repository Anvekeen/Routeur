<?php if ($product && $product->__get('name')) { ?>
<h1> <?= $product->__get('name'); ?></h1>
<?php } else { ?>
<h1>AUCUN PRODUIT</h1>

<?php }

/*
if(isset($_GET) && isset($_GET['idprod'])) {
    $product = $product_manager->fetch($_GET['idprod']);
    if($product->__get('id') !== null) {
        ?>
        <h2> "<?= $product->__get('name'); ?>" </h2>
    <?php }
    else {
        ?>  <h2>Erreur : Produit non trouvé</h2> <?php }
}?>
*/
