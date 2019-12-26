<div class="titulo">Modificar locación</div>
<div class="contenido">
    <form action="<?= base_url() ?>admin/locaciones/actualizar" id="form_almacenar" method="post">
      <div class="contenedortabla">
          <div class="campoinfo">Nombre:</div>
          <div class="campoinput"><input name="loc_nombre" id="loc_nombre" size="52" maxlength="50"  value="<?= $loc_nombre ?>" /></div>
      </div>
        <div class="contenedortabla">
            <div class="campoinfo">Dirección:</div>
            <div class="campoinput"><input name="loc_direccion" id="loc_direccion" maxlength="200" value="<?= $loc_direccion ?>"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Teléfonos:</div>
            <div class="campoinput"><input name="loc_telefonos" id="loc_telefonos" maxlength="200" value="<?= $loc_telefonos ?>"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Coordenadas:</div>
            <div class="campoinput"><input name="loc_coordenadas" id="loc_coordenadas" maxlength="200" value="<?= $loc_coordenadas ?>"/></div>
        </div>
    <input type="hidden" name="id" id="id" value="<?= $id ?>" />
</form>
</div>
<div class="btnpie" id="almacenar">Almacenar</div>
<script src="<?= base_url() ?>js/admin/locaciones.js"></script>