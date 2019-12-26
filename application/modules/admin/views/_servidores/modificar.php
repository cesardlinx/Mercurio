<div class="titulo">Modificar datos de servidor</div>
<div class="contenido">
    <form action="<?= base_url() ?>admin/servidores/actualizar" id="form_almacenar" method="post">
        <div class="contenedortabla">
            <div class="campoinfo">Autenticación SMTP:</div>
            <div class="camposelect_cm">
                <?= $combo_auth ?>
            </div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Sistema de Encriptacion:</div>
            <div class="camposelect_cm">
                <?= $combo_sec ?>                
            </div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Servidor:</div>
            <div class="campoinput"><input type="text" name="con_smtp_host" id="con_smtp_host" maxlength="100" value="<?= $con_smtp_host ?>" /></div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Usuario SMTP:</div>
            <div class="campoinput"><input type="text" name="con_smtp_user" id="con_smtp_user" maxlength="100" value="<?= $con_smtp_user ?>" /></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Contraseña SMTP:</div>
            <div class="campoinput"><input type="password" name="con_smtp_pass" id="con_smtp_pass" maxlength="100" value="<?= $con_smtp_pass ?>" /><?=$password_seguro?></div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Puerto TCP:</div>
            <div class="campoinput_xs"><input type="text" name="con_smtp_port" id="con_smtp_port" maxlength="100" value="<?= $con_smtp_port ?>" /></div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">From:</div>
            <div class="campoinput"><input type="text" name="con_smtp_from" id="con_smtp_from" maxlength="100" value="<?= $con_smtp_from ?>" /></div>
        </div>

        <input type="hidden" name="id" id="id" value="<?= $id ?>" />      

    </form>
</div>
<div class="btnpie" id="almacenar">Almacenar</div>

<script src="<?= base_url() ?>js/admin/helper.js"></script>
<script src="<?= base_url() ?>js/admin/servidores.js"></script>