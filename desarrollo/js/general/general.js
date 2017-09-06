$(document).ready(function () {

    /* deshabilitar boton back */
    window.location.hash = "no-back-button";
    window.location.hash = "Again-No-back-button" //chrome
    window.onhashchange = function () {
        window.location.hash = "no-back-button";
    }

    var base_url = $("#base_url").val();
    var altoDocumento = $(window).height();
    var anchoDocumento = $(window).width();
    var alm_alto_ventana = $("#alm_alto_ventana").val();

    $("#contenedor").height(altoDocumento - 10 - 20);
    // -110 cabecera y margen y -30 del titulo - 20 área para botones
    $(".contenido").height(altoDocumento - 23 - 20 - 110 - 30 - 20);

    // enviar el tamaño de la pantalla, para calcular cuantos resultados mostrar
    if (altoDocumento != alm_alto_ventana)
        enviarAlto(base_url, altoDocumento);

    $(window).resize(function () {
        var altoDocumento = $(window).height();
        enviarAlto(base_url, altoDocumento);
    });

    

    function enviarAlto(base_url, altoDocumento) {
        $.ajax({
            type: "POST",
            url: base_url + "general/alm_alto_ventana/" + altoDocumento,
        });
    }
    
    /* Cargando */
    $(document).ajaxStart(function () {
        $("#cargando").css("display", "block");
    });
    $(document).ajaxComplete(function () {
        $("#cargando").css("display", "none");
    });

    $("#infouser").click(function () {
        $("#dialoginfo").dialog("open");
    });

    $("#dialoginfo").dialog({
        autoOpen: false, modal: true, height: 420, width: 640,
        buttons: {
            Cerrar: function () {
                $(this).dialog("close");
            }
        },
        show: {
            effect: "blind",
            duration: 500
        },
        hide: {
            effect: "explode",
            duration: 300
        }
    });

    $(".eliminar").click(function () {
        var res = confirm("¿Seguro desea eliminar?");
        if (res) {
            $(this).parent("td").parent("tr").remove();
            return res;
        } else
            return false;
    });

    /*menu contextual*/
    //cuando hagamos click, el menú desaparecerá
    $(document).click(function (e) {
        if (e.button == 0) {
            $("#menu_contextual").css("display", "none");
        }
    });

    //si pulsamos escape, el menú desaparecerá
    $(document).keydown(function (e) {
        if (e.keyCode == 27) {
            $("#menu_contextual").css("display", "none");
        }
    });

    $(".myScroll").mCustomScrollbar({
        autoHideScrollbar: true,
        theme: "minimal-dark"
    });

    // Ayudas 
    $("#dlg_ayuda").hide();
    $("body").on("click", "span[rel='ayuda']",function () {
        var id = $(this).attr('valor');
        var base_url = $("#base_url").val();
        $("#dlg_ayuda").dialog({
            open: function () {
                $.ajax({
                    type: "POST",
                    url: base_url + "admin/ayudas/ver/",
                    data: {id: id},
                    success: function (html) {
                        $("#dlg_ayuda").html(html);
                    },
                });
            }, buttons: {
                "Cerrar": function () {
                    $('#dlg_ayuda').dialog('close');
                }
            },
            modal: true,
            width: 400,
            height: 200
        });
    });
    $("span[rel='ayuda']").css('cursor', 'pointer');

});