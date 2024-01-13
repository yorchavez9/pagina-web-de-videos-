<?php

require_once "conexion.php";

class ModeloCategoriaP{

    /* ===============================================
    MOSTRAR CATEGORIA A
    =============================================== */

    static public function mdlMostrarCategoriaP($tabla, $item, $valor){
        if($item !=null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt ->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt -> execute();
            return $stmt->fetchAll();
        }


		$stmt = null;
    }

   /*  ================================================
    REGISTRO DE CATEGORIA A
    ================================================ */

    static public function mdlIngresarCategoriaP($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_cp) VALUES(:nombre_cp)");
        $stmt->bindParam(":nombre_cp", $datos["nombre_cp"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

    /* ===============================================
    EDITAR CATEGORIA A
    =============================================== */

	static public function mdlEditarCategoriaP($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
                                                                nombre_cp = :nombre_cp
                                                          WHERE id_cp = :id_cp");

		$stmt -> bindParam(":nombre_cp", $datos["nombre_cp"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_cp", $datos["id_cp"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

   /*  =================================================
    BORRAR CATEGORIA A
    ================================================= */

    static public function mdlBorrarCategoriaP($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cp = :id_cp");
        $stmt->bindParam(":id_cp", $datos, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

}

