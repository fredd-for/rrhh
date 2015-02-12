/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  09-02-2015
 */
/**
 * Función para la carga la grilla de asignaciones.
 * @param idPerfilLaboral
 * @param perfilLaboral
 * @param grupo
 * @param tipoHorario
 * @param tipoHorarioDescripcion
 */
function cargarGrillaAsignacionesIndividuales(idPerfilLaboral,perfilLaboral,grupo,tipoHorario,tipoHorarioDescripcion) {
    var source =
    {
        datatype: "json",
        datafields: [
            {name: 'nro_row', type: 'integer'},
            {name: 'fecha_nac', type: 'string'},
            {name: 'edad', type: 'integer'},
            {name: 'lugar_nac', type: 'integer'},
            {name: 'genero', type: 'integer'},
            {name: 'e_civil', type: 'integer'},
            {name: 'id_relaboral', type: 'integer'},
            {name: 'id_persona', type: 'integer'},
            {name: 'tiene_contrato_vigente', type: 'integer'},
            {name: 'id_fin_partida', type: 'integer'},
            {name: 'finpartida', type: 'integer'},
            {name: 'id_ubicacion', type: 'string'},
            {name: 'ubicacion', type: 'string'},
            {name: 'id_condicion', type: 'integer'},
            {name: 'condicion', type: 'string'},
            {name: 'tiene_item', type: 'integer'},
            {name: 'id_cargo', type: 'integer'},
            {name: 'cargo_codigo', type: 'string'},
            {name: 'cargo_resolucion_ministerial_id', type: 'integer'},
            {name: 'cargo_resolucion_ministerial', type: 'string'},
            {name: 'estado', type: 'integer'},
            {name: 'estado_descripcion', type: 'string'},
            {name: 'nombres', type: 'string'},
            {name: 'ci', type: 'string'},
            {name: 'expd', type: 'string'},
            {name: 'num_complemento', type: 'string'},
            {name: 'id_organigrama', type: 'integer'},
            {name: 'gerencia_administrativa', type: 'string'},
            {name: 'departamento_administrativo', type: 'string'},
            {name: 'id_area', type: 'integer'},
            {name: 'area', type: 'string'},
            {name: 'id_ubicacion', type: 'integer'},
            {name: 'num_contrato', type: 'string'},
            {name: 'fin_partida', type: 'string'},
            {name: 'id_procesocontratacion', type: 'integer'},
            {name: 'proceso_codigo', type: 'string'},
            {name: 'nivelsalarial', type: 'string'},
            {name: 'nivelsalarial_resolucion', type: 'string'},
            {name: 'cargo', type: 'string'},
            {name: 'sueldo', type: 'numeric'},
            {name: 'fecha_ini', type: 'date'},
            {name: 'fecha_incor', type: 'date'},
            {name: 'fecha_fin', type: 'date'},
            {name: 'fecha_baja', type: 'date'},
            {name: 'motivo_baja', type: 'string'},
            {name: 'observacion', type: 'string'},
            {name: 'relaboralperfil_id', type: 'integer'},
            {name: 'asignacion_estado', type: 'string'},
            {name: 'relaboralperfil_ubicacion_id', type: 'integer'},
            {name: 'relaboralperfil_ubicacion', type: 'string'},
            {name: 'relaboralperfil_estacion_id', type: 'integer'},
            {name: 'relaboralperfil_estacion', type: 'string'},
            {name: 'relaboralperfil_fecha_ini', type: 'date'},
            {name: 'relaboralperfil_fecha_fin', type: 'date'},
            {name: 'relaboralperfil_observacion', type: 'string'},
            {name: 'relaboralperfil_estado', type: 'integer'},
            {name: 'relaboralperfil_estado_descripcion', type: 'string'}
        ],
        url: '/relaboralesperfiles/listsingle?id='+idPerfilLaboral,
        cache: false
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    cargarRegistrosDeRelacionesLaborales();
    function cargarRegistrosDeRelacionesLaborales() {
        var theme = prepareSimulator("grid");
        $("#divGrillaAsignacionesIndividuales").jqxGrid(
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
                    /*container.append("<button id='approverowbutton'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-check-square fa-2x text-info' title='Aprobar registro'></i></button>");*/
                    container.append("<button id='updaterowbutton'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-pencil-square fa-2x text-info' title='Modificar registro.'/></button>");
                    container.append("<button id='deleterowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-minus-square fa-2x text-info' title='Dar de baja al registro.'/></i></button>");
                    container.append("<button id='viewrowbutton' class='btn btn-sm btn-primary' type='button'><i class='gi gi-calendar fa-2x text-info' title='Vista Historial.'/></i></button>");

                    $("#addrowbutton").jqxButton();
                    /*$("#approverowbutton").jqxButton();*/
                    $("#updaterowbutton").jqxButton();
                    $("#deleterowbutton").jqxButton();
                    $("#viewrowbutton").jqxButton();

                    $("#hdnAccionAsignacionSinglePerfil").val(0);
                    $("#hdnIdRelaboralAsignacionSinglePerfil").val(0);
                    $("#hdnIdPerfilLaboralAsignacionSinglePerfil").val(0);
                    $("#hdnIdRelaboralPerfilAsignacionSinglePerfil").val(0);

                    /* Registrar nueva relación laboral.*/
                    $("#addrowbutton").off();
                    $("#addrowbutton").on('click', function () {
                        var selectedrowindex = $("#divGrillaAsignacionesIndividuales").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGrillaAsignacionesIndividuales').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                /**
                                 * El registro de una nueva asignación de Perfil Laboral es posible para toda relación laboral
                                 * vigente, siempre y cuando las fechas de asignación no tengan conflicto con otras fechas
                                 * registradas.
                                 */
                                if (dataRecord.estado>=1) {
                                    $("#hdnAccionAsignacionSinglePerfil").val(1);
                                    $("#spanPrefijoFormularioAsignacionSingle").html("Nueva ");
                                    var fechaMin = fechaConvertirAFormato(dataRecord.fecha_ini,"-");
                                    if(dataRecord.fecha_incor!=null)
                                        fechaMin = fechaConvertirAFormato(dataRecord.fecha_incor,"-");
                                    var fechaMax = fechaConvertirAFormato(dataRecord.fecha_fin,"-");
                                    generaModalAdicionAsignacionSinglePerfilLaboral(1,dataRecord.id_ubicacion,0,"","",fechaMin,fechaMax,"");
                                    $("#hdnIdRelaboralAsignacionSinglePerfil").val(dataRecord.id_relaboral);
                                    $("#hdnIdPerfilLaboralAsignacionSinglePerfil").val(idPerfilLaboral);
                                } else {
                                    var msje = "";
                                    if(dataRecord.relaboralperfil_id!=null)
                                    msje = "El registro seleccionado ya tiene una asignaci&oacute;n de Perfil. ";
                                    if(dataRecord.estado==0)
                                    msje += "Debe seleccionar un registro en estado ACTIVO o EN PROCESO para poder asignar un Perfil.";
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
                    $("#updaterowbutton").off();
                    $("#updaterowbutton").on('click', function () {
                        var selectedrowindex = $("#divGrillaAsignacionesIndividuales").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGrillaAsignacionesIndividuales').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                if(dataRecord.relaboralperfil_estado==1){
                                    $("#hdnAccionAsignacionSinglePerfil").val(2);
                                    $("#spanPrefijoFormularioAsignacionSingle").html("Modificaci&oacute;n ");
                                    var fechaIni = fechaConvertirAFormato(dataRecord.relaboralperfil_fecha_ini,'-');
                                    var fechaFin = fechaConvertirAFormato(dataRecord.relaboralperfil_fecha_fin,'-');
                                    var fechaMin = fechaConvertirAFormato(dataRecord.fecha_ini,"-");
                                    if(dataRecord.fecha_incor!=null)
                                        fechaMin = fechaConvertirAFormato(dataRecord.fecha_incor,"-");
                                    var fechaMax = fechaConvertirAFormato(dataRecord.fecha_fin,"-");
                                    generaModalAdicionAsignacionSinglePerfilLaboral(2,dataRecord.relaboralperfil_ubicacion_id,dataRecord.relaboralperfil_estacion_id,fechaIni,fechaFin,fechaMin,fechaMax,dataRecord.relaboralperfil_observacion);
                                    $("#hdnIdRelaboralAsignacionSinglePerfil").val(dataRecord.id_relaboral);
                                    $("#hdnIdPerfilLaboralAsignacionSinglePerfil").val(idPerfilLaboral);
                                    $("#hdnIdRelaboralPerfilAsignacionSinglePerfil").val(dataRecord.relaboralperfil_id);
                                }else
                                {
                                    var msje = "Debe seleccionar un registro que se encuentre 'ASIGNADO' para realizar la modificaci&oacute;n.";
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
                    $("#deleterowbutton").off();
                    $("#deleterowbutton").on('click', function () {
                        var selectedrowindex = $("#divGrillaAsignacionesIndividuales").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGrillaAsignacionesIndividuales').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {

                                /*
                                 *  Para dar de baja un registro, este debe estar inicialmente en estado ASIGNADO
                                 */
                                if(dataRecord.relaboralperfil_estado==1){
                                    if(confirm("¿Esta seguro de que desea dar de baja el registro de asignación de Perfil?")){
                                        var ok = bajaRegistroAsignacionPerfilLaboral(dataRecord.relaboralperfil_id);
                                        if(ok){
                                            $("#divGrillaAsignacionesIndividuales").jqxGrid("updatebounddata");
                                            var msje = "Baja exitosa del registro.";
                                            $("#divMsjeNotificacionSuccess").html("");
                                            $("#divMsjeNotificacionSuccess").append(msje);
                                            $("#divMsjeNotificacionSuccess").jqxNotification("open");
                                        }
                                    }
                                } else {
                                    var msje = "Debe seleccionar un registro que se encuentre 'ASIGNADO' para realizar la modificaci&oacute;n.";
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
                    $("#viewrowbutton").off();
                    $("#viewrowbutton").on('click', function () {

                        var selectedrowindex = $("#divGrillaAsignacionesIndividuales").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGrillaAsignacionesIndividuales').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                if (dataRecord.relaboralperfil_id >= 0) {
                                    alert("Vista de todos los calendarios para esta relación laboral.")

                                } else {
                                    var msje = "Para acceder a la vista del registro, la persona debe haber tenido al menos un registro de relaci&oacute,n laboral que implica un estado ACTIVO o PASIVO.";
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
                    /*{
                     text: 'Nro.', sortable: false, filterable: false, editable: false,
                     groupable: false, draggable: false, resizable: false,
                     columntype: 'number', width: 50,cellsalign:'center',align:'center'
                     },*/
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
                    {
                        text: 'Asignaci&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'relaboralperfil_estado_descripcion',
                        width: 120,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Asig. Ubicaci&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'relaboralperfil_ubicacion',
                        width: 120,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Asig. Estaci&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'relaboralperfil_estacion',
                        width: 100,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Asig. Fecha Ini',
                        datafield: 'relaboralperfil_fecha_ini',
                        filtertype: 'range',
                        width: 110,
                        cellsalign: 'center',
                        cellsformat: 'dd-MM-yyyy',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Asig. Fecha Fin',
                        datafield: 'relaboralperfil_fecha_fin',
                        filtertype: 'range',
                        width: 110,
                        cellsalign: 'center',
                        cellsformat: 'dd-MM-yyyy',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Nombres y Apellidos',
                        columntype: 'textbox',
                        filtertype: 'input',
                        datafield: 'nombres',
                        width: 215,
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'CI',
                        columntype: 'textbox',
                        filtertype: 'input',
                        datafield: 'ci',
                        width: 90,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Exp',
                        filtertype: 'checkedlist',
                        datafield: 'expd',
                        width: 40,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Condici&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'condicion',
                        width: 150,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
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
                    /*{
                     text: 'N/C',
                     columntype: 'textbox',
                     filtertype: 'input',
                     datafield: 'num_complemento',
                     width: 40,
                     cellsalign: 'center',
                     align: 'center',
                     hidden: true
                     },*/
                    {
                        text: 'Gerencia',
                        filtertype: 'checkedlist',
                        datafield: 'gerencia_administrativa',
                        width: 220,
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Departamento',
                        filtertype: 'checkedlist',
                        datafield: 'departamento_administrativo',
                        width: 220,
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: '&Aacute;rea',
                        filtertype: 'checkedlist',
                        datafield: 'area',
                        width: 220,
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Proceso',
                        filtertype: 'checkedlist',
                        datafield: 'proceso_codigo',
                        width: 220,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Fuente',
                        filtertype: 'checkedlist',
                        datafield: 'fin_partida',
                        width: 220,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Nivel Salarial',
                        filtertype: 'checkedlist',
                        datafield: 'nivelsalarial',
                        width: 220,
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Cargo',
                        columntype: 'textbox',
                        filtertype: 'input',
                        datafield: 'cargo',
                        width: 215,
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Haber',
                        filtertype: 'checkedlist',
                        datafield: 'sueldo',
                        width: 100,
                        cellsalign: 'right',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Fecha Inicio',
                        datafield: 'fecha_ini',
                        filtertype: 'range',
                        width: 200,
                        cellsalign: 'center',
                        cellsformat: 'dd-MM-yyyy',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Fecha Incor.',
                        datafield: 'fecha_incor',
                        filtertype: 'range',
                        width: 100,
                        cellsalign: 'center',
                        cellsformat: 'dd-MM-yyyy',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Fecha Fin',
                        datafield: 'fecha_fin',
                        filtertype: 'range',
                        width: 100,
                        cellsalign: 'center',
                        cellsformat: 'dd-MM-yyyy',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Fecha Baja',
                        datafield: 'fecha_baja',
                        filtertype: 'range',
                        width: 100,
                        cellsalign: 'center',
                        cellsformat: 'dd-MM-yyyy',
                        align: 'center',
                        hidden: false
                    },
                    {text: 'Motivo Baja', datafield: 'motivo_baja', width: 100, hidden: false},
                    {text: 'Observacion', datafield: 'observacion', width: 100, hidden: false},
                ]
            });
        var listSource = [
            {label: 'Ubicaci&oacute;n', value: 'relaboralperfil_ubicacion', checked: true},
            {label: 'Estaci&oacute;n', value: 'relaboralperfil_estacion', checked: true},
            {label: 'Fecha Ini Perfil', value: 'relaboralperfil_fecha_ini', checked: true},
            {label: 'Fecha Fin Perfil', value: 'relaboralperfil_fecha_fin', checked: true},
            {label: 'Nombres y Apellidos', value: 'nombres', checked: true},
            {label: 'CI', value: 'ci', checked: true},
            {label: 'Exp', value: 'expd', checked: true},
            {label: 'Condici&oacute;n', value: 'condicion', checked: true},
            {label: 'Estado', value: 'estado_descripcion', checked: true},
            /*{label: 'N/C', value: 'num_complemento', checked: false},*/
            {label: 'Gerencia', value: 'gerencia_administrativa', checked: true},
            {label: 'Departamento', value: 'departamento_administrativo', checked: true},
            {label: '&Aacute;rea', value: 'area', checked: true},
            {label: 'proceso', value: 'proceso_codigo', checked: true},
            {label: 'Fuente', value: 'fin_partida', checked: true},
            {label: 'Nivel Salarial', value: 'nivelsalarial', checked: true},
            {label: 'Cargo', value: 'cargo', checked: true},
            {label: 'Haber', value: 'sueldo', checked: true},
            {label: 'Fecha Inicio', value: 'fecha_ini', checked: true},
            {label: 'Fecha Incor.', value: 'fecha_incor', checked: true},
            {label: 'Fecha Fin', value: 'fecha_fin', checked: true},
            {label: 'Fecha Baja', value: 'fecha_baja', checked: true},
            {label: 'Motivo Baja', value: 'motivo_baja', checked: true},
            {label: 'Observacion', value: 'observacion', checked: true},
        ];
        $("#lstBoxColumnasDisponibles").jqxListBox({source: listSource, width: "100%", height: 430, checkboxes: true});
        $("#lstBoxColumnasDisponibles").on('checkChange', function (event) {
            $("#divGrillaAsignacionesIndividuales").jqxGrid('beginupdate');
            if (event.args.checked) {
                $("#divGrillaAsignacionesIndividuales").jqxGrid('showcolumn', event.args.value);
            }
            else {
                $("#divGrillaAsignacionesIndividuales").jqxGrid('hidecolumn', event.args.value);
            }
            $("#divGrillaAsignacionesIndividuales").jqxGrid('endupdate');
        });
    }
}
var rownumberrenderer = function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
    var nro = row + 1;
    return "<div align='center'>" + nro + "</div>";
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
 * Función para cargar la lista de ubicaciones principales.
 * La particularidad de esta función es que sólo muestra la ubicación preestablecida
 * @param accion
 * @param idUbicacion
 */
function cargarUbicacionesPrincipalesAsignacionIndividual(accion,idUbicacion){
    var selected = "";
    var sufijo = "";
    if(accion==2)sufijo="";
    $("#lstUbicacionesAsignacionSingle"+sufijo).html("");
    $("#lstUbicacionesAsignacionSingle"+sufijo).append("<option value='0' data-cant-nodos-hijos='0'>Seleccionar...</option>");
    $("#lstUbicacionesAsignacionSingle"+sufijo).prop("disabled",true);
    if(idUbicacion>0){
        $.ajax({
            url: '/ubicaciones/listprincipales/',
            type: "POST",
            datatype: 'json',
            async: false,
            cache: false,
            success: function (data) {
                var res = jQuery.parseJSON(data);
                if (res.length > 0) {
                    $("#lstUbicacionesAsignacionSingle"+sufijo).prop("disabled",false);
                    $.each(res, function (key, val) {
                        if(idUbicacion==val.id){
                            selected = "selected";
                        }else selected="";
                        $("#lstUbicacionesAsignacionSingle"+sufijo).append("<option value='"+val.id+"' data-cant-nodos-hijos='"+val.cant_nodos_hijos+"' "+selected+">"+val.ubicacion+"</option>");
                    });
                }else $("#lstUbicacionesAsignacionSingle"+sufijo).prop("disabled",true);
            }
        });
    }
}
/**
 * Función para cargar la lista correspondiente a las estaciones por línea.
 * @param accion
 * @param idUbicacion
 * @param idLinea
 */
function cargarEstacionesAsignacionIndividual(accion,idUbicacion,idEstacion){
    var sufijo = "";
    if(accion==2) sufijo="";
    $("#lstEstacionesAsignacionSingle"+sufijo).html("");
    $("#lstEstacionesAsignacionSingle"+sufijo).append("<option value='0'>Seleccionar...</option>");
    $("#lstEstacionesAsignacionSingle"+sufijo).prop("disabled","disabled");
    $("#spanAsteriscoEstacionesAsignacionSingle"+sufijo).html("");
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
                    $("#lstEstacionesAsignacionSingle"+sufijo).prop("disabled",false);
                    $("#spanAsteriscoEstacionesAsignacionSingle"+sufijo).text(" *");
                    $.each(res, function (key, val) {
                        if(idEstacion==val.id){
                            selected = "selected";
                        }else selected = "";
                        $("#lstEstacionesAsignacionSingle"+sufijo).append("<option value='"+val.id+"' "+selected+">"+val.ubicacion+"</option>");
                    });
                }else $("#lstEstacionesAsignacionSingle"+sufijo).prop("disabled","disabled");
            }
        });
    }
}
/**
 * Función para la generación de la ventana modal para el registro de una nueva asignación de perfil laboral de manera individual.
 * @param accion
 * @param idUbicacion
 * @param idEstacion
 * @param fechaIni
 * @param fechaFin
 * @param observacion
 */
function generaModalAdicionAsignacionSinglePerfilLaboral(accion,idUbicacion,idEstacion,fechaIni,fechaFin,fechaMin,fechaMax,observacion){

    $('#txtFechaIniAsignacionSingle').datepicker('remove');
    $('#txtFechaIniAsignacionSingle').datepicker({
        startDate: fechaMin,
        endDate: fechaMax
    });
    $('#txtFechaFinAsignacionSingle').datepicker('remove');
    $('#txtFechaFinAsignacionSingle').datepicker({
        startDate: fechaMin,
        endDate: fechaMax
    });

    $('#txtFechaIniAsignacionSingle').data("date-min",fechaMin);
    $('#txtFechaIniAsignacionSingle').data("date-max",fechaMax);
    $('#txtFechaFinAsignacionSingle').data("date-min",fechaMin);
    $('#txtFechaFinAsignacionSingle').data("date-max",fechaMax);

    if(accion==1){
        $("#lstEstacionesAsignacionSingle").html("");
        $("#lstEstacionesAsignacionSingle").append("<option value='0'>Seleccionar...</option>");
        $("#lstEstacionesAsignacionSingle").prop("disabled",true);
        limpiarMensajesErrorPorValidacionAsignacionSinglePerfil(1);
        cargarUbicacionesPrincipalesAsignacionIndividual(1,idUbicacion);
        cargarEstacionesAsignacionIndividual(1,idUbicacion,0);
        $("#lstUbicacionesAsignacionSingle").off();
        $("#lstUbicacionesAsignacionSingle").on("change",function(){
            cargarEstacionesAsignacionIndividual(1,$(this).val(),0);
        });
        $("#txtFechaIniAsignacionSingle").val(fechaMin);
        $("#txtFechaFinAsignacionSingle").val(fechaMax);
        $("#txtObservacionAsignacionSingle").val("");
    }else{
        limpiarMensajesErrorPorValidacionAsignacionSinglePerfil(2);
        cargarUbicacionesPrincipalesAsignacionIndividual(2,idUbicacion);
        cargarEstacionesAsignacionIndividual(2,idUbicacion,idEstacion);
        $("#lstUbicacionesAsignacionSingle").off();
        $("#lstUbicacionesAsignacionSingle").on("change",function(){
            cargarEstacionesAsignacionIndividual(2,$(this).val(),0);
        });
        $("#txtFechaIniAsignacionSingle").val(fechaIni);
        $("#txtFechaFinAsignacionSingle").val(fechaFin);
        $("#txtObservacionAsignacionSingle").val(observacion);
    }
    $('#popupAsignacionPerfilLaboral').modal('show');
    $("#lstUbicacionesAsignacionSingle").focus();
}
/**
 * Función para la validación del formulario de asignación de perfil laboral.
 * @param accion
 */
function validaFormularioAsignacionSinglePerfilLaboral(accion,idRelaboralPerfil,idRelaboral,idPerfilLaboral,idUbicacion,fechaIni,fechaFin){
    var ok = true;
    var idUbicacion = $("#lstUbicacionesAsignacionSingle").val();
    var ctrlEstacion = $("#lstUbicacionesAsignacionSingle option:selected").data("cant-nodos-hijos");
    var idEstacion = $("#lstEstacionesAsignacionSingle").val();
    var fechaIni = $("#txtFechaIniAsignacionSingle").val();
    var fechaFin = $("#txtFechaFinAsignacionSingle").val();
    limpiarMensajesErrorPorValidacionAsignacionSinglePerfil(accion);
    var enfoque = "";
    if(idUbicacion<=0){
        ok = false;
        var msje = "Debe seleccionar la Ubicaci&oacute;n para la asignaci&oacute;n necesariamente.";
        $("#divUbicacionesAsignacionSingle").addClass("has-error");
        $("#helpErrorUbicacionesAsignacionSingle").html(msje);
        if(enfoque==null)enfoque =$("#LstUbicacionesAsignacionSingle");
    }else{
        if(ctrlEstacion>0){
            if(idEstacion<=0){
                ok = false;
                var msje = "Debe seleccionar la Estaci&oacute;n para la asignaci&oacute;n necesariamente.";
                $("#divEstacionesAsignacionSingle").addClass("has-error");
                $("#helpErrorEstacionesAsignacionSingle").html(msje);
                if(enfoque==null)enfoque =$("#LstEstacionesAsignacionSingle");
            }
        }
    }
    if(fechaIni==""){
        ok = false;
        var msje = "Debe seleccionar la Fecha de Inicio para la asignaci&oacute;n necesariamente.";
        $("#divFechaIniAsignacionSingle").addClass("has-error");
        $("#helpErrorFechaIniAsignacionSingle").html(msje);
        if(enfoque==null)enfoque =$("#TxtFechaIniAsignacionSingle");
    }
    if(fechaFin==""){
        ok = false;
        var msje = "Debe seleccionar la Fecha de Finalizaci&oacute;n para la asignaci&oacute;n necesariamente.";
        $("#divFechaFinAsignacionSingle").addClass("has-error");
        $("#helpErrorFechaFinAsignacionSingle").html(msje);
        if(enfoque==null)enfoque =$("#TxtFechaFinAsignacionSingle");
    }
    if(fechaIni!=""&&fechaFin!=""){
        var sep='-';
        if(procesaTextoAFecha(fechaIni,sep)>procesaTextoAFecha(fechaFin,sep)){
            ok = false;
            var msje = "La Fecha de Finalizaci&oacute;n debe ser igual o mayor a la Fecha de Inicio.";
            $("#divFechaIniAsignacionSingle").addClass("has-error");
            $("#helpErrorFechaIniAsignacionSingle").html(msje);
            $("#divFechaFinAsignacionSingle").addClass("has-error");
            $("#helpErrorFechaFinAsignacionSingle").html(msje);
            if(enfoque==null)enfoque =$("#TxtFechaFinAsignacionSingle");
        }else{
            var fechaMin = $('#txtFechaIniAsignacionSingle').data("date-min");
            var fechaMax = $('#txtFechaIniAsignacionSingle').data("date-max");
            if(procesaTextoAFecha(fechaMin,sep)>procesaTextoAFecha(fechaIni,sep)){
                ok = false;
                var msje = "La Fecha de Inicio no puede ser superior a "+fechaMin+".";
                $("#divFechaIniAsignacionSingle").addClass("has-error");
                $("#helpErrorFechaIniAsignacionSingle").html(msje);
                if(enfoque==null)enfoque =$("#TxtFechaIniAsignacionSingle");
            }
            if(procesaTextoAFecha(fechaMax,sep)<procesaTextoAFecha(fechaFin,sep)){
                ok = false;
                var msje = "La Fecha de Finalizaci&oacute;n no puede ser superior a "+fechaMax+".";
                $("#divFechaFinAsignacionSingle").addClass("has-error");
                $("#helpErrorFechaFinAsignacionSingle").html(msje);
                if(enfoque==null)enfoque =$("#TxtFechaFinAsignacionSingle");
            }

        }
    }
    var ok2 = verificaSobrePosicionDePerfiles(idRelaboralPerfil,idRelaboral,idPerfilLaboral,idUbicacion,fechaIni,fechaFin);
    if(ok2){
        ok=false;
        var msje = "Existe ya un registro de perfil con sobreposici&oacute;n de fechas con el perfil que intenta registrar para esta persona.";
        $("#divMsjePorError").html("");
        $("#divMsjePorError").append(msje);
        $("#divMsjeNotificacionError").jqxNotification("open");
    }
    return ok;
}
/**
 * Función para limpiar el formulario de mensajes de errores.
 * @param accion
 */
function limpiarMensajesErrorPorValidacionAsignacionSinglePerfil(accion){
    var sufijo = "";
    if(accion==2)sufijo="";

    $("#divUbicacionesAsignacionSingle"+sufijo).removeClass("has-error");
    $("#helpErrorUbicacionesAsignacionSingle"+sufijo).html("");

    $("#divEstacionesAsignacionSingle"+sufijo).removeClass("has-error");
    $("#helpErrorEstacionesAsignacionSingle"+sufijo).html("");

    $("#divFechaIniAsignacionSingle"+sufijo).removeClass("has-error");
    $("#helpErrorFechaIniAsignacionSingle"+sufijo).html("");

    $("#divFechaFinAsignacionSingle"+sufijo).removeClass("has-error");
    $("#helpErrorFechaFinAsignacionSingle"+sufijo).html("");
}