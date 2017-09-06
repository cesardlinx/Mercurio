<link href="<?= base_url() ?>css/chosen.css" rel="stylesheet">
<div class="titulo">Modificar tema</div>
<div class="contenido myScroll">
    <form action="<?= base_url() ?>admin/eventos/actualizar" id="form_almacenar" method="post">
      <div class="contenedortabla">
            <div class="campoinfo">Título:</div>
            <div class="campoinput"><input name="eve_titulo" id="eve_titulo" maxlength="40" value="<?= $eve_titulo ?>"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Subtítulo:</div>
            <div class="campoinput"><input name="eve_subtitulo" id="eve_subtitulo" maxlength="100" value="<?= $eve_subtitulo ?>"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Duración:</div>
            <div class="campoinput"><input name="eve_duracion" id="eve_duracion" maxlength="100" value="<?= $eve_duracion ?>"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Lugar:</div>
            <div class="campoinput"><input name="eve_lugar" id="eve_lugar" maxlength="100" value="<?= $eve_lugar ?>"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Fechas y horarios:</div>
            <div class="campoinput"><input name="eve_fechasHorarios" id="eve_fechasHorarios" maxlength="100" value="<?= $eve_fechasHorarios ?>"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Costo:</div>
            <div class="campoinput_xs"><input name="eve_costo" id="eve_costo" maxlength="100" value="<?= $eve_costo ?>"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Locación:</span></div>
            <div class="camposelect_cm"> <?= $cmb_locaciones ?></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Tema:</span></div>
            <div class="camposelect_cm"> <?= $cmb_temas ?></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Conferrencista:</span></div>
            <div class="camposelect_cm"> <?= $cmb_usuarios ?></div>
        </div>
        <div class="subtitulo">
            Descripción:
            <div class="barracurva"></div>
        </div>
        <div class="contenedortabla">
            <textarea class="campotextarea" name="eve_descripcion" id="eve_descripcion" cols="8" rows="5" placeholder="Ingrese la descripción del evento"><?= $eve_descripcion ?></textarea>
        </div>
        <div class="subtitulo">
            Contenido:
            <div class="barracurva"></div>
        </div>
        <div class="contenedortabla">
            <textarea class="campotextarea" name="eve_contenido" id="eve_contenido" cols="8" rows="5" placeholder="Ingrese lel contenido del evento"><?= $eve_contenido ?></textarea>
        </div>
        <div class="subtitulo">
            Objetivos:
            <div class="barracurva"></div>
        </div>
        <div class="contenedortabla">
            <textarea class="campotextarea" name="eve_objetivos" id="eve_objetivos" cols="8" rows="5" placeholder="Ingrese"><?= $eve_objetivos ?></textarea>
        </div>
        <div class="subtitulo">
            Dirigido:
            <div class="barracurva"></div>
        </div>
        <div class="contenedortabla">
            <textarea class="campotextarea" name="eve_dirigido" id="eve_dirigido" cols="8" rows="5" placeholder="Ingrese"><?= $eve_dirigido ?></textarea>
        </div>
        <div class="subtitulo">
            Observaciones:
            <div class="barracurva"></div>
        </div>
        <div class="contenedortabla">
            <textarea class="campotextarea" name="eve_observaciones" id="eve_observaciones" cols="8" rows="5" placeholder="Ingrese las observaciones del evento"><?= $eve_observaciones ?></textarea>
        </div>
    <input type="hidden" name="id" id="id" value="<?= $id ?>" />
</form>
</div>
<div class="btnpie" id="almacenar">Almacenar</div>
<script src="<?= base_url() ?>js/choseen/chosen.jquery.js"></script>
<script src="<?= base_url() ?>js/choseen/gofrendi.chosen.ajaxify.js"></script>
<script src="<?= base_url() ?>js/admin/eventos.js"></script>
<script>

    $('#usu_id_conferencista').chosen({allow_single_deselect: true, width: "100%", search_contains: true});
    // And this one is how you add AJAX capability
    chosen_ajaxify('usu_id_conferencista', "<?= base_url() ?>admin/usuarios/buscar?keyword=");

</script>