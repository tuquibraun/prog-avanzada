<?php

include_once '../Controlador/AbmEstado.php';
include_once '../Controlador/AbmUsuario.php';
include_once '../Controlador/AbmContacto.php';

// EVALUAMOS EL TIPO DE FUNCION A EJECUTAR
switch ($_POST["funcion"]) {
  //ej1
    case 'buscarestados':
        getEstados();
        break;

  //ej4
    case 'enviardatos':
        enviarDatos();
        break;

  //ej5
    case 'buscarcontactos':
        getContactos();
        break;

  //ej6
    case 'validarUsuario':
        validarUsuario();
        break;

  //ej6
    case 'getEstadosLetras':
        getEstadosLetras();
        break;
}

function getEstados() {

    $param = $array = [
        "idPais" => $_POST['idPais']
    ];

    $objEstado = new AbmEstado;

    $estados = $objEstado::buscar($param);

    $array = [];

    foreach ($estados as $estado) {

      $obj = (object) [
        'id' => $estado->getId(),
        'descripcion' => $estado->getDescripcion(),
        'idpais' => $estado->getIdPais()
      ];

      array_push($array, $obj);

    }

    echo json_encode($array);

}

function enviarDatos() {

  $valido = "error";

  if (isset($_POST)) {

    //VALIDAR EL NOMBRE
    if(isset($_POST["nombre"])){


      $valido = "ok";

    }

    //VALIDAR EL EMPRESA
    if(isset($_POST["empresa"])){

      $valido = "ok";

    }

    //VALIDAR EL TELEFONO
    if(isset($_POST["telefono"])){

      $valido = "ok";

    }

    //VALIDAR EL EMAIL
    if(isset($_POST["email"])){

      $valido = "ok";

    }

  }

  if ($valido == "ok") {

    $param = $array = [
        "id" => null,
        "nombre" => $_POST['nombre'],
        "empresa" => $_POST['empresa'],
        "telefono" => $_POST['telefono'],
        "email" => $_POST['email'],
        "comentario" => $_POST['comentario']
    ];

    $objContacto = new AbmContacto;

    if ($objContacto->alta($param)) {

      echo "ok";

    } else {

      echo "error";

    }

  }

}

function getContactos() {

  $offset = $_POST["offset"];

  $objContacto = new AbmContacto;

  $contactos = $objContacto::paginar(null, 5, $offset);

  $array = [];

  foreach ($contactos as $clave => $contacto) {

    $obj = (object) [
      'clave' => $clave + 1,
      'id' => $contacto->getId(),
      'nombre' => $contacto->getNombre(),
      'empresa' => $contacto->getEmpresa(),
      'telefono' => $contacto->getTelefono(),
      'email' => $contacto->getEmail(),
      'comentario' => $contacto->getComentario()

    ];

    array_push($array, $obj);

  }

  echo json_encode($array);

}

function validarUsuario() {

  $param = $array = [
      "usuario" => $_POST['data']
  ];

  $objUsuario = new AbmUsuario;

  $usuarios = $objUsuario::buscar($param);

  $array = [];

  foreach ($usuarios as $usuario) {

    $obj = (object) [

      'usuario' => $usuario->getUsuario(),

    ];

    array_push($array, $obj);

  }

  echo json_encode($array);

}

function getEstadosLetras() {

  $param = $array = [
      "descripcion" => $_POST['data']
  ];

  $objEstado = new AbmEstado;

  $estados = $objEstado::buscarEstado($param);

  $array = [];

  foreach ($estados as $estado) {

    $obj = (object) [

      'descripcion' => $estado->getDescripcion(),

    ];

    array_push($array, $obj);

  }

  echo json_encode($array);

}

?>
