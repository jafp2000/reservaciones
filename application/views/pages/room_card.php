<?php for($i=0; $i< count($room_list); $i++) : ?>
<?php if ($room_list[$i]['disponibles'] > 0) : ?>	
<div class="col-md-4">
	<div class="card card-product">
		<div class="card-image" data-header-animation="true">
			<a>
				<img class="img" src="<?=base_url('assets/uploads/rooms/'.$room_list[$i]['main_picture']);?>">
			</a>
			<div class="ripple-container"></div>
		</div>
		<div class="card-content">
			<h4 class="card-title"><a><?= $room_list[$i]['name'] ?></a></h4>
			<small>Capacidad: <?= $room_list[$i]['max_occupancy'] ?> Personas</small>
			<div class="card-description"><?= $room_list[$i]['description'] ?></div>
		</div>
		<div class="card-footer">
			<div class="price">
				<small>Desde</small>
				<h5>$<?= number_format($room_list[$i]['base_price'],'0',',','.') ?>/noche</h5>
			</div>
			<div class="stats pull-right">
				<button id="<?= $room_list[$i]['id'] ?>" class="btn btn-primary btn-round reserve_room">Reservar</button>
			</div>
			<br>
			<div class="text-center">
			<?php if($room_list[$i]['disponibles'] <= 5): ?>
				<?php if($room_list[$i]['disponibles'] == 1): ?>
				<small style="font-weight: bold; color:red;">Sólo queda 1 habitación disponible!</small>
				<?php else: ?>
				<small style="font-weight: bold; color:red;">Sólo quedan <?= $room_list[$i]['disponibles'] ?> habitaciones disponibles!</small>
				<?php endif; ?>	
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php endfor; ?>