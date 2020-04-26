<h4>Liste des produits :</h4>
<table class="table table-bordered" id="product-list">
    <thead>
    <tr class="thead-dark">
        <th scope="col">Nom</th>
        <th scope="col">Prix</th>
        <th scope="col">Quantité</th>
        <th scope="col">Modifier</th>
        <th scope="col">Supprimer</th>
    </tr>
    </thead>
    <?php foreach ($product_list as $product): ?>
    <tbody>
    <tr>
        <th scope="row" class="prodname"><?= $product->__get('name'); ?></th>
        <td class="prodprice"><?= $product->__get('price_total'); ?> €</td>
        <td class="prodqua"><?= $product->__get('quantity'); ?></td>
        <td><button type="button" class="productmodif" productinfo="<?= $product->__get('pk'); ?>">Modifier</button></td>
        <td><form action="index.php" method="post">
            <input type="hidden" name="productdelete" value="<?= $product->__get('pk'); ?>">
            <input type="submit" value="Supprimer" onclick="return confirm('Êtes-vous sur de vouloir supprimer ?')">
        </form></td>
    </tr>
    </tbody>
    <?php endforeach; ?>
</table>