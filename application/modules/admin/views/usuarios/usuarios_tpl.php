<tr>
	<td>{id}</td>
	<td>{usu_nombres}</td>
	<td>{usu_apellidos}</td>
	<td>{usu_email}</td>
	<td>{usu_activo}</td>
	<td class="ver-mas-1">
		<a href="<?= base_url() ?>admin/usuarios/archivos/{id}" title="Ver Suscriptores" class="btn btn-primary">
			<span class="glyphicon glyphicon-paperclip"></span>
		</a>
	</td>


	<td class="acciones">
		<a href="#modal-usuarios" title="Editar" class="btn btn-primary" data-toggle="modal" data-id="{id}">
			<span class="glyphicon glyphicon-pencil"></span>								
		</a>
		<a href="#" title="Eliminar" class="btn btn-danger" rel="eliminar_usuario" val="{id}">
			<span class="glyphicon glyphicon-remove"></span>								
		</a>
	</td>
</tr>