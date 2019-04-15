<?php

include_once '../Modelo/Contacto.php';

class AbmContacto {
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object
     */

    public function cargarObjeto($param){

        //    echo "entramos a cargar objeto";

        $obj = null;

        if(array_key_exists('nombre',$param) && array_key_exists('empresa',$param) && array_key_exists('telefono',$param) && array_key_exists('email',$param) && array_key_exists('comentario',$param)){

            $obj = new Contacto();

            $obj-> setear($param['id'], $param['nombre'], $param['empresa'], $param['telefono'], $param['email'], $param['comentario']);

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
            $obj = new Contacto();
            $obj->setear($param['id'],null, null, null, null, null);

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
        $elObjtContacto = new Contacto();
        $elObjtContacto = $this->cargarObjeto($param);

        if ($elObjtContacto!=null and $elObjtContacto->insertar()){
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

            $elObjtContacto = $this->cargarObjetoConClave($param);

            if ($elObjtContacto !=null and $elObjtContacto->eliminar()){

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
            $elObjtContacto = $this->cargarObjeto($param);

            if($elObjtContacto !=null and $elObjtContacto->modificar()){
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
            if  (isset($param['nombre']))
            $where.=" and nombre='".$param['nombre']."'";
            if  (isset($param['empresa']))
            $where.=" and empresa='".$param['empresa']."'";
            if  (isset($param['telefono']))
            $where.=" and telefono='".$param['telefono']."'";
            if  (isset($param['email']))
            $where.=" and email='".$param['email']."'";
            if  (isset($param['comentario']))
            $where.=" and comentario='".$param['comentario']."'";
        }

        $arreglo = Contacto::listar($where);

        return $arreglo;
    }

    /**
     * permite paginar objetos
     * @param array $param
     * @return boolean
     */

    public function paginar($param, $limit, $offset){

        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['id']))
            $where.=" and id='".$param['id']."'";
            if  (isset($param['nombre']))
            $where.=" and nombre='".$param['nombre']."'";
            if  (isset($param['empresa']))
            $where.=" and empresa='".$param['empresa']."'";
            if  (isset($param['telefono']))
            $where.=" and telefono='".$param['telefono']."'";
            if  (isset($param['email']))
            $where.=" and email='".$param['email']."'";
            if  (isset($param['comentario']))
            $where.=" and comentario='".$param['comentario']."'";
        }

        if ($limit <> null) {

          $where.=" LIMIT $limit";

        }

        if ($offset <> "null") {

          $where.=" OFFSET $offset";

        }

        $arreglo = Contacto::listar($where);

        return $arreglo;
    }

}
?>
