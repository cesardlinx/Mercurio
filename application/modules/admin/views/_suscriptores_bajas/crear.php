<div class='titulo'>Dar de baja a suscriptor</div>
<div class="contenido">
    <form action="<?= base_url() ?>admin/suscriptores_bajas/almacenar" id="form_almacenar" method="post">

        <div class="contenedortabla">
            <div class="campoinfo">Suscriptor a dar de baja:</div>
            <div class="camposelect_cm">
                <?= $combo_suscriptores ?>
            </div>
        </div>

        <div class="subtitulo">
            Razon:
            <div class="barracurva"></div>
        </div>

        <div class="contenedortabla">
            <textarea class="campotextarea" name="sus_razon_baja" id="sus_razon_baja" cols="8" rows="5" placeholder="Razon de la Baja"></textarea>
        </div>


        <input type="hidden" name="sus_fecha_baja" value="<?= hoy('c'); ?>">       
    </form>
</div>
<div class="btnpie" id="almacenar">Almacenar</div>

<script src="<?= base_url() ?>js/admin/helper.js"></script>
<script src="<?= base_url() ?>js/admin/suscriptores_bajas.js"></script>
