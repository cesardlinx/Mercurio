<?php

function migaPan() {

    $ci = &get_instance();

    $ci->load->library('breadcrumbcomponent');


    $opc1 = $ci->uri->segment(1); //modulo
    $opc2 = $ci->uri->segment(2); //controlador
    $opc3 = $ci->uri->segment(3); //funcion
    $opc4 = $ci->uri->segment(4); //parametros
    $opc5 = $ci->uri->segment(5);

    $ci->breadcrumbcomponent->add('Inicio', base_url() . "/");

    
}

?>