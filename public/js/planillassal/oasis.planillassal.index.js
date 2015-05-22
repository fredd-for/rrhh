/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  29-04-2014
 */
$().ready(function () {

    /**
     * Inicialmente se habilita solo la pestaña del listado
     */
    $('#divTabPlanillasSal').jqxTabs('theme', 'oasis');
    $('#divTabPlanillasSal').jqxTabs('enableAt', 0);
    $('#divTabPlanillasSal').jqxTabs('disableAt', 1);
    $('#divTabPlanillasSal').jqxTabs('disableAt', 2);

    definirGrillaParaListaPlanillas();
    /**
     * Control para la obtención de la planilla previa
     */
    $("#btnGenerarPlanillaPreviaSal").on("click",function(){
         limpiarFormularioPlanillaSal(1);
         var ok = validaFormularioPlanillaSal(1);
         if (ok){
             desplegarPlanillaPreviaSal();
         }
    });
    /**
     * Control para el control de los registros seleccionados
     */
    $("#btnGenerarPlanillaSal").on("click",function(){
        limpiarFormularioPlanillaSal(1);
        var ok = validaFormularioPlanillaSal(1);
        if (ok){
            var rows = $("#divGridPlanillasSalGen").jqxGrid('selectedrowindexes');
            if(rows.length>0){
                var listaIdRelaborales = '';
                var separador = '|';
                var selectedRecords = new Array();
                for (var m = 0; m < rows.length; m++) {
                    var row = $("#divGridPlanillasSalGen").jqxGrid('getrowdata', rows[m]);
                    listaIdRelaborales += row.id_relaboral + separador;
                }
                listaIdRelaborales += separador;
                listaIdRelaborales = listaIdRelaborales.replace(separador + separador, "");
                var sufijo = "Gen";
                var gestion = $("#lstGestion"+sufijo).val();
                var mes = $("#lstMes"+sufijo).val();
                var idFinPartida = $("#lstFinPartida"+sufijo).val();
                var idTipoPlanilla = $("#lstTipoPlanillaSal"+sufijo).val();
                var numeroPlanilla = $("#lstTipoPlanillaSal"+sufijo+" option:selected").data("numero");
                generarPlanillaSalarial(gestion,mes,idFinPartida,idTipoPlanilla,numeroPlanilla,listaIdRelaborales);

            }else{
                var msje = "Debe seleccionar al menos un registro para la generaci&oacute;n de la Planilla Salarial.";
                $("#divMsjePorError").html("");
                $("#divMsjePorError").append(msje);
                $("#divMsjeNotificacionError").jqxNotification("open");
            }
        }
    });

    /**
     * Control del evento de solicitud de guardar el registro de la excepción.
     */
    $("#btnGuardarExcepcionNew").on("click",function () {
        var ok = validaFormularioExcepcion(1)
        if (ok) {
            var okk = guardaExcepcion(1);
            if (okk) {
                $('#divTabPlanillasSal').jqxTabs('enableAt', 0);
                $('#divTabPlanillasSal').jqxTabs('disableAt', 1);
                $('#divTabPlanillasSal').jqxTabs('disableAt', 2);
                $("#msjs-alert").hide();
            }
        }
    });
    $("#btnGuardarExcepcionEdit").on("click",function () {
        var ok = validaFormularioExcepcion(2);
        if (ok) {
            var okk = guardaExcepcion(2);
            if (okk) {
                $('#divTabPlanillasSal').jqxTabs('enableAt', 0);
                $('#divTabPlanillasSal').jqxTabs('disableAt', 1);
                $('#divTabPlanillasSal').jqxTabs('disableAt', 2);

                $("#msjs-alert").hide();
            }
        }
    });
    $("#btnCancelarExcepcionNew").click(function () {
        $('#divTabPlanillasSal').jqxTabs('enableAt', 0);
        $('#divTabPlanillasSal').jqxTabs('disableAt', 1);
        $('#divTabPlanillasSal').jqxTabs('disableAt', 2);

        $("#msjs-alert").hide();

    });
    $("#btnCancelarExcepcionEdit").click(function () {
        $('#divTabPlanillasSal').jqxTabs('enableAt', 0);
        $('#divTabPlanillasSal').jqxTabs('disableAt', 1);
        $('#divTabPlanillasSal').jqxTabs('disableAt', 2);

        $("#msjs-alert").hide();
    });
    $("#btnExportarGenExcel").click(function () {
        /*$("#divGridPlanillasSalGen").jqxGrid('exportdata', 'xls', 'jqxGrid');*/
        $("#divGridPlanillasSalGen").jqxGrid('exportdata', 'xml', 'PlanillaSalPrevia');
    });
    $("#btnExportarPDF").click(function () {
        var items = $("#listBoxPlanillasSal").jqxListBox('getCheckedItems');
        var numColumnas = 0;
        $.each(items, function (index, value) {
            numColumnas++;
        });
        if (numColumnas > 0) exportarReporte(2);
        else {
            alert("Debe seleccionar al menos una columna para la obtención del reporte solicitado.");
            $("#listBoxPlanillasSal").focus();
        }
    });
    $("#chkAllCols").click(function () {
        if (this.checked == true) {
            $("#listBoxPlanillasSal").jqxListBox('checkAll');
        } else {
            $("#listBoxPlanillasSal").jqxListBox('uncheckAll');
        }
    });
    $("#liList").click(function () {
        $("#btnCancelarExcepcionNew").click();
        $("#btnCancelarExcepcionEdit").click();
    });
    $('#btnDesfiltrartodo').click(function () {
        $("#divGridPlanillasSal").jqxGrid('clearfilters');
    });
    $('#btnDesagrupartodo').click(function () {
        $('#divGridPlanillasSal').jqxGrid('cleargroups');
    });
    $('#btnDesagruparTodoMovilidad').click(function () {
        $('#divGridPlanillasSalmovilidad').jqxGrid('cleargroups');
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
 * Función para definir la grilla principal (listado) para la gestión de planillas.
 */
function definirGrillaParaListaPlanillas() {
    var source =
    {
        datatype: "json",
        datafields: [
            {name: 'nro_row', type: 'integer'},
            {name: 'id', type: 'integer'},
            {name: 'gestion', type: 'integer'},
            {name: 'mes', type: 'integer'},
            {name: 'mes_nombre', type: 'string'},
            {name: 'finpartida_id', type: 'integer'},
            {name: 'fin_partida', type: 'string'},
            {name: 'condicion_id', type: 'integer'},
            {name: 'condicion', type: 'string'},
            {name: 'tipoplanilla_id', type: 'integer'},
            {name: 'tipo_planilla', type: 'string'},
            {name: 'numero', type: 'integer'},
            {name: 'total_ganado', type: 'numeric'},
            {name: 'total_liquido', type: 'numeric'},
            {name: 'observacion', type: 'string'},
            {name: 'estado', type: 'string'},
            {name: 'estado_descripcion', type: 'string'}
        ],
        url: '/planillassal/list',
        cache: false
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    cargarRegistrosDeTolerancias();
    function cargarRegistrosDeTolerancias() {
        var theme = prepareSimulator("grid");
        $("#divGridPlanillasSal").jqxGrid(
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
                    container.append("<button id='addplanrowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-plus-square fa-2x text-info' title='Nuevo Registro.'/></i></button>");
                    /*container.append("<button id='approveplanrowbutton'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-check-square fa-2x text-info' title='Aprobar registro'></i></button>");*/
                    container.append("<button id='updateplanrowbutton'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-pencil-square fa-2x text-info' title='Modificar registro.'/></button>");
                    container.append("<button id='deleteplanrowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-minus-square fa-2x text-info' title='Dar de baja al registro.'/></i></button>");

                    $("#addplanrowbutton").jqxButton();
                    /*$("#approveplanrowbutton").jqxButton();*/
                    $("#updateplanrowbutton").jqxButton();
                    $("#deleteplanrowbutton").jqxButton();
                    $("#hdnIdExcepcionEdit").val(0);
                    /* Generar una nueva planilla salarial */
                    $("#addplanrowbutton").off();
                    $("#addplanrowbutton").on('click', function () {
                        $('#divTabPlanillasSal').jqxTabs('enableAt', 1);
                        $('#divTabPlanillasSal').jqxTabs('disableAt', 2);
                        $('#divTabPlanillasSal').jqxTabs({selectedItem: 1});
                        limpiarFormularioPlanillaSal(1);
                        cargarGestiones(1,0);
                        cargarMeses(1,0,0);
                        cargarFinPartidas(1,0,0,0);
                        cargarTiposDePlanilla(1,0,0,0,0);
                        iniciarFormularioGeneracionPlanillasSal();
                        desplegarPlanillaPreviaSal();
                        $("#lstGestionGen").focus();

                        $("#lstGestionGen").off();
                        $("#lstGestionGen").on("change",function(){
                            cargarMeses(1,$("#lstGestionGen").val(),0);
                            cargarFinPartidas(1,$("#lstGestionGen").val(),0,0);
                            cargarTiposDePlanilla(1,$("#lstGestionGen").val(),0,0,0);
                            /*$("#divGridPlanillasSalGen").jqxGrid('clear');*/
                            $("#btnGenerarPlanillaSal").hide();
                        });
                        $("#lstMesGen").off();
                        $("#lstMesGen").on("change",function(){
                            cargarFinPartidas(1,$("#lstGestionGen").val(),$("#lstMesGen").val(),0);
                            cargarTiposDePlanilla(1,$("#lstGestionGen").val(),$("#lstMesGen").val(),0,0);
                            /*$("#divGridPlanillasSalGen").jqxGrid('clear');*/
                            $("#btnGenerarPlanillaSal").hide();
                        });
                        $("#lstFinPartidaGen").off();
                        $("#lstFinPartidaGen").on("change",function(){
                            cargarTiposDePlanilla(1,$("#lstGestionGen").val(),$("#lstMesGen").val(),$("#lstFinPartidaGen").val(),0);
                            /*$("#divGridPlanillasSalGen").jqxGrid('clear');*/
                            $("#btnGenerarPlanillaSal").hide();
                        });
                        $("#lstTipoPlanillaSalGen").off();
                        $("#lstTipoPlanillaSalGen").on("change",function(){
                            /*$("#divGridPlanillasSalGen").jqxGrid('clear');*/
                            $("#btnGenerarPlanillaSal").hide();
                        });
                    });
                    /*Aprobar registro.*/
                    /*$("#approveplanrowbutton").on('click', function () {
                     var selectedrowindex = $("#divGridPlanillasSal").jqxGrid('getselectedrowindex');
                     if (selectedrowindex >= 0) {
                     var dataRecord = $('#divGridPlanillasSal').jqxGrid('getrowdata', selectedrowindex);
                     if (dataRecord != undefined) {
                     if (dataRecord.estado == 2) {
                     if (confirm("¿Esta seguro de aprobar este registro de la Excepci&oacute;n?")) {
                     aprobarRegistroExcepcion(dataRecord.id);
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
                     });*/
                    /* Modificar registro.*/
                    $("#updateplanrowbutton").off();
                    $("#updateplanrowbutton").on('click', function () {
                        var selectedrowindex = $("#divGridPlanillasSal").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGridPlanillasSal').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                $("#hdnIdExcepcionEdit").val(dataRecord.id);
                                /**
                                 * La modificación sólo es admisible si el registro de horario laboral tiene estado EN PROCESO
                                 */
                                if (dataRecord.estado >= 1) {
                                    $('#divTabPlanillasSal').jqxTabs('enableAt', 0);
                                    $('#divTabPlanillasSal').jqxTabs('disableAt', 1);
                                    $('#divTabPlanillasSal').jqxTabs('enableAt', 2);

                                    $('#divTabPlanillasSal').jqxTabs({selectedItem: 2});

                                    $("#hdnIdExcepcionEdit").val(dataRecord.id);
                                    limpiarMensajesErrorPorValidacionExcepcion(2);
                                    inicializaFormularioExcepcionesNuevoEditar(2,dataRecord.excepcion,dataRecord.tipoexcepcion_id,dataRecord.codigo,dataRecord.color,dataRecord.descuento,dataRecord.compensatoria,dataRecord.genero_id);
                                    inicializarDatosDuracion(2,dataRecord.cantidad,dataRecord.unidad,dataRecord.fraccionamiento);
                                    $("#txtExcepcionEdit").val(dataRecord.excepcion);
                                    $("#txtObservacionEdit").val(dataRecord.observacion);
                                    $("#txtExcepcionEdit").focus();

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
                    $("#deleteplanrowbutton").on('click', function () {
                        var selectedrowindex = $("#divGridPlanillasSal").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGridPlanillasSal').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                /*
                                 *  Para dar de baja un registro, este debe estar inicialmente en estado ACTIVO
                                 */
                                if (dataRecord.estado >= 1) {
                                    if (confirm("Esta seguro de dar de baja registro de tolerancia?"))
                                        darDeBajaExcepcion(dataRecord.id);
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
                    {
                        text: 'Estado',
                        filtertype: 'checkedlist',
                        datafield: 'estado_descripcion',
                        width: 90,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false,
                        cellclassname: cellclass
                    },
                    {
                        text: 'Gesti&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'gestion',
                        width: 60,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Mes',
                        filtertype: 'checkedlist',
                        datafield: 'mes_nombre',
                        width: 100,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Condici&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'condicion',
                        width: 120,
                        align: 'center',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
                        text: 'Tipo Planilla',
                        filtertype: 'checkedlist',
                        datafield: 'tipo_planilla',
                        width: 80,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'N&uacute;mero',
                        filtertype: 'checkedlist',
                        datafield: 'numero',
                        width: 60,
                        align: 'center',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
                        text: 'Total Ganado',
                        filtertype: 'checkedlist',
                        datafield: 'total_ganado',
                        width: 90,
                        align: 'center',
                        cellsalign: 'right',
                        hidden: false
                    },
                    {
                        text: 'Total L&iacute;quido',
                        filtertype: 'checkedlist',
                        datafield: 'total_liquido',
                        width: 90,
                        align: 'center',
                        cellsalign: 'right',
                        hidden: false
                    },
                    {
                        text: 'Observaci&oacute;n',
                        datafield: 'observacion',
                        width: 100,
                        align: 'center',
                        hidden: false
                    },
                ]
            });
        var listSource = [
            {label: 'Estado', value: 'estado_descripcion', checked: true},
            {label: 'Gesti&oacute;n', value: 'gestion', checked: true},
            {label: 'Mes', value: 'mes_nombre', checked: true},
            {label: 'Condici&oacute;n', value: 'condicion', checked: true},
            {label: 'Tipo Planilla', value: 'tipo_planilla', checked: true},
            {label: 'N&uacute;mero', value: 'numero', checked: true},
            {label: 'Total Ganado', value: 'total_ganado', checked: true},
            {label: 'Total L&iacute;quido', value: 'total_liquido', checked: true},
            {label: 'Observaci&oacute;n', value: 'observacion', checked: true}
        ];
        $("#listBoxPlanillasSal").jqxListBox({source: listSource, width: "100%", height: 430, checkboxes: true});
        $("#listBoxPlanillasSal").on('checkChange', function (event) {
            $("#divGridPlanillasSal").jqxGrid('beginupdate');
            if (event.args.checked) {
                $("#divGridPlanillasSal").jqxGrid('showcolumn', event.args.value);
            }
            else {
                $("#divGridPlanillasSal").jqxGrid('hidecolumn', event.args.value);
            }
            $("#divGridPlanillasSal").jqxGrid('endupdate');
        });
    }
}
/**
 * Función para la generación de la planilla salarial.
 */
function desplegarPlanillaPreviaSal(){
    var sufijo = "Gen";
    var gestion = $("#lstGestion"+sufijo).val();
    var mes = $("#lstMes"+sufijo).val();
    var idFinPartida = $("#lstFinPartida"+sufijo).val();
    var idTipoPlanilla = $("#lstTipoPlanillaSal"+sufijo).val();
    var numeroPlanilla = $("#lstTipoPlanillaSal"+sufijo+" option:selected").data("numero");
    var source =
    {
        datatype: "json",
        datafields: [
            {name: 'nro_row', type: 'integer'},
            {name: 'chk', type: 'bool'},
            {name: 'id_relaboral', type: 'integer'},
            {name: 'cargo', type: 'string'},
            {name: 'nombres', type: 'string'},
            {name: 'ci', type: 'string'},
            {name: 'expd', type: 'string'},
            {name: 'cargo', type: 'string'},
            {name: 'sueldo', type: 'numeric'},
            {name: 'dias_efectivos', type: 'numeric'},
            {name: 'faltas', type: 'numeric'},
            {name: 'atrasos', type: 'numeric'},
            {name: 'faltas_atrasos', type: 'numeric'},
            {name: 'lsgh', type: 'numeric'},
            {name: 'omision', type: 'numeric'},
            {name: 'abandono', type: 'numeric'},
            {name: 'otros', type: 'numeric'},
            {name: 'total_ganado', type: 'numeric'},
            {name: 'total_liquido', type: 'numeric'},
            {name: 'estado', type: 'string'},
            {name: 'estado_descripcion', type: 'string'}
        ],
        url: '/planillassal/displayplanprevia?gestion='+gestion+'&mes='+mes+'&id_finpartida='+idFinPartida+'&id_tipoplanilla='+idTipoPlanilla+'&numero='+numeroPlanilla,
        cache: false
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    var columnCheckBox = null;
    var updatingCheckState = false;
    cargarRegistrosLaborales();
    function cargarRegistrosLaborales() {
        var theme = prepareSimulator("grid");
        $("#divGridPlanillasSalGen").jqxGrid(
            {
                theme: theme,
                width: '100%',
                height: '100%',
                source: dataAdapter,
                sortable: true,
                altRows: true,
                //groupable: true,
                columnsresize: true,
                pageable: true,
                pagerMode: 'advanced',
                showfilterrow: true,
                filterable: true,
                //showtoolbar: true,
                showstatusbar: true,
                statusbarheight: 50,
                showaggregates: true,
                autorowheight: true,
                selectionmode:'checkbox',
                pagesize: 20,
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
                        text: 'Cargo',
                        filtertype: 'checkedlist',
                        datafield: 'cargo',
                        width: 100,
                        cellsalign: 'justify',
                        align: 'center'
                    },
                    {
                        text: 'Estado',
                        filtertype: 'checkedlist',
                        datafield: 'estado_descripcion',
                        width: 70,
                        cellsalign: 'center',
                        align: 'center',
                        cellclassname: cellclass
                    },
                    {
                        text: 'Nombres',
                        datafield: 'nombres',
                        width: 100,
                        cellsalign: 'justify',
                        align: 'center'
                    },
                    {
                        text: 'CI',
                        datafield: 'ci',
                        width: 70,
                        align: 'center',
                        cellsalign: 'center',
                        aggregatesrenderer: function (aggregates) {
                            var renderstring ='<div id="divTotal" style="float: right; margin: 4px; overflow: hidden;">Totales:</div>';
                            return renderstring;
                        }
                    },
                    {
                        text: 'Expd',
                        filtertype: 'checkedlist',
                        datafield: 'expd',
                        width: 30,
                        cellsalign: 'center',
                        align: 'center'
                    },
                    {
                        text: 'Haber',
                        filtertype: 'checkedlist',
                        datafield: 'sueldo',
                        width: 60,
                        align: 'center',
                        cellsalign: 'right',
                        aggregatesrenderer: function (aggregates) {
                            var renderstring ='<div id="divTotalHaberes" style="float: right; margin: 4px; overflow: hidden;">0.00</div>';
                            return renderstring;
                        }
                    },
                    {
                        text: 'D&iacute;as Efectivos',
                        filtertype: 'checkedlist',
                        datafield: 'dias_efectivos',
                        width: 60,
                        align: 'center',
                        cellsalign: 'right',
                        aggregatesrenderer: function (aggregates) {
                            var renderstring ='<div id="divTotalDiasEfectivos" style="float: right; margin: 4px; overflow: hidden;">0.00</div>';
                            return renderstring;
                        }
                    },
                    {
                        text: 'LSGHs',
                        filtertype: 'checkedlist',
                        datafield: 'lsgh',
                        width: 60,
                        align: 'center',
                        cellsalign: 'right',
                        columngroup: 'DescuentoDias',
                        aggregatesrenderer: function (aggregates) {
                            var renderstring ='<div id="divTotalLsgh" style="float: right; margin: 4px; overflow: hidden;">0.00</div>';
                            return renderstring;
                        }
                    },
                    {
                        text: 'Omisi&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'omision',
                        width: 60,
                        align: 'center',
                        cellsalign: 'right',
                        columngroup: 'DescuentoDias',
                        aggregatesrenderer: function (aggregates) {
                            var renderstring ='<div id="divTotalOmision" style="float: right; margin: 4px; overflow: hidden;">0.00</div>';
                            return renderstring;
                        }
                    },
                    {
                        text: 'Abandono',
                        filtertype: 'checkedlist',
                        datafield: 'abandono',
                        width: 65,
                        align: 'center',
                        cellsalign: 'right',
                        columngroup: 'DescuentoDias',
                        aggregatesrenderer: function (aggregates) {
                            var renderstring ='<div id="divTotalAbandono" style="float: right; margin: 4px; overflow: hidden;">0.00</div>';
                            return renderstring;
                        }
                    },
                    {
                        text: 'Faltas',
                        filtertype: 'checkedlist',
                        datafield: 'faltas',
                        width: 60,
                        align: 'center',
                        cellsalign: 'right',
                        columngroup: 'DescuentoDias',
                        aggregatesrenderer: function (aggregates) {
                            var renderstring ='<div id="divTotalFaltas" style="float: right; margin: 4px; overflow: hidden;">0.00</div>';
                            return renderstring;
                        }
                    },
                    {
                        text: 'Atrasos',
                        filtertype: 'checkedlist',
                        datafield: 'atrasos',
                        width: 60,
                        align: 'center',
                        cellsalign: 'right',
                        columngroup: 'DescuentoDias',
                        aggregatesrenderer: function (aggregates) {
                            var renderstring ='<div id="divTotalAtrasos" style="float: right; margin: 4px; overflow: hidden;">0.00</div>';
                            return renderstring;
                        }
                    },
                    {
                        text: 'F. & A.',
                        filtertype: 'checkedlist',
                        datafield: 'faltas_atrasos',
                        width: 60,
                        align: 'center',
                        cellsalign: 'right',
                        columngroup: 'DescuentoMonetario',
                        aggregatesrenderer: function (aggregates) {
                            var renderstring ='<div id="divTotalFaltasAtrasos" style="float: right; margin: 4px; overflow: hidden;">0.00</div>';
                            return renderstring;
                        }
                    },
                    {
                        text: 'Otros',
                        filtertype: 'checkedlist',
                        datafield: 'otros',
                        width: 60,
                        align: 'center',
                        cellsalign: 'right',
                        columngroup: 'DescuentoMonetario',
                        aggregatesrenderer: function (aggregates) {
                            var renderstring ='<div id="divTotalOtros" style="float: right; margin: 4px; overflow: hidden;">0.00</div>';
                            return renderstring;
                        }
                    },
                    {
                        text: 'Total Ganado',
                        filtertype: 'checkedlist',
                        datafield: 'total_ganado',
                        width: 90,
                        align: 'center',
                        cellsalign: 'right',
                        aggregatesrenderer: function (aggregates) {
                            var renderstring ='<div id="divTotalTotalGanado" style="float: right; margin: 4px; overflow: hidden;">0.00</div>';
                            return renderstring;
                        }
                    },
                    {
                        text: 'Total L&iacute;quido',
                        filtertype: 'checkedlist',
                        datafield: 'total_liquido',
                        width: 90,
                        align: 'center',
                        cellsalign: 'right',
                        aggregatesrenderer: function (aggregates) {
                            var renderstring ='<div id="divTotalTotalLiquido" style="float: right; margin: 4px; overflow: hidden;">0.00</div>';
                            return renderstring;
                        }
                    }
                ],
                columngroups:
                    [
                        { text: 'Descuento en D&iacute;as', align: 'center', name: 'DescuentoDias' },
                        { text: 'Descuento en Bs.', align: 'center', name: 'DescuentoMonetario' }
                    ]
            });
        $('#divGridPlanillasSalGen').off();
        /**
         * Control cuando se completa la construcción de la grilla correspondiente a la planilla previa.
         */
        $("#divGridPlanillasSalGen").on("bindingcomplete",function(){
            var rows = $('#divGridPlanillasSalGen').jqxGrid('getrows');
            if(rows.length>0){
                $("#btnGenerarPlanillaSal").show();
            }else{
                $("#btnGenerarPlanillaSal").hide();
            }
        });

        $('#divGridPlanillasSalGen').on('rowselect', function (event) {
            calcularTotales();
        });
        $('#divGridPlanillasSalGen').on('rowunselect', function (event) {
            calcularTotales()
        });
        function calcularTotales(){
            var rows = $("#divGridPlanillasSalGen").jqxGrid('selectedrowindexes');
            var totalHaberes = 0;
            var totalDiasEfectivos = 0;
            var totalFaltas = 0;
            var totalAtrasos = 0;
            var totalFaltasAtrasos = 0;
            var totalOmisiones = 0;
            var totalAbandonos = 0;
            var totalLsgh = 0;
            var totalOtros = 0;
            var totalTotalGanado = 0;
            var totalTotalLiquido = 0;
            $.each(rows,function(key,val){
                var rowindex = val;
                var dataRecord = $("#divGridPlanillasSalGen").jqxGrid('getrowdata', rowindex);
                if(!isNaN(dataRecord.sueldo)){
                    totalHaberes += Number(parseFloat(dataRecord.sueldo));
                }
                if(!isNaN(dataRecord.dias_efectivos)){
                    totalDiasEfectivos += Number(parseFloat(dataRecord.dias_efectivos));
                }
                if(!isNaN(dataRecord.faltas)){
                    totalFaltas += Number(parseFloat(dataRecord.faltas));
                }
                if(!isNaN(dataRecord.atrasos)){
                    totalAtrasos += Number(parseFloat(dataRecord.atrasos));
                }
                if(!isNaN(dataRecord.faltas_atrasos)){
                    totalFaltasAtrasos += Number(parseFloat(dataRecord.faltas_atrasos));
                }
                if(!isNaN(dataRecord.lsgh)){
                    totalLsgh += Number(parseFloat(dataRecord.lsgh));
                }
                if(!isNaN(dataRecord.omision)){
                    totalOmisiones += Number(parseFloat(dataRecord.omision));
                }
                if(!isNaN(dataRecord.abandono)){
                    totalAbandonos += Number(parseFloat(dataRecord.abandono));
                }
                if(!isNaN(dataRecord.otros)){
                    totalOtros += Number(parseFloat(dataRecord.otros));
                }
                if(!isNaN(dataRecord.total_ganado)){
                    totalTotalGanado += Number(parseFloat(dataRecord.total_ganado));
                }
                if(!isNaN(dataRecord.total_liquido)){
                    totalTotalLiquido += Number(parseFloat(dataRecord.total_liquido));
                }

            });
            $("#divTotalHaberes").text("");
            $("#divTotalHaberes").text(totalHaberes.toFixed(2));

            $("#divTotalDiasEfectivos").text("");
            $("#divTotalDiasEfectivos").text(totalDiasEfectivos.toFixed(2));

            $("#divTotalFaltas").text("");
            $("#divTotalFaltas").text(totalFaltas.toFixed(2));

            $("#divTotalAtrasos").text("");
            $("#divTotalAtrasos").text(totalAtrasos.toFixed(2));

            $("#divTotalFaltasAtrasos").text("");
            $("#divTotalFaltasAtrasos").text(totalFaltasAtrasos.toFixed(2));

            $("#divTotalLsgh").text("");
            $("#divTotalLsgh").text(totalLsgh.toFixed(2));

            $("#divTotalOmision").text("");
            $("#divTotalOmision").text(totalOmisiones.toFixed(2));

            $("#divTotalAbandono").text("");
            $("#divTotalAbandono").text(totalAbandonos.toFixed(2));

            $("#divTotalOtros").text("");
            $("#divTotalOtros").text(totalOtros.toFixed(2));

            $("#divTotalTotalGanado").text("");
            $("#divTotalTotalGanado").text(totalTotalGanado.toFixed(2));

            $("#divTotalTotalLiquido").text("");
            $("#divTotalTotalLiquido").text(totalTotalLiquido.toFixed(2));
        }
        /*$("#excelExport").jqxButton();
        $("#xmlExport").jqxButton();
        $("#csvExport").jqxButton();
        $("#tsvExport").jqxButton();
        $("#htmlExport").jqxButton();
        $("#jsonExport").jqxButton();
        $("#pdfExport").jqxButton();

        $("#excelExport").on("click",function () {
            $("#divGridPlanillasSalGen").jqxGrid('exportdata', 'xls', 'jqxGrid');
        });
        $("#xmlExport").on("click",function () {
            $("#divGridPlanillasSalGen").jqxGrid('exportdata', 'xml', 'jqxGrid');
        });
        $("#csvExport").on("click",function () {
            $("#divGridPlanillasSalGen").jqxGrid('exportdata', 'csv', 'jqxGrid');
        });
        $("#tsvExport").on("click",function () {
            $("#divGridPlanillasSalGen").jqxGrid('exportdata', 'tsv', 'jqxGrid');
        });
        $("#htmlExport").on("click",function () {
            $("#divGridPlanillasSalGen").jqxGrid('exportdata', 'html', 'jqxGrid');
        });
        $("#jsonExport").on("click",function () {
            $("#divGridPlanillasSalGen").jqxGrid('exportdata', 'json', 'jqxGrid');
        });
        $("#pdfExport").on("click",function () {
            $("#divGridPlanillasSalGen").jqxGrid('exportdata', 'pdf', 'jqxGrid');
        });*/
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
        $('#divTabPlanillasSal').jqxTabs('enableAt', 0);
        $('#divTabPlanillasSal').jqxTabs('disableAt', 1);
        $('#divTabPlanillasSal').jqxTabs('disableAt', 2);

        /**
         * Saltamos a la pantalla principal en caso de presionarse ESC
         */
        $('#divTabPlanillasSal').jqxTabs({selectedItem: 0});
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
    if (value == 'ANULADA') {
        return 'rojo';
    }
    else if (value == 'REVERTIDA') {
        return 'negro';
    }
    else if (value == 'GENERADA') {
        return 'amarillo';
    }
    else if (value == 'VERIFICADA') {
        return 'azul';
    }
    else if (value == 'APROBADA') {
        return 'verde';
    }
    else return ''
}
/**
 * Función para la definición de la columna en función del valor almacenado en la columna.
 * @param row
 * @param column
 * @param value
 * @param defaultHtml
 * @returns {*}
 */
var cellsrenderer = function(row, column, value, defaultHtml) {
    var element = $(defaultHtml);
    element.css({'background-color': value});
    return element[0].outerHTML;
    return defaultHtml;
}
/**
 * Función para la carga del combo de gestiones en función de si es para la generación de nuevas planillas o para la vista de planillas generadas.
 * @param option
 */
function cargarGestiones(option,g){
    var sufijo = "Gen";
    if(option==2)sufijo = "View";
    var lista = "";
    $("#lstGestion"+sufijo).html("");
    $("#lstGestion"+sufijo).append("<option value=''>Seleccionar</option>");
    $("#lstGestion"+sufijo).prop("disabled",false);
    var selected = "";
    $.ajax({
        url: '/planillassal/getgestionesgeneracion/',
        type: "POST",
        datatype: 'json',
        async: false,
        cache: false,
        success: function (data) {
            var res = jQuery.parseJSON(data);
            if (res.length > 0) {
                $.each(res, function (key, gestion) {
                    if(g==gestion)selected="selected";
                    else selected = "";
                    lista += "<option value='"+gestion+"' "+selected+">"+gestion+"</option>";
                });
            }
        }
    });
    if(lista!='')$("#lstGestion"+sufijo).append(lista);
    else $("#lstGestion"+sufijo).prop("disabled",true);
}
/**
 * Función para obtener el listado de meses disponibles para la generación de planillas salariales en consideración a una gestion en particular.
 * @param option
 * @param g
 * @param m
 */
function cargarMeses(option,g,m){
    var sufijo = "Gen";
    if(option==2)sufijo = "View";
    var lista = "";
    $("#lstMes"+sufijo).html("");
    $("#lstMes"+sufijo).append("<option value=''>Seleccionar</option>");
    $("#lstMes"+sufijo).prop("disabled",false);
    var selected = "";
    if(g>0){
        $.ajax({
            url: '/planillassal/getmesesgeneracion/',
            type: "POST",
            datatype: 'json',
            async: false,
            cache: false,
            data:{gestion:g},
            success: function (data) {
                var res = jQuery.parseJSON(data);
                if (res.length > 0) {
                    $.each(res, function (key, val) {
                        if(m==val.mes)selected="selected";
                        else selected = "";
                        lista += "<option value='"+val.mes+"' "+selected+">"+val.mes_nombre+"</option>";
                    });
                }
            }
        });
    }
    if(lista!='')$("#lstMes"+sufijo).append(lista);
    else $("#lstMes"+sufijo).prop("disabled",true);
}
/**
 * Función para la obtención del listado de financiamientos por partida disponibles para la generación de planillas salariales en consideración a una gestion en particular.
 * @param option
 * @param g
 * @param m
 * @param idFinPartida
 */
function cargarFinPartidas(option,g,m,idFinPartida){
    var sufijo = "Gen";
    if(option==2)sufijo = "View";
    var lista = "";
    $("#lstFinPartida"+sufijo).html("");
    $("#lstFinPartida"+sufijo).append("<option value=''>Seleccionar</option>");
    $("#lstFinPartida"+sufijo).prop("disabled",false);
    var selected = "";
    if(g>0&&m>0){
        $.ajax({
            url: '/planillassal/getfinpartidasgeneracion/',
            type: "POST",
            datatype: 'json',
            async: false,
            cache: false,
            data:{gestion:g,mes:m},
            success: function (data) {
                var res = jQuery.parseJSON(data);
                if (res.length > 0) {
                    $.each(res, function (key, val) {
                        if(idFinPartida==val.id_finpartida)selected="selected";
                        else selected = "";
                        lista += "<option value='"+val.id_finpartida+"' "+selected+">"+val.fin_partida+"</option>";
                    });
                }
            }
        });
    }
    if(lista!='')$("#lstFinPartida"+sufijo).append(lista);
    else $("#lstFinPartida"+sufijo).prop("disabled",true);
}
/**
 * Función para la obtención los tipos de planillas disponibles para la generación.
 * @param option
 * @param g
 * @param m
 * @param idFinPartida
 * @param idTipoPlanilla
 */
function cargarTiposDePlanilla(option,g,m,idFinPartida,idTipoPlanilla){
    var sufijo = "Gen";
    if(option==2)sufijo = "View";
    var lista = "";
    $("#lstTipoPlanillaSal"+sufijo).html("");
    $("#lstTipoPlanillaSal"+sufijo).append("<option value=''>Seleccionar</option>");
    $("#lstTipoPlanillaSal"+sufijo).prop("disabled",false);
    var selected = "";
    if(g>0&&m>0&&idFinPartida>0){
        //$("#lstTipoPlanillaSal"+sufijo).html("");
        $.ajax({
            url: '/planillassal/gettiposplanillassal/',
            type: "POST",
            datatype: 'json',
            async: false,
            cache: false,
            data:{gestion:g,mes:m,id_finpartida:idFinPartida},
            success: function (data) {
                var res = jQuery.parseJSON(data);
                   if (res.length > 0) {
                    $.each(res, function (key, val) {
                        if(idTipoPlanilla==val.id_tipoplanilla)selected="selected";
                        else selected = "";
                        lista += "<option value='"+val.id_tipoplanilla+"' "+selected+" data-numero='"+val.numero+"'>"+val.tipo_planilla_disponible+"</option>";
                    });
                }
            }
        });
    }
    if(lista!='')$("#lstTipoPlanillaSal"+sufijo).append(lista);
    else $("#lstTipoPlanillaSal"+sufijo).prop("disabled",true);
}
/**
 * Función para la limpieza de los formularios de generación y vista de planillas salariales.
 * @param option
 */
function limpiarFormularioPlanillaSal(option){
    var ok = true;
    var sufijo = "Gen";
    var accion = "generaci&oacute;n";
    if(option==2)sufijo = "View";

    $("#divGestion"+sufijo).removeClass("has-error");
    $("#helpErrorGestion"+sufijo).html("");

    $("#divMes"+sufijo).removeClass("has-error");
    $("#helpErrorMes"+sufijo).html("");

    $("#divFinPartida"+sufijo).removeClass("has-error");
    $("#helpErrorFinPartida"+sufijo).html("");

    $("#divTipoPlanillaSal"+sufijo).removeClass("has-error");
    $("#helpErrorTipoPlanillaSal"+sufijo).html("");
}
/**
 * Función para validar los formularios para la generación y vista de Planillas Salariales.
 * @param option
 * @returns {boolean}
 */
function validaFormularioPlanillaSal(option){
    var ok = true;
    var sufijo = "Gen";
    var accion = "generaci&oacute;n";
    if(option==2) {
        sufijo = "View";
        accion = "vista";
    }
    var divGestion = $("#divGestion"+sufijo);
    var gestion = $("#lstGestion"+sufijo).val();
    var helpErrorGestion = $("#helpErrorGestion"+sufijo);

    var divMes = $("#divMes"+sufijo);
    var mes = $("#lstMes"+sufijo).val();
    var helpErrorMes = $("#helpErrorMes"+sufijo);

    var divFinPartida = $("#divFinPartida"+sufijo);
    var idFinPartida = $("#lstFinPartida"+sufijo).val();
    var helpErrorFinPartida = $("#helpErrorFinPartida"+sufijo);

    var divTipoPlanilla = $("#divTipoPlanillaSal"+sufijo);
    var idTipoPlanilla = $("#lstTipoPlanillaSal"+sufijo).val();
    var numeroPlanilla = $("#lstTipoPlanillaSal"+sufijo).data("numero");
    var helpErrorTipoPlanilla = $("#helpErrorTipoPlanillaSal"+sufijo);

    if(gestion==''||gestion==0){
        ok = false;
        var msje = "Debe seleccionar la gesti&oacute;n para la "+accion+" de la planilla.";
        divGestion.addClass("has-error");
        helpErrorGestion.html(msje);
    }
    if(mes==''||mes==0){
        ok = false;
        var msje = "Debe seleccionar el mes para la "+accion+" de la planilla.";
        divMes.addClass("has-error");
        helpErrorMes.html(msje);
    }
    if(idFinPartida==''||idFinPartida==0){
        ok = false;
        var msje = "Debe seleccionar la Fuente para la "+accion+" de la planilla.";
        divFinPartida.addClass("has-error");
        helpErrorFinPartida.html(msje);
    }
    if(idTipoPlanilla==''||idTipoPlanilla==0){
        ok = false;
        var msje = "Debe seleccionar la Fuente para la "+accion+" de la planilla.";
        divTipoPlanilla.addClass("has-error");
        helpErrorTipoPlanilla.html(msje);
    }
    return ok;
}
/**
 * Función para la generación de la planilla salarial coorespondiente.
 * @param gestion
 * @param mes
 * @param idFinPartida
 * @param idTipoPlanilla
 * @param numeroPlanilla
 * @param idRelaborales
 * @returns {boolean}
 */
function generarPlanillaSalarial(gestion,mes,idFinPartida,idTipoPlanilla,numeroPlanilla,idRelaborales){
    var ok=true;
    if(gestion>0&&mes>0&&idFinPartida>0&&numeroPlanilla>=0){
        $.ajax({
            url: '/planillassal/genplanilla/',
            type: "POST",
            datatype: 'json',
            async: false,
            cache: false,
            data:{gestion:gestion,mes:mes,id_finpartida:idFinPartida,id_tipoplanilla:idTipoPlanilla,numero:numeroPlanilla,id_relaborales:idRelaborales},
            success: function(data) {

                var res = jQuery.parseJSON(data);
                /**
                 * Si se ha realizado correctamente el registro de la planilla salarial
                 */
                $(".msjes").hide();
                if(res.result==1){
                    var msje = "La planilla se ha generado de forma satisfactoria.";
                    $("#divMsjePorSuccess").html("");
                    $("#divMsjePorSuccess").append(msje);
                    $("#divMsjeNotificacionSuccess").jqxNotification("open");
                } else if(res.result==0){
                    var msje = "Error: No se ha podido generar la planilla salarial.";
                    $("#divMsjePorError").html("");
                    $("#divMsjePorError").append(msje);
                    $("#divMsjeNotificacionError").jqxNotification("open");
                }else{
                    var msje = "No se ha podido generar la planilla salarial debido a un error cr&iacute;tico.";
                    $("#divMsjePorError").html("");
                    $("#divMsjePorError").append(msje);
                    $("#divMsjeNotificacionError").jqxNotification("open");
                }

            }, //mostramos el error
            error: function() { alert('Se ha producido un error inesperado'); }
        });
    }
    return ok;
}