
							
						<!-- Breadcrumb -->

						<?= $breadcrumb ?>



							<!-- barra de búsqueda -->									
							<form action="<?= base_url() ?>admin/fechas/index" method="get" class="form-inline">
							  <div class="row">
							  	<div class="form-group col-lg-3">
							  	  <div class="input-group">
							  	    <input name="buscar" type="text" class="form-control" placeholder="Buscar Fecha">
							  	    <span class="input-group-btn">
							  	      <button type="submit" class="btn btn-secondary">
							  	      	<span class="glyphicon glyphicon-search"></span>
							  	      </button>
							  	    </span>
							  	  </div>
							  	</div>
							  	
							  	<div class="form-group col-lg-3">
							  		<a href="#modal-fechas" class="btn btn-success" data-toggle="modal">Añadir Fecha</a>
							  	</div>
							  </div>
							</form>

	
							<!-- tabla principal -->
							<div class="table-responsive">
								<table class="table">
									<tr>
										<th>Id</th>
										<th>Fecha</th>
										<th>Hora de inicio</th>
										<th>Hora de fin</th>
										<th class="acciones">Acciones</th>						
									</tr>

									<?= $fechas_html ?>						
									
								</table>
							</div>


							<!-- Paginación -->
							<?= $paginacion ?>

						</div><!--  fin columna de valor 10 -->				
						
					</section>
				</section>
			</section> <!-- main -->
		</div> <!-- contenedor principal -->

		<footer> Powered by AteneaSoluciones S.A. info@ateneasoluciones.com +593 2255 3458 .:.</footer>

		<!-- Dialogo de tipo modal para fechas -->
		<div class="modal fade" id="modal-fechas" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Crear Nueva Fecha</h4>
					</div>

					<div class="modal-body">
						<form class="form form-horizontal" role="form" action="" id="form-fechas" method="POST">

							<div class="form-group">
						    <label for="tem_nombre" class="col-sm-2 control-label">Nombre:</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" name="tem_nombre" id="tem_nombre" placeholder="Nombre">
						    </div>
						  </div>

						  <div class="form-group">
						    <label for="tem_descripcion" class="col-sm-2 control-label">Descripción:</label>
						    <div class="col-sm-10">
						      <textarea name="tem_descripcion" class="form-control texto" placeholder="Descripción"></textarea>
						    </div>
						  </div>

						</form>

          </div>

					<div class="modal-footer">
						<button class="btn btn-primary" id="enviar-fecha">Enviar</button>
						<button class="btn btn-default" data-dismiss="modal">Cancelar</button>						
					</div>

				</div>
			</div>
		</div> <!-- Fin de Dialogo de tipo modal para fechas -->

    <script src="<?= base_url() ?>js/admin/fechas.js"></script>
	</body>
</html>
