<?php

/**
 * This  model is responsible of manage the registers of passwords
 * 
 * @package ParanoidKeeper 
 * @author www.oblak.solutions    
 * @copyright 2016. 
 * @version 1.0    
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class passwordsModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * This funtion inserts a new password
     * @returns an array 
     */
    public function savePass($data) {
        $this->db->insert("registers", $data);
    }

    /**
     * This function obtains register for each user
     * @returns an Array 
     */
    public function getRegisterbyid($id) {
        $this->db->select('id');
        $this->db->from('registers');
        $this->db->where('user_id', $id);
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $response = $query->result_array();
            return $response[0]['id'];
        } else {
            return false;
        }
    }

    /**
     * This function obtains register for each user when the password is active
     * @returns an Array 
     */
    public function getRegistersbyid($id) {
        $this->db->select('*');
        $this->db->from('registers');
        $this->db->where('user_id', $id);
        $this->db->where('active', 1);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $response = $query->result_array();
            return $response;
        } else {
            return false;
        }
    }

    /**
     * This function obtains the user passwords
     * @returns an Array 
     */
    public function getRegisterbyidregister($id) {
        $this->db->select('*');
        $this->db->from('registers');
        $this->db->where('id', $id);
        $this->db->where('active', 1);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $response = $query->result_array();
            return $response[0];
        } else {
            return false;
        }
    }

    /**
     * This function disable the password 
     * @returns true or false
     */
    public function deletePass($id) {
        try {
            $this->db->where('id', $id);
            $this->db->update('registers', array("active" => 0));
            return true;
        } catch (ErrorException $e) {
            return false;
        }
    }

}
