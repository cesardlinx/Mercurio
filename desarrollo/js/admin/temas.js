$(document).ready(function () {

    $("#form_locaciones").validate({
        rules: {
            tem_nombre: "required",
        },
        messages: {
            tem_nombre: "* Ingrese el nombre",
        }
    });

    $("a[rel='paginador']").on("click", function (evento) {
        evento.preventDefault();
        var pagina = $(this).attr('href');
        $("#desde").val(pagina);
        $("#form_buscar").trigger("submit");
    });

    $(".buscar").on("click", function (evento) {
        evento.preventDefault();
        $("#form_buscar").trigger("submit");
    });


    $("a[rel='eliminar_tema']").click(function (event) {
        var id = $(this).attr('val');
        var base_url = $("#base_url").val();
        var res = confirm("¿Seguro desea eliminar?");
        if (res) {
            $.ajax({
                type: "POST",
                url: base_url + "admin/temas/eliminar/" + id,
                success: function (html) {
                    window.location = base_url + "admin/temas";
                }
            });
        }
    });



    $("#almacenar").click(function () {
        $("#form_almacenar").submit();
    });
});
