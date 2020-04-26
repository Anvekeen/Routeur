<?php

include_once 'DAO.php';

class ProductManager extends DAO {

    protected $db = "demo";
    protected $table = "products";
    //private $product_list;


    function create($data) {
        return new Product(
            $data['pk'],
            $data['name'],
            $data['price'],
            $data['vat'],
            $data['quantity']
        );
    }

    function saveProduct($data) {
        $data['pk'] = -1; //pour la setter car si on passe rien ds le construct de produit il ne sera pas content
        $product = $this->create([
            'pk' => $data['pk'],
            'name' =>$data['name'],
            'price' => $data['price'],
            'vat' => $data['vat'],
            'quantity'=> $data['quantity']
        ]);
        if ($product) {
            $colfields = "name, price, vat, price_vat, price_total, quantity";
            $numfields= "?, ?, ?, ?, ?, ?";
            $object = array($product->__get('name'),
                $product->__get('price'),$product->__get('vat'),$product->__get('price_vat'),
                $product->__get('price_total'),$product->__get('quantity'));
            parent::save($colfields, $numfields, $object);
        }
    }

    function updateProduct($params)
    {
        $product = $this->create([
            'pk' => $params['productpk'],
            'name' => $params['name'],
            'price' => $params['price'],
            'vat' => $params['vat'],
            'quantity' => $params['quantity']
        ]);
        if ($product) {
            $colfields = 'name = ?, price = ?, vat = ?, price_vat = ?, price_total = ?, quantity = ?';
            $numfields = 'pk = ?';
            $object = array($product->__get('name'),
                $product->__get('price'), $product->__get('vat'), $product->__get('price_vat'),
                $product->__get('price_total'), $product->__get('quantity'), $product->__get('pk'));
            parent::update($colfields, $numfields, $object);
        }
    }

    function fetchProduct($id) {  //pourrait check si $id bien int mais déjà check dans form html, pas sûr qu'utile
        $colfields = "pk";
        $numfields= "?";
        $result = parent::fetch($colfields, $numfields, $id);
        return $this->create($result);
    }

    function deleteProduct($id) {
    $colfields = "pk";
    $numfields= "?";
    parent::delete($colfields, $numfields, $id);
}

}