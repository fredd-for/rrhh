/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  04-03-2014
 */
/**
 * Función registrar la baja de un registro de control de excepción.
 */
<<<<<<< HEAD
function darDeBajaIdeaDeNegocio(idIdea){
    var ok=true;
    if(idIdea>0){
        var ok=$.ajax({
            url:'/misideas/down/',
            type:'POST',
            datatype: 'json',
            async:false,
            data:{id:idIdea},
=======
function darDeBajaControlExcepcion(idControlExcepcion){
    var ok=true;
    if(idControlExcepcion>0){
        var ok=$.ajax({
            url:'/controlexcepciones/down/',
            type:'POST',
            datatype: 'json',
            async:false,
            data:{id:idControlExcepcion},
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
            success: function(data) {  //alert(data);
                var res = jQuery.parseJSON(data);
                /**
                 * Si se ha realizado correctamente el registro de baja del control de excepción.
                 */
                $(".msjes").hide();
                if(res.result==1){
                    $("#divMsjePorSuccess").html("");
                    $("#divMsjePorSuccess").append(res.msj);
                    $("#divMsjeNotificacionSuccess").jqxNotification("open");
<<<<<<< HEAD
                    $("#divGridIdeas").jqxGrid("updatebounddata");
=======
                    $("#divGridControlExcepciones").jqxGrid("updatebounddata");
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                } else if(res.result==0){
                    /**
                     * En caso de haberse presentado un error al momento de registrar la baja por inconsistencia de datos.
                     */
                    $("#divMsjePorWarning").html("");
                    $("#divMsjePorWarning").append(res.msj);
                    $("#divMsjeNotificacionWarning").jqxNotification("open");
                }else{
                    /**
                     * En caso de haberse presentado un error crítico al momento de registrarse la baja (Error de conexión)
                     */
                    $("#divMsjePorError").html("");
                    $("#divMsjePorError").append(res.msj);
                    $("#divMsjeNotificacionError").jqxNotification("open");
                }

            }, //mostramos el error
            error: function() { alert('Se ha producido un error Inesperado'); }
        });
    }else {
        ok = false;
    }
    return ok;
}