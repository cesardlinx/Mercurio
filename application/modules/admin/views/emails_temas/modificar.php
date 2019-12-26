<div class="titulo">Modificar email de tema</div>
<div class="contenido">
    <form action="<?= base_url() ?>admin/emails_temas/actualizar" id="form_almacenar" method="post">

        <div class="contenedortabla">
            <div class="campoinfo">Suscriptor:</div>
            <div class="camposelect_cm">
                <?= $combo_suscriptores ?>
            </div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Tema:</div>
            <div class="camposelect_cm">
                <?= $combo_temas ?>
            </div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Asunto:</div>
            <div class="campoinput"><input type="text" name="eml_asunto" id="eml_asunto" maxlength="100" value="<?= $eml_asunto ?>" /></div>
        </div>


        <div class="contenedortabla">
            <div class="campoinfo">Fecha de Envío:</div>
            <div class="">
                <input type="date" name="eml_fecha_envio" id="eml_fecha_envio" maxlength="100" value="<?= $eml_fecha_envio ?>"/>
                <input type="time" name="eml_hora_envio" id="eml_hora_envio" maxlength="100" value="<?= $eml_hora_envio ?>"/>
            </div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Estado:</div>
            <div class="camposelect_cm">
                <?= $combo_estado ?>
            </div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Servidor:</div>
            <div class="camposelect_cm">
                <?= $combo_servidores ?>
            </div>
        </div>

        <div class="subtitulo">
            Contenido:
            <div class="barracurva"></div>
        </div>

        <div class="contenedortabla">
            <textarea class="campotextarea" name="eml_contenido" id="eml_contenido" cols="8" rows="5" placeholder="Ingrese el contenido del email"><?= $eml_contenido ?></textarea>
        </div>

        <div class="subtitulo">
            Error:
            <div class="barracurva"></div>
        </div>

        <div class="contenedortabla">
            <textarea class="campotextarea" name="eml_error" id="eml_error" cols="8" rows="5" placeholder="Error"><?= $eml_error ?></textarea>
        </div>

        <input type="hidden" name="id" id="id" value="<?= $id ?>" />

    </form>
</div>
<div class="btnpie" id="almacenar">Almacenar</div>

<script src="<?= base_url() ?>js/admin/helper.js"></script>
<script src="<?= base_url() ?>js/admin/emails_temas.js"></script>