<?php
/* *********************************
SUMA DE REGISTROS 
********************************* */
$tipo = "normal";
$item = null;
$valor = null;
$tipo = "normal";

$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
$totalUsuarios = count($usuarios);

$categorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);
$totalCategoria = count($categorias);

$videos = ControladorRegalo::ctrMostrarRegalo($tipo, $item, $valor);
$totalVideos = count($videos);

$anuncio = ControladorAnuncio::ctrMostrarAnuncio($item, $valor);
$totalAnuncio = count($anuncio);

$ip = null;
$totalVisitas = ControladorVisitas::ctrMostrarVisitas($ip, $tipo);

?>
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="row">

                            <div class="col-xl-12">
                                <div class="card tryal-gradient">
                                    <div class="card-body tryal row">
                                        <div class="col-xl-7 col-sm-6">
                                            <h2>Gestiona tu publicidad desde Hotmart con un solo toque</h2>
                                            <span>Elige el mejor producto y el mejor video </span>
                                            <a href="https://app-vlc.hotmart.com/login" target="_blank" rel="nofollow"  class="btn btn-rounded  fs-18 font-w500">Visitar Hotmart</a>
                                        </div>
                                        <div class="col-xl-5 col-sm-6">
                                            <img src="vistas/estilosB/images/chart.png" alt="" class="sd-shape">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Gráfico de visitas</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="barChart_1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header border-0 pb-0">
                                        <h4 class="fs-20 font-w700 mb-0">Completion Project Rate</h4>
                                        <div class="dropdown ">
                                            <div class="btn-link" data-bs-toggle="dropdown">
                                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5"></circle>
                                                    <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5"></circle>
                                                    <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5"></circle>
                                                </svg>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pb-0">
                                        <div id="revenueMap" class="revenueMap"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="card">
                                            <div class="card-body d-flex px-4 pb-0 justify-content-between">
                                                <div>
                                                    <h4 class="fs-18 font-w600 mb-4 text-nowrap">Total Usuarios</h4>
                                                    <div class="d-flex align-items-center">
                                                        <h2 class="fs-32 font-w700 mb-0"><?php echo $totalUsuarios; ?></h2>
                                                        <span class="d-block ms-4">
                                                            <svg width="21" height="11" viewbox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M1.49217 11C0.590508 11 0.149368 9.9006 0.800944 9.27736L9.80878 0.66117C10.1954 0.29136 10.8046 0.291359 11.1912 0.661169L20.1991 9.27736C20.8506 9.9006 20.4095 11 19.5078 11H1.49217Z" fill="#09BD3C"></path>
                                                            </svg>
                                                            <small class="d-block fs-16 font-w400 text-success">+0,5%</small>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div id="columnChart"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="card">
                                            <div class="card-body px-4 pb-0">
                                                <h4 class="fs-18 font-w600 mb-5 text-nowrap">Total Categoría</h4>
                                                <div class="progress default-progress">
                                                    <div class="progress-bar bg-gradient1 progress-animated" style="width: <?php echo $totalCategoria?>%; height:10px;" role="progressbar">
                                                        <span class="sr-only">45% Complete</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end mt-2 pb-3 justify-content-between">
                                                    <span><?php $totalCategoria ?> Total de categorías</span>
                                                    <h4 class="mb-0"><?php echo $totalCategoria; ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="card">
                                            <div class="card-body d-flex px-4  justify-content-between">
                                                <div>
                                                    <div class="">
                                                        <h2 class="fs-32 font-w700"><?php echo $totalVideos;?></h2>
                                                        <span class="fs-18 font-w500 d-block">Total Videos</span>
                                                        <span class="d-block fs-16 font-w400"><small class="text-danger">2%</small> subidos</span>
                                                    </div>
                                                </div>
                                                <div id="NewCustomers"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="card">
                                            <div class="card-body d-flex px-4  justify-content-between">
                                                <div>
                                                    <div class="">
                                                        <h2 class="fs-32 font-w700"><?php echo $totalAnuncio; ?></h2>
                                                        <span class="fs-18 font-w500 d-block">Total de anuncios</span>
                                                        <span class="d-block fs-16 font-w400"><small class="text-success">2%</small> subidos</span>
                                                    </div>
                                                </div>
                                                <div id="NewCustomers1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-6 col-sm-6">
                                                <div class=" owl-carousel card-slider">
                                                    <div class="items">
                                                        <h4 class="fs-20 font-w700 mb-4">Fillow Company Profile Website Project</h4>
                                                        <span class="fs-14 font-w400">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque </span>
                                                    </div>
                                                    <div class="items">
                                                        <h4 class="fs-20 font-w700 mb-4">Fillow Company Profile Website Project</h4>
                                                        <span class="fs-14 font-w400">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque </span>
                                                    </div>
                                                    <div class="items">
                                                        <h4 class="fs-20 font-w700 mb-4">Fillow Company Profile Website Project</h4>
                                                        <span class="fs-14 font-w400">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 redial col-sm-6">
                                                <div id="redial"></div>
                                                <span class="text-center d-block fs-18 font-w600">On Progress <small class="text-success">70%</small></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xl-6 col-xxl-12 col-sm-6">
                                        <div class="card">
                                            <div class="card-header border-0">
                                                <div>
                                                    <h4 class="fs-20 font-w700">Email Categories</h4>
                                                    <span class="fs-14 font-w400 d-block">Lorem ipsum dolor sit amet</span>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div id="emailchart"> </div>
                                                <div class="mb-3 mt-4">
                                                    <h4 class="fs-18 font-w600">Legend</h4>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                                        <span class="fs-18 font-w500">
                                                            <svg class="me-3" width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="20" height="20" rx="6" fill="#886CC0"></rect>
                                                            </svg>
                                                            Primary (27%)
                                                        </span>
                                                        <span class="fs-18 font-w600">763</span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between  mb-4">
                                                        <span class="fs-18 font-w500">
                                                            <svg class="me-3" width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="20" height="20" rx="6" fill="#26E023"></rect>
                                                            </svg>
                                                            Promotion (11%)
                                                        </span>
                                                        <span class="fs-18 font-w600">321</span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between  mb-4">
                                                        <span class="fs-18 font-w500">
                                                            <svg class="me-3" width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="20" height="20" rx="6" fill="#61CFF1"></rect>
                                                            </svg>
                                                            Forum (22%)
                                                        </span>
                                                        <span class="fs-18 font-w600">69</span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between  mb-4">
                                                        <span class="fs-18 font-w500">
                                                            <svg class="me-3" width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="20" height="20" rx="6" fill="#FFDA7C"></rect>
                                                            </svg>
                                                            Socials (15%)
                                                        </span>
                                                        <span class="fs-18 font-w600">154</span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between  mb-4">
                                                        <span class="fs-18 font-w500">
                                                            <svg class="me-3" width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="20" height="20" rx="6" fill="#FF86B1"></rect>
                                                            </svg>
                                                            Spam (25%)
                                                        </span>
                                                        <span class="fs-18 font-w600">696</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="card-footer border-0 pt-0">
                                                <a href="javascript:void(0);" class="btn btn-outline-primary d-block btn-rounded">Update Progress</a>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->