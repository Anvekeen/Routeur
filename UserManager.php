<?php

class UserManager {

    private $table;
    private $connection;
    private $users_list;

    function __construct() {
        $this->table = 'users';
        $this->connection = new PDO('mysql:host=localhost;dbname=demo', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->users_list = array();
    }

    function create($data) {
        return new Users(
            $data['pk'],
            $data['username'],
            $data['password'],
            $data['created_at'],
            $data['updated_at']
        );
    }

    function save($data) {
        $data['pk'] = -1;
        $data['created_at'] = -1;
        $data['updated_at'] = -1;
        $user = $this->create([
            'pk' => $data['pk'],
            'username' =>$data['username'],
            'password' => $data['password'],
            'created_at'=> $data['created_at'],
            'updated_at'=> $data['updated_at']
        ]);

        if ($user) {
            try{
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (username, password, updated_at) VALUES (?, ?, CURRENT_TIMESTAMP)"
                );
                $statement->execute([
                    $user->__get('username'),
                    $user->__get('password')
                ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
    }

    function update($params) {
        try{
            $statement = $this->connection->prepare(
                "UPDATE {$this->table} SET username = ?, password = ?, updated_at = CURRENT_TIMESTAMP WHERE pk = ?");
            $statement->execute([
                $params['username'],
                $params['password'],
                $params['userid']
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
                array_push($this->users_list, $this->create($product));
            }
            return $this->users_list;
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