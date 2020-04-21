<?php
include 'Product.php';
include 'ProductManager.php';
include 'Users.php';
include 'UserManager.php';

$product_manager = new ProductManager();
$user_manager = new UserManager();

if(isset($_GET) && isset($_GET['pk'])) {
    $product = $product_manager->fetch($_GET['pk']);
    $display = 'one';
}
?>
<h2> <?= $product->__get('name'); ?> </h2>

<?php
if(isset($_GET) && isset($_GET['userpk'])) {
$user = $user_manager->fetch($_GET['userpk']);
$display = 'one';
}
?>
<h2> <?= $user->__get('username'); ?> </h2>
