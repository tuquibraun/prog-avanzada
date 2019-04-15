<?php

include_once 'conector/BaseDatos.php';

class Usuario {

    private $idUsuario;
    private $usuario;
    private $clave;
    private $nombre;
    private $apellido;

    public function __construct(){

        $this->idUsuario="";
        $this->usuario="";
        $this->clave="";
        $this->nombre="";
        $this->apellido="";
        $this->mensajeoperacion="";

    }

    public function setear($idUsuario, $usuario, $clave, $nombre, $apellido)    {

        $this->setIdUsuario($idUsuario);
        $this->setUsuario($usuario);
        $this->setClave($clave);
        $this->setNombre($nombre);
        $this->setApellido($apellido);

    }

    // METODOS DE ACCESO GET

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function getClave(){
        return $this->clave;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }


    // METODOS DE ACCESO SET

    public function setIdUsuario($valor){
        $this->idUsuario = $valor;
    }

    public function setUsuario($valor){
        $this->usuario = $valor;
    }

    public function setClave($valor){
        $this->clave = $valor;
    }

    public function setNombre($valor){
        $this->nombre = $valor;
    }

    public function setApellido($valor){
        $this->apellido = $valor;
    }

    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }


    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM usuarios WHERE idUsuario= ". $this->getIdUsuario();
        //echo $sql;

        if ($base->Iniciar()) {

            $res = $base->Ejecutar($sql);

            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idUsuario'], $row['usuario'], $row['clave'], $row['nombre'], $row['apellido']);

                }
            }
        } else {
            $this->setmensajeoperacion("usuarios->listar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO usuarios (usuario, clave, nombre, apellido) VALUES ('".$this->getUsuario()."', '".$this->getClave()."', '".$this->getNombre()."', '".$this->getApellido()."')";

        if ($base->Iniciar()) {

            if ($elidUsuario = $base->Ejecutar($sql)) {
                $this->setIdUsuario($elidUsuario);
                $resp = true;
            } else {
                $this->setmensajeoperacion("usuarios->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("usuarios->insertar: ".$base->getError());
        }

        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE usuarios SET usuario='".$this->getUsuario()."', clave='".$this->getClave()."', nombre='".$this->getNombre()."', apellido='".$this->getApellido()."'";
        $sql.= " WHERE idUsuario=".$this->getIdUsuario()."";
        //echo $sql;

        if ($base->Iniciar()) {

            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("usuarios->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("usuarios->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuarios WHERE idUsuario='". $this->getIdUsuario()."'";
        //echo $sql;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("usuarios->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("usuarios->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){

        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuarios ";

        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }

        //echo $sql;

        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){

                    $obj = new Usuario();
                    $obj->setear($row['idUsuario'], $row['usuario'], $row['clave'], $row['nombre'], $row['apellido']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            //     $this->setmensajeoperacion("persona->listar: ".$base->getError());
        }

        return $arreglo;
    }

}
