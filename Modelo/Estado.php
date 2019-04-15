<?php

include_once 'conector/BaseDatos.php';

class Estado {
    
    private $id;
    private $descripcion;
    private $idPais;
    
    public function __construct(){
        
        $this->id="";
        $this->descripcion="";
        $this->idPais="";
        $this->mensajeoperacion="";
        
    }
    
    public function setear($id, $descripcion, $idPais)    {
        
        $this->setId($id);
        $this->setDescripcion($descripcion);
        $this->setIdPais($idPais);
        
    }
    
    // METODOS DE ACCESO GET
    
    public function getId(){
        return $this->id;
    }
    
    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getIdPais(){
        return $this->idPais;
    }
    
    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }
    
    
    // METODOS DE ACCESO SET
    
    public function setId($valor){
        $this->id = $valor;
    }
    
    public function setDescripcion($valor){
        $this->descripcion = $valor;
    }

    public function setIdPais($valor){
        $this->idPais = $valor;
    }
    
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }
    
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM estados WHERE id= ". $this->getId();
        //echo $sql;
        
        if ($base->Iniciar()) {
            
            $res = $base->Ejecutar($sql);
            
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['id'], $row['descripcion'], $row['idPais']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("estados->listar: ".$base->getError());
        }
        return $resp;
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO estados (descripcion, idPais) VALUES ('".$this->getDescripcion()."','".$this->getIdpais()."')";

        if ($base->Iniciar()) {
            
            if ($elid = $base->Ejecutar($sql)) {
                $this->setId($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("estados->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("estados->insertar: ".$base->getError());
        }
        
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE estados SET descripcion='".$this->getDescripcion()."', idPäis='".$this->getIdpais()."'";
        $sql.= " WHERE id=".$this->getId()."";
        //echo $sql;
        
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("estados->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("estados->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM estados WHERE id='". $this->getId()."'";
        //echo $sql;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("estados->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("estados->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM estados ";
        
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        
        //echo $sql;
        
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    
                    $obj = new Estado();
                    $obj->setear($row['id'], $row['descripcion'], $row['idPais']);
                    array_push($arreglo, $obj);
                }
            }
        }
        
        return $arreglo;
    }
    
}