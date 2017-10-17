<div class="card">
	<div class="card-header" data-background-color="green">
		<h4 class="title">Tarifa por Fecha <button class="btn btn-white btn-round btn-sm pull-right " data-toggle="modal" data-target="#addModal">Crear Nueva Tarifa</button></h4>
	</div>
	<div class="card-content table-responsive">
		<table class="table">
			<thead class="text-success">
				<th class="text-center"></th>
				<th class="text-center">Código</th>
				<th class="text-center">Nombre</th>
				<th class="text-center">Precio</th>
				<th class="text-center">Disponibilidad</th>
				<th class="text-center">Max. Ocupantes</th>
			</thead>
		</table>
	</div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Nueva Tarifa</h4>
			</div>
			<div class="modal-body">
				<?php
				$attrb = array('id' => 'formAddRate');
				$hidden = array('formType' => 'add');
				echo form_open('#', $attrb, $hidden);
				?>
					<div class="row">
						<div class="col-md-12 col-xs-12 form-group">
							<label for="inputPrecio" class="control-label">Tipo de Habitación:</label>
							<select class="form-control" id="inputType" name="inputType" required>
								<?php foreach ($rooms as $rm ): ?>
									<option value="<?= $rm->id ?>"><?= $rm->short_name ?> - <?= $rm->name ?></option>
								<?php endforeach ?>
							</select>
						</div>

						<div class="col-md-6 text-center">
							<span class="btn btn-primary btn-round">Desde</span>
							<div id="fecha_desde"></div>
						</div>
						<div class="col-md-6 text-center">
							<span class="btn btn-primary btn-round">Hasta</span>
							<div id="fecha_hasta"></div>
						</div>

						<div class="col-md-6 text-center form-group">
							<input type="text" class="form-control" id="fecha_desde_input" name="inputFechaDesde" readonly>
						</div>
						<div class="col-md-6 text-center form-group">
							<input type="text" class="form-control" id="fecha_hasta_input" name="inputFechaHasta" readonly>
						</div>

						<div class="col-md-6 col-xs-12 form-group">
							<label for="inputPrecio" class="control-label">Precio:</label>
							<input type="number" class="form-control" id="inputPrecio" name="inputPrecio" onKeyPress="if(this.value.length==9) return false;" max="999999.99" min="0.01" step="any" required>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" onClick="ajaxCreate('formAddRate', '<?=base_url()?>rest/sendRate', 'S')">Guardar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Editar Tarifa</h4>
			</div>
			<div class="modal-body">
				<?php
				$attrb = array('id' => 'formEditRate');
				$hidden = array('formType' => 'edit');
				echo form_open('#', $attrb, $hidden);
				?>
				<input type="hidden" name="idRate" id="id" />
					<div class="row">
						<div class="col-md-12 col-xs-12 form-group">
							<label for="inputPrecio" class="control-label">Tipo de Habitación:</label>
							<select class="form-control" id="room_type_id" name="inputType" readonly required>
								<?php foreach ($rooms as $rm ): ?>
									<option value="<?= $rm->id ?>"><?= $rm->short_name ?> - <?= $rm->name ?></option>
								<?php endforeach ?>
							</select>
						</div>

						<div class="col-md-6 text-center">
							<span class="btn btn-primary btn-round">Desde</span>
							<input type="text" class="form-control" id="date_from" name="inputFechaDesde" readonly>
						</div>
						<div class="col-md-6 text-center">
							<span class="btn btn-primary btn-round">Hasta</span>
							<input type="text" class="form-control" id="date_to" name="inputFechaHasta" readonly>
						</div>

						<div class="col-md-6 col-xs-12 form-group">
							<label for="inputPrecio" class="control-label">Precio:</label>
							<input type="number" class="form-control" id="rate" name="inputPrecio" onKeyPress="if(this.value.length==9) return false;" max="999999.99" min="0.01" step="any" required>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" onClick="ajaxUpdate('formEditRate', '<?=base_url()?>rest/sendRate', 'S')">Guardar</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	function format (rowData) {
	    return  '<div class="card-content table-responsive table-condensed">' +
		    		'<table class="table" id="posts-' + rowData.id + '">' +
		            	'<thead class="text-info">' +
			            	'<tr>' +
				                '<th>Desde</th>' +	
				                '<th>Hasta</th>' +
				                '<th>Tarifa</th>' +
				                '<th><i class="material-icons">build</i></th>' +
			            	'</tr>' +
		            	'</thead>' +
	        		'</table>' +
	        	'</div>';
	}

    function initTable(tableId, data) {
        $('#' + tableId).DataTable({
            ajax: {
		        url: '<?= base_url('rest/buscarTarifasHab') ?>',
		        data: { id: data.id },
		        type: 'POST',
            },
			language: {
				url: '<?= base_url('assets/plugins/datatables/spanish.json') ?>',
			},
            columns: [
                { data: 'date_from', name: 'date_from' },
                { data: 'date_to', name: 'date_to' },
				{ data: 'rate', class: 'text-right', render: $.fn.dataTable.render.number('.', ',', 2, '$') },
				{
					data: 'id',
					render: function(data, type, full, meta) {
						return '<button class="btn btn-sm btn-success btn-round" onClick="ajaxRead('+ data +', \'<?=base_url('rest/readRate')?>\', \'formEditRate\')"><i data-toggle="tooltip" title="Editar" class="material-icons">edit</i></button><button onClick="ajaxDelete('+ data +', \'<?=base_url()?>rest/deleteRate\', \'S\')" class="btn btn-sm btn-danger btn-round"><i data-toggle="tooltip" title="Borrar" class="material-icons">delete</i></button>';
					},
					class: 'text-center',
					orderable: false,
				}
            ],
			sDom: 'tp'
        })
    }

	$(document).ready(function() {
		var table = $('.table').DataTable({
			ajax: {
				url: '<?= base_url('rest/listaHab') ?>',
				type: 'POST'
			},
			language: {
				url: '<?= base_url('assets/plugins/datatables/spanish.json') ?>',
			},
			columns: [
				{ data: null, class: 'details-control', orderable: false, defaultContent: '' },
				{ data: 'short_name' },
				{ data: 'name' },
				{ data: 'base_price', class: 'text-right', render: $.fn.dataTable.render.number('.', ',', 2, '$') },
				{ data: 'base_availability', class: 'text-center' },
				{ data: 'max_occupancy', class: 'text-center' }
			],
			order: [[2, 'asc']],
			sDom: 'tp'
		});

		$('.table tbody').on('click', 'td.details-control', function () {
		    var tr = $(this).closest('tr');
		    var row = table.row( tr );
		    var tableId = 'posts-' + row.data().id;
		 
		    if ( row.child.isShown() ) {
		        row.child.hide();
		        tr.removeClass('shown');
		    }
		    else {
		        row.child( format(row.data()) ).show();
		        initTable(tableId, row.data());
		        tr.addClass('shown');
		        tr.next().find('td').addClass('no-padding bg-gray');
		    }
		});

		$('#fecha_desde').datetimepicker({
			inline: true,
			sideBySide: true,
			viewMode: 'months',
			format: 'DD/MM/YYYY',
			minDate: new Date(),
		});

		$('#fecha_hasta').datetimepicker({
			inline: true,
			sideBySide: true,
			viewMode: 'months',
			format: 'DD/MM/YYYY',
			minDate: new Date(),
		});
		$('#fecha_desde').on('dp.change', function(e) {
			$('#fecha_hasta').data("DateTimePicker").minDate(e.date);
			var formatedValue = e.date.format('YYYY-MM-DD');
			$('#fecha_desde_input').val(formatedValue);
		})
		$('#fecha_hasta').on('dp.change', function(e) {
			$('#fecha_desde').data("DateTimePicker").maxDate(e.date);
			var formatedValue = e.date.format('YYYY-MM-DD');
			$('#fecha_hasta_input').val(formatedValue);
		})
	});
</script>