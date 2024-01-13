<?php

/* =========================================
CONTROLADORES
========================================= */

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categoriap.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/regalo.controlador.php";
require_once "controladores/anuncio.controlador.php";
require_once "controladores/visitas.controlador.php";

/* =========================================
MODELOS
========================================= */
require_once "modelos/usuarios.modelos.php";
require_once "modelos/categoriap.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/regalo.modelo.php";
require_once "modelos/anuncio.modelo.php";
require_once "modelos/visitas.modelo.php";

$plantilla = new ControladorPlantilla();

$plantilla->ctrPlantilla();