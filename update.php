<?php
include './classes/Product.php';
include './classes/ProductManager.php';
include './classes/Users.php';
include './classes/UserManager.php';

$product_manager = new ProductManager();
$user_manager = new UserManager();

if (isset($_POST) && isset($_POST['productid'])) {
    $prod = $product_manager->fetchProduct($_POST['productid']);
    $produit = [
        'pk' => $prod->__get('pk'),
        'name' => $prod->__get('name'),
        'price' => $prod->__get('price'),
        'vat' => $prod->__get('vat'),
        'quantity' => $prod->__get('quantity')
    ];
    echo json_encode($produit);
}

if (isset($_POST) && isset($_POST['userid'])) {
    $u = $user_manager->fetchUser($_POST['userid']);
    $user = [
        'pk' => $u->__get('pk'),
        'username' => $u->__get('username'),
        'password' => $u->__get('password')
    ];
    echo json_encode($user);
}