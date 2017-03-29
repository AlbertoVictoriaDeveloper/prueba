<?php

/**
 * 
 * @package ParanoidKeeper Admin
 * @author www.oblak.solutions    
 * @copyright 2016. 
 * @version 1.0    
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class userModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Obtains registers of the token table 
     * @returns an Array
     */
    public function getUserByToken($token) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('token', 'user.id = token.user_id');
        $this->db->where('token', $token);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    
       public function getUserByHistory() {
        $this->db->select('*');
        $this->db->from('history');
        $this->db->join('user', 'user.id = history.user_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    } 
    
    
    
}
