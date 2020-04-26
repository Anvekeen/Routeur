<?php


class DAO
{
    // note : pourrait passer user & password de la connexion en var ici ou classe fille
    private $connection; // private sauf s'il faut l'utiliser dans une méthode classe fille
    protected $db;
    protected $table; // protected signifie que la var sera redéfinie dans les classes filles
    protected $list;

    function __construct() {
        $this->connection = new PDO("mysql:host=localhost;dbname={$this->db}", "root", "");
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAME'utf8'");  //permet d'encoder dans la db les données converties par htmlspecialchar (sinon redevient symbole..)
        $this->list = array();
    }

    function create($data) {
    }

    function save($colfields, $numfields, $object) {
            try{
                $statement = $this->connection->prepare("INSERT INTO {$this->table} ({$colfields}) VALUES ({$numfields})");
                $statement->execute(array_values($object));
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }

    function update($colfields, $numfields, $object) {
        try{
            $statement = $this->connection->prepare(
                "UPDATE {$this->table} SET $colfields WHERE $numfields");
            $statement->execute(array_values($object));
        } catch(PDOException $e) {
            print $e->getMessage();
        }
    }

    function fetch($colfields, $numfields, $id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE {$colfields} = {$numfields}");
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    function fetchAll() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $result) {
                array_push($this->list, $this->create($result));
            }
            return $this->list;
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    function delete($colfields, $numfields, $id) {
        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE {$colfields} = {$numfields}");
            $statement->execute([$id]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

}