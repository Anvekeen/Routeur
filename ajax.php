<?php
include 'Product.php';
include 'ProductManager.php';
$productManager = new ProductManager();

if(isset($_GET) && isset($_GET['pk'])) {
    $product = $productManager->fetch($_GET['pk']);
    $display = 'one';
}
?>
<h2> <?= $product->__get('name'); ?> </h2>
