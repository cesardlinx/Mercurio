<div class="titulo">Modificar fecha</div>
<div class="contenido">
    <form action="<?= base_url() ?>admin/fechas/actualizar" id="form_almacenar" method="post">

        <div class="contenedortabla">
            <div class="campoinfo">Evento:</div>
            <div class="camposelect_cm">
                <?= $combo_eventos ?>
            </div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Fecha:</div>
            <div class=""><input type="date" name="eve_fecha" id="eve_fecha" maxlength="100" value="<?= $eve_fecha ?>" /></div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Hora de Inicio:</div>
            <div class=""><input type="time" name="eve_inicia" id="eve_inicia" maxlength="100" value="<?= $eve_inicia ?>" /></div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Hora de Fin:</div>
            <div class=""><input type="time" name="eve_termina" id="eve_termina" maxlength="100" value="<?= $eve_termina ?>" /></div>
        </div>

        <input type="hidden" name="id" id="id" value="<?= $id ?>" />

    </form>
</div>
<div class="btnpie" id="almacenar">Almacenar</div>

<script src="<?= base_url() ?>js/admin/helper.js"></script>
<script src="<?= base_url() ?>js/admin/fechas.js"></script>