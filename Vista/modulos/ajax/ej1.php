<?php 

    include_once 'Controlador/AbmPais.php';

    $paises = AbmPais::buscar(null);

?>
<div class="container">
    
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Options</label>
    </div>
    <select class="custom-select selectpaises" id="inputGroupSelect01">
        <option selected>Paises</option>
        <?php foreach ($paises as $pais) {
            echo '<option value="'.$pais->getId().'"> '.$pais->getDescripcion().' </option>';
        } ?>
        
    </select>
    </div>


    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Options</label>
    </div>
    <select class="custom-select selectciudades" id="inputGroupSelect01">
        <option selected>Ciudades</option>
        
    </select>
    </div>

</div>
