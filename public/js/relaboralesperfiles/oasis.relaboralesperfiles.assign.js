/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  02-02-2015
 */
/**
 * Función para la carga la grilla de asignaciones.
 * @param idPerfilLaboral
 * @param perfilLaboral
 * @param grupo
 * @param tipoHorario
 * @param tipoHorarioDescripcion
 */
function cargarGrillaAsignaciones(idPerfilLaboral,perfilLaboral,grupo,tipoHorario,tipoHorarioDescripcion) {
    var source =
    {
        datatype: "json",
        datafields: [
            {name: 'nro_row', type: 'integer'},
            {name: 'id', type: 'integer'},
            {name: 'padre_id', type: 'integer'},
            {name: 'id_ubicacion', type: 'integer'},
            {name: 'ubicacion', type: 'string'},
            {name: 'id_estacion', type: 'integer'},
            {name: 'estacion', type: 'string'},
            {name: 'color', type: 'string'},
            {name: 'id_perfillaboral', type: 'integer'},
            {name: 'perfil_laboral', type: 'string'},
            {name: 'fecha_ini', type: 'date'},
            {name: 'fecha_fin', type: 'date'},
            {name: 'estado', type: 'integer'},
            {name: 'estado_descripcion', type: 'string'},
            {name: 'tipo_horario', type: 'integer'},
            {name: 'tipo_horario_descripcion', type: 'string'},
            {name: 'cantidad', type: 'integer'}

        ],
        url: '/relaboralesperfiles/listgroup?id='+idPerfilLaboral,
        cache: false
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    cargarRegistrosDeTurnosLaborales();
    function cargarRegistrosDeTurnosLaborales() {
        var theme = prepareSimulator("grid");
        $("#divGridAsignaciones").jqxGrid(
            {
                theme: theme,
                width: '100%',
                height: '100%',
                source: dataAdapter,
                sortable: true,
                altRows: true,
                groupable: false,
                columnsresize: true,
                pageable: true,
                pagerMode: 'advanced',
                showfilterrow: true,
                filterable: true,
                showtoolbar: true,
                autorowheight: true,
                rendertoolbar: function (toolbar) {
                    var me = this;
                    var container = $("<div></div>");
                    toolbar.append(container);
                    container.append("<button id='addrowbutton' class='btn btn-sm btn-primary' type='button' title='Nueva Asignaci&oacute;n Grupal'><i class='fa fa-plus-square fa-2x text-info' title='Nueva Asignaci&oacute;n Grupal.'/></i></button>");
                    container.append("<button id='editrowbutton' class='btn btn-sm btn-primary' type='button' title='Nueva Asignaci&oacute;n Individual'><i class='fa fa-pencil-square fa-2x text-info' title='Nueva Asignaci&oacute;n Individual.'/></button>");
                    container.append("<button id='approverowbuttonturn' class='btn btn-sm btn-primary' type='button' title='Aprobar Calendario'><i class='fa fa-check-square fa-2x text-info' title='Aprobar registro'></i></button>");
                    /*container.append("<button id='deleterowbuttonturn' class='btn btn-sm btn-primary' type='button'><i class='fa fa-minus-square fa-2x text-info' title='Dar de baja al registro.'/></i></button>");*/
                    container.append("<button id='viewrowbuttonturn' class='btn btn-sm btn-primary' type='button' title='Vista Calendario'><i class='fa fa-calendar fa-2x text-info' title='Vista Calendarios Laborales por Perfil.'/></i></button>");
                    container.append("<button id='quotasrowbuttonturn' class='btn btn-sm btn-primary' type='button' title='Asignar cupos'><i class='fa fa fa-users fa-2x text-info' title='Asignar Cupos'></i></button>");
                    $("#addrowbutton").jqxButton();
                    $("#editrowbutton").jqxButton();
                    $("#approverowbuttonturn").jqxButton();
                    //$("#deleterowbuttonturn").jqxButton();
                    $("#viewrowbuttonturn").jqxButton();
                    $("#quotasrowbuttonturn").jqxButton();

                    $("#hdnIdPerfilLaboralNueva").val(0);
                    // Registrar nuevo turno laboral.
                    $("#addrowbutton").off();
                    $("#addrowbutton").on('click', function () {
                        /**
                         * Se habilita la vista del calendario laboral con la opcion de registrar nuevo
                         */
                        $('#jqxTabsAsignacionPerfiles').jqxTabs('enableAt', 0);
                        $('#jqxTabsAsignacionPerfiles').jqxTabs('enableAt', 1);
                        $('#jqxTabsAsignacionPerfiles').jqxTabs('enableAt', 2);
                        $('#jqxTabsAsignacionPerfiles').jqxTabs({selectedItem: 2});
                        $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 3);
                        $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 4);
                        $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 5);

                        $("#ddPerfilLaboralNew").text(perfilLaboral);
                        if(grupo!=''&&grupo!=null)$("#ddGrupoNew").text(grupo);
                        else $("#ddGrupoNew").html("&nbsp;");
                        $("#ddTipoHorarioNew").text(tipoHorarioDescripcion);

                        limpiarMensajesErrorPorValidacionNuevoRegistroAsignacionPerfilLaboral(1);
                        cargarUbicacionesPrincipales(1,0);

                        $("#txtFechaIniNew").jqxDateTimeInput({ enableBrowserBoundsDetection: true, height: 24, formatString:'dd-MM-yyyy' });
                        $("#txtFechaFinNew").jqxDateTimeInput({ enableBrowserBoundsDetection: true, height: 24, formatString:'dd-MM-yyyy' });

                        definirListaDualNueva(1,0,100,"","");
                        $("#hdnIdPerfilLaboralNew").val(idPerfilLaboral);
                        $("#lstUbicacionesNew").off();
                        $("#lstUbicacionesNew").on("change",function(){
                            cargarEstaciones(1,$(this).val(),0);
                            definirListaDualNueva(1,0,$(this).val(),"","");
                        });
                    });
                    /**
                     * Modificar registro de asignación de Perfil Laboral.
                     */
                    $("#editrowbutton").off();
                    $("#editrowbutton").on('click', function () {
                        var selectedrowindex = $("#divGridAsignaciones").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGridAsignaciones').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                /**
                                 * Para el caso cuando el estado de la asignación esté ACTIVO, de otro modo no es admisible.
                                 */
                                if (dataRecord.estado == 1) {
                                    /**
                                     * Se habilita la vista del formulario para la modificación de asignación grupal de perfil laboral.
                                     */
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('enableAt', 0);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('enableAt', 1);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 2);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('enableAt', 3);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 4);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs({selectedItem: 3});
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 4);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 5);

                                    $("#ddPerfilLaboralEdit").text(perfilLaboral);
                                    if(grupo!=''&&grupo!=null)$("#ddGrupoEdit").text(grupo);
                                    else $("#ddGrupoEdit").html("&nbsp;");
                                    $("#ddTipoHorarioEdit").text(tipoHorarioDescripcion);

                                    limpiarMensajesErrorPorValidacionNuevoRegistroAsignacionPerfilLaboral(2);
                                    cargarUbicacionesPrincipales(2,dataRecord.id_ubicacion);
                                    var idEstacion = 0;
                                    if(dataRecord.id_estacion!=null) idEstacion = dataRecord.id_estacion;
                                    cargarEstaciones(2,dataRecord.id_ubicacion,idEstacion);

                                    $("#txtFechaIniEdit").jqxDateTimeInput({ value:dataRecord.fecha_ini,enableBrowserBoundsDetection: true, height: 24, formatString:'dd-MM-yyyy' });
                                    $("#txtFechaFinEdit").jqxDateTimeInput({ value:dataRecord.fecha_fin,enableBrowserBoundsDetection: true, height: 24, formatString:'dd-MM-yyyy' });
                                    var fechaIni = fechaConvertirAFormato(dataRecord.fecha_ini,'-');
                                    var fechaFin = fechaConvertirAFormato(dataRecord.fecha_fin,'-');
                                    definirListaDualNueva(2,dataRecord.id_perfillaboral,dataRecord.id,fechaIni,fechaFin);

                                    $("#hdnIdPerfilLaboralEdit").val(idPerfilLaboral);
                                    $("#lstUbicacionesEdit").off();
                                    $("#lstUbicacionesEdit").on("change",function(){
                                        cargarEstaciones(2,$(this).val(),idEstacion);
                                        definirListaDualNueva(2,dataRecord.id_perfillaboral,$(this).val(),fechaIni,fechaFin);
                                    });

                                } else {
                                    var msj = "Debe seleccionar un registro en estado ACTIVO para posibilitar la modificaci&oacute;n de los registros correspondientes.";
                                    $("#divMsjePorError").html("");
                                    $("#divMsjePorError").append(msj);
                                    $("#divMsjeNotificacionError").jqxNotification("open");
                                }
                            }
                        } else {
                            var msj = "Debe seleccionar un registro necesariamente.";
                            $("#divMsjePorError").html("");
                            $("#divMsjePorError").append(msj);
                            $("#divMsjeNotificacionError").jqxNotification("open");
                        }
                        $("#btnImprimirCalendario").hide();
                        $("#divArrastre").show();
                        $("#hdnIdPerfilLaboralParaCuposCalendario").val(0);
                        $("#hdnTipoHorarioParaCuposCalendario").val(0);
                        $("#hdnFechaIniParaCuposCalendario").val(0);
                        $("#hdnFechaFinParaCuposCalendario").val(0);
                    });
                    $("#approverowbuttonturn").off();
                    $("#approverowbuttonturn").on('click', function () {
                        var selectedrowindex = $("#divGridPerfilesLaborales").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGridPerfilesLaborales').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                /**
                                 * Para el caso cuando el estado del turno esté EN ELABORACIÓN, de otro modo no es admisible.
                                 */
                                if (dataRecord.estado == 2) {
                                    /**
                                     * Se habilita la vista del calendario laboral con la opcion de registrar nuevo
                                     */
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('enableAt', 0);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 1);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 2);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('enableAt', 3);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('enableAt', 4);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs({selectedItem: 4});
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 5);

                                    $("#ddPerfilLaboralCalendario").text(perfilLaboral);
                                    if(grupo!=''&&grupo!=null)$("#ddGrupoCalendario").text(grupo);
                                    else $("#ddGrupoCalendario").html("&nbsp;");
                                    $("#ddTipoHorarioCalendario").text(tipoHorarioDescripcion);
                                    $("#dtRangoFechasCalendario").hide();
                                    $("#ddRangoFechasCalendario").hide();
                                    $("#spanPrefijoCalendarioLaboral").html("Aprobaci&oacute;n ");
                                    $("#calendar").html("");
                                    var date = new Date();
                                    var d = date.getDate();
                                    var m = date.getMonth();
                                    var y = date.getFullYear();
                                    var accion = 3;
                                    var fechaActual = fechaConvertirAFormato(new Date(),'-');
                                    var formattedDate = dataRecord.fecha_ini;
                                    var d = formattedDate.getDate();
                                    var m =  formattedDate.getMonth();
                                    m += 1;  // Los meses en JavaScript son 0-11
                                    var y = formattedDate.getFullYear();
                                    var fechaIni = d+"-"+m+"-"+y;
                                    var defaultDay=d;
                                    var defaultMonth = m-1;
                                    var defaultYear = y;
                                    if(dataRecord.tipo_horario==1||dataRecord.tipo_horario==2){
                                        var arrFechaActual  = fechaActual.split("-");
                                        defaultDay=arrFechaActual[0];
                                        defaultMonth = arrFechaActual[1]-1;
                                        defaultYear = arrFechaActual[2];
                                    }
                                    var fechaFin = fechaConvertirAFormato(dataRecord.fecha_fin,'-');
                                    var tipoHorario = dataRecord.tipo_horario;
                                    $("#hdnTipoHorarioParaCalendario").val(tipoHorario);
                                    $("#hdnIdPerfilLaboralParaCalendario").val(idPerfilLaboral);
                                    var arrHorariosPreviosRegistrados = [];
                                    var arrHorariosSiguientesRegistrados = [];
                                    if(tipoHorario==3){
                                        var arrFechaIni = fechaIni.split("-");
                                        var fechaIniRango ="01-"+arrFechaIni[1]+"-"+arrFechaIni[2];
                                        $("#hdnFechaIniParaCalendario").val(fechaIniRango);
                                        var fechaFinRango = obtenerUltimoDiaMes(fechaIniRango);
                                        $("#hdnFechaFinParaCalendario").val(fechaFinRango);
                                        var fechaIniSemanaPrevia = obtenerFechaMenosDias(fechaIniRango,10);
                                        var fechaFinSemanaPrevia = obtenerFechaMenosDias(fechaIniRango,1);
                                        arrHorariosPreviosRegistrados = obtenerHorariosRegistradosEnCalendarioPorPerfil(idPerfilLaboral,tipoHorario,false,fechaIniSemanaPrevia,fechaFinSemanaPrevia);
                                        var fechaIniSemanaSiguiente = obtenerFechaMasDias(fechaFinRango,1);
                                        var fechaFinSemanaSiguiente = obtenerFechaMasDias(fechaFinRango,10);
                                        arrHorariosSiguientesRegistrados = obtenerHorariosRegistradosEnCalendarioPorPerfil(idPerfilLaboral,tipoHorario,false,fechaIniSemanaSiguiente,fechaFinSemanaSiguiente);
                                    }else{
                                        $("#hdnFechaIniParaCalendario").val("00-00-0000");
                                        $("#hdnFechaFinParaCalendario").val("00-00-0000");
                                    }
                                    var arrHorariosRegistrados = obtenerHorariosRegistradosEnCalendarioPorPerfil(dataRecord.id_perfillaboral,tipoHorario,true,fechaIni,fechaFin);
                                    cargarHorariosDisponibles(obtenerHorariosDisponibles(tipoHorario));
                                    var arrFechasPorSemana = iniciarCalendarioLaboral(accion,tipoHorario,arrHorariosRegistrados,defaultYear,defaultMonth,defaultDay);
                                    /**
                                     * Se adicionan los horarios del mes anterior y mes siguiente en caso de ser necesarios para su contabilización pero sin la posibilidad de modificación.
                                     */
                                    $("#calendar").fullCalendar('addEventSource', arrHorariosPreviosRegistrados);
                                    $("#calendar").fullCalendar('addEventSource', arrHorariosSiguientesRegistrados);
                                    cargarJornadasLaborales(accion,dataRecord.id_jornada_laboral);
                                    cargarTolerancias(accion,dataRecord.id_tolerancia);
                                    sumarTotalHorasPorSemana(arrFechasPorSemana,"inicio-modificacion");
                                    $("#lstJornadasLaborales").off();
                                    $("#lstJornadasLaborales").on("change",function(){
                                        sumarTotalHorasPorSemana(arrFechasPorSemana);
                                    });
                                    $("#divEstadoCalendario").html("");
                                    var spanEstadoCalendario = "Estado: ";
                                    switch (dataRecord.estado){
                                        case 0:spanEstadoCalendario+="<span class='label label-primary'><i class='fa fa-thumbs-o-down'></i> "+dataRecord.estado_descripcion+"</span>";break;
                                        case 1:spanEstadoCalendario+="<span class='label label-primary'><i class='fa fa-cogs'></i> "+dataRecord.estado_descripcion+"</span>";break;
                                        case 2:spanEstadoCalendario+="<span class='label label-primary'><i class='hi hi-thumbs-up'></i> "+dataRecord.estado_descripcion+"</span>";break;
                                        case 3:spanEstadoCalendario+="<span class='label label-success'><i class='gi gi-ok_2'></i> "+dataRecord.estado_descripcion+"</span>";break;
                                        case 4:spanEstadoCalendario+="<span class='label label-primary'><i class='fa fa-lock'></i> "+dataRecord.estado_descripcion+"</span>";break;
                                    }
                                    if(dataRecord.estado>=0){
                                        $("#divEstadoCalendario").html(spanEstadoCalendario);
                                    }
                                } else {
                                    var msj = "Debe seleccionar un registro en estado ELABORADO para posibilitar la APROBACI&Oacute;N de los registros correspondientes.";
                                    $("#divMsjePorError").html("");
                                    $("#divMsjePorError").append(msj);
                                    $("#divMsjeNotificacionError").jqxNotification("open");
                                }
                                $("#divLstTolerancias").show();
                                $("#divDatosTolerancia").show();
                                $("#divGrupoBotonesAprobacion").show();
                                $("#divGrupoBotonesElaboracion").hide();
                            }
                        } else {
                            var msj = "Debe seleccionar un registro necesariamente.";
                            $("#divMsjePorError").html("");
                            $("#divMsjePorError").append(msj);
                            $("#divMsjeNotificacionError").jqxNotification("open");
                        }
                        $("#btnImprimirCalendario").hide();
                        $("#divArrastre").show();
                        $("#hdnIdPerfilLaboralParaCuposCalendario").val(0);
                        $("#hdnTipoHorarioParaCuposCalendario").val(0);
                        $("#hdnFechaIniParaCuposCalendario").val(0);
                        $("#hdnFechaFinParaCuposCalendario").val(0);
                    });
                    /* Ver el calendario registrado.*/
                    $("#viewrowbuttonturn").off();
                    $("#viewrowbuttonturn").on('click', function () {
                        var selectedrowindex = $("#divGridPerfilesLaborales").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGridPerfilesLaborales').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                /**
                                 * Para el caso cuando el estado del turno esté minimamente EN ELABORACIÓN, de otro modo no es admisible.
                                 */
                                if (dataRecord.estado >= 1) {
                                    /**
                                     * Se habilita la vista del calendario laboral con la opcion de registrar nuevo
                                     */
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('enableAt', 0);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 1);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 2);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('enableAt', 3);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('enableAt', 4);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs({selectedItem: 4});
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 5);

                                    $("#ddPerfilLaboralCalendario").text(perfilLaboral);
                                    if(grupo!=''&&grupo!=null)$("#ddGrupoCalendario").text(grupo);
                                    else $("#ddGrupoCalendario").html("&nbsp;");
                                    $("#ddTipoHorarioCalendario").text(tipoHorarioDescripcion);
                                    var fechaIniRango = fechaConvertirAFormato(dataRecord.fecha_ini,'-');
                                    var fechaFinRango = fechaConvertirAFormato(dataRecord.fecha_fin,'-');
                                    $("#dtRangoFechasCalendario").show();
                                    $("#ddRangoFechasCalendario").show();
                                    $("#ddRangoFechasCalendario").text(fechaIniRango+" AL "+fechaFinRango);
                                    $("#spanPrefijoCalendarioLaboral").html("Vista ");
                                    $("#calendar").html("");
                                    var date = new Date();
                                    var d = date.getDate();
                                    var m = date.getMonth();
                                    var y = date.getFullYear();
                                    var accion = 5;
                                    var fechaActual = fechaConvertirAFormato(new Date(),'-');
                                    var formattedDate = dataRecord.fecha_ini;
                                    var d = formattedDate.getDate();
                                    var m =  formattedDate.getMonth();
                                    m += 1;  // Los meses en JavaScript son 0-11
                                    var y = formattedDate.getFullYear();
                                    var fechaIni = d+"-"+m+"-"+y;
                                    var defaultDay=d;
                                    var defaultMonth = m-1;
                                    var defaultYear = y;
                                    if(dataRecord.tipo_horario==1||dataRecord.tipo_horario==2){
                                        var arrFechaActual  = fechaActual.split("-");
                                        defaultDay=arrFechaActual[0];
                                        defaultMonth = arrFechaActual[1]-1;
                                        defaultYear = arrFechaActual[2];
                                    }
                                    var fechaFin = fechaConvertirAFormato(dataRecord.fecha_fin,'-');
                                    var tipoHorario = dataRecord.tipo_horario;
                                    $("#hdnTipoHorarioParaCalendario").val(tipoHorario);
                                    $("#hdnIdPerfilLaboralParaCalendario").val(idPerfilLaboral);
                                    var arrHorariosPreviosRegistrados = [];
                                    var arrHorariosSiguientesRegistrados = [];
                                    if(tipoHorario==3){
                                        var arrFechaIni = fechaIni.split("-");
                                        var fechaIniRango ="01-"+arrFechaIni[1]+"-"+arrFechaIni[2];
                                        $("#hdnFechaIniParaCalendario").val(fechaIniRango);
                                        var fechaFinRango = obtenerUltimoDiaMes(fechaIniRango);
                                        $("#hdnFechaFinParaCalendario").val(fechaFinRango);
                                        var fechaIniSemanaPrevia = obtenerFechaMenosDias(fechaIniRango,10);
                                        var fechaFinSemanaPrevia = obtenerFechaMenosDias(fechaIniRango,1);
                                        arrHorariosPreviosRegistrados = obtenerHorariosRegistradosEnCalendarioPorPerfil(idPerfilLaboral,tipoHorario,false,fechaIniSemanaPrevia,fechaFinSemanaPrevia);
                                        var fechaIniSemanaSiguiente = obtenerFechaMasDias(fechaFinRango,1);
                                        var fechaFinSemanaSiguiente = obtenerFechaMasDias(fechaFinRango,10);
                                        arrHorariosSiguientesRegistrados = obtenerHorariosRegistradosEnCalendarioPorPerfil(idPerfilLaboral,tipoHorario,false,fechaIniSemanaSiguiente,fechaFinSemanaSiguiente);
                                    }else{
                                        $("#hdnFechaIniParaCalendario").val("00-00-0000");
                                        $("#hdnFechaFinParaCalendario").val("00-00-0000");
                                    }
                                    var arrHorariosRegistrados = obtenerHorariosRegistradosEnCalendarioPorPerfil(dataRecord.id_perfillaboral,tipoHorario,false,fechaIni,fechaFin);
                                    cargarHorariosDisponibles(obtenerHorariosDisponibles(tipoHorario));
                                    var arrFechasPorSemana = iniciarCalendarioLaboral(accion,tipoHorario,arrHorariosRegistrados,defaultYear,defaultMonth,defaultDay);
                                    /**
                                     * Se adicionan los horarios del mes anterior y mes siguiente en caso de ser necesarios para su contabilización pero sin la posibilidad de modificación.
                                     */
                                    $("#calendar").fullCalendar('addEventSource', arrHorariosPreviosRegistrados);
                                    $("#calendar").fullCalendar('addEventSource', arrHorariosSiguientesRegistrados);
                                    cargarJornadasLaborales(accion,dataRecord.id_jornada_laboral);
                                    cargarTolerancias(accion,dataRecord.id_tolerancia);
                                    sumarTotalHorasPorSemana(arrFechasPorSemana,"inicio-modificacion");
                                    $("#lstJornadasLaborales").off();
                                    $("#lstJornadasLaborales").on("change",function(){
                                        sumarTotalHorasPorSemana(arrFechasPorSemana);
                                    });
                                    $("#divEstadoCalendario").html("");
                                    var spanEstadoCalendario = "Estado: ";
                                    switch (dataRecord.estado){
                                        case 0:spanEstadoCalendario+="<span class='label label-primary'><i class='fa fa-thumbs-o-down'></i> "+dataRecord.estado_descripcion+"</span>";break;
                                        case 1:spanEstadoCalendario+="<span class='label label-primary'><i class='fa fa-cogs'></i> "+dataRecord.estado_descripcion+"</span>";break;
                                        case 2:spanEstadoCalendario+="<span class='label label-primary'><i class='hi hi-thumbs-up'></i> "+dataRecord.estado_descripcion+"</span>";break;
                                        case 3:spanEstadoCalendario+="<span class='label label-success'><i class='gi gi-ok_2'></i> "+dataRecord.estado_descripcion+"</span>";break;
                                        case 4:spanEstadoCalendario+="<span class='label label-primary'><i class='fa fa-lock'></i> "+dataRecord.estado_descripcion+"</span>";break;
                                    }
                                    if(dataRecord.estado>=0){
                                        $("#divEstadoCalendario").html(spanEstadoCalendario);
                                    }
                                } else {
                                    var msj = "Debe seleccionar un registro en estado ELABORADO para posibilitar la APROBACI&Oacute;N de los registros correspondientes.";
                                    $("#divMsjePorError").html("");
                                    $("#divMsjePorError").append(msj);
                                    $("#divMsjeNotificacionError").jqxNotification("open");
                                }
                                $("#divLstTolerancias").show();
                                $("#divDatosTolerancia").show();
                                $("#divGrupoBotonesAprobacion").hide();
                                $("#divGrupoBotonesElaboracion").hide();
                            }
                        } else {
                            var msj = "Debe seleccionar un registro necesariamente.";
                            $("#divMsjePorError").html("");
                            $("#divMsjePorError").append(msj);
                            $("#divMsjeNotificacionError").jqxNotification("open");
                        }
                        $("#btnImprimirCalendario").show();
                        $("#divArrastre").hide();
                        $("#hdnIdPerfilLaboralParaCuposCalendario").val(0);
                        $("#hdnTipoHorarioParaCuposCalendario").val(0);
                        $("#hdnFechaIniParaCuposCalendario").val(0);
                        $("#hdnFechaFinParaCuposCalendario").val(0);
                    });
                    $("#quotasrowbuttonturn").off();
                    $("#quotasrowbuttonturn").on('click', function () {
                        var selectedrowindex = $("#divGridPerfilesLaborales").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            $("#spanPrefijoCalendarioLaboral").html("Cupos por ");
                            var dataRecord = $('#divGridPerfilesLaborales').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                /**
                                 * Para el caso cuando el estado del turno esté ELABORADO, de otro modo no es admisible.
                                 */
                                if (dataRecord.estado == 3) {
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('enableAt', 0);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 1);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 2);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('enableAt', 3);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('disableAt', 4);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs('enableAt', 5);
                                    $('#jqxTabsAsignacionPerfiles').jqxTabs({selectedItem: 5});

                                    $("#spanPrefijoCuposCalendarioLaboral").html("Cupos por ");
                                    $("#ddPerfilLaboralCupos").text(perfilLaboral);
                                    if(grupo!=''&&grupo!=null)$("#ddGrupoCupos").text(grupo);
                                    else $("#ddGrupoCupos").html("&nbsp;");
                                    $("#ddTipoHorarioCupos").text(tipoHorarioDescripcion);
                                    var fechaIniRango = fechaConvertirAFormato(dataRecord.fecha_ini,'-');
                                    var fechaFinRango = fechaConvertirAFormato(dataRecord.fecha_fin,'-');
                                    $("#ddRangoFechas").text(fechaIniRango+" AL "+fechaFinRango);
                                    $("#calendar").html("");
                                    cargarCupos(0,idPerfilLaboral,fechaIniRango,fechaFinRango);
                                    $("#hdnIdPerfilLaboralParaCuposCalendario").val(dataRecord.id_perfillaboral);
                                    $("#hdnTipoHorarioParaCuposCalendario").val(dataRecord.tipo_horario);
                                    $("#hdnFechaIniParaCuposCalendario").val(dataRecord.fecha_ini);
                                    $("#hdnFechaFinParaCuposCalendario").val(dataRecord.fecha_fin);
                                }
                                else {
                                    var msj = "Debe seleccionar un registro en estado APROBADO para posibilitar la asignaci&oacute;n de cupos correspondientes.";
                                    $("#divMsjePorError").html("");
                                    $("#divMsjePorError").append(msj);
                                    $("#divMsjeNotificacionError").jqxNotification("open");
                                }
                            }
                        }
                    });
                },
                columns: [
                    {
                        text: 'Nro.', /*datafield: 'nro_row',*/
                        sortable: false,
                        filterable: false,
                        editable: false,
                        groupable: false,
                        draggable: false,
                        resizable: false,
                        columntype: 'number',
                        width: 50,
                        cellsalign: 'center',
                        align: 'center',
                        cellsrenderer: rownumberrenderer
                    }
                    ,
                    {
                        text: 'Estado',
                        filtertype: 'checkedlist',
                        datafield: 'estado_descripcion',
                        width: 100,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false,
                        cellclassname: cellclass
                    },
                    {
                        text: 'Ubicaci&oacute;n',
                        columntype: 'dropdownlist',
                        datafield: 'ubicacion',
                        width: 200,
                        cellsalign: 'center',
                        align: 'center'
                    },
                    {
                        text: 'Estaci&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'estacion',
                        width: 130,
                        cellsalign: 'center',
                        align: 'center'
                    },
                    {
                        text: 'Fecha Inicio',
                        datafield: 'fecha_ini',
                        filtertype: 'range',
                        width: 90,
                        cellsalign: 'center',
                        cellsformat: 'dd-MM-yyyy',
                        align: 'center'
                    },
                    {
                        text: 'Fecha Fin',
                        datafield: 'fecha_fin',
                        filtertype: 'range',
                        width: 90,
                        cellsalign: 'center',
                        cellsformat: 'dd-MM-yyyy',
                        align: 'center'
                    },
                    {
                        text: 'Cantidad',
                        filtertype: 'checkedlist',
                        datafield: 'cantidad',
                        width: 200,
                        cellsalign: 'center',
                        align: 'center'
                    },
                ]
            });
    }

    /**
     * Eventos
     */
    /*$("#jqxgridmovilidad").on('cellendedit', function (event) {
        var args = event.args;
        $("#cellendeditevent").text("Event Type: cellendedit, Column: " + args.datafield + ", Row: " + (1 + args.rowindex) + ", Value: " + args.value);
    });*/
}

