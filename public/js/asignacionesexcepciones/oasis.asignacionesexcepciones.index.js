/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  21-10-2014
 */
$().ready(function () {
    /**
     * Inicialmente se habilita solo la pestaña del listado
     */
    $('#tabAsignacionesExcepciones').jqxTabs('theme', 'oasis');
    $('#tabAsignacionesExcepciones').jqxTabs('enableAt', 1);
    $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 1);
    $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 2);
    $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 3);
    $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 4);
    $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 5);

    definirGrillaParaListaRelaborales();
    habilitarCamposParaNuevoRegistroDeRelacionLaboral();
    $("#btnGuardarNuevo").click(function () {
        var ok = validaFormularioPorNuevoRegistro();
        if (ok) {
            guardarNuevoRegistro();
        }
    });
    $("#btnGuardarEditar").click(function () {
        var ok = validaFormularioPorEditarRegistro();
        if (ok) {
            guardarRegistroEditado();
        }
    });
    $("#btnGuardarBaja").click(function () {
        var ok = validaFormularioPorBajaRegistro();
        if (ok) {
            guardarRegistroBaja();
        }
    });
    /**
     * Control sobre la solicitud de guardar registro de movilidad de personal por nuevo, edición y baja.
     */
    $("#btnGuardarMovilidad").click(function () {
        var idRelaboralMovilidadBaja = $("#hdnIdRelaboralMovilidadBaja").val();
        if (idRelaboralMovilidadBaja == 0) {
            /**
             * Si se solicita nuevo registro o modificación.
             * @type {boolean}
             */
            var ok = validaFormularioPorRegistroMovilidad();
            if (ok) {
                var okk = guardarRegistroMovilidad();
                if (okk) {
                    $("#popupWindowNuevaMovilidad").jqxWindow('close');
                }
            }
        } else {
            /**
             * Si se ha solicitado realizar una baja.
             */
            var ok = validaFormularioPorBajaRegistroMovilidad();
            if (ok) {
                var okk = bajaRegistroMovilidad();
                if (okk) {
                    $("#popupWindowNuevaMovilidad").jqxWindow('close');
                }
            }
        }
    });
    $("#btnCancelarNuevo").click(function () {
        $('#tabAsignacionesExcepciones').jqxTabs('enableAt', 0);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 1);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 2);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 3);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 4);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 5);
        $("#msjs-alert").hide();
        deshabilitarCamposParaNuevoRegistroDeRelacionLaboral();
    });
    $("#btnCancelarEditar").click(function () {
        $('#tabAsignacionesExcepciones').jqxTabs('enableAt', 0);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 1);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 2);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 3);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 4);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 5);
        $("#msjs-alert").hide();
        deshabilitarCamposParaEditarRegistroDeRelacionLaboral();
    });
    $("#btnCancelarBaja").click(function () {
        $('#tabAsignacionesExcepciones').jqxTabs('enableAt', 0);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 1);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 2);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 3);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 4);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 5);
        $("#msjs-alert").hide();
        deshabilitarCamposParaBajaRegistroDeRelacionLaboral();
    });
    $("#btnCancelarVista").click(function () {
        $('#tabAsignacionesExcepciones').jqxTabs('enableAt', 0);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 1);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 2);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 3);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 4);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 5);
        $("#msjs-alert").hide();
    });
    $("#btnVolverDesdeMovilidad").click(function (){
        $('#tabAsignacionesExcepciones').jqxTabs('enableAt', 0);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 1);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 2);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 3);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 4);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 5);
        $("#msjs-alert").hide();
    });
    $("#btnVolverDesdeBaja").click(function (){
        $('#tabAsignacionesExcepciones').jqxTabs('enableAt', 0);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 1);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 2);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 3);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 4);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 5);
        $("#msjs-alert").hide();
    });
    $("#btnCancelarMovilidad").click(function () {
        /**
         * Inicialmente es necesario eliminar los eventos sobre este elemento para que no se repitan
         */
        $("#lstTipoMemorandum").off();
    });
    $("#btnBuscarCargo").off();
    $("#btnBuscarCargo").on("click",function () {
        $("#divGrillaParaSeleccionarCargo").jqxGrid("clear");
        $('#popupGrillaCargo').modal('show');
        definirGrillaParaSeleccionarCargoAcefalo(0, '');
    });
    $("#btnBuscarCargoEditar").off();
    $("#btnBuscarCargoEditar").on("click",function () {
        $("#divGrillaParaSeleccionarCargo").jqxGrid("clear");
        $('#popupGrillaCargo').modal('show');
        definirGrillaParaSeleccionarCargoAcefaloParaEditar(0, '');
    });
    $('#popupGrillaCargo').on('show', function () {
        $(this).find('.modal-body').css({
            width:'auto', //probably not needed
            height:'auto', //probably not needed
            'max-height':'100%'
        });
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
    $("#btnImprimirHistorial").on("click",function(){
        var opciones = {mode:"popup",popClose: false};
        $("#HistorialSplitter").printArea(opciones);
    });
    /**
     * Control sobre el cambio en el listado de motivos de baja
     */
    $("#lstMotivosBajas").change(function () {
        var res = this.value.split("_");
        $("#hdnFechaRenBaja").val(res[0]);
        $("#hdnFechaAceptaRenBaja").val(res[1]);
        $("#hdnFechaAgraServBaja").val(res[2]);
        if (res[0] > 0)defineFechasBajas(res[1], res[2], res[3]);
        else $("#divFechasBaja").hide();
    });
    /**
     * Control sobre el uso o no de a.i. en el cargo para movilidad de personal.
     */
    $("#chkAi").on("click", function () {
        var cargo = $("#txtCargoMovilidad").val();
        var sw = 0;
        if (jQuery.type(cargo) == "object") {
            cargo = String(cargo.label);
        }
        cargo = cargo + '';
        if (cargo != null && cargo != '') {
            if (this.checked == true) {
                var n = cargo.indexOf("a.i.");
                if (n < 0) {
                    cargo = cargo + " a.i.";
                    $('#txtCargoMovilidad').val(cargo);
                    //$('#txtCargoMovilidad').jqxInput('val', {label: cargo, value: cargo});
                }
            } else {
                var n = cargo.indexOf("a.i.");
                if (n > 0) {
                    cargo = cargo.replace("a.i.", "").trim();
                    $('#txtCargoMovilidad').val(cargo);
                    //$('#txtCargoMovilidad').jqxInput('val', {label: cargo, value: cargo});
                }
            }
        }
    });

    $("#liList").click(function () {
        $("#btnCancelarNuevo").click();
        $("#btnCancelarEditar").click();
        $("#btnCancelarBaja").click();
    });
    $("#popupWindowNuevaMovilidad").jqxWindow({
        position: {x: 300, y: 200},
        height: 700,
        width: '100%',
        resizable: true,
        isModal: true,
        autoOpen: false,
        cancelButton: $("#btnCancelarMovilidad"),
        modalOpacity: 0.01
    });
    $('#btnDesfiltrartodo').click(function () {
        $("#jqxgrid").jqxGrid('clearfilters');
    });
    $('#btnDesfiltrarTodoMovilidad').click(function () {
        $("#jqxgridmovilidad").jqxGrid('clearfilters');
    });
    $('#btnDesagrupartodo').click(function () {
        $('#jqxgrid').jqxGrid('cleargroups');
    });
    $('#btnDesagruparTodoMovilidad').click(function () {
        $('#jqxgridmovilidad').jqxGrid('cleargroups');
    });
    /**
     * Definición de la ventana donde se ve el historial de registros de relación laboral
     */
    $('#HistorialSplitter').jqxSplitter({
        theme: 'oasis',
        width: '100%',
        height: 480,
        panels: [{size: '8%'}, {size: '92%'}]
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
    $("#txtMotivoMovilidad").jqxInput({
        width: 300,
        height: 35,
        placeHolder: "Introduzca el motivo de la comisión."
    });
    $("#txtLugarMovilidad").jqxInput({
        width: 300,
        height: 35,
        placeHolder: "Introduzca el lugar donde se realizará el evento."
    });
    $(document).keypress(OperaEvento);
    $(document).keyup(OperaEvento);
});
/**
 * Función para definir la grilla principal (listado) para la gestión de relaciones laborales.
 */
function definirGrillaParaListaRelaborales() {
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
            {name: 'finpartida', type: 'string'},
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
            {name: 'relaboral_previo_id', type: 'integer'},
            {name: 'observacion', type: 'string'},
            {name: 'fecha_ing', type: 'date'}
        ],
        url: '/relaborales/list',
        cache: false
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    cargarRegistrosDeRelacionesLaborales();
    function cargarRegistrosDeRelacionesLaborales() {
        var theme = prepareSimulator("grid");
        $("#jqxgrid").jqxGrid(
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
                    container.append("<button id='viewrowbutton' class='btn btn-sm btn-primary' type='button'><i class='gi gi-nameplate_alt fa-2x text-info' title='Vista Historial.'/></i></button>");

                    $("#addrowbutton").jqxButton();
                    $("#viewrowbutton").jqxButton();

                    /* Registrar nueva relación laboral.*/
                    $("#addrowbutton").on('click', function () {
                        var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#jqxgrid').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                /**
                                 * Para el caso cuando la persona no tenga ninguna relación laboral vigente con la entidad se da la opción de registro de nueva relación laboral.
                                 */
                                if (dataRecord.tiene_contrato_vigente == 0 || dataRecord.tiene_contrato_vigente == -1) {
                                    $('#tabAsignacionesExcepciones').jqxTabs('enableAt', 1);
                                    $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 2);
                                    $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 3);
                                    $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 4);
                                    $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 5);
                                    /**
                                     * Trasladamos el item seleccionado al que corresponde, el de nuevo registro.
                                     */
                                    $('#tabAsignacionesExcepciones').jqxTabs({selectedItem: 1});

                                    $('#btnBuscarCargo').click();

                                    $("#hdnIdRelaboralEditar").val(dataRecord.id_relaboral);
                                    $("#hdnIdPersonaSeleccionada").val(dataRecord.id_persona);
                                    $("#NombreParaNuevoRegistro").html(dataRecord.nombres);
                                    $("#CorreoPersonal").html("");
                                    $("#hdnIdCondicionNuevaSeleccionada").val(0)
                                    $("#divAreas").hide();
                                    $("#divItems").hide();
                                    $("#divFechasFin").hide();
                                    $("#divNumContratos").hide();
                                    $(".msjs-alert").hide();
                                    $("#divProcesos").hide();
                                    limpiarMensajesErrorPorValidacionNuevoRegistro();
                                    var rutaImagen = obtenerRutaFoto(dataRecord.ci, dataRecord.num_complemento);
                                    $("#imgFotoPerfilNuevo").attr("src", rutaImagen);
                                } else {
                                    var msje = "La persona seleccionada tiene actualmente un registro en estado " + dataRecord.estado_descripcion + " de relaci&oacute;n laboral por lo que no se le puede asignar otro.";
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
                    $("#viewrowbutton").on('click', function () {

                        var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var dataRecord = $('#jqxgrid').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                var id_relaboral = dataRecord.id_relaboral;
                                /*
                                 *  La vista del historial se habilita para personas que tengan al menos un registro de relación sin importar su estado, ACTIVO, EN PROCESO o PASIVO.
                                 *  De esta vista se excluyen a personas que no tengan ningún registro de relación laboral.
                                 */
                                $(".msjs-alert").hide();
                                $("#hdnIdPersonaHistorial").val(dataRecord.id_persona);
                                if (dataRecord.tiene_contrato_vigente >= 0) {
                                    $('#tabAsignacionesExcepciones').jqxTabs('enableAt', 0);
                                    $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 1);
                                    $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 2);
                                    $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 3);
                                    $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 4);
                                    $('#tabAsignacionesExcepciones').jqxTabs('enableAt', 5);
                                    /**
                                     * Trasladamos el item seleccionado al que corresponde, el de vistas.
                                     */
                                    $('#tabAsignacionesExcepciones').jqxTabs({selectedItem: 5});
                                    // Create jqxTabs.
                                    $('#tabFichaPersonal').jqxTabs({
                                        theme: 'oasis',
                                        width: '100%',
                                        height: '100%',
                                        position: 'top'
                                    });
                                    $('#tabFichaPersonal').jqxTabs({selectedItem: 0});
                                    $("#ddNombres").html(dataRecord.nombres);
                                    var rutaImagen = obtenerRutaFoto(dataRecord.ci, dataRecord.num_complemento);
                                    $("#imgFotoPerfilContactoPer").attr("src", rutaImagen);
                                    $("#imgFotoPerfilContactoInst").attr("src", rutaImagen);
                                    $("#imgFotoPerfil").attr("src", rutaImagen);
                                    cargarPersonasContactos(dataRecord.id_persona);
                                    $("#hdnIdRelaboralVista").val(id_relaboral);
                                    $("#hdnSwPrimeraVistaHistorial").val(0);
                                    cargarGestionesHistorialRelaboral(dataRecord.id_persona);
                                    /**
                                     * Para la primera cargada el valor para el parámetro gestión es 0 debido a que mostrará el historial completo.
                                     * Para el valor del parámetro sw el valor es 1 porque se desea que se limpie lo que haya y se cargue algo nuevo
                                     */
                                    cargarHistorialRelacionLaboral(dataRecord.id_persona, 0, 1);
                                    $("#divContent_" + dataRecord.id_relaboral).focus().select();
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
                        text: '',
                        datafield: 'nuevo',
                        width: 10,
                        sortable: false,
                        showfilterrow: false,
                        filterable: false,
                        columntype: 'number',
                        cellsrenderer: function (rowline) {
                            ctrlrow = rowline
                            var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', ctrlrow);
                            var sw = dataRecord.tiene_contrato_vigente;
                            if (sw == 0 || sw == -1) {
                                return "<div style='width: 100%' align='center'><a href='#'><i class='fa fa-plus-square fa-2x text-info' title='Nuevo Registro.'/></i></div>";
                            }
                            else return "";
                        },
                        hidden: true //Se oculta esta columna con el boton nuevo dejándolo disponible en caso de requerirse
                    },
                    {
                        text: '',
                        datafield: 'aprobar',
                        width: 10,
                        sortable: false,
                        showfilterrow: false,
                        filterable: false,
                        columntype: 'number',
                        cellsrenderer: function (rowline) {
                            ctrlrow = rowline
                            var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', ctrlrow);
                            var estado = dataRecord.estado;
                            if (dataRecord.estado == 2) {
                                return "<div style='width: 100%' align='center'><a href='#'><i class='fa fa-check-square fa-2x text-info' title='Aprobar registro'></i></a></div>";
                            }
                            else return "";
                        },
                        hidden: true //Se oculta esta columna con el boton aprobar dejándolo disponible en caso de requerirse
                    },
                    {
                        text: '',
                        datafield: 'editar',
                        width: 10,
                        sortable: false,
                        showfilterrow: false,
                        filterable: false,
                        columntype: 'number',
                        cellsrenderer: function (rowline) {
                            ctrlrow = rowline
                            var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', ctrlrow);
                            var estado = dataRecord.estado;
                            if (estado == 2) {
                                return "<div style='width: 100%' align='center'><a href='#'><i class='fa fa-pencil-square fa-2x text-info' title='Modificar registro.'/></a></div>";
                            }
                            else return "";
                        },
                        hidden: true //Se oculta esta columna con el boton editar dejándolo disponible en caso de requerirse
                    },
                    {
                        text: '',
                        datafield: 'eliminar',
                        width: 10,
                        sortable: false,
                        showfilterrow: false,
                        filterable: false,
                        columntype: 'number',
                        cellsrenderer: function (rowline) {
                            ctrlrow = rowline
                            var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', ctrlrow);
                            var estado = dataRecord.estado;
                            if (estado == 1) {
                                //return "<div style='width: 100%'><a href='#'><img src='/images/del.png' style='margin-left: 25%' title='Dar de baja al registro.'/></a></div>";
                                return "<div style='width: 100%' align='center'><a href='#'><i class='fa fa-minus-square fa-2x text-info' title='Dar de baja al registro.'/></i></div>";
                            }
                            else return "";
                        },
                        hidden: true //Se oculta esta columna con el boton baja dejándolo disponible en caso de requerirse
                    },
                    {
                        text: '',
                        datafield: 'mover',
                        width: 10,
                        sortable: false,
                        showfilterrow: false,
                        filterable: false,
                        columntype: 'number',
                        cellsrenderer: function (rowline) {
                            ctrlrow = rowline
                            var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', ctrlrow);
                            var sw = dataRecord.tiene_contrato_vigente;
                            if (sw >= 0) {
                                return "<div style='width: 100%' align='center'><a href='#'><i class='fa fa-tag fa-2x text-info' title='Movilidad de Personal.'/></i></div>";
                            }
                            else return "";
                        },
                        hidden: true //Se oculta esta columna con el boton vista dejándolo disponible en caso de requerirse
                    },
                    {
                        text: '',
                        datafield: 'ver',
                        width: 10,
                        sortable: false,
                        showfilterrow: false,
                        filterable: false,
                        columntype: 'number',
                        cellsrenderer: function (rowline) {
                            ctrlrow = rowline
                            var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', ctrlrow);
                            var sw = dataRecord.tiene_contrato_vigente;
                            if (sw >= 0) {
                                return "<div style='width: 100%' align='center'><a href='#'><i class='fa fa-search fa-2x text-info' title='Vista Historial.'/></i></div>";
                            }
                            else return "";
                        },
                        hidden: true //Se oculta esta columna con el boton vista dejándolo disponible en caso de requerirse
                    },
                    {
                        text: 'Ubicaci&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'ubicacion',
                        width: 150,
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
                        text: 'Fecha Ingreso',
                        datafield: 'fecha_ing',
                        filtertype: 'range',
                        width: 100,
                        cellsalign: 'center',
                        cellsformat: 'dd-MM-yyyy',
                        align: 'center',
                        hidden: false
                    },
                    {
                        text: 'Fecha Inicio',
                        datafield: 'fecha_ini',
                        filtertype: 'range',
                        width: 100,
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
            {label: 'Ubicaci&oacute;n', value: 'ubicacion', checked: true},
            {label: 'Condici&oacute;n', value: 'condicion', checked: true},
            {label: 'Estado', value: 'estado_descripcion', checked: true},
            {label: 'Nombres y Apellidos', value: 'nombres', checked: true},
            {label: 'CI', value: 'ci', checked: true},
            {label: 'Exp', value: 'expd', checked: true},
            /*{label: 'N/C', value: 'num_complemento', checked: false},*/
            {label: 'Gerencia', value: 'gerencia_administrativa', checked: true},
            {label: 'Departamento', value: 'departamento_administrativo', checked: true},
            {label: '&Aacute;rea', value: 'area', checked: true},
            {label: 'proceso', value: 'proceso_codigo', checked: true},
            {label: 'Fuente', value: 'fin_partida', checked: true},
            {label: 'Nivel Salarial', value: 'nivelsalarial', checked: true},
            {label: 'Cargo', value: 'cargo', checked: true},
            {label: 'Haber', value: 'sueldo', checked: true},
            {label: 'Fecha Ingreso', value: 'fecha_ing', checked: true},
            {label: 'Fecha Inicio', value: 'fecha_ini', checked: true},
            {label: 'Fecha Incor.', value: 'fecha_incor', checked: true},
            {label: 'Fecha Fin', value: 'fecha_fin', checked: true},
            {label: 'Fecha Baja', value: 'fecha_baja', checked: true},
            {label: 'Motivo Baja', value: 'motivo_baja', checked: true},
            {label: 'Observacion', value: 'observacion', checked: true},
        ];
        $("#jqxlistbox").jqxListBox({source: listSource, width: "100%", height: 430, checkboxes: true});
        $("#jqxlistbox").on('checkChange', function (event) {
            $("#jqxgrid").jqxGrid('beginupdate');
            if (event.args.checked) {
                $("#jqxgrid").jqxGrid('showcolumn', event.args.value);
            }
            else {
                $("#jqxgrid").jqxGrid('hidecolumn', event.args.value);
            }
            $("#jqxgrid").jqxGrid('endupdate');
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
        $('#tabAsignacionesExcepciones').jqxTabs('enableAt', 0);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 1);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 2);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 3);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 4);
        $('#tabAsignacionesExcepciones').jqxTabs('disableAt', 5);
        /**
         * Saltamos a la pantalla principal en caso de presionarse ESC
         */
        $('#tabAsignacionesExcepciones').jqxTabs({selectedItem: 0});

        $("#popupWindowCargo").jqxWindow('close');
        $("#popupWindowNuevaMovilidad").jqxWindow('close');
        $("#lstTipoMemorandum").off();
        $('#jqxgrid').jqxGrid('focus');
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
 *
 * Función para la obtención de la ruta en la cual reside la fotografía correspondiente de la persona.
 * @param numDocumento Número de documento, comunmente el número de CI.
 * @param numComplemento Número de complemento.
 * @returns {string} Ruta de ubicación de la fotografía a mostrarse.
 */
