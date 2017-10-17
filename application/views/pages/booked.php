<div class="card">
	<div class="card-header" data-background-color="green">
		<h4 class="title">Habitaciones Reservadas</h4>
	</div>
	<div class="card-content table-responsive">
		<div class="col-lg-12 text-center" id="div-fecha">
            <div class="col-lg-4 col-lg-offset-4">
				<span class="btn btn-primary btn-round">Fecha</span>
				<div id="inputFecha"></div>
				<input type="text" class="form-control" id="fecha_show" name="inputFechaShow" readonly>
				<button type="button" class="btn btn-primary" id="btn-search">Buscar</button>
            </div>
		</div>
		<div class="col-lg-12" id="div-data" style="display: none">
			<table class="table">
				<thead class="text-success">
					<th class="text-center">Fecha</th>
					<th class="text-center">Habitación</th>
					<th class="text-center">Nombre</th>
					<th class="text-center">Apellido</th>
					<th class="text-center">Fecha Entrada</th>
					<th class="text-center">Fecha Salida</th>
					<th class="text-center">No. Ocupantes</th>
				</thead>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#inputFecha').datetimepicker({
			inline: true,
			sideBySide: true,
			format: 'DD/MM/YYYY',
		});

		$('#inputFecha').on('dp.change', function(e) {
			var formatedValue = e.date.format('YYYY-MM-DD');
			$('#fecha_show').val(formatedValue);
		})

	    $(document).on('click', '#btn-search', function(){
	        if ($('#fecha_show').val().length == 0){
				swal({
					title: '¡Advertencia!',
					text: 'Seleccione una Fecha',
					type: 'error'});
	        } else {
	        	$('#div-fecha').css('display', 'none');
	        	$('#div-data').css('display', 'block');

				$('.table').DataTable({
					ajax: {
						url: '<?= base_url('rest/bookedHab') ?>',
						data: {fecha: $('#fecha_show').val() },
						type: 'POST'
					},
					language: {
						url: '<?= base_url('assets/plugins/datatables/spanish.json') ?>',
					},
					columns: [
						{ data: 'day', 'class': 'text-center' },
						{ data: 'name' },
						{ data: 'first_name' },
						{ data: 'last_name' },
						{ data: 'checkin', 'class': 'text-center' },
						{ data: 'checkout', 'class': 'text-center' },
						{ data: 'occupancy', 'class': 'text-center' },
					],
			        dom: 'Bfrtip',
			        buttons: [
			            {
			                extend: 'print',
			                customize: function ( win ) {
			                    $(win.document.body)
			                        .css( 'font-size', '10pt' )
			                        .prepend(
			                            '<img width="150" height="60" src="<?= base_url('assets/img/logo.png') ?>">'
			                        );

			                    $(win.document.body).find( 'h1' )
			                        .css( 'font-size', '24' )
			                        .css( 'text-align', 'center' )
			                        .css( 'margin-top', '-50px' )
			                        .text( 'Misahualli Amazon Lodge' )
			                        .append(
			                        	'<h6 style="font-size:20; font-weight: bold; margin-top: -5px">Habitaciones Reservadas</h6>'
			                        );

			                    $(win.document.body).find( 'table' )
			                        .addClass( 'compact' )
			                        .css( 'font-size', 'inherit' );
			                }


			            }
			        ]
				});
	        }
	    });


    });
</script>