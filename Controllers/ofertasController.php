<?php

class ofertaController
{

    public function ctrInsertarOferta()
    {
        if (isset($_POST['insertar'])) {
            if (!empty($_POST['titulo'])) {
                if (!empty($_POST['descripcion'])) {
                    if (!empty($_POST['categoria'])) {

                        $datos = array('titulo' => $_POST['titulo'], 'descripcion' => $_POST['descripcion'], 'categoria' => $_POST['categoria']);



                        if ($_FILES['imagen']['size']['0'] > 0) {

                            $resultado_comprobacion = imagenesController::ctrComprobarImagen($_FILES['imagen']);
                            if (is_array($resultado_comprobacion)) {
                                return $resultado_comprobacion;
                            } else {
                                $id_oferta = ofertasModel::mdlInsertarOferta($datos);
                                $rutas = imagenesController::ctrPrepararImagen($id_oferta, $_FILES['imagen']);
                                imagenesController::ctrSubirImagen($id_oferta, $rutas);
                                $devolver = array('datos' => $datos, 'rutas' => $rutas);
                                return $devolver;
                            }
                        } else {
                            $id_oferta = ofertasModel::mdlInsertarOferta($datos);
                            imagenesController::ctrSubirImagen($id_oferta, 'default.png');
                            $rutas = 0;
                            $devolver = array('datos' => $datos, 'rutas' => $rutas);
                            return $devolver;
                        }
                    } else {
                        echo "<script>alert('Rellena categoria')</script>";
                    }
                } else {
                    echo "<script>alert('Rellena descripcion')</script>";
                }
            } else {
                echo "<script>alert('Rellena titulo')</script>";
            }
        }
    }
}
