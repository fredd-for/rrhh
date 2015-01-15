/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  18-12-2014
 */
function iniciarCalendarioLaboral(accion,tipoHorario,arrHorariosRegistrados,defaultGestion,defaultMes,defaultDia) {
    var arrFechasPorSemana = [];
    var contadorPorSemana = 0;
    var diasSemana=7;
    var calendarEvents  = $('.calendar-events');
    /* Inicializa la funcionalidad de eventos: arrastrar y soltar */
    //initEvents();

    /* Initialize FullCalendar */
    var optLeft = 'prev,next';
    var optRight = 'year,month,agendaWeek,agendaDay';
    var optEditable = true;
    var optDroppable = true;
    var optSelectable = true;
    var optVerFinesDeSemana= true;
    var optVerTotalizadorHorasPorSemana=true;
    //weekends
    switch (accion){
        case 1://Nuevo
            switch (tipoHorario){
                case 1:
                case 2:break;
                case 3:optLeft='';optRight='year';break;
            }
            break;
        case 2://Edición
            switch (tipoHorario){
                case 1:
                case 2:break;
                case 3:optLeft='';optRight='year';break;
            }
            break;
    }
    switch (tipoHorario){
        case 1:
        case 2:optVerFinesDeSemana=false;diasSemana=5;optVerTotalizadorHorasPorSemana=false;break;
        case 3:break;
    }
    $('#calendar').fullCalendar({
        header: {
            left: optLeft,
            center: 'title',
            right: optRight
        },
        year:defaultGestion,
        month:defaultMes,
        date:defaultDia,
        firstDay: 1,
        weekends:optVerFinesDeSemana,
        editable: optEditable,
        droppable: optDroppable,
        selectable: optSelectable,
        timeFormat: 'H(:mm)', // Mayusculas H de 24-horas
        drop: function(date, allDay) {

            /**
             * Controlando cuando se introduce un nuevo evento u horario en el calendario
             * @type {*|jQuery}
             */

            // Recuperar almacenado de objeto del evento del elemento caído
            var originalEventObject = $(this).data('eventObject');

            // Tenemos que copiarlo, de modo que múltiples eventos no tienen una referencia al mismo objeto
            var copiedEventObject = $.extend({}, originalEventObject);

            // Asignarle la fecha que fue reportado
            copiedEventObject.start = date;


            // Hacer que el evento en el calendario
            // El último argumento `true` determina si el evento "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            /**
             * Si se introduce un nuevo horario en el calendario se recalcula los totales por semana.
             */
            sumarTotalHorasPorSemana(arrFechasPorSemana);

        }
        ,
        eventDrop: function (event, dayDelta, minuteDelta, allDay, revertFunc) {
            /**
             * Si un horario se ha movido, es necesario calcular los totales de horas por semana
             */
            sumarTotalHorasPorSemana(arrFechasPorSemana);
        },
        events: arrHorariosRegistrados,
        /**
         * Controlando el evento de clik sobre el horario.
         * @param calEvent
         * @param jsEvent
         * @param view
         */
        eventClick: function(calEvent, jsEvent, view) {

            var clase = calEvent.className+"";
            var arrClass = clase.split("_");
            var idTipoHorario = arrClass[1];
            clase = arrClass[0];
            var idTurno = 0;
            if(calEvent.id!=undefined){
                idTurno = calEvent.id;
            }
            if(idTipoHorario>0){
                var ok = cargarModalHorario(idTipoHorario);
                if(ok) {
                    /**
                     * Si la clase del horario esta bloqueada no se la puede eliminar
                     */
                    if(clase=="b"){
                        $("#btnDescartarHorario").hide();
                    } else {$("#btnDescartarHorario").show();}
                    $('#popupDescripcionHorario').modal('show');
                    $("#btnDescartarHorario").off();
                    $("#btnDescartarHorario").on("click", function () {
                        switch (clase){
                            case "r":
                            case "d":
                                var okBaja = bajaTurnoEnCalendario(idTurno);
                                if(okBaja){
                                    $('#calendar').fullCalendar('removeEvents', calEvent._id);
                                    $('#popupDescripcionHorario').modal('hide');
                                }
                                break;
                            case "n":
                                $('#calendar').fullCalendar('removeEvents', calEvent._id);
                                $('#popupDescripcionHorario').modal('hide');
                                break;
                        }
                        /**
                         * Si se ha eliminado un horario, es necesario recalcular las horas por semana
                         */
                        sumarTotalHorasPorSemana(arrFechasPorSemana);
                    });
                }else alert("Error al determinar los datos del horario.");
            }else {
                alert("El registro corresponde a un periodo de descanso");
            }
        },
        eventResize: function(event, delta, revertFunc) {
            /**
             * Cuando un horario es modificado en cuanto a su duración, se debe calcular nuevamente los totales de horas por semana
             */
            sumarTotalHorasPorSemana(arrFechasPorSemana);

        },
        dayRender: function (date, cell) {
            var dia = $.fullCalendar.formatDate(date,'dd-MM-yyyy');
            var check = $.fullCalendar.formatDate(date,'yyyy-MM-dd');
            var today = $.fullCalendar.formatDate(new Date(),'yyyy-MM-dd');
            if (check < today) {
                cell.css("background-color", "silver");
            }
            contadorPorSemana++;
            if(contadorPorSemana>=1&&contadorPorSemana<=diasSemana){
                arrFechasPorSemana.push( {
                    semana:1,
                    fecha:dia
                });
            }
            if(contadorPorSemana>=(diasSemana+1)&&contadorPorSemana<=diasSemana*2){
                arrFechasPorSemana.push( {
                    semana:2,
                    fecha:dia
                });
            }
            if(contadorPorSemana>=((diasSemana*2)+1)&&contadorPorSemana<=diasSemana*3){
                arrFechasPorSemana.push( {
                    semana:3,
                    fecha:dia
                });
            }
            if(contadorPorSemana>=((diasSemana*3)+1)&&contadorPorSemana<=diasSemana*4){
                arrFechasPorSemana.push( {
                    semana:4,
                    fecha:dia
                });
            }
            if(contadorPorSemana>=((diasSemana*4)+1)&&contadorPorSemana<=diasSemana*5){
                arrFechasPorSemana.push( {
                    semana:5,
                    fecha:dia
                });
            }
            if(contadorPorSemana>=((diasSemana*5)+1)&&contadorPorSemana<=diasSemana*6){
                arrFechasPorSemana.push( {
                    semana:6,
                    fecha:dia
                });
            }
        }
    });
    return arrFechasPorSemana;
}
/**
 * Función para inicializar las funcionalidad para el evento de arrastre y eliminación
 */
