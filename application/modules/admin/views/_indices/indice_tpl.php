<tr>
    <td>{id}</td>
    <td>{nombre}</td>

    <td>
        <a href='<?=base_url()?>admin/{seccion}s/modificar/{id}'><img src="<?= base_url() ?>css/general/img/t.gif" class='opciones opc_modificar' title='Modificar datos del {seccion}'/></a>
        <a href='#' rel="eliminar_{seccion}s" val="{id}"><img src="<?= base_url() ?>css/general/img/t.gif" class='opciones opc_borrar' title='Eliminar {seccion}'/></a>
    </td>
</tr>