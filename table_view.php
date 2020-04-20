<h4>Liste des produits :</h4>
<table id="product-list">
    <tr>
        <th>Nom</th>
        <th>Prix</th>
        <th>Quantité</th>
    </tr>
    <?php foreach ($product_list as $product): ?>
    <tr>
        <td class="prodname"><?= $product->__get('name'); ?></td>
        <td class="prodprice"><?= $product->__get('price'); ?></td>
        <td class="prodqua"><?= $product->__get('quantity'); ?></td>
        <td><button type="button" class="modif" data-id="<?= $product->__get('pk'); ?>">Modifier</button></td>
        <td><form action="index.php" method="post">
            <input type="hidden" name="delete" value="<?= $product->__get('pk'); ?>">
            <input type="submit" value="Supprimer" onclick="return confirm('Etes-vous sur de vouloir supprimer ?')">
        </form></td>
    </tr>
    <?php endforeach; ?>

</table>