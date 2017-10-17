<!DOCTYPE html>
<html>
    <head>
		<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/img/apple-icon.png') ?>" />
		<link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.ico') ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Admin Misahualli Amazon Lodge</title>
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
		<!--  Bootstrap core CSS  -->
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" />
		<!--  Material Dashboard CSS  -->
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/material-dashboard.css?v=1.2.0') ?>" rel="stylesheet" />
		<!--  Fonts and icons  -->
		<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
		<!-- DataTables -->
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/datatables/datatables-bootstrap/css/dataTables.bootstrap.min.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/datatables/responsive/css/responsive.bootstrap.min.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/datatables/buttons.bootstrap.min.css') ?>" />
		<!-- DateTimePicker -->
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/datetimepicker/css/bootstrap-datetimepicker.css') ?>" />
		<!-- Bootstrap Select -->
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/bootstrap-select/bootstrap-select.css') ?>" />
		<!-- SweetAlert -->
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/sweetalert/sweetalert.css') ?>" />
		<!-- DropzoneJS -->
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/dropzone/dropzone.css') ?>" />
		<!--  CSS for Demo Purpose, don't include it in your project  -->
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/demo.css') ?>" rel="stylesheet" />

		<script type="text/javascript" src="<?= base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
    </head>

    <body>
	<div class="wrapper">
		<div class="sidebar" data-color="green" data-image="<?= base_url('assets/img/sidebar-1.jpg') ?>">
			<div class="logo">
				<a href="<?= base_url() ?>" class="simple-text">
					<img width="200" height="80" src="<?= base_url('assets/img/logo.png') ?>">
				</a>
			</div>
			<div class="sidebar-wrapper">
				<ul class="nav">
					<li>
						<a href="<?= base_url() ?>" class="" aria-expanded="true">
							<i class="material-icons">home</i>
							<p>Inicio</p>
						</a>
					</li>
					<li>
						<a data-toggle="collapse" href="#habitacionesNav" class="" aria-expanded="false">
							<i class="material-icons">dashboard</i>
							<p>Gestión de habitaciones</p>
						</a>
						<div class="collapse" id="habitacionesNav" aria-expanded="false" style="">
							<ul class="nav">
								<li>
									<a href="<?= base_url('home/room_type') ?>">
										<span class="sidebar-normal">Tipos de Habitaciones</span>
									</a>
								</li>
								<li>
									<a href="<?= base_url('home/room_price') ?>">
										<span class="sidebar-normal">Tarifa por Fecha</span>
									</a>
								</li>
								<li>
									<a href="<?= base_url('home/booked') ?>">
										<span class="sidebar-normal">Habitaciones Reservadas</span>
									</a>
								</li>
								<li>
									<a href="<?= base_url('home/available') ?>">
										<span class="sidebar-normal">Habitaciones Disponibles</span>
									</a>
								</li>
								<li>
									<a href="<?= base_url('home/reservation') ?>">
										<span class="sidebar-normal">Reservación</span>
									</a>
								</li>
							</ul>
						</div>
					</li>
					<li>
						<a data-toggle="collapse" href="#reportesNav" class="" aria-expanded="false">
							<i class="material-icons">content_paste</i>
							<p>Reportes</p>
						</a>
						<div class="collapse" id="reportesNav" aria-expanded="false" style="">
							<ul class="nav">
								<li>
									<a href="<?= base_url('home/cost') ?>">
										<span class="sidebar-normal">Rentabilidad</span>
									</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</div>

		<div class="main-panel">
			<!-- <nav class="navbar navbar-transparent navbar-absolute">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"></a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
									<i class="material-icons">person</i>
									<p class="hidden-lg hidden-md">Profile</p>
								</a>
							</li>
						</ul>
						<form class="navbar-form navbar-right" role="search">
							<div class="form-group  is-empty">
								<input type="text" class="form-control" placeholder="Search">
								<span class="material-input"></span>
							</div>
							<button type="submit" class="btn btn-white btn-round btn-just-icon">
								<i class="material-icons">search</i>
								<div class="ripple-container"></div>
							</button>
						</form>
					</div>
				</div>
			</nav> -->

			<div class="content" style="margin-top: 0px;">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
						<?= $content ?>
						</div>
					</div>
				</div>
			</div>

			<footer class="footer">
				<div class="container-fluid">
					<p class="copyright pull-right">
						&copy;
						<script>
							document.write(new Date().getFullYear())
						</script>
					</p>
				</div>
			</footer>
		</div>
	</div>

	<div class="modal-loading"></div>
    </body>

	<!--   Core JS Files   -->
	<script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/material.min.js') ?>" type="text/javascript"></script>
	<!-- Moment JS -->
	<script type="text/javascript" src="<?= base_url('assets/js/moment.js') ?>" type="text/javascript"></script>
	<!--  Charts Plugin -->
	<script type="text/javascript" src="<?= base_url('assets/js/chartist.min.js') ?>"></script>
	<!--  Dynamic Elements plugin -->
	<script type="text/javascript" src="<?= base_url('assets/js/arrive.min.js') ?>"></script>
	<!--  PerfectScrollbar Library -->
	<script type="text/javascript" src="<?= base_url('assets/js/perfect-scrollbar.jquery.min.js') ?>"></script>
	<!--  Notifications Plugin    -->
	<script type="text/javascript" src="<?= base_url('assets/js/bootstrap-notify.js') ?>"></script>
	<!-- Material Dashboard javascript methods -->
	<script type="text/javascript" src="<?= base_url('assets/js/material-dashboard.js?v=1.2.0') ?>"></script>
	<!-- Material Dashboard DEMO methods, don't include it in your project! -->
	<script type="text/javascript" src="<?= base_url('assets/js/demo.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/functions.js') ?>"></script>
	<!-- DataTables -->
	<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/datatables-bootstrap/js/jquery.dataTables.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/datatables-bootstrap/js/dataTables.bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/responsive/js/dataTables.responsive.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/responsive/js/responsive.bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/dataTables.buttons.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/buttons.bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/buttons.print.min.js') ?>"></script>

	<!-- CK Editor -->
	<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>
	<!-- DateTimePicker -->
	<script type="text/javascript" src="<?= base_url('assets/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>"></script>
	<!-- Bootstrap Select -->
	<script type="text/javascript" src="<?= base_url('assets/plugins/bootstrap-select/bootstrap-select.min.js') ?>"></script>
	<!-- SweetAlert -->
	<script type="text/javascript" src="<?= base_url('assets/plugins/sweetalert/sweetalert.min.js') ?>"></script>
	<!-- DropzoneJS -->
	<script type="text/javascript" src="<?= base_url('assets/plugins/dropzone/dropzone.js') ?>"></script>
	<!-- PayPal -->
	<script type="text/javascript" src="https://www.paypalobjects.com/api/checkout.js"></script>

	<script type="text/javascript">
		var base_url = "<?= base_url() ?>";
		var $body = $("body");

		$(document).on({
		    ajaxStart: function() { $body.addClass("loading");    },
		     ajaxStop: function() { $body.removeClass("loading"); }    
		});
	</script>
</html>