var initEvents = function() {
    var calendarEvents  = $('.calendar-events');
    calendarEvents.find('li').each(function() {

        /*Creando un nuevo objeto con los datos necesarios (Se usa HTML5 para almacenar otro datos*/
        var horasLaborales = $(this).data("horas_laborales");
        var diasLaborales = $(this).data("dias_laborales");
        var eventObject = { className:'n_'+this.id,title: $.trim($(this).text()), color: $(this).css('background-color'),horas_laborales: horasLaborales,dias_laborales:diasLaborales};

        /* Almacenar el objeto de evento en el elemento DOM para que podamos llegar a ella más tarde */
        $(this).data('eventObject', eventObject);

        /* Hacer que el evento se pueda arrastrar usando jQuery UI*/
        $(this).draggable({ zIndex: 999, revert: true, revertDuration: 0 });
    });
};
/**
 * Función para la obtención del listado de horarios registrados en el sistema a objeto de ponerlos disponibles para su registro en el calendario.
 * @returns {Array}
 */
function obtenerHorariosDisponibles(tipoHorario){
    var arrHorarios = [];
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var ctrlAllDay=false;
    switch (tipoHorario){
        case 1:
        case 2:ctrlAllDay=true;break;
    }
    $.ajax({
        url: '/horarioslaborales/listdisponibles',
        type: 'POST',
        datatype: 'json',
        async: false,
        cache: false,
        success: function (data) {
            var res = jQuery.parseJSON(data);
            if (res.length > 0) {
                $.each(res, function (key, val) {
                    var fechaIni =  val.fecha_ini.split("-");
                    var yi = fechaIni[0];
                    var mi = fechaIni[1];
                    var di = fechaIni[2];
                    var horaEnt = val.hora_entrada.split(":");
                    var he = horaEnt[0];
                    var me = horaEnt[1];
                    var se = horaEnt[2];
                    var fechaFin =  val.fecha_fin.split("-");
                    var yf = fechaFin[0];
                    var mf = fechaFin[1];
                    var df = fechaFin[2];
                    var horaSal = val.hora_entrada.split(":");
                    var hs = horaSal[0];
                    var ms = horaSal[1];
                    var ss = horaSal[2];
                    arrHorarios.push( {
                        id:val.id_horariolaboral,
                        className:'d_'+val.id_horariolaboral,
                        title: val.nombre,
                        start: new Date(yi, mi, di, he, me),
                        end: new Date(yf, mf, df, hs, ms),
                        allDay: ctrlAllDay,
                        color: val.color,
                        horas_laborales:val.horas_laborales,
                        dias_laborales:val.dias_laborales
                    });
                });
            }
        }
    });
    return arrHorarios;
}
/**
 * Función para la obtención del listado de horarios registrados en el calendario de acuerdo a un perfil determinado, una rango de fechas y un tipo de horario.
 * @param idPerfil
 * @param gestion
 * @param mes
 * @param tipoHorario
 * @returns {Array}
 */
