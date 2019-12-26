<div class="titulo">Modificar archivo</div>
<div class="contenido">
    <form action="<?= base_url() ?>admin/archivos/actualizar" id="form_modificar" method="post" enctype="multipart/form-data">

        <div class="contenedortabla">
            <div class="campoinfo">Usuario:</div>
            <div class="camposelect_cm"><?= $cmb_usuarios ?></div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Archivo:</div>
            <div class=""><input type="file" name="archivo" id="archivo" maxlength="100"/></div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">De que:</div>
            <div class="camposelect_cm"><?= $arc_combo ?></div>
        </div>

        <input type="hidden" name="arc_fecha" value="<?= hoy('c'); ?>">

        <input type="hidden" name="id" id="id" value="<?= $id ?>" />

    </form>
</div>
<div class="btnpie" id="almacenar">Almacenar</div>

<script src="<?= base_url() ?>js/admin/helper.js"></script>
<script src="<?= base_url() ?>js/admin/archivos.js"></script>