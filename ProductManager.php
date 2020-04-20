<?php

class ProductManager {

    private $table;
    private $connection;
    private $product_list;

    function __construct() {
        $this->table = 'products';
        $this->connection = new PDO('mysql:host=localhost;dbname=demo', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->product_list = array();
    }

    function create($data) {
        return new Product(
            $data['pk'],
            $data['name'],
            $data['price'],
            $data['vat'],
            $data['quantity']
        );
    }

    function save($data) {
        $data['pk'] = -1; //pour la setter car si on passe rien ds le construct de produit il ne sera pas content
        //note : ci-dessous c'est déplacé, d'abord dans l'execute plus bas, mis ici car plus facile de créer le product avant, comme ça
        //1e vérif faite dans la classe product
        $product = $this->create([
            'pk' => $data['pk'],
            'name' =>$data['name'],
            'price' => $data['price'],
            'vat'=>0,
            'price_vat'=>0,
            'price_total'=>0,
            'quantity'=> $data['quantity']
        ]);
        // vérifications sur les inputs du form (+ escape specialcharts)
        if ($product) {
            try{
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (name, price, vat, price_vat, price_total, quantity) VALUES (?, ?, ?, ?, ?, ?)"
                );
                $statement->execute([
                    $product->__get('name'),
                    $product->__get('price'),
                    $product->__get('vat'),
                    $product->__get('price_vat'),
                    $product->__get('price_total'),
                    $product->__get('quantity')
                ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
    }

    function update($params) {
        try{
            $statement = $this->connection->prepare(
                "UPDATE {$this->table} SET name = ?, price_total = ?, quantity = ? WHERE pk = ?");
            $statement->execute([
                $params->__get('name'),
                $params->__get('price_total'),
                $params->__get('quantity'),
            ]);
        } catch(PDOException $e) {
            print $e->getMessage();
        }
    }

    function fetch($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE pk = ?");

            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->create($result);

        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    function fetchAll() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $product) {
                array_push($this->product_list, $this->create($product));
            }
            return $this->product_list;
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    function delete($id) {
        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE pk = ?");
            $statement->execute([$id]);

        } catch (PDOException $e) {
            print $e->getMessage();
        }
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