function obtenerHorariosRegistradosEnCalendarioPorPerfil(idPerfil,tipoHorario,editable,fechaIni,fechaFin){
    var arrHorariosRegistrados = [];
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var ctrlAllDay=false;
    switch (tipoHorario){
        case 1:
        case 2:ctrlAllDay=true;break;
    }
    $.ajax({
        url: '/calendariolaboral/listregistered',
        type: 'POST',
        datatype: 'json',
        async: false,
        cache: false,
        data: {id:idPerfil,fecha_ini:fechaIni,fecha_fin:fechaFin},
        success: function (data) {
            var res = jQuery.parseJSON(data);
            if (res.length > 0) {
                $.each(res, function (key, val) {
                    var idHorarioLaboral = 0;
                    var horaEnt = '00:00:00';
                    var horaSal = '24:00:00';
                    var color = '#000000';
                    var horario_nombre = 'DESCANSO';
                    if(val.id_horariolaboral!=null){
                        idHorarioLaboral = val.id_horariolaboral;
                        horario_nombre = val.horario_nombre;
                        horaEnt = val.hora_entrada.split(":");
                        horaSal = val.hora_salida.split(":");
                        color = val.color;
                    }else {
                        horaEnt = horaEnt.split(":");
                        horaSal = horaSal.split(":");
                    }
                    var fechaIni =  val.calendario_fecha_ini.split("-");
                    var yi = fechaIni[0];
                    var mi = fechaIni[1]-1;
                    var di = fechaIni[2];

                    var he = horaEnt[0];
                    var me = horaEnt[1];
                    var se = horaEnt[2];

                    var fechaFin =  val.calendario_fecha_fin.split("-");
                    var yf = fechaFin[0];
                    var mf = fechaFin[1]-1;
                    var df = fechaFin[2];

                    var hs = horaSal[0];
                    var ms = horaSal[1];
                    var ss = horaSal[2];
                    var prefijo = "r_";
                    if(idHorarioLaboral==0){ prefijo="d_";}
                    var borde = color;
                    if(!editable){
                        borde = "#000000";
                        prefijo="b_";//Se modifica para que d: represente a los horarios bloqueados
                    }
                    arrHorariosRegistrados.push( {
                        id:val.id_calendariolaboral,
                        className:prefijo+idHorarioLaboral,
                        title: horario_nombre,
                        start: new Date(yi, mi, di, he, me),
                        end: new Date(yf, mf, df, hs, ms),
                        allDay: ctrlAllDay,
                        color: color,
                        editable:editable,
                        borderColor:borde,
                        horas_laborales:val.horas_laborales,
                        dias_laborales:val.dias_laborales
                    });
                });
            }
        }
    });
    return arrHorariosRegistrados;
}
/**
 * Función para el despliegue en el lado izquierdo de todos los horarios registrados, dando la posibilidad de su modificación.
 * @author JLM
 * @param arrHorarios
 */
function cargarHorariosDisponibles(arrHorarios){
    $("#ulHorariosEnEspera").html("");
    if(arrHorarios.length>0){
        $.each(arrHorarios, function (key, val) {

            var valId = val.id;
            var valColor = val.color;
            var eventInputVal = val.title;
            var calendarEvents  = $('.calendar-events');
            var horasLaborales = val.horas_laborales;
            var diasLaborales = val.dias_laborales;
            calendarEvents.append('<li style="background-color: '+valColor+'" class="ui-draggable '+val.class+'" id="'+valId+'" data-horas_laborales="'+horasLaborales+'" data-dias_laborales="'+diasLaborales+'">' + $('<div />').text(eventInputVal).html() + '</li>');

            // Init Events
            initEvents();


        });

    }
}
/**
 * Formulario para la validación de lo datos enviados para el registro de horarios laborales.
 * @author JLM
 * @returns {boolean}
 */
