<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>MERCURIO</title>
    <link href="<?=base_url();?>css/conexion.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?=base_url();?>favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?=base_url();?>favicon.ico" type="image/x-icon">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h5 class="text-center">
                     CONEXIÓN</h5>
                     <form class="form form-signup" role="form" action="<?=base_url();?>conexion/conectar" id="conexion" method="POST">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                            </span>
                            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Correo electrónico" value="<?=$usuario?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Contaseña" value="<?=$contrasena?>"/>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?=$llave?>" name="llave">
                <input type="hidden" value="<?=base_url()?>" id="base_url">
                <input type="hidden" value="<?=$url_destino?>" id="url_destino" name="url_destino">
                <input type="submit" class="btn btn-sm btn-primary btn-block" id="conectar" value="Ingresar">
            </form>
        </div>
    </div>

</div>
</div>
</div>

</body>
<script src="<?=base_url();?>js/jquery.min.js"></script>
<script src="<?=base_url();?>js/conexion/conectar.js"></script>
</html>