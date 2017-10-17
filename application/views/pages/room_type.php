<div class="card">
	<div class="card-header" data-background-color="green">
		<h4 class="title">Tipos de Habitaciones <button class="btn btn-white btn-round btn-sm pull-right " data-toggle="modal" data-target="#addModal">Crear Habitación</button></h4>
	</div>
	<div class="card-content table-responsive">
		<table class="table">
			<thead class="text-success">
				<th class="text-center">Código</th>
				<th class="text-center">Nombre</th>
				<th class="text-center">Precio</th>
				<th class="text-center">Disponibilidad</th>
				<th class="text-center">Max. Ocupantes</th>
				<th class="text-center">Opciones</th>
			</thead>
		</table>
	</div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Nueva Habitación</h4>
			</div>
			<div class="modal-body">
				<ul  class="nav nav-pills">
					<li class="active"><a href="#data" data-toggle="tab">Datos Habitación</a></li>
					<li><a href="#description_tab" data-toggle="tab">Descripción</a></li>
					<li><a href="#pictures" data-toggle="tab">Fotos</a></li>
					<li><a href="#terms_tab" data-toggle="tab">Términos y Condiciones</a></li>
				</ul>
				<?php
				$attrb = array('id' => 'formAddHab');
				$hidden = array('formType' => 'add');
				echo form_open('#', $attrb, $hidden);
				?>
					<div class="row">
					<div class="tab-content clearfix">
					  	<div class="tab-pane active" id="data">
							<div class="col-md-6 col-xs-12">
								<div class="form-group form-success">
									<label for="inputNombre" class="control-label">Nombre:</label>
									<input type="text" class="form-control" id="inputNombre" name="inputNombre" maxlength="100" required>
								</div>
								<div class="form-group form-success">
									<label for="inputCodigo" class="control-label">Código:</label>
									<input type="text" class="form-control" id="inputCodigo" name="inputCodigo" maxlength="10" required>
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group form-success">
									<label for="inputPrecio" class="control-label">Precio:</label>
									<input type="number" class="form-control" id="inputPrecio" name="inputPrecio" onKeyPress="if(this.value.length==9) return false;" max="999999.99" min="0.01" step="any" required>
								</div>
								<div class="form-group form-success">
									<label for="inputDisponibilidad" class="control-label">Disponibilidad:</label>
									<input type="number" class="form-control" id="inputDisponibilidad" name="inputDisponibilidad" onKeyPress="if(this.value.length==11) return false;" max="99999999999" min="1" step="1" required>
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group form-success">
									<label for="inputMax" class="control-label">Max. Ocupantes:</label>
									<input type="number" class="form-control" id="inputMax" name="inputMax" onKeyPress="if(this.value.length==11) return false;" max="99999999999" min="1" step="1" required>
								</div>
							</div>
						</div>	
					  	<div class="tab-pane" id="description_tab">
							<div class="col-md-12 col-xs-12">
								<div class="form-group form-success">
									<textarea cols="10" id="inputDescripcion" name="inputDescripcion" rows="5" required></textarea>
								</div>
							</div>
						</div>
					  	<div class="tab-pane" id="pictures">
							<div class="col-md-12 col-xs-12">
								<div class="img">
									<div class="col-lg-4">
										<label for="inputImagen1" class="control-label">Imagen Principal</label>
									</div>
									<div class="col-lg-4">
										<label for="inputImagen1" class="control-label">Imagen No. 2</label>
									</div>
									<div class="col-lg-4">
										<label for="inputImagen1" class="control-label">Imagen No. 3</label>
									</div>
									<div class="col-lg-4">
										<input type="file" accept="image/png, image/jpeg, image/gif" id="inputImagen1" name="inputImagen1" class="hidden input-img" data-pos="1">
		            					<input type="hidden" name="base64Imagen1" id="base64Imagen1" required>
										<img class="prev-img" src="<?= base_url('assets/img/no_image.jpg') ?>" id="previewImagen1" data-pos="1">
									</div>
									<div class="col-lg-4">
										<input type="file" accept="image/png, image/jpeg, image/gif" id="inputImagen2" name="inputImagen2" class="hidden input-img" data-pos="2">
		            					<input type="hidden" name="base64Imagen2" id="base64Imagen2" required>
										<img class="prev-img" src="<?= base_url('assets/img/no_image.jpg') ?>" id="previewImagen2" data-pos="2">
									</div>
									<div class="col-lg-4">
										<input type="file" accept="image/png, image/jpeg, image/gif" id="inputImagen3" name="inputImagen3" class="hidden input-img" data-pos="3">
		            					<input type="hidden" name="base64Imagen3" id="base64Imagen3" required>
										<img class="prev-img" src="<?= base_url('assets/img/no_image.jpg') ?>" id="previewImagen3" data-pos="3">
									</div>
									<div class="col-lg-4">
									<label for="inputImagen1" class="control-label">Imagen No. 4</label>
									</div>
									<div class="col-lg-4">
									<label for="inputImagen1" class="control-label">Imagen No. 5</label>
									</div>
									<div class="col-lg-4">
									<label for="inputImagen1" class="control-label">Imagen No. 6</label>
									</div>
									<div class="col-lg-4">
										<input type="file" accept="image/png, image/jpeg, image/gif" id="inputImagen4" name="inputImagen4" class="hidden input-img" data-pos="4">
		            					<input type="hidden" name="base64Imagen4" id="base64Imagen4" required>
										<img class="prev-img" src="<?= base_url('assets/img/no_image.jpg') ?>" id="previewImagen4" data-pos="4">
									</div>
									<div class="col-lg-4">
										<input type="file" accept="image/png, image/jpeg, image/gif" id="inputImagen5" name="inputImagen5" class="hidden input-img" data-pos="5">
		            					<input type="hidden" name="base64Imagen5" id="base64Imagen5" required>
										<img class="prev-img" src="<?= base_url('assets/img/no_image.jpg') ?>" id="previewImagen5" data-pos="5">
									</div>
									<div class="col-lg-4">
										<input type="file" accept="image/png, image/jpeg, image/gif" id="inputImagen6" name="inputImagen6" class="hidden input-img" data-pos="6">
		            					<input type="hidden" name="base64Imagen6" id="base64Imagen6" required>
										<img class="prev-img" src="<?= base_url('assets/img/no_image.jpg') ?>" id="previewImagen6" data-pos="6">
									</div>
								</div>
							</div>
					  	</div>
					  	<div class="tab-pane" id="terms_tab">
							<div class="col-md-12 col-xs-12">
								<div class="form-group">
									<textarea cols="10" id="inputTerminos" name="inputTerminos" rows="5" required></textarea>
								</div>
							</div>
					  	</div>
					</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-success" onClick="sendData('formAddHab', 'add')">Guardar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Editar Habitación</h4>
			</div>
			<div class="modal-body">
				<ul  class="nav nav-pills">
					<li class="active"><a href="#data_edit" data-toggle="tab">Datos Habitación</a></li>
					<li><a href="#description_edit" data-toggle="tab">Descripción</a></li>
					<li><a href="#pictures_edit" data-toggle="tab">Fotos</a></li>
					<li><a href="#terms_edit" data-toggle="tab">Términos y Condiciones</a></li>
				</ul>
				<?php
				$attrb = array('id' => 'formEditHab');
				$hidden = array('formType' => 'edit');
				echo form_open_multipart('#', $attrb, $hidden);
				?>
				<input type="hidden" name="idHab" id="id" />
					<div class="row">
					<div class="tab-content clearfix">
					  	<div class="tab-pane active" id="data_edit">
							<div class="col-md-6 col-xs-12">
								<div class="form-group form-success">
									<label for="inputNombre" class="control-label">Nombre:</label>
									<input type="text" class="form-control" id="name" name="inputNombre" maxlength="100" required>
								</div>
								<div class="form-group form-success">
									<label for="inputCodigo" class="control-label">Código:</label>
									<input type="text" class="form-control" id="short_name" name="inputCodigo" maxlength="10" readonly required>
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group form-success">
									<label for="inputPrecio" class="control-label">Precio:</label>
									<input type="number" class="form-control" id="base_price" name="inputPrecio" onKeyPress="if(this.value.length==9) return false;" max="999999.99" min="0.01" step="any" required>
								</div>
								<div class="form-group form-success">
									<label for="inputDisponibilidad" class="control-label">Disponibilidad:</label>
									<input type="number" class="form-control" id="base_availability" name="inputDisponibilidad" onKeyPress="if(this.value.length==11) return false;" max="99999999999" min="1" step="1" required>
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group form-success">
									<label for="inputMax" class="control-label">Max. Ocupantes:</label>
									<input type="number" class="form-control" id="max_occupancy" name="inputMax" onKeyPress="if(this.value.length==11) return false;" max="99999999999" min="1" step="1" required>
								</div>
							</div>
						</div>
					  	<div class="tab-pane" id="description_edit">
							<div class="col-md-12 col-xs-12">
								<div class="form-group form-success">
									<label for="inputDescripcion" class="control-label">Descripción:</label>
									<textarea cols="10" id="description" name="inputDescripcion" rows="5" required></textarea>
								</div>
							</div>
						</div>
					  	<div class="tab-pane" id="pictures_edit">
							<div class="col-md-12 col-xs-12">
								<div class="img">
									<div class="col-lg-4">
										<label for="inputImagen1Edit" class="control-label">Imagen Principal</label>
									</div>
									<div class="col-lg-4">
										<label for="inputImagen2Edit" class="control-label">Imagen No. 2</label>
									</div>
									<div class="col-lg-4">
										<label for="inputImagen3Edit" class="control-label">Imagen No. 3</label>
									</div>
									<div class="col-lg-4">
										<input type="file" accept="image/png, image/jpeg, image/gif" id="inputImagen1Edit" name="inputImagen1Edit" class="hidden input-img" data-pos="1Edit">
		            					<input type="hidden" name="base64Imagen1Edit" id="base64Imagen1Edit">
										<img class="prev-img" src="<?= base_url('assets/img/no_image.jpg') ?>" id="previewImagen1Edit" data-pos="1Edit">
									</div>
									<div class="col-lg-4">
										<input type="file" accept="image/png, image/jpeg, image/gif" id="inputImagen2Edit" name="inputImagen2Edit" class="hidden input-img" data-pos="2Edit">
		            					<input type="hidden" name="base64Imagen2Edit" id="base64Imagen2Edit">
										<img class="prev-img" src="<?= base_url('assets/img/no_image.jpg') ?>" id="previewImagen2Edit" data-pos="2Edit">
									</div>
									<div class="col-lg-4">
										<input type="file" accept="image/png, image/jpeg, image/gif" id="inputImagen3Edit" name="inputImagen3Edit" class="hidden input-img" data-pos="3Edit">
		            					<input type="hidden" name="base64Imagen3Edit" id="base64Imagen3Edit">
										<img class="prev-img" src="<?= base_url('assets/img/no_image.jpg') ?>" id="previewImagen3Edit" data-pos="3Edit">
									</div>
									<div class="col-lg-4">
									<label for="inputImagen4Edit" class="control-label">Imagen No. 4</label>
									</div>
									<div class="col-lg-4">
									<label for="inputImagen5Edit" class="control-label">Imagen No. 5</label>
									</div>
									<div class="col-lg-4">
									<label for="inputImagen6Edit" class="control-label">Imagen No. 6</label>
									</div>
									<div class="col-lg-4">
										<input type="file" accept="image/png, image/jpeg, image/gif" id="inputImagen4Edit" name="inputImagen4Edit" class="hidden input-img" data-pos="4Edit">
		            					<input type="hidden" name="base64Imagen4Edit" id="base64Imagen4Edit">
										<img class="prev-img" src="<?= base_url('assets/img/no_image.jpg') ?>" id="previewImagen4Edit" data-pos="4Edit">
									</div>
									<div class="col-lg-4">
										<input type="file" accept="image/png, image/jpeg, image/gif" id="inputImagen5Edit" name="inputImagen5Edit" class="hidden input-img" data-pos="5Edit">
		            					<input type="hidden" name="base64Imagen5Edit" id="base64Imagen5Edit">
										<img class="prev-img" src="<?= base_url('assets/img/no_image.jpg') ?>" id="previewImagen5Edit" data-pos="5Edit">
									</div>
									<div class="col-lg-4">
										<input type="file" accept="image/png, image/jpeg, image/gif" id="inputImagen6Edit" name="inputImagen6Edit" class="hidden input-img" data-pos="6Edit">
		            					<input type="hidden" name="base64Imagen6Edit" id="base64Imagen6Edit">
										<img class="prev-img" src="<?= base_url('assets/img/no_image.jpg') ?>" id="previewImagen6Edit" data-pos="6Edit">
									</div>
								</div>
							</div>
					  	</div>
					  	<div class="tab-pane" id="terms_edit">
							<div class="col-md-12 col-xs-12">
								<div class="form-group">
									<textarea cols="10" id="terms" name="inputTerminos" rows="5" required></textarea>
								</div>
							</div>
						</div>
					</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-success" onClick="sendData('formEditHab', 'edit')">Guardar</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function sendData(formId, type){
	    for (instance in CKEDITOR.instances) {
	            CKEDITOR.instances[instance].updateElement();
	    }

		if (type == 'add') { ajaxCreate(formId, '<?=base_url()?>rest/sendHab', 'S') }
		else if (type == 'edit') { ajaxUpdate(formId, '<?=base_url()?>rest/sendHab', 'S') }
	}

	$(document).ready(function() {
		$('.table').DataTable({
			ajax: {
				url: '<?= base_url('rest/listaHab') ?>',
				type: 'POST'
			},
			language: {
				url: '<?= base_url('assets/plugins/datatables/spanish.json') ?>',
			},
			columns: [
				{ data: 'short_name' },
				{ data: 'name' },
				{ data: 'base_price', 'class': 'text-right', render: $.fn.dataTable.render.number('.', ',', 2, '$') },
				{ data: 'base_availability', 'class': 'text-center' },
				{ data: 'max_occupancy', 'class': 'text-center' },
				{
					data: 'id',
					render: function(data, type, full, meta) {
						return '<button class="btn btn-success btn-round btn-just-icon" onClick="ajaxRead('+ data +', \'<?=base_url('rest/readHab')?>\', \'formEditHab\', [\'description\', \'terms\'])"><i data-toggle="tooltip" title="Editar" class="material-icons">edit</i></button><button onClick="ajaxDelete('+ data +', \'<?=base_url()?>rest/deleteHab\', \'S\')" class="btn btn-danger btn-round btn-just-icon"><i data-toggle="tooltip" title="Borrar" class="material-icons">delete</i></button>';
					},
					class: 'text-center',
					orderable: false,
				},
			],
			sDom: 'tp'
		});

		CKEDITOR.replace('inputDescripcion', {
				height: 200,
				width: 550,
		});

		CKEDITOR.replace('inputTerminos', {
				height: 200,
				width: 550,
		});
	});

    $(document).on('click', '.prev-img', function(){
        $('#inputImagen' + $(this).attr('data-pos')).trigger('click');
    });

    $(document).on('change', '.input-img', function(){
        var preview = document.querySelector('#previewImagen' + $(this).attr('data-pos'));
        var content = document.querySelector('#base64Imagen' + $(this).attr('data-pos'));
        var file = document.querySelector('#inputImagen' + $(this).attr('data-pos')).files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            content.value = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    });
</script>