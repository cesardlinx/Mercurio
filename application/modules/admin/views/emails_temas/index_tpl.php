<tr>
    <td>{id}</td>
    <td>{nombre}</td>
    <td>
        <a href='<?=base_url()?>admin/emails_temas/modificar/{id}'><img src="<?= base_url() ?>css/general/img/t.gif" class='opciones opc_modificar' title='Modificar datos del email'/></a>
        <a href='#' rel="eliminar_emails_temas" val="{id}"><img src="<?= base_url() ?>css/general/img/t.gif" class='opciones opc_borrar' title='Eliminar email'/></a>
    </td>
</tr>