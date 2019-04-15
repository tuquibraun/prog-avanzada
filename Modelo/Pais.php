<?php

include_once 'conector/BaseDatos.php';

class Pais {
    
    private $id;
    private $descripcion;
    
    public function __construct(){
        
        $this->id="";
        $this->descripcion="";

        $this->mensajeoperacion="";
        
    }
    
    public function setear($id, $descripcion)    {
        
        $this->setId($id);
        $this->setDescripcion($descripcion);
        
    }
    
    // METODOS DE ACCESO GET
    
    public function getId(){
        return $this->id;
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
    
    public function setDescripcion($valor){
        $this->descripcion = $valor;
    }
    
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }
    
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM paises WHERE id= ". $this->getId();
        //echo $sql;
        
        if ($base->Iniciar()) {
            
            $res = $base->Ejecutar($sql);
            
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['id'], $row['descripcion']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("paises->listar: ".$base->getError());
        }
        return $resp;
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO paises (descripcion) VALUES ('".$this->getDescripcion()."')";

        if ($base->Iniciar()) {
            
            if ($elid = $base->Ejecutar($sql)) {
                $this->setId($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("paises->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("paises->insertar: ".$base->getError());
        }
        
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE paises SET descripcion='".$this->getDescripcion()."'";
        $sql.= " WHERE id=".$this->getId()."";
        //echo $sql;
        
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("paises->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("paises->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM paises WHERE id='". $this->getId()."'";
        //echo $sql;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("paises->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("paises->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM paises ";
        
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        
        //echo $sql;
        
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    
                    $obj = new Pais();
                    $obj->setear($row['id'], $row['descripcion']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            //     $this->setmensajeoperacion("persona->listar: ".$base->getError());
        }
        return $arreglo;
    }
    
}