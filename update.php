<?php
include 'Product.php';
include 'ProductManager.php';
$productManager = new ProductManager();

if (isset($_POST) && isset($_POST['id'])) {
    $prod = $productManager->fetch($_POST['id']);
    $produit = [
        'name' => $prod->__get('name'),
        'price_total' => $prod->__get('price_total'),
        'quantity' => $prod->__get('quantity'),
    ];
    echo json_encode($produit);
}