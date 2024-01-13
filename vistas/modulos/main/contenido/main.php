<?php
if (isset($_GET["idCategoria"]) && isset($_GET["nombreCategoria"])) {
?>
    <main class="main-grid">

        <section class="video_content grid">

            <?php
            $tipo = "random";
            $item = null;
            $valor = null;

            $mostrarVideos = ControladorRegalo::ctrMostrarRegalo($tipo, $item, $valor);

            foreach ($mostrarVideos as $key => $value) {
            ?>
                <?php
                if ($_GET["idCategoria"] == $value["id_c"]) {
                ?>
                    <div class="video_items ">
                        <a class="click_video" href="index.php?idVideo=<?php echo $value['id_r'] ?>&nombreVideo=<?php echo $value["titulo_r"] ?>&idCategoria=<?php echo $value["id_c"] ?>">
                            <video  poster="<?php echo substr($value["imagen_r"],3) ?>" width="290" height="200">
                                <source src="<?php echo substr($value["video_r"],3) ?>" type="video/mp4">
                            </video>
                        </a>
                        <div class="details flex">
                            <div class="heading">
                                <p><a class="text-white click_video" href="index.php?idVideo=<?php echo $value['id_r'] ?>&nombreVideo=<?php echo $value["titulo_r"] ?>&idCategoria=<?php echo $value["id_c"] ?>"><?php echo $value["titulo_r"] ?></a></p>
                                <a href="index.php?idCategoria=<?php echo $value['id_c'] ?>&nombreCategoria=<?php echo $value["nombre_c"] ?>"><span><?php echo $value["nombre_c"] ?> <i class="fa fa-circle-check"></i> </span></a>
                                
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

            <?php
            }
            ?>
        </section>
    </main>
<?php
} elseif (isset($_GET["search-btn"])) {
?>
    <main class="main-grid">
        <section class="video_content grid">
            <?php

            $dato = $_GET["buscarVideo"];

            $resultadoBus = ControladorRegalo::ctrBuscarVideo($dato);
            $cantidad = count($resultadoBus);

            if ($cantidad <= 0) {
            ?>

                <?php

            } else {

                foreach ($resultadoBus as $key => $value) {
                ?>
                    <div class="video_items">
                        <a class="click_video" href="index.php?idVideo=<?php echo $value['id_r'] ?>&nombreVideo=<?php echo $value["titulo_r"] ?>&idCategoria=<?php echo $value["id_c"] ?>">
                            <video poster="<?php echo substr($value["imagen_r"],3) ?>" width="290" height="200">
                                <source src="<?php echo substr($value["video_r"],3) ?>" type="video/mp4">
                            </video>
                        </a>
                        <div class="details flex">
                            <div class="heading">
                                <p><a class="text-white click_video" href="index.php?idVideo=<?php echo $value['id_r'] ?>&nombreVideo=<?php echo $value["titulo_r"] ?>&idCategoria=<?php echo $value["id_c"] ?>"><?php echo $value["titulo_r"] ?></a></p>
                                <a href="index.php?idCategoria=<?php echo $value['id_c'] ?>&nombreCategoria=<?php echo $value["nombre_c"] ?>"><span><?php echo $value["nombre_c"] ?> <i class="fa fa-circle-check"></i> </span></a>
                                
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

        </section>
    </main>
<?php
} elseif (isset($_GET["idVideo"]) && isset($_GET["nombreVideo"]) && isset($_GET["idCategoria"])) {
?>
    <main>
        <section class="video_items flex-video">

            <div class="left">
                <div class="left_content">
                    <?php
                    $tipo = "normal";
                    $item = null;
                    $valor = null;

                    $reproducirVideo = ControladorRegalo::ctrMostrarRegalo($tipo, $item, $valor);

                    foreach ($reproducirVideo as $key => $value) {
                        if ($_GET["idVideo"] == $value["id_r"]) {
                    ?>

                            <video id="video_play" autoplay controls poster="<?php echo substr($value["imagen_r"],3) ?>">
                                <source src="<?php echo substr($value["video_r"],3) ?>" type="video/mp4">
                            </video>

                            <!-- video tages -->
                            <div class="tag">
                                <p><b><?php echo $value["titulo_r"] ?></b></p>
                            </div>
                            <!-- video tages -->

                            <!-- total viwer  -->
                            <div class="mb-3 border_bottom">
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <div class="anuncio-main">
                        <?php
                        $item = null;
                        $valor = null;

                        $mostrarAnuncio = ControladorAnuncio::ctrMostrarAnuncio($item, $valor);
                        foreach ($mostrarAnuncio as $key => $value) {
                            if ($_GET["idCategoria"] == $value["id_c"]) {
                        ?>
                                <div class="anuncio-content">
                                    <div class="bm-3 imageAnuncio">
                                        <a href="<?php echo $value["link_a"] ?>" target="_blank"><img src="<?php echo $value["imagen_a"] ?>" alt=""></a>
                                    </div><br>

                                    <div class="mb-2 linkAnuncio text-center">
                                        <a class="btn btn-primary" href="<?php echo $value["link_a"] ?>" target="_blank">
                                            Ver más sobre el curso
                                        </a>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <!-- total viwer  -->

                </div>
            </div>

            <div class="right">
                <div class="right_content">
                    <?php
                    $item = null;
                    $valor = null;

                    $mostrarAnuncio = ControladorAnuncio::ctrMostrarAnuncio($item, $valor);
                    foreach ($mostrarAnuncio as $key => $value) {
                        if ($_GET["idVideo"] == $value["id_r"]) {
                            if($value["imagen_a_b"] !=""){
                            ?>
                               <div class="tags">
                                    <div class="tags-content">
                                        <a class="text-white" href="<?php echo $value["link_a"] ?>" target="_blank"><img src="<?php echo $value["imagen_a_b"] ?>" alt=""></a>
                                        <a class="text-white anuncio-title" href="<?php echo $value["link_a"] ?>" target="_blank"><?php echo $value["titulo_a"] ?></a>
                                    </div>
                                </div>     
                            <?php
                            }
                        }
                    }
                    ?>

                    <?php
                    $tipo = "random";
                    $item = null;
                    $valor = null;

                    $reproducirVideoRing = ControladorRegalo::ctrMostrarRegalo($tipo, $item, $valor);

                    foreach ($reproducirVideoRing as $key => $value) {
                        if ($_GET["idCategoria"] == $value["id_c"]) {
                    ?>
                            <div class="video_items vide_sidebar flex">
                                <a href="index.php?idVideo=<?php echo $value['id_r'] ?>&nombreVideo=<?php echo $value["titulo_r"] ?>&idCategoria=<?php echo $value["id_c"] ?>">
                                    <video poster="<?php echo substr($value["imagen_r"],3) ?>">
                                        <source src="<?php echo substr($value["video_r"],3) ?>" type="video/mp4">
                                    </video>
                                </a>
                                <div class="detalle mb-2">
                                    <div class="detalle-main">
                                        <a class="text-white" href="index.php?idVideo=<?php echo $value['id_r'] ?>&nombreVideo=<?php echo $value["titulo_r"] ?>&idCategoria=<?php echo $value["id_c"] ?>"><?php echo $value["titulo_r"] ?></a>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

        </section>

    </main>

<?php
} else {
?>
    <main class="main-grid">
        <section class="video_content grid">
            <?php

            /* Función mostrar cantidad de palabras */
            function cortarFraseTitulo($frase, $maxPalabras = 15, $noTerminales = ["de"])
            {
                $palabras = explode(" ", $frase);
                $numPalabras = count($palabras);
                if ($numPalabras > $maxPalabras) {
                    $offset = $maxPalabras - 1;
                    while (in_array($palabras[$offset], $noTerminales) && $offset < $numPalabras) {
                        $offset++;
                    }
                    return implode(" ", array_slice($palabras, 0, $offset + 1));
                }
                return $frase;
            }

            $tipo = "random";
            $item = null;
            $valor = null;

            $mostrarVideos = ControladorRegalo::ctrMostrarRegalo($tipo, $item, $valor);

            foreach ($mostrarVideos as $key => $value) {
            ?>
                <div class="video_items">
                    <a class="click_video" href="index.php?idVideo=<?php echo $value['id_r'] ?>&nombreVideo=<?php echo $value["titulo_r"] ?>&idCategoria=<?php echo $value["id_c"] ?>">
                        <video poster="<?php echo substr($value["imagen_r"],3) ?>">
                            <source src="<?php echo substr($value["video_r"],3) ?>" type="video/mp4">
                        </video>
                    </a>
                    <div class="details flex">
                        <div class="heading">
                            <p class="click_video"><a class="text-white" href="index.php?idVideo=<?php echo $value['id_r'] ?>&nombreVideo=<?php echo $value["titulo_r"] ?>&idCategoria=<?php echo $value["id_c"] ?>"><?php echo cortarFraseTitulo($value["titulo_r"]) ?></a></p>
                            <a href=""><span><?php echo $value["nombre_c"] ?> <i class="fa fa-circle-check"></i> </span></a>
                            
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </section>
    </main>
<?php
}
?>