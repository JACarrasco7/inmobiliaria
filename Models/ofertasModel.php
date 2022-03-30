<?php

require_once 'conexion.php';

class ofertasModel
{

    public static function mdlInsertarOferta($datos)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("INSERT INTO Ofertas(titulo, descripcion, categoria) VALUES (:titulo, :descripcion, :categoria)");
        $sentencia->bindparam(":titulo", $datos['titulo'], PDO::PARAM_STR);
        $sentencia->bindparam(":descripcion", $datos['descripcion'], PDO::PARAM_STR);
        $sentencia->bindparam(":categoria", $datos['categoria'], PDO::PARAM_STR);

        if ($sentencia->execute()) {
            return $conexion->lastInsertId();
        }
    }

    public static function mdlSubirImagen($id_oferta, $rutas)
    {
        if (is_array($rutas)) {
            for ($i = 0; $i < count($rutas); $i++) {
                $conexion = Conexion::conectar();
                $sentencia = $conexion->prepare("INSERT INTO imagenes(id_oferta, imagen) VALUES (:id_oferta, :ruta)");
                $sentencia->bindparam(":id_oferta", $id_oferta, PDO::PARAM_INT);
                $sentencia->bindparam(":ruta", $rutas[$i], PDO::PARAM_STR);
                $sentencia->execute();
            }
        } else {
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("INSERT INTO imagenes(id_oferta, imagen) VALUES (:id_oferta, :ruta)");
            $sentencia->bindparam(":id_oferta", $id_oferta, PDO::PARAM_INT);
            $sentencia->bindparam(":ruta", $rutas, PDO::PARAM_STR);
            $sentencia->execute();
        }
    }
}
