<section class="nav" id="navbar">
    <nav class="nav_container">
        <div>
            <a href="#" class="nav_link nav_logo ">
                <i class="fa-solid fa-bars nav_icon"></i>
                <span class="logo_name">

                    Apuuray
                </span>
            </a>

            <div class="nav_list">
                <div class="nav_items navtop">
                    <a href="index.php" class="nav_link active">
                        <i class="fa fa-home nav_icon"></i>
                        <span class="nav_name">Inicio</span>
                    </a>


                    <?php
                    $item = null;
                    $valor = null;
                    $mostrarCategoriaP = ControladorCategoriaP::ctrMostrarCategoriaP($item, $valor);
                    foreach ($mostrarCategoriaP as $key => $valueP) {
                    ?>
                        <a href="" class="nav_link navtop dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-check-circle nav_icon"></i>
                            <span class="nav_name"><?php echo $valueP["nombre_cp"] ?></span>
                        </a>
                        <ul class="nav_link dropdown-menu">
                        <?php
                        $item = null;
                        $valor = null;
                        $mostrarSubCategoria = ControladorCategoria::ctrMostrarCategoria($item, $valor);
                        foreach ($mostrarSubCategoria as $key => $valueS) {
                            if($valueP["id_cp"] == $valueS["id_cp"]){
                        ?>
                            <li>
                                <a href="index.php?idCategoria=<?php echo $valueS['id_c'] ?>&nombreCategoria=<?php echo $valueS["nombre_c"] ?>" class="dropdown-item ">
                                    <i style="font-size: 13px;" class="fa fa-check nav_icon"></i>
                                    <span class="nav_name"><?php echo $valueS["nombre_c"] ?></span>
                                </a>
                            </li>
                        <?php
                            }
                        }
                        ?>
                        </ul>
                    <?php
                    }
                    ?>

                </div>

            </div>
        </div>
    </nav>
</section>