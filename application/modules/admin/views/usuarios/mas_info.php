<link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/jquery-clockpicker.min.css">
<script type="text/javascript" src="<?= base_url() ?>js/jquery-clockpicker.min.js"></script>
<script>
    $(document).ready(function() {
        $("input[rel='hora']").clockpicker({
            placement: 'top',
            autoclose: true,
        });
        $("input[rel='hora']").attr('readonly', 'true');
    });
</script>

<div class="titulo">Más información de <?=nomApeUsuario($id);?></div>
<div class="contenido myScroll">
    <?php
    $atributos = array('id' => 'form_usuarios_mas_info');
    echo form_open('admin/usuarios/actualizar_mas_info', $atributos);
    ?>
    <div class="contenedortabla">
        <div class="campoinfo">Cédula:</div>
        <div class="campoinput_xs"><input type="text" name="usu_cedula" id="usu_cedula" value="<?= $usu_cedula ?>"/><span id='alertc'></span></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Fecha de nacimiento:</div>
        <div class="campoinput_xs"><input type="text" name="usu_fecha_nacimiento" id="fecha" rel="fecha" value="<?= $usu_fecha_nacimiento ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Edad:</div>
        <div class="campoinput_xs"><span id="calculoEdad"/></span><input type="hidden" name="usu_edad" id="usu_edad" value="<?= $edad ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Discapacitado:</div>
        <div class="campoinput"><input type="radio" name="usu_discapacitado" id="usu_discapacitado" value="s" <?php if ($usu_discapacitado == 's') echo "checked"; ?>/>Si
            <input type="radio" name="usu_discapacitado" id="usu_discapacitado" value="n" <?php if ($usu_discapacitado == 'n') echo "checked"; ?>/>No
        </div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Procedencia:</div>
        <div class="campoinput"><input type="text" name="usu_procedencia" id="usu_procedencia" value="<?= $usu_procedencia ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Natural de:</div>
        <div class="campoinput"><input type="text" name="usu_naturalde" id="usu_naturalde" value="<?= $usu_naturalde ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Estado civil:</div>
        <div class="campoinput"><input type="radio" name="usu_estado_civil" id="usu_estado_civil" value="s" <?php if ($usu_estado_civil == 's') echo "checked"; ?>/>Soltero
            <input type="radio" name="usu_estado_civil" id="usu_estado_civil" value="c" <?php if ($usu_estado_civil == 'c') echo "checked"; ?>/>Casado
            <input type="radio" name="usu_estado_civil" id="usu_estado_civil" value="d" <?php if ($usu_estado_civil == 'd') echo "checked"; ?>/>Divorciado
            <input type="radio" name="usu_estado_civil" id="usu_estado_civil" value="u" <?php if ($usu_estado_civil == 'u') echo "checked"; ?>/>Unión libre
            <input type="radio" name="usu_estado_civil" id="usu_estado_civil" value="v" <?php if ($usu_estado_civil == 'v') echo "checked"; ?>/>Viudo
        </div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Dirección:</div>
        <div class="campoinput"><input type="text" name="usu_direccion" id="usu_direccion" value="<?= $usu_direccion ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Referencia:</div>
        <div class="campoinput"><input type="text" name="usu_dir_ref" id="usu_dir_ref" value="<?= $usu_dir_ref ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Provincia:</div>
        <div class="campoinput"><input type="text" name="usu_provincia" id="usu_provincia" value="<?= $usu_provincia ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Ciudad:</div>
        <div class="campoinput"><input type="text" name="usu_ciudad" id="usu_ciudad" value="<?= $usu_ciudad ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Sector:</div>
        <div class="campoinput"><input type="text" name="usu_sector" id="usu_sector" value="<?= $usu_sector ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Teléfono:</div>
        <div class="campoinput_xs"><input type="text" name="usu_telefono" id="usu_telefono" value="<?= $usu_telefono ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Escolaridad:</div>
        <div class="campoinput"><input type="text" name="usu_escolaridad" id="usu_escolaridad" value="<?= $usu_escolaridad ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo" title="Fecha en que empezó a trabajar">Fecha que empezó:</div>
        <div class="campoinput_xs"><input type="text" name="usu_edad_et" id="fecha2" rel="fecha" value="<?= $usu_edad_et ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Tiempo de trabajo:</div>
        <div class="campoinput_xs"><span id="calculoEdad_et"/></span><input type="hidden" name="edad_et" id="edad_et" value="<?= $edad_et ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Profesión/oficio:</div>
        <div class="campoinput"><input type="text" name="usu_profesion" id="usu_profesion" value="<?= $usu_profesion ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Ocupación:</div>
        <div class="campoinput"><input type="text" name="usu_ocupacion" id="usu_ocupacion" value="<?= $usu_ocupacion ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Fecha inicio cargo:</div>
        <div class="campoinput_xs"><input type="text" name="usu_tiempo_cargo" id="fecha_cargo" rel="fecha" value="<?= $usu_tiempo_cargo ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Tiempo en cargo:</div>
        <div class="campoinput_xs"><span id="calculoEdad_cargo"/></span><input type="hidden" name="tiempo_cargo" id="tiempo_cargo" value="<?= $tiempo_cargo ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Horario regular de trabajo:</div>
        <div class="campoinput_xs">De:<input type="text" name="usu_hora_ini" id="usu_hora_ini" rel="hora" value="<?= $usu_hora_ini ?>"/> A:<input type="text" name="usu_hora_fin" id="usu_hora_fin" rel="hora" value="<?= $usu_hora_fin ?>"/></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Presto servicio militar:</div>
        <div class="campoinput"><input type="radio" name="usu_servicio_militar" id="usu_servicio_militar2" value="s" <?php if ($usu_servicio_militar == 's') echo "checked"; ?>/>Si
            <input type="radio" name="usu_servicio_militar" id="usu_servicio_militar" value="n" <?php if ($usu_servicio_militar == 'n') echo "checked"; ?>/>No
            <div class="servicio_militar">
                Año:<div class="campoinput_xs"><input type="text" name="usu_anio_servicio_militar" id="usu_anio_servicio_militar" value="<?= $usu_anio_servicio_militar ?>"/></div>
            </div>
        </div>
    </div>
    <input type="hidden" name="usu_id" id="usu_id" value="<?= $id ?>"/>
    <?php echo form_close() ?>
</div>
<input type="hidden" name="deque" id="deque" value="m"/>
<div class="btnpie" id="almacenar_mas_info">Actualizar</div>
<a class="btnpie" href="<?= base_url() ?>admin/usuarios/modificar_usuario/<?= $id ?>">Regresar</a>
<script src="<?= base_url() ?>js/admin/usuarios.js"></script>

