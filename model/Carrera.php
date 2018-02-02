<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Carrera
 *
 * @author IvánDarío
 */
class Carrera {

    private $cod_carrera;
    private $nombre;

    public function __construct($cod_carrera, $nombre) {
        $this->cod_carrera = $cod_carrera;
        $this->nombre = $nombre;
    }

    public function getCod_carrera() {
        return $this->cod_carrera;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setCod_carrera($cod_carrera) {
        $this->cod_carrera = $cod_carrera;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

}
