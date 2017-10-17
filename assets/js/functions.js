/******** FUNCIONES GENERALES ********/

function ajaxCreate(formId, url, dataTable = 'N') {
	$.ajax({
		type: 'POST',
		url: url,
		data: $('#' + formId).serialize(),
		success: function(msg) {
			var mensaje = msg.message;
			console.log(mensaje);
			if(msg.status == true) {
				$('#' + formId)[0].reset();
				if (formId == 'formAddHab'){
					if (dataTable != 'N'){
					    for (instance in CKEDITOR.instances) {
					            CKEDITOR.instances[instance].updateElement();
								CKEDITOR.instances[instance].setData('');
					    }
					}
					for (var i = 1; i < 7; i++) {
		 				$('#' + formId + ' #base64Imagen'+ i).removeAttr('value');
		 				$('#' + formId + ' #previewImagen'+ i).attr('src', base_url + 'assets/img/no_image.jpg');
	 				}
				}

				$('#addModal').modal('hide');
				swal({
					title: '¡Hecho!',
					text: msg.message,
					type: 'success'},function(){
						if (dataTable == 'N') {
							location.reload();
						} else {
							$('.table').DataTable().ajax.reload();
						}
					});
			} else {
				swal({
					title: '¡Advertencia!',
					text: msg.message,
					type: 'error'});
			}
		},
		error: function(msg) {
			console.log(msg);
		}
	});
}

function ajaxCreateFile(formId, url, dataTable = 'N', idImagen) {
	var formData = new FormData($('#' + formId)[0])
	$.ajax({
		type: 'POST',
		url: url,
		fileElementId: idImagen,
		data: formData,
		cache: false,
		contentType: false,
		processData:false,
		success: function(msg) {
			var mensaje = msg.message;
			console.log(mensaje);
			if(msg.status == true) {
				$('#' + formId)[0].reset();
				$('#addModal').modal('hide');
				swal({
					title: '¡Hecho!',
					text: msg.message,
					type: 'success'},function(){
						if (dataTable == 'N') {
							location.reload();
						} else {
							$('.table').DataTable().ajax.reload();
						}
					});
			} else {
				swal({
					title: '¡Advertencia!',
					text: msg.message,
					type: 'error'});
			}	
		},
		error: function(msg) {
			console.log(msg);
		}
	});
}

function ajaxRead(id, url, formId, ckEditorVal = 'N') {

	if (ckEditorVal.length > 1){
		for (var i = 0; i < ckEditorVal.length; i++) {
			if(CKEDITOR.instances[ckEditorVal[i]]) { CKEDITOR.instances[ckEditorVal[i]].destroy() }
		}
	} else {
		if(CKEDITOR.instances[ckEditorVal]) { CKEDITOR.instances[ckEditorVal].destroy() }
	}

	$.ajax({
		type: 'POST',
		url: url,
		data: {'id': id },
		success: function(msg) {
			var mensaje = msg.message;
			console.log(mensaje);
			if(msg.status == true) {
		 		$('#' + formId)[0].reset();

				for (var aux in msg.data[0]) {
					if (formId == 'formEditHab' && aux == 'main_picture'){
						for (var i = 1; i < 7; i++) {
		 				$('#' + formId + ' #base64Imagen'+ i +'Edit').removeAttr('value');
		 				$('#' + formId + ' #previewImagen'+ i +'Edit').attr('src', base_url + 'assets/img/no_image.jpg');

							if (existeUrl(base_url + 'assets/uploads/rooms/' + msg.data[0].short_name + '_' + i + '.jpg')){
							    $('#' + formId + ' #previewImagen' + i + 'Edit').attr('src', base_url + 'assets/uploads/rooms/' + msg.data[0].short_name + '_' + i + '.jpg');
							}
						}
					} else {
						$('#'+ formId +' #' + aux).val(eval('msg.data[0].' + aux));
					}
				}

				if (ckEditorVal != 'N'){
					if (ckEditorVal.length > 1){
						for (var i = 0; i < ckEditorVal.length; i++) {
							CKEDITOR.replace(ckEditorVal[i], {
								height: 200,
								width: 550,
							});
						}
					} else {
						CKEDITOR.replace(ckEditorVal, {
							height: 200,
							width: 550,
						});
					}
				}
				$('#editModal').modal('show');
			} else {
				swal({
					title: '¡Advertencia!',
					text: msg.message,
					type: 'error'});
			}	
		},
		error: function(msg) {
			console.log(msg);
		}
	});
}

function ajaxUpdate(formId, url, dataTable = 'N'){
	$.ajax({
		type: 'POST',
		url: url , 
		data: $('#' + formId).serialize(),
		success: function (msg) {
			var mensaje = msg.message;
			console.log(mensaje);
			if(msg.status == true) {
				$('#editModal').modal('hide');
				swal({
					title: '¡Hecho!',
					text: msg.message,
					type: 'success'},function(){
						if (dataTable == 'N') {
							location.reload();
						} else {
							$('.table').DataTable().ajax.reload();
						}
					});
			} else {
				swal({
					title: '¡Advertencia!',
					text: msg.message,
					type: 'error'});
			}
		},
		error: function(msg) {
			console.log(msg);
		}
	});
}

function ajaxUpdateFile(formId, url, dataTable = 'N', idImagen){
	var formData = new FormData($('#' + formId)[0])

	$.ajax({
		type: 'POST',
		url: url,
		fileElementId: idImagen,
		data: formData,
		cache: false,
		contentType: false,
		processData:false,
		success: function (msg) {
			var mensaje = msg.message;
			console.log(mensaje);
			if(msg.status == true) {
				$('#editModal').modal('hide');
				swal({
					title: '¡Hecho!',
					text: msg.message,
					type: 'success'},function(){
						if (dataTable == 'N') {
							location.reload();
						} else {
							$('.table').DataTable().ajax.reload();
						}
					});
			} else {
				swal({
					title: '¡Advertencia!',
					text: msg.message,
					type: 'error'});
			}
		},
		error: function(msg) {
			console.log(msg);
		}
	});
}

function ajaxDelete(id, url, dataTable = 'N'){
	swal({
		title: '¡Advertencia!',
		text: '¿Seguro que desea Eliminar este Registro?',
		type: 'warning',
		showCancelButton: true,
		cancelButtonText: "Cancelar",
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "¡Eliminar!",
		closeOnConfirm: false }, function(){
			$.ajax({
				type: 'POST',
				url: url, 
				data: {'id': id },
				success: function (msg) {
					var mensaje = msg.message;
					console.log(mensaje);
					if(msg.status == true) {
						swal({
							title: '¡Hecho!',
							text: msg.message,
							type: 'success'},function(){
								if (dataTable == 'N') {
									location.reload();
								} else {
									$('.table').DataTable().ajax.reload();
								}
							});
					} else {
						swal({
							title: '¡Advertencia!',
							text: msg.message,
							type: 'error'});
					}
				},
				error: function(msg) {
					console.log(msg);
				}
			});
	});
}

function existeUrl(url) {
   var http = new XMLHttpRequest();
   http.open('HEAD', url, false);
   http.send();
   return http.status != 404;
}