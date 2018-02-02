<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Provincia
 *
 * @author IvánDarío
 */
class Provincia {

    private $cod_provincia;
    private $nombre;

    public function __construct($cod_provincia, $nombre) {
        $this->cod_provincia = $cod_provincia;
        $this->nombre = $nombre;
    }

    public function getCod_provincia() {
        return $this->cod_provincia;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setCod_provincia($cod_provincia) {
        $this->cod_provincia = $cod_provincia;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

}
