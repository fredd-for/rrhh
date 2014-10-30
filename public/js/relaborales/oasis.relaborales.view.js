/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  28-10-2014
 */

function cargarPersonasContactos(idPersona){
    var ok=$.ajax({
        url:'/relaborales/personascontacto/',
        type:'POST',
        datatype: 'json',
        async:false,
        data:{id:idPersona},
        success: function(data) {  //alert(data);
            var res = jQuery.parseJSON(data);
            if(res.length>0){
                $.each( res, function( key, val ) {
                        $("#tdTipoDeDocumento").html("<b>"+val.tipo_documento+"</b> : "+val.ci+" "+val.expd);
                        if(val.num_complemento!=""&&val.num_complemento!=null)
                        $("#tdNumeroDeDocumento").append(" "+val.num_complemento);
                        $("#tdNacionalidad").html("<b>Nacionalidad: </b>"+val.nacionalidad);
                        $("#tdLugarDeNacimiento").html("<b>Lugar de Nacionalidad: </b>"+val.lugar_nac);
                        $("#tdFechaDeNacimiento").html("<b>Fecha de Nacimiento: </b>"+val.fecha_nac);
                        $("#tdDireccion").html("<b>Direcci&oacute;n: </b>"+val.direccion_dom);
                        $("#tdTelefonoFijo").html("<b>Tel&eacute;fono Domicilio: </b>"+val.telefono_fijo);
                        $("#tdTelefonoInst").html("<b>Tel&eacute;fono Institucional: </b>"+val.telefono_inst);
                        $("#tdCelularPer").html("<b>Celular Personal: </b>"+val.celular_per);
                        $("#tdCelularInst").html("<b>Celular Institucional: </b>"+val.celular_inst);
                        $("#tdFax").html("<b>Tel&eacute;fono Fax: </b>"+val.telefono_fax);
                        $("#tdInternoInst").html("<b>N&uacute;merp Interno: </b>"+val.interno_inst);
                        $("#tdEmailPer").html("<b>E-Mail Personal: </b>"+val.e_mail_per);
                        $("#tdEmailInst").html("<b>E-Mail Institucional: </b>"+val.e_mail_inst);
                });
            }
        }, //mostramos el error
        error: function() { alert('Se ha producido un error Inesperado'); }
    });
}