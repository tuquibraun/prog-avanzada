<?php

include_once 'conector/BaseDatos.php';

class Jugador {
    
    private $id;
    private $nombre;
    private $descripcion;
    
    public function __construct(){
        
        $this->id="";
        $this->nombre="";
        $this->descripcion="";
        $this->mensajeoperacion="";
        
    }
    
    public function setear($id, $nombre, $descripcion)    {
        
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setDescripcion($descripcion);
        
    }
    
    // METODOS DE ACCESO GET
    
    public function getId(){
        return $this->id;
    }
    
    public function getNombre(){
        return $this->nombre;
    }

    public function getDescripcion(){
        return $this->descripcion;
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

    public function setDescripcion($valor){
        $this->descripcion = $valor;
    }
    
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }
    
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM jugadores WHERE id= ". $this->getId();
        //echo $sql;
        
        if ($base->Iniciar()) {
            
            $res = $base->Ejecutar($sql);
            
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['id'], $row['nombre'], $row['descripcion']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("jugadores->listar: ".$base->getError());
        }
        return $resp;
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO jugadores (nombre, descripcion) VALUES ('".$this->getNombre()."','".$this->getDescripcion()."')";

        if ($base->Iniciar()) {
            
            if ($elid = $base->Ejecutar($sql)) {
                $this->setId($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("jugadores->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("jugadores->insertar: ".$base->getError());
        }
        
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE jugadores SET nombre='".$this->getNombre()."', idPäis='".$this->getDescripcion()."'";
        $sql.= " WHERE id=".$this->getId()."";
        //echo $sql;
        
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("jugadores->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("jugadores->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM jugadores WHERE id='". $this->getId()."'";
        //echo $sql;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("jugadores->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("jugadores->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM jugadores ";
        
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        
        //echo $sql;
        
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    
                    $obj = new Jugador();
                    $obj->setear($row['id'], $row['nombre'], $row['descripcion']);
                    array_push($arreglo, $obj);
                }
            }
        }
        
        return $arreglo;
    }
    
}