<?php

class imagenesController
{
    public static function ctrSubirImagen($id_oferta, $rutas)
    {
        $resultado = ofertasModel::mdlSubirImagen($id_oferta, $rutas);
        return $resultado;
    }

    public static function ctrComprobarImagen($imagen)
    {
        foreach ($imagen['tmp_name'] as $id => $tmp_name) {
            if ($imagen['size'][$id] > 1024000) {
                $errores[] = "El tamaño es superior al permitido";
            }

            if ($imagen['type'][$id] != 'image/jpeg' and $imagen['type'] != 'image/png') {
                $errores[] = "El tipo de archivo no es valido";
            }
        }

        if (!empty($errores)) {
            return $imagen['type'][$id];
        } else {
            return true;
        }
    }

    public static function ctrPrepararImagen($id_oferta, $imagen)
    {

        $rutas = array();
        $nombre_carpeta = $id_oferta;

        // CREAMOS EL DIRECTORIO
        $directorio = "img/" . $id_oferta;
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777);
        }

        foreach ($imagen['tmp_name'] as $id => $tmp_name) {

            $total_imagenes = count(glob('img/' . $id_oferta . '/{*.jpg,*.png}', GLOB_BRACE));

            if ($total_imagenes > 0) {
                $nombre_imagen = $id_oferta . "." . $total_imagenes;
            } else {
                $nombre_imagen = $id_oferta;
            }


            list($ancho, $alto) = getimagesize($imagen["tmp_name"][$id]);
            $nuevoAncho = 500;
            $nuevoAlto = 500;


            // APLICAMOS FUNCIONES SEGUN EL FORMATO

            if ($imagen["type"][$id] == "image/jpeg") {
                $ruta = "img/" . $nombre_carpeta . "/" . $nombre_imagen . ".jpg";
                $origen = imagecreatefromjpeg($imagen["tmp_name"][$id]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                imagejpeg($destino, $ruta);
            } elseif ($imagen["type"][$id] == "image/png") {
                $ruta = "img/" . $nombre_carpeta . "/" . $nombre_imagen . ".png";
                $origen = imagecreatefrompng($imagen["tmp_name"][$id]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                imagepng($destino, $ruta);
            }
            $rutas[$id] = $ruta;
        }
        return $rutas;
    }
}