function validaFormularioHorario() {
    var ok = true;
    var msje = "";
    $(".msjs-alert").hide();

    limpiarMensajesErrorPorValidacionHorario();

    var enfoque = null;
    var nombre = $("#txtNombreHorario").val();
    var nombreAlternativo = $("#txtNombreAlternativoHorario").val();
    var color = $("#txtColorHorario").val();
    var horaEntHorario = $("#txtHoraEntHorario").val();
    var horaSalHorario = $("#txtHoraSalHorario").val();
    var minutosToleranciaAcumulable = $("#txtMinutosToleranciaAcu").val();
    var minutosToleranciaEntrada = $("#txtMinutosToleranciaEnt").val();
    var minutosToleranciaSalida = $("#txtMinutosToleranciaSal").val();
    var horaInicioRangoEntrada = $("#txtHoraInicioRangoEnt").val();
    var horaFinalizacionRangoEntrada = $("#txtHoraFinalizacionRangoEnt").val();
    var horaInicioRangoSalida = $("#txtHoraInicioRangoSal").val();
    var horaFinalizacionRangoSalida = $("#txtHoraFinalizacionRangoSal").val();



    if (nombre == '') {
        ok = false;
        var msje = "Debe introducir un nombre para el horario necesariamente.";
        $("#divNombreHorario").addClass("has-error");
        $("#helpErrorNombreHorario").html(msje);
        if (enfoque == null)enfoque = $("#txtNombreHorario");
    }
    if(color==''){
        ok = false;
        var msje = "Debe seleccionar un color para el horario necesariamente.";
        $("#divColorHorario").addClass("has-error");
        $("#helpErrorColorHorario").html(msje);
        if (enfoque == null)enfoque = $("#txtColorHorario");
    }
    if(color=='#FFFFFF'){
        ok = false;
        var msje = "Seleccion&oacute; el color blanco para el horario, debe seleccionar un color diferente necesariamente.";
        $("#divColorHorario").addClass("has-error");
        $("#helpErrorColorHorario").html(msje);
        if (enfoque == null)enfoque = $("#txtColorHorario");
    }
    if(horaEntHorario==''){
        ok = false;
        var msje = "Debe seleccionar una hora de entrada necesariamente.";
        $("#divHoraEntHorario").addClass("has-error");
        $("#helpErrorHoraEntHorario").html(msje);
        if (enfoque == null)enfoque = $("#txtHoraEntHorario");
    }
    if(horaSalHorario==''){
        ok = false;
        var msje = "Debe seleccionar una hora de salida necesariamente.";
        $("#divHoraSalHorario").addClass("has-error");
        $("#helpErrorHoraSalHorario").html(msje);
        if (enfoque == null)enfoque = $("#txtHoraSalHorario");
    }
    if(minutosToleranciaAcumulable==''){
        ok = false;
        var msje = "Debe introducir los minutos de tolerancia acumulable necesariamente.";
        $("#divMinutosToleranciaAcu").addClass("has-error");
        $("#helpErrorMinutosToleranciaAcu").html(msje);
        if (enfoque == null)enfoque = $("#txtMinutosToleranciaAcu");
    }
    if(minutosToleranciaEntrada==''){
        ok = false;
        var msje = "Debe introducir los minutos de tolerancia en la entrada del horario necesariamente.";
        $("#divMinutosToleranciaEnt").addClass("has-error");
        $("#helpErrorMinutosToleranciaEnt").html(msje);
        if (enfoque == null)enfoque = $("#txtMinutosToleranciaEnt");
    }
    if(minutosToleranciaSalida==''){
        ok = false;
        var msje = "Debe introducir los minutos de tolerancia en la salida del horario necesariamente.";
        $("#divMinutosToleranciaSal").addClass("has-error");
        $("#helpErrorMinutosToleranciaSal").html(msje);
        if (enfoque == null)enfoque = $("#txtMinutosToleranciaSal");
    }
    if(horaInicioRangoEntrada==''){
        ok = false;
        var msje = "Debe introducir la hora de inicio del rango de marcaci&oacute;n para la entrada.";
        $("#divHoraInicioRangoEnt").addClass("has-error");
        $("#helpErrorHoraInicioRangoEnt").html(msje);
        if (enfoque == null)enfoque = $("#txtHoraInicioRangoEnt");
    }
    if(horaFinalizacionRangoEntrada==''){
        ok = false;
        var msje = "Debe introducir la hora de finalizaci&oacute;n del rango de marcaci&oacute;n para la entrada.";
        $("#divHoraFinalizacionRangoEnt").addClass("has-error");
        $("#helpErrorHoraFinalizacionRangoEnt").html(msje);
        if (enfoque == null)enfoque = $("#txtHoraFinalizacionRangoEnt");
    }
    if(horaInicioRangoSalida==''){
        ok = false;
        var msje = "Debe introducir la hora de inicio del rango de marcaci&oacute;n para la salida.";
        $("#divHoraInicioRangoSal").addClass("has-error");
        $("#helpErrorHoraInicioRangoSal").html(msje);
        if (enfoque == null)enfoque = $("#txtHoraInicioRangoSal");
    }
    if(horaFinalizacionRangoSalida==''){
        ok = false;
        var msje = "Debe introducir la hora de finalizaci&oacute;n del rango de marcaci&oacute;n para la salida.";
        $("#divHoraFinalizacionRangoSal").addClass("has-error");
        $("#helpErrorHoraFinalizacionRangoSal").html(msje);
        if (enfoque == null)enfoque = $("#txtHoraFinalizacionRangoSal");
    }

    /*var sep = '-';
     if (procesaTextoAFecha(fechaIni, sep) < procesaTextoAFecha(fechaMem, sep)) {
     ok = false;
     msje = "La fecha de inicio debe ser igual o superior a la fecha del memor&aacute;ndum.";
     $("#divFechasIniMovilidad").addClass("has-error");
     $("#divFechasMemorandums").addClass("has-error");
     $("#helpErrorFechasIniMovilidad").html(msje);
     $("#helpErrorFechasMemorandums").html(msje);
     if (enfoque == null)enfoque = $("#txtFechaIniMovilidad");
     }
     if (swFechaFin == 1) {
     if (procesaTextoAFecha(fechaFin, sep) < procesaTextoAFecha(fechaIni, sep)) {
     ok = false;
     msje = "La fecha de finalizaci&oacute;n debe ser igual o superior a la fecha de inicio.";
     $("#divFechasIniMovilidad").addClass("has-error");
     $("#divFechasFinMovilidad").addClass("has-error");
     $("#helpErrorFechasIniMovilidad").html(msje);
     $("#helpErrorFechasFinMovilidad").html(msje);
     if (enfoque == null)enfoque = $("#txtFechaIniMovilidad");
     }
     }*/
    if (enfoque != null) {
        enfoque.focus();
    }
    return ok;
}
/**
 * Función para la limpieza de los mensajes de error debido a la validación del formulario para registro de horario laboral.
 */
