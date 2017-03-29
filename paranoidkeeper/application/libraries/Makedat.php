<?php

/**
 * This class adds and updates in a text file the password and encryption key.
 * 
 * @package ParanoidKeeper 
 * @author www.oblak.solutions    
 * @copyright 2016. 
 * @version 1.0    
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Makedat {

    private $archivo;
    private $direccion;

    /**
     * Add content to the file
     * @returns an Array
     */
    public function maketext($id, $url, $data = null) {
        $direccion = __DIR__ . $url . md5($id . "keys") . ".dat";
        $this->direccion = $direccion;
        $this->archivo = fopen($direccion, "a+");
        //$contenido=$this->obtenerContenido();
        $this->agregarLineaTexto($data . "\t");
        $this->cerrarArchivo();
    }

    /**
     * Obtains the content of the file
     * @returns an Array
     */
    public function gettext($id, $url, $type = "r+") {
        $direccion = __DIR__ . $url . md5($id . "keys") . ".dat";
        $this->archivo = fopen($direccion, $type);
        $contenido = $this->obtenerContenidoArray();
        $this->cerrarArchivo();
        return $contenido;
    }

    /**
     * Update text 
     * @return false or true 
     */
    public function updatetext($id, $data, $type = "w") {
        try {
            $direccion = __DIR__ . "/../../kep/" . md5($id . "keys") . ".dat";
            //$direccion = __DIR__ . "/../../kep/hola.txt";
            $this->archivo = fopen($direccion, $type);
            foreach ($data as $text) {
                $this->agregarLineaTexto($text . "\t");
            }
            $this->cerrarArchivo();
            return true;
        } catch (ErrorException $e) {
            return false;
        }
    }

    /**
     * Add line to the text 
     * @return string or false
     */
    public function agregarLineaTexto($texto) {
        try {
            return fwrite($this->archivo, $texto . PHP_EOL);
        } catch (Exception $ex) {
            return false;
        }
    }

    /**
     * Add content to the text 
     * @return string or false
     */
    public function agregarContenidoTexto($texto) {
        try {
            return fwrite($this->archivo, $texto);
        } catch (Exception $ex) {
            return false;
        }
    }

    /**
     * Obtains the content 
     * @return array
     */
    public function obtenerContenido() {
        $contenido = "";
        while (!feof($this->archivo)) {
            $linea = fgets($this->archivo);
            $contenido.=$linea;
        }
        return $contenido;
    }

    /**
     * Close the File 
     */
    public function cerrarArchivo() {
        fclose($this->archivo);
    }

    /**
     * Obtains each line of text 
     * @return array
     */
    public function obtenerContenidoArray() {
        $lineas = array();
        while (!feof($this->archivo)) {
            $auxiliar = fgets($this->archivo);
            if (!empty($auxiliar)) {
                $aux = explode("{sepa}", $auxiliar);
                $lineas[$aux[0]] = $aux[1];
            }
        }
        return $lineas;
    }

    /**
     * Obtains user type
     * @return String 
     */
    public function obtenerLineaArchivo() {
        return fgets($this->archivo);
    }

}
