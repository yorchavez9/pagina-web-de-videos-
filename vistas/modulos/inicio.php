<?php
date_default_timezone_set("America/Lima");
?>
<!DOCTYPE html>
<html lang="en">
<!-- head --> 
<?php include "main/head-footer/head.php"; ?>
<body>
    <?php
      /* ================================================
      CONTADOR DE VISITAS
      ================================================ */
      $ip = $_SERVER['REMOTE_ADDR'];
      $tipo = "contar";

      $sqlConsultar = ControladorVisitas::ctrMostrarVisitas($ip, $tipo);
      $contarVisitasG = count($sqlConsultar);
      $contarVisitas0 = count($sqlConsultar);
      
      if($contarVisitasG == 0){
        $contarVisitas0 = 1;
        $ingresoContador = new ControladorVisitas();
        $ingresoContador->ctrCrearVisitas($contarVisitas0);
      }else{
        foreach($sqlConsultar as $key => $value){
          $fechaRegistro = $value["fecha_visitas"];
          $fechaActual = date('Y-m-d H:i:s');
          $nuevaFecha = strtotime($fechaRegistro." + 1 hour");
          $nuevaFecha = date('Y-m-d H:i:s', $nuevaFecha);
        }
        if($fechaActual >= $nuevaFecha){

          $ingresoContador = new ControladorVisitas();
          $ingresoContador->ctrCrearVisitas($contarVisitasG+1);
        }
      }
    ?>
    <!-- header -->
    <?php include "main/contenido/header.php"; ?>
    <!-- login -->
    <?php include "main/contenido/login.php"; ?>
    <!-- nav -->
    <?php include "main/contenido/nav.php"; ?>
    <!-- main -->
    <?php include "main/contenido/main.php"; ?>

    <!-- footer -->
    <?php include "main/head-footer/footer.php"; ?>
</body>

</html>
