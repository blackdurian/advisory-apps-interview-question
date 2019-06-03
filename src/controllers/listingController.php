<?php
namespace App\Controller;

require_once "DBController.php";

class listingController{
    function __construct() {
        $this->db_handle = new DBController();
    }
    function addNewListing($id, $list_name, $distance, $user_id) {
        $query = "INSERT INTO listing (id,list_name,distance,user_id) VALUES (?, ?, ?, ?)";
        $paramType = "isdi";
        $paramValue = array(
            $id, $list_name, $distance, $user_id
        );       
        $this->db_handle->insert($query, $paramType, $paramValue); 
    }

    function getAllListing() {
        $query = "SELECT * FROM listing ORDER BY id";
        $result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function getListingByID($id) {
        $query = "SELECT * FROM listing WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function getListingByUserID($user_id) {
        $query = "SELECT id, list_name, distance FROM listing WHERE user_id = ?";
        $paramType = "i";
        $paramValue = array(
            $user_id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function getMaxId() {
        $query = "SELECT MAX(id) AS 'id' FROM listing";
        $result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function deleteListingById($id) {
        $query = "DELETE FROM listing WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function editListingByID($list_name, $distance, $user_id, $id) {
        $query = "UPDATE listing SET list_name = ?, distance = ?, user_id = ? WHERE id = ?";
        $paramType = "sdii";
        $paramValue = array(
            $list_name, $distance, $user_id, $id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    
}