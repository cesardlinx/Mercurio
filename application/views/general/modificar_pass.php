<?php
$password_seguro = $this->load->view('admin/usuarios/password_seguro', array(), true);
$log_usu_id = $this->session->userdata('log_usu_id');
?>
<div class="titulo">
   CAMBIO DE CONTRASEÑA
</div>
<div class="contenido">

    <form action="<?= base_url() ?>admin/usuarios/actualizar_password" id="form_usuarios" method="post">
        <div class="contenedortabla">
            <div class="campoinfo">Nueva contraseña:</div>
            <div class="campoinput"><input name="usu_contrasena" type="password" id="usu_contrasena" size="50" maxlength="200" placeholder="Ingrese nueva contraseña"/><span id="alert"></span><?= $password_seguro ?></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Repetir contraseña:</div>
            <div class="campoinput"><input name="usu_rep_contrasena" type="password" id="usu_rep_contrasena" size="50" maxlength="200" placeholder="Repita la contraseña"/><span id="alert"></span><?= $password_seguro ?></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Mostrar contraseña:</div>
            <div class="campoinput">
                <input type="checkbox" id="ver_contrasena" value="false" />
            </div>
        </div>
        <input type="hidden" name="usu_id"  id="usu_id" value="<?= $log_usu_id ?>"/>
    </form>    

    <script src="<?= base_url() ?>js/admin/actualizar_password.js"></script>
    <script src="<?= base_url() ?>js/admin/password_seguro.js"></script>
</div>
<div class="btnpie" id="usu_almacenar">Almacenar</div>
