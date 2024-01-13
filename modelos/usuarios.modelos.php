<?php

require_once "conexion.php";

class ModeloUsuarios{

    /* ===============================================
    MOSTRAR USUARIOS
    =============================================== */

    static public function mdlMostrarUsuarios($tabla, $item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt = null;
    }

   /*  ================================================
    REGISTRO DE USUARIO
    ================================================ */

    static public function mdlIngresarUsuario($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_usuario, correo_usuario, password_usuario, perfil_usuario, foto_usuario) 
                                                            VALUES(:nombre_usuario, :correo_usuario, :password_usuario, :perfil_usuario, :foto_usuario)");
        $stmt->bindParam(":nombre_usuario", $datos["nombre_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":correo_usuario", $datos["correo_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password_usuario", $datos["password_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":perfil_usuario", $datos["perfil_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":foto_usuario", $datos["foto_usuario"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }



    /*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

    /* ===============================================
    EDITAR USUARIO
    =============================================== */

	static public function mdlEditarUsuario($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_usuario = :nombre_usuario, password_usuario = :password_usuario, perfil_usuario = :perfil_usuario, foto_usuario = :foto_usuario WHERE correo_usuario = :correo_usuario");

		$stmt -> bindParam(":nombre_usuario", $datos["nombre_usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":password_usuario", $datos["password_usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil_usuario", $datos["perfil_usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto_usuario", $datos["foto_usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":correo_usuario", $datos["correo_usuario"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

   /*  =================================================
    BORRAR USUARIO
    ================================================= */

    static public function mdlBorrarUsuario($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");
        $stmt->bindParam(":id_usuario", $datos, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }
}

