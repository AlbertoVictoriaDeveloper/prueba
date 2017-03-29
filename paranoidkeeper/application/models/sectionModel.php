<?php

/**
 * This model is responsible of the starting session and the inserccion of the new users.
 * 
 * @package ParanoidKeeper
 * @author www.oblak.solutions    
 * @copyright 2016. 
 * @version 1.0    
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class sectionModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * This funtion inserts a new  user 
     * @returns an array 
     */
    public function setUser($data) {
        $this->db->insert('user', $data);
    }

    /**
     * This funtion obtain a user 
     * @returns an array 
     */
    public function getUser($mail) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('mail', $mail);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /**
     * This funtion obtain a user 
     * @returns an array 
     */
    public function getUserPassword($mail, $password) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('mail', $mail);
        $this->db->where('keyp', $password);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /**
     * verifies if the password and user exists 
     * @returns true of false 
     */
    public function existUserPasword($mail, $password) {
        $user = $this->getUserPassword($mail, $password);
        if ((isset($user[0]['id']) && isset($user[0]['keyp'])) && (!empty($user[0]['id']) && !empty($user[0]['keyp']))) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * verifies if an user exists 
     * @returns true of false 
     */
    public function existUser($mail) {
        $user = $this->getUser($mail);
        if (isset($user[0]['mail'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Create a Token 
     * @returns an String
     */
    public function createToken($mail) {
        $token = md5($mail . rand(0, 9) . rand(0, 9) . date("Ymd"));
        return $token;
    }

    /**
     * Signing in
     * @returns an array
     */
    public function signIn($mail) {
        $user = $this->getUser($mail);
        if (isset($user['0'])) {
            $token = $this->createToken($mail);
            $this->session->set_userdata(array("token" => $token));
            $data = array(
                'token' => $token,
                'type' => 1,
                'user_id' => $user['0']['id']
            );
            return $this->db->insert('token', $data);
        } else {
            return false;
        }
    }

    /**
     * Signing in
     * @returns an array
     */
    public function signInMobile($mail) {
        $user = $this->getUser($mail);
        if (isset($user['0'])) {
            $token = $this->createToken($mail);
            //$this->session->set_userdata(array("token" => $token));
            $data = array(
                'token' => $token,
                'type' => 1,
                'user_id' => $user['0']['id']
            );
            if ($this->db->insert('token', $data)) {
                return $token;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Changes the Key to a null value
     * @returns true or false
     */
    public function deletePassword($mail, $password) {
        try {
            $this->db->where('mail', $mail);
            $this->db->update('user', array("keyp" => null));
            return true;
        } catch (ErrorException $e) {
            return false;
        }
    }

    /**
     * Changes the key to a null value
     * @returns true or false
     */
    public function deleteKeep($id) {
        try {
            $this->db->where('id', $id);
            $this->db->update('user', array("kep" => null));
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    /**
     * Inserts the new passoword  
     * @returns true or false
     */
    public function InsertPassword($data, $mail) {
        try {
            $this->db->where('mail', $mail);
            $this->db->update('user', $data);
            return true;
        } catch (ErrorException $e) {
            return false;
        }
    }

    /**
     * Destroys the session  
     * @returns true or false
     */
    public function signOut() {
        try {
            $this->db->where('token', $this->session->userdata('token'));
            $this->db->update('token', array("type" => 0));
            $this->session->sess_destroy();
            return true;
        } catch (ErrorException $e) {
            return false;
        }
    }

}
