/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  18-12-2014
 */
function iniciarCalendarioLaboral(accion,tipoHorario,arrHorariosRegistrados,defaultGestion,defaultMes,defaultDia) {

    var calendarEvents  = $('.calendar-events');
    /* Inicializa la funcionalidad de eventos: arrastrar y soltar */
    initEvents();

    /* Add new event in the events list */
    //var eventInput      = $('#add-event');
    //var eventInputVal   = '';
    /*$('#add-event-btn').off();*/
    // Cuando el botón adicionar es  seleccionado
    /*$('#add-event-btn').on('click', function(){
        // Obteniendo el valor del input
        eventInputVal = eventInput.prop('value');
        limpiarMensajesErrorPorValidacionHorario();
        $("#popupWindowHorario").jqxWindow('open');
        $("#txtColorHorario").css({'background-color' : "#FFFFFF",'color' : "#FFFFFF"});
        $("#txtNombreHorario").focus();
        // Check if the user entered something
        if ( eventInputVal ) {

            // Add it to the events list
            calendarEvents.append('<li class="animation-slideDown">' + $('<div />').text(eventInputVal).html() + '</li>');

            // Clear input field
            eventInput.prop('value', '');

            // Init Events
            initEvents();
        }

        // Don't let the form submit
        return false;
    });*/

    /* Initialize FullCalendar */
    var optLeft = 'prev,next';
    var optRight = 'year,month,agendaWeek,agendaDay';
    var optEditable = true;
    var optDroppable = true;
    var optSelectable = true;
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
        editable: optEditable,
        droppable: optDroppable,
        selectable: optSelectable,
        drop: function(date, allDay) { // this function is called when something is dropped
            //alert("drop");
            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            // remove the element from the "Draggable Events" list
            /**
             * Se anula la eliminación del horario arrastrado
             */
            //$(this).remove();

        },
        events: arrHorariosRegistrados,
        /*eventClick: function(calEvent, jsEvent, view) {


            var idHorario = calEvent.class;
            idHorario = idHorario.replace("h_","");
            var ok = cargarModalHorario(idHorario);
            if(ok)
            {   var horario =$(this);
                $(this).remove();
                //$('#popupDescripcionHorario').modal('show');
                $("#btnDescartarHorario").on("click",function(){
                    horario.remove();

                    //$('#popupDescripcionHorario').modal('hide');

                });
            }
            else alert("Error al determinar los datos del horario.")

            alert('Event: ' + calEvent.title);
            alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
            alert('View: ' + view.name);


        },*/
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
                    });
                }else alert("Error al determinar los datos del horario.");
            }else {
                alert("El registro corresponde a un periodo de descanso");
            }
        }
        /*eventClick: function(event) {
            *//*alert("id:"+event.id);*//*
            $('#popupDescripcionHorario').modal('show');
        }*/
      /*  eventRender: function (event, element) {
            element.attr('href', 'javascript:void(0);');
            element.click(function() {


                *//*$("#startTime").html(moment(event.start).format('MMM Do h:mm A'));
                $("#endTime").html(moment(event.end).format('MMM Do h:mm A'));*//*
                *//*$("#eventInfo").html(event.description);
                $("#eventLink").attr('href', event.url);
                $("#eventContent").dialog({ modal: true, title: event.title, width:350});*//*
                //$('#popupDescripcionHorario').modal('show');
            });
        }*/
       /*,
         eventRender: function (event, element) {
         element.popover({
         title: event.title,
         placement:'auto',
         html:true,
         trigger : 'click',
         animation : 'true',
         content: event.msg,
         container:'body'
         });
         }*/
    });
    /**
     * Control del evento de solicitud de guardar el registro del horario.
     */
    /*$("#btnGuardarHorario").off();
    $("#btnGuardarHorario").on("click",function(){
        var ok = validaFormularioHorario()
        if (ok){
            var okk = guardaHorario()
            if(okk){
                var eventInput      = $('#txtNombreHorario');
                var eventInputVal   = '';
                var valColor = $("#txtColorHorario").val();
                eventInputVal = eventInput.prop('value');

                calendarEvents.append('<li style="background-color: '+valColor+'" class="ui-draggable">' + $('<div />').text(eventInputVal).html() + '</li>');

                // Clear input field
                eventInput.prop('value', '');

                // Init Events
                initEvents();
                //$("#popupWindowHorario").jqxWindow('close');
            }
        }
    });*/

}
/**
 * Función para inicializar las funcionalidad para el evento de arrastre y eliminación
 */
