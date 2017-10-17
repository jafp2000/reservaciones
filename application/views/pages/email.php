<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Información de Reserva</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Roboto:400,300'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="row">
    <div class="cols-lg-12 text-center">
        <a href="http://misahualliamazonlodge.ec" class="simple-text" target="_blank">
            <img width="200" height="80" src="<?= base_url('assets/img/logo.png') ?>">
        </a>
    </div>
</div>
<div class="row">
    <div class=" col-xs-12 col-md-4 col-md-offset-4">
        <div class="panel panel-success">
            <div class="panel-heading">Reservación</div>
            <div class="panel-body">
                <h4>Informacion del Cliente</h4>
                <p>Nombre: <?= $nombre ?></p>
                <p>Apellido: <?= $apellido ?></p>
                <p>Correo Electrónico: <?= $correo ?></p>
                <h4>Información de la Reserva</h4>
                <p>Tipo de Habitacion: <?= $nombre_habitacion ?></p>
                <p>Fecha Entrada: <?= date('d/m/Y', strtotime($fecha_entrada)) ?></p>
                <p>Fecha Salida: <?= date('d/m/Y', strtotime($fecha_salida)) ?></p>
                <p>Adultos: <?= $huespedes ?></p>
                <p>Precio Total: $<?= number_format($precio_total, '2', ',', '.') ?></p>
                <h4>Tarifa por Noche</h4>
                <?php
                $fecha = $fecha_entrada;
                while (strtotime($fecha) <= strtotime($fecha_salida)) {
                    if (isset($tarifas[$fecha])){
                        echo 'Dia '.date('d/m/Y', strtotime($fecha)).'  -  Precio : $'.number_format($tarifas[$fecha], '2', ',', '.').'<br>';
                    }
                    $fecha = date("Y-m-d", strtotime("+1 day", strtotime($fecha)));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php if($tipo_pago == 'PAYPAL') : ?>
<div class="row">
    <div class=" col-xs-12 col-md-4 col-md-offset-4">
        <div class="panel panel-info">
            <div class="panel-heading">Información del Pago</div>
            <div class="panel-body">
                <p>Tipo: <?= $tipo_pago ?></p>
                <p>ID Transacción: <?= $id_pago ?></p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if($tipo_pago == 'TRANSFERENCIA') : ?>
<div class="row">
    <div class=" col-xs-12 col-md-4 col-md-offset-4">
        <div class="panel panel-info">
            <div class="panel-heading">Datos para la Transferencia</div>
            <div class="panel-body">
                <p>Banco: BANCO PRINCIPAL</p>
                <p>No. Cuenta: 123456789-7</p>
                <p>Beneficiario: Misahualli Amazon Lodge</p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous""></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>