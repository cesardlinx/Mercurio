
							
						<!-- Breadcrumb -->

						<?= $breadcrumb ?>



							<!-- barra de búsqueda -->									
							<form action="<?= base_url() ?>admin/temas/index" method="get" class="form-inline">
							  <div class="row">
							  	<div class="form-group col-lg-3">
							  	  <div class="input-group">
							  	    <input name="buscar" type="text" class="form-control" placeholder="Buscar Tema">
							  	    <span class="input-group-btn">
							  	      <button type="submit" class="btn btn-secondary">
							  	      	<span class="glyphicon glyphicon-search"></span>
							  	      </button>
							  	    </span>
							  	  </div>
							  	</div>
							  	
							  	<div class="form-group col-lg-3">
							  		<a href="#modal-temas" class="btn btn-success" data-toggle="modal">Añadir Tema</a>
							  	</div>
							  </div>
							</form>

	
							<!-- tabla principal -->
							<table class="table">
								<tr>
									<th>Id</th>
									<th>Tema</th>
									<th>Descripción</th>
									<th class="ver-mas-1">Ver emails</th>
									<th class="acciones">Acciones</th>						
								</tr>

								<?= $temas_html ?>

							
								
							</table>


							<!-- Paginación -->
							<?= $paginacion ?>

						</div><!--  fin columna de valor 10 -->				
						
					</section>
				</section>
			</section> <!-- main -->
		</div> <!-- contenedor principal -->

		<footer> Powered by AteneaSoluciones S.A. info@ateneasoluciones.com +593 2255 3458 .:.</footer>

		<!-- Dialogo de tipo modal para temas -->
		<div class="modal fade" id="modal-temas" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Crear Nuevo Tema</h4>
					</div>

					<div class="modal-body">
						<form class="form form-horizontal" role="form" action="" id="form-temas" method="POST">

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
						<button class="btn btn-primary" id="enviar-tema">Enviar</button>
						<button class="btn btn-default" data-dismiss="modal">Cancelar</button>						
					</div>

				</div>
			</div>
		</div> <!-- Fin de Dialogo de tipo modal para temas -->

    <script src="<?= base_url() ?>js/admin/temas.js"></script>
	</body>
</html>
