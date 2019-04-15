<?php

include_once 'conector/BaseDatos.php';

class Contacto {

    private $id;
    private $nombre;
    private $empresa;
    private $telefono;
    private $email;
    private $comentario;

    public function __construct(){

        $this->id="";
        $this->nombre="";
        $this->empresa="";
        $this->telefono="";
        $this->email="";
        $this->comentario="";
        $this->mensajeoperacion="";

    }

    public function setear($id, $nombre, $empresa, $telefono, $email, $comentario)    {

        $this->setId($id);
        $this->setNombre($nombre);
        $this->setEmpresa($empresa);
        $this->setTelefono($telefono);
        $this->setEmail($email);
        $this->setComentario($comentario);

    }

    // METODOS DE ACCESO GET

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getEmpresa(){
        return $this->empresa;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getComentario(){
        return $this->comentario;
    }

    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }


    // METODOS DE ACCESO SET

    public function setId($valor){
        $this->id = $valor;
    }

    public function setNombre($valor){
        $this->nombre = $valor;
    }

    public function setEmpresa($valor){
        $this->empresa = $valor;
    }

    public function setTelefono($valor){
        $this->telefono = $valor;
    }

    public function setEmail($valor){
        $this->email = $valor;
    }

    public function setComentario($valor){
        $this->comentario = $valor;
    }

    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }


    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM contactos WHERE id= ". $this->getId();
        //echo $sql;

        if ($base->Iniciar()) {

            $res = $base->Ejecutar($sql);

            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['id'], $row['nombre'], $row['empresa'], $row['telefono'], $row['email'], $row['comentario']);

                }
            }
        } else {
            $this->setmensajeoperacion("contactos->listar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO contactos (nombre, empresa, telefono, email, comentario) VALUES ('".$this->getNombre()."', '".$this->getEmpresa()."', '".$this->getTelefono()."', '".$this->getEmail()."', '".$this->getComentario()."')";

        if ($base->Iniciar()) {

            if ($elid = $base->Ejecutar($sql)) {
                $this->setId($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("contactos->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("contactos->insertar: ".$base->getError());
        }

        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE contactos SET nombre='".$this->getNombre()."', empresa='".$this->getEmpresa()."', telefono='".$this->getTelefono()."', email='".$this->getEmail()."', comentario='".$this->getComentario()."'";
        $sql.= " WHERE id=".$this->getId()."";
        //echo $sql;

        if ($base->Iniciar()) {

            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("contactos->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("contactos->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM contactos WHERE id='". $this->getId()."'";
        //echo $sql;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("contactos->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("contactos->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){

        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM contactos ";

        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }

        //echo $sql;

        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){

                    $obj = new Contacto();
                    $obj->setear($row['id'], $row['nombre'], $row['empresa'], $row['telefono'], $row['email'], $row['comentario']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            //     $this->setmensajeoperacion("persona->listar: ".$base->getError());
        }

        return $arreglo;
    }

}
