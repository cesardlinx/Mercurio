<?php
//$data["estilo_adicional"] = "<link rel='stylesheet' href='" . base_url() . "css/general/estilos_inicio.css' media='screen' />";
$this->load->view('general/header');
?>
<div id="contenedor">
    <div class="cabecera">
        <div class="logomai">
            <!--<a href="<?= base_url(); ?>"><img class="logomaiimg" src="<?= base_url(); ?>css/general/img/t.gif"></a>-->
        </div>
        <div class="continfousuario">
            <div class="menu_inicio">
                <a href="<?= base_url() . "conexion/salir"; ?>"><img class="ico_general ico_exit" src="<?= base_url(); ?>css/general/img/t.gif" title="Salir"></a>
            </div>
        </div>
    </div>