/**
 * Función para validar los datos del formulario de nuevo registro de calendario laboral.
 * @returns {boolean} True: La validación fue correcta; False: La validación anuncia que hay errores en el formulario.
 */
function validaFormularioPorRegistroCalendarioLaboral() {
    var ok = true;

    return ok;
}
/**
 * Función para la limpieza de los mensajes de error debido a la validación del formulario para registro de calendario laboral.
 */
function limpiarMensajesErrorPorValidacionCalendarioLaboral() {
}
/**
 * Función para el registro de la movilidad de personal.
 */
function guardarRegistroCalendarioLaboral() {
    var ok = false;
    var swCargo = 0;
    var idRelaboral = $("#hdnIdRelaboralPorMovilidad").val();
    var idRelaboralMovilidad = $("#hdnIdRelaboralMovilidadModificar").val();
    var idMemorandum = 0;
    var idOrganigrama = 0;
    var idUbicacion = 0;
    var idArea = 0;
    var swOrganigrama = 0;
    var swUbicacion = 0;
    var swCargo = 0;
    var chAi = 0;
    if ($("#chkAi").is(':checked')) {
        chAi = 1;
    }
    var idff = $("#lstTipoMemorandum").val();
    var arr = idff.split("-");
    var idTipoMemorandum = arr[0];
    var swFechaFin = arr[1];
    var swHoraFin = arr[2];
    var swCargo = arr[3];
    var swOrganigrama = arr[4];
    var swUbicacion = arr[5];

    var correlativoMemorandum = $("#txtCorrelativoMemorandum").val();
    var gestionMemorandum = $("#lstGestionMemorandum").val();
    var fechaMem = $('#txtFechaMem').jqxDateTimeInput('getText');
    var idGerencia = $("#lstGerenciasAdministrativasMovilidad").val();
    var idDepartamentoAdministrativo = $("#lstDepartamentosAdministrativosMovilidad").val();
    var idArea = $("#lstAreasAdministrativasMovilidad").val();
    var idUbicacion = $("#lstUbicacionesMovilidad").val();
    var asignacionCargo = $("#txtCargoMovilidad").val();
    if(jQuery.type(asignacionCargo)=="object"){
        asignacionCargo = String(asignacionCargo.label);
    }
    asignacionCargo = asignacionCargo+'';
    if (asignacionCargo != '' && chAi == 1) {
        /**
         * Si el cargo menciona la palabra a.i. no se hace nada
         */
        var n = asignacionCargo.indexOf("a.i.");
        if (n < 0) {
            asignacionCargo += " a.i.";
        }
    }else if(asignacionCargo != '' && chAi == 0){
        /**
         * Si el cargo menciona la palabra a.i. se le quita
         */
        var n = asignacionCargo.indexOf("a.i.");
        if (n > 0) {
            asignacionCargo.replace("a.i.", "");
        }
    }
    var motivo = $("#txtMotivoMovilidad").val();
    var idPais = $("#lstPaisesMovilidad").val();
    var idDepartamento = $("#lstCiudadesMovilidad").val();
    var lugar = $("#txtLugarMovilidad").val();
    var fechaIni = $('#txtFechaIniMovilidad').jqxDateTimeInput('getText');
    var horaIni = $('#txtHoraIniMovilidad').val();
    var fechaFin = $('#txtFechaFinMovilidad').jqxDateTimeInput('getText');
    var horaFin = $('#txtHoraFinMovilidad').val();
    var observacion = $("#txtObservacionMovilidad").val();

    idPais = parseInt(idPais);
    idDepartamento = parseInt(idDepartamento);
    if (isNaN(idPais))idPais = 0;
    if (isNaN(idDepartamento))idDepartamento = 0;
    idGerencia = parseInt(idGerencia);
    idDepartamentoAdministrativo = parseInt(idDepartamentoAdministrativo);
    idArea = parseInt(idArea);
    idUbicacion = parseInt(idUbicacion);
    if (idGerencia != null && idGerencia != undefined) {
        if (!isNaN(idGerencia)) {
            idOrganigrama = idGerencia;
        }
        if (!isNaN(idDepartamentoAdministrativo)) {
            idOrganigrama = idDepartamentoAdministrativo;
        }
    }
    if (idOrganigrama == 0) {
        /**
         * En caso de que se haya seleccionado el cargo superior y no se haya especificado Gerencia, Departamento ni área
         * se establece el valor de acuerdo al id_organigrama del cargo del jefe
         */
        if ($("#hdnIdOrganigramaPorSeleccionCargoSuperior").val() > 0)
            idOrganigrama = $("#hdnIdOrganigramaPorSeleccionCargoSuperior").val();
    }
    if (isNaN(idArea)) {
        idArea = 0;
    }
    if (!isNaN(idUbicacion)) {
        idUbicacion = idUbicacion;
        swUbicacion = 1;
    } else {
        /*
         * En caso de que se haya seleccionado el cargo superior y no se haya especificado la ubicación
         * se establece el valor de acuerdo al lugar donde esta situado del cargo del jefe
         */
        if ($("#hdnIdOrganigramaPorSeleccionCargoSuperior").val() > 0) {
            idUbicacion = -1;
        }
        else idUbicacion = 0;

    }
    if (idRelaboralMovilidad > 0) {
        idMemorandum = $("#hdnIdMemorandumMovilidadModificar").val();
    }
    if (swFechaFin == 0) {
        fechaFin = '';
    }
    if (idRelaboral > 0 && idTipoMemorandum > 0 && correlativoMemorandum != '' && gestionMemorandum > 0 && fechaMem != '' && fechaIni != '') {
        $.ajax({
            url: '/relaborales/savemovilidad/',
            type: "POST",
            datatype: 'json',
            async: false,
            cache: false,
            data: {
                id: idRelaboralMovilidad,
                id_relaboral: idRelaboral,
                id_da: 0,
                id_regional: 0,
                id_organigrama: idOrganigrama,
                id_area: idArea,
                id_ubicacion: idUbicacion,
                cargo: asignacionCargo,
                id_evento: 0,
                motivo: motivo,
                id_pais: idPais,
                id_departamento: idDepartamento,
                lugar: lugar,
                id_memorandum: idMemorandum,
                id_tipomemorandum: idTipoMemorandum,
                correlativo: correlativoMemorandum,
                gestion: gestionMemorandum,
                fecha_mem: fechaMem,
                contenido: '',
                fecha_ini: fechaIni,
                hora_ini: horaIni,
                fecha_fin: fechaFin,
                hora_fin: horaFin,
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
                    $("#jqxgridmovilidad").jqxGrid("updatebounddata");
                    $("#divMsjePorSuccess").html("");
                    $("#divMsjePorSuccess").append(res.msj);
                    $("#divMsjeNotificacionSuccess").jqxNotification("open");
                    /*Es necesario actualizar la grilla principal debido a que este debe mostrar los datos de acuerdo a la última movilidad de personal*/
                    $("#jqxgrid").jqxGrid('beginupdate');
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
 * Función para obtener la fecha de inicio próximo sin registro para un determinado perfil.
 * @param idPerfil
 */
function obtenerFechaDeInicioProximo(idPerfil){
    var arrFecha = [];
    $.ajax({
        url: '/perfileslaborales/getfechainiproximo/',
        type: "POST",
        datatype: 'json',
        async: false,
        cache: false,
        data: {id: idPerfil},
        success: function (data) {
            var res = jQuery.parseJSON(data);
            if (res.length > 0) {
                $.each(res, function (key, val) {
                    arrFecha.push( {
                        dia:val.dia,
                        mes:val.mes,
                        gestion:val.gestion
                    });
                });
            }
        }
    });
    return arrFecha;
}
/**
 * Función para obtener la fecha del último día de un determinado mes en una determinada gestión.
 * @param fecha
 * @returns {Array}
 */
function obtenerUltimoDiaMes(fecha){
    var fecha = $.ajax({
        url: '/perfileslaborales/getultimafechames/',
        type: "POST",
        datatype: 'json',
        async: false,
        cache: false,
        data: {fecha: fecha},
        success: function (data) {
        }
    }).responseText;
    return fecha;
}
/**
 * Función para obtener la fecha a la cual se le restan una cantidad determinada de días.
 * @param fecha
 * @param dias
 * @returns {*}
 */
function obtenerFechaMenosDias(fecha,dias){
    var fechaRes = fecha;
    if(dias>0){
        var fechaRes = $.ajax({
            url: '/perfileslaborales/getfechamenosdias/',
            type: "POST",
            datatype: 'json',
            async: false,
            cache: false,
            data: {fecha: fecha,dias:dias},
            success: function (data) {
            }
        }).responseText;
    }
    return fechaRes;
}
/**
 * Función para obtener la fecha a la cual se le suman una cantidad determinada de días.
 * @param fecha
 * @param dias
 * @returns {*}
 */
function obtenerFechaMasDias(fecha,dias){
    var fechaRes = fecha;
    if(dias>0){
        var fechaRes = $.ajax({
            url: '/perfileslaborales/getfechamasdias/',
            type: "POST",
            datatype: 'json',
            async: false,
            cache: false,
            data: {fecha: fecha,dias:dias},
            success: function (data) {
            }
        }).responseText;
    }
    return fechaRes;
}
/**
 * Función para cargar la lista de ubicaciones principales
 * @param accion
 * @param idUbicacion
 */
function cargarUbicacionesPrincipales(accion,idUbicacion){
    var selected = "";
    var sufijo = "New";
    if(accion==2)sufijo="Edit";
    $.ajax({
        url: '/ubicaciones/listprincipales/',
        type: "POST",
        datatype: 'json',
        async: false,
        cache: false,
        success: function (data) {
            $("#lstUbicaciones"+sufijo).html("");
            $("#lstUbicaciones"+sufijo).append("<option value='0' data-cant-nodos-hijos='0'>Seleccionar...</option>");
            var res = jQuery.parseJSON(data);
            if (res.length > 0) {
                $("#lstUbicaciones"+sufijo).prop("disabled",false);
                $.each(res, function (key, val) {
                    if(idUbicacion==val.id){
                        selected = "selected";
                    }else selected = "";
                    $("#lstUbicaciones"+sufijo).append("<option value='"+val.id+"' data-cant-nodos-hijos='"+val.cant_nodos_hijos+"' "+selected+">"+val.ubicacion+"</option>");
                });
            }else $("#lstUbicaciones"+sufijo).prop("disabled",true);
        }
    });
}
/**
 * Función para cargar la lista correspondiente a las estaciones por línea.
 * @param accion
 * @param idUbicacion
 * @param idLinea
 */
function cargarEstaciones(accion,idUbicacion,idEstacion){
    var sufijo = "New";
    if(accion==2) sufijo="Edit";
    $("#lstEstaciones"+sufijo).html("");
    $("#lstEstaciones"+sufijo).append("<option value='0'>Seleccionar...</option>");
    $("#lstEstaciones"+sufijo).prop("disabled","disabled");
    $("#spanAsteriscoEstaciones"+sufijo).html("");
    var selected = "";
    if(idUbicacion>0){
        $.ajax({
            url: '/ubicaciones/listestaciones/',
            type: "POST",
            datatype: 'json',
            async: false,
            cache: false,
            data: {id:idUbicacion},
            success: function (data) {
                var res = jQuery.parseJSON(data);
                if (res.length > 0) {
                    $("#lstEstaciones"+sufijo).prop("disabled",false);
                    $("#spanAsteriscoEstaciones"+sufijo).text(" *");
                    $.each(res, function (key, val) {
                        if(idEstacion==val.id){
                            selected = "selected";
                        }else selected = "";
                        $("#lstEstaciones"+sufijo).append("<option value='"+val.id+"' "+selected+">"+val.ubicacion+"</option>");
                    });
                }else $("#lstEstaciones"+sufijo).prop("disabled","disabled");
            }
        });
    }
}