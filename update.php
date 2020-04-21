<?php
include 'Product.php';
include 'ProductManager.php';
include 'Users.php';
include 'UserManager.php';

$product_manager = new ProductManager();
$user_manager = new UserManager();

if (isset($_POST) && isset($_POST['id'])) {
    $prod = $product_manager->fetch($_POST['id']);
    $produit = [
        'pk' => $prod->__get('pk'),
        'name' => $prod->__get('name'),
        'price_total' => $prod->__get('price_total'),
        'quantity' => $prod->__get('quantity')
    ];
    echo json_encode($produit);
}

if (isset($_POST) && isset($_POST['userid'])) {
    $u = $user_manager->fetch($_POST['userid']);
    $user = [
        'pk' => $u->__get('pk'),
        'username' => $u->__get('username'),
        'password' => $u->__get('password')
    ];
    echo json_encode($user);
}