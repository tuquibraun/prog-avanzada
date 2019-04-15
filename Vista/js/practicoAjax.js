$(document).ready(function(){

      var offset = null;

    /* EJ 1 */
    //Escuchamos los cambios del Select País, cada vez que la seleccion_
    //cambie ejecutamos la funcion getEstados con el respectivo ID de país
    $(".selectpaises").change(function(){

        var id = $(this).val();

        getEstados(id);

    })

    /* EJ 2*/
    $(".nav-link").click(function(event){

      $(".nav-link").removeClass("active");

      $(this).addClass("active");

      var ej = $(this).attr("ej");

      getEjercicio(ej);

      if (ej == 6) {
          getContactos(offset)
      }

    })

    /* EJ 3 */
    /** Selecciona al jugador por id al clickearlo */
    $('.jugador').click(function(){
      console.log("click")

      var id = $(this).attr('id');

      getJugador(id);

    })

    /* EJ 4 */
    $(".ej4 .enviar").click(function(){

      //CAPTURAMOS DATOS DE INPUTS EN VARIABLES
      var nombre =  $("input#nombre").val();

      var empresa =  $("input#empresa").val();

      var telefono =  $("input#telefono").val();

      var email =  $("input#email").val();

      var comentario =  $("textarea#comentario").val();

      //Si los datos son validadaos por el script se ejecuta enviarDatos()
      if (validarDatos(nombre, empresa, telefono, email, comentario)) {

        enviarDatos(nombre, empresa, telefono, email, comentario);

      }

    })

    $(".ej4 .borrar").click(function(){

      resetForm()

    })


    /* EJ 5 */

    $("#nav-tabContent").on('click', $("nav ul button:nth-child(1)"), function(event) {

      offset = offset+5;
      setTimeout(function(){
        getContactos(offset)
      }, 1000);

    })


    $("#nav-tabContent").on('click', $("nav ul button:nth-child(2)"), function(event) {

      offset = offset-5;
      setTimeout(function(){
        getContactos(offset)
      }, 1000);

    })

    /* EJ 6 */
    $("#usuario").keyup(function() {

        var data = $(this).val();
        validarUsuario(data)

     });

     /** EJ 7 */
     $('#search').keyup(function() {

       var data = $(this).val();
       $('#result').html("")
       getEstadosLetras(data)

     });


});



//Se encarga de buscar los estados del país seleccionado
function getEstados(idpais) {

    //Se crea un FormData con el id del país y la funcion a ejecutar en el archivo de la URL
    var datos = new FormData();
    datos.append("idPais", idpais);
    datos.append("funcion", "buscarestados");

    $.ajax({
        url: 'Ajax/funcionesAjax.php',
        type: 'POST',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(response){
          $(".ciudad").remove()
        },
        success: function(response){
        //decodificamos los datos recibidos
        var estados = JSON.parse(response)

        //Realizamos un foreach con los datos recibidos y creamos una opción por cada iteración
        estados.forEach(function(estado) {

          $(".selectciudades").append("<option class='ciudad' value='"+estado.id+"'>"+estado.descripcion+"</option>s")

        });
        },
        error: function(xhr, status, error){
            console.log(error)
        },
    });

}

function getEjercicio(ej) {

    $( ".tab-content" ).load("Vista/modulos/bootstrap/ej"+ej+".php", function( data ) {

    })

}

function enviarDatos(nombre, empresa, telefono, email, comentario) {

  //Se crea un FormData con los datos del formulario y la funcion a ejecutar en el archivo de la URL
  var datos = new FormData();
  datos.append("nombre", nombre);
  datos.append("empresa", empresa);
  datos.append("telefono", telefono);
  datos.append("email", email);
  datos.append("comentario", comentario);
  datos.append("funcion", "enviardatos")

  $.ajax({
      url: 'Ajax/funcionesAjax.php',
      type: 'POST',
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function(response){

      },
      success: function(response){

        //Si la respuesta es OK le avisamos al usuario que el contacto se cargó correctamente
        if (response == "ok") {

          $(".ej4 .container").append("<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Contacto agregado correctamente!</strong> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times</span></button></div>")

          resetForm();
          //Si la respuesta es distinta a OK le avisamos al usuario que hubo un error al cargar el contacto
        } else {

          $(".ej4 .container").append("<div class='alert alert-error alert-dismissible fade show' role='alert'><strong>Error al agregar contacto!</strong> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times</span></button></div>")

          resetForm();

        }

        console.log(response);

      },

      error: function(xhr, status, error){

          console.log(error)

      },

  });

}

//Funcion para resetear el formulario
function resetForm() {

    $("input#nombre").val("");

    $("input#empresa").val("");

    $("input#telefono").val("");

    $("input#email").val("");

    $("textarea#comentario").val("");

}

