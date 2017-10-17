<div class="card">
	<div class="card-header" data-background-color="green">
		<h4 class="title">Rentabilidad</h4>
	</div>
	<div class="card-content table-responsive">
		<div class="col-lg-12 text-center" id="div-fecha">
            <div class="col-lg-4 col-lg-offset-2" style="border-right: 3px double #9c27b0;">
				<span class="btn btn-primary btn-round">Desde</span>
				<div id="inputFechaDesde"></div>
				<input type="text" class="form-control" id="fecha_show_desde" name="inputFechaShowDesde" readonly>
            </div>

            <div class="col-lg-4">
				<span class="btn btn-primary btn-round">Hasta</span>
				<div id="inputFechaHasta"></div>
				<input type="text" class="form-control" id="fecha_show_hasta" name="inputFechaShowHasta" readonly>
            </div>
            <div class="col-lg-12">
				<center><button type="button" class="btn btn-primary" id="btn-search">Buscar</button></center>
            </div>
		</div>
		<div class="col-lg-12" id="div-data" style="display: none">
			<table class="table">
				<thead class="text-success">
					<th class="text-center">Fecha</th>
					<th class="text-center">Habitación</th>
					<th class="text-center">Ventas</th>
				</thead>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#inputFechaDesde').datetimepicker({
			inline: true,
			sideBySide: true,
			viewMode: 'months',
			format: 'DD/MM/YYYY',
		});

		$('#inputFechaHasta').datetimepicker({
			inline: true,
			sideBySide: true,
			viewMode: 'months',
			format: 'DD/MM/YYYY',
		});
		$('#inputFechaDesde').on('dp.change', function(e) {
			$('#inputFechaHasta').data("DateTimePicker").minDate(e.date);
			var formatedValue = e.date.format('YYYY-MM-DD');
			$('#fecha_show_desde').val(formatedValue);
		})
		$('#inputFechaHasta').on('dp.change', function(e) {
			$('#inputFechaDesde').data("DateTimePicker").maxDate(e.date);
			var formatedValue = e.date.format('YYYY-MM-DD');
			$('#fecha_show_hasta').val(formatedValue);
		})

	    $(document).on('click', '#btn-search', function(){
	        if ($('#fecha_show_desde').val().length == 0 || $('#fecha_show_hasta').val().length == 0){
				swal({
					title: '¡Advertencia!',
					text: 'Seleccione una Rengo de Fechas',
					type: 'error'});
	        } else {
	        	$('#div-fecha').css('display', 'none');
	        	$('#div-data').css('display', 'block');

				$('.table').DataTable({
					ajax: {
						url: '<?= base_url('rest/costHab') ?>',
						data: {inicio: $('#fecha_show_desde').val(), fin: $('#fecha_show_hasta').val() },
						type: 'POST'
					},
					language: {
						url: '<?= base_url('assets/plugins/datatables/spanish.json') ?>',
					},
					columns: [
						{ data: 'day', 'class': 'text-center' },
						{ data: 'name' },
						{ data: 'total', class: 'text-right', render: $.fn.dataTable.render.number('.', ',', 2, '$') },
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
			                        	'<h6 style="font-size:20; font-weight: bold; margin-top: -5px">Rentabilidad</h6>'
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