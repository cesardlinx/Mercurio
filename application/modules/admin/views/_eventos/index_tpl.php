<tr>
    <td>{id}</td>
    <td>{eve_titulo}</td>
    <td>
        <a href='<?=base_url()?>admin/eventos/modificar/{id}'><img src="<?= base_url() ?>css/general/img/t.gif" class='opciones opc_modificar' title='Modificar datos del evento'/></a>
        <a href='#' rel="eliminar_evento" val="{id}"><img src="<?= base_url() ?>css/general/img/t.gif" class='opciones opc_borrar' title='Eliminar evento'/></a>
    </td>
</tr>