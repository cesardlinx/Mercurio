<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Mercurio</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>css/general/main.css">
  </head>
	<body>
		
		<div class="contenedor-principal">

			<!-- BARRA DE NAVEGACIÓN -->
			<nav class="navbar navbar-default" role="navigation">
			  <!-- Logotipo y barra de navegación para dispositivos móviles -->
			  <div class="navbar-header">
			    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
			      <span class="icon-bar"></span>
			      <span class="icon-bar"></span>
			      <span class="icon-bar"></span>
			    </button>
			    <a class="navbar-brand" href="<?= base_url() ?>">Mercurio</a>
			  </div>
			
			  <!-- Barra de búsqueda, inicio de sesión y registro -->
			  <div class="collapse navbar-collapse" id="menu">
			
			    <ul class="nav navbar-nav navbar-right">
			    	<li>		    		
					    <div>
					        <form action="<?= base_url() ?>" method="get" class="navbar-form" role="search">
					        <div class="input-group">
					            <input type="text" class="form-control" placeholder="Buscar" name="buscar">				            
			
					            <div class="input-group-btn">
					                <button class="btn btn-default busqueda" type="submit"><i class="glyphicon glyphicon-search"></i></button>
					            </div>
					        </div>
					        </form>
					    </div>
			    	</li>
			    	<?php if(isset($_SESSION['conectado'])): ?>
				      <li><a href="<?= base_url() ?>admin">Panel de Administración</a></li>
			    	<?php else: ?>
				      <li><a href="#iniciar-sesion" data-toggle="modal">Iniciar Sesión</a></li>
			    	<?php endif; ?>
			      <li><a href="#registrar-usuario" data-toggle="modal">Registrarse</a></li>
			    </ul>
			  </div><!-- /.navbar-collapse -->
			</nav>
			
			
			
			<!-- contenido principal -->
			<section class="main container">
				<section class="row">
			
					<!-- Eventos -->
					<section class="eventos col-md-9 col-sm-12">
						<!-- eventos -->					
						<?= $eventos_html ?>
			
						<!-- Paginación -->
						<?= $paginacion ?>
					</section>
			
			
					<!-- aside -->
					<aside class="col-md-3 visible-md visible-lg">
						
						<h4>Publicidad</h4>
						<div class="list-group">
							<a href="#" class="list-group-item">
						    	<h4 class="list-group-item-heading">Anuncio 1</h4>
						    	<p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
						  	</a>
						  	<a href="#" class="list-group-item">
						    	<h4 class="list-group-item-heading">Anuncio 2</h4>
						    	<p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
						  	</a>
						  	<a href="#" class="list-group-item">
						    	<h4 class="list-group-item-heading">Anuncio 3</h4>
						    	<p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
						  	</a>
						  	<a href="#" class="list-group-item">
						    	<h4 class="list-group-item-heading">Anuncio 4</h4>
						    	<p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
						  	</a>
						</div>
			
					</aside> 
				</section>
			</section>
		</div> <!-- main -->
		
		<footer> Powered by AteneaSoluciones S.A. info@ateneasoluciones.com +593 2255 3458 .:.</footer>



	  <!-- Dialogo de tipo modal para inicio de sesión -->
		<div class="modal fade" id="iniciar-sesion" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Inicio de Sesión</h4>
					</div>

					<div class="modal-body">
						<form class="form form-signup" role="form" action="<?=base_url();?>conexion/conectar" id="ingreso" method="POST">

              <!-- Usuario(email) -->
              <div class="form-group">
                  <div class="input-group">
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-envelope"></span>
                      </span>
                      <input type="email" name="usuario" id="usuario" class="form-control" placeholder="Correo electrónico"/>
                  </div>
              </div>
              
              <!-- contraseña -->
              <div class="form-group">
                  <div class="input-group">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                      <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Contaseña"/>
                  </div>
              </div>
            </form>
					</div>

					<div class="modal-footer">
						<button class="btn btn-primary" id="enviar-ingreso">Enviar</button>
						<button class="btn btn-default" data-dismiss="modal">Cancelar</button>						
					</div>

				</div>
			</div>
		</div> <!-- Fin de Dialogo de tipo modal para inicio de sesión -->

		<!-- Dialogo de tipo modal para registro -->
		<div class="modal fade" id="registrar-usuario" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Registrarse</h4>
					</div>

					<div class="modal-body">
						
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
                  <span class="input-group-addon">
                  	<span class="glyphicon glyphicon-user"></span>
                  </span>
                  <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos"/>
                </div>
              </div>

              <!-- contraseña -->                        
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                  	<span class="glyphicon glyphicon-lock"></span>
                  </span>
                  <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Contaseña"/>
                </div>
              </div>

              <!-- Confirmar contraseña -->                        
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                  	<span class="glyphicon glyphicon-lock"></span>
                  </span>
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
                  <textarea name="hojavida" class="form-control texto" placeholder="Hoja de vida"></textarea>
                </div>
              </div>

              <!-- error -->
              <div class="alert alert-danger" id="error-registro"></div>

					<div class="modal-footer">
						<button class="btn btn-primary" id="enviar-registro">Enviar</button>
						<button class="btn btn-default" data-dismiss="modal">Cancelar</button>						
					</div>

				</div>
			</div>
		</div> <!-- Fin de Dialogo de tipo modal para registro -->

		<script src="<?= base_url() ?>js/jquery.min.js"></script>
		<script src="<?= base_url() ?>js/bootstrap.min.js"></script>
		<script src="<?= base_url() ?>js/portada/portada.js"></script>
	  
	</body>
</html>
