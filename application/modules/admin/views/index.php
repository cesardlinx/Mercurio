<div class="titulo">Administración del Software</div>

<div class="contenido">

    <div class="subtitulo">
        Pruebas iconos y estilos
        <div class="barracurva"></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Nombres</div>
        <div class="campoinput"><input type="text" /></div>
    </div>	
    <div class="contenedortabla">
        <div class="campoinfo">Apellidos</div>
        <div class="campoinput"><input type="text" /></div>
    </div>		

    <div class="subtitulo">
        Pruebas iconos y estilos
        <div class="barracurva"></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Nombres</div>
        <div class="campoinput"><input type="text" /></div>
    </div>	
    <div class="contenedortabla">
        <div class="campoinfo">Apellidos</div>
        <div class="campoinput"><input type="text" /></div>
    </div>
    <div class="subtitulo">
        Pruebas iconos y estilos
        <div class="barracurva"></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Areas</div>
        <div class="camposelect"><select> </select></div>
    </div>
    <div class="contenedortabla">
        <div class="campoinfo">Género</div>
        <div class="campoinput"><input type="radio" name="usu_genero" id="usu_genero" value="m"/>Masculino
        <input type="radio" name="usu_genero" id="usu_genero" value="f"/>Femenino
        </div>
    </div>

   <div class="subtitulo">
        Pruebas iconos y estilos
        <div class="barracurva"></div>
    </div>
    <div class="contenedortabla">       
        <div class="campoinfo">Activo:</div>
        <div class="campoinput"><input type="checkbox" name="usu_activo" id="usu_activo" value="s"/></div>        
    </div>

    <div class="subtitulo">
        Descripción
        <div class="barracurva"></div>
    </div>	
    <div class="contenedortabla">
        <textarea class="campotextarea" name=""></textarea>
    </div>	

    <div class="subtitulo">
        Hallazgos:
        <div class="barracurva"></div>
    </div>	
    <div class="contenedortabla">
        <table>
            <thead>
                <tr>
                    <th width="74%">Descripción</th>
                    <th width="8%">Fecha</th>
                    <th width="8%">Opciones</th>
                </tr>
            </thead>
            <tr>
                <td>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                </td>
                <td>2015-08-25</td>

                <td>

                    <a href="<?= base_url() . "adm"; ?>"><img class="opciones opc_ver" src="<?= base_url(); ?>css/general/img/t.gif" title="Ver"></a>

                    <a href="<?= base_url() . "adm"; ?>"><img class="opciones opc_verificacion" src="<?= base_url(); ?>css/general/img/t.gif" title="Verificación"></a>

                </td>

            </tr>

            <tr>

                <td>

                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore

                </td>

                <td>2015-08-25</td>

                <td>

                    <a href="<?= base_url() . "adm"; ?>"><img class="opciones opc_crear" src="<?= base_url(); ?>css/general/img/t.gif" title="Crear"></a>

                    <a href="<?= base_url() . "adm"; ?>"><img class="opciones opc_planaccion" src="<?= base_url(); ?>css/general/img/t.gif" title="Planes de acción"></a>

                </td>

            </tr>

            <tr>

                <td>

                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore

                </td>

                <td>2015-08-25</td>

                <td>

                    <a href="<?= base_url() . "adm"; ?>"><img class="opciones opc_revisar" src="<?= base_url(); ?>css/general/img/t.gif" title="Revisar"></a>

                    <a href="<?= base_url() . "adm"; ?>"><img class="opciones opc_modificar" src="<?= base_url(); ?>css/general/img/t.gif" title="Modificar"></a>

                </td>

            </tr>		

            <tr>

                <td>

                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore

                </td>

                <td>2015-08-25</td>

                <td>

                    <a href="<?= base_url() . "adm"; ?>"><img class="opciones opc_analisis" src="<?= base_url(); ?>css/general/img/t.gif" title="Análisis de causa"></a>

                    <a href="<?= base_url() . "adm"; ?>"><img class="opciones opc_eficacia" src="<?= base_url(); ?>css/general/img/t.gif" title="Eficacia"></a>

                </td>

            </tr>	

            <tr>

                <td>

                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore

                </td>

                <td>2015-08-25</td>

                <td>

                    <a href="<?= base_url() . "adm"; ?>"><img class="opciones opc_actividad" src="<?= base_url(); ?>css/general/img/t.gif" title="Actividad"></a>

                    <a href="<?= base_url() . "adm"; ?>"><img class="opciones opc_ver_actividad" src="<?= base_url(); ?>css/general/img/t.gif" title="Ver actividad"></a>

                    <a href="<?= base_url() . "adm"; ?>"><img class="opciones opc_des_actividad" src="<?= base_url(); ?>css/general/img/t.gif" title="Desarrollar actividad"></a>						

                </td>

            </tr>

            <tfoot>

                <tr>

                    <td colspan="3">

                        <a class="numpag" rel="paginador" href="1">1</a> 

                        <a class="numpagactivo" rel="paginador" href="2">2</a> 

                        <a class="numpag" rel="paginador" href="3">3</a> 

                        <a class="numpag" rel="paginador" href="4">4</a> 

                        <a class="numpag" rel="paginador" href="5">5</a> 

                </tr>

            </tfoot>							

        </table>

    </div>

</div>

<div class="btnpie">Cancelar</div>

<div class="btnpie">Almacenar</div>

<div class="btnpie">Aprobar análisis de causa</div>

<div class="btnpie">Aprobar planes de acción</div>

<div class="btnpie">Verificar eficacia</div>

<div class="btnpie">Actualizar</div>

