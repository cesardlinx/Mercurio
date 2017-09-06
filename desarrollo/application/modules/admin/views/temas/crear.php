<div class='titulo'>Crear nuevo tema</div>
<div class="contenido">
    <form action="<?= base_url() ?>admin/temas/almacenar" id="form_almacenar" method="post">
        <div class="contenedortabla">
            <div class="campoinfo">Nombre:</div>
            <div class="campoinput"><input name="tem_nombre" id="tem_nombre" maxlength="100"/></div>
        </div>
        <div class="subtitulo">
            Descripción:
            <div class="barracurva"></div>
        </div>
        <div class="contenedortabla">
            <textarea class="campotextarea" name="tem_descripcion" id="tem_descripcion" cols="8" rows="5" placeholder="Ingrese la descripción del tema"></textarea>
        </div>
    
</form>
</div>
<div class="btnpie" id="almacenar">Almacenar</div>
<script src="<?= base_url() ?>js/admin/temas.js"></script>