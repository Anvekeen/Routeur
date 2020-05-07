<?php


class Product {

    private $id;
    private $name;
    private $price;
    private $vat;
    private $price_vat;
    private $price_total;
    private $quantity;

    function __construct($id, $name, $price, $vat, $quantity)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->vat = $vat;
        $this->price_vat = ($this->price/100)*$this->vat;
        $this->price_total = ($this->price + $this->price_vat);
        $this->quantity = $quantity;
    }

    function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

}