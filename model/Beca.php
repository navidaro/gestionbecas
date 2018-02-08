<?php

/*
 * @author IvánDarío
 */

class Beca {

    private $cod_beca;
    private $cod_universidad;
    private $nombre;
    private $monto;

    public function __construct($cod_beca, $cod_universidad, $nombre, $monto) {
        $this->cod_beca = $cod_beca;
        $this->cod_universidad = $cod_universidad;
        $this->nombre = $nombre;
        $this->monto = $monto;
    }

    public function getCod_beca() {
        return $this->cod_beca;
    }

    public function getCod_universidad() {
        return $this->cod_universidad;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getMonto() {
        return $this->monto;
    }

    public function setCod_beca($cod_beca) {
        $this->cod_beca = $cod_beca;
    }

    public function setCod_universidad($cod_universidad) {
        $this->cod_universidad = $cod_universidad;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setMonto($monto) {
        $this->monto = $monto;
    }

}
