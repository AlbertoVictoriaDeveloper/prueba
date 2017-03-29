<?php

/**
 * This controller is responsible for monitoring session
 * @package ParanoidKeeper Admin
 * @author www.oblak.solutions    
 * @copyright 2016. 
 * @version 1.0    
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mailing');
        $this->load->model('sectionModel');
        $this->load->model('userModel');
        $this->load->model('passwordsModel');
        $this->load->library('makedat');
        $this->load->library('cryptastic');
    }

    /**
     * This function is responsible for validating if there is an active session
     * 
     */
    public function index() {
        $token = $this->session->userdata('token');
        if ($token) {
            header("Location: " . base_url() . "register/registeruseradmin");
        } else {

            $this->load->view('login');
        }
    }

    /**
     * This function is responsible for sending the password to the user for access
     */
    public function dataRegister() {
        $mail = $this->input->post('mail');
        $user = $this->sectionModel->existUser($mail);
        $SaveUser = $this->sectionModel->getUser($mail);
        if ($SaveUser[0]['type'] == 0 || $SaveUser[0]['type'] == 1 || $SaveUser[0]['type'] == 2 || $SaveUser[0]['type'] == 4) {
            if ($user) {
                $password = $this->mailing->GeneratorkeyUser(8);
                $data = array(
                    'keyp' => $password
                );
                $this->sectionModel->InsertPassword($data, $mail);
                if ($this->mailing->sendMail($mail, $password)) {
                    echo json_encode(array('response' => "OK", "message" => "The information was succesfully sent"));
                } else {
                    echo json_encode(array("response" => "error", "message" => "The email cant be sent"));
                }
            } else {
                echo json_encode(array("response" => "error", "message" => "This user doesn't exist, please enter a valid user"));
            }
        } else {
            echo json_encode(array("response" => "error", "message" => "Invalid User"));
        }
    }

    /**
     * This function is responsible for controlling access to paranoidKeeper Admin
     */
    public function access() {
        $mail = $this->input->post('mail');
        $password = $this->input->post('pass');
        $user = $this->sectionModel->existUserPasword($mail, $password);
        if ($user != false) {
            $this->sectionModel->signIn($mail);
            $token = $this->session->userdata('token');
            if ($token) {
                $this->sectionModel->deletePassword($mail, $password);
                $typeUser = $this->sectionModel->getUser($mail);
                $levelUser = $typeUser[0]['type'];
                if ($levelUser == 0) {
                    header("Location: " . base_url() . "register/registeruseradmin");
                } else if ($levelUser == 1) {
                    header("Location: " . base_url() . "register/registerUserParanoid");
                } else if ($levelUser == 2) {
                    header("Location: " . base_url() . "register/seePasswordParanoid");
                } else if ($levelUser == 4) {
                    header("Location: " . base_url() . "register/seePasswordParanoid");
                }
            } else {
                header("Location: " . base_url());
            }
        } else {
            header("Location: " . base_url());
        }
    }

    /**
     * This function is responsible for closing session
     */
    public function closeSession() {
        if ($this->sectionModel->signOut()) {

            header("Location: " . base_url());
        } else {
            header("Location: " . base_url() . "register");
        }
    }

}
