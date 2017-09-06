<tr>
    <td>{id}</td>
    <td>{tem_nombre}</td>
    <td>
        <a href='<?=base_url()?>admin/temas/modificar/{id}'><img src="<?= base_url() ?>css/general/img/t.gif" class='opciones opc_modificar' title='Modificar datos del tema'/></a>
        <a href='<?=base_url()?>admin/temas/eliminar/{id}' rel="eliminar_tema" val="{id}"><img src="<?= base_url() ?>css/general/img/t.gif" class='opciones opc_borrar' title='Eliminar tema'/></a>
    </td>
</tr>