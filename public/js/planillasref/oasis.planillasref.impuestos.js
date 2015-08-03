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
function abrirVentanaModalForm110ImpRef(rowline){
    if(rowline>=0){
        var dataRecord = $("#divGridPlanillasRefGen").jqxGrid('getrowdata', rowline);
        limpiarVentanaModalForm110ImpRef();
        alert(dataRecord.gestion+"--"+dataRecord.mes);
        var form110Object = getOneForm110ImpRef(dataRecord.id_form110impref,dataRecord.id_relaboral,dataRecord.gestion,dataRecord.mes);
        if(form110Object.id>0){
            $("#txtImporte").val(form110Object.importe);
            $("#txtImpuesto").val(form110Object.impuesto);
            $("#txtFechaForm").val(form110Object.fecha_form);
            $("#txtObservacion").val(form110Object.observacion);
        }
        $("#popupFormulario110ImpRef").modal("show");
    }
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
 * @param id
 * @param idRelaboral
 * @param gestion
 * @param mes
 */
function getOneForm110ImpRef(id,idRelaboral,gestion,mes){
    var objForm110ImpRef = {id:0,relaboral_id:0,gestion:0,mes:0,cantidad:0,monto_diario:0,importe:0,impuesto:0,retencion:0,fecha_form:null,
        codigo:null,observacion:null,estado:0};
    $.ajax({
        url:'/form110impref/getoneforrelaboral/',
        type:"POST",
        datatype: 'json',
        async:false,
        cache:false,
        data:{id:id,
            id_relaboral:idRelaboral,
            gestion:gestion,
            mes:mes
        },
        success: function(data) {  //alert(data);

            var res = jQuery.parseJSON(data);
            if(res.length>0){
                objForm110ImpRef = {id:res.id,relaboral_id:res.relaboral_id,gestion:res.gestion,mes:res.mes,cantidad:res.cantidad,monto_diario:res.monto_diario,importe:res.importe,impuesto:res.impuesto,retencion:res.retencion,fecha_form:res.fecha_form,
                    codigo:res.codigo,observacion:res.observacion,estado:res.estado};
            }
        }, //mostramos el error
        error: function() { alert('Se ha producido un error Inesperado'); }
    });
    return objForm110ImpRef;
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