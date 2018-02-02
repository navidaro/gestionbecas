<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Resumen
 *
 * @author IvánDarío
 */
class Resumen {

    private $cedula;
    private $nombre;
    private $codigo;
    private $promedio;

    public function __construct($cedula, $nombre, $codigo, $promedio) {
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->codigo = $codigo;
        $this->promedio = $promedio;
    }

    public function getCedula() {
        return $this->cedula;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getPromedio() {
        return $this->promedio;
    }

    public function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setPromedio($promedio) {
        $this->promedio = $promedio;
    }

}
