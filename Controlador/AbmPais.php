<?php

include_once 'Modelo/Pais.php';

class AbmPais {
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
    
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object
     */
    
    public function cargarObjeto($param){
        
        //    echo "entramos a cargar objeto";
        
        $obj = null;
        
        if(array_key_exists('descripcion',$param)){
            
            $obj = new Pais();
            
            $obj-> setear($param['id'], $param['descripcion']);

        }
        return $obj;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['id']) ){
            $obj = new Pais();
            $obj->setear($param['id'],null);
            
        }
        return $obj;
    }
    
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        
        $resp = false;
        if (isset($param['id']))
            
            $resp = true;
            return $resp;
    }
    
    /**
     *
     * @param array $param
     */
    public function alta($param){
        
        //echo "entramos a alta";
        
        $resp = false;
        $elObjtPais = new Pais();
        $elObjtPais = $this->cargarObjeto($param);
        // verEstructura($elObjtPais);
        
        // print_R($elObjtPais);
        if ($elObjtPais!=null and $elObjtPais->insertar()){
            $resp = true;
        }
        
        return $resp;
    }
    
    /**
     * permite eliminar un objeto
     * @param array $param
     * @return boolean
     */
    
    public function baja($param){
        
        $resp = false;
        
        if ($this->seteadosCamposClaves($param)){
            
            $elObjtPais = $this->cargarObjetoConClave($param);
            
            if ($elObjtPais !=null and $elObjtPais->eliminar()){
                
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        //echo "Estoy en modificacion";
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            //verEstructura($param);  
            $elObjtPais = $this->cargarObjeto($param);
            
            if($elObjtPais !=null and $elObjtPais->modificar()){
                $resp = true;
                
            }
        }
        return $resp;
    }
    
    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    
    public function buscar($param){
        
        
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['id']))
            $where.=" and id='".$param['id']."'";
            if  (isset($param['descripcion']))
            $where.=" and descripcion='".$param['descripcion']."'";
        }
        
        $arreglo = Pais::listar($where);
        
        return $arreglo;
    }
    
}
?>