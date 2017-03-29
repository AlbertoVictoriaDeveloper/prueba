<?php

/**
 * This clas is responsible of sending emails
 * 
 * @package ParanoidKeeper
 * @author www.oblak.solutions    
 * @copyright 2016. 
 * @version 1.0    
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class mailing extends CI_Model {

    public $mailing;

    public function __construct() {
        parent::__construct();
        $this->load->library('libraryMailer');
        $this->mailing = new phpmailer();
        $this->mailing->PluginDir = "includes/";
        $this->mailing->Mailer = "smtp";
        $this->mailing->Host = "mail.oblak.solutions";
        $this->mailing->Port = 587;
        $this->mailing->SMTPSecure = 'TLS';
        $this->mailing->SMTPAuth = true;
        $this->mailing->Username = "paranoid@oblak.solutions";
        $this->mailing->Password = "ekgJ08weVQ";
        $this->mailing->From = "paranoid@oblak.solutions";
        $this->mailing->FromName = "ParanoidKeeper";
        $this->mailing->Timeout = 30;
    }

    /**
     * Generates password and Key 
     * @returns an String
     * 
     */
    public function GeneratorkeyUser($longitudPass) {
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890|-_";
        $longitudCadena = strlen($cadena);
        $key = "";
        for ($i = 1; $i <= $longitudPass; $i++) {
            $pos = rand(0, $longitudCadena - 1);
            $key .= substr($cadena, $pos, 1);
        }
        return $key;
    }

    /**
     * Send a password in a email
     *
     */
    public function sendMail($mail, $password) {
        $this->mailing->AddAddress($mail);
        $this->mailing->Subject = "Login password";
        $file = __DIR__ . "/../views/sendPassword.html";
        $body = file_get_contents($file);
        $pattern[] = "{{pass}}";
        $pattern[] = "{{url}}";
        $content[] = $password;
        $content[] = base_url();
        $bodySend = preg_replace($pattern, $content, $body);
        $this->mailing->Body = $bodySend;
        $this->mailing->AltBody = "Mensaje de prueba mandado";
        $exito = $this->mailing->Send();
        $intentos = 1;
        while ((!$exito) && ($intentos < 3)) {
            sleep(5);
            //echo $mail->ErrorInfo;
            $exito = $this->mailing->Send();
            $intentos = $intentos + 1;
        }
        if ($exito) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Send email confirmation of a registration of a new user
     *
     */
    public function register($mail, $password, $key) {
        $this->mailing->AddAddress($mail);
        $this->mailing->Subject = "Login password and key";
        $file = __DIR__ . "/../views/register.html";
        $body = file_get_contents($file);
        $pattern = array();
        $pattern[] = "{{pass}}";
        $pattern[] = "{{key}}";
        $pattern[] = "{{url}}";
        $content = array();
        $content[] = $password;
        $content[] = $key;
        $content[] = base_url();
        $bodySend = preg_replace($pattern, $content, $body);
        $this->mailing->Body = $bodySend;
        $this->mailing->AltBody = "Mensaje de prueba mandado";
        $exito = $this->mailing->Send();
        $intentos = 1;
        while ((!$exito) && ($intentos < 5)) {
            sleep(5);
            //echo $mail->ErrorInfo;
            $exito = $this->mailing->Send();
            $intentos = $intentos + 1;
        }
        if ($exito) {
            return true;
        } else {

            return false;
        }
    }

    /**
     * Send email confirmation of a registration of a new user
     *
     */
    public function sendMailMovement($mail, $subject, $movement) {
        $this->mailing->AddAddress($mail);
        $this->mailing->Subject = $subject;
        $file = __DIR__ . "/../views/movement.html";
        $body = file_get_contents($file);
        $pattern[] = "{{movement}}";
        $pattern[] = "{{who}}";
        $pattern[] = "{{url}}";
        $movement[] = base_url();
        $bodySend = preg_replace($pattern, $movement, $body);
        $this->mailing->Body = $bodySend;
        $this->mailing->AltBody = "Movimiento Detectado";
        $exito = $this->mailing->Send();
        $intentos = 1;
        while ((!$exito) && ($intentos < 5)) {
            sleep(5);
            //echo $mail->ErrorInfo;
            $exito = $this->mailing->Send();
            $intentos = $intentos + 1;
        }
    }

}
