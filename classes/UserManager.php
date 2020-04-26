<?php

include_once 'DAO.php';

class UserManager extends DAO {

    protected $db = 'demo';
    protected $table = "users";

    function create($data) {
        return new Users(
            $data['pk'],
            $data['username'],
            $data['password'],
            $data['created_at'],
            $data['updated_at']
        );
    }

    function saveUser($data) {
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
            $colfields = "username, password";
            $numfields= "?, ?";
            $object = array($user->__get('username'),$user->__get('password'));
            parent::save($colfields, $numfields, $object);
        }
    }

    function updateUser($params) {
        $colfields = 'username = ?, password = ?';
        $numfields =  'pk = ?';
        $object = array($params['username'], $params['password'], $params['userpk']);
        parent::update($colfields, $numfields, $object);
        }

    function fetchUser($id) {  //pourrait check si $id bien int mais déjà check dans form html, pas sûr que utile
        $colfields = "pk";
        $numfields= "?";
        $result = parent::fetch($colfields, $numfields, $id);
        return $this->create($result);
    }

    function deleteUser($id) {
        $colfields = "pk";
        $numfields= "?";
        parent::delete($colfields, $numfields, $id);
    }

}