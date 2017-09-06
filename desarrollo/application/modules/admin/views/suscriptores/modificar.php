<div class="titulo">Modificar suscriptor</div>
<div class="contenido myScroll">
    <?php
    $atributos = array('id' => 'form_suscriptores');
    echo form_open('admin/suscriptores/actualizar', $atributos);
    ?>
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
    <input type="hidden" name="sus_id" id="sus_id" value="<?= $id ?>"/>
    <?php echo form_close() ?>
</div>
<div class="btnpie" id="actualizar">Actualizar</div>
<script src="<?= base_url() ?>js/admin/suscriptores.js"></script>


