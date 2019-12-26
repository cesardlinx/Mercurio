$(document).ready(function () {

    /* deshabilitar boton back */
    window.location.hash = "no-back-button";
    window.location.hash = "Again-No-back-button" //chrome
    window.onhashchange = function () {
        window.location.hash = "no-back-button";
    }

    var base_url = $("#base_url").val();

  
    // evento que abre y cierra el menú en dispositivos móviles
    $('#toggle-menu-adm').click(function(){
      if ($('.menu-adm').hasClass('open')) {
        cerrarMenu();
      } else {
        abrirMenu();
      }
    
    });
  
    // funciones para abrir y cerrar el menú
    function abrirMenu() {
        $('.menu-adm').animate({left: '0'});
        $('.menu-adm').addClass('open');
    }

    function cerrarMenu() {
        $('.menu-adm').animate({left: '-70%'});
        $('.menu-adm').removeClass('open');
                
    }

    // corrige el error de que el menú quede desaparecido
    var cerrarMenuUnaVez = function() {
        executed = false;
        if (!executed) {
            executed = true;
            $('.menu-adm').css('left','-70%');
            $('.menu-adm').removeClass('open'); 
        }
      };

    $(window).resize(function(){
        if ($(window).width() > 991) {
            if (!$('.menu-adm').hasClass('open')) {
                $('.menu-adm').css('left','0');
                $('.menu-adm').addClass('open');
                if (resizedToMobile) {
                    executed = false;
                }
            }
        } else {
            cerrarMenuUnaVez();
            var resizedToMobile = true;
        }
    });

    
    /*muestra en el menú de administración la opción activa*/
    var pathArray = window.location.pathname.split( '/' );

    switch(pathArray[3]) {
        case 'temas':
           $('#menu-adm-temas').addClass('active'); 
           break;
        case 'eventos':
           $('#menu-adm-eventos').addClass('active'); 
           break;
        case 'fechas':
           $('#menu-adm-fechas').addClass('active'); 
           break;
        case 'usuarios':
           $('#menu-adm-usuarios').addClass('active'); 
           break;
        case 'locaciones':
           $('#menu-adm-locaciones').addClass('active'); 
           break;
        case 'servidores':
           $('#menu-adm-servidores').addClass('active'); 
           break;
        case 'suscriptores_bajas':
           $('#menu-adm-bajas').addClass('active'); 
           break;
    }


});
 
