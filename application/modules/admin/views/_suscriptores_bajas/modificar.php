<div class="titulo">Modificar suscriptor dado de baja</div>
<div class="contenido">
    <form action="<?= base_url() ?>admin/suscriptores_bajas/actualizar" id="form_modificar" method="post">

        <div class="contenedortabla">
            <div class="campoinfo">Nombres:</div>
            <div class="campoinput"><input type="text" name="sus_nombres" id="sus_nombres" placeholder="" value="<?= $sus_nombres ?>"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Apellidos:</div>
            <div class="campoinput"><input type="text" name="sus_apellidos" id="sus_apellidos" placeholder="" value="<?= $sus_apellidos ?>"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Correo:</div>
            <div class="campoinput"><input type="text" name="sus_email" id="sus_email" placeholder="" value="<?= $sus_email ?>"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Celular:</div>
            <div class="campoinput"><input type="text" name="sus_celular" id="sus_celular" value="<?= $sus_celular ?>"/></div>
        </div>

        <div class="subtitulo">
            Razon:
            <div class="barracurva"></div>
        </div>

        <div class="contenedortabla">
            <textarea class="campotextarea" name="sus_razon_baja" id="sus_razon_baja" cols="8" rows="5" placeholder="Razon de la Baja"><?= $sus_razon_baja ?></textarea>
        </div>

        <input type="hidden" name="id" id="id" value="<?= $id ?>" />

    </form>
</div>
<div class="btnpie" id="almacenar">Almacenar</div>

<script src="<?= base_url() ?>js/admin/helper.js"></script>
<script src="<?= base_url() ?>js/admin/suscriptores_bajas.js"></script>