<link href="<?= base_url(); ?>css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
<div class="titulo">Relacionar usuario con áreas</div>
<div class="contenido">
    <?php
    $atributos = array('id' => 'form_usuarios_rel');
    echo form_open('admin/usuarios/alm_rel_usu_areas', $atributos);
    ?>
   <div class="contenedortabla">
        <div class="campoinfo">Usuario:</div>
        <div class="campoinput"><input type="text" name="usu_nombres" id="usu_nombres" value="<?= $usuario ?>" disabled="true"/></div>
    </div>
    <div class="contenedortabla">
        <table class="tbl_multiple">
            <tbody>
                <tr>
                    <th colspan="2">Áreas</th>
                </tr>
                <tr>
                    <td colspan="2"><?= $combo ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <input type="hidden" name="usu_id" id="usu_id" value="<?= $id ?>">
    <?php echo form_close() ?>
</div>
<div class="btnpie" id="usu_almacenar_rel">Almacenar</div>
<script src="<?= base_url(); ?>js/multiselect/jquery.multi-select.js"></script>
<script src="<?= base_url(); ?>js/multiselect/jquery.quicksearch.js"></script>
<script src="<?= base_url(); ?>js/multiselect/script.js"></script>
<script src="<?= base_url() ?>js/admin/usuarios.js"></script>
