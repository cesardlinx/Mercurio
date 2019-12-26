							
						<!-- Breadcrumb -->

						<?= $breadcrumb ?>



							<!-- barra de búsqueda -->									
							<form action="<?= base_url() ?>admin/temas/emails" method="get" class="form-inline">
							  <div class="row">
							  	<div class="form-group col-lg-3">
							  	  <div class="input-group">
							  	    <input name="buscar" id="buscar" type="text" class="form-control" placeholder="Buscar Email">
							  	    <span class="input-group-btn">
							  	    	<a href="#" class="btn btn-secondary" id='busqueda'>
							  	      	<span class="glyphicon glyphicon-search"></span>				  	    		
							  	    	</a>
							  	    </span>
							  	  </div>
							  	</div>
							  	
									<div class="form-group col-lg-3">
							  	  <label class="control-label" for="estado">Filtrar por estado:</label>
										<select class="form-control" id="estado">
											<option value="">Seleccionar</option>
											<option value="e">Enviado</option>
											<option value="p">Pendiente</option>
										</select>
							  	</div>

							  	<div class="form-group col-lg-3">
							  		<a href="#modal-emails" class="btn btn-success" data-toggle="modal">Añadir Email</a>
							  	</div>
							  </div>
							</form>

	
							<!-- tabla principal -->
							<table class="table">
								<tr>
									<th>Id</th>
									<th>Asunto</th>
									<th>Fecha de Ingreso</th>
									<th>Fecha Programada</th>
									<th>Estado</th>
									<th class="acciones">Acciones</th>						
								</tr>

								<?= $emails_html ?>

							
								
							</table>


							<!-- Paginación -->
							<?= $paginacion ?>

						</div><!--  fin columna de valor 10 -->				
						
					</section>
				</section>
			</section> <!-- main -->
		</div> <!-- contenedor principal -->

		<footer> Powered by AteneaSoluciones S.A. info@ateneasoluciones.com +593 2255 3458 .:.</footer>

		<!-- Dialogo de tipo modal para emails -->
		<div class="modal fade" id="modal-emails" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Crear Nuevo Email</h4>
					</div>

					<div class="modal-body">
						<form class="form form-horizontal" role="form" action="" id="form-emails" method="POST">

							<div class="form-group">
						    <label for="sus_email" class="col-sm-2 control-label">Email Suscriptor:</label>
						    <div class="col-sm-10">
						      <input type="email" class="form-control" name="sus_email" id="sus_email" placeholder="Email del Suscriptor">
						    </div>
						  </div>

						  <div class="form-group">
						    <label for="eml_asunto" class="col-sm-2 control-label">Asunto:</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" name="eml_asunto" id="eml_asunto" placeholder="Asunto">
						    </div>
						  </div>


						  <div class="form-group">
						    <label for="eml_contenido" class="col-sm-2 control-label">Contenido:</label>
						    <div class="col-sm-10">
						      <textarea id="eml_contenido" name="eml_contenido" class="form-control texto" placeholder="Contenido"></textarea>
						    </div>
						  </div>

						  <div class="form-group">
						    <label for="eml_fecha_programada" class="col-sm-2 control-label">Fecha Programada:</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" name="eml_fecha_programada" id="eml_fecha_programada">
						    </div>
						  </div>

						  <div class="form-group" id="combo_servidores">
						    <label for="ser_id" class="col-sm-2 control-label">Servidor:</label>
						    <div class="col-sm-10">
						      <?= $combo_servidores ?>
						    </div>
						  </div>
							
							<!-- campos ocultos -->
						  <input type='hidden' name="eml_estado" id='eml_estado' value="p">
			        <input type="hidden" name="eml_fecha_ingreso" id="eml_fecha_ingreso" value="<?= hoy('c'); ?>">
							<input type="hidden" id="tem_id" value="<?= $tem_id ?>">


						</form>

          </div>

					<div class="modal-footer">
						<button class="btn btn-primary" id="enviar-email">Enviar</button>
						<button class="btn btn-default" data-dismiss="modal">Cancelar</button>						
					</div>
					



				</div>
			</div>
		</div> <!-- Fin de Dialogo de tipo modal para emails -->



    <script src="<?= base_url() ?>js/admin/emails_temas.js"></script>
	</body>
</html>
