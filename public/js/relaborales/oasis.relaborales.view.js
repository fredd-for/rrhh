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
                        $("#dtTipoDeDocumento").html(val.tipo_documento+":");
                        $("#ddNumeroDeDocumento").html("");
                        $("#ddNumeroDeDocumento").append(val.ci+" "+val.expd);
                        if(val.num_complemento!=""&&val.num_complemento!=null)
                        $("#ddNumeroDeDocumento").append(" "+val.num_complemento);
                        $("#ddNacionalidad").html(val.nacionalidad);
                        $("#ddLugarDeNacimiento").html(val.lugar_nac);
                        $("#ddFechaDeNacimiento").html(val.fecha_nac);
                        $("#ddDireccion").html(val.direccion_dom);
                        $("#ddTelefonoFijo").html(val.telefono_fijo);
                        $("#ddTelefonoInst").html(val.telefono_inst);
                        $("#ddCelularPer").html(val.celular_per);
                        $("#ddCelularInst").html(val.celular_inst);
                        $("#ddTelefonoFax").html(val.telefono_fax);
                        $("#ddInternoInst").html(val.interno_inst);
                        $("#ddEmailPer").html(val.e_mail_per);
                        $("#ddEmailInst").html(val.e_mail_inst);
                });
            }
        }, //mostramos el error
        error: function() { alert('Se ha producido un error Inesperado'); }
    });
}