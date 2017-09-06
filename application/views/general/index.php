<div class="titulo">Menú principal
</div>
<div class="contenido myScroll">
    <div class="subtitulo">
        Módulos del software MAI:
        <div class="barracurva"></div>
    </div>
    <div class="contenedortabla">
        <table>
            <tr>
                <th width='120px'>Opción</th>
                <th>Descripción</th>
            </tr>
            <?php if ($acc_pi): ?>
                <tr>
                    <td>
                        <div class="ico_space"></div>
                        <a href="<?= base_url() . "pi"; ?>"><img class="ico_general ico_pi" src="<?= base_url(); ?>css/general/img/t.gif" title="Partes Interesadas"></a>
                    </td>
                    <td>
                        Comprensión de la organización y de su <b>contexto</b>, identifica las necesidades y expectativas de las partes interesadas, FODA
                    </td>
                </tr>
            <?php endif; ?>
            <?php if ($acc_sgp): ?>
                <tr>
                    <td>
                        <div class="ico_space"></div>
                        <a href="<?= base_url() . "sgp"; ?>"><img class="ico_general ico_sgp" src="<?= base_url(); ?>css/general/img/t.gif" title="Procesos"></a>
                    </td>
                    <td>
                        Planifica, implementa y controla los <b>procesos</b> para la provisión de productos y servicios, así como la evaluación de sus riesgos
                    </td>
                </tr>
            <?php endif; ?>
            <?php if ($acc_planificador): ?>
                <tr>
                    <td>
                        <div class="ico_space"></div>
                        <a href="<?= base_url() . "planificador"; ?>"><img class="ico_general ico_pla" src="<?= base_url(); ?>css/general/img/t.gif" title="Planificador"></a>
                    </td>
                    <td>
                        Gestiona los <b>planes</b> de auditoria, mantenimiento, capacitación, legales y financieros
                    </td>
                </tr>
            <?php endif; ?>
            <?php if ($acc_sdi): ?>
                <tr>
                    <td>
                        <div class="ico_space"></div>
                        <a href="<?= base_url() . "sdi"; ?>"><img class="ico_general ico_sdi" src="<?= base_url(); ?>css/general/img/t.gif" title="Gestión Documental"></a>
                    </td>
                    <td>
                        Crea y actualiza y mantiene la <b>información documentada</b>, asegurando la identificación, descripción y formato adecuados como apoyo a la operación de los procesos
                    </td>
                </tr>
            <?php endif; ?>
            <?php if ($acc_smc): ?>
                <tr>
                    <td>
                        <div class="ico_space"></div>
                        <a href="<?= base_url() . "smc"; ?>"><img class="ico_general ico_smc" src="<?= base_url(); ?>css/general/img/t.gif" title="Mejora Contínua"></a>
                    </td>
                    <td>
                        Identifica las oportunidades de <b>mejora</b> e implementa el seguimiento de las acciones para cumplir con los requisitos evaluando su desempeño
                    </td>
                </tr>
            <?php endif; ?>
            <?php if ($acc_sgi): ?>
                <tr>
                    <td>
                        <div class="ico_space"></div>
                        <a href="<?= base_url() . "sgi"; ?>"><img class="ico_general ico_sgi" src="<?= base_url(); ?>css/general/img/t.gif" title="Indicadores"></a>
                    </td>
                    <td>
                        Identifica los <b>indicadores</b> de desempeño necesarios para asegurar una operación eficaz y el control de los procesos
                    </td>
                </tr>
            <?php endif; ?>
            <?php if ($acc_sso): ?>
                <tr>
                    <td>
                        <div class="ico_space"></div>
                        <a href="<?= base_url() . "sso"; ?>">
                            <img class="ico_general ico_sso" src="<?= base_url(); ?>css/general/img/t.gif" title="Salud y seguridad ocupacional">
                        </a>
                    </td>
                    <td>
                        Módulo de <b>salud y seguridad ocupacional</b>
                    </td>
                </tr>          
            <?php endif; ?>
            <tr>
                <td>
                    <div class="ico_space"></div>
                    <a href="<?= base_url() . "soporte"; ?>"><img class="ico_general ico_ayuda" src="<?= base_url(); ?>css/general/img/t.gif" title="Ayuda, soporte, mantenimiento y garantía"></a>
                </td>
                <td>
                    <b>Soporte</b>, Mantenimiento y garantía de Software
                </td>
            </tr>
            <?php if ($this->config->item('con_emp_capacitacion') == 's'): ?>
                <?php if ($cap == 's'): ?>
                    <tr>
                        <td>
                            <div class="ico_space"></div>
                            <a href="<?= $enlace_cap_pro ?>"><img class="ico_general ico_cap" src="<?= base_url(); ?>css/general/img/t.gif" title="Ingreso al ambiente de producción"></a>
                        </td>
                        <td>
                            Ingreso al ambiente de <b>producción</b>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td>
                            <div class="ico_space"></div>
                            <a href="<?= base_url() . "capacitacion"; ?>"><img class="ico_general ico_cap" src="<?= base_url(); ?>css/general/img/t.gif" title="Ingreso al ambiente de capacitación"></a>
                        </td>
                        <td>
                            Ingreso al ambiente de <b>capacitación</b>
                        </td>
                    </tr>

                <?php endif; ?>
            <?php endif; ?>

            <tr>
                <td>
                    <div class="ico_space"></div>
                    <a href="<?= base_url() . "general/modificar_pass"; ?>"><img class="ico_general ico_password" src="<?= base_url(); ?>css/general/img/t.gif" title="Salir del software MAI"></a>
                </td>
                <td>
                    Cambiar <b>contraseña</b> de acceso
                </td>
            </tr>
            <tr>
                <td>
                    <div class="ico_space"></div>
                    <a href="<?= base_url() . "manual"; ?>">
                        <img class="ico_general ico_muf" src="<?= base_url(); ?>css/general/img/t.gif" title="Manual de usuario">
                    </a>
                </td>
                <td>
                    Ingreso al <b>manual del sistema</b>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="ico_space"></div>
                    <a href="<?= base_url() . "conexion/salir"; ?>"><img class="ico_general ico_exit" src="<?= base_url(); ?>css/general/img/t.gif" title="Salir del software MAI"></a>
                </td>
                <td>
                    <b>Salir</b> de forma segura del software MAI
                </td>
            </tr>
        </table>
    </div>
</div>
