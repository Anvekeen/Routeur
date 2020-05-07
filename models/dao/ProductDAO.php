<?php
//dao = data acces object
//dal = data access layer

//include
class ProductDAO extends DAO {
    protected $table;
    protected $deleteBehaviour;
    protected $properties;

    function __construct() {
        $this->table = 'products';
        $this->properties = ['id', 'name', 'price', 'vat', 'price_vat', 'price_total', 'quantity'];
        $this->deleteBehaviour = new HardDeleteBehaviour();
        parent::__construct();
    }

    function create($data) {
        //$data['vat'] ? $data['vat] : 0;
        //condition ? si oui : si non;
        return new Product(
            $data['id'],
            $data['name'],
            $data['price'],
            $data['vat'] ? $data['vat'] : 0,
            $data['quantity']
        );
    }



}
