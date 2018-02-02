<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of becario
 *
 * @author IvánDarío
 */
class Becario {

    private $cedula;
    private $fecha_ini;
    private $fecha_fin;
    private $carrera;
    private $cuenta;
    private $cod_beca;

    public function __construct($cedula, $fecha_ini, $fecha_fin, $carrera, $cuenta, $cod_beca) {
        $this->cedula = $cedula;
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
        $this->carrera = $carrera;
        $this->cuenta = $cuenta;
        $this->cod_beca = $cod_beca;
    }

    public function getCod_beca() {
        return $this->cod_beca;
    }

    public function setCod_beca($cod_beca) {
        $this->cod_beca = $cod_beca;
    }

    public function getCuenta() {
        return $this->cuenta;
    }

    public function setCuenta($cuenta) {
        $this->cuenta = $cuenta;
    }

    public function getCedula() {
        return $this->cedula;
    }

    public function getFecha_ini() {
        return $this->fecha_ini;
    }

    public function getFecha_fin() {
        return $this->fecha_fin;
    }

    public function getCarrera() {
        return $this->carrera;
    }

    public function setCedula($cedula) {
        $this->cod_beca = $cedula;
    }

    public function setFecha_ini($fecha_ini) {
        $this->fecha_ini = $fecha_ini;
    }

    public function setFecha_fin($fecha_fin) {
        $this->fecha_fin = $fecha_fin;
    }

    public function setCarrera($carrera) {
        $this->carrera = $carrera;
    }

}
