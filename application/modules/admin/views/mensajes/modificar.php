<div class="titulo">Modificar mensaje</div>
<div class="contenido">
    <form action="<?= base_url() ?>admin/mensajes/actualizar" id="form_almacenar" method="post" >


        <div class="contenedortabla">
            <div class="campoinfo">Título:</div>
            <div class="campoinput"><input type="text" name="msj_titulo" id="msj_titulo" maxlength="100" value="<?= $msj_titulo ?>" /></div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Tema:</div>
            <div class="camposelect_cm">
                <?= $combo_temas ?>
            </div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Estado:</div>
            <div class="camposelect_cm">
                <?= $combo_estado ?>
            </div>
        </div>
        
        <div class="subtitulo">
            Descripción:
            <div class="barracurva"></div>
        </div>

        <div class="contenedortabla">
            <textarea class="campotextarea" name="msj_descripcion" id="msj_descripcion" cols="8" rows="5" placeholder="Ingrese la descripción del mensaje"><?= $msj_titulo ?></textarea>
        </div>

        <input type="hidden" name="id" id="id" value="<?= $id ?>" />

    </form>
</div>
<div class="btnpie" id="almacenar">Almacenar</div>

<script src="<?= base_url() ?>js/admin/helper.js"></script>
<script src="<?= base_url() ?>js/admin/mensajes.js"></script>