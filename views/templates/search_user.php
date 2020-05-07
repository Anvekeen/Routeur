<?php

include './classes/Users.php';
include './classes/UserDAO.php';

$user_manager = new UserDAO();

if(isset($_GET) && isset($_GET['iduser'])) {
    $user = $user_manager->fetchUser($_GET['iduser']);
    if($user->__get('id') !== null) {
        ?>
        <h2> "<?= $user->__get('username'); ?>" </h2>
    <?php }
    else {
        ?>  <h2>Erreur : Utilisateur non trouvé</h2> <?php }
}?>
