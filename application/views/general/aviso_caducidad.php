<?php
$data["estilo_adicional"] = "<link rel='stylesheet' href='" . base_url() . "css/general/estilos_inicio.css' media='screen' />";
$this->load->view('general/header', $data);
$password_seguro = $this->load->view('admin/usuarios/password_seguro', array(), true);
$log_usu_id = $this->session->userdata('log_usu_id');
migaPan();
?>
<div id="contenedor">
    <div class="cabecera">
        <div class="logomai">
            <a href="<?= base_url(); ?>"><img class="logomaiimg" src="<?= base_url(); ?>css/general/img/t.gif"></a>
        </div>
        <div class="continfousuario">
            <div class="menu_inicio">
                <a href="<?= base_url() . "general/avisocad"; ?>"><img class="ico_general ico_inicio" src="<?= base_url(); ?>css/general/img/t.gif" title="Inicio"></a>
                <a href="<?= base_url() . "general/avisocad"; ?>"><img class="ico_general ico_ayuda" src="<?= base_url(); ?>css/general/img/t.gif" title="Solicitar ayuda"></a>
                <a href="<?= base_url() . "conexion/salir"; ?>"><img class="ico_general ico_exit" src="<?= base_url(); ?>css/general/img/t.gif" title="Salir del MAI"></a>
            </div>
            <?php infoUsuario() ?>
            <div class="miga">
                <div class="migabarra"></div>
                <div class="migainfo"><?php echo $this->breadcrumbcomponent->output(); ?></div>
            </div>
        </div>
    </div>

    <div class="titulo">
        AVISO DE SEGURIDAD
    </div>
    <div class="contenido">
        <center>
            <h2>SU CONTRASEÑA HA CADUCADO,INGRESE UNA NUEVA</h2>
        </center>
        <form action="<?= base_url() ?>admin/usuarios/actualizar_password" id="form_usuarios" method="post">
            <div class="contenedortabla">
                <div class="campoinfo">Nueva contraseña:</div>
                <div class="campoinput"><input type="password" name="usu_contrasena" id="usu_contrasena" size="30" maxlength="200" placeholder="Ingrese nueva contraseña"/><span id="alert"></span><?= $password_seguro ?></div>
            </div>
            <div class="contenedortabla">
                <div class="campoinfo">Repetir contraseña:</div>
                <div class="campoinput"><input type="password" name="usu_rep_contrasena" id="usu_rep_contrasena" size="30" maxlength="200" placeholder="Repita la contraseña"/><span id="alert"></span><?= $password_seguro ?></div>
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
