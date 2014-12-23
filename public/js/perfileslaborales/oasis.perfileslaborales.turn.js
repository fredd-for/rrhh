/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  18-12-2014
 */
function cargarGrillaTurnos(idPerfilLaboral,perfilLaboral,grupo,tipoHorarioDescripcion) {
    var source =
    {
        datatype: "json",
        datafields: [
            {name: 'nro_row', type: 'integer'},
            {name: 'id_perfillaboral', type: 'integer'},
            {name: 'perfil_laboral', type: 'string'},
            {name: 'grupo', type: 'string'},
            {name: 'gestion', type: 'integer'},
            {name: 'numero_mes', type: 'integer'},
            {name: 'mes', type: 'string'},
            {name: 'fecha_ini', type: 'date'},
            {name: 'fecha_fin', type: 'date'},
            {name: 'tipo_horario', type: 'integer'},
            {name: 'tipo_horario_descripcion', type: 'string'},
            {name: 'estado', type: 'integer'},
            {name: 'estado_descripcion', type: 'string'}

        ],
        url: '/perfileslaborales/listhistorialturnos?id=' + idPerfilLaboral,
        /*id: 'id_perfillaboral',*/
        cache: false
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    cargarRegistrosDeTurnosLaborales();
    function cargarRegistrosDeTurnosLaborales() {
        var theme = prepareSimulator("grid");
        $("#jqxgridturnos").jqxGrid(
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
                    container.append("<button id='addrowbuttonturn' class='btn btn-sm btn-primary' type='button'><i class='fa fa-plus-square fa-2x text-info' title='Nuevo Registro.'/></i></button>");
                    container.append("<button id='updaterowbuttonturn'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-pencil-square fa-2x text-info' title='Modificar registro.'/></button>");
                    container.append("<button id='deleterowbuttonturn' class='btn btn-sm btn-primary' type='button'><i class='fa fa-minus-square fa-2x text-info' title='Dar de baja al registro.'/></i></button>");
                    container.append("<button id='viewrowbuttonturn' class='btn btn-sm btn-primary' type='button'><i class='fa fa-calendar fa-2x text-info' title='Vista Calendarios Laborales por Perfil.'/></i></button>");

                    $("#addrowbuttonturn").jqxButton();
                    $("#updaterowbuttonturn").jqxButton();
                    $("#deleterowbuttonturn").jqxButton();
                    $("#viewrowbuttonturn").jqxButton();

                    // Registrar nuevo turno laboral.
                    $("#addrowbuttonturn").on('click', function () {
                        /**
                         * Se habilita la vista del calendario laboral con la opcion de registrar nuevo
                         */
                        $('#jqxTabsPerfilesLaborales').jqxTabs('enableAt', 0);
                        $('#jqxTabsPerfilesLaborales').jqxTabs('disableAt', 1);
                        $('#jqxTabsPerfilesLaborales').jqxTabs('disableAt', 2);
                        $('#jqxTabsPerfilesLaborales').jqxTabs('enableAt', 3);
                        $('#jqxTabsPerfilesLaborales').jqxTabs('enableAt', 4);
                        $('#jqxTabsPerfilesLaborales').jqxTabs({selectedItem: 4});

                        $("#ddPerfilLaboralCalendario").text(perfilLaboral);
                        if(grupo!=''&&grupo!=null)$("#ddGrupoCalendario").text(grupo);
                        else $("#ddGrupoCalendario").html("&nbsp;");
                        $("#ddTipoHorarioCalendario").text(tipoHorarioDescripcion);
                        $("#spanPrefijoCalendarioLaboral").text("Nuevo ")
                        $("#calendar").html("");
                        iniciarCalendarioLaboral();
                        iniciarSelectorTolerancias();
                    });

                    /**
                     * Modificar registro de turno laboral.
                     */
                    $("#updaterowbuttonturn").on('click', function () {
                        var selectedrowindex = $("#jqxgridturnos").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#jqxgridturnos').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                /**
                                 * Para el caso cuando el estado del turno esté EN ELABORACIÓN, de otro modo no es admisible.
                                 */
                                if (dataRecord.estado == 1) {

                                } else {
                                    var msj = "Debe seleccionar un registro en estado EN PROCESO para posibilitar la modificaci&oacute;n de los registros correspondientes.";
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
                    });
                    /* Dar de baja un registro de movilidad de personal.*/
                    $("#deleterowbuttonturn").on('click', function () {
                        var selectedrowindex = $("#jqxgridturnos").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#jqxgridturnos').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                /**
                                 * Sólo se puede dar de baja un turno cuando su estado es EN PROCESO.
                                 */
                                if (dataRecord.estado == 1) {


                                } else {
                                    var msj= "Debe seleccionar un registro con estado EN PROCES para posibilitar la baja del registro de turnos laborales.";
                                    $("#divMsjePorError").html("");
                                    $("#divMsjePorError").append(msj);
                                    $("#divMsjeNotificacionError").jqxNotification("open");

                                }
                            }
                        } else {
                            $("#divMsjePorError").html("");
                            $("#divMsjePorError").append("Debe seleccionar un registro necesariamente.");
                            $("#divMsjeNotificacionError").jqxNotification("open");
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
                    },
                    /*{
                        text: 'Perfil',
                        columntype: 'dropdownlist',
                        datafield: 'perfil_laboral',
                        width: 200,
                        cellsalign: 'center',
                        align: 'center'
                    },
                    {
                        text: 'Grupo',
                        filtertype: 'checkedlist',
                        datafield: 'grupo',
                        width: 130,
                        cellsalign: 'center',
                        align: 'center'
                    },*/
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
                    /*{
                        text: 'Tipo Horario',
                        filtertype: 'checkedlist',
                        datafield: 'tipo_horario_descripcion',
                        width: 200,
                        cellsalign: 'center',
                        align: 'center'
                    },*/
                    {
                        text: 'Estado',
                        columntype: 'checkedlist',
                        datafield: 'estado_descripcion',
                        width: 130,
                        cellsalign: 'center',
                        align: 'center'
                    }
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
 * Función para cargar el combo de tipos de memorándums.
 * @param idTipoMemorandumPrederminado Identificador del tipo de memorándum predeterminado.
 */

function cargarTiposMemorandumsParaMovilidad(idTipoMemorandumPrederminado) {
    var agrupador = 1;
    var sw = 0;
    $.ajax({
        url: '/relaborales/listtiposmemorandumsmovilidad',
        type: 'POST',
        datatype: 'json',
        async: false,
        cache: false,
        success: function (data) {
            var res = jQuery.parseJSON(data);
            $('#lstTipoMemorandum').html("");
            $('#lstTipoMemorandum').append("<option value='0'>Seleccionar...</option>");
            if (res.length > 0) {
                $.each(res, function (key, val) {
                    if (idTipoMemorandumPrederminado == val.id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $('#lstTipoMemorandum').append("<option value=" + val.id_agrupado + " " + $selected + ">" + val.tipo_memorandum + "</option>");
                    sw = 1;
                });
                if (sw == 0)$('#lstTipoMemorandum').prop("disabled", "disabled");
            } else $('#lstTipoMemorandum').prop("disabled", "disabled");
        }
    });
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