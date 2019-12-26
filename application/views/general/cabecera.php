<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title><?= $titulo ?></title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>css/fonts/fonts.css" />
    <link rel="stylesheet" href="<?= base_url() ?>css/general/main.css">
    <link rel="stylesheet" href="<?= base_url() ?>js/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>js/jquery-ui/jquery-ui.timepicker.css">


    <script src="<?= base_url() ?>js/jquery.min.js"></script>
    <script src="<?= base_url() ?>js/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>js/jquery-ui/jquery-ui.timepicker.js"></script>

    <script src="<?= base_url() ?>js/validate/jquery.validate.min.js"></script>
    <script src="<?= base_url() ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>js/general/general.js"></script>
  </head>
    <body>

        <input type="hidden" id="base_url" value="<?= base_url(); ?>" />

        <div class="contenedor-principal">
            <!-- Encabezado de Administración -->
            <header>
                <button type="button" id="toggle-menu-adm">
                    <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                </button>
                <a class="logo" href="<?= base_url() ?>admin">Panel de Administración</a>
                <a class="cerrar-sesion" href="<?= base_url() ?>conexion/salir">Cerrar Sesión</a>             
                <a class="bienvenida" href="#">Hola, <?= $log_nombre ?></a>
            </header>

                    