function limpiarMensajesErrorPorValidacionHorario() {
    $("#divNombreHorario").removeClass("has-error");
    $("#helpErrorNombreHorario").html("");
    $("#divColorHorario").removeClass("has-error");
    $("#helpErrorColorHorario").html("");
    $("#divHoraEntHorario").removeClass("has-error");
    $("#helpErrorHoraEntHorario").html("");
    $("#divHoraSalHorario").removeClass("has-error");
    $("#helpErrorHoraSalHorario").html("");
    $("#divMinutosToleranciaAcu").removeClass("has-error");
    $("#helpErrorMinutosToleranciaAcu").html("");
    $("#divMinutosToleranciaEnt").removeClass("has-error");
    $("#helpErrorMinutosToleranciaEnt").html("");
    $("#divMinutosToleranciaSal").removeClass("has-error");
    $("#helpErrorMinutosToleranciaSal").html("");
    $("#divHoraInicioRangoEnt").removeClass("has-error");
    $("#helpErrorHoraInicioRangoEnt").html("");
    $("#divHoraFinalizacionRangoEnt").removeClass("has-error");
    $("#helpErrorHoraFinalizacionRangoEnt").html("");
    $("#divHoraInicioRangoSal").removeClass("has-error");
    $("#helpErrorHoraInicioRangoSal").html("");
    $("#divHoraFinalizacionRangoSal").removeClass("has-error");
    $("#helpErrorHoraFinalizacionRangoSal").html("");
}
/**
 * Función para guardar el registro del horario.
 * @param idHorario Identificador del horario
 * @returns {boolean}
 */
function guardaHorario(){
    var ok = true;
    var idHorarioLaboral = $("#hdnIdHorarioLaboralModificar").val();
    var nombre = $("#txtNombreHorario").val();
    var nombreAlternativo = $("#txtNombreAlternativoHorario").val();
    var color = $("#txtColorHorario").val();
    var horaEntHorario = $("#txtHoraEntHorario").val();
    var horaSalHorario = $("#txtHoraSalHorario").val();
    var minutosToleranciaAcumulable = $("#txtMinutosToleranciaAcu").val();
    var minutosToleranciaEntrada = $("#txtMinutosToleranciaEnt").val();
    var minutosToleranciaSalida = $("#txtMinutosToleranciaSal").val();
    var rangoEntrada = 1;
    var rangoSalida = 1;
    var horaInicioRangoEntrada = $("#txtHoraInicioRangoEnt").val();
    var horaFinalizacionRangoEntrada = $("#txtHoraFinalizacionRangoEnt").val();
    var horaInicioRangoSalida = $("#txtHoraInicioRangoSal").val();
    var horaFinalizacionRangoSalida = $("#txtHoraFinalizacionRangoSal").val();
    var observacion = $("#txtObservacion").val();
    var fecha_ini = '01-01-2014';
    var fecha_fin = '31-12-2020';
    if (nombre != '' && color != '') {
        $.ajax({
            url: '/calendariolaboral/savehorario/',
            type: "POST",
            datatype: 'json',
            async: false,
            cache: false,
            data: {
                id: idHorarioLaboral,
                nombre: nombre,
                nombre_alternativo: nombreAlternativo,
                color: color,
                hora_entrada: horaEntHorario,
                hora_salida: horaSalHorario,
                minutos_tolerancia_acu: minutosToleranciaAcumulable,
                minutos_tolerancia_ent: minutosToleranciaEntrada,
                minutos_tolerancia_sal: minutosToleranciaSalida,
                rango_entrada:rangoEntrada,
                rango_salida:rangoSalida,
                hora_inicio_rango_ent: horaInicioRangoEntrada,
                hora_final_rango_ent: horaFinalizacionRangoEntrada,
                hora_inicio_rango_sal: horaInicioRangoSalida,
                hora_final_rango_sal: horaFinalizacionRangoSalida,
                fecha_ini:fechaIni,
                fecha_fin:fechaFin,
                observacion: observacion
            },
            success: function (data) {  //alert(data);
                var res = jQuery.parseJSON(data);
                /**
                 * Si se ha realizado correctamente el registro de la relación laboral y la movilidad
                 */
                $(".msjes").hide();
                if (res.result == 1) {
                    ok = true;
                    /*$("#jqxgridmovilidad").jqxGrid("updatebounddata");*/
                    $("#divMsjePorSuccess").html("");
                    $("#divMsjePorSuccess").append(res.msj);
                    $("#divMsjeNotificacionSuccess").jqxNotification("open");
                    /*Es necesario actualizar la grilla principal debido a que este debe mostrar los datos de acuerdo a la última movilidad de personal*/
                    /*$("#jqxgrid").jqxGrid('beginupdate');*/
                } else if (res.result == 0) {
                    /**
                     * En caso de presentarse un error subsanable
                     */
                    $("#divMsjePorWarning").html("");
                    $("#divMsjePorWarning").append(res.msj);
                    $("#divMsjeNotificacionWarning").jqxNotification("open");
                } else {
                    /**
                     * En caso de haberse presentado un error crítico al momento de registrarse la relación laboral
                     */
                    $("#divMsjePorError").html("");
                    $("#divMsjePorError").append(res.msj);
                    $("#divMsjeNotificacionError").jqxNotification("open");
                }

            }, //mostramos el error
            error: function () {
                $("#divMsjePorError").html("");
                $("#divMsjePorError").append("Se ha producido un error Inesperado");
                $("#divMsjeNotificacionError").jqxNotification("open");
            }
        });
    }
    return ok;
}
/**
 * Función para la selección de la tolerancia a aplicarse para el calendario.
 */
