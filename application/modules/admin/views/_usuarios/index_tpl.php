<tr>
    <td>{id}</td>
    <td>{estado} {usu_nombres} {usu_apellidos}</td>
    <td>{usu_email}</td>
    <td align="center">
       <!-- <?php if ($id != 1): ?> -->
            <a href="<?= base_url() ?>admin/usuarios/modificar/{id}"><img class="opciones opc_modificar" src="<?= base_url(); ?>css/general/img/t.gif" title="Modificar"></a>
            <a href="<?= base_url() ?>admin/usuarios/eliminar/{id}" class="eliminar"><img class="opciones opc_borrar" src="<?= base_url(); ?>css/general/img/t.gif" title="Desactivar usuario"></a>
       <!-- <?php endif; ?> -->

    </td>
</tr>       