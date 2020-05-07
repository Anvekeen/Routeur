<?php
class HardDeleteBehaviour implements DeleteBehaviour {

    public function delete($id) {
        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE id = ?");
            $statement->execute([$id]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
}