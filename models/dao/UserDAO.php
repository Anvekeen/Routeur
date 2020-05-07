<?php

class UserDAO extends DAO {
    protected $table;
    protected $connection;
    protected $object_list;
    protected $deleteBehaviour;

    function __construct() {
        $this->deleteBehaviour = new SoftDeleteBehaviour();
        $this->object_list = array();
        $this->table = 'products';
        $this->connection = new PDO('mysql:host=localhost;dbname=demo_base', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function create($data) {
        return new Users(
            $data['id'],
            $data['username'],
            $data['password'],
            $data['created_at'],
            $data['updated_at']
        );
    }

    function saveUser($data) {
        $data['id'] = -1;
        $data['created_at'] = -1;
        $data['updated_at'] = -1;
        $user = $this->create([
            'id' => $data['id'],
            'username' =>$data['username'],
            'password' => $data['password'],
            'created_at'=> $data['created_at'],
            'updated_at'=> $data['updated_at']
        ]);
        if ($user) {
            $colfields = "username, password";
            $numfields= "?, ?";
            $object = array($user->__get('username'),$user->__get('password'));
            parent::save($colfields, $numfields, $object);
        }
    }

    function updateUser($params) {
        $colfields = 'username = ?, password = ?';
        $numfields =  'id = ?';
        $object = array($params['username'], $params['password'], $params['userid']);
        parent::update($colfields, $numfields, $object);
    }

    function fetchUser($id) {  //pourrait check si $id bien int mais déjà check dans form html, pas sûr que utile
        $colfields = "id";
        $numfields= "?";
        $result = parent::fetch($colfields, $numfields, $id);
        return $this->create($result);
    }

    function deleteUser($id) {
        $colfields = "id";
        $numfields= "?";
        parent::delete($colfields, $numfields, $id);
    }

}