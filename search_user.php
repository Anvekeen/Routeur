<?php

include 'Users.php';
include 'UserManager.php';

$user_manager = new UserManager();

if(isset($_GET) && isset($_GET['userpk'])) {
    $user = $user_manager->fetch($_GET['userpk']);
    $display = 'one';
}
?>
<h2> <?= $user->__get('username'); ?> </h2><?php
