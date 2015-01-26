/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  21-10-2014
 */
$().ready(function () {

    $("#divMsjeNotificacionError").jqxNotification({
        width: '100%', position: "bottom-right", opacity: 0.9,
        autoOpen: false, animationOpenDelay: 800, autoClose: true, autoCloseDelay: 7000, template: "error"
    });

    $("#divMsjeNotificacionWarning").jqxNotification({
        width: '100%', position: "bottom-right", opacity: 0.9,
        autoOpen: false, animationOpenDelay: 800, autoClose: true, autoCloseDelay: 7000, template: "warning"
    });
    $("#divMsjeNotificacionSuccess").jqxNotification({
        width: '100%', position: "bottom-right", opacity: 0.9,
        autoOpen: false, animationOpenDelay: 800, autoClose: true, autoCloseDelay: 7000, template: "success"
    });
    $("#btnImprimirCalendario").on("click",function(){
        var opciones = {mode:"popup",popClose: false};
        $("#page-content").printArea(opciones);
    });
    $("#popupWindowHorario").jqxWindow({
        width: '100%',
        height: '100%',
        resizable: true,
        isModal: true,
        autoOpen: false,
        cancelButton: $("#btnCancelar"),
        modalOpacity: 0.01
    });
    var calendarEvents  = $('.calendar-events');
        /* Inicializa la funcionalidad de eventos: arrastrar y soltar */
        initEvents();

        /* Add new event in the events list */
        var eventInput      = $('#add-event');
        var eventInputVal   = '';

        // Cuando el botón adicionar es  seleccionado
        $('#add-event-btn').on('click', function(){
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
        });

        /* Initialize FullCalendar */
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var arrEventos = [
            {
                title: 'Gaming Day',
                start: new Date(y, m, 1),
                color: '#9b59b6'
            },
            {
                title: 'Live Conference',
                start: new Date(y, m, 3)
            },
            {
                title: 'Top Secret Project',
                start: new Date(y, m, 4),
                end: new Date(y, m, 8),
                color: '#1abc9c'
            },
            {
                id: 999,
                title: 'Gym (repeated)',
                start: new Date(y, m, d - 3, 15, 0),
                allDay: false
            },
            {
                id: 999,
                title: 'Gym (repeated)',
                start: new Date(y, m, d + 3, 15, 0),
                allDay: false
            },
            {
                title: 'Job Meeting',
                start: new Date(y, m, d, 16, 00),
                allDay: false,
                color: '#f39c12'
            },
            {
                title: 'Awesome Project',
                start: new Date(y, m, d, 9, 0),
                end: new Date(y, m, d, 12, 0),
                allDay: false,
                color: '#d35400'
            },
            {
                title: 'Book Reading',
                start: new Date(y, m, 15),
                end: new Date(y, m, 16),
                allDay: true,
                color: '#3498db'
            },
            {
                title: 'Party',
                start: new Date(y, m, d + 8, 21, 0),
                end: new Date(y, m, d + 8, 23, 30),
                allDay: false
            },
            {
                title: 'Follow me on Twitter',
                start: new Date(y, m, 20),
                end: new Date(y, m, 24),
                url: 'http://twitter.com/pixelcave',
                color: '#e74c3c'
            }
        ];
        arrHorarios = cargarHorariosRegistradosEnCalendario();
        if(arrHorarios.length>0){
            cargarHorariosRegistradosParaModificar(arrHorarios);
        }
        arrHorarios=[];
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'year,month,agendaWeek,agendaDay'
            },
            firstDay: 1,
            editable: true,
            droppable: true,
            selectable: true,

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
            events: arrHorarios,
            eventClick: function(calEvent, jsEvent, view) {
                /*if (event.url) {
                window.open(event.url);
                return false;
                }*/
                /*alert(event.id+":"+event.title);*/
                /*alert('Event: ' + calEvent.title);
                alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                alert('View: ' + view.name);
    */
                // change the border color just for fun
                //$(this).css('border-color', 'red');
                /*this.remove();*/
            }/*,
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
                $("#popupWindowHorario").jqxWindow('close');
            }
        }
    });
    /*
     *   Función para la inserción obligatoria de datos numéricos en los campos de clase.
     */
    $('.numeral').keyup(function (event) {
        if ($(this).val() != '') {
            $(this).val($(this).val().replace(/[^0-9]/g, ""));
        }
    });

    /*
     *   Función para la inserción obligatoria de letras distintas a números en los campos de clase.
     */
    $('.literal').keyup(function (event) {
        if ($(this).val() != '') {
            $(this).val($(this).val().replace(/[^A-Z,a-z,ñ,Ñ, ]/g, ""));
        }
    });
    $(document).keypress(OperaEvento);
    $(document).keyup(OperaEvento);
});
/*
 * Función para controlar la ejecución del evento esc con el teclado.
 */
function OperaEvento(evento) {
    if ((evento.type == "keyup" || evento.type == "keydown") && evento.which == "27") {
        $("#popupWindowHorario").jqxWindow('close');
    }
}

/* Function for initializing drag and drop event functionality */
var initEvents = function() {
    var calendarEvents  = $('.calendar-events');
    calendarEvents.find('li').each(function() {
        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        var eventObject = { title: $.trim($(this).text()), color: $(this).css('background-color') };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({ zIndex: 999, revert: true, revertDuration: 0 });
    });
};
/**
 * Función para el registro de horarios en espera (El primer estado de un horario) para su disponibilidad de asignación en las fechas dentro del calendario.
 * @returns {Array}
 */
function cargarHorariosRegistradosEnCalendario(){
    var arrHorarios = [];
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    $.ajax({
        url: '/calendariolaboral/gethorariosregistrados',
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
                       title: val.nombre,
                        start: new Date(yi, mi, di, he, me),
                        end: new Date(yf, mf, df, hs, ms),
                        allDay: true,
                        color: val.color
                    });
                });
            }
        }
    });
    return arrHorarios;
}
/**
 * Función para el despliegue en el lado izquierdo de todos los horarios registrados, dando la posibilidad de su modificación.
 * @author JLM
 * @param arrHorarios
 */
function cargarHorariosRegistradosParaModificar(arrHorarios){
    $("#ulHorariosEnEspera").html("");
    if(arrHorarios.length>0){
        $.each(arrHorarios, function (key, val) {
            /*$("#ulHorariosEnEspera").append("<li class='ui-draggable' style='background-color: rgb(155, 89, 182);position: relative; '>"+val.title+"</li>");*/

            var eventInput      = $('#txtNombreHorario');
            var eventInputVal   = '';
            //var valColor = $("#txtColorHorario").val();
            var valColor = val.color;
            //eventInputVal = eventInput.prop('value');
            eventInputVal = val.title;
            var calendarEvents  = $('.calendar-events');
            calendarEvents.append('<li style="background-color: '+valColor+'" class="ui-draggable">' + $('<div />').text(eventInputVal).html() + '</li>');

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
    var fechaIni = '01-01-2014';
    var fechaFin = '31-12-2020';
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