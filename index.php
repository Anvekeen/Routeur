<?php
include 'Product.php';
include 'ProductManager.php';
$product_manager = new ProductManager();
$display = 'list';

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'create') {
    $product = $product_manager->save($_POST);
}

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'update') {
    $product = $product_manager->update($_POST);
}

if(isset($_POST) && isset($_POST['delete'])) {
    $product = $product_manager->delete($_POST['delete']);
}

/*if(isset($_GET) && isset($_GET['pk'])) {
    $product = $product_manager->fetch($_GET['pk']);
    $display = 'one';
} else {*/
    $product_list = $product_manager->fetchAll();
//}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="script.js"></script>
</head>

<body>
<form action="index.php" method="get" id="search-form">
    <h4><label for="pk-search">Effectuer une recherche : </label></h4>
    <input type="number" name="pk" id="pk-search">
    <input type="submit" value="Rechercher">
</form>

<h4>Ajouter ou modifier un produit :</h4>
<form action="index.php" method="post">
    <input type="hidden" name="type" id="test" value="create">
    <label for="name">Nom :</label>
    <input type="text" id="name" name="name">
    <label for="price">Prix :</label>
    <input type="number" id="price" name="price" step="0.01">
    <label for="quantity"> Quantité :</label>
    <input type="number" id="quantity" name="quantity" min="0">
    <input type="submit">
</form>

<section id="ajax-rsp">

</section>

<?php //if($display == 'one') include 'unique_view.php'; ?>
<?php if($display == 'list') include 'table_view.php'; ?>
</body>
</html>