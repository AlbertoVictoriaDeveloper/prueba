<?php

/**
 * This function to manage passwords paranoidKeeper
 * @package ParanoidKeeper 
 * @author www.oblak.solutions    
 * @copyright 2016. 
 * @version 1.0    
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Insertpass extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('passwordsModel');
        $this->load->model('userModel');
        $this->load->library('cryptastic');
        $this->load->library('makedat');
        $this->load->model('mailing');
    }

    /**
     * This function loads the view insertpass.
     */
    public function index() {
        $token = $this->session->userdata('token');
        if ($token) {
            $user = $this->userModel->getUserByToken($token);
            $mail = $user[0]['mail'];
            $data = array("template" => "insertpass",
                "js" => "validatePass.js",
                "mail" => $mail);
            $this->load->view('headers/layout_panel', $data);
        } else {
            header("Location: " . base_url());
        }
    }

    /**
     * This function is responsible for registering new passwords
     */
    public function registerPass() {
        $token = $this->session->userdata('token');
        if ($token) {
            $users = $this->userModel->getUserByToken($token);
            $dataPass = array("name" => $this->input->post("name"),
                "descripcion" => $this->input->post("description"),
                "url" => $this->input->post("url"),
                "user_id" => $users[0]['user_id'],
                "active" => 1
            );
            $urlKey = "/../../key/";
            $contenido = $this->makedat->gettext($users[0]['user_id'], $urlKey, "r+");
            if (isset($contenido) && !empty($contenido)) {
                $KeyEncrypt = implode($contenido);
                $Keydecrypt = $this->cryptastic->decryptMD5($KeyEncrypt, true);
                $key = $this->input->post("enckey");
                $contentKey = substr($key, 0, 10);
                if ($Keydecrypt === $contentKey) {
                    $this->passwordsModel->savePass($dataPass);
                    $urlKep = "/../../kep/";
                    $this->makedat->maketext($users[0]['user_id'], $urlKep, $this->passwordsModel->getRegisterbyid($users[0]['user_id']) . "{sepa}" . $this->cryptastic->encrypt($this->input->post("pass"), $this->input->post("enckey"), true));
                    echo json_encode(array('response' => "OK", "message" => "Save password"));
                } else {

                    echo json_encode(array('response' => "error", "message" => "Your Encryption Key Was Incorrect"));
                }
            } else {

                echo json_encode(array('response' => "error", "message" => "Without Response"));
            }
        } else {

            echo json_encode(array("response" => "error", "message" => "error token", "info" => ""));
        }
    }

    /**
     * This function is responsible for registering new passwords
     */
    public function registerPassMobile() {
        $token = $this->input->post('token');
        if ($token) {
            $users = $this->userModel->getUserByToken($token);
            $dataPass = array("name" => $this->input->post("name"),
                "descripcion" => $this->input->post("description"),
                "url" => $this->input->post("url"),
                "user_id" => $users[0]['user_id'],
                "active" => 1
            );
            $urlKey = "/../../key/";
            $contenido = $this->makedat->gettext($users[0]['user_id'], $urlKey, "r+");
            if (isset($contenido) && !empty($contenido)) {
                $KeyEncrypt = implode($contenido);
                $Keydecrypt = $this->cryptastic->decryptMD5($KeyEncrypt, true);
                $key = $this->input->post("enckey");
                $contentKey = substr($key, 0, 10);
                if ($Keydecrypt === $contentKey) {
                    $this->passwordsModel->savePass($dataPass);
                    $urlKep = "/../../kep/";
                    $this->makedat->maketext($users[0]['user_id'], $urlKep, $this->passwordsModel->getRegisterbyid($users[0]['user_id']) . "{sepa}" . $this->cryptastic->encrypt($this->input->post("pass"), $this->input->post("enckey"), true));
                    echo json_encode(array('response' => "ok", "message" => "Save password"));
                } else {
                    echo json_encode(array('response' => "error", "message" => "Your Encryption Key Was Incorrect"));
                }
            } else {
                echo json_encode(array('response' => "error", "message" => "Without Response"));
            }
        } else {
            echo json_encode(array("response" => "error", "message" => "error token", "info" => ""));
        }
    }

    /**
     * This function loads the view seepass.
     */
    public function seepass() {
        $token = $this->session->userdata('token');
        if ($token) {
            $users = $this->userModel->getUserByToken($token);
            $pass = $this->passwordsModel->getRegistersbyid($users[0]['user_id']);
            $mail = $users[0]['mail'];
            $data = array("template" => "seepass",
                "passes" => $pass,
                "js" => "clientupdel.js",
                "token" => $token,
                "mail" =>$mail   
            );
            $this->load->view('headers/layout_panel', $data);
        } else {
            header("Location: " . base_url());
        }
    }

    /**
     * This function is responsible for displaying the passwords
     */
    public function getregistersmobile() {
        $token = $this->input->post("token");
        if ($token) {
            $users = $this->userModel->getUserByToken($token);
            $pass = $this->passwordsModel->getRegistersbyid($users[0]['user_id']);
            echo json_encode(array("response" => "ok", "message" => "get information", "info" => array("pass" => $pass)));
        } else {
            echo json_encode(array("response" => "error", "message" => "error token", "info" => ""));
        }
    }

    /**
     * This function is responsible for displaying the passwords
     */
    public function getpass() {
        $encryptionKey = $this->input->post("encval");
        $idregister = $this->input->post("idregister");
        $infoRegister = $this->passwordsModel->getRegisterbyidregister($idregister);
        $urlKep = "/../../kep/";
        $users = $this->userModel->getUserByToken($this->input->post("token"));
        $contenido = $this->makedat->gettext($users[0]['user_id'], $urlKep, "r+");
        if (isset($contenido[$idregister]) && !empty($contenido[$idregister])) {
            $password = $this->cryptastic->decrypt($contenido[$idregister], $encryptionKey, true);
            if ($password) {
                $this->mailing->sendMailMovement($users[0]['mail'], "Movement Count ParanoidKeepi", array("Get password", $infoRegister['name']));
                echo json_encode(array("response" => "ok", "message" => $password));
            } else {
                echo json_encode(array("response" => "error", "message" => "Your Encryption key was incorrect"));
            }
        } else {
            echo json_encode(array("response" => "error", "message" => "Without Response"));
        }
        exit;
    }

    /**
     * This function is responsible for removing a password.
     */
    public function delpass() {
        $idregister = $this->input->post("idregister");
        $token = $this->input->post("token");
        $users = $this->userModel->getUserByToken($token);
        $infoRegister = $this->passwordsModel->getRegisterbyidregister($idregister);
        $this->mailing->sendMailMovement($users[0]['mail'], "Movement Count ParanoidKeepi", array("Delete password", $infoRegister['name']));
        $deleted = $this->passwordsModel->deletePass($idregister);
        if ($deleted) {
            echo json_encode(array("response" => "ok", "message" => "Deleted Correct"));
        } else {
            echo json_encode(array("response" => "error", "message" => "Without Response"));
        }
    }

    /**
     * This function is responsible for updating a password
     */
    public function updatepass() {
        $newPass = $this->input->post("newpass");
        $confirmPass = $this->input->post("confirmpass");
        if ($newPass == $confirmPass) {
            $users = $this->userModel->getUserByToken($this->input->post("token"));
            $idregister = $this->input->post("idregister");
            $urlKep = "/../../kep/";
            $contenido = $this->makedat->gettext($users[0]['user_id'], $urlKep, "r+");
            $oldPass = $this->input->post("oldpass");
            $encryptionKey = $this->input->post("encval");
            $urlKey = "/../../key/";
            $contenidoKey = $this->makedat->gettext($users[0]['user_id'], $urlKey, "r+");
            $KeyEncrypt = implode($contenidoKey);
            $Keydecrypt = $this->cryptastic->decryptMD5($KeyEncrypt, true);
            $contentKey = substr($encryptionKey, 0, 10);
            if ($oldPass == $this->cryptastic->decrypt($contenido[$idregister], $encryptionKey, true)) {
                $contenido[$idregister] = $this->cryptastic->encrypt($newPass, $encryptionKey, true);
                $idregisters = array_keys($contenido);
                $newcontent = array();
                foreach ($idregisters as $register => $value) {
                    $newcontent[] = $value . "{sepa}" . $this->cryptastic->encrypt($this->cryptastic->decrypt($contenido[$value], $encryptionKey, true), $encryptionKey, true);
                }

                if ($this->makedat->updatetext($users[0]['user_id'], $newcontent)) {
                    if ($contentKey === $Keydecrypt) {
                        $infoRegister = $this->passwordsModel->getRegisterbyidregister($idregister);
                        $this->mailing->sendMailMovement($users[0]['mail'], "Movement Count ParanoidKeepi", array("Update password", $infoRegister['name']));
                        echo json_encode(array("response" => "ok", "message" => "Update Succesful"));
                    } else {
                        echo json_encode(array("response" => "error", "message" => "Your Encryption key was incorrect"));
                    }
                } else {
                    echo json_encode(array("response" => "error", "message" => "Error when update password"));
                }
            } else {
                echo json_encode(array("response" => "error", "message" => "Error when update password"));
            }
        } else {
            echo json_encode(array("response" => "error", "message" => "The new password doest'n match please confirm"));
        }


        exit;
    }

    /**
     * This function is responsible for saving a password

     */
    public function setpassmobile() {
        $token = $this->input->post('token');
        if ($token) {
            $post = $this->input->post('name');
            if (!empty($post)) {
                $users = $this->userModel->getUserByToken($token);
                $datapass = array("name" => $this->input->post("name"),
                    "descripcion" => $this->input->post("description"),
                    "url" => $this->input->post("url"),
                    "user_id" => $users[0]['user_id'],
                    "active" => 1
                );
                $this->passwordsModel->savePass($datapass);
                $urlKep = "/../../kep/";
                $this->makedat->maketext($users[0]['user_id'], $urlKep, $this->passwordsModel->getRegisterbyid($users[0]['user_id']) . "{sepa}" . $this->cryptastic->encrypt($this->input->post("pass"), $this->input->post("enckey"), true));
                echo json_encode(array("response" => "ok", "message" => "The password saved", "info" => ""));
            }
        } else {
            echo json_encode(array("response" => "error", "message" => "The password didnt save", "info" => ""));
        }
    }

}
