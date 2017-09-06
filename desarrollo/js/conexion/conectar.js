$(document).ready(function () {

    $("#conexion").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $('#conexion').attr('action'),
            data: $('#conexion').serialize(), 
            success: function(r){
                if(r)
                    alert(r);
                location.href = $("#base_url").val()+$("#url_destino").val();
            }
        });
    });
});