function iniciarSelectorTolerancias(idTolerancia){
    // prepare the data
    var arrTolerancias=[];
    var grilla = "";
    $.ajax({
        url: '/tolerancias/list',
        type: 'POST',
        datatype: 'json',
        async: false,
        cache: false,
        data:{estado:1},
        success: function (data) {
            var res = jQuery.parseJSON(data);
            $('#lstTolerancias').html("");
            $('#lstTolerancias').append("<option value='0'>Seleccionar...</option>");
            if (res.length > 0) {
                $.each(res, function (key, val) {
                    if (idTolerancia == val.id) {
                        $selected = 'selected';
                        grilla = "<td class='text-center'>"+val.tolerancia+"</td><td class='text-center'>"+val.acumulacion_descripcion+"</td><td>"+val.consideracion_retraso_descripcion+"</td><td>"+val.descripcion+"</td><td>"+val.observacion+"</td>";
                    } else {
                        $selected = '';
                    }
                    $('#lstTolerancias').append("<option value=" + val.id + " " + $selected + ">" + val.id + "</option>");
                    sw = 1;
                    arrTolerancias.push( {
                        id: val.id,
                        tolerancia:val.tolerancia,
                        tipo_acumulacion: val.tipo_acumulacion,
                        acumulacion_descripcion:val.acumulacion_descripcion,
                        consideracion_retraso:val.consideracion_retraso,
                        consideracion_retraso_descripcion:val.consideracion_retraso_descripcion,
                        descripcion:val.descripcion,
                        fecha_ini:val.fecha_ini,
                        fecha_fin:val.fecha_fin,
                        observacion:val.observacion
                    });
                });
                if (sw == 0)$('#lstTolerancias').prop("disabled", "disabled");
            } else $('#lstTolerancias').prop("disabled", "disabled");
        }
    });
    $("#tr_tolerancia").html("");
    if(grilla!="")$("#tr_tolerancia").append(grilla);
    $("#lstTolerancias").off();
    $("#lstTolerancias").on("change",function(){
        $("#tr_tolerancia").html("");
        grilla ="";
        $.each(arrTolerancias,function(key,val){
            if(val.id==$("#lstTolerancias").val()){
                grilla = "<td class='text-center'>"+val.tolerancia+"</td><td class='text-center'>"+val.acumulacion_descripcion+"</td><td>"+val.consideracion_retraso_descripcion+"</td><td>"+val.descripcion+"</td><td>"+val.observacion+"</td>";
            }
        });
        if(grilla!="")$("#tr_tolerancia").append(grilla);
    });
}
/**
 * Función para la carga de los datos correspondientes al horario en el modal respectivo.
 * @param idHorario
 */
