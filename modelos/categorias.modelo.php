<?php

require_once "conexion.php";

class ModeloCategoria{

    /* ===============================================
    MOSTRAR CATEGORIA
    =============================================== */

    static public function mdlMostrarUCategoria($tablaP, $tablaS, $item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaP INNER JOIN $tablaS ON $tablaP.id_cp = $tablaS.id_cp WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaP INNER JOIN $tablaS ON $tablaP.id_cp = $tablaS.id_cp");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt = null;
    }

   /*  ================================================
    REGISTRO DE CATEGORIA
    ================================================ */

    static public function mdlIngresarCategoria($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_c, id_cp) 
                                                            VALUES(:nombre_c, :id_cp)");
        $stmt->bindParam(":nombre_c", $datos["nombre_c"], PDO::PARAM_STR);
        $stmt->bindParam(":id_cp", $datos["id_cp"], PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }


    /* ===============================================
    EDITAR CATEGORIA
    =============================================== */

	static public function mdlEditarCategoria($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_c = :nombre_c, id_cp = :id_cp WHERE id_c = :id_c");

		$stmt -> bindParam(":nombre_c", $datos["nombre_c"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_cp", $datos["id_cp"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_c", $datos["id_c"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

   /*  =================================================
    BORRAR CATEGORIA
    ================================================= */

    static public function mdlBorrarCategoria($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_c = :id_c");
        $stmt->bindParam(":id_c", $datos, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }
}

