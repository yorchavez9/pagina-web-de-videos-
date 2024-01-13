<!--**********************************
    Sidebar start
***********************************-->
<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">

            <li>
                <a href="admin-inicio" class="" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Inicio</span>
                </a>
            </li>
            <?php
            if ($_SESSION["perfil_usuario"] == "Administrador") {
            ?>
                <li>
                    <a href="admin-usuarios" class="" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        <span class="nav-text">Usuarios</span>
                    </a>
                </li>
            <?php
            }
            if($_SESSION["perfil_usuario"]=="Administrador" || $_SESSION["perfil_usuario"]="Ayudante"){
            ?>
            <li>
                <a href="admin-categoriap" class="" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                    <span class="nav-text">Categoria A</span>
                </a>
            </li>
            <li>
                <a href="admin-categoria" class="" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                    <span class="nav-text">Categorias B</span>
                </a>
            </li>
            <li>
                <a href="admin-regalo" class="" aria-expanded="false">
                    <i class="fas fa-video"></i>
                    <span class="nav-text">Video</span>
                </a>
            </li>

            <li>
                <a href="admin-anuncio" class="" aria-expanded="false">
                    <i class="fas fa-bullhorn"></i>
                    <span class="nav-text">Anuncio</span>
                </a>
            </li>
            <li>
                <a href="admin-inicio" class="" aria-expanded="false">
                    <i class="fas fa-eye"></i>
                    <span class="nav-text">Vistas</span>
                </a>
            </li>
            <?php
            }
            ?>
        </ul>
        <div class="side-bar-profile">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="side-bar-profile-img">
                    <img src="images/user.jpg" alt="">
                </div>
                <div class="profile-info1">
                    <h4 class="fs-18 font-w500">Soeng Souy</h4>
                    <span>example@mail.com</span>
                </div>
                <div class="profile-button">
                    <i class="fas fa-caret-down scale5 text-light"></i>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-2 progress-info">
                <span class="fs-12"><i class="fas fa-star text-orange me-2"></i>Task Progress</span>
                <span class="fs-12">20/45</span>
            </div>
            <div class="progress default-progress">
                <div class="progress-bar bg-gradientf progress-animated" style="width: 45%; height:10px;" role="progressbar">
                    <span class="sr-only">45% Complete</span>
                </div>
            </div>
        </div>

        <div class="copyright">
            <p><strong>Apuuray</strong> © <script>document.write(new Date().getFullYear())</script> Todos los derechos reservados</p>
            <p class="fs-12">Hecho por <span class="heart"></span>Jorge Chavez Huincho</p>
        </div>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->