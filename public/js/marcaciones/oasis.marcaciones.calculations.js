/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  27-03-2015
 */
/**
 * Función para la búsqueda de registros de personal que cumplen el criterio de búsqueda establecido a través del parámetro.
 * @param objParametros
 */
function definirGrillaMarcacionesRango(objParametros) {
    var idOrganigrama = objParametros.idOrganigrama;
    var idArea=objParametros.idArea;
    var idUbicacion=objParametros.idUbicacion;
    var idRelaboral=objParametros.idRelaboral;
    var fechaIni = objParametros.fechaIni;
    var fechaFin = objParametros.fechaFin;
    var source =
    {
        datatype: "json",
        datafields: [
            {name: 'nro_row', type: 'integer'},
            {name: 'nombres', type: 'string'},
            {name: 'ci', type: 'string'},
            {name: 'expd', type: 'string'},
            {name: 'gestion', type: 'integer'},
            {name: 'mes', type: 'integer'},
            {name: 'mes_nombre', type: 'string'},
            {name: 'fecha', type: 'date'},
            {name: 'hora', type: 'time'},
            {name: 'id_maquina', type: 'integer'},
            {name: 'maquina', type: 'string'},
            {name: 'observacion', type: 'string'},
            {name: 'estado', type: 'string'},
            {name: 'estado_descripcion', type: 'string'},
            {name: 'user_reg_id', type: 'integer'},
            {name: 'fecha_reg', type: 'date'}
        ],
        url: '/marcaciones/list?id_organigrama='+idOrganigrama+'&id_area='+idArea+'&id_ubicacion='+idUbicacion+'&id_relaboral='+idRelaboral+'&fecha_ini='+fechaIni+'&fecha_fin='+fechaFin,
        cache: false
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    cargarRegistrosDeMarcaciones();
    function cargarRegistrosDeMarcaciones() {
        var theme = prepareSimulator("grid");
        $("#divGridMarcacionesRango").jqxGrid(
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
                    /*container.append("<button title='Registrar nuevo control de excepci&oacute;n.' id='addcontrolexceptrowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-plus-square fa-2x text-info' title='Nuevo Registro.'/></i></button>");
                     container.append("<button title='Aprobar registro de control de excepci&oacute;n.' id='approveexceptrowbutton'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-check-square fa-2x text-info' title='Aprobar registro'></i></button>");
                     container.append("<button title='Modificar registro de control de excepci&oacute;n.' id='updateexceptrowbutton'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-pencil-square fa-2x text-info' title='Modificar registro.'/></button>");
                     container.append("<button title='Dar de baja registro de control de excepci&oacute;n.' id='deleteexceptrowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-minus-square fa-2x text-info' title='Dar de baja al registro.'/></i></button>");*/
                    container.append("<button title='Ver calendario de turnos y permisos de manera global para la persona.' id='calendarrowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-calendar fa-2x text-info' title='Vista Turnos Laborales por Perfil.'/></i></button>");

                    /*$("#addcontrolexceptrowbutton").jqxButton();
                     $("#approveexceptrowbutton").jqxButton();
                     $("#updateexceptrowbutton").jqxButton();
                     $("#deleteexceptrowbutton").jqxButton();*/
                    $("#calendarrowbutton").jqxButton();

                    $("#hdnIdControlExcepcionEdit").val(0);
                    $("#hdnIdRelaboralNew").val(0);
                    $("#hdnIdRelaboralEdit").val(0);

                    $("#calendarrowbutton").off();
                    $("#calendarrowbutton").on("click",function(){
                        var selectedrowindex = $("#divGridControlMarcaciones").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGridControlMarcaciones').jqxGrid('getrowdata', selectedrowindex);
                            if(dataRecord!=undefined){
                                if(dataRecord.gestion!=null&&dataRecord.gestion!=undefined){
                                    $('#divTabControlMarcaciones').jqxTabs('enableAt', 0);
                                    $('#divTabControlMarcaciones').jqxTabs('enableAt', 3);
                                    $('#divTabControlMarcaciones').jqxTabs({selectedItem: 3});

                                    var idPerfilLaboral=0;
                                    var tipoHorario=2;

                                    $("#spanPrefijoCalendarioLaboral").html("");
                                    $("#spanSufijoCalendarioLaboral").html(" Vrs. Calendario de Excepciones (Individual)");

                                    var defaultDia = 1;
                                    var defaultMes = dataRecord.mes-1;
                                    var defaultGestion = dataRecord.gestion;
                                    var fechaIni = "";
                                    var fechaFin = "";
                                    var contadorPerfiles = 0;
                                    var arrHorariosRegistrados = obtenerTodosHorariosRegistradosEnCalendarioRelaboralParaVerAsignaciones(idRelaboral,idPerfilLaboral,tipoHorario,false,fechaIni,fechaFin,contadorPerfiles);
                                    $("#calendar").html("");
                                    var arrFechasPorSemana = iniciarCalendarioLaboralPorRelaboralTurnosYExcepcionesParaVerAsignaciones(dataRecordRelaboral,idRelaboral,5,idPerfilLaboral,tipoHorario,arrHorariosRegistrados,defaultGestion,defaultMes,defaultDia);
                                    sumarTotalHorasPorSemana(arrFechasPorSemana);

                                    $('#tabFichaPersonalTurnAndExcept').jqxTabs({
                                        theme: 'oasis',
                                        width: '100%',
                                        height: '100%',
                                        position: 'top'
                                    });
                                    /*******************************************************************************************************/
                                    $('#tabFichaPersonalTurnAndExcept').jqxTabs({
                                        theme: 'oasis',
                                        width: '100%',
                                        height: '100%',
                                        position: 'top'
                                    });
                                    $('#tabFichaPersonalTurnAndExcept').jqxTabs({selectedItem: 0});
                                    $(".ddNombresTurnAndExcept").html(dataRecordRelaboral.nombres+"&nbsp;");
                                    $(".ddCIAndNumComplementoExpdTurnAndExcept").html(dataRecordRelaboral.ci+dataRecordRelaboral.num_complemento+" "+dataRecordRelaboral.expd+"&nbsp;");
                                    $("#ddCargoTurnAndExcept").html(dataRecordRelaboral.cargo+"&nbsp;");
                                    $("#ddProcesoTurnAndExcept").html(dataRecordRelaboral.proceso_codigo+"&nbsp;");
                                    $("#ddFinanciamientoTurnAndExcept").html(dataRecordRelaboral.condicion+" (Partida "+dataRecordRelaboral.partida+")");
                                    $("#ddGerenciaTurnAndExcept").html(dataRecordRelaboral.gerencia_administrativa+"&nbsp;");
                                    if(dataRecordRelaboral.departamento_administrativo!=""&&dataRecordRelaboral.departamento_administrativo!=null){
                                        $("#ddDepartamentoTurnAndExcept").show();
                                        $("#dtDepartamentoTurnAndExcept").show();
                                        $("#ddDepartamentoTurnAndExcept").html(dataRecordRelaboral.departamento_administrativo+"&nbsp;");
                                    }
                                    else {
                                        $("#dtDepartamentoTurnAndExcept").hide();
                                        $("#ddDepartamentoTurnAndExcept").hide();
                                    }
                                    $("#ddUbicacionTurnAndExcept").html(dataRecordRelaboral.ubicacion+"&nbsp;");

                                    switch (dataRecordRelaboral.tiene_item) {
                                        case 1:
                                            $("#dtItemTurnAndExcept").show();
                                            $("#ddItemTurnAndExcept").show();
                                            $("#ddItemTurnAndExcept").html(dataRecordRelaboral.item+"&nbsp;");
                                            break;
                                        case 0:
                                            $("#dtItemTurnAndExcept").hide();
                                            $("#ddItemTurnAndExcept").hide();
                                            break;
                                    }
                                    $("#ddNivelSalarialTurnAndExcept").html(dataRecordRelaboral.nivelsalarial+"&nbsp;");
                                    $("#ddHaberTurnAndExcept").html(dataRecordRelaboral.sueldo+"&nbsp;");
                                    $("#ddFechaIngTurnAndExcept").html(fechaConvertirAFormato(dataRecordRelaboral.fecha_ing,"-")+"&nbsp;");
                                    if(dataRecordRelaboral.fecha_incor!=null){
                                        var fechaIncor = fechaConvertirAFormato(dataRecordRelaboral.fecha_incor,"-");
                                        $("#dtFechaIncorTurnAndExcept").show();
                                        $("#ddFechaIncorTurnAndExcept").show();
                                        $("#ddFechaIncorTurnAndExcept").html(fechaIncor+"&nbsp;");
                                    }else{
                                        $("#dtFechaIncorTurnAndExcept").hide();
                                        $("#ddFechaIncorTurnAndExcept").hide();
                                    }
                                    $("#ddFechaIniTurnAndExcept").html(fechaConvertirAFormato(dataRecordRelaboral.fecha_ini,"-")+"&nbsp;");
                                    switch (dataRecordRelaboral.tiene_item) {
                                        case 1:
                                            $("#dtFechaFinTurnAndExcept").hide();
                                            $("#ddFechaFinTurnAndExcept").hide();
                                            break;
                                        case 0:
                                            $("#dtFechaFinTurnAndExcept").show();
                                            $("#ddFechaFinTurnAndExcept").show();
                                            $("#ddFechaFinTurnAndExcept").html(fechaConvertirAFormato(dataRecordRelaboral.fecha_fin,"-")+"&nbsp;");
                                            break;
                                    }
                                    $("#ddEstadoDescripcionTurnAndExcept").html(dataRecordRelaboral.estado_descripcion+"&nbsp;");
                                    if(dataRecordRelaboral.estado==0){
                                        $("#dtFechaBajaTurnAndExcept").show();
                                        $("#ddFechaBajaTurnAndExcept").show();
                                        $("#ddFechaBajaTurnAndExcept").html(fechaConvertirAFormato(dataRecordRelaboral.fecha_baja,"-")+"&nbsp;");
                                        $("#dtMotivoBajaTurnAndExcept").show();
                                        $("#ddMotivoBajaTurnAndExcept").show();
                                        $("#ddMotivoBajaTurnAndExcept").html(fechaConvertirAFormato(dataRecordRelaboral.motivo_baja,"-")+"&nbsp;");
                                    }else{
                                        $("#dtFechaBajaTurnAndExcept").hide();
                                        $("#ddFechaBajaTurnAndExcept").hide();
                                        $("#dtMotivoBajaTurnAndExcept").hide();
                                        $("#ddMotivoBajaTurnAndExcept").hide();
                                    }
                                    /*******************************************************************************************************/

                                    $('#tabFichaPersonalTurnAndExcept').jqxTabs({selectedItem: 0});
                                    $("#ddNombresTurnAndExcept").html(nombres);
                                    var rutaImagen = obtenerRutaFoto(ci, numComplemento);
                                    $("#imgFotoPerfilTurnAndExceptRelaboral").attr("src", rutaImagen);
                                    $("#imgFotoPerfilContactoPerTurnAndExcept").attr("src", rutaImagen);
                                    $("#imgFotoPerfilContactoInstTurnAndExcept").attr("src", rutaImagen);
                                    $("#imgFotoPerfilTurnAndExcept").attr("src", rutaImagen);
                                    cargarPersonasContactosControlExcepciones(2,idPersona);
                                    $("#hdnIdRelaboralVistaTurnAndExcept").val(idRelaboral);
                                    $("#hdnSwPrimeraVistaHistorialTurnAndExcept").val(0);


                                }else{
                                    var msje = "Para acceder a la vista del calendario con las marcaciones y excepciones debidas debe seleccionar un registro necesariamente.";
                                    $("#divMsjePorError").html("");
                                    $("#divMsjePorError").append(msje);
                                    $("#divMsjeNotificacionError").jqxNotification("open");
                                }
                            }
                        }else{
                            var msje = "Para acceder a la vista del calendario con las marcaciones y excepciones debidas debe seleccionar un registro necesariamente.";
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
                        width: 80,
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
                    }/*,
                    {
                        text: 'Estado',
                        filtertype: 'checkedlist',
                        datafield: 'estado_descripcion',
                        width: 100,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false,
                        cellclassname: cellclass
                    }*/,
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
                        text: 'Fecha',
                        datafield: 'fecha',
                        filtertype: 'range',
                        width:90,
                        cellsalign: 'center',
                        cellsformat: 'dd-MM-yyyy',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Hora',
                        filtertype: 'checkedlist',
                        datafield: 'hora',
                        width: 70,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'M&aacute;quina',
                        filtertype: 'checkedlist',
                        datafield: 'maquina',
                        width: 70,
                        cellsalign: 'center',
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
                    }
                ]
            });
        var listSource = [
            {label: 'Nombres', value: 'nombres', checked: true},
            {label: 'CI', value: 'ci', checked: true},
            {label: 'Expd', value: 'expd', checked: true},
            {label: 'Gesti&oacute;n', value: 'gestion', checked: true},
            {label: 'Mes', value: 'mes_nombre', checked: true},
            {label: 'Fecha', value: 'fecha', checked: true},
            {label: 'Hora', value: 'hora', checked: true},
            {label: 'M&aacute;quina', value: 'maquina', checked: true},
            {label: 'Observaci&oacute;n', value: 'observacion', checked: true}
        ];
        $("#divListBoxMarcacionesRango").jqxListBox({source: listSource, width: "100%", height: 430, checkboxes: true});
        $("#divListBoxMarcacionesRango").on('checkChange', function (event) {
            $("#divGridMarcacionesRango").jqxGrid('beginupdate');
            if (event.args.checked) {
                $("#divGridMarcacionesRango").jqxGrid('showcolumn', event.args.value);
            }
            else {
                $("#divGridMarcacionesRango").jqxGrid('hidecolumn', event.args.value);
            }
            $("#divGridMarcacionesRango").jqxGrid('endupdate');
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