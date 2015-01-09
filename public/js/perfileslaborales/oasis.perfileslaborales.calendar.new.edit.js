/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  06-01-2015
 */
function validaFormularioRegistroCalendario(idPerfilLaboral,tipoHorario,fechaIni,fechaFin) {
    var ok = true;
    var msje = "";
    $(".msjs-alert").hide();
    var idTolerancia = $("#lstTolerancias").val();
    var arr = $("#calendar").fullCalendar( 'clientEvents');
    var arrMeses=('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
    var contadorEventos = 0;
    var mesIni = 0;
    var mesFin = 0;
    var arrMeses = [];
    var cruce = true;
        $.each(arr,function(key,evento){
        var valClass = evento.className+"";
        var arrClass = valClass.split("_");
        var clase = arrClass[0];
        cruce = true;
        switch (clase){
            case "r":
            case "n":
                contadorEventos++;
                var fechaIni = fechaConvertirAFormato(evento.start,'-');
                var fechaFin = "";
                if(evento.start!=null&&evento.end==null){
                    fechaFin = fechaConvertirAFormato(evento.start,'-');
                }
                else fechaFin = fechaConvertirAFormato(evento.end,'-');
                var arrfechaIni = fechaIni.split("-");
                mesIni = arrfechaIni[1];
                var arrfechaFin = fechaFin.split("-");
                mesFin = arrfechaFin[1];
                cruce = prevenirCruceDeHorarios(idPerfilLaboral,fechaIni,fechaFin);
      //          alert(mesIni+"---"+mesFin);
                arrMeses.push(mesIni);
                arrMeses.push(mesFin);
                break;
            case "d":break;
        }
    });
    var mesesInvolucrados = calculamesesInvolucrados(arrMeses);
    //alert("el calendario tiene "+mesesInvolucrados+" meses");
    if(contadorEventos==0){
        ok = false;
        var msje = "Debe registrar al menos un evento en el calendario necesariamente.";
        $("#divMsjePorError").html("");
        $("#divMsjePorError").append(msje);
        $("#divMsjeNotificacionError").jqxNotification("open");
    }else{
        /**
         * Si el tipo de horario corresponde a un múltiple y el mes de la fecha de inicio y el mes de la fecha de finalización son distintos
         */
        if(tipoHorario==3){
            if(arrMeses.length>0){
                var mesSeleccionado = arrMeses[0];
                var sw=true;
                $.each(arrMeses,function(key,val){
                    if(mesSeleccionado!=val&&sw==true)sw=false;
                });
            }
            if(sw==false){
                ok = false;
                var msje = "Debe seleccionar sólo un mes para la asignaci&oacute;n del calendario debido a que el tipo de Horario es Multiple.";
                $("#divMsjePorError").html("");
                $("#divMsjePorError").append(msje);
                $("#divMsjeNotificacionError").jqxNotification("open");
            }
        }
        if(cruce==false){
            ok = false;
            var msje = "No se puede registrar el calendario debido a que algun(os) horario(s) tienen cruce con otros..";
            $("#divMsjePorError").html("");
            $("#divMsjePorError").append(msje);
            $("#divMsjeNotificacionError").jqxNotification("open");
        }
    }
    //var id_condicion = $("#hdnIdCondicionNuevaSeleccionada").val();
    if(idTolerancia==0||idTolerancia==undefined){
        ok = false;
        var msje = "Debe seleccionar un tipo de tolerancia necesariamente.";
        $("#divMsjePorError").html("");
        $("#divMsjePorError").append(msje);
        $("#divMsjeNotificacionError").jqxNotification("open");
    }
    return ok;
}
/**
 * Función para el almacenamiento de los turnos registrados en el calendario.
 */
function guardaFormularioRegistroCalendario(idPerfilLaboral,tipoHorario,fechaIni,fechaFin){
    var arr = $("#calendar").fullCalendar( 'clientEvents');
    var contadorEventos = 0;
    var mesIni = 0;
    var mesFin = 0;
    var arrMeses = [];
    var cruce = true;
    var seRegistraEnMesDeterminado = true;
    var idTolerancia = $("#lstTolerancias").val();
    var ok = true;
    var okk= true;
    $.each(arr,function(key,turno){
        var valClass = turno.className+"";
        var arrClass = valClass.split("_");
        var clase = arrClass[0];
        var idTipoHorario = arrClass[1];
        var idCalendarioLaboral = 0;
        if(turno.id!=undefined){
            idCalendarioLaboral=turno.id;
        }
        cruce = true;
        var fechaIni = fechaConvertirAFormato(turno.start,'-');
        var fechaFin = "";
        if(turno.start!=null&&turno.end==null){
            fechaFin = fechaConvertirAFormato(turno.start,'-');
        }
        else fechaFin = fechaConvertirAFormato(turno.end,'-');
        var arrfechaIni = fechaIni.split("-");
        mesIni = arrfechaIni[1];
        var arrfechaFin = fechaFin.split("-");
        mesFin = arrfechaFin[1];
        cruce = prevenirCruceDeHorarios(idPerfilLaboral,fechaIni,fechaFin);
        if(cruce){
        switch (clase){
            case "r":
                contadorEventos++;
                ok = guardarTurnoEnCalendario(idCalendarioLaboral,idPerfilLaboral,idTipoHorario,idTolerancia,fechaIni,fechaFin,'');
                if(!ok)okk=false;
                break;
            case "n":
                contadorEventos++;
                ok = guardarTurnoEnCalendario(0,idPerfilLaboral,idTipoHorario,idTolerancia,fechaIni,fechaFin,'');
                if(!ok)okk=false;
                break;
            case "d":break;
        }
        }
    });
    return okk;
}
/**
 * Función para la verificación de la existencia cruce de horarios
 * @param idPerfilLaboral
 * @param fechaIni
 * @param fechaFin
 */
function prevenirCruceDeHorarios(idPerfilLaboral,fechaIni,fechaFin){

    //alert("El perfil recibido esss:"+idPerfilLaboral+" --> "+ $("#hdnIdPerfilLaboralParaCalendario").val());
    var ok=true;
    return ok;

}
/**
 * Función para el registro de
 * @param idPerfilLaboral
 * @param idTipoHorario
 * @param idTolerancia
 * @param fechaIni
 * @param fechaFin
 */
function guardarTurnoEnCalendario(idCalendarioLaboral,idPerfilLaboral,idTipoHorario,idTolerancia,fechaIni,fechaFin,observacion){
    var ok = false;
    if(idPerfilLaboral>0&&idTipoHorario>0&&fechaIni!=''&&fechaFin!=''){
        ok = $.ajax({
            url: '/calendariolaboral/saveturno/',
            type: "POST",
            datatype: 'json',
            async: false,
            cache: false,
            data: {
                id: idCalendarioLaboral,
                id_perfillaboral:idPerfilLaboral,
                id_horario:idTipoHorario,
                fecha_ini:fechaIni,
                fecha_fin:fechaFin,
                id_tolerancia:idTolerancia,
                observacion:observacion
            },
            success: function (data) {  //alert(data);
                var res = jQuery.parseJSON(data);
                /**
                 * Si se ha realizado correctamente el registro de la relación laboral y la movilidad
                 */
                if (res.result == 1) {
                    ok = true;

                }
            }
        });
    }
    return ok;
}
function calculamesesInvolucrados(arrMeses){
    var cantidad = 0;
    var sw=true;
    if(arrMeses.length>0){
        var mes = arrMeses[0];
        $.each(arrMeses,function (clave,elemento){
            if(mes!=elemento){
                sw=false;
            }
        });
    }
    return cantidad;
}