//Funcion para validar los datos del formulario de contacto
function validarDatos(nombre, empresa, telefono, email, comentario){

  console.log(nombre, empresa, telefono, email, comentario)

  //VALIDAR EL NOMBRE
  if(nombre != ""){

    var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;

    if(!expresion.test(nombre)){

      $("#nombre").addClass("is-invalid");
      $("#nombre").after('<div class="invalid-feedback"><strong>ERROR:</strong> No se permiten números ni caracteres especiales</div>')

      return false;

    }

  }else{

    $("#nombre").addClass("is-invalid");
    $("#nombre").after('<div class="invalid-feedback"><strong>ERROR:</strong> Este campo es obligatorio</div>')

    return false;
  }

  //VALIDAR EL EMPRESA
  if(empresa == ""){

    $("#empresa").addClass("is-invalid");
    $("#empresa").after('<div class="invalid-feedback"><strong>ERROR:</strong> Este campo es obligatorio</div>')

    return false;

  }

  //VALIDAR EL TELEFONO
  if(telefono == ""){

    $("#telefono").addClass("is-invalid");
    $("#telefono").after('<div class="invalid-feedback"><strong>ERROR:</strong> Este campo es obligatorio</div>')

    return false;

  }

  //VALIDAR EL EMAIL
  if(email != ""){

    var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

    if(!expresion.test(email)){

      $("#email").addClass("is-invalid");
      $("#email").after('<div class="invalid-feedback"><strong>ERROR:</strong> Escriba correctamente el correo electrónico</div>')

      return false;

    }

  }else{

    $("#email").after('<div class="invalid-feedback"><strong>ERROR:</strong> Este campo es obligatorio</div>')

    return false;
  }

  //VALIDAR COMENTARIO
  if(comentario == ""){

    console.log("laa")

    $("#comentario").addClass("is-invalid");
    $("#comentario").after('<div class="invalid-feedback"><strong>ERROR:</strong> Este campo es obligatorio</div>')

    return false;

  }

  return true

}

function getContactos(offset) {

  //Se crea un FormData con el offset que vamos a utilizar en el query de la base de datos y el nombre de la funcion a ejecutar en el archivo de la URL
  var datos = new FormData();
  datos.append("offset", offset)
  datos.append("funcion", "buscarcontactos");

  $.ajax({
      url: 'Ajax/funcionesAjax.php',
      type: 'POST',
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function(response){
        $("#nav-tabContent tbody").html("")
      },
      success: function(response){
      //decodificamos los datos recibidos
      var contactos = JSON.parse(response)

      //Realizamos un foreach con los datos recibidos y creamos una opción por cada iteración
      contactos.forEach(function(contacto) {

        //sumamos el offset a la clave para que cambiar la pagina no se repitan las claves
        var clave = contacto.clave + offset

        //Creamos una fila nueva con los datos recibidos
        $(".tablacontactos").append("<tr> <th scope='row'>" + clave + "</th> <td>" + contacto.nombre + "</td> <td>" + contacto.empresa + "</td> <td>"+ contacto.telefono +"</td> <td>"+ contacto.email +"</td> <td>"+ contacto.comentario +"</td> </tr>")

      });

      },
      error: function(xhr, status, error){
          console.log(error)
      },

  });

}

function validarUsuario(data) {

  //Se crea un FormData con nombre de la funcion a ejecutar en el archivo de la URL
  var datos = new FormData();
  datos.append("data", data)
  datos.append("funcion", "validarUsuario");

  $.ajax({
      url: 'Ajax/funcionesAjax.php',
      type: 'POST',
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function(response){

      },
      success: function(response){
        // Si el tamaño del array recibido es mayor que 0, el usuario ya existe
        if (JSON.parse(response).length > 0) {
          // Notificamos que el usuario existe
          $('#usuario').popover({content: "El usuario ya existe", placement: "right", trigger: "manual"})
          $('#usuario').popover('show')

        } else {

          $('#usuario').popover('hide')

        }

      },
      error: function(xhr, status, error){
          console.log(error)
      },

  });
}

  function getEstadosLetras(data) {

    if (data != "") {

    //Se crea un FormData con nombre de la funcion a ejecutar en el archivo de la URL
    var datos = new FormData();
    datos.append("data", data)
    datos.append("funcion", "getEstadosLetras");

    $.ajax({
        url: 'Ajax/funcionesAjax.php',
        type: 'POST',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(response){

        },
        success: function(response){

          var estados = JSON.parse(response);
          // Si el tamaño del array recibido es mayor que 0, hay estados que comienzan con las letras enviadas por parametro
          if (estados.length > 0) {

            estados.forEach(function(estado) {
              //Mostramos esos estados en una lista
              $('#result').append('<li class="list-group-item link-class">'+estado.descripcion+' </li>')

            })

          }

        },
        error: function(xhr, status, error){
            console.log(error)
        },

    });

  }

}
