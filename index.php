<?php
include 'Product.php';
include 'ProductManager.php';
include 'Users.php';
include 'UserManager.php';

$product_manager = new ProductManager();
$user_manager = new UserManager();

$display = 'list';

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'create') {
    $product = $product_manager->save($_POST);
    var_dump($_POST);
}

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'update') {
    $product = $product_manager->update($_POST);
    var_dump($_POST);
}

if(isset($_POST) && isset($_POST['delete'])) {
    $product = $product_manager->delete($_POST['delete']);
    var_dump($_POST);
}

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'usercreate') {
    $user = $user_manager->save($_POST);
    var_dump($_POST);
}

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'userupdate') {
    $user = $user_manager->update($_POST);
    var_dump($_POST);
}

if(isset($_POST) && isset($_POST['userdelete'])) {
    $user = $user_manager->delete($_POST['delete']);
    var_dump($_POST);
}


/*if(isset($_GET) && isset($_GET['pk'])) {
    $product = $product_manager->fetch($_GET['pk']);
    $display = 'one';
} else {*/
    $product_list = $product_manager->fetchAll();
    $users_list = $user_manager->fetchAll();
//}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="script.js"></script>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col border border-secondary text-center">
        <h3> Jeux Vidéos</h3>
<form action="index.php" method="get" id="search-form">
    <h4><label for="pk-search">Effectuer une recherche : </label></h4>
    <input type="number" name="pk" id="pk-search">
    <input type="submit" value="Rechercher">
</form>

<h4>Ajouter ou modifier un produit :</h4>
<form action="index.php" method="post">
    <input type="hidden" name="type" id="test" value="create">
    <input type="hidden" name="id" id="id">
    <label for="name">Nom :</label>
    <input type="text" id="name" name="name">
    <br>
    <label for="price">Prix :</label>
    <input type="number" id="price" name="price" step="0.01">
    <br>
    <label for="quantity"> Quantité :</label>
    <input type="number" id="quantity" name="quantity" min="0">
    <input type="submit">
</form>

<section id="ajax-rsp">

</section>

<?php //if($display == 'one') include 'unique_view.php'; ?>
<?php if($display == 'list') include 'table_view.php'; ?>
</div>

        <div class="col border border-secondary text-center">
            <h3 class="text-center"> Utilisateurs</h3>
    <form action="index.php" method="get" id="user-search-form">
        <h4><label for="user-pk-search">Effectuer une recherche : </label></h4>
        <input type="number" name="pk" id="user-pk-search">
        <input type="submit" value="Rechercher">
    </form>

    <h4>Ajouter ou modifier un utilisateur :</h4>
    <form action="index.php" method="post">
        <input type="hidden" name="type" id="usertest" value="usercreate">
        <input type="hidden" name="userid" id="userid">
        <label for="username">Nom :</label>
        <input type="text" id="username" name="username">
        <label for="password">Prix :</label>
        <input type="password" id="password" name="password">
        <input type="submit">
    </form>

    <section id="ajax-rsp">

    </section>

    <?php //if($display == 'one') include 'unique_view.php'; ?>
    <?php if($display == 'list') include 'table_user.php'; ?>
        </div>
    </div>
</div>



</body>
</html>