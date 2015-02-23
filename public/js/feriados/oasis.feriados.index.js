/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  18-02-2015
 */
$().ready(function () {
    $("#chkHorariosDiscontinuos").bootstrapSwitch();
    $("#chkHorariosContinuos").bootstrapSwitch();
    $("#chkHorariosMultiples").bootstrapSwitch();
    $("#chkHorariosTodos").bootstrapSwitch();
    /**
     * Inicialmente se habilita solo la pestaña del listado
     */
    $('#divTabFeriados').jqxTabs('theme', 'oasis');
    $('#divTabFeriados').jqxTabs('enableAt', 0);
    $('#divTabFeriados').jqxTabs('disableAt', 1);
    $('#divTabFeriados').jqxTabs('disableAt', 2);
    $('#divTabFeriados').jqxTabs('disableAt', 3);

    definirGrillaParaListaTolerancias();
    /**
     * Control del evento de solicitud de guardar el registro del horario.
     */
    $("#btnGuardarToleranciaNuevo").click(function () {
        var ok = validaFormularioTolerancia()
        if (ok) {
            var okk = guardaTolerancia();
            if (okk) {
                $('#divTabFeriados').jqxTabs('enableAt', 0);
                $('#divTabFeriados').jqxTabs('disableAt', 1);
                $('#divTabFeriados').jqxTabs('disableAt', 2);
                $('#divTabFeriados').jqxTabs('disableAt', 3);
                $("#msjs-alert").hide();
            }
        }
    });
    $("#btnGuardarToleranciaEditar").click(function () {
        var ok = validaFormularioTolerancia();
        if (ok) {
            var okk = guardaTolerancia();
            if (okk) {
                $('#divTabFeriados').jqxTabs('enableAt', 0);
                $('#divTabFeriados').jqxTabs('disableAt', 1);
                $('#divTabFeriados').jqxTabs('disableAt', 2);
                $('#divTabFeriados').jqxTabs('disableAt', 3);
                $("#msjs-alert").hide();
            }
        }
    });
    $("#btnCancelarToleranciaNuevo").click(function () {
        $('#divTabFeriados').jqxTabs('enableAt', 0);
        $('#divTabFeriados').jqxTabs('disableAt', 1);
        $('#divTabFeriados').jqxTabs('disableAt', 2);
        $('#divTabFeriados').jqxTabs('disableAt', 3);
        $("#msjs-alert").hide();

    });
    $("#btnCancelarToleranciaEditar").click(function () {
        $('#divTabFeriados').jqxTabs('enableAt', 0);
        $('#divTabFeriados').jqxTabs('disableAt', 1);
        $('#divTabFeriados').jqxTabs('disableAt', 2);
        $('#divTabFeriados').jqxTabs('disableAt', 3);
        $("#msjs-alert").hide();
    });
    $("#btnExportarExcel").click(function () {
        var items = $("#jqxlistbox").jqxListBox('getCheckedItems');
        var numColumnas = 0;
        $.each(items, function (index, value) {
            numColumnas++;
        });
        if (numColumnas > 0) exportarReporte(1);
        else {
            alert("Debe seleccionar al menos una columna para la obtención del reporte solicitado.");
            $("#jqxlistbox").focus();
        }
    });
    $("#btnExportarPDF").click(function () {
        var items = $("#jqxlistbox").jqxListBox('getCheckedItems');
        var numColumnas = 0;
        $.each(items, function (index, value) {
            numColumnas++;
        });
        if (numColumnas > 0) exportarReporte(2);
        else {
            alert("Debe seleccionar al menos una columna para la obtención del reporte solicitado.");
            $("#jqxlistbox").focus();
        }
    });
    $("#chkAllCols").click(function () {
        if (this.checked == true) {
            $("#jqxlistbox").jqxListBox('checkAll');
        } else {
            $("#jqxlistbox").jqxListBox('uncheckAll');
        }
    });
    $("#liList").click(function () {
        $("#btnCancelarToleranciaNuevo").click();
        $("#btnCancelarToleranciaEditar").click();
    });
    $('#btnDesfiltrartodo').click(function () {
        $("#divGridFeriados").jqxGrid('clearfilters');
    });
    $('#btnDesagrupartodo').click(function () {
        $('#divGridFeriados').jqxGrid('cleargroups');
    });
    $('#btnDesagruparTodoMovilidad').click(function () {
        $('#divGridFeriadosmovilidad').jqxGrid('cleargroups');
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

    $(document).keypress(OperaEvento);
    $(document).keyup(OperaEvento);
});
/**
 * Función para definir la grilla principal (listado) para la gestión de tolerancias de ingreso.
 */
function definirGrillaParaListaTolerancias() {
    var source =
    {
        datatype: "json",
        datafields: [
            {name: 'nro_row', type: 'integer'},
            {name: 'id', type: 'integer'},
            {name: 'feriado', type: 'string'},
            {name: 'descripcion', type: 'string'},
            {name: 'regional_id', type: 'integer'},
            {name: 'regional', type: 'string'},
            {name: 'horario_discontinuo', type: 'integer'},
            {name: 'horario_discontinuo_descripcion', type: 'string'},
            {name: 'horario_continuo', type: 'integer'},
            {name: 'horario_continuo_descripcion', type: 'string'},
            {name: 'horario_multiple', type: 'integer'},
            {name: 'horario_multiple_descripcion', type: 'string'},
            {name: 'cantidad_dias', type: 'integer'},
            {name: 'repetitivo', type: 'integer'},
            {name: 'repetitivo_descripcion', type: 'string'},
            {name: 'dia', type: 'integer'},
            {name: 'mes', type: 'integer'},
            {name: 'gestion', type: 'integer'},
            {name: 'observacion', type: 'string'},
            {name: 'estado', type: 'integer'},
            {name: 'estado_descripcion', type: 'string'}
        ],
        url: '/feriados/list',
        cache: false
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    cargarRegistrosDeTolerancias();
    function cargarRegistrosDeTolerancias() {
        var theme = prepareSimulator("grid");
        $("#divGridFeriados").jqxGrid(
            {
                theme: theme,
                width: '100%',
                height: '100%',
                source: dataAdapter,
                sortable: true,
                altRows: true,
                groupable: true,
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
                    container.append("<button id='addrowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-plus-square fa-2x text-info' title='Nuevo Registro.'/></i></button>");
                    container.append("<button id='approverowbutton'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-check-square fa-2x text-info' title='Aprobar registro'></i></button>");
                    container.append("<button id='updaterowbutton'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-pencil-square fa-2x text-info' title='Modificar registro.'/></button>");
                    container.append("<button id='deleterowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-minus-square fa-2x text-info' title='Dar de baja al registro.'/></i></button>");

                    $("#addrowbutton").jqxButton();
                    $("#approverowbutton").jqxButton();
                    $("#updaterowbutton").jqxButton();
                    $("#deleterowbutton").jqxButton();

                    /* Registrar nueva tolerancia.*/
                    $("#addrowbutton").on('click', function () {
                        $('#divTabFeriados').jqxTabs('enableAt', 1);
                        $('#divTabFeriados').jqxTabs('disableAt', 2);
                        $('#divTabFeriados').jqxTabs('disableAt', 3);
                        $('#divTabFeriados').jqxTabs({selectedItem: 1});
                        listarCantidadDias(1,0);
                        inicializarCamposParaNuevoRegistroTolerancia();
                        limpiarMensajesErrorPorValidacionTolerancia("");
                        cargarTiposDeAcumulacion(-1,"");
                        cargarOpcionesDeConsideracionEnRetraso(-1,"");
                        $("#txtTolerancia").focus();
                    });
                    /*Aprobar registro.*/
                    $("#approverowbutton").on('click', function () {
                        var selectedrowindex = $("#divGridFeriados").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGridFeriados').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                /*
                                 * La aprobación de un registro es admisible si el estado del registro es EN PROCESO.
                                 */
                                if (dataRecord.estado == 2) {
                                    if (confirm("¿Esta seguro de aprobar este registro de tolerancia?")) {
                                        aprobarRegistroTolerancia(dataRecord.id);
                                    }
                                } else {
                                    var msje = "Debe seleccionar un registro con estado EN PROCESO para posibilitar la aprobaci&oacute;n del registro";
                                    $("#divMsjePorError").html("");
                                    $("#divMsjePorError").append(msje);
                                    $("#divMsjeNotificacionError").jqxNotification("open");
                                }
                            }
                        } else {
                            var msje = "Debe seleccionar un registro necesariamente.";
                            $("#divMsjePorError").html("");
                            $("#divMsjePorError").append(msje);
                            $("#divMsjeNotificacionError").jqxNotification("open");
                        }
                    });
                    /* Modificar registro.*/
                    $("#updaterowbutton").on('click', function () {
                        var selectedrowindex = $("#divGridFeriados").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGridFeriados').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                $("#hdnIdToleranciaEditar").val(dataRecord.id);
                                /**
                                 * La modificación sólo es admisible si el registro de horario laboral tiene estado EN PROCESO
                                 */
                                if (dataRecord.estado >= 1) {
                                    $('#divTabFeriados').jqxTabs('enableAt', 0);
                                    $('#divTabFeriados').jqxTabs('disableAt', 1);
                                    $('#divTabFeriados').jqxTabs('enableAt', 2);
                                    $('#divTabFeriados').jqxTabs('disableAt', 3);
                                    $('#divTabFeriados').jqxTabs({selectedItem: 2});

                                    limpiarMensajesErrorPorValidacionTolerancia("Editar");
                                    $("#txtToleranciaEditar").val(dataRecord.tolerancia);
                                    cargarTiposDeAcumulacion(dataRecord.tipo_acumulacion,"Editar");
                                    cargarOpcionesDeConsideracionEnRetraso(dataRecord.consideracion_retraso,"Editar");
                                    $("#txtDescripcionEditar").val(dataRecord.descripcion);
                                    var fechaIni = "";
                                    if(dataRecord.fecha_ini!=null)
                                    fechaIni = $.jqx.dataFormat.formatdate(dataRecord.fecha_ini, 'dd-MM-yyyy');
                                    var fechaFin = "";
                                    if(dataRecord.fecha_fin!=null)
                                        fechaFin = $.jqx.dataFormat.formatdate(dataRecord.fecha_fin, 'dd-MM-yyyy');
                                    $("#txtFechaIniEditar").val(fechaIni);
                                    $("#txtFechaFinEditar").val(fechaFin);
                                    $("#txtObservacionEditar").val(dataRecord.observacion);
                                    $("#txtToleranciaEditar").focus();

                                } else {
                                    var msje = "Debe seleccionar un registro en estado EN PROCESO o ACTIVO necesariamente.";
                                    $("#divMsjePorError").html("");
                                    $("#divMsjePorError").append(msje);
                                    $("#divMsjeNotificacionError").jqxNotification("open");
                                }
                            }
                        } else {
                            var msje = "Debe seleccionar un registro necesariamente.";
                            $("#divMsjePorError").html("");
                            $("#divMsjePorError").append(msje);
                            $("#divMsjeNotificacionError").jqxNotification("open");
                        }
                    });
                    /* Dar de baja un registro.*/
                    $("#deleterowbutton").on('click', function () {
                        var selectedrowindex = $("#divGridFeriados").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGridFeriados').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                var id_tolerancia = dataRecord.id;
                                /*
                                 *  Para dar de baja un registro, este debe estar inicialmente en estado ACTIVO
                                 */
                                if (dataRecord.estado >= 1) {
                                    if (confirm("Esta seguro de dar de baja registro de tolerancia?"))
                                        darDeBajaTolerancia(id_tolerancia);
                                } else {
                                    var msje = "Para dar de baja un registro, este debe estar en estado ACTIVO o EN PROCESO inicialmente.";
                                    $("#divMsjePorError").html("");
                                    $("#divMsjePorError").append(msje);
                                    $("#divMsjeNotificacionError").jqxNotification("open");
                                }
                            }
                        } else {
                            var msje = "Debe seleccionar un registro necesariamente.";
                            $("#divMsjePorError").html("");
                            $("#divMsjePorError").append(msje);
                            $("#divMsjeNotificacionError").jqxNotification("open");
                        }
                    });
                },
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
                    /*{
                        text: 'Estado',
                        filtertype: 'checkedlist',
                        datafield: 'estado_descripcion',
                        width: 90,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false,
                        cellclassname: cellclass
                    },*/
                    {
                        text: 'Feriado',
                        filtertype: 'checkedlist',
                        datafield: 'feriado',
                        width: 200,
                        align: 'center',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
                        text: 'H. Discontinuos',
                        filtertype: 'checkedlist',
                        datafield: 'horario_discontinuo_descripcion',
                        width: 100,
                        align: 'center',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
                        text: 'H. Continuos',
                        filtertype: 'checkedlist',
                        datafield: 'horario_continuo_descripcion',
                        width: 100,
                        align: 'center',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
                        text: 'H. Multiples',
                        filtertype: 'checkedlist',
                        datafield: 'horario_multiple_descripcion',
                        width: 100,
                        align: 'center',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
                        text: '# D&iacute;as',
                        filtertype: 'checkedlist',
                        datafield: 'cantidad_dias',
                        width: 50,
                        align: 'center',
                        cellsalign:'center',
                        hidden: false
                    },
                    {
                        text: 'Repetitivo',
                        filtertype: 'checkedlist',
                        datafield: 'repetitivo_descripcion',
                        width: 150,
                        align: 'center',
                        cellsalign:'center',
                        hidden: false
                    },
                    {
                        text: 'D&iacute;a',
                        filtertype: 'checkedlist',
                        datafield: 'dia',
                        width: 50,
                        cellsalign:'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Mes',
                        filtertype: 'checkedlist',
                        datafield: 'mes',
                        width: 50,
                        cellsalign:'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'A&ntilde;o',
                        filtertype: 'checkedlist',
                        datafield: 'gestion',
                        width: 50,
                        cellsalign:'center',
                        align: 'center',
                        hidden: false
                    },
                   {
                        text: 'Observaci&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'observacion',
                        width: 150,
                        align: 'center',
                        hidden: false
                    },
                ]
            });
        var listSource = [
            /*{label: 'Estado', value: 'estado_descripcion', checked: true},*/
            {label: 'Feriado', value: 'feriado', checked: true},
            {label: 'H. Discontinuos', value: 'horario_discontinuo_descripcion', checked: true},
            {label: 'H. Continuos', value: 'horario_continuo_descripcion', checked: true},
            {label: 'H. Multiples', value: 'horario_multiple_descripcion', checked: true},
            {label: 'Cantidad D&iacute;as', value: 'cantidad_dias', checked: true},
            {label: 'Repetitivo', value: 'repetitivo_descripcion', checked: true},

            {label: 'Observaci&oacute;n', value: 'observacion', checked: true}
        ];
        $("#jqxlistbox").jqxListBox({source: listSource, width: "100%", height: 430, checkboxes: true});
        $("#jqxlistbox").on('checkChange', function (event) {
            $("#divGridFeriados").jqxGrid('beginupdate');
            if (event.args.checked) {
                $("#divGridFeriados").jqxGrid('showcolumn', event.args.value);
            }
            else {
                $("#divGridFeriados").jqxGrid('hidecolumn', event.args.value);
            }
            $("#divGridFeriados").jqxGrid('endupdate');
        });
    }
}
/**
 * Función anónima para enumerar los registros
 * @param row
 * @param columnfield
 * @param value
 * @param defaulthtml
 * @param columnproperties
 * @param rowdata
 * @returns {string}
 */
