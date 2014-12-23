/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  19-12-2014
 */
$().ready(function () {
    /**
     * Inicialmente se habilita solo la pestaña del listado
     */
    $('#jqxTabsHorarios').jqxTabs('theme', 'oasis');
    $('#jqxTabsHorarios').jqxTabs('enableAt', 0);
    $('#jqxTabsHorarios').jqxTabs('disableAt', 1);
    $('#jqxTabsHorarios').jqxTabs('disableAt', 2);
    $('#jqxTabsHorarios').jqxTabs('disableAt', 3);

    definirGrillaParaListaHorarios();
    /**
     * Control del evento de solicitud de guardar el registro del horario.
     */
    $("#btnGuardarHorarioNuevo").click(function () {
        var ok = validaFormularioHorarioLaboral()
        if (ok){
            var okk = guardaHorarioLaboral();
            if(okk){
                $('#jqxTabsHorarios').jqxTabs('enableAt', 0);
                $('#jqxTabsHorarios').jqxTabs('disableAt', 1);
                $('#jqxTabsHorarios').jqxTabs('disableAt', 2);
                $('#jqxTabsHorarios').jqxTabs('disableAt', 3);
                $("#msjs-alert").hide();
            }
        }
    });
    $("#btnGuardarHorarioEditar").click(function () {
        var ok = validaFormularioHorarioLaboral();
        if (ok) {
            var okk = guardaHorarioLaboral();
            if(okk){
                $('#jqxTabsHorarios').jqxTabs('enableAt', 0);
                $('#jqxTabsHorarios').jqxTabs('disableAt', 1);
                $('#jqxTabsHorarios').jqxTabs('disableAt', 2);
                $('#jqxTabsHorarios').jqxTabs('disableAt', 3);
                $("#msjs-alert").hide();
            }
        }
    });
    $("#btnGuardarHorarioBaja").click(function () {
        var ok = validaFormularioPorBajaRegistro();
        if (ok) {
            guardarRegistroBajaPerfilLaboral();
        }
    });

    $("#btnCancelarHorarioNuevo").click(function () {
        $('#jqxTabsHorarios').jqxTabs('enableAt', 0);
        $('#jqxTabsHorarios').jqxTabs('disableAt', 1);
        $('#jqxTabsHorarios').jqxTabs('disableAt', 2);
        $('#jqxTabsHorarios').jqxTabs('disableAt', 3);
        $("#msjs-alert").hide();
        
    });
    $("#btnCancelarHorarioEditar").click(function () {
        $('#jqxTabsHorarios').jqxTabs('enableAt', 0);
        $('#jqxTabsHorarios').jqxTabs('disableAt', 1);
        $('#jqxTabsHorarios').jqxTabs('disableAt', 2);
        $('#jqxTabsHorarios').jqxTabs('disableAt', 3);
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
        $("#btnCancelarHorarioNuevo").click();
        $("#btnCancelarHorarioEditar").click();
    });


    $('#btnDesfiltrartodo').click(function () {
        $("#jqxgridhorarios").jqxGrid('clearfilters');
    });
    $('#btnDesagrupartodo').click(function () {
        $('#jqxgridhorarios').jqxGrid('cleargroups');
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
 * Función para definir la grilla principal (listado) para la gestión de relaciones laborales.
 */
function definirGrillaParaListaHorarios() {
    var source =
    {
        datatype: "json",
        datafields: [
            {name: 'nro_row', type: 'integer'},
            {name: 'id_horariolaboral', type: 'integer'},
            {name: 'nombre', type: 'string'},
            {name: 'nombre_alternativo', type: 'string'},
            {name: 'hora_entrada', type: 'time'},
            {name: 'hora_salida', type: 'time'},
            {name: 'horas_laborales', type: 'numeric'},
            {name: 'dias_laborales', type: 'numeric'},
            {name: 'rango_entrada', type: 'integer'},
            {name: 'rango_salida', type: 'integer'},
            {name: 'hora_inicio_rango_ent', type: 'time'},
            {name: 'hora_final_rango_ent', type: 'time'},
            {name: 'hora_inicio_rango_sal', type: 'time'},
            {name: 'hora_final_rango_sal', type: 'time'},
            {name: 'color', type: 'string'},
            {name: 'fecha_ini', type: 'date'},
            {name: 'fecha_fin', type: 'date'},
            {name: 'observacion', type: 'string'},
            {name: 'estado', type: 'string'},
            {name: 'estado_descripcion', type: 'string'}
        ],
        url: '/horarioslaborales/list',
        cache: false
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    cargarRegistrosDeRelacionesLaborales();
    function cargarRegistrosDeRelacionesLaborales() {
        var theme = prepareSimulator("grid");
        $("#jqxgridhorarios").jqxGrid(
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
                    /*container.append("<button id='viewrowbutton' class='btn btn-sm btn-primary' type='button'><i class='hi hi-time fa-2x text-info' title='Vista Historial.'/></i></button>");*/

                    $("#addrowbutton").jqxButton();
                    $("#approverowbutton").jqxButton();
                    $("#updaterowbutton").jqxButton();
                    $("#deleterowbutton").jqxButton();
                    /*$("#viewrowbutton").jqxButton();*/


                    /* Registrar nueva relación laboral.*/
                    $("#addrowbutton").on('click', function () {
                        $('#jqxTabsHorarios').jqxTabs('enableAt', 1);
                        $('#jqxTabsHorarios').jqxTabs('disableAt', 2);
                        $('#jqxTabsHorarios').jqxTabs('disableAt', 3);
                        $('#jqxTabsHorarios').jqxTabs({selectedItem: 1});
                        inicializarCamposParaNuevoRegistro();
                        limpiarMensajesErrorPorValidacionHorario("");
                        $("#txtNombreHorario").focus();
                        inicializarPaleta(1);
                    });
                    /*Aprobar registro.*/
                    $("#approverowbutton").on('click', function () {
                     var selectedrowindex = $("#jqxgridhorarios").jqxGrid('getselectedrowindex');
                     if (selectedrowindex >= 0) {
                     var dataRecord = $('#jqxgridhorarios').jqxGrid('getrowdata', selectedrowindex);
                     if (dataRecord != undefined) {
                         /*
                          * La aprobación de un registro es admisible si el estado del registro es EN PROCESO.
                          */
                         if (dataRecord.estado == 2) {
                             if(confirm("¿Esta seguro de aprobar este horario?")){
                                aprobarRegistroHorarioLaboral(dataRecord.id_horariolaboral);
                             }
                         }else {
                             var msje = "Debe seleccionar un registro con estado EN PROCESO para posibilitar la aprobaci&oacute;n del registro";
                             $("#divMsjePorError").html("");
                             $("#divMsjePorError").append(msje);
                             $("#divMsjeNotificacionError").jqxNotification("open");
                             }
                         }
                     }else{
                         var msje = "Debe seleccionar un registro necesariamente.";
                         $("#divMsjePorError").html("");
                         $("#divMsjePorError").append(msje);
                         $("#divMsjeNotificacionError").jqxNotification("open");
                         }
                     });
                    /* Modificar registro.*/
                    $("#updaterowbutton").on('click', function () {
                        var selectedrowindex = $("#jqxgridhorarios").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#jqxgridhorarios').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                $("#hdnIdHorarioLaboralEditar").val(dataRecord.id_horariolaboral);
                                /**
                                 * La modificación sólo es admisible si el registro de horario laboral tiene estado EN PROCESO
                                 */
                                if (dataRecord.estado >= 1) {
                                    $('#jqxTabsHorarios').jqxTabs('enableAt', 0);
                                    $('#jqxTabsHorarios').jqxTabs('disableAt', 1);
                                    $('#jqxTabsHorarios').jqxTabs('enableAt', 2);
                                    $('#jqxTabsHorarios').jqxTabs('disableAt', 3);
                                    /**
                                     * Trasladamos el item seleccionado al que corresponde, el de modificación
                                     */
                                    $('#jqxTabsHorarios').jqxTabs({selectedItem: 2});
                                    limpiarMensajesErrorPorValidacionHorario("Editar");
                                    $("#txtNombreHorario").focus();
                                    $("#txtNombreHorarioEditar").val(dataRecord.nombre);
                                    $("#txtNombreAlternativoHorarioEditar").val(dataRecord.nombre_alternativo);
                                    $("#txtColorHorarioEditar").val(dataRecord.color);
                                    $("#txtColorHorarioEditar").css({'background-color': dataRecord.color,'color':dataRecord.color});
                                    $("#txtHoraEntHorarioEditar").val(dataRecord.hora_entrada);
                                    $("#txtHoraSalHorarioEditar").val(dataRecord.hora_salida);
                                    $("#txtHoraInicioRangoEntEditar").val(dataRecord.hora_inicio_rango_ent);
                                    $("#txtHoraFinalizacionRangoEntEditar").val(dataRecord.hora_final_rango_ent);
                                    $("#txtHoraInicioRangoSalEditar").val(dataRecord.hora_inicio_rango_sal);
                                    $("#txtHoraFinalizacionRangoSalEditar").val(dataRecord.hora_final_rango_sal);
                                    $("#txtObservacionEditar").val(dataRecord.observacion);
                                    inicializarPaleta(2);
                                }else {
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
                        var selectedrowindex = $("#jqxgridhorarios").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#jqxgridhorarios').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                var id_horariolaboral = dataRecord.id_horariolaboral;
                                /*
                                 *  Para dar de baja un registro, este debe estar inicialmente en estado ACTIVO
                                 */
                                if (dataRecord.estado >= 1) {
                                    if(confirm("Esta seguro de dar de baja registro de horario laboral?"))
                                    darDeBajaHorarioLaboral(id_horariolaboral);
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
                    /* Ver registro.*/
                    /*$("#viewrowbutton").on('click', function () {

                        var selectedrowindex = $("#jqxgridhorarios").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#jqxgridhorarios').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                var id_horariolaboral = dataRecord.id_horariolaboral;

                            }
                        } else {
                            var msje = "Debe seleccionar un registro necesariamente.";
                            $("#divMsjePorError").html("");
                            $("#divMsjePorError").append(msje);
                            $("#divMsjeNotificacionError").jqxNotification("open");
                        }
                    });*/
                },
                columns: [
                    {
                        text: 'Nro.',
                        filterable: false,
                        columntype: 'number',
                        width: 50,
                        cellsalign: 'center',
                        align: 'center',
                        cellsrenderer: rownumberrenderer
                    },
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
                        text: 'Color',
                        datafield: 'color',
                        width: 100,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false,
                        cellsrenderer: cellsrenderer

                    },
                    {
                        text: 'Nombre',
                        columntype: 'textbox',
                        filtertype: 'checkedlist',
                        datafield: 'nombre',
                        width: 100,
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Nombre Alternativo',
                        columntype: 'textbox',
                        filtertype: 'input',
                        datafield: 'nombre_alternativo',
                        width: 200,
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Hora Entrada',
                        filtertype: 'checkedlist',
                        datafield: 'hora_entrada',
                        width: 100,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Hora Salida',
                        filtertype: 'checkedlist',
                        datafield: 'hora_salida',
                        width: 100,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Horas Laborales',
                        filtertype: 'checkedlist',
                        datafield: 'horas_laborales',
                        width: 100,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: true
                    },
                    {
                        text: 'D&iacute;as Laborales',
                        filtertype: 'checkedlist',
                        datafield: 'dias_laborales',
                        width: 100,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: true
                    },
                    {
                        text: 'Hora Inicio Rango Entrada',
                        filtertype: 'checkedlist',
                        datafield: 'hora_inicio_rango_ent',
                        width: 100,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: true
                    },
                    {
                        text: 'Hora Final Rango Entrada',
                        filtertype: 'checkedlist',
                        datafield: 'hora_final_rango_ent',
                        width: 100,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: true
                    },
                    {
                        text: 'Hora Inicio Rango Salida',
                        filtertype: 'checkedlist',
                        datafield: 'hora_inicio_rango_sal',
                        width: 100,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: true
                    },
                    {
                        text: 'Hora Final Rango Salida',
                        filtertype: 'checkedlist',
                        datafield: 'hora_final_rango_sal',
                        width: 100,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: true
                    },
                    {text: 'Observaci&oacute;n', datafield: 'observacion', width: 100, hidden: false},
                ]
            });
        var listSource = [
            {label: 'Estado', value: 'estado_descripcion', checked: true},
            {label: 'Color', value: 'color', checked: true},
            {label: 'Nombre', value: 'nombre', checked: true},
            {label: 'Nombre Alternativo', value: 'nombre_alternativo', checked: true},
            {label: 'Hora Entrada', value: 'hora_entrada', checked: true},
            {label: 'Hora Salida', value: 'hora_salida', checked: true},
            {label: 'Horas Laborales', value: 'horas_laborales', checked: false},
            {label: 'D&iacute;as Laborales', value: 'dias_laborales', checked: false},
            {label: 'Hora Inicio Rango Entrada', value: 'hora_inicio_rango_ent', checked: false},
            {label: 'Hora Final Rango Entrada', value: 'hora_final_rango_ent', checked: false},
            {label: 'Hora Inicio Rango Salida', value: 'hora_inicio_rango_sal', checked: false},
            {label: 'Hora Final Rango Salida', value: 'hora_final_rango_sal', checked: false},
            {label: 'Observacion', value: 'observacion', checked: true},
        ];
        $("#jqxlistbox").jqxListBox({source: listSource, width: "100%", height: 430, checkboxes: true});
        $("#jqxlistbox").on('checkChange', function (event) {
            $("#jqxgridhorarios").jqxGrid('beginupdate');
            if (event.args.checked) {
                $("#jqxgridhorarios").jqxGrid('showcolumn', event.args.value);
            }
            else {
                $("#jqxgridhorarios").jqxGrid('hidecolumn', event.args.value);
            }
            $("#jqxgridhorarios").jqxGrid('endupdate');
        });
    }
}
var rownumberrenderer = function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
    var nro = row + 1;
    return "<div align='center'>" + nro + "</div>";
}
/*
 * Función para controlar la ejecución del evento esc con el teclado.
 */
function OperaEvento(evento) {
    if ((evento.type == "keyup" || evento.type == "keydown") && evento.which == "27") {
        $('#jqxTabsHorarios').jqxTabs('enableAt', 0);
        $('#jqxTabsHorarios').jqxTabs('disableAt', 1);
        $('#jqxTabsHorarios').jqxTabs('disableAt', 2);
        $('#jqxTabsHorarios').jqxTabs('disableAt', 3);
        /**
         * Saltamos a la pantalla principal en caso de presionarse ESC
         */
        $('#jqxTabsHorarios').jqxTabs({selectedItem: 0});
    }
}
/**
 * Función para convertir un texto con el formato dd-MM-yyyy al formato MM/dd/yyyy
 * @param date Cadena con la fecha
 * @param sep Separador
 * @returns {number}
 */
function procesaTextoAFecha(date, sep) {
    var parts = date.split(sep);
    var date = new Date(parts[1] + "/" + parts[0] + "/" + parts[2]);
    return date.getTime();
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