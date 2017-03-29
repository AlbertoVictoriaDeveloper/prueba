<?php

/**
 * This controller is responsible for monitoring session
 * @package ParanoidKeeper 
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
            header("Location: " . base_url() . "insertpass/seepass");
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
        $userType = $this->sectionModel->getUser($mail);
            if ($user) {
                if ($userType[0]['type'] == 3) {
                $password = $this->mailing->GeneratorkeyUser(8);
                $data = array(
                    'keyp' => $password,
                );
                $this->sectionModel->InsertPassword($data, $mail);
                if ($this->mailing->sendMail($mail, $password)) {
                    echo json_encode(array('response' => "OK", "message" => "The information was successfully sent to start session"));
                } else {
                    echo json_encode(array("response" => "error", "message" => "The e-mail cant be sent"));
                }
            } else {                                                        
                echo json_encode(array("response" => "error", "message" => "Invalid user"));
            }
        } else {
            echo json_encode(array("response" => "error", "message" => "This user does not exist. Please make a new register"));
        }
    }

    /**
     * This function is responsible for registering new users
     */
    public function registerUser() {
        $mail = $this->input->post('mail');
        $user = $this->sectionModel->existUser($mail);
        if ($user != false) {
            echo json_encode(array('response' => "OK", "message" => "This user already exists. Please register a new user"));
        } else {
            $password = $this->mailing->GeneratorKeyUser(8);
            $key = $this->mailing->GeneratorKeyUser(10);
            $data = array(
                'mail' => $mail,
                'keyp' => $password,
                'type' => 3
            );

            if ($this->mailing->register($mail, $password, $key)) {
                $this->sectionModel->setUser($data);
                $user = $this->sectionModel->getUser($mail);
                $url = "/../../key/";
                $this->makedat->maketext($user[0]['id'], $url, $user[0]['id'] . "{sepa}" . $this->cryptastic->encryptedMD5($key));
                echo json_encode(array('response' => "error", "message" => "We sent an email with your password and encryption key"));
            } else {
                echo json_encode(array('response' => "error", "message" => "The e-mail cant be sent"));
            }
        }
    }

    /**
     * This function is responsible for controlling access to paranoidKeeper Admin
     */
    public function access() {
        $mail = $this->input->post('mail');
        $password = $this->input->post('pass');
        $user = $this->sectionModel->existUserPasword($mail, $password);
        $userMail = $this->sectionModel->getUser($mail);
        if ($user != false) {
            $this->sectionModel->signIn($mail);
            $token = $this->session->userdata('token');
            if ($token) {
                $this->sectionModel->deletePassword($mail, $password);
                $kep = $userMail[0]['kep'];
                if (!empty($kep) && isset($kep)) {
                    $url = "/../../key/";
                    $this->makedat->maketext($userMail[0]['id'], $url, $userMail[0]['id'] . "{sepa}" . $this->cryptastic->encryptedMD5($kep));
                    $this->sectionModel->deleteKeep($userMail[0]['id']);
                    header("Location: " . base_url() . "insertpass/seepass");
                } else {

                    header("Location: " . base_url() . "insertpass/seepass");
                }
            } else {
                header("Location: " . base_url());
            }
        } else {
            header("Location: " . base_url());
        }
    }

    /**
     * This function is responsible for controlling access to paranoidKeeper Admin
     */
    public function accessmobile() {
        $mail = $this->input->post('mail');
        $password = $this->input->post('pass');
        $user = $this->sectionModel->existUserPasword($mail, $password);
        if ($user != false) {
            $token = $this->sectionModel->signInMobile($mail);
            if ($token) {
                $this->sectionModel->deletePassword($mail, $password);
                echo json_encode(array("response" => "ok", "message" => "login correct", "info" => array("key" => $token)));
            } else {
                echo json_encode(array("response" => "error", "message" => "token error", "info" => array("key" => $token)));
            }
        } else {
            echo json_encode(array("response" => "error", "message" => "token error", "info" => array("key" => $token)));
        }
    }

    /**
     * This function is responsible for closing session
     */
    public function closeSession() {
        if ($this->sectionModel->signOut()) {

            header("Location: " . base_url());
        } else {
            header("Location: " . base_url() . "insertpass/seepass");
        }
    }

}