var rownumberrenderer = function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
    var nro = row + 1;
    return "<div align='center'>" + nro + "</div>";
}
/*
 * Función para controlar la ejecución del evento esc con el teclado.
 */
function OperaEvento(evento) {
    if ((evento.type == "keyup" || evento.type == "keydown") && evento.which == "27") {
        $('#divTabFeriados').jqxTabs('enableAt', 0);
        $('#divTabFeriados').jqxTabs('disableAt', 1);
        $('#divTabFeriados').jqxTabs('disableAt', 2);
        $('#divTabFeriados').jqxTabs('disableAt', 3);
        /**
         * Saltamos a la pantalla principal en caso de presionarse ESC
         */
        $('#divTabFeriados').jqxTabs({selectedItem: 0});
    }
}

/**
 * Función anónima para la aplicación de clases a celdas en particular dentro de las grillas.
 * @param row
 * @param columnfield
 * @param value
 * @returns {string}
 * @author JLM
 */
var cellclass = function (row, columnfield, value) {
    if (value == 'ACTIVO') {
        return 'verde';
    }
    else if (value == 'EN PROCESO') {
        return 'amarillo';
    }
    else if (value == 'PASIVO') {
        return 'rojo';
    }
    else return ''
}
/**
 * Función anónima para la obtención del listado de posibilidades de cantidades de días por feriado.
 * @param opcion
 * @param cantidad
 */
function listarCantidadDias(opcion,cantidad){
    var sufijo = "New";
    if(opcion==2){
        sufijo = "Edit";
    }
    var selected="";
    $("#lstCantidadDias"+sufijo).html("");
    $("#lstCantidadDias"+sufijo).append("<option value='0'>Seleccionar...</option>");
    if(cantidad>=0){
        for (i=1;i<=10;i++){
            if(i==cantidad)selected="selected";
            else selected="";
            $("#lstCantidadDias"+sufijo).append("<option value='"+i+"'>"+i+" D&iacute;a (s)</option>");
        }
    }
}