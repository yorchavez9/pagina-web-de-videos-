
/* ================================================
SELECCION DE CATEGORIA A Y B
================================================ */

$("#nuevaCategoria").change(function () {
    var idSelect = $("#nuevaCategoria").val();
    $.ajax({
      url: "ajax/categoria.select.ajax.php",
      type: "POST",
      data: { idSelect: idSelect },
      beforeSend: function () {},
      success: function (data) {
        $("#nuevoIdRegalo").html(data);
      },
      error: function () {
        alert("Error");
      },
    });
  });

/* ================================================
SELECCION EDITAR DE CATEGORIA A Y B
================================================ */

$("#editarCategoriaAn").change(function () {
   
    var idSelect = $("#editarCategoriaAn").val();
    $.ajax({
      url: "ajax/categoria.edit.select.ajax.php",
      type: "POST",
      data: { idSelect: idSelect },
      beforeSend: function () {},
      success: function (data) {
        $("#editarRegaloAB").html(data);
      },
      error: function () {
        alert("Error");
      },
    });
  });


/* ==================================================
PREVISUALIZADOR DE IMAGEN DE PRINCIPAL DEL ANUNCIO
================================================== */

$(".nuevoImagenAM").change(function(){
    let imagen = this.files[0];
    /* ==========================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPE OPNG
    ========================================== */

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
        $(".nuevoImagenAM").val("");
        Swal.fire({
            title: "¡Error al subir la imagen!",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            icon: "error",
            confirmButtonColor: "#0576b9",
        });
    }else if(imagen["size"] > 2000000){
        $(".nuevoImagenAM").val("");
        Swal.fire({
            title: "¡Error al subir la imagen!",
            text: "¡La imagen no debe pesar más de 2MB!",
            icon: "error",
            confirmButtonColor: "#0576b9",
        });
    }else{
        let datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){
            let rutaImagen = event.target.result;
            $(".previsualizarMainImagen").attr("src",rutaImagen);
        })
    }
});
/* ==================================================
PREVISUALIZADOR DE IMAGEN DE BANNER DEL ANUNCIO
================================================== */

$(".nuevoImagenAB").change(function(){
    let imagen = this.files[0];
    /* ==========================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPE OPNG
    ========================================== */

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
        $(".nuevoImagenAB").val("");
        Swal.fire({
            title: "¡Error al subir la imagen!",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            icon: "error",
            confirmButtonColor: "#0576b9",
        });
    }else if(imagen["size"] > 2000000){
        $(".nuevoImagenAB").val("");
        Swal.fire({
            title: "¡Error al subir la imagen!",
            text: "¡La imagen no debe pesar más de 2MB!",
            icon: "error",
            confirmButtonColor: "#0576b9",
        });
    }else{
        let datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){
            let rutaImagen = event.target.result;
            $(".previsualizarBannerImagen").attr("src",rutaImagen);
        })
    }
});


/*=============================================
EDITAR ANUNCIO
=============================================*/
$(".tabla_anuncio").on("click", ".btnEditarAnuncio", function(){
	var idAnuncio = $(this).attr("idAnuncio");
	var datos = new FormData();
	datos.append("idAnuncio", idAnuncio);

	$.ajax({

		url:"ajax/anuncio.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarIdAnuncio").val(respuesta["id_a"]);
			$("#editarCodigoA").val(respuesta["codigo_a"]);

			$("#editarCategoriaA").val(respuesta["id_c"]);
			$("#editarCategoriaA").html(respuesta["nombre_c"]);

			$("#editarRegaloA").val(respuesta["id_r"]);
			$("#editarRegaloA").html(respuesta["titulo_r"]);

            $("#imagenActualA").val(respuesta["imagen_a"]);
			$("#imagenActualB").val(respuesta["imagen_a_b"]);

			if(respuesta["imagen_a"] != ""){
				$(".previsualizadorImagenAnuncio").attr("src", respuesta["imagen_a"]);
			}else{
				$(".previsualizarEditarImagenR").attr("src", "vistas/img/anuncio/default/default.png");
			}

			if(respuesta["imagen_a_b"] != ""){
                $(".previsualizarImagenBanner").attr("src", respuesta["imagen_a_b"]);
			}else{
				$(".previsualizarImagenBanner").attr("src", "vistas/img/anuncio/default/defaultB.png");
			}

			$("#editarTituloR").val(respuesta["titulo_a"]);
            $("#summernoteEditarA").summernote("code", respuesta["descripcion_a"]);
            $("#editarLinkA").val(respuesta["link_a"]);
		}

	});

})

/*=============================================
ELIMINAR ANUNCIO
=============================================*/
$(".tabla_anuncio").on("click", ".btnEliminarAnuncio", function(){

	var idAnuncio = $(this).attr("idAnuncio");
	var imagenAnuncio = $(this).attr("imagenAnuncio");
	var imagenBanner = $(this).attr("imagenBanner");
	var condigoAnuncio = $(this).attr("condigoAnuncio");
  
	Swal.fire({
	  title: "¿Está seguro de borrar el anuncio?",
	  text: "Si no lo está puede cancelar la acción!",
	  icon: "warning",
	  showCancelButton: !0,
	  confirmButtonColor: "#34c3af",
	  cancelButtonColor: "#f46a6a",
	  confirmButtonText: "Si, eliminar!",
	}).then(function (result) {
	  if(result.value){
  
		  window.location = "index.php?ruta=admin-anuncio&idAnuncio="+idAnuncio+"&imagenAnuncio="+imagenAnuncio+"&imagenBanner="+imagenBanner+"&condigoAnuncio="+condigoAnuncio;
	
		}
	});
  
  
  })
  