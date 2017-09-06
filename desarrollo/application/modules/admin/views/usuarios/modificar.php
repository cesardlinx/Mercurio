<div class="titulo">Modificar usuario</div>
<div class="contenido myScroll">
    <?php
    $atributos = array('id' => 'form_usuarios_mod');
    echo form_open('admin/usuarios/actualizar', $atributos);
    ?>
    <div class="contenedortabla">
        <div class="campoinfo">Nombres:</div>
        <div class="campoinput"><input type="text" name="usu_nombres" id="usu_nombres" placeholder="" value="<?= $usu_nombres ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Apellidos:</div>
        <div class="campoinput"><input type="text" name="usu_apellidos" id="usu_apellidos" placeholder="" value="<?= $usu_apellidos ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Correo:</div>
        <div class="campoinput"><input type="text" name="usu_email" id="usu_email" placeholder="" value="<?= $usu_email ?>"/><span id="alert"></span></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Contraseña:</div>
        <div class="campoinput"><input type="password" name="usu_contrasena" id="usu_contrasena" value="<?= $usu_contrasena ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Administrador:</div>
        <div class="campoinput"><input type="radio" name="usu_adm" id="usu_adm" value="n" <?php if ($usu_adm == 'n') echo "checked"; ?>/>No
            <input type="radio" name="usu_adm" value="s" <?php if ($usu_adm == 's') echo "checked"; ?>/>Si
        </div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Activo:</div>
        <div class="campoinput"><input type="checkbox" name="usu_activo" id="usu_activo" value="s" <?php if ($usu_activo == 's') echo "checked"; ?>/></div>
    </div>
    <div class="subtitulo">
        Hoja de vida:
        <div class="barracurva"></div>
    </div>
    <div class="contenedortabla">
        <textarea class="campotextarea" name="usu_hojavida" id="usu_hojavida"  placeholder=""><?= $usu_hojavida ?></textarea>
    </div>
    <input type="hidden" name="usu_id" id="usu_id" value="<?= $id ?>"/>
    <input type="hidden" name="deque" id="deque" value="m"/>
    <?php echo form_close() ?>
</div>
<div class="btnpie" id="usu_actualizar">Actualizar</div>
<script src="<?= base_url() ?>js/admin/usuarios.js"></script>
<script src="<?= base_url() ?>js/admin/password_seguro.js"></script>

