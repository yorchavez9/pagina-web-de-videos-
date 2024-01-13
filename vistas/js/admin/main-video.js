
/* ==================================================
PREVISUALIZADOR DE VIDEO DE REGALO
================================================== */

$(".nuevoVideoR").change(function () {
  let video = this.files[0];
  /* ==========================================
    VALIDAMOS EL FORMATO DE LA VIDEO SEA JPE OPNG
    ========================================== */

  if (video["type"] != "video/mp4") {
    $(".nuevoVideoR").val("");
    Swal.fire({
      title: "¡Error al subir el video!",
      text: "¡El formato de video debe estar en formato MP4 o PNG!",
      icon: "error",
      confirmButtonColor: "#0576b9",
    });
  } else if (video["size"] > 400000000) {
    $(".nuevoVideoR").val("");
    Swal.fire({
      title: "¡Error al subir el video!",
      text: "¡El video no debe pesar no debe pesar más de 200MB!",
      icon: "error",
      confirmButtonColor: "#0576b9",
    });
  } else {
    let datosVideo = new FileReader();
    datosVideo.readAsDataURL(video);

    $(datosVideo).on("load", function (event) {
      let rutaVideo = event.target.result;
      $(".previsualizarImagenR").attr("src", rutaVideo);
    });
  }
});

/* ==================================================
PREVISUALIZADOR DE IMAGEN DE REGALO
================================================== */

$(".nuevoFotoR").change(function () {
  let imagen = this.files[0];
  /* ==========================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPE OPNG
    ========================================== */

  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevoFotoR").val("");
    Swal.fire({
      title: "¡Error al subir la imagen!",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      icon: "error",
      confirmButtonColor: "#0576b9",
    });
  } else if (imagen["size"] > 2000000) {
    $(".nuevoFotoR").val("");
    Swal.fire({
      title: "¡Error al subir la imagen!",
      text: "¡La imagen no debe pesar más de 2MB!",
      icon: "error",
      confirmButtonColor: "#0576b9",
    });
  } else {
    let datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function (event) {
      let rutaImagen = event.target.result;
      $(".previsualizarImagenR").attr("poster", rutaImagen);
    });
  }
});

/* =============================================
GUARDAR REGALO
============================================= */

$(document).ready(function () {
  $("#guardar_video").on("click", function (e) {
    e.preventDefault();

    let formData = new FormData();

    let nuevoIdCategoria = $("#nuevoIdCategoria").val();
    let nuevoCodigoR = $("#nuevoCodigoR").val();
    let nuevoVideoR = $("#nuevoVideoR")[0].files[0];
    let nuevoFotoR = $("#nuevoFotoR")[0].files[0];
    let nuevoTituloR = $("#nuevoTituloR").val();
    let nuevoDescripcionR = $("#summernoteNuevoR").val();

    formData.append("nuevoIdCategoria", nuevoIdCategoria);
    formData.append("nuevoCodigoR", nuevoCodigoR);
    formData.append("nuevoVideoR", nuevoVideoR);
    formData.append("nuevoFotoR", nuevoFotoR);
    formData.append("nuevoTituloR", nuevoTituloR);
    formData.append("nuevoDescripcionR", nuevoDescripcionR);

    $.ajax({
      url: "ajax/regalo.ajax.php",
      type: "post",
      data: formData,
      contentType: false,
      processData: false,
      beforeSend: function() {
        Swal.fire({
          title: 'Subiendo video...',
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading()
          }
        })
    },
      success: function (response) {

        Swal.fire({
          title: "El video ha sido guardado con exito!",
          text: "Has click para cerrar",
          icon: "success",
          confirmButtonColor: "#0576b9",
        }).then(function (result) {
          if (result.value) {
            window.location = "admin-regalo";
          }
        });
      },
      error: function () {
        alert("Error al enviar datos");
      },
    });
  });
});

