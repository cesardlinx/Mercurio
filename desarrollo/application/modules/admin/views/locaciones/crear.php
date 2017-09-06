<div class='titulo'>Crear nueva locacion</div>
<div class="contenido">
    <form action="<?= base_url() ?>admin/locaciones/almacenar" id="form_almacenar" method="post">
        <div class="contenedortabla">
            <div class="campoinfo">Nombre:</div>
            <div class="campoinput"><input name="loc_nombre" id="loc_nombre" maxlength="100"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Dirección:</div>
            <div class="campoinput"><input name="loc_direccion" id="loc_direccion" maxlength="200"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Teléfonos:</div>
            <div class="campoinput"><input name="loc_telefonos" id="loc_telefonos" maxlength="200"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Coordenadas:</div>
            <div class="campoinput"><input name="loc_coordenadas" id="loc_coordenadas" maxlength="200"/></div>
        </div>
    
</form>
</div>
<div class="btnpie" id="almacenar">Almacenar</div>
<script src="<?= base_url() ?>js/admin/locaciones.js"></script>