<?php
spl_autoload_register(function($class) {
    if($class == "Router") {
        include "router/Router.php";
    } else if (strpos($class, "Controller")) {
        include "controllers/{$class}.php";
    } else if (strpos($class, "View")) {
        include "views/{$class}.php";
    } else if (strpos($class, "Behaviour")) {
        include "models/dao/{$class}.php";
    } else if (strpos($class, "DAO") || strpos($class, "DAO") === 0) {
        include "models/dao/{$class}.php";
    } else {
        include "models/entities/{$class}.php";
    }
});

$router = new Router($_GET, $_POST, $_SERVER['PHP_SELF'], $_SERVER['REQUEST_URI']);

/*$productDAO = new ProductDAO();
$productDAO->delete(0);
$productDAO->__set('deleteBehaviour', 'HardDeleteBehaviour');
$productDAO->delete(0);
$productDAO->__set('deleteBehaviour', 'SoftDeleteBehaviour');
$productDAO->delete(0);*/

/*

<?php
include './classes/Product.php'; //require = si erreur, stoppe l'exécution - include = si erreur, seulement warning mais code continue
include './classes/ProductDAO.php';  //once = surtout utile si des includes ou quoi en cascade ! Prof considère que comme on force le chargement une seule fois ça éviterait des probs si on l'avait include plusieurs fois... comme un "pansement", pas top
include './classes/Users.php';          // "Comme include est une structure de langage particulière, les parenthèses ne sont pas nécessaires autour de l'argument. Faites attention lorsque vous comparez la valeur retournée." [  s'écrit : if ((include 'vars.php') == TRUE)  ]
include './classes/UserDAO.php';

$product_manager = new ProductDAO();
$user_manager = new UserDAO();

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'productcreate') {
    $newpost = array_map('htmlspecialchars', $_POST);  //thx stackoverflow
    $product = $product_manager->saveProduct($newpost);

}

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'productupdate') {
    $newpost = array_map('htmlspecialchars', $_POST);
    $product = $product_manager->updateProduct($newpost);

}

if(isset($_POST) && isset($_POST['productdelete'])) {
    $product = $product_manager->deleteProduct($_POST['productdelete']);

}

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'usercreate') {
    $newpost = array_map('htmlspecialchars', $_POST);
    $user = $user_manager->saveUser($newpost);

}

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'userupdate') {
    $newpost = array_map('htmlspecialchars', $_POST);
    $user = $user_manager->updateUser($newpost);

}

if(isset($_POST) && isset($_POST['userdelete'])) {
    $user = $user_manager->deleteUser($_POST['userdelete']);

}

    $product_list = $product_manager->fetchAll();
    $user_list = $user_manager->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>
<div class="container">
    <div class="row">

        <div class="col border border-secondary text-center">

            <h3> Jeux Vidéos</h3>

            <form action="index.php" method="get" id="product-search-form">
                <div class="form-group">
                <h4><label for="pk-search">Effectuer une recherche : </label></h4>
                <input class="form-control" type="number" min="0" name="PKprod" id="PKsearchProduct" required>
                </div>
                <input type="submit" value="Rechercher">
            </form>

            <h4>Ajouter ou modifier un produit :</h4>

            <form action="index.php" method="post">
                <input type="hidden" name="type" id="productType" value="productcreate">
                <input type="hidden" name="productpk" id="productpk">
                <div class="form-group">
                <label for="name">Nom :</label>
                <input class="form-control" type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                <label for="price">Prix (sans TVA) :</label>
                <input class="form-control" type="number" id="price" name="price" min="0" step="0.01" required>
                </div>
                <div class="form-group">
                <label for="vat">TVA (%) :</label>
                <input class="form-control" type="number" id="vat" name="vat" min="0" max="100" step="0" required>
                </div>
                <div class="form-group">
                <label for="quantity"> Quantité :</label>
                <input class="form-control" type="number" id="quantity" name="quantity" min="0" required>
                </div>
                <input type="submit">
            </form>

            <section id="searchProduct">
            </section>
            <?php include 'table_product.php'; ?>

        </div>

        <div class="col border border-secondary text-center">

            <h3> Utilisateurs</h3>

            <form action="index.php" method="get" id="user-search-form">
                <div class="form-group">
                <h4><label for="user-pk-search">Effectuer une recherche : </label></h4>
                <input class="form-control" type="number" min="0" name="PKuser" id="PKsearchUser" required>
                </div>
                <input type="submit" value="Rechercher">
            </form>

            <h4>Ajouter ou modifier un utilisateur :</h4>

            <form action="index.php" method="post">
                <input type="hidden" name="type" id="userType" value="usercreate">
                <input type="hidden" name="userpk" id="userpk">
                <div class="form-group">
                <label for="username">Nom :</label>
                <input class="form-control" type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input class="form-control" type="password" pattern="(?=.*\d)(?=.*[A-Z]).{8,}" id="password" name="password" required>
                <small id="passInfo" class="form-text text-muted">*Votre mot de passe doit contenir au moins 8 caractères, un chiffre et une lettre majuscule.</small>
                </div>
                <input type="submit">
            </form>

            <section id="searchUser">
            </section>
            <?php include 'table_user.php'; ?>

        </div>

    </div>
</div>



</body>
</html>

*/