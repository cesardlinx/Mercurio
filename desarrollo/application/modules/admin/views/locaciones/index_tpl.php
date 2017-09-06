<tr>
    <td>{id}</td>
    <td>{loc_nombre}</td>
    <td>
        <a href='<?=base_url()?>admin/locaciones/modificar/{id}'><img src="<?= base_url() ?>css/general/img/t.gif" class='opciones opc_modificar' title='Modificar datos de la locacion'/></a>
        <a href='#' rel="eliminar_locacion" val="{id}"><img src="<?= base_url() ?>css/general/img/t.gif" class='opciones opc_borrar' title='Eliminar locacion'/></a>
    </td>
</tr>