function obtenerRutaFoto(numDocumento, numComplemento) {
    var resultado = "/images/perfil-profesional.jpg";
    if (numDocumento != "") {
        $.ajax({
            url: '/relaborales/obtenerrutafoto/',
            type: "POST",
            datatype: 'json',
            async: false,
            cache: false,
            data: {ci: numDocumento, num_complemento: numComplemento},
            success: function (data) {
                var res = jQuery.parseJSON(data);
                if (res.result == 1) {
                    resultado = res.ruta;
                }
            }, //mostramos el error
            error: function () {
                alert('Se ha producido un error Inesperado');
            }
        });
    }
    return resultado;
}
/**
 * Función para obtener la fecha de este día
 * @param separador
 * @returns {*}
 * @author JLM
 */
function fechaHoy(separador, format) {
    if (separador == '')separador = "-";
    var fullDate = new Date()
    var dia = fullDate.getDate().toString();
    var mes = (fullDate.getMonth() + 1).toString();
    var twoDigitDay = (dia.length === 1 ) ? '0' + dia : dia;
    var twoDigitMonth = (mes.length === 1 ) ? '0' + mes : mes;
    if (format == "dd-mm-yyyy")
        var currentDate = twoDigitDay + separador + twoDigitMonth + separador + fullDate.getFullYear();
    else if (format == "mm-dd-yyyy") {
        var currentDate = twoDigitMonth + separador + twoDigitDay + separador + fullDate.getFullYear();
    } else {
        var currentDate = fullDate;
    }
    return currentDate;
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
