<?php

include_once '../Modelo/Usuario.php';

class AbmUsuario {
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los usuarios de las variables instancias del objeto


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los usuarios de las variables instancias del objeto
     * @param array $param
     * @return object
     */

    public function cargarObjeto($param){

        //    echo "entramos a cargar objeto";

        $obj = null;

        if(array_key_exists('usuario',$param) && array_key_exists('clave',$param) && array_key_exists('nombre',$param) && array_key_exists('apellido',$param) ){

            $obj = new Usuario();

            $obj-> setear($param['idUsuario'], $param['usuario'], $param['clave'], $param['nombre'], $param['apellido']);

        }

        return $obj;

    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los usuarios de las variables instancias del objeto que son claves
     * @param array $param
     * @return object
     */
    private function cargarObjetoConClave($param){
        $obj = null;

        if( isset($param['id']) ){
            $obj = new Usuario();
            $obj->setear($param['id'],null, null, null, null);

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

        $resp = false;
        $elObjtUsuario = new Usuario();
        $elObjtUsuario = $this->cargarObjeto($param);

        if ($elObjtUsuario!=null and $elObjtUsuario->insertar()){
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

            $elObjtUsuario = $this->cargarObjetoConClave($param);

            if ($elObjtUsuario !=null and $elObjtUsuario->eliminar()){

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
            $elObjtUsuario = $this->cargarObjeto($param);

            if($elObjtUsuario !=null and $elObjtUsuario->modificar()){
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
            if  (isset($param['usuario']))
            $where.=" and usuario='".$param['usuario']."'";
            if  (isset($param['clave']))
            $where.=" and clave='".$param['clave']."'";
            if  (isset($param['nombre']))
            $where.=" and nombre='".$param['nombre']."'";
            if  (isset($param['apellido']))
            $where.=" and apellido='".$param['apellido']."'";

        }

        $arreglo = Usuario::listar($where);

        return $arreglo;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */

    public function buscarUsuario($param){

        $where = " true ";
        if ($param<>NULL){

            if  (isset($param['usuario']))
            $where.=" and usuario LIKE '".$param['usuario']."%'";

        }

        $arreglo = Usuario::listar($where);

        return $arreglo;
    }

}
?>
