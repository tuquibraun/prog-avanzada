<?php

include 'Modelo/Jugador.php';

class AbmJugador {
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object
     */

    public function cargarObjeto($param){

        //    echo "entramos a cargar objeto";

        $obj = null;

        if(array_key_exists('nombre',$param)){

            $obj = new Jugador();

            $obj-> setear($param['id'], $param['nombre'], $param['descripcion']);

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
            $obj = new Jugador();
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
        $elObjtJugador = new Jugador();
        $elObjtJugador = $this->cargarObjeto($param);
        // verEstructura($elObjtJugador);

        // print_R($elObjtJugador);
        if ($elObjtJugador!=null and $elObjtJugador->insertar()){
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

            $elObjtJugador = $this->cargarObjetoConClave($param);

            if ($elObjtJugador !=null and $elObjtJugador->eliminar()){

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
            $elObjtJugador = $this->cargarObjeto($param);

            if($elObjtJugador !=null and $elObjtJugador->modificar()){
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
            if  (isset($param['descripcion']))
            $where.=" and descripcion='".$param['descripcion']."'";
        }

        $arreglo = Jugador::listar($where);

        return $arreglo;
    }

}
?>
