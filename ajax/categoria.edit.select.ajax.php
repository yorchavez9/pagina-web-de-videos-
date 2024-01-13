<?php

require_once "../controladores/regalo.controlador.php";
require_once "../modelos/regalo.modelo.php";

if (isset($_POST['idSelect'])) {

    $tipo = "select";
    $valor = null;
    $item = $_POST['idSelect'];

    $respuesta = ControladorRegalo::ctrMostrarRegalo($tipo, $item, $valor);

    $htmlDatos = "";
    foreach($respuesta as $key => $value) {
        $htmlDatos .='<option value="'.$value['id_r'].'">'.$value['titulo_r'].'</option>';
    }


    echo $htmlDatos;
}
