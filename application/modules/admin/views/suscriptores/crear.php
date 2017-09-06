<div class="titulo">Crear suscriptor</div>
<div class="contenido myScroll">
    <?php
    $atributos = array('id' => 'form_suscriptores');
    echo form_open('admin/suscriptores/almacenar', $atributos);
    ?>
    <div class="contenedortabla">
        <div class="campoinfo">Nombres:</span></div>
        <div class="campoinput"><input type="text" name="sus_nombres" id="sus_nombres" placeholder="" /></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Apellidos:</span></div>
        <div class="campoinput"><input type="text" name="sus_apellidos" id="sus_apellidos" placeholder="" /></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Correo:</span></div>
        <div class="campoinput"><input type="text" name="sus_email" id="sus_email" placeholder="" /></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Celular:</span></div>
        <div class="campoinput"><input type="text" name="sus_celular" id="sus_celular" placeholder="" /></div>
    </div>
    <?php echo form_close() ?>
</div>
<div class="btnpie" id="almacenar">Almacenar</div>
<script src="<?= base_url() ?>js/admin/suscriptores.js"></script>
