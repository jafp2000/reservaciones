<div class="card">
	<div class="card-header" data-background-color="green">
		<h4 class="title">Reservaciones</h4>
	</div>
	<div class="card-content">
		<div class="row">
			<div class="col-md-6 text-center" style="border-right: 3px double #9c27b0;">
				<span class="btn btn-primary btn-round">Fecha de ingreso</span>
				<div id="fecha_ingreso"></div>
			</div>
			<div class="col-md-6 text-center">
				<span class="btn btn-primary btn-round">Fecha de salida</span>
				<div id="fecha_salida"></div>
			</div>
		</div>
		<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label">Ingreso</label>
						<input type="text" class="form-control" id="fecha_ingreso_input" disabled>
					</div>
				</div>
				<div class="col-md-2"><div class="form-group">
						<label class="control-label">Salida</label>
						<input type="text" class="form-control" id="fecha_salida_input" disabled>
					</div></div>
				<div class="col-md-5">
					<center>
					<br>
					<select class="selectpicker" id="personas" data-style="btn btn-primary btn-round" title="Personas" data-size="5" required>
						<?php
							for ($i = 1; $i < ($maximo + 1) ; $i++) { 
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
						?>
					</select>
					</center>
				</div>
				<div class="col-md-3">
					<br><button class="btn btn-primary btn-round search_rooms pull-right">Buscar</button>
				</div>
			</div>
		<div style="display: none;" class="btn btn-primary btn-round available_rooms">Habitaciones disponibles</div>
		<div class="row rooms">
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#fecha_ingreso').datetimepicker({
			inline: true,
			sideBySide: true,
			format: 'DD/MM/YYYY',
			minDate: new Date(),
		});
		$('#fecha_salida').datetimepicker({
			inline: true,
			sideBySide: true,
			format: 'DD/MM/YYYY',
			minDate: new Date(),
		});
		$('#fecha_ingreso').on('dp.change', function(e) {
			$('#fecha_salida').data("DateTimePicker").minDate(e.date);
			var formatedValue = e.date.format('DD-MM-YYYY');
			$('#fecha_ingreso_input').val(formatedValue);
		})
		$('#fecha_salida').on('dp.change', function(e) {
			$('#fecha_ingreso').data("DateTimePicker").maxDate(e.date);
			var formatedValue = e.date.format('DD-MM-YYYY');
			$('#fecha_salida_input').val(formatedValue);
		})
		$('body').on('click', '.search_rooms', function() {
			$('.available_rooms').hide();
			$('.rooms').html('');

			if ($('#fecha_ingreso_input').val().length == 0 || $('#fecha_salida_input').val().length == 0 || $('#personas').val().length == 0) {
				swal({
					title: '¡Advertencia!',
					text: 'Debe Seleccionar:\nFecha de Ingreso\nFecha de Salida\nCantidad de Personas',
					type: 'error'});
			} else if ($('#fecha_ingreso_input').val() == $('#fecha_salida_input').val()) {
				swal({
					title: '¡Advertencia!',
					text: 'La Fecha de Salida debe ser Mayor a la Fecha de Ingreso',
					type: 'error'});
			} else {
				var fecha_ingreso = moment($('#fecha_ingreso_input').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
				var fecha_salida = moment($('#fecha_salida_input').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
				$.ajax({
					type: 'POST',
					url: '<?=base_url('rest/searchAvailability');?>',
					data: {
						'fecha_ingreso_input': fecha_ingreso,
						'fecha_salida_input': fecha_salida,
						'personas': $('#personas').val()
					},
					success: function (msj) {
						if(msj.status == false) {
							swal({
								title: '¡Error!',
								text: msj.message,
								type: 'error'});
						} else {
							$('.available_rooms').show();
							$('.rooms').html(msj);
						}
					},
					error: function(msj) {
						console.log(msj);
					}
				});
			}
		});
		$('body').on('click', '.reserve_room', function(e) {
			var fecha_ingreso = moment($('#fecha_ingreso_input').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
			var fecha_salida = moment($('#fecha_salida_input').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
			var room_id = e.currentTarget.id;
			$.ajax({
				type: 'POST',
				url: '<?=base_url('rest/makeReservation');?>',
				data: {
					'fecha_ingreso_input': fecha_ingreso,
					'fecha_salida_input': fecha_salida,
					'personas': $('#personas').val(),
					'room_id': room_id
				},
				success: function (msj) {
					$('.content').html(msj);
					$('.content').scrollTop(0);
				},
				error: function(msj) {
					console.log(msj);
				}
			});
		});
	});
</script>