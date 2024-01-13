<!--**********************************
        Scripts
    ***********************************-->
<!-- Required vendors -->
<script src="vistas/estilosB/vendor/global/global.min.js"></script>
<script src="vistas/estilosB/vendor/chart.js/Chart.bundle.min.js"></script>
<script src="vistas/estilosB/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

<!-- Apex Chart -->
<script src="vistas/estilosB/vendor/apexchart/apexchart.js"></script>

<script src="vistas/estilosB/vendor/chart.js/Chart.bundle.min.js"></script>

<!-- Datatable -->
<script src="vistas/estilosB/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="vistas/estilosB/js/plugins-init/datatables.init.js"></script>



<!-- Chart piety plugin files -->
<script src="vistas/estilosB/vendor/peity/jquery.peity.min.js"></script>

<!-- <script src="vistas/estilosB/js/plugins-init/chartjs-init.js"></script> -->




<!-- Dashboard 1 -->
<script src="vistas/estilosB/js/dashboard/dashboard-1.js"></script>

<script src="vistas/estilosB/vendor/owl-carousel/owl.carousel.js"></script>

<script src="vistas/estilosB/js/custom.min.js"></script>
<script src="vistas/estilosB/js/dlabnav-init.js"></script>
<script src="vistas/estilosB/js/demo.js"></script>
<script src="vistas/estilosB/js/styleSwitcher.js"></script>
<script>
	function cardsCenter() {

		/*  testimonial one function by = owl.carousel.js */



		jQuery('.card-slider').owlCarousel({
			loop: true,
			margin: 0,
			nav: true,
			//center:true,
			slideSpeed: 3000,
			paginationSpeed: 3000,
			dots: true,
			navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
			responsive: {
				0: {
					items: 1
				},
				576: {
					items: 1
				},
				800: {
					items: 1
				},
				991: {
					items: 1
				},
				1200: {
					items: 1
				},
				1600: {
					items: 1
				}
			}
		})
	}

	jQuery(window).on('load', function() {
		setTimeout(function() {
			cardsCenter();
		}, 1000);
	});
</script>

<!-- Funcionalidades con ajax -->
<script src="vistas/js/admin/sccript_usuario.js"></script>
<script src="vistas/js/admin/categorias.js"></script>
<script src="vistas/js/admin/categoriap.js"></script>
<script src="vistas/js/admin/embudo.js"></script>
<script src="vistas/js/admin/main-video.js"></script>
<script src="vistas/js/admin/anuncio.js"></script>

<script src="vistas/estilosB/summernote/summernote-lite.js"></script>

<!-- Configurado sumernNOte -->
<script>
	$(document).ready(function() {
		$('#summernoteNuevoR').summernote({
			height: 200,
		});

		$('#summernoteEditarR').summernote({
			height: 200,
		});

		$('#nuevoDescripcionA').summernote({
			height: 200,
		});
		$('#summernoteEditarA').summernote({
			height: 200,
		});

		$('span.note-icon-caret').remove();

		$('.note-editable').css('background', '#fff');
	});
</script>

<?php
	error_reporting(0);

	if (isset($_GET["fechaInicial"])) {
		$fechaInicial = $_GET["fechaInicial"];
		$fechaFinal = $_GET["fechaFinal"];
	} else {
		$fechaInicial = null;
		$fechaFinal = null;
	}

	$respuesta = ControladorVisitas::ctrRangoFechasVisitas($fechaInicial, $fechaFinal);

	$arrayFechas = array();
	$arrayVisitas = array();
	$sumaVisitas = array();

	foreach ($respuesta as $key => $value) {
		#Capturamos solo el año y el mes
		$fecha = substr($value["fecha_visitas"], 0, 7);

		#Introducir las fechas en arrayFechas
		array_push($arrayFechas, $fecha);

		#capturamos las visitas
		$arrayVisitas = array($fecha => $value["total_visitas"]);

		#Sumamos las vistas que ocurrieron el mismo mes

		foreach ($arrayVisitas as $key => $value) {
			$sumaVisitas[$key] += $value;
		}
	}
	$noRepetirFechas = array_unique($arrayFechas);
	sort($noRepetirFechas);
?>

<!-- Gráfico de barras de vista -->
<script>
	(function($) {
		"use strict"

		var dlabSparkLine = function() {
			let draw = Chart.controllers.line.__super__.draw;

			var screenWidth = $(window).width();

			var barChart1 = function() {

				if (jQuery('#barChart_1').length > 0) {
					const barChart_1 = document.getElementById("barChart_1").getContext('2d');

					barChart_1.height = 100;

					new Chart(barChart_1, {
						type: 'bar',
						data: {
							defaultFontFamily: 'Poppins',
							labels: [
								<?php
									foreach($noRepetirFechas as $key){
										echo '"'.$key.'"'.',';
									}
								?>
							],
							datasets: [{
								label: "Total de visitas",
								data: [
									<?php
										foreach($noRepetirFechas as $key){
										echo $sumaVisitas[$key].',';
										}
									?>
								],
								borderColor: 'rgba(136,108,192, 1)',
								borderWidth: "0",
								backgroundColor: 'rgba(136,108,192, 1)'
							}]
						},
						options: {
							legend: false,
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero: true
									}
								}],
								xAxes: [{
									// Change here
									barPercentage: 0.5
								}]
							}
						}
					});
				}
			}

			/* Function de retorno ============ */
			return {
				init: function() {},


				load: function() {
					barChart1();
				},

				resize: function() {}
			}

		}();

		jQuery(document).ready(function() {});

		jQuery(window).on('load', function() {
			dlabSparkLine.load();
		});

		jQuery(window).on('resize', function() {
			//dlabSparkLine.resize();
			setTimeout(function() {
				dlabSparkLine.resize();
			}, 1000);
		});

	})(jQuery);
</script>




</body>

</html>