<?php

include_once '../Modelo/Estado.php';

class AbmEstado {
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

            $obj = new Estado();

            $obj-> setear($param['id'], $param['descripcion'], $param['idPais']);

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
            $obj = new Estado();
            $obj->setear($param['id'],null, null);

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
        $elObjtEstado = new Estado();
        $elObjtEstado = $this->cargarObjeto($param);
        // verEstructura($elObjtEstado);

        // print_R($elObjtEstado);
        if ($elObjtEstado!=null and $elObjtEstado->insertar()){
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

            $elObjtEstado = $this->cargarObjetoConClave($param);

            if ($elObjtEstado !=null and $elObjtEstado->eliminar()){

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
            $elObjtEstado = $this->cargarObjeto($param);

            if($elObjtEstado !=null and $elObjtEstado->modificar()){
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
            if  (isset($param['idPais']))
            $where.=" and idPais='".$param['idPais']."'";
        }

        $arreglo = Estado::listar($where);

        return $arreglo;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */

    public function buscarEstado($param){

        $where = " true ";
        if ($param<>NULL){

            if  (isset($param['descripcion']))
            $where.=" and descripcion LIKE '".$param['descripcion']."%'";

        }

        $arreglo = Estado::listar($where);

        return $arreglo;
    }

}
?>
