<?php

/**
 * This controller is responsible for loading the view paranoidKeeper
 * 
 * @package ParanoidKeeper Admin
 * @author www.oblak.solutions    
 * @copyright 2016. 
 * @version 1.0    
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('passwordsModel');
        $this->load->model('sectionModel');
        $this->load->model('userModel');
        $this->load->library('cryptastic');
        $this->load->library('makedat');
        $this->load->model('mailing');
    }

    /**
     * This function loads the view registerUser.
     */
    public function index() {
        $token = $this->session->userdata('token');
        if ($token) {
            $users = $this->userModel->getUserByToken($token);
            $userType = $users[0]['user_id'];
            $typeUser = $this->sectionModel->getUserLevel($userType);
            $levelUser = $typeUser[0]['type'];
            $mailUser = $typeUser[0]['mail'];
            if ($levelUser == 0) {
                $register = $this->passwordsModel->registers();
                $data = array("template" => "registerUser", "js" => "clientupdel.js",
                    "token" => $token,
                    "register" => $register,
                    "mailUser" => $mailUser,
                    "headers" => "headers/menu"
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 1) {
                $userParanoid = $this->passwordsModel->registersParanoid();
                $data = array("template" => "registerUserParanoid", "js" => "clientupdel.js",
                    "token" => $token,
                    "registerParanoid" => $userParanoid,
                    "mailUser" => $mailUser,
                    "headers" => "headers/menuAdmin"
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 2) {
                $userParanoid = $this->passwordsModel->registersParanoid();
                $data = array("template" => "passwordParanoid", "js" => "clientupdel.js",
                    "token" => $token,
                    "register" => $userParanoid,
                    "mailUser" => $mailUser,
                    "headers" => "headers/menuUser"
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 4) {
                $register = $this->passwordsModel->registers();
                $data = array("template" => "registerUser", "js" => "clientupdel.js",
                    "token" => $token,
                    "register" => $register,
                    "mailUser" => $mailUser,
                    "headers" => "headers/menuSuperAdmin"
                );
                $this->load->view('headers/layout_panel', $data);
            }
        } else {
            header("Location: " . base_url());
        }
    }

    /**
     * This function loads the view registerUser.
     */
    public function registerUserAdmin() {
        $token = $this->session->userdata('token');
        if ($token) {
            $users = $this->userModel->getUserByToken($token);
            $userType = $users[0]['user_id'];
            $typeUser = $this->sectionModel->getUserLevel($userType);
            $levelUser = $typeUser[0]['type'];
            $mailUser = $typeUser[0]['mail'];
            if ($levelUser == 0) {
                $register = $this->passwordsModel->registers();
                $data = array("template" => "registerUser",
                    "register" => $register,
                    "js" => "clientupdel.js",
                    "token" => $token,
                    "headers" => "headers/menu",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 1) {
                $data = array("template" => "registerUserParanoid", "js" => "clientupdel.js",
                    "token" => $token,
                    "headers" => "headers/menuAdmin",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 2) {
                $data = array("template" => "passwordParanoid", "js" => "clientupdel.js",
                    "token" => $token,
                    "headers" => "headers/menuUser",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 4) {
                $data = array("template" => "registerUser",
                    "js" => "clientupdel.js",
                    "registerParanoid" => $userParanoid,
                    "token" => $token,
                    "headers" => "headers/menuSuperAdmin",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            }
        } else {
            header("Location: " . base_url());
        }
    }

    /**
     * This function register a user of ParanoidKeeper.
     */
    public function registerAdmin() {
        $token = $this->session->userdata('token');
        $users = $this->userModel->getUserByToken($token);
        $mail = $this->input->post("mail");
        $typeUser = $this->input->post("type");
        $user = $this->sectionModel->existUser($mail);
        if ($user != false) {
            echo json_encode(array('response' => "error", "message" => "This user already exists. Please insert another one"));
        } else {
            $dataRegister = array(
                'mail' => $mail,
                'keyp' => "",
                'type' => $typeUser
            );
            $data = array(
                'movement' => "Add User",
                'user_movement' => $mail,
                'date_movement' => date("Y-m-d H:i:s"),
                'user_id' => $users[0]['user_id']
            );
            $userType = $this->makedat->adminType($typeUser);
            if ($this->mailing->registerAdmin($mail, $userType)) {
                $this->sectionModel->setUser($dataRegister);
                $this->sectionModel->setUserHistory($data);
                echo json_encode(array('response' => "ok", "message" => "The user has been registered"));
            } else {
                echo json_encode(array('response' => "error", "message" => "This user is not registered"));
            }
        }
    }

    /**
     * This function delete a user  of paranoidKeeperAdmin.
     */
    public function deleteAdmin() {
        $idRegister = $this->input->post("idregister");
        $token = $this->session->userdata('token');
        $users = $this->userModel->getUserByToken($token);
        $userDelete = $this->sectionModel->getUserLevel($idRegister);
        $data = array('movement' => "Delete User",
            'user_movement' => $userDelete[0]['mail'],
            'date_movement' => date("Y-m-d H:i:s"),
            'user_id' => $users[0]['user_id']
        );
        $this->sectionModel->setUserHistory($data);
        $deleted = $this->passwordsModel->deleteAdmin($idRegister);
        if ($deleted) {
            echo json_encode(array('response' => 'ok', "message" => "Deleted user"));
        } else {
            echo json_encode(array('response' => 'ok', "message" => "The user cant be eliminated"));
        }
    }

    /**
     * This function delete a user of paranoidKeeper.
     */
    public function deleteUser() {
        $idParanoid = $this->input->post('idregister');
        $deletedUser = $this->passwordsModel->deleteUser($idParanoid);
        if ($deletedUser) {
            echo json_encode(array('response' => 'ok', "message" => "Deleted user"));
        } else {
            echo json_encode(array('response' => 'ok', "message" => "The user cant be eliminated"));
        }
    }

    /**
     * This function loads the view registerUserParanoid.
     */
    public function registerUserParanoid() {
        $token = $this->session->userdata('token');
        if ($token) {
            $users = $this->userModel->getUserByToken($token);
            $userType = $users[0]['user_id'];
            $typeUser = $this->sectionModel->getUserLevel($userType);
            $userParanoid = $this->passwordsModel->registersParanoid();
            $levelUser = $typeUser[0]['type'];
            $mailUser = $typeUser[0]['mail'];
            if ($levelUser == 0) {

                $data = array("template" => "registerUserParanoid",
                    "js" => "clientupdel.js",
                    "registerParanoid" => $userParanoid,
                    "token" => $token,
                    "headers" => "headers/menu",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 1) {
                $data = array("template" => "registerUserParanoid",
                    "js" => "clientupdel.js",
                    "token" => $token,
                    "registerParanoid" => $userParanoid,
                    "headers" => "headers/menuAdmin",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 2) {
                $data = array("template" => "registerUserParanoid",
                    "js" => "clientupdel.js",
                    "token" => $token,
                    "headers" => "headers/menuUser",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else if (($levelUser == 4)) {
                $data = array("template" => "registerUserParanoid",
                    "js" => "clientupdel.js",
                    "registerParanoid" => $userParanoid,
                    "token" => $token,
                    "headers" => "headers/menuSuperAdmin",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else {
                header("Location:" . base_url());
            }
        }
    }

    /**
     * This function register a user.
     */
    public function registerUser() {
        $mail = $this->input->post('mail');
        $user = $this->sectionModel->existUser($mail);
        if ($user != false) {
            echo json_encode(array('response' => "error", "message" => "This user already exists. Please register another one"));
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
                $id = $user[0]['id'];
                $this->passwordsModel->addKep($id, $key);
                echo json_encode(array('response' => "ok", "message" => "You registered a ParanoidKeeper user"));
            } else {
                echo json_encode(array('response' => "error", "message" => "No user registrations"));
            }
        }
    }

    /**
     * This function loads the view passwordParanoid.
     */
    public function seePasswordParanoid() {
        $token = $this->session->userdata('token');
        if ($token) {
            $users = $this->userModel->getUserByToken($token);
            $userType = $users[0]['user_id'];
            $typeUser = $this->sectionModel->getUserLevel($userType);
            $levelUser = $typeUser[0]['type'];
            $userParanoid = $this->passwordsModel->registersParanoid();
            $mailUser = $typeUser[0]['mail'];
            if ($levelUser == 0) {
                $data = array("template" => "passwordParanoid",
                    "register" => $userParanoid,
                    "js" => "clientupdel.js",
                    "headers" => "headers/menu",
                    "token" => $token,
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 1) {
                $data = array("template" => "passwordParanoid",
                    "js" => "clientupdel.js",
                    "token" => $token,
                    "register" => $userParanoid,
                    "headers" => "headers/menuAdmin",
                    "mailUser" => $mailUser,
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 2) {
                $data = array("template" => "passwordParanoid",
                    "js" => "clientupdel.js",
                    "token" => $token,
                    "register" => $userParanoid,
                    "headers" => "headers/menuUser",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 4) {
                $data = array("template" => "passwordParanoid",
                    "register" => $userParanoid,
                    "js" => "clientupdel.js",
                    "headers" => "headers/menuSuperAdmin",
                    "token" => $token,
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else {
                header("Location:" . base_url());
            }
        }
    }

    /**
     * This function register a password
     */
    public function passwordParanoid() {
        $user = $this->input->post('user');
        if ($user) {
            $pass = $this->passwordsModel->getRegistersParanoid($user);
            echo json_encode(array("response" => "ok", "message" => "The user information was found", "info" => array("pass" => $pass)));
        } else {
            echo json_encode(array("response" => "error", "message" => "It was not possible to find the information", "info" => array("pass" => "")));
        }
    }

    /**
     * This function activate a password
     */
    public function disablePassword() {
        $user = $this->input->post('id');
        if ($user) {
            $this->passwordsModel->disablePass($user);
            echo json_encode(array("response" => "ok", "message" => "Password Disable"));
        } else {
            echo json_encode(array("response" => "error", "message" => "The password wasn´t updated"));
        }
    }

    /**
     * This function activate a password
     */
    public function activatePassword() {
        $user = $this->input->post('id');
        if ($user) {
            $this->passwordsModel->activatePass($user);
            echo json_encode(array("response" => "ok", "message" => "Password Disable"));
        } else {
            echo json_encode(array("response" => "error", "message" => "The password wasn't updated"));
        }
    }

    /**
     * This function loads the view historyConnection.
     */
    public function historyConnection() {
        $token = $this->session->userdata('token');
        if ($token) {
            $users = $this->userModel->getUserByToken($token);
            $userType = $users[0]['user_id'];
            $typeUser = $this->sectionModel->getUserLevel($userType);
            $levelUser = $typeUser[0]['type'];
            $mailUser = $typeUser[0]['mail'];
            if ($levelUser == 0) {
                $register = $this->passwordsModel->registers();
                $data = array("template" => "registerUser",
                    "register" => $register,
                    "js" => "clientupdel.js",
                    "token" => $token,
                    "headers" => "headers/menu",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 1) {
                $data = array("template" => "registerUserParanoid", "js" => "clientupdel.js",
                    "token" => $token,
                    "headers" => "headers/menuAdmin",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 2) {
                $data = array("template" => "passwordParanoid", "js" => "clientupdel.js",
                    "token" => $token,
                    "headers" => "headers/menuUser",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 4) {
                $userParanoid = $this->passwordsModel->registers();
                $data = array("template" => "historyUser",
                    "js" => "history.js",
                    "register" => $userParanoid,
                    "token" => $token,
                    "headers" => "headers/menuSuperAdmin",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            }
        } else {
            header("Location: " . base_url());
        }
    }

    /**
     * This function handles view the history of connections
     */
    public function historyUser() {
        $user = $this->input->post('user');
        if ($user) {
            $history = $this->passwordsModel->getRegistersToken($user);
            if ($history != false) {
                echo json_encode(array("response" => "ok", "message" => "The user information was found", "info" => array("history" => $history)));
            } else {
                echo json_encode(array("response" => "error", "message" => "User does not have room connections", "info" => array("pass" => "")));
            }
        } else {
            echo json_encode(array("response" => "error", "message" => "It was not possible to find the information", "info" => array("pass" => "")));
        }
    }

    /**
     * This function loads the view historyUser.
     */
    public function userHistory() {
        $token = $this->session->userdata('token');
        if ($token) {
            $users = $this->userModel->getUserByToken($token);
            $userType = $users[0]['user_id'];
            $typeUser = $this->sectionModel->getUserLevel($userType);
            $levelUser = $typeUser[0]['type'];
            $mailUser = $typeUser[0]['mail'];
            if ($levelUser == 0) {
                $register = $this->passwordsModel->registers();
                $data = array("template" => "registerUser",
                    "register" => $register,
                    "js" => "clientupdel.js",
                    "token" => $token,
                    "headers" => "headers/menu",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 1) {
                $data = array("template" => "registerUserParanoid", "js" => "clientupdel.js",
                    "token" => $token,
                    "headers" => "headers/menuAdmin",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 2) {
                $data = array("template" => "passwordParanoid", "js" => "clientupdel.js",
                    "token" => $token,
                    "headers" => "headers/menuUser",
                    "mailUser" => $mailUser
                );
                $this->load->view('headers/layout_panel', $data);
            } else if ($levelUser == 4) {
                $history = $this->userModel->getUserByHistory();
                $data = array("template" => "gestionHistory",
                    "mailUser" => $mailUser,
                    "history" => $history,
                    "token" => $token,
                    "headers" => "headers/menuSuperAdmin"
                );
                $this->load->view('headers/layout_panel', $data);
            }
        } else {
            header("Location: " . base_url());
        }
    }

}
