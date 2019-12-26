<link href="<?= base_url() ?>css/chosen.css" rel="stylesheet">
<div class='titulo'>Crear nuevo evento</div>
<div class="contenido myScroll">
    <form action="<?= base_url() ?>admin/eventos/almacenar" id="form_almacenar" method="post">
        <div class="contenedortabla">
            <div class="campoinfo">Título:</div>
            <div class="campoinput"><input name="eve_titulo" id="eve_titulo" maxlength="40"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Subtítulo:</div>
            <div class="campoinput"><input name="eve_subtitulo" id="eve_subtitulo" maxlength="100"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Duración:</div>
            <div class="campoinput"><input name="eve_duracion" id="eve_duracion" maxlength="100"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Lugar:</div>
            <div class="campoinput"><input name="eve_lugar" id="eve_lugar" maxlength="100"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Fechas y horarios:</div>
            <div class="campoinput"><input name="eve_fechasHorarios" id="eve_fechasHorarios" maxlength="100"/></div>
        </div>
        <div class="contenedortabla">
            <div class="campoinfo">Costo:</div>
            <div class="campoinput_xs"><input name="eve_costo" id="eve_costo" maxlength="100"/></div>
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
            <div class="campoinfo">Conferencista:</span></div>
            <div class="camposelect_cm"> <?= $cmb_usuarios ?></div>
        </div>
        <div class="subtitulo">
            Descripción:
            <div class="barracurva"></div>
        </div>
        <div class="contenedortabla">
            <textarea class="campotextarea" name="eve_descripcion" id="eve_descripcion" cols="8" rows="5" placeholder="Ingrese la descripción del evento"></textarea>
        </div>
        <div class="subtitulo">
            Contenido:
            <div class="barracurva"></div>
        </div>
        <div class="contenedortabla">
            <textarea class="campotextarea" name="eve_contenido" id="eve_contenido" cols="8" rows="5" placeholder="Ingrese lel contenido del evento"></textarea>
        </div>
        <div class="subtitulo">
            Objetivos:
            <div class="barracurva"></div>
        </div>
        <div class="contenedortabla">
            <textarea class="campotextarea" name="eve_objetivos" id="eve_objetivos" cols="8" rows="5" placeholder="Ingrese"></textarea>
        </div>
        <div class="subtitulo">
            Dirigido:
            <div class="barracurva"></div>
        </div>
        <div class="contenedortabla">
            <textarea class="campotextarea" name="eve_dirigido" id="eve_dirigido" cols="8" rows="5" placeholder="Ingrese"></textarea>
        </div>
        <div class="subtitulo">
            Observaciones:
            <div class="barracurva"></div>
        </div>
        <div class="contenedortabla">
            <textarea class="campotextarea" name="eve_observaciones" id="eve_observaciones" cols="8" rows="5" placeholder="Ingrese las observaciones del evento"></textarea>
        </div>


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


