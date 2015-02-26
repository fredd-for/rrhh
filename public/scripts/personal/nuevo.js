$(document).ready(function () {
    //mostrar apellido de casada
    $('#estado_civil').change(function () {
        var e_civil = $(this).val();
        if (e_civil == 'CASADO(A)') {
            $('#div_a_casada').show();
        }
        else {
            $('#div_a_casada').hide();
        }
    });
    // verfiicar si el ci existe ya en la db
    $('input#ci').blur(function () {
//        alert($("#id").val());
        if($("#id").val()==''){
            var ajax = $.ajax({
            url: '/personas/ci',
            type: 'POST',
            datatype: 'json',
            data: {ci: $("#ci").val()},
            success: function (data) {
                var data = jQuery.parseJSON(data);
                if (data.existe > 0) {
                    bootbox.alert("<strong>¡Error!</strong> " + data.mensaje);
                    $('#ci').val('').focus();
                }

            }, //mostramos el error
            error: function () {
                alert('Se ha producido un error Inesperado');
            }
        });
        }
        


    });

    //datepicker a fechas
    $('#f_caducidad,#fecha_nacimiento').datepicker();

    $("#container_image").PictureCut({
        InputOfImageDirectory : "image",
        PluginFolderOnServer : "/jquery.picture.cut/",
        FolderOnServer : "/personal/",
        EnableCrop : true,
        CropWindowStyle : "Bootstrap"
    });

    
});


