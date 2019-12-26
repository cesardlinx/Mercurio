<tr>
	<td>{id}</td>
	<td>{eml_asunto}</td>
	<td>{eml_fecha_ingreso}</td>
	<td>{eml_fecha_programada}</td>
	<td>{eml_estado}</td>
	<td class="acciones">
		<a href="#modal-emails" title="Editar" class="btn btn-primary" data-toggle="modal" data-id="{id}">
			<span class="glyphicon glyphicon-pencil"></span>								
		</a>
		<a href="#" title="Eliminar" class="btn btn-danger" rel="eliminar_email" val="{id}">
			<span class="glyphicon glyphicon-remove"></span>								
		</a>
	</td>
</tr>