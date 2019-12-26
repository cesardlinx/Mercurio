<div class="titulo">Crear usuario</div>
<div class="contenido myScroll">
    <?php
    $atributos = array('id' => 'form_usuarios');
    echo form_open('admin/usuarios/almacenar', $atributos);
    ?>
    <div class="contenedortabla">
        <div class="campoinfo">Nombres:</span></div>
        <div class="campoinput"><input type="text" name="usu_nombres" id="usu_nombres" placeholder="" /></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Apellidos:</span></div>
        <div class="campoinput"><input type="text" name="usu_apellidos" id="usu_apellidos" placeholder="" /></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Correo:</span></div>
        <div class="campoinput"><input type="text" name="usu_email" id="usu_email" placeholder="" /><span id="alert"></span></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Contraseña:</span></div>
        <div class="campoinput"><input type="password" name="usu_contrasena" id="usu_contrasena" placeholder="" /><?= $password_seguro ?></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Administrador:</span></div>
        <div class="campoinput">
            <input type="radio" name="usu_adm" id="usu_adm" value="n" checked/>No
            <input type="radio" name="usu_adm" id="usu_adm" value="s"/>Si
        </div>
    </div>
    <div class="subtitulo">
        Hoja de vida:
        <div class="barracurva"></div>
    </div>
    <div class="contenedortabla">
        <textarea class="campotextarea" name="usu_hojavida" id="usu_hojavida"  placeholder=""></textarea>
    </div>
    <?php echo form_close() ?>
</div>
<div class="btnpie" id="usu_almacenar">Almacenar</div>
<script src="<?= base_url() ?>js/admin/usuarios.js"></script>
<script src="<?= base_url() ?>js/admin/password_seguro.js"></script>