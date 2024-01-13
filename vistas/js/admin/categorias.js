

/* =============================================
GUARDAR CATEGORIA A
============================================= */

$(document).ready(function () {
	$("#guardarSubCategoria").on("click", function (e) {

		e.preventDefault();

		let formData = new FormData();

		let nuevoIdCategoriaP = $("#nuevoIdCategoriaP").val();
		let nuevoNombreC = $("#nuevoNombreC").val();

		formData.append("nuevoIdCategoriaP", nuevoIdCategoriaP);
		formData.append("nuevoNombreC", nuevoNombreC);

		$.ajax({
		url: "ajax/categorias.ajax.php",
		type: "post",
		data: formData,
		contentType: false,
		processData: false,
		beforeSend: function () {
			Swal.fire({
			title: "Subiendo Categoría B...",
			timerProgressBar: true,
			didOpen: () => {
				Swal.showLoading();
			},
			});
		},
		success: function (response) {
			Swal.fire({
			title: "La categoría se ha sido guardado con exito!",
			text: "Has click para cerrar",
			icon: "success",
			confirmButtonColor: "#0576b9",
			}).then(function (result) {
			if (result.value) {
				window.location = "admin-categoria";
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
EDITAR CATEGORIA
=============================================*/
$(".tabla_categoria").on("click", ".btnEditarCategoria", function(){
	var idCategoria = $(this).attr("idCategoria");
	
	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({

		url:"ajax/categorias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarIdCategoria").val(respuesta["id_c"]);

			$("#editarCategoriaP").val(respuesta["id_cp"]);
			$("#editarCategoriaP").html(respuesta["nombre_cp"]);

			$("#editarNombreC").val(respuesta["nombre_c"]);


		}

	});

})

/* ===============================================
GUARDAR CATEGORIA A
=============================================== */

$(document).ready(function () {
	$("#GuardarEditar").on("click", function (e) {

		e.preventDefault();

		let formData = new FormData();

		let editarIdCategoria = $("#editarIdCategoria").val();
		let editandoCategoriaP = $("#editandoCategoriaP").val();
		let editarNombreC = $("#editarNombreC").val();

		formData.append("editarIdCategoria", editarIdCategoria);
		formData.append("editandoCategoriaP", editandoCategoriaP);
		formData.append("editarNombreC", editarNombreC);

		$.ajax({
		url: "ajax/categorias.ajax.php",
		type: "post",
		data: formData,
		contentType: false,
		processData: false,
		beforeSend: function () {
			Swal.fire({
			title: "Actualizando Categoría B...",
			timerProgressBar: true,
			didOpen: () => {
				Swal.showLoading();
			},
			});
		},
		success: function (response) {
			Swal.fire({
			title: "La categoría B ha sido editado con exito!",
			text: "Has click para cerrar",
			icon: "success",
			confirmButtonColor: "#0576b9",
			}).then(function (result) {
			if (result.value) {
				window.location = "admin-categoria";
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
ELIMINAR CATEGORIA
=============================================*/
$(".tabla_categoria").on("click", ".btnEliminarCategoria", function(){

	var idCategoriaD = $(this).attr("idCategoria");

    var datos = new FormData();
    datos.append("idCategoriaD", idCategoriaD);
  
	Swal.fire({
	  title: "¿Está seguro de borrar el usuario?",
	  text: "Si no lo está puede cancelar la acción!",
	  icon: "warning",
	  showCancelButton: !0,
	  confirmButtonColor: "#34c3af",
	  cancelButtonColor: "#f46a6a",
	  confirmButtonText: "Si, eliminar!",
	}).then(function (result) {
		$.ajax({
			url: "ajax/categorias.ajax.php",
			type: "post",
			data: datos,
			contentType: false,
			processData: false,
			success: function (response) {
			  Swal.fire({
				title: "La categoría B ha sido eliminado!",
				text: "Has click para cerrar",
				icon: "success",
				confirmButtonColor: "#0576b9",
			  }).then(function (result) {
				if (result.value) {
				  window.location = "admin-categoria";
				}
			  });
			},
			error: function () {
			  alert("Error al enviar datos");
			},
		  });
	});
  
  
  })
  