function cargarModalHorario(idHorario){
    if(idHorario>0){
        $.ajax({
            url: '/horarioslaborales/getone',
            type: 'POST',
            datatype: 'json',
            async: false,
            cache: false,
            data: {id: idHorario},
            success: function (data) {
                var res = jQuery.parseJSON(data);
                if (res.length > 0) {
                    $.each(res, function (key, val) {
                        $("#txtNombreHorario").val(val.nombre);
                        $("#txtNombreAlternativoHorario").val(val.nombre_alternativo);
                        $("#txtColorHorario").val(val.color);
                        $("#txtColorHorario").css({'background-color':val.color,'color':val.color});
                        $("#txtHoraEntHorario").val(val.hora_entrada);
                        $("#txtHoraSalHorario").val(val.hora_salida);
                        $("#txtHoraInicioRangoEnt").val(val.hora_inicio_rango_ent);
                        $("#txtHoraFinalizacionRangoEnt").val(val.hora_final_rango_ent);
                        $("#txtHoraInicioRangoSal").val(val.hora_inicio_rango_sal);
                        $("#txtHoraFinalizacionRangoSal").val(val.hora_final_rango_sal);
                        $("#txtObservacion").val(val.observacion);
                        var hEnt = val.hora_entrada;
                        var hSal = val.hora_salida;
                        if(hEnt=="")hEnt = "00:00:00";
                        if(hSal=="")hSal = "00:00:00";
                        $("#txtHorasLaborales").val(calcularCantidadHorasLaborales(hEnt,hSal));
                    });
                }
            }
        });
        return true;
    }else return false;
}
/**
 * Función para la obtención del registro correspondiente a un horario en específico.
 * @param idHorario
 * @returns {Array}
 */
function obtenerDatosHorario(idHorario){
    var arrHorario = [];
    var prefijo = "r_";
    if(idHorario>0){
        $.ajax({
            url: '/horarioslaborales/getone',
            type: 'POST',
            datatype: 'json',
            async: false,
            cache: false,
            data: {id: idHorario},
            success: function (data) {
                var res = jQuery.parseJSON(data);
                if (res.length > 0) {
                    $.each(res, function (key, val) {
                      arrHorario.push( {
                            nombre:val.nombre,
                            nombre_alternativo:val.nombre_alternativo,
                            color:val.color,
                            hora_entrada:val.hora_entrada,
                            hora_salida:val.hora_salida,
                            hora_inicio_rango_ent:val.hora_inicio_rango_ent,
                            hora_final_rango_ent:val.hora_final_rango_ent,
                            hora_inicio_rango_sal:val.hora_inicio_rango_sal,
                            observacion:val.observacion,
                            horas_laborales:val.horas_laborales,
                            dias_laborales:val.dias_laborales
                        });
                    });
                }
            }
        });

    }
    return arrHorario;
}
/**
 * Función para la baja de un evento en el calendario
 * @param idEvento
 */
