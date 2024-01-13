<?php
session_start();

if (isset($_SESSION["iniciarSession"]) && $_SESSION["iniciarSession"] == "ok") {

  /* error_reporting(0); */
  include "modulos/admin/head-footer/head.php";
  echo '<div id="main-wrapper">';

        include "modulos/admin/contenido/admin-header.php";
        include "modulos/admin/contenido/admin-chatbox.php";
        include "modulos/admin/contenido/admin-header-start.php";
        include "modulos/admin/contenido/admin-sidebar.php";

        if (isset($_GET["ruta"])) {

          if (
            $_GET["ruta"] == "admin-inicio" ||
            $_GET["ruta"] == "admin-usuarios" ||
            $_GET["ruta"] == "admin-categoriap" ||
            $_GET["ruta"] == "admin-categoria" ||
            $_GET["ruta"] == "admin-embudo" ||
            $_GET["ruta"] == "admin-regalo" ||
            $_GET["ruta"] == "admin-anuncio" ||
            $_GET["ruta"] == "admin-calificacion" ||
            $_GET["ruta"] == "admin-vistas" ||
            $_GET["ruta"] == "admin-salir"
          ) {

            include "modulos/admin/contenido/".$_GET["ruta"].".php";
          } else {

            include "modulos/admin/contenido/admin-404.php";
          }
        } else {

          include "modulos/admin/contenido/admin-inicio.php";
        }

        include "modulos/admin/contenido/admin-footer-start.php";

  echo '</div>';

  include "modulos/admin/head-footer/footer.php";
} else {
  include "modulos/inicio.php";
}
