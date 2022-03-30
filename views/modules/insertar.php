<?php

$ofertas = new OfertaController;

$datos = $ofertas->ctrInsertarOferta();

if (!empty($datos)) {
    if (is_array($datos['rutas'])) {
        $numero_imagenes = count($datos['rutas']);
    } else {
        $numero_imagenes = 0;
    }


    ?>
    <div class="container">
        <p>La oferta ha sido recibida correctamente:</p>
        <ul>
            <li><b>Titulo:</b><?php echo $datos['datos']['titulo'] ?></li>
            <li><b>Descripcion:</b><?php echo $datos['datos']['descripcion'] ?></li>
            <li><b>Categoria:</b><?php echo $datos['datos']['categoria'] ?></li>
            <li>
                <b>Imagen:</b>
                <?php
                    if ($numero_imagenes == 0) {
                        echo '(No hay)';
                    } else {
                        for ($i = 0; $i < $numero_imagenes; $i++) {
                            if ($i == ($numero_imagenes - 1)) {
                                ?>
                            <a href="<?php echo $datos['rutas'][$i] ?>" target="_blank"><?php echo $datos['rutas'][$i] ?> </a>
                        <?php
                                    } else {
                                        ?>
                            <a href="<?php echo $datos['rutas'][$i] ?>" target="_blank"><?php echo $datos['rutas'][$i] ?> </a>,
                <?php
                            }
                        }
                    }
                    ?>
            </li>
        </ul>
    </div>
<?php
} else {
    ?>
    <div class="container">
        <form enctype="multipart/form-data" action="" method="POST" class="mt-4 ml-4 mr-4">
            <div class="form-group">
                <label for="titulo">Titulo*:</label>
                <input type="text" class="form-control" id="titulo" name="titulo">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion:*</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
            </div>



            <div class="form-group">
                <label for="categoria">Categoria:*</label>
                <select class="form-control" id="categoria" name="categoria">
                    <option value="">Seleccione categoria</option>
                    <option value="promociones">Promociones</option>
                    <option value="ofertas">Ofertas</option>
                    <option value="costas">Costas</option>
                </select>
            </div>
            <label for="imagen[]">Imagen:</label>
            <input type="file" id="imagen[]" name="imagen[]" multiple /><br /><br />
            <input type="submit" name="insertar" value="Insertar oferta" />
            <p class="mt-5">NOTA: los datos marcados con (*) deben ser rellenados obligatoriamente</p>
        </form>
    </div>
<?php
}
?>