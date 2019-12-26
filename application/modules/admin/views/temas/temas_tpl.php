<tr>
	<td>{id}</td>
	<td>{tem_nombre}</td>
	<td>{tem_descripcion}</td>
	<td class="ver-mas-1">
		<a href="<?= base_url() ?>admin/temas/emails/{id}" title="Ver Emails" class="btn btn-primary">
			<span class="glyphicon glyphicon-envelope"></span>
		</a>
	</td>


	<td class="acciones">
		<a href="#modal-temas" title="Editar" class="btn btn-primary" data-toggle="modal" data-id="{id}">
			<span class="glyphicon glyphicon-pencil"></span>								
		</a>
		<a href="#" title="Eliminar" class="btn btn-danger" rel="eliminar_tema" val="{id}">
			<span class="glyphicon glyphicon-remove"></span>								
		</a>
	</td>
</tr>