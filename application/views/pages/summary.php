<div class="col-md-8">
	<div class="card">
		<div class="card-header" data-background-color="green">
			<h4 class="title">Información de la Reserva</h4>
		</div>
		<div class="card-content text-center">
			<ul class="nav nav-pills" style="display: inline-block;">
				<li class="active"><a href="#reservation_info" data-toggle="tab">Sumario</a></li>
				<li><a href="#fotos" data-toggle="tab">Fotos</a></li>
				<li><a href="#description" data-toggle="tab">Descripción</a></li>
				<li><a href="#terms" data-toggle="tab">Términos y Condiciones</a></li>
			</ul>
			<div class="tab-content clearfix" style="margin-top: 20px;">
				<div class="tab-pane active" id="reservation_info">
					<div class="row">
						<div class="col-lg-3"><p class="pull-left">Fecha de Entrada:</p></div>
						<div class="col-lg-3"><strong class="pull-right"><?= date('d/m/Y', strtotime($fecha_ingreso)) ?></strong></div>
						<div class="col-lg-3"><p class="pull-left">Fecha de Salida:</p></div>
						<div class="col-lg-3"><strong class="pull-right"><?= date('d/m/Y', strtotime($fecha_salida)) ?></strong></div>
					</div>
					<div class="row">
						<div class="col-lg-3"><p class="pull-left">Personas Hab.:</p></div>
						<div class="col-lg-3"><strong class="pull-right"><?= $ocupantes ?></strong></div>
						<div class="col-lg-3"><p class="pull-left">No. Noches:</p></div>
						<div class="col-lg-3"><strong class="pull-right"><?= $noches ?></strong></div>
					</div>
					<div class="row">
						<div class="col-lg-6"><p class="pull-left">Tipo de Habitación:</p></div>
						<div class="col-lg-6"><strong class="pull-right"><?= $nombre_habitacion ?></strong></div>
					</div>
					<div class="row">
						<div class="col-lg-6"><p class="pull-left">Tarifa Media por Noche:</p></div>
						<div class="col-lg-6"><strong class="pull-right">$<?= number_format($precio_total/$noches,"2",",",".") ?></strong></div>
					</div>
					<div class="row alert alert-info">
						<div class="col-lg-6"><p class="pull-left">Importe a Pagar Ahora:</p></div>
						<div class="col-lg-6"><strong class="pull-right">$<?= number_format($precio_total,"2",",",".") ?></strong></div>
					</div>
				</div>
				<div class="tab-pane" id="fotos">
					<div class="colls-12 pull-left contenedor-imagen">
						<div class="img">
						<?php
						for ($i=1; $i < 7 ; $i++) { 
							if (file_exists(getcwd().'/assets/uploads/rooms/'.$codigo.'_'.$i.'.jpg')){
								echo '<div class="col-lg-4"><img class="img-summary" src="'.base_url('assets/uploads/rooms/'.$codigo.'_'.$i.'.jpg').'"></div>';
							}
						}
						?>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="description">
					<div class="colls-12 pull-left"><?= $description ?></div>
				</div>
				<div class="tab-pane" id="terms">
					<div class="colls-12 pull-left"><?= $terms ?></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-4">
	<div class="card">
		<div class="card-header" data-background-color="green">
			<h4 class="title">Información del Cliente</h4>
		</div>
		<div class="card-content">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group label-floating">
						<label class="control-label">Nombre</label>
						<input type="text" id="nombre_cliente" class="form-control">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group label-floating">
						<label class="control-label">Apellido</label>
						<input type="text" id="apellido_cliente" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group label-floating">
						<label class="control-label">Correo electronico</label>
						<input type="email" id="correo_cliente" class="form-control">
					</div>
				</div>
			</div>
			<div class="center-block">
				<center><br>
					<button class="btn btn-primary create_reservation">Pagar con Transferencia</button>
					<a class="paypal-button"></a>
				</center>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<div class="modal fade" id="viewModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ver Imagen</h4>
			</div>
			<div class="modal-body">
				<center><img id="preview_picture" src="" style="max-width: 550px"></center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$(document).on('click', '.img-summary', function(){
			$('#preview_picture').attr('src', $(this).attr('src'));
			$('#viewModal').modal('show');
		});

		$('body').on('click', '.create_reservation', function(e) {
			if ($('#nombre_cliente').val().length == 0 || $('#apellido_cliente').val().length == 0 || $('#correo_cliente').val().length == 0) {
				swal({
					title: '¡Advertencia!',
					text: 'Debe Ingresar:\nNombre\nApellido\nCorreo Electrónico',
					type: 'error'});
			} else if (ValidaEmail($('#correo_cliente').val()) == false){
				swal({
					title: '¡Advertencia!',
					text: 'Debe Ingresar un Correo Electrónico Válido',
					type: 'error'});
			} else {
				$.ajax({
					type: 'POST',
					url: '<?=base_url('rest/createReservation');?>',
					data: {
						'fecha_ingreso': '<?=$fecha_ingreso?>',
						'fecha_salida': '<?=$fecha_salida?>',
						'personas': '<?=$ocupantes?>',
						'room_id': '<?=$room_id?>',
						'precio_total': '<?=$precio_total?>',
						'nombre_cliente': $('#nombre_cliente').val(),
						'apellido_cliente': $('#apellido_cliente').val(),
						'correo_cliente': $('#correo_cliente').val(),
						'tarifas': '<?=json_encode($tarifas)?>',
						'tipo': 'TRANSFERENCIA',
						'nombre_habitacion' : '<?=$nombre_habitacion?>',
					},
					success: function (msj) {
						if(msj.status == false) {
							swal({
								title: '¡Error!',
								text: msj.message,
								type: 'error'});
						} else {
							swal({
								title: '¡Hecho!',
								text: msj.message + '\nHemos enviado a tu correo ' + msj.correo + ' los datos para realizar la transferencia.',
								type: 'success'},function(){
									window.location = base_url+ 'home/reservation';
							});
						}
					},
					error: function(msj) {
						console.log(msj);
					}
				});
			}
		});
	});

	paypal.Button.render({
		env: 'sandbox', // Or 'sandbox' , 'production',
        style: {
            label: 'pay',
            size:  'responsive', // small | medium | large | responsive
            shape: 'rect',   // pill | rect
            color: 'gold'   // gold | blue | silver | black
        },
		client: {
			sandbox:    'AXwAZKQpM29AX7lApZm4wYZxYIq0jJdRLTfENdF9aHpl0DSA8uOPgOquTOesWu3xrpibDwW2m-ENKRxc',
			production: 'AXwAZKQpM29AX7lApZm4wYZxYIq0jJdRLTfENdF9aHpl0DSA8uOPgOquTOesWu3xrpibDwW2m-ENKRxc'
		},
		commit: true,
		payment: function(data, actions) {
			return actions.payment.create({
				payment: {
					transactions: [
						{
							amount: { total: '<?=$precio_total?>', currency: 'USD' }
						}
					]
				}
			});
		},
		onAuthorize: function(data, actions) {
			return actions.payment.execute().then(function(payment) {
				console.log(payment);
				$.ajax({
					type: 'POST',
					url: '<?=base_url('rest/createReservationPaypal');?>',
					data: {
						'fecha_ingreso': '<?=$fecha_ingreso?>',
						'fecha_salida': '<?=$fecha_salida?>',
						'personas': '<?=$ocupantes?>',
						'room_id': '<?=$room_id?>',
						'precio_total': '<?=$precio_total?>',
						'nombre_cliente': $('#nombre_cliente').val(),
						'apellido_cliente': $('#apellido_cliente').val(),
						'correo_cliente': $('#correo_cliente').val(),
						'nombre_paypal': payment.payer.payer_info.first_name,
						'apellido_paypal': payment.payer.payer_info.last_name,
						'correo_paypal': payment.payer.payer_info.email,
						'tarifas': '<?=json_encode($tarifas)?>',
						'tipo': 'PAYPAL',
						'id_paypal': payment.id,
						'nombre_habitacion' : '<?=$nombre_habitacion?>',
					},
					success: function (msj) {
						if(msj.status == false) {
							swal({
								title: '¡Error!',
								text: msj.message,
								type: 'error'});
						} else {
							swal({
								title: '¡Hecho!',
								text: msj.message,
								type: 'success'},function(){
									window.location = base_url+ 'home/reservation';
							});
						}
					},
					error: function(msj) {
						console.log(msj);
					}
				});
			});
		}
	}, '.paypal-button');

	function ValidaEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
	}
</script>
