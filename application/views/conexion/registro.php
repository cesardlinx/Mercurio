<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Mercurio</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="<?=base_url();?>favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?=base_url();?>favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?=base_url();?>css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h5 class="text-center">Registro</h5>

                    <!-- formulario de registro -->
                     <form class="form form-signup" role="form" action="<?=base_url();?>conexion/registrarusuario" id="registro" method="POST">
                        
                        <!-- nombres -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres"/>
                            </div>
                        </div>
                        
                        <!-- apellidos -->                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos"/>
                            </div>
                        </div>

                        <!-- contraseña -->                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Contaseña"/>
                            </div>
                        </div>

                        <!-- Confirmar contraseña -->                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" class="form-control" placeholder="Confirmar Contraseña"/>
                            </div>
                        </div>

                        <!-- Usuario(email) -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Correo electrónico"/>
                            </div>
                        </div>

                        <!-- hoja de vida -->                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                                <textarea name="hojavida" class="form-control" placeholder="Hoja de vida"></textarea>
                            </div>
                        </div>

                        <!-- submit -->
                        <input type="submit" class="btn btn-sm btn-primary btn-block" id="conectar" value="Registrarse">

                        <!-- error -->
                        <div class="alert alert-danger" id="error-registro"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url();?>js/jquery.min.js"></script>
<script src="<?=base_url();?>js/bootstrap.min.js"></script>
<script src="<?=base_url();?>js/conexion/conectar.js"></script>
</body>
</html>