/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  29-07-2015
 */
/**
 * Función para abrir el formulario para el registro de Formulario 110 de Impuestos por Refrigerio.
 * @param idRelaboral
 * @param gestion
 * @param mes
 * @param idUsuario
 */
function abrirVentanaModalForm110ImpRef(idRelaboral,gestion,mes,idUsuario){
    $("#popupFormulario110ImpRef").modal("show");
    limpiarVentanaModalForm110ImpRef();
    //var form110Object = { id: $.trim($(this).text()), color: $(this).css('background-color') };
    var form110Object = getOneForm110ImpRef(idRelaboral,gestion,mes);

}
/**
 * Función para limpiar el formulario Modal para el Registro de Formularios 110 de Refrigerios.
 */
function limpiarVentanaModalForm110ImpRef(){
    $("#txtImporte").val("");
    $("#txtImpuesto").val("");
    $("#txtFechaForm").val("");
    $("#txtObservacion").val("");
}
/**
 * Función para la obtención de los datos correspondientes al registro de pago de formulario 110 por impuesto de refrigerio.
 * @param idRelaboral
 * @param gestion
 * @param mes
 */
function getOneForm110ImpRef(idRelaboral,gestion,mes){

}
function openVentanaModalForm110ImpRef(row){
    var dataRecord = $("#divGridPlanillasRefGen").jqxGrid('getrowdata', row);
    //dataRecord.id_relaboral
    $("#popupFormulario110ImpRef").modal("show");
    $("#txtImporte").focus();

}
/**
 * Función para la obtención de los datos referentes al formulario de impuestos 110 por refrigerios.
 * @param idRelaboral
 */
function obtenerDatosImpuestoRefrigerioPorRelaboralGestionMes(idRelaboral){
    if(idRelaboral>0){
        $.ajax({
            url:'/form110impref/getoneforrelaboral/',
            type:"POST",
            datatype: 'json',
            async:false,
            cache:false,
            data:{id:0,
                id_persona:idPersona,
                id_cargo:idCargo,
                num_contrato:numContrato,
                id_area:idArea,
                id_ubicacion:idUbicacion,
                id_regional:idRegional,
                id_procesocontratacion:idProceso,
                fecha_inicio:fechaIni,
                fecha_incor:fechaIncor,
                fecha_fin:fechaFin,
                observacion:observacion
            },
            success: function(data) {  //alert(data);

                var res = jQuery.parseJSON(data);
                /**
                 * Si se ha realizado correctamente el registro de la relación laboral
                 */
                $(".msjes").hide();
                if(res.result==1){
                    $("#divMsjePorSuccess").html("");
                    $("#divMsjePorSuccess").append(res.msj);
                    $("#divMsjeNotificacionSuccess").jqxNotification("open");
                    /**
                     * Se habilita nuevamente el listado actualizado con el registro realizado y
                     * se inhabilita el formulario para nuevo registro.
                     */
                    $('#jqxTabs').jqxTabs('enableAt', 0);
                    $('#jqxTabs').jqxTabs('disableAt', 1);
                    deshabilitarCamposParaNuevoRegistroDeRelacionLaboral();
                    $("#jqxgrid").jqxGrid("updatebounddata");
                } else if(res.result==0){
                    /**
                     * En caso de haberse presentado un error al momento de especificar la ubicación del trabajo
                     */
                    $("#divMsjePorWarning").html("");
                    $("#divMsjePorWarning").append(res.msj);
                    $("#divMsjeNotificacionWarning").jqxNotification("open");
                }else{
                    /**
                     * En caso de haberse presentado un error crítico al momento de registrarse la relación laboral
                     */
                    $("#divMsjePorError").html("");
                    $("#divMsjePorError").append(res.msj);
                    $("#divMsjeNotificacionError").jqxNotification("open");
                }

            }, //mostramos el error
            error: function() { alert('Se ha producido un error Inesperado'); }
        });
    }
}