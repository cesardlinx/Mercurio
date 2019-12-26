<tr>
	<td>{id}</td>
	<td>{eve_titulo}</td>
	<td>{eve_lugar}</td>
	<td>{eve_fecha_hora}</td>
	<td>{eve_duracion}</td>
	<td class="ver-mas-2">
		<a href="<?= base_url() ?>admin/eventos/suscriptores/{id}" title="Ver Suscriptores" class="btn btn-primary">
			<span class="glyphicon glyphicon-user"></span>
		</a>
		<a href="<?= base_url() ?>admin/eventos/emails/{id}" title="Ver Emails" class="btn btn-primary">
			<span class="glyphicon glyphicon-envelope"></span>
		</a>
	</td>


	<td class="acciones">
		<a href="#modal-eventos" title="Editar" class="btn btn-primary" data-toggle="modal" data-id="{id}">
			<span class="glyphicon glyphicon-pencil"></span>								
		</a>
		<a href="#" title="Eliminar" class="btn btn-danger" rel="eliminar_evento" val="{id}">
			<span class="glyphicon glyphicon-remove"></span>								
		</a>
	</td>
</tr>