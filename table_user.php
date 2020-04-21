<h4>Liste des users :</h4>
<table id="product-list">
    <tr>
        <th>Nom</th>
        <th>password</th>
    </tr>
    <?php foreach ($users_list as $user): ?>
        <tr>
            <td class="username"><?= $user->__get('username'); ?></td>
            <td class="userpass"><?= $user->__get('password'); ?></td>
            <td><button type="button" class="usermodif" data-id="<?= $user->__get('pk'); ?>">Modifier</button></td>
            <td><form action="index.php" method="post">
                    <input type="hidden" name="userdelete" value="<?= $user->__get('pk'); ?>">
                    <input type="submit" value="Supprimer" onclick="return confirm('Etes-vous sur de vouloir supprimer ?')">
                </form></td>
        </tr>
    <?php endforeach; ?>

</table>