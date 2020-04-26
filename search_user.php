<?php

include './classes/Users.php';
include './classes/UserManager.php';

$user_manager = new UserManager();

if(isset($_GET) && isset($_GET['PKuser'])) {
    $user = $user_manager->fetchUser($_GET['PKuser']);
    if($user->__get('pk') !== null) {
        ?>
        <h2> "<?= $user->__get('username'); ?>" </h2>
    <?php }
    else {
        ?>  <h2>Erreur : Utilisateur non trouvé</h2> <?php }
}?>
