<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of universidad
 *
 * @author IvánDarío
 */
class Universidad {

    private $cod_universidad;
    private $cod_provincia;
    private $nombre;
    private $telefono;
    private $categoria;

    public function __construct($cod_universidad, $cod_provincia, $nombre, $telefono, $categoria) {
        $this->cod_universidad = $cod_universidad;
        $this->cod_provincia = $cod_provincia;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->categoria = $categoria;
    }

    public function getCod_universidad() {
        return $this->cod_universidad;
    }

    public function getCod_provincia() {
        return $this->cod_provincia;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCod_universidad($cod_universidad) {
        $this->cod_universidad = $cod_universidad;
    }

    public function setCod_provincia($cod_provincia) {
        $this->cod_provincia = $cod_provincia;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

}
