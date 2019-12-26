<div class='titulo'>Ingresar nuevo servidor</div>
<div class="contenido">
    <form action="<?= base_url() ?>admin/servidores/almacenar" id="form_almacenar" method="post">

        <div class="contenedortabla">
            <div class="campoinfo">Autenticación SMTP:</div>
            <div class="camposelect_cm">
                <select name="con_smtp_auth" id="con_smtp_auth">
                    <option value="0">Deshabilitada</option>
                    <option value="1" selected>Habilitada</option>
                </select>
            </div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Sistema de Encriptacion:</div>
            <div class="camposelect_cm">
                <select name="con_smtp_sec" id="con_smtp_sec">
                    <option value="ssl">SSL</option>
                    <option value="tls" selected>TLS</option>
                </select>
            </div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Servidor:</div>
            <div class="campoinput"><input type="text" name="con_smtp_host" id="con_smtp_host" maxlength="100"/></div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Usuario SMTP:</div>
            <div class="campoinput"><input type="text" name="con_smtp_user" id="con_smtp_user" maxlength="100"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Contraseña SMTP:</div>
            <div class="campoinput"><input type="password" name="con_smtp_pass" id="con_smtp_pass" maxlength="100"/><?=$password_seguro?></div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">Puerto TCP:</div>
            <div class="campoinput_xs"><input type="text" name="con_smtp_port" id="con_smtp_port" maxlength="100"/></div>
        </div>

        <div class="contenedortabla">
            <div class="campoinfo">From:</div>
            <div class="campoinput"><input type="text" name="con_smtp_from" id="con_smtp_from" maxlength="100"/></div>
        </div>      

    </form>
</div>
<div class="btnpie" id="almacenar">Almacenar</div>

<script src="<?= base_url() ?>js/admin/helper.js"></script>
<script src="<?= base_url() ?>js/admin/servidores.js"></script>