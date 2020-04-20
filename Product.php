<?php


class Product {
    //protected?
    private $pk;
    private $name;
    private $price;
    private $vat;
    private $price_vat;
    private $price_total;
    private $quantity;

    function __construct($pk, $name, $price, $vat, $quantity)
    {
        $this->pk = $pk;
        $this->name = $name;
        $this->price = $price;
        $this->vat = $vat;
        $this->price_vat = ($this->price/100)*$this->vat;
        $this->price_total = ($this->price + $this->price_vat);
        $this->quantity = $quantity;
    }

    // fonction "magique" pour faire ça plus simplement
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