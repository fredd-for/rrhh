/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
<<<<<<< HEAD
 *   Fecha Creación:  03-11-2015
=======
 *   Fecha Creación:  03-03-2015
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
 */
/**
 * Función para la definición de la grilla que contiene la lista de registros de control de excepciones.
 * @param dataRecord
 */
<<<<<<< HEAD
function definirGrillaParaListaMisIdeasPorPersona(dataRecordMain) {
=======
function definirGrillaParaListaIdeasPorPersona(dataRecordMain) {
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
    var idRelaboral = dataRecordMain.id_relaboral;
    var genero = dataRecordMain.genero;
    var source =
    {
        datatype: "json",
        datafields: [
            {name: 'nro_row', type: 'integer'},
            {name: 'id', type: 'integer'},
<<<<<<< HEAD
            {name: 'padre_id', type: 'integer'},
            {name: 'relaboral_id', type: 'integer'},
            {name: 'rubro_id', type: 'integer'},
            {name: 'tipo_negocio', type: 'integer'},
            {name: 'tipo_negocio_descripcion', type: 'string'},
            {name: 'gestion', type: 'intege'},
            {name: 'mes', type: 'integer'},
            {name: 'mes_nombre', type: 'string'},
            {name: 'numero', type: 'integer'},
            {name: 'titulo', type: 'string'},
            {name: 'resumen', type: 'string'},
            {name: 'descripcion', type: 'string'},
            {name: 'inversion', type: 'string'},
            {name: 'beneficios', type: 'string'},
            {name: 'puntuacion_a', type: 'numeric'},
            {name: 'puntuacion_a_descripcion', type: 'string'},
            {name: 'puntuacion_b', type: 'numeric'},
            {name: 'puntuacion_b_descripcion', type: 'string'},
            {name: 'puntuacion_c', type: 'numeric'},
            {name: 'puntuacion_c_descripcion', type: 'string'},
            {name: 'puntuacion_d', type: 'numeric'},
            {name: 'puntuacion_d_descripcion', type: 'string'},
            {name: 'puntuacion_e', type: 'numeric'},
            {name: 'puntuacion_e_descripcion', type: 'string'},
            {name: 'observacion', type: 'string'},
            {name: 'estado', type: 'string'},
            {name: 'estado_descripcion', type: 'string'},
            {name: 'agrupador', type: 'integer'},
            {name: 'user_reg_id', type: 'integer'},
            {name: 'user_reg', type: 'string'},
            {name: 'pseudonimo', type: 'string'},
            {name: 'fecha_reg', type: 'date'},
            {name: 'user_mod_id', type: 'integer'},
            {name: 'user_mod', type: 'string'},
            {name: 'fecha_mod', type: 'date'}
        ],
        url: '/misideas/list?id='+idRelaboral+'&gestion=0',
        cache: false
=======
            {name: 'fecha_ini', type: 'date'},
            {name: 'hora_ini', type: 'time'},
            {name: 'fecha_fin', type: 'date'},
            {name: 'hora_fin', type: 'time'},
            {name: 'justificacion', type: 'string'},
            {name: 'turno', type: 'integer'},
            {name: 'turno_descripcion', type: 'string'},
            {name: 'entrada_salida', type: 'integer'},
            {name: 'entrada_salida_descripcion', type: 'string'},
            {name: 'controlexcepcion_observacion', type: 'string'},
            {name: 'controlexcepcion_estado', type: 'string'},
            {name: 'controlexcepcion_estado_descripcion', type: 'string'},
            {name: 'controlexcepcion_user_reg_id', type: 'numeric'},
            {name: 'controlexcepcion_user_registrador', type: 'string'},
            {name: 'controlexcepcion_fecha_reg', type: 'date'},
            {name: 'controlexcepcion_user_ver_id', type: 'numeric'},
            {name: 'controlexcepcion_user_verificador', type: 'string'},
            {name: 'controlexcepcion_fecha_ver', type: 'date'},
            {name: 'controlexcepcion_user_apr_id', type: 'numeric'},
            {name: 'controlexcepcion_user_aprobador', type: 'string'},
            {name: 'controlexcepcion_fecha_apr', type: 'date'},
            {name: 'controlexcepcion_user_mod_id', type: 'numeric'},
            {name: 'controlexcepcion_user_modificador', type: 'string'},
            {name: 'controlexcepcion_fecha_mod', type: 'date'},
            {name: 'excepcion_id', type: 'integer'},
            {name: 'excepcion', type: 'string'},
            {name: 'tipoexcepcion_id', type: 'integer'},
            {name: 'tipo_excepcion', type: 'string'},
            {name: 'genero_id', type: 'integer'},
            {name: 'genero', type: 'string'},
            {name: 'cantidad', type: 'numeric'},
            {name: 'unidad', type: 'string'},
            {name: 'fraccionamiento', type: 'string'},
            {name: 'frecuencia_descripcion', type: 'string'},
            {name: 'compensatoria', type: 'integer'},
            {name: 'compensatoria_descripcion', type: 'string'},
            {name: 'redondeo', type: 'integer'},
            {name: 'redondeo_descripcion', type: 'string'},
            {name: 'horario', type: 'integer'},
            {name: 'horario_descripcion', type: 'string'},
            {name: 'refrigerio', type: 'integer'},
            {name: 'refrigerio_descripcion', type: 'string'},
            {name: 'codigo', type: 'string'},
            {name: 'color', type: 'string'},
            {name: 'controlexcepcion_observacion', type: 'string'},
            {name: 'estado', type: 'string'},
            {name: 'estado_descripcion', type: 'string'},
            {name: 'agrupador', type: 'integer'},
            {name: 'boleta', type: 'integer'},
            {name: 'boleta_descripcion', type: 'string'}
        ],
        url: '/misideas/list?id='+idRelaboral,
        cache: false,
        root: 'Rows',
        beforeprocessing: function (data) {
            source.totalrecords = data[0].TotalRows;
        },
        filter: function()
        {
            // Actualiza la grilla y reenvia los datos actuales al servidor
            $("#divGridIdeas").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
            // Actualiza la grilla y reenvia los datos actuales al servidor
            $("#divGridIdeas").jqxGrid('updatebounddata', 'sort');
        }
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    cargarRegistrosDeTolerancias();
    function cargarRegistrosDeTolerancias() {
        var theme = prepareSimulator("grid");
        $("#divGridIdeas").jqxGrid(
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
                pagesize:10,
                virtualmode: true,
                rendergridrows: function (params) {
                    return params.data;
                },
                showfilterrow: true,
                filterable: true,
                showtoolbar: true,
                autorowheight: true,
                rendertoolbar: function (toolbar) {
                    var me = this;
                    var container = $("<div></div>");
                    toolbar.append(container);
<<<<<<< HEAD
                    container.append("<button title='Actualizar Grilla' id='refreshidearowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-refresh fa-2x text-info' title='Refrescar Grilla.'/></i> Actualizar</button>");
                    container.append("<button title='Registrar nueva Idea de Negocio.' id='addidearowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-plus-square fa-2x text-info' title='Nuevo Registro.'/></i> Nuevo</button>");
                    container.append("<button title='Modificar registro de Idea de Negocio.' id='updateidearowbutton'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-pencil-square fa-2x text-info' title='Modificar registro.'/> Modificar</button>");
                    container.append("<button title='Concluir registro de Idea de Negocio.' id='finishidearowbutton'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-check-square fa-2x text-info' title='Concluir registro'></i> Concluir</button>");
                    container.append("<button title='Ver registro de Idea de Negocio.' id='viewidearowbutton'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-search-plus fa-2x text-info' title='Modificar registro.'/> Ver</button>");
                    /*container.append("<button title='Imprimir formulario de Idea de Negocio.' id='printexceptrowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-print fa-2x text-info' title='Imprimir Control de Excepci&oacute;n.'/></i> Imprimir</button>");*/
                    container.append("<button title='Dar de baja registro de Idea de Negocio.' id='deleteidearowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-times-circle-o fa-2x text-info' title='Dar de baja al registro.'/></i> Eliminar</button>");

                    $("#refreshidearowbutton").jqxButton();
                    $("#addidearowbutton").jqxButton();
                    $("#updateidearowbutton").jqxButton();
                    $("#finishidearowbutton").jqxButton();
                    $("#viewidearowbutton").jqxButton();
                    /*$("#printexceptrowbutton").jqxButton();*/
                    $("#deleteidearowbutton").jqxButton();

                    $("#hdnIdRelaboralNew").val(0);
                    $("#hdnIdRelaboralEdit").val(0);
                    $("#hdnIdRelaboralView").val(0);
                    $("#hdnIdIdeaEdit").val(0);
                    $("#hdnIdIdeaView").val(0);

                    $("#refreshidearowbutton").off();
                    $("#refreshidearowbutton").on('click', function () {
                        $("#divGridIdeas").jqxGrid("updatebounddata");
                    });
                    /* Registrar nueva excepción */
                    $("#addidearowbutton").off();
                    $("#addidearowbutton").on('click', function () {
                        inicializarFormularioMisIdeasNewEditView(1,idRelaboral,0,0,0,"","","","","",0,0,0,0,0,"");
                        $("#hdnIdRelaboralNew").val(idRelaboral);
                        $('#divTabIdeas').jqxTabs('enableAt', 1);
                        $('#divTabIdeas').jqxTabs('disableAt', 2);
                        $('#divTabIdeas').jqxTabs({selectedItem: 1});
                        $("#txtTituloNew").focus();
                    });
                    /* Modificar registro.*/
                    $("#updateidearowbutton").off();
                    $("#updateidearowbutton").on('click', function () {
=======
                    container.append("<button title='Actualizar Grilla' id='refreshcontrolexceptrowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-refresh fa-2x text-info' title='Refrescar Grilla.'/></i> Actualizar</button>");
                    container.append("<button title='Registrar nuevo control de excepci&oacute;n.' id='addcontrolexceptrowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-plus-square fa-2x text-info' title='Nuevo Registro.'/></i> Nuevo</button>");
                    container.append("<button title='Modificar registro de control de excepci&oacute;n.' id='updateexceptrowbutton'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-pencil-square fa-2x text-info' title='Modificar registro.'/> Modificar</button>");
                    container.append("<button title='Enviar registro de control de excepci&oacute;n.' id='sendexceptrowbutton'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-share fa-2x text-info' title='Enviar Solicitud'></i> Enviar</button>");
                    container.append("<button title='Imprimir formulario de control de excepci&oacute;n.' id='printexceptrowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-print fa-2x text-info' title='Imprimir Control de Excepci&oacute;n.'/></i> Imprimir</button>");
                    container.append("<button title='Dar de baja registro de control de excepci&oacute;n.' id='deleteexceptrowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-times-circle-o fa-2x text-info' title='Dar de baja al registro.'/></i> Eliminar</button>");
                    container.append("<button title='Ver calendario de turnos y permisos de manera global para la persona.' id='turnexceptrowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-calendar fa-2x text-info' title='Vista Turnos Laborales por Perfil.'/></i> Ver</button>");

                    $("#refreshcontrolexceptrowbutton").jqxButton();
                    $("#addcontrolexceptrowbutton").jqxButton();
                    $("#sendexceptrowbutton").jqxButton();
                    $("#updateexceptrowbutton").jqxButton();
                    $("#printexceptrowbutton").jqxButton();
                    $("#deleteexceptrowbutton").jqxButton();
                    $("#turnexceptrowbutton").jqxButton();
                    var genero_id = 0;
                    $("#hdnIntermediacion").val(-1);
                    $("#hdnIdRelDestPrincipal").val(0);
                    $("#hdnIdRelDestSecundario").val(0);
                    $("#hdnIdControlExcepcionEnvio").val(0);
                    $("#hdnIdControlExcepcionEdit").val(0);
                    $("#hdnIdRelaboralNew").val(0);
                    $("#hdnIdRelaboralEdit").val(0);
                    $("#lblObservacionNew").text("Observaciones:");
                    $("#lblObservacionEdit").text("Observaciones:");
                    $("#txtObservacionNew").prop("placeholder","Observaciones...");
                    $("#txtObservacionEdit").prop("placeholder","Observaciones...");

                    $("#refreshcontrolexceptrowbutton").off();
                    $("#refreshcontrolexceptrowbutton").on('click', function () {
                        $("#divGridIdeas").jqxGrid("updatebounddata");
                    });
                    /* Registrar nueva excepción */
                    $("#addcontrolexceptrowbutton").off();
                    $("#addcontrolexceptrowbutton").on('click', function () {
                    $('#divTabIdeas').jqxTabs('enableAt', 1);
                        $('#divTabIdeas').jqxTabs('disableAt', 2);
                        $('#divTabIdeas').jqxTabs('disableAt', 3);
                        $('#divTabIdeas').jqxTabs({selectedItem: 1});
                        inicializarFormularioIdeasNuevoEditar(1,idRelaboral,0,"","","","","",0,-1,genero,"");
                        $("#hdnIdRelaboralNew").val(idRelaboral);
                        $("#lstExcepcionesNew").focus();
                    });
                    /* Modificar registro.*/
                    $("#updateexceptrowbutton").off();
                    $("#updateexceptrowbutton").on('click', function () {
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                        var selectedrowindex = $("#divGridIdeas").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGridIdeas').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
<<<<<<< HEAD
                                $("#hdnIdIdeaEdit").val(dataRecord.id);
                                /**
                                 * La modificación sólo es admisible si el registro de horario laboral tiene estado EN PROCESO
                                 */
                                if (dataRecord.estado == 1) {

                                    $("#hdnIdRelaboralEdit").val(idRelaboral);
                                    limpiarMensajesErrorPorValidacionIdeas(2);
                                    inicializarFormularioMisIdeasNewEditView(2,idRelaboral,dataRecord.id,dataRecord.gestion,dataRecord.mes,dataRecord.tipo_negocio,dataRecord.titulo,dataRecord.resumen,dataRecord.descripcion,dataRecord.inversion,genero,dataRecord.beneficios,dataRecord.puntuacion_a,dataRecord.puntuacion_b,dataRecord.puntuacion_c,dataRecord.puntuacion_d,dataRecord.puntuacion_e,dataRecord.observacion);
                                    $("#txtTituloEdit").focus();
                                    $('#divTabIdeas').jqxTabs('enableAt', 0);
                                    $('#divTabIdeas').jqxTabs('disableAt', 1);
                                    $('#divTabIdeas').jqxTabs('disableAt', 2);
                                    $('#divTabIdeas').jqxTabs('enableAt', 2);

                                    $('#divTabIdeas').jqxTabs({selectedItem: 2});
                                } else {
                                    var msje = "Debe seleccionar un registro en estado EN ELABORACION necesariamente.";
=======
                                $("#hdnIdControlExcepcionEdit").val(dataRecord.id);
                                /**
                                 * La modificación sólo es admisible si el registro de horario laboral tiene estado EN PROCESO
                                 */
                                if (dataRecord.controlexcepcion_estado == 1||dataRecord.controlexcepcion_estado == 2) {

                                    if(dataRecord.boleta==1){
                                        $('#divTabIdeas').jqxTabs('enableAt', 0);
                                        $('#divTabIdeas').jqxTabs('disableAt', 1);
                                        $('#divTabIdeas').jqxTabs('disableAt', 2);
                                        $('#divTabIdeas').jqxTabs('disableAt', 3);
                                        $('#divTabIdeas').jqxTabs('enableAt', 2);

                                        $('#divTabIdeas').jqxTabs({selectedItem: 2});
                                        $("#hdnIdRelaboralEdit").val(idRelaboral);
                                        $("#hdnIdControlExcepcionEdit").val(dataRecord.id);
                                        limpiarMensajesErrorPorValidacionControlExcepcion(2);
                                        inicializarFormularioControlExcepcionesNuevoEditar(2,idRelaboral,dataRecord.excepcion_id,dataRecord.fecha_ini,dataRecord.hora_ini,dataRecord.fecha_fin,dataRecord.hora_fin,dataRecord.justificacion,dataRecord.turno,dataRecord.entrada_salida,genero,dataRecord.controlexcepcion_observacion);
                                    }else {
                                        var msje = "Usted no tiene los permisos suficientes para modificar este tipo de excepciones. Consulte con Personal de Control de Personal o el Administrador.";
                                        $("#divMsjePorError").html("");
                                        $("#divMsjePorError").append(msje);
                                        $("#divMsjeNotificacionError").jqxNotification("open");
                                    }

                                } else {
                                    var msje = "Debe seleccionar un registro en estado EN ELABORACI&Oacute;N necesariamente.";
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
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
<<<<<<< HEAD
                    /* Concluir registro.*/
                    $("#finishidearowbutton").off();
                    $("#finishidearowbutton").on('click', function () {
=======
                    /*Concluir Elaboración.*/
                    $("#sendexceptrowbutton").off();
                    $("#sendexceptrowbutton").on('click', function () {
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                        var selectedrowindex = $("#divGridIdeas").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGridIdeas').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
<<<<<<< HEAD
                                if (dataRecord.estado == 1) {
                                    if (confirm("¿Esta seguro de concluir este registro? Ya no podrá realizar modificaciones sobre el registro.")) {
                                        concluirRegistroDeIdeaDeNegocio(dataRecord.id);
                                    }
                                } else {
                                    var msje = "Debe seleccionar un registro con estado EN ELABORACION para posibilitar la conclusi&oacute;n del registro";
=======
                                if (dataRecord.controlexcepcion_estado == 1||dataRecord.controlexcepcion_estado == 2
                                    //||dataRecord.controlexcepcion_estado == 3||dataRecord.controlexcepcion_estado == 4||dataRecord.controlexcepcion_estado == 5
                                    ||dataRecord.controlexcepcion_estado == -3||dataRecord.controlexcepcion_estado == -4
                                ) {

                                    if(dataRecord.boleta==1){
                                        /**
                                         * Se controla si el plazo de envío sigue vigente, en caso contrario se despliega un mensaje de error desde la misma función.
                                         */
                                        var okPlazo = controlaPlazoDeSolicitud(dataRecord.id);
                                        if(okPlazo){
                                            var fechaIniAux = fechaConvertirAFormato(dataRecord.fecha_ini,"-");
                                            var fechaFinAux = fechaConvertirAFormato(dataRecord.fecha_fin,"-");
                                            var okFrecuencia = verificaFrecuencia(dataRecord.id,idRelaboral,dataRecord.excepcion_id,fechaIniAux,dataRecord.hora_ini,fechaFinAux,dataRecord.hora_fin,dataRecord.horario);
                                            if(okFrecuencia){
                                                $('#divTabIdeas').jqxTabs('enableAt', 0);
                                                $('#divTabIdeas').jqxTabs('disableAt', 1);
                                                $('#divTabIdeas').jqxTabs('disableAt', 2);
                                                $('#divTabIdeas').jqxTabs('enableAt', 3);
                                                $('#divTabIdeas').jqxTabs('enableAt', 4);

                                                $('#divTabIdeas').jqxTabs({selectedItem: 3});
                                                var verificado = 0;
                                                /**
                                                 * Si el registro esta ya verificado sólo requiere ser aprobado, que es un proceso como cualquiera
                                                 */
                                                if(dataRecord.controlexcepcion_estado == 5){
                                                    verificado = 1;
                                                }
                                                cargarDatosDestinatarios(dataRecordMain,dataRecord,verificado);
                                            }
                                        }
                                    }else {
                                        var msje = "Usted no tiene los permisos suficientes para modificar este tipo de excepciones. Consulte con Personal de Control de Personal o el Administrador.";
                                        $("#divMsjePorError").html("");
                                        $("#divMsjePorError").append(msje);
                                        $("#divMsjeNotificacionError").jqxNotification("open");
                                    }
                                } else {
                                    var msje = "Debe seleccionar un registro con estado EN ELABORACI&Oacute;N, ELABORADO o estar en espera de reenvio debido ERROR EN LA SOLICITUD para posibilitar la aprobaci&oacute;n del registro";
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
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
<<<<<<< HEAD
                    /* Imprimir de baja un registro.*/
=======
                    /* Dar de baja un registro.*/
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                    $("#printexceptrowbutton").off();
                    $("#printexceptrowbutton").on('click', function () {
                        var selectedrowindex = $("#divGridIdeas").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGridIdeas').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                /*
                                 *  Para dar de baja un registro, este debe estar inicialmente en estado EN PROCESO, de otro modo no es posible
                                 */
                                if (dataRecord.controlexcepcion_estado >= 1||dataRecord.controlexcepcion_estado < 0) {
                                    if(dataRecord.boleta==1){
                                        exportarFormulario(dataRecord.id);
                                    }else {
                                        var msje = "Usted no tiene los permisos suficientes para modificar este tipo de excepciones. Consulte con Personal de Control de Personal o el Administrador.";
                                        $("#divMsjePorError").html("");
                                        $("#divMsjePorError").append(msje);
                                        $("#divMsjeNotificacionError").jqxNotification("open");
                                    }
                                } else {
                                    var msje = "El formulario no puede ser visible en este estado "+dataRecord.controlexcepcion_estado_descripcion+".";
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
<<<<<<< HEAD
                    /* Ver registro.*/
                    $("#viewidearowbutton").off();
                    $("#viewidearowbutton").on('click', function () {
                        var selectedrowindex = $("#divGridIdeas").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGridIdeas').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                $("#hdnIdIdeaView").val(dataRecord.id);
                                /**
                                 * La modificación sólo es admisible si el registro de horario laboral tiene estado EN PROCESO
                                 */
                                if (dataRecord.estado >= 1) {

                                    $("#hdnIdRelaboralView").val(idRelaboral);
                                    limpiarMensajesErrorPorValidacionIdeas(3);
                                    inicializarFormularioMisIdeasNewEditView(3,idRelaboral,dataRecord.id,dataRecord.gestion,dataRecord.mes,dataRecord.tipo_negocio,dataRecord.titulo,dataRecord.resumen,dataRecord.descripcion,dataRecord.inversion,genero,dataRecord.beneficios,dataRecord.puntuacion_a,dataRecord.puntuacion_b,dataRecord.puntuacion_c,dataRecord.puntuacion_d,dataRecord.puntuacion_e,dataRecord.observacion);
                                    $("#lstGestionView").prop("disabled","disabled");
                                    $("#lstMesView").prop("disabled","disabled");
                                    $("#lstTiposDeNegocioView").prop("disabled","disabled");
                                    $('#divTabIdeas').jqxTabs('enableAt', 0);
                                    $('#divTabIdeas').jqxTabs('disableAt', 1);
                                    $('#divTabIdeas').jqxTabs('disableAt', 2);
                                    $('#divTabIdeas').jqxTabs('enableAt', 3);

                                    $('#divTabIdeas').jqxTabs({selectedItem: 3});
                                } else {
                                    var msje = "Debe seleccionar un registro en estado EN ELABORACION necesariamente.";
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
                    $("#deleteidearowbutton").off();
                    $("#deleteidearowbutton").on('click', function () {
=======

                    /* Dar de baja un registro.*/
                    $("#deleteexceptrowbutton").off();
                    $("#deleteexceptrowbutton").on('click', function () {
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                        var selectedrowindex = $("#divGridIdeas").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#divGridIdeas').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                /*
<<<<<<< HEAD
                                 *  Para dar de baja un registro, este debe estar inicialmente en estado EN ELABORACION, de otro modo no es posible
                                 */
                                if (dataRecord.estado == 1) {
                                    if (confirm("¿Esta seguro de dar de baja registro de Idea de Negocio?"))
                                        darDeBajaIdeaDeNegocio(dataRecord.id);
                                } else {
                                    var msje = "Para dar de baja un registro, este debe estar en estado EN ELABORACI&Oacute;N necesariamente.";
=======
                                 *  Para dar de baja un registro, este debe estar inicialmente en estado EN PROCESO, de otro modo no es posible
                                 */
                                if (dataRecord.controlexcepcion_estado == 1||dataRecord.controlexcepcion_estado == 2) {
                                    if (confirm("¿Esta seguro de dar de baja registro de control de excepción?"))
                                        if(dataRecord.boleta==1){
                                            darDeBajaControlExcepcion(dataRecord.id);
                                        }else{
                                            var msje = "Usted no tiene los permisos suficientes para modificar este tipo de excepciones. Consulte con Personal de Control de Personal o el Administrador.";
                                            $("#divMsjePorError").html("");
                                            $("#divMsjePorError").append(msje);
                                            $("#divMsjeNotificacionError").jqxNotification("open");
                                        }
                                } else {
                                    var msje = "Para dar de baja un registro, este debe estar en estado ELABORADO o en ELABORACI&Oacute;N necesariamente.";
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
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
<<<<<<< HEAD
=======
                    $("#turnexceptrowbutton").off();
                    $("#turnexceptrowbutton").on("click",function(){
                            $('#divTabIdeas').jqxTabs('enableAt', 0);
                            $('#divTabIdeas').jqxTabs('disableAt', 1);
                            $('#divTabIdeas').jqxTabs('disableAt', 2);
                            $('#divTabIdeas').jqxTabs('disableAt', 3);
                            $('#divTabIdeas').jqxTabs('enableAt', 4);

                            $('#divTabIdeas').jqxTabs({selectedItem: 4});
                            var idPerfilLaboral=0;
                            var tipoHorario=3;

                            $("#spanPrefijoCalendarioLaboral").html("");
                            $("#spanSufijoCalendarioLaboral").html(" Vrs. Calendario de Excepciones (Individual)");
                            var date = new Date();
                            var defaultDia = date.getDate();
                            var defaultMes = date.getMonth();
                            var defaultGestion = date.getFullYear();
                            var selectedrowindex = $("#divGridIdeas").jqxGrid('getselectedrowindex');
                            if (selectedrowindex >= 0) {
                                var dataRecordAux = $('#divGridIdeas').jqxGrid('getrowdata', selectedrowindex);
                                if (dataRecordAux != undefined) {
                                    var fechaAux = fechaConvertirAFormato(dataRecordAux.fecha_ini,"-");
                                    var arrFechaAux = fechaAux.split("-");
                                    defaultDia =arrFechaAux[0];
                                    defaultMes =arrFechaAux[1]-1;
                                    defaultGestion =arrFechaAux[2];
                                }
                            }
                            var arrHorariosRegistrados = [];
                            $("#calendar").html("");
                            var arrFechasPorSemana = iniciarCalendarioLaboralPorRelaboralTurnosAndExcepcionesParaVerAsignacionesPersonales(dataRecordMain,idRelaboral,5,idPerfilLaboral,tipoHorario,arrHorariosRegistrados,defaultGestion,defaultMes,defaultDia);
                            sumarTotalHorasPorSemana(arrFechasPorSemana);
                    })
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
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
<<<<<<< HEAD
                     datafield: 'estado_descripcion',
                     width: 130,
=======
                     datafield: 'controlexcepcion_estado_descripcion',
                     width: 90,
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                     cellsalign: 'center',
                     align: 'center',
                     hidden: false,
                     cellclassname: cellclass
                     },
                    {
<<<<<<< HEAD
                        text: 'Tipo Negocio',
                        filtertype: 'checkedlist',
                        datafield: 'tipo_negocio_descripcion',
=======
                        text: 'Tipo Excepci&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'tipo_excepcion',
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                        width: 100,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
                    },
                    {
<<<<<<< HEAD
                        text: 'Gesti&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'gestion',
                        width: 50,
                        cellsalign: 'center',
=======
                        text: 'Excepci&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'excepcion',
                        width: 200,
                        cellsalign: 'justify',
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                        align: 'center',
                        hidden: false
                    },
                    {
<<<<<<< HEAD
                        text: 'Mes',
                        filtertype: 'checkedlist',
                        datafield: 'mes_nombre',
=======
                        text: 'C&oacute;digo',
                        filtertype: 'checkedlist',
                        datafield: 'codigo',
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                        width: 120,
                        align: 'center',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
<<<<<<< HEAD
                        text: '#',
                        datafield: 'numero',
                        width: 30,
=======
                        text: 'Color',
                        datafield: 'color',
                        width: 80,
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false,
                        cellsrenderer: cellsrenderer

                    },
<<<<<<< HEAD
                    {
                        text: 'T&iacute;tulo',
                        datafield: 'titulo',
                        width: 100,
                        cellsalign: 'justify',
=======

                    {
                        text: 'Fecha Inicio',
                        datafield: 'fecha_ini',
                        filtertype: 'range',
                        width: 100,
                        cellsalign: 'center',
                        cellsformat: 'dd-MM-yyyy',
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                        align: 'center',
                        hidden: false
                    },
                    {
<<<<<<< HEAD
                        text: 'Resumen',
                        datafield: 'resumen',
                        width: 200,
                        cellsalign: 'justify',
=======
                        text: 'Hora Inicio',
                        filtertype: 'checkedlist',
                        datafield: 'hora_ini',
                        width: 100,
                        cellsalign: 'center',
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                        align: 'center',
                        hidden: false
                    },
                    {
<<<<<<< HEAD
                        text: 'Planteamiento',
                        datafield: 'descripcion',
                        width: 400,
                        cellsalign: 'justify',
=======
                        text: 'Fecha Fin',
                        datafield: 'fecha_fin',
                        filtertype: 'range',
                        width: 100,
                        cellsalign: 'center',
                        cellsformat: 'dd-MM-yyyy',
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                        align: 'center',
                        hidden: false
                    },
                    {
<<<<<<< HEAD
                        text: 'Puntuaci&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'puntuacion_a',
=======
                        text: 'Hora Fin',
                        filtertype: 'checkedlist',
                        datafield: 'hora_fin',
                        width: 100,
                        cellsalign: 'center',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Justificaci&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'justificacion',
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                        width: 100,
                        align: 'center',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
<<<<<<< HEAD
                        text: 'Puntuaci&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'puntuacion_a_descripcion',
=======
                        text: 'G&eacute;nero',
                        filtertype: 'checkedlist',
                        datafield: 'genero',
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                        width: 100,
                        align: 'center',
                        cellsalign: 'center',
                        hidden: false
                    },
<<<<<<< HEAD
                     {
                        text: 'Fecha Reg.',
                        filtertype: 'checkedlist',
                        datafield: 'fecha_reg',
=======
                    {
                        text: 'Frecuencia',
                        filtertype: 'checkedlist',
                        datafield: 'frecuencia_descripcion',
                        width: 80,
                        align: 'center',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
                        text: 'Compensar Horas',
                        filtertype: 'checkedlist',
                        datafield: 'compensatoria_descripcion',
                        width: 100,
                        align: 'center',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
                        text: 'Contr. Horario',
                        filtertype: 'checkedlist',
                        datafield: 'horario_descripcion',
                        width: 100,
                        align: 'center',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
                        text: 'Refrigerio',
                        filtertype: 'checkedlist',
                        datafield: 'refrigerio_descripcion',
                        width: 100,
                        align: 'center',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
                        text: 'Turno',
                        filtertype: 'checkedlist',
                        datafield: 'turno_descripcion',
                        width: 100,
                        align: 'center',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
                        text: 'E/S',
                        filtertype: 'checkedlist',
                        datafield: 'entrada_salida_descripcion',
                        width: 100,
                        align: 'center',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
                        text: 'Solicitante',
                        filtertype: 'checkedlist',
                        datafield: 'controlexcepcion_user_registrador',
                        width: 100,
                        align: 'center',
                        cellsalign: 'justify',
                        hidden: false
                    },
                    {
                        text: 'Fecha Sol.',
                        filtertype: 'checkedlist',
                        datafield: 'controlexcepcion_fecha_reg',
                        width: 100,
                        align: 'center',
                        cellsformat: 'dd-MM-yyyy',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
                        text: 'Verificador',
                        filtertype: 'checkedlist',
                        datafield: 'controlexcepcion_user_verificador',
                        width: 100,
                        align: 'center',
                        cellsalign: 'justify',
                        hidden: false
                    },
                    {
                        text: 'Fecha Ver.',
                        filtertype: 'checkedlist',
                        datafield: 'controlexcepcion_fecha_ver',
                        width: 100,
                        align: 'center',
                        cellsformat: 'dd-MM-yyyy',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
                        text: 'Aprobador',
                        filtertype: 'checkedlist',
                        datafield: 'controlexcepcion_user_aprobador',
                        width: 100,
                        align: 'center',
                        cellsalign: 'justify',
                        hidden: false
                    },
                    {
                        text: 'Fecha Apr.',
                        filtertype: 'checkedlist',
                        datafield: 'controlexcepcion_fecha_apr',
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                        width: 100,
                        align: 'center',
                        cellsformat: 'dd-MM-yyyy',
                        cellsalign: 'center',
                        hidden: false
                    },
                    {
                        text: 'Observaci&oacute;n',
<<<<<<< HEAD
                        datafield: 'observacion',
                        width: 100,
                        align: 'justify',
                        hidden: false
                    }
=======
                        filtertype: 'checkedlist',
                        datafield: 'controlexcepcion_observacion',
                        width: 100,
                        align: 'center',
                        hidden: false
                    },
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
                ]
            });
        /*var listSource = [
            *//*{label: 'Estado', value: 'estado_descripcion', checked: true},*//*
            {label: 'Tipo Excepci&oacute;n', value: 'tipo_excepcion', checked: true},
            {label: 'Excepci&oacute;n', value: 'excepcion', checked: true},
            {label: 'C&oacute;digo', value: 'codigo', checked: true},
            {label: 'Color', value: 'color', checked: true},
            {label: 'G&eacute;nero', value: 'genero', checked: true},
            {label: 'Frecuencia', value: 'frecuencia_descripcion', checked: true},
            {label: 'Compensar Horas', value: 'compensatoria_descripcion', checked: true},
            {label: 'Observaci&oacute;n', value: 'observacion', checked: true}
        ];
        $("#listBoxExcepciones").jqxListBox({source: listSource, width: "100%", height: 430, checkboxes: true});
        $("#listBoxExcepciones").on('checkChange', function (event) {
            $("#divGridExcepciones").jqxGrid('beginupdate');
            if (event.args.checked) {
                $("#divGridExcepciones").jqxGrid('showcolumn', event.args.value);
            }
            else {
                $("#divGridExcepciones").jqxGrid('hidecolumn', event.args.value);
            }
            $("#divGridExcepciones").jqxGrid('endupdate');
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