var initEvents = function() {
    var calendarEvents  = $('.calendar-events');
    calendarEvents.find('li').each(function() {
        /*Creando un nuevo objeto*/
        //alert("el id es:"+this.id);
        var eventObject = { className:'n_'+this.id,title: $.trim($(this).text()), color: $(this).css('background-color') };

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
        url: '/horarioslaborales/listDisponibles',
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
                        color: val.color
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
function obtenerHorariosRegistradosEnCalendarioPorPerfil(idPerfil,tipoHorario,fechaIni,fechaFin){
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
                    if(idHorarioLaboral==0) prefijo="d_";
                    arrHorariosRegistrados.push( {
                        id:val.id_calendariolaboral,
                        className:prefijo+idHorarioLaboral,
                        title: horario_nombre,
                        start: new Date(yi, mi, di, he, me),
                        end: new Date(yf, mf, df, hs, ms),
                        allDay: ctrlAllDay,
                        color: color
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
            /*$("#ulHorariosEnEspera").append("<li class='ui-draggable' style='background-color: rgb(155, 89, 182);position: relative; '>"+val.title+"</li>");*/

            var eventInput      = $('#txtNombreHorario');
            var eventInputVal   = '';
            //var valColor = $("#txtColorHorario").val();
            var valId = val.id;
            var valColor = val.color;
            //eventInputVal = eventInput.prop('value');
            eventInputVal = val.title;
            var calendarEvents  = $('.calendar-events');
            calendarEvents.append('<li style="background-color: '+valColor+'" class="ui-draggable '+val.class+'" id="'+valId+'">' + $('<div />').text(eventInputVal).html() + '</li>');

            // Clear input field
            /*eventInput.prop('value', '');*/

            // Init Events
            initEvents();


            /*arrHorarios.push( {
             id:val.id_horariolaboral,
             title: val.nombre,
             start: new Date(yi, mi, di, he, me),
             end: new Date(yf, mf, df, hs, ms),
             allDay: true,
             color: val.color
             });*/
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

    /*var source =
    {
        datatype: "json",
        datafields: [
            {name: 'nro_row', type: 'integer'},
            {name: 'id', type: 'integer'},
            {name: 'tolerancia', type: 'integer'},
            {name: 'tipo_acumulacion', type: 'integer'},
            {name: 'acumulacion_descripcion', type: 'time'},
            {name: 'consideracion_retraso', type: 'integer'},
            {name: 'consideracion_retraso_descripcion', type: 'numeric'},
            {name: 'descripcion', type: 'string'},
            {name: 'observacion', type: 'string'},
            {name: 'estado', type: 'string'},
            {name: 'estado_descripcion', type: 'string'}
        ],
        url: '/tolerancias/list?estado=1',
        cache: false
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    var theme = prepareSimulator("grid");
    $("#jqxgridtolerancias").jqxGrid(
        {
            theme: theme,
            width: '100%',
            height: '10%',
            source: dataAdapter,
            pageable: true,
            autorowheight: true,
            columns: [
                {
                    text: 'Nro.',
                    filterable: false,
                    columntype: 'number',
                    width: 40,
                    cellsalign: 'center',
                    align: 'center',
                    cellsrenderer: rownumberrenderer
                },
                {
                    text: 'Selecci&oacute;n',
                    datafield: 'estado_descripcion',
                    width: 70,
                    cellsalign: 'center',
                    align: 'center',
                    sortable: false,
                    showfilterrow: false,
                    filterable: false,
                    columntype: 'number',
                    cellsrenderer: function (rowline) {
                        ctrlrow = rowline
                        var dataRecord = $("#jqxgridtolerancias").jqxGrid('getrowdata', ctrlrow);
                        var checked="";
                        if(idTolerancia==dataRecord.id){
                            checked = "checked";
                        }
                        return "<div style='width: 100%' align='center'><input type='radio' id='rd_"+dataRecord.id+"' class='rdTolerancias' name='rdToleracias' "+checked+"/></div>";

                    }
                },
                {
                    text: 'Minutos',
                    filtertype: 'checkedlist',
                    datafield: 'tolerancia',
                    width: 80,
                    cellsalign: 'center',
                    align: 'center',
                    hidden: false
                },
                {
                    text: 'Acumulaci&oacute;n',
                    filtertype: 'checkedlist',
                    datafield: 'acumulacion_descripcion',
                    width: 100,
                    align: 'center',
                    cellsalign: 'center',
                    hidden: false
                },
                {
                    text: 'Consideraci&oacute;n',
                    filtertype: 'checkedlist',
                    datafield: 'consideracion_retraso_descripcion',
                    width: 100,
                    align: 'center',
                    hidden: false
                },
                {
                    text: 'Descripci&oacute;n',
                    filtertype: 'checkedlist',
                    datafield: 'descripcion',
                    width: 350,
                    align: 'center',
                    hidden: false
                },
                {
                    text: 'Observaci&oacute;n',
                    filtertype: 'checkedlist',
                    datafield: 'observacion',
                    width: 100,
                    align: 'center',
                    hidden: false
                },
            ]
        });*/

    /*$("#jqxgridtolerancias").off();
    $("#jqxgridtolerancias").on('rowselect', function (event) {
        var offset = $("#jqxgridtolerancias").offset();
        var rowindex = event.args.rowindex;
        newrow = rowindex;
        var dataRecord = $("#jqxgridtolerancias").jqxGrid('getrowdata', newrow);
        $(".rdTolerancias").prop("checked",false);
        $("#rd_"+dataRecord.id).prop("checked",true);
    });*/
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
                    });
                }
            }
        });
        return true;
    }else return false;
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