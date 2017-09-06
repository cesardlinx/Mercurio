<div class="titulo">Modificar tema</div>
<div class="contenido">
    <form action="<?= base_url() ?>admin/temas/actualizar" id="form_almacenar" method="post">
      <div class="contenedortabla">
          <div class="campoinfo">Nombre:</div>
          <div class="campoinput"><input name="tem_nombre" id="tem_nombre" size="52" maxlength="50"  value="<?= $tem_nombre ?>" /></div>
      </div>
        <div class="subtitulo">
            Descripción:
            <div class="barracurva"></div>
        </div>
        <div class="contenedortabla">
            <textarea class="campotextarea" name="tem_descripcion" id="tem_descripcion" cols="8" rows="5" placeholder="Ingrese la descripción del tema"><?= $tem_descripcion ?></textarea>
        </div>
    <input type="hidden" name="id" id="id" value="<?= $id ?>" />
</form>
</div>
<div class="btnpie" id="almacenar">Almacenar</div>
<script src="<?= base_url() ?>js/admin/temas.js"></script>