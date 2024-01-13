
  /* =============================================
  GUARDAR CATEGORIA A
  ============================================= */
  
  $(document).ready(function () {
    $("#guardar_categoriap").on("click", function (e) {

      e.preventDefault();

      let formData = new FormData();
  
      let nuevoNombreCP = $("#nuevoNombreCP").val();
  
      formData.append("nuevoNombreCP", nuevoNombreCP);
  
      $.ajax({
        url: "ajax/categoriap.ajax.php",
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          Swal.fire({
            title: "Subiendo Categoría...",
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
              window.location = "admin-categoriap";
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
  EDITAR CATEGORIA A
  =============================================*/
  $(".tabla_categoriap").on("click", ".btnEditarCategoriaP", function () {
    
    var idCategoriaP = $(this).attr("idCategoriaP");

    var datos = new FormData();
    datos.append("idCategoriaP", idCategoriaP);
  
    $.ajax({
      url: "ajax/categoriap.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {

        $("#editarIdCategoriaP").val(respuesta["id_cp"]);
        $("#editarNombreCP").val(respuesta["nombre_cp"]);

      },
    });
  });
  
  /* ===============================================
  GUARDAR CATEGORIA A
  =============================================== */
  
  $(document).ready(function () {
    $("#guardarCPAEditado").on("click", function (e) {

      e.preventDefault();
  
      let formData = new FormData();
  
      let editarIdCategoriaP = $("#editarIdCategoriaP").val();
      let editarNombreCP = $("#editarNombreCP").val();

      formData.append("editarIdCategoriaP", editarIdCategoriaP);
      formData.append("editarNombreCP", editarNombreCP);

      $.ajax({
        url: "ajax/categoriap.ajax.php",
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
          Swal.fire({
            title: "Actualizando Categoría A...",
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading();
            },
          });
        },
        success: function (response) {
          Swal.fire({
            title: "La categoría ha sido editado con exito!",
            text: "Has click para cerrar",
            icon: "success",
            confirmButtonColor: "#0576b9",
          }).then(function (result) {
            if (result.value) {
              window.location = "admin-categoriap";
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
  ELIMINAR CATEGORIA A
  =============================================*/
  $(".tabla_categoriap").on("click", ".btnEliminarCategoriaP", function (e) {

    var idCategoriaPD = $(this).attr("idCategoriaP");

    var datos = new FormData();
    datos.append("idCategoriaPD", idCategoriaPD);
  
    Swal.fire({
      title: "¿Está seguro de borrar la categoría?",
      text: "Si no lo está puede cancelar la acción!",
      icon: "warning",
      showCancelButton: !0,
      confirmButtonColor: "#34c3af",
      cancelButtonColor: "#f46a6a",
      confirmButtonText: "Si, eliminar!",
    }).then(function (result) {
        $.ajax({
          url: "ajax/categoriap.ajax.php",
          type: "post",
          data: datos,
          contentType: false,
          processData: false,
          success: function (response) {
            Swal.fire({
              title: "La categoría ha sido eliminado!",
              text: "Has click para cerrar",
              icon: "success",
              confirmButtonColor: "#0576b9",
            }).then(function (result) {
              if (result.value) {
                window.location = "admin-categoriap";
              }
            });
          },
          error: function () {
            alert("Error al enviar datos");
          },
        });
    });
  });
  