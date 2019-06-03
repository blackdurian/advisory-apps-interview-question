<?php
namespace App\Controller;

require_once "DBController.php";

class userController{
    function __construct() {
        $this->db_handle = new DBController();
    }
    function addUser($id, $email, $encrypted_password, $token, $type) {
        $query = "INSERT INTO user (id,email,encrypted_password,token,type) VALUES (?, ?, ?, ?, ?)";
        $paramType = "issss";
        $paramValue = array(
            $id, $email, $encrypted_password, $token, $type
        );       
        $this->db_handle->insert($query, $paramType, $paramValue); 
    }

    function getMaxId() {
        $query = "SELECT MAX(id) AS 'id' FROM user ORDER BY id";
        $result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    
    function getAllUser() {
        $query = "SELECT * FROM user ORDER BY id";
        $result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function getUserByID($id) {
        $query = "SELECT * FROM user WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function getUserByEmail($email) {
        $query = "SELECT * FROM user WHERE email = ?";
        $paramType = "s";
        $paramValue = array(
            $email
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function getIdTokenByEmail($email) {
        $query = "SELECT id, token FROM user WHERE email = ?";
        $paramType = "s";
        $paramValue = array(
            $email
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function deleteUserByID($id) {
        $query = "DELETE FROM user WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function editUserByID($email, $encrypted_password, $token, $type, $id) {
        $query = "UPDATE user SET email = ?, encrypted_password = ?, token = ?, type = ? WHERE id = ?";
        $paramType = "ssssi";
        $paramValue = array(
            $email, $encrypted_password, $token, $type, $id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    
}