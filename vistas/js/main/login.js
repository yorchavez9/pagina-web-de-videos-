/* ==================================================
PREVISUALIZADOR DE IMAGEN DE LOGIN
================================================== */

$(".nuevoFotoLogin").change(function(){
    let imagen = this.files[0];
    /* ==========================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPE OPNG
    ========================================== */

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
        $(".nuevoFotoLogin").val("");
        Swal.fire({
            title: "¡Error al subir la imagen!",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            icon: "error",
            confirmButtonColor: "#0576b9",
        });
    }else if(imagen["size"] > 2000000){
        $(".nuevoFotoLogin").val("");
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
            $(".previsualizarLogin").attr("src",rutaImagen);
        })
    }
});