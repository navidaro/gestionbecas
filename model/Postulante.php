<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of postulante
 *
 * @author IvánDarío
 */
class Postulante {

    private $cedula;
    private $cod_beca;
    private $nombres;
    private $apellidos;
    private $promedio;
    
    public function __construct($cedula, $cod_beca, $nombres, $apellidos, $promedio) {
        $this->cedula = $cedula;
        $this->cod_beca = $cod_beca;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->promedio = $promedio;
    }

    
    public function getPromedio() {
        return $this->promedio;
    }

    public function setPromedio($promedio) {
        $this->promedio = $promedio;
    }

    
    public function getCedula() {
        return $this->cedula;
    }

    public function getCod_beca() {
        return $this->cod_beca;
    }

    public function getNombres() {
        return $this->nombres;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    public function setCod_beca($cod_beca) {
        $this->cod_beca = $cod_beca;
    }

    public function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

}