function bajaTurnoEnCalendario(idEvento){
    var ok=true;
    if(idEvento>0){
        var ok=$.ajax({
            url:'/Calendariolaboral/down/',
            type:'POST',
            datatype: 'json',
            async:false,
            data:{id:idEvento},
            success: function(data) {  //alert(data);
                var res = jQuery.parseJSON(data);
                /**
                 * Si se ha realizado correctamente el registro de baja de la tolerancia.
                 */
                $(".msjes").hide();
                if(res.result==1){
                    ok=true;
                    $("#divMsjePorSuccess").html("");
                    $("#divMsjePorSuccess").append(res.msj);
                    $("#divMsjeNotificacionSuccess").jqxNotification("open");
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
        }).responseText;
    }else {
        ok = false;
    }
    return ok;
}
/**
 * Función para calcular la cantidad de horas laborales transcurridas entre la hora de entrada y la hora de salida, el resultado se expresa en términos numéricos.
 * @param horaEntrada
 * @param horaSalida
 * @returns {number}
 */
function calcularCantidadHorasLaborales(horaEntrada,horaSalida){
    if(horaEntrada!=""&&horaSalida!=""){
        var horaEnt = numeroHoras(horaEntrada);
        var horaSal = numeroHoras(horaSalida);
        var calculo = parseFloat(horaSal) - parseFloat(horaEnt);
        return calculo.toFixed(2);
    }else return 0;
}
/**
 * Función para calcular el número de horas que representa la hora.
 * @param hora
 * @returns {*}
 */
function numeroHoras(hora){
    if(hora!=""){
        var arrHora = hora.split(":");
        var hEnt = parseFloat(arrHora[0]);
        var mEnt = parseFloat(arrHora[1]);
        var sEnt = parseFloat(arrHora[2]);
        var sEnMin = 0;
        var mEnHor = 0;
        if(sEnt>0){
            sEnMin = sEnt/60;
        }
        mEnt = mEnt + sEnMin;
        if(mEnt>0){
            mEnHor = mEnt/60;
        }
        hEnt = hEnt +mEnHor;
        return hEnt;
    }
    else return 0;
}
/**
 * Función para calcular el total de horas por semana.
 */
function sumarTotalHorasPorSemana(arrFechasPorSemana){
    var arr = $("#calendar").fullCalendar( 'clientEvents');
    var horasSemana1=0;
    var horasSemana2=0;
    var horasSemana3=0;
    var horasSemana4=0;
    var horasSemana5=0;
    var horasSemana6=0;
    $("#spSumaSemana1").html(0);
    $("#spSumaSemana2").html(0);
    $("#spSumaSemana3").html(0);
    $("#spSumaSemana4").html(0);
    $("#spSumaSemana5").html(0);
    $("#spSumaSemana6").html(0);
    $.each(arr,function(key,turno){
        var fechaIni = $.fullCalendar.formatDate(turno.start,'dd-MM-yyyy');
        var fechaFin = $.fullCalendar.formatDate(turno.end,'dd-MM-yyyy');
        var sep='-';
        $.each(arrFechasPorSemana,function(clave,valor){
            /**
             * Esto porque en algunos casos el horario no tiene fecha de finalización debido a que
             * su existencia es producto de haber jalado de la lista de horarios disponibles sobre el calendario
             */
            //alert(valor.fecha);
            if(fechaFin=="")fechaFin=fechaIni;
            if(valor.semana==1){
                if(procesaTextoAFecha(fechaIni,sep)<=procesaTextoAFecha(valor.fecha,sep)
                    &&procesaTextoAFecha(valor.fecha,sep)<=procesaTextoAFecha(fechaFin,sep)){
                    horasSemana1 += parseFloat(turno.horas_laborales);
                    //alert(turno.title+" entro en la semana 1 =>"+fechaIni+"<="+valor.fecha+"<="+fechaFin+" horas: "+turno.horas_laborales);

                }
            }
            if(valor.semana==2){
                if(procesaTextoAFecha(fechaIni,sep)<=procesaTextoAFecha(valor.fecha,sep)
                    &&procesaTextoAFecha(valor.fecha,sep)<=procesaTextoAFecha(fechaFin,sep)){
                    horasSemana2 += parseFloat(turno.horas_laborales);
                    //alert(turno.title+" entro en la semana 2 =>"+fechaIni+"<="+valor.fecha+"<="+fechaFin+" horas: "+turno.horas_laborales);
                }
            }
            if(valor.semana==3){
                if(procesaTextoAFecha(fechaIni,sep)<=procesaTextoAFecha(valor.fecha,sep)
                    &&procesaTextoAFecha(valor.fecha,sep)<=procesaTextoAFecha(fechaFin,sep)){
                    horasSemana3 += parseFloat(turno.horas_laborales);
                    //alert(turno.title+" entro en la semana 3 =>"+fechaIni+"<="+valor.fecha+"<="+fechaFin+" horas: "+turno.horas_laborales);
                }
            }
            if(valor.semana==4){
                if(procesaTextoAFecha(fechaIni,sep)<=procesaTextoAFecha(valor.fecha,sep)
                    &&procesaTextoAFecha(valor.fecha,sep)<=procesaTextoAFecha(fechaFin,sep)){
                    horasSemana4 += parseFloat(turno.horas_laborales);
                    //alert(turno.title+" entro en la semana 4 =>"+fechaIni+"<="+valor.fecha+"<="+fechaFin+" horas: "+turno.horas_laborales);
                }
            }
            if(valor.semana==5){
                if(procesaTextoAFecha(fechaIni,sep)<=procesaTextoAFecha(valor.fecha,sep)
                    &&procesaTextoAFecha(valor.fecha,sep)<=procesaTextoAFecha(fechaFin,sep)){
                    horasSemana5 += parseFloat(turno.horas_laborales);
                    //alert(turno.title+" entro en la semana 5 =>"+fechaIni+"<="+valor.fecha+"<="+fechaFin+" horas: "+turno.horas_laborales);
                }
            }
            if(valor.semana==6){
                if(procesaTextoAFecha(fechaIni,sep)<=procesaTextoAFecha(valor.fecha,sep)
                    &&procesaTextoAFecha(valor.fecha,sep)<=procesaTextoAFecha(fechaFin,sep)){
                    horasSemana6 += parseFloat(turno.horas_laborales);
                    //alert(turno.title+" entro en la semana 6 =>"+fechaIni+"<="+valor.fecha+"<="+fechaFin+" horas: "+turno.horas_laborales);
                }
            }
        });
    });
    $("#spSumaSemana1").html(horasSemana1);
    $("#spSumaSemana2").html(horasSemana2);
    $("#spSumaSemana3").html(horasSemana3);
    $("#spSumaSemana4").html(horasSemana4);
    $("#spSumaSemana5").html(horasSemana5);
    $("#spSumaSemana6").html(horasSemana6);
}