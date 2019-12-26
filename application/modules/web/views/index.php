<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title><?= $eve_titulo ?></title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="<?= base_url(); ?>css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?= base_url(); ?>css/general/main.css" />
        <script src="<?= base_url() ?>js/jquery.min.js"></script>
        <script src="<?= base_url() ?>js/validate/jquery.validate.min.js"></script>
        <script src="<?= base_url() ?>js/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>js/web/suscribirse.js"></script>

    </head>
    <body>
    <div class="contenedor-principal">
    
			<div class="main"> <!-- contenido -->
	    	<!-- jumbotron -->
	    	<div class="jumbotron">
	    		<div class="container align-center">
	    			<h1><?= $eve_titulo ?></h1>
	    			<h4><?= $eve_subtitulo ?></h4>
	    		</div>
	    	</div>
    	
    	
    		<section class="container">
    			<div class="row">
    				<!-- articulos -->
    				<div class="col-sm-9 col-xs-12">
    					<article>
    						<h3>Objetivos</h3>
    						<p><?= $eve_objetivos ?></p>
    		
    					</article>
    					<article>
    						<h3>Descripción</h3>
    						<p><?= $eve_descripcion ?></p>
    					</article>
    					<article>
    						<h3>Contenido</h3>
    						<p><?= $eve_contenido ?></p>
    					</article>
    				</div>
    				<!-- aside -->
    				<aside class="col-sm-3 col-xs-12 info">
    					<div class="info-secundaria">
    						<h4>Dirigido a:</h4>
    						<p><?= $eve_dirigido ?></p>
    					</div>
    		
    					<div class="info-secundaria">
    						<h4>Duración:</h4>
    						<p><?= $eve_duracion ?></p>
    					</div>
    		
    					<div class="info-secundaria">
    						<h4>Lugar:</h4>
    						<p><?= $eve_lugar ?></p>
    					</div>
    		
    					<div class="info-secundaria">
    						<h4>Costo:</h4>
    						<p><?= $eve_costo ?></p>
    					</div>
    		
    					<div class="info-secundaria">
    						<h4>Fecha:</h4>
    						<p><?= $eve_fecha_hora ?></p>
    					</div>
    		
    					<div>
    						<h4>Conferencista:</h4>
    						<p><?= $usu_conferencista ?></p>
    					</div>
    				
    				</aside>
    			</div>
    		</section>
    				
				<div class="panel panel-default">

					<div class="panel-heading mas-info" id="heading">
						<h4>
							<a  href="#suscripcion" data-toggle="collapse">Obtener más información</a>
						</h4>
					</div>

					<div class="panel-collapse collapse" id="suscripcion">
						<div class="container">
							<!-- formulario de suscripción -->
							<h2>Suscribirse:</h2>
							<form action="<?= base_url() ?>web/landing_page/suscripcion" method="post" id="form-suscripcion">
								<div class="form-group">
									<label class="control-label" for="nombres">Nombres:</label>
									<input class="form-control" type="text" name="nombres" id="nombres">
								</div>
								<div class="form-group">
									<label class="control-label" for="apellidos">Apellidos:</label>
									<input class="form-control" type="text" name="apellidos" id="apellidos">
								</div>
								<div class="form-group">
									<label class="control-label" for="email">Correo:</label>
									<input class="form-control" type="email" name="email" id="email">
								</div>
								<div class="form-group">
									<label class="control-label" for="celular">Celular:</label>
									<input class="form-control" type="text" name="celular" id="celular">
								</div>
				
				        <!-- confirma -->
								<div class="form-group">
									<label class="control-label" for="confirmado">Confirmar Asistencia:</label>
													
																  <label class="radio-inline">
									  <input type="radio" name="confirmado" value="s"> Si
									</label>
									<label class="radio-inline">
									  <input type="radio" name="confirmado" value="n"> No
									</label>
									<label class="radio-inline">
									  <input type="radio" name="confirmado" value="q"> Quizas
									</label>
								</div>
				
							    <!-- colabora -->
								<div class="form-group">
									<label class="control-label" for="colabora">Va a traer algo:</label>
																  <label class="checkbox-inline">
									  <input type="checkbox" name="colabora" id="colabora" value="s"> Si
									</label>
								</div>
				
								<!-- campos ocultos -->
								<input type="hidden" name="tem_id" value="<?= $tem_id ?>">
								<input type="hidden" name="eve_id" value="<?= $id ?>">
				
				
								<!-- submit -->
								<div class="form-group">
									<div class="text-center">
										<input type="submit" value="Suscribirse" class="suscribirse btn btn-primary btn-lg">
									</div>
								</div>
				
								<!-- error -->
				            <div class="alert alert-danger" id="error-suscripcion"></div>
							</form>
						</div>
					</div> <!-- cuerpo del panel -->
				</div> <!-- panel -->
    	</div> <!-- main -->
    </div> <!-- contenedor-principal -->

		<footer> Powered by AteneaSoluciones S.A. info@ateneasoluciones.com +593 2255 3458 .:.</footer>
	</body>
</html>