/*=============================================
EDITAR REGALO
=============================================*/
$(".tabla_regalo").on("click", ".btnEditarRegalo", function () {
  var idRegalo = $(this).attr("idRegalo");
  var datos = new FormData();
  datos.append("idRegalo", idRegalo);

  $.ajax({
    url: "ajax/regalo.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarIdRegalo").val(respuesta["id_r"]);
      $("#editarCodigoR").val(respuesta["codigo_r"]);

      $("#editarCategoriaR").val(respuesta["id_c"]);
      $("#editarCategoriaR").html(respuesta["nombre_c"]);

      $("#videoActualR").val(respuesta["video_r"]);
      $("#fotoActualR").val(respuesta["imagen_r"]);

      if (respuesta["imagen_r"] != "") {
        $(".previsualizarEditarImagenR").attr(
          "poster",
          respuesta["imagen_r"].slice(3)
        );
        $(".previsualizarEditarImagenR").html(
          "<source class='attr-video-modal' src='" +
            respuesta["video_r"].slice(3) +
            "' type='video/mp4'>"
        );
      } else {
        $(".previsualizarEditarImagenR").attr(
          "poster",
          "vistas/img/regalo/default/default.png"
        );
      }

      $("#editarTituloR").val(respuesta["titulo_r"]);
      $("#summernoteEditarR").summernote("code", respuesta["descripcion_r"]);
    },
  });
});

/* ===============================================
GUARDAR EDITAR
=============================================== */

$(document).ready(function () {
  $("#guardar_video_editado").on("click", function (e) {
    e.preventDefault();

    let formData = new FormData();

    let editarIdRegalo = $("#editarIdRegalo").val();
    let editarCodigoR = $("#editarCodigoR").val();
    let editarCategoriaR = $("#editandoCategoríaR").val();
    let videoActualR = $("#videoActualR").val();
    let editarVideoR = $("#editarVideoR")[0].files[0];
    let fotoActualR = $("#fotoActualR").val();
    let editarFotoR = $("#editarFotoR")[0].files[0];
    let editarTituloR = $("#editarTituloR").val();
    let editarDescripcionR = $("#summernoteEditarR").val();

    formData.append("editarIdRegalo", editarIdRegalo);
    formData.append("editarCodigoR", editarCodigoR);
    formData.append("editarCategoriaR", editarCategoriaR);
    formData.append("videoActualR", videoActualR);
    formData.append("editarVideoR", editarVideoR);
    formData.append("fotoActualR", fotoActualR);
    formData.append("editarFotoR", editarFotoR);
    formData.append("editarTituloR", editarTituloR);
    formData.append("editarDescripcionR", editarDescripcionR);

    $.ajax({
      url: "ajax/regalo.ajax.php",
      type: "post",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        Swal.fire({
          title: "El video ha sido editado con exito!",
          text: "Has click para cerrar",
          icon: "success",
          confirmButtonColor: "#0576b9",
        }).then(function (result) {
          if (result.value) {
            window.location = "admin-regalo";
          }
        });
      },
      error: function () {
        alert("Error al enviar datos");
      },
    });
  });
});

/*=============================================
ELIMINAR REGALO
=============================================*/
$(".tabla_regalo").on("click", ".btnEliminarRegalo", function () {
  var idRegalo = $(this).attr("idRegalo");
  var videoRegalo = $(this).attr("videoRegalo");
  var imagenRegalo = $(this).attr("imagenRegalo");
  var codigoRegalo = $(this).attr("codigoRegalo");

  Swal.fire({
    title: "¿Está seguro de borrar el video?",
    text: "Si no lo está puede cancelar la acción!",
    icon: "warning",
    showCancelButton: !0,
    confirmButtonColor: "#34c3af",
    cancelButtonColor: "#f46a6a",
    confirmButtonText: "Si, eliminar!",
  }).then(function (result) {
    if (result.value) {
      window.location =
        "index.php?ruta=admin-regalo&idRegalo=" +
        idRegalo +
        "&videoRegalo=" +
        videoRegalo +
        "&codigoRegalo=" +
        codigoRegalo +
        "&imagenRegalo=" +
        imagenRegalo;
    }
  });
});
