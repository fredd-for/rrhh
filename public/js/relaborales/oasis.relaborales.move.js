/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  17-11-2014
 */
function cargarGrillaMovilidad(idRelaboral){
    var source =
    {
        datatype: "json",
        datafields: [
            { name: 'nro_row', type: 'integer' },
            { name: 'id_relaboral', type: 'integer' },
            { name: 'id_relaboralmovilidad', type: 'integer' },
            { name: 'id_gerencia_administrativa', type: 'integer' },
            { name: 'gerencia_administrativa', type: 'string' },
            { name: 'id_departamento_administrativo', type: 'integer' },
            { name: 'departamento_administrativo', type: 'string' },
            { name: 'id_organigrama', type: 'integer' },
            { name: 'unidad_administrativa', type: 'string' },
            { name: 'id_area', type: 'integer' },
            { name: 'area', type: 'string' },
            { name: 'id_ubicacion', type: 'integer' },
            { name: 'ubicacion', type: 'string' },
            { name: 'numero', type: 'integer' },
            { name: 'cargo', type: 'string' },
            { name: 'fecha_ini', type: 'date' },
            { name: 'fecha_fin', type: 'date' },
            { name: 'tipo_memorandum', type: 'string' },
            { name: 'memorandum_correlativo', type: 'string' },
            { name: 'memorandum_gestion', type: 'integer' },
            { name: 'memorandum', type: 'integer' },
            { name: 'fecha_mem', type: 'date' },
            { name: 'observacion', type: 'string' },
            { name: 'estado', type: 'integer' },

        ],
        url: '/relaborales/listhistorialmovilidad?id='+idRelaboral,
        id: 'id_relaboralmovilidad',
        cache: false
    };
    //var dataAdapter = new $.jqx.dataAdapter(source);
    /*var source =
    {
        source: dataAdapter,
        updaterow: function (rowid, rowdata, commit) {
            // synchronize with the server - send update command
            // call commit with parameter true if the synchronization with the server is successful
            // and with parameter false if the synchronization failder.
            commit(true);
        },
        datafields:
            [
                { name: 'Gerencia', type: 'string' },
                { name: 'Departamento', type: 'string' },
                { name: 'Area', type: 'string' },
                { name: 'Ubicacion', type: 'string' },
                { name: 'Cargo', type: 'string' },
                { name: 'Fecha Ini', type: 'date' },
                { name: 'Fecha Fin', type: 'date' },
                { name: 'Memorandum', type: 'string' },
                { name: 'Fecha Mem.', type: 'date' },
                { name: 'Observacion', type: 'string' }
            ]
    };*/
    var dataAdapter = new $.jqx.dataAdapter(source);
    cargarRegistrosDeMovilidadDePersonal();
    function cargarRegistrosDeMovilidadDePersonal() {
        var theme = prepareSimulator("grid");
        $("#jqxgridmovilidad").jqxGrid(
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
                /*ready: function(){
                    //$("#jqxgridmovilidad").jqxGrid('localizestrings', localizationobj);
                },*/
                rendertoolbar: function (toolbar) {
                    var me = this;
                    var container = $("<div></div>");
                    toolbar.append(container);
                    container.append("<button id='addrowbuttonmove' class='btn btn-sm btn-primary' type='button'><i class='fa fa-plus-square fa-2x text-info' title='Nuevo Registro.'/></i></button>");

                    /*container.append("<button id='updaterowbutton'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-pencil-square fa-2x text-info' title='Modificar registro.'/></button>");
                    container.append("<button id='deleterowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-minus-square fa-2x text-info' title='Dar de baja al registro.'/></i></button>");
                    container.append("<button id='moverowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-tag fa-2x text-info' title='Movilidad de Personal.'/></i></button>");
                    container.append("<button id='viewrowbutton' class='btn btn-sm btn-primary' type='button'><i class='gi gi-nameplate_alt fa-2x text-info' title='Vista Historial.'/></i></button>");*/

                    $("#addrowbuttonmove").jqxButton();
                    //$("#approverowbutton").jqxButton();
                    /*$("#updaterowbutton").jqxButton();
                    $("#deleterowbutton").jqxButton();
                    $("#moverowbutton").jqxButton();
                    $("#viewrowbutton").jqxButton();*/


                    // Registrar nueva relación laboral.
                    $("#addrowbuttonmove").on('click', function () {
                        $("#hdnIdRelaboralNuevaMovilidad").val(idRelaboral);
                        limpiarMensajesErrorPorValidacionMovilidad();
                        $("#divTitleRegistroMovilidad").html("");
                        $("#divTitleRegistroMovilidad").append("Nuevo Registro de Movilidad de Personal");
                        cargarTiposMemorandumsParaMovilidad(0);
                        cargarGestionesMemorandumsParaMovilidad(0);
                        cargarUnidadesOrganizacionalesParaMovilidad(0,0,0);
                        cargarUbicacionesParaMovilidad(0);
                        cargarCargosParaMovilidad('');
                        $("#lstTipoMemorandum").focus();
                        $("#lstTipoMemorandum").change(function(){
                            $("#txtCorrelativoMemorandum").focus();
                            var itemTipoMemorandum = $("#lstTipoMemorandum").jqxComboBox('getSelectedItem');
                            if(itemTipoMemorandum!=null){
                                var idff = $("#lstTipoMemorandum").val();
                                var arr = idff.split("-");
                                var ff = arr[1];
                                /*
                                Se evalua si el tipo de memorándum establece el requerimiento de la fecha de finalización.
                                 */
                                if(ff==1){
                                    $("#divFechasFinMovilidad").show();
                                    $("#divHorasFinMovilidad").show();
                                }else{
                                    $("#divFechasFinMovilidad").hide();
                                    $("#divHorasFinMovilidad").hide();
                                }
                            }
                        });
                        $("#lstUbicaciones").change(function(){
                            $("#txtCargoMemorandum").focus();
                        });
                        $("#txtFechaMem").jqxDateTimeInput({ enableBrowserBoundsDetection: false, height: 24, formatString:'dd-MM-yyyy' });
                        var fechaActual= $('#txtFechaMem').jqxDateTimeInput('getDate');
                        $('#txtFechaMem').jqxDateTimeInput('setMaxDate', fechaActual);
                        /*
                            Se establece como fecha mínima debido a que al inicio de operaciones de la empresa
                         */
                        $('#txtFechaMem').jqxDateTimeInput('setMinDate', new Date(2014, 3, 1));

                        $("#txtFechaIniMovilidad").jqxDateTimeInput({ enableBrowserBoundsDetection: false, height: 24, formatString:'dd-MM-yyyy' });
                        $("#txtFechaFinMovilidad").jqxDateTimeInput({ enableBrowserBoundsDetection: false, height: 24, formatString:'dd-MM-yyyy' });
                        $("#divFechasFinMovilidad").hide();
                        $("#divHorasFinMovilidad").hide();
                        $("#txtHoraIniMovilidad").val("");
                        $("#txtHoraFinMovilidad").val("");
                        $("#txtObservacionMovilidad").jqxInput({ width: 300, height: 35, placeHolder: "Introduzca sus observaciones"});
                        $("#popupWindowNuevaMovilidad").jqxWindow('open');
                    });

                    // Modificar registro.
                    $("#updaterowbutton").on('click', function () {
                        var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                        if(selectedrowindex>=0){
                            var dataRecord = $('#jqxgrid').jqxGrid('getrowdata', selectedrowindex);
                            if(dataRecord!=undefined) {
                                var id_relaboral = dataRecord.id_relaboral;
                                /**
                                 * Para el caso cuando la persona tenga un registro de relación laboral en estado EN PROCESO o ACTIVO.
                                 */
                                if (dataRecord.estado >= 1) {
                                    $('#jqxTabs').jqxTabs('enableAt', 0);
                                    $('#jqxTabs').jqxTabs('disableAt', 1);
                                    $('#jqxTabs').jqxTabs('enableAt', 2);
                                    $('#jqxTabs').jqxTabs('disableAt', 3);
                                    $('#jqxTabs').jqxTabs('disableAt', 4);
                                    $('#jqxTabs').jqxTabs('disableAt', 5);
                                    /**
                                     * Trasladamos el item seleccionado al que corresponde, el de modificación
                                     */
                                    $('#jqxTabs').jqxTabs({ selectedItem: 2 });

                                    $("#hdnIdRelaboralEditar").val(id_relaboral);
                                    $("#hdnIdPersonaSeleccionadaEditar").val(dataRecord.id_persona);
                                    $("#NombreParaEditarRegistro").html(dataRecord.nombres);
                                    $("#hdnIdCondicionEditableSeleccionada").val(dataRecord.id_condicion);
                                    $("#hdnIdUbicacionEditar").val(dataRecord.id_ubicacion);
                                    $("#hdnIdProcesoEditar").val(dataRecord.id_procesocontratacion);
                                    $("#FechaIniEditar").jqxDateTimeInput({ value:dataRecord.fecha_ini,enableBrowserBoundsDetection: false, height: 24, formatString:'dd-MM-yyyy' });
                                    $("#FechaIncorEditar").jqxDateTimeInput({ value:dataRecord.fecha_incor,enableBrowserBoundsDetection: false, height: 24, formatString:'dd-MM-yyyy' });
                                    switch (dataRecord.condicion){
                                        case 'PERMANENTE':$("#divFechasFinEditar").hide();break;
                                        case 'EVENTUAL':
                                        case 'CONSULTOR':
                                            $("#FechaFinEditar").jqxDateTimeInput({ value:dataRecord.fecha_fin,enableBrowserBoundsDetection: false, height: 24, formatString:'dd-MM-yyyy' });
                                            break;
                                    }
                                    $("#hdnFechaFinEditar").val(dataRecord.fecha_fin);
                                    $("#txtNumContratoEditar").val(dataRecord.num_contrato);
                                    $("#divItemsEditar").hide();
                                    $("#divNumContratosEditar").hide();
                                    $(".msjs-alert").hide();
                                    $("#helpErrorUbicacionesEditar").html("");
                                    $("#helpErrorProcesosEditar").html("");
                                    $("#helpErrorCategoriasEditar").html("");
                                    $("#helpErrorFechasIniEditar").html("");
                                    $("#helpErrorFechasIncorEditar").html("");
                                    $("#helpErrorFechasFinEditar").html("");
                                    $("#divUbicacionesEditar").removeClass("has-error");
                                    $("#divProcesosEditar").removeClass("has-error");
                                    $("#divCategoriasEditar").removeClass("has-error");
                                    $("#divAreas").hide();
                                    $("#divFechasIniEditar").removeClass("has-error");
                                    $("#divFechasIncorEditar").removeClass("has-error");
                                    $("#divFechasFinEditar").removeClass("has-error");
                                    $("#tr_cargo_seleccionado_editar").html("");
                                    if(dataRecord.observacion!=null)$("#txtObservacionEditar").text(dataRecord.observacion);
                                    else $("#txtObservacionEditar").text('');
                                    var rutaImagen = obtenerRutaFoto(dataRecord.ci,dataRecord.num_complemento);
                                    $("#imgFotoPerfilEditar").attr("src",rutaImagen);
                                    cargarProcesosParaEditar(dataRecord.id_condicion,dataRecord.id_procesocontratacion);
                                    var idUbicacionPrederminada = 0;
                                    if(dataRecord.id_ubicacion==null||dataRecord.id_ubicacion=='')idUbicacionPrederminada=dataRecord.id_ubicacion;
                                    cargarUbicacionesParaEditar(idUbicacionPrederminada);
                                    agregarCargoSeleccionadoEnGrillaParaEditar(dataRecord.id_cargo,dataRecord.cargo_codigo,dataRecord.id_finpartida,dataRecord.finpartida,dataRecord.id_condicion,dataRecord.condicion,dataRecord.id_organigrama,dataRecord.gerencia_administrativa,dataRecord.departamento_administrativo,dataRecord.id_area,dataRecord.nivelsalarial,dataRecord.cargo,dataRecord.sueldo);
                                }else {
                                    alert("Debe seleccionar un registro con estado EN PROCESO o ACTIVO para posibilitar la modificaci&oacute;n del registro");
                                }
                            }
                        }else {
                            alert("Debe seleccionar un registro necesariamente.")
                        }
                    });
                    // Dar de baja un registro.
                    $("#deleterowbutton").on('click', function () {
                        var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                        if(selectedrowindex>=0) {
                            var dataRecord = $('#jqxgrid').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                var id_relaboral = dataRecord.id_relaboral;
                                /*
                                 *  Para dar de baja un registro, este debe estar inicialmente en estado ACTIVO
                                 */
                                if (dataRecord.estado == 1) {
                                    $('#jqxTabs').jqxTabs('enableAt', 0);
                                    $('#jqxTabs').jqxTabs('disableAt', 1);
                                    $('#jqxTabs').jqxTabs('disableAt', 2);
                                    $('#jqxTabs').jqxTabs('enableAt', 3);
                                    $('#jqxTabs').jqxTabs('disableAt', 4);
                                    $('#jqxTabs').jqxTabs('disableAt', 5);
                                    /**
                                     * Trasladamos el item seleccionado al que corresponde, el de bajas.
                                     */
                                    $('#jqxTabs').jqxTabs({ selectedItem: 3 });

                                    //alert(dataRecord.fecha_incor.toString());
                                    $("#hdnIdRelaboralBaja").val(id_relaboral);
                                    $("#NombreParaBajaRegistro").html(dataRecord.nombres);
                                    $("#hdnIdCondicionSeleccionadaBaja").val(dataRecord.id_condicion);
                                    $("#txtFechaIniBaja").jqxDateTimeInput({ disabled: true,value:dataRecord.fecha_ini,enableBrowserBoundsDetection: true, height: 24, formatString:'dd-MM-yyyy' });
                                    $("#txtFechaIncorBaja").jqxDateTimeInput({ disabled: true,value:dataRecord.fecha_incor,enableBrowserBoundsDetection: true, height: 24, formatString:'dd-MM-yyyy' });
                                    $("#txtFechaFinBaja").jqxDateTimeInput({ disabled: true,value:dataRecord.fecha_fin,enableBrowserBoundsDetection: true, height: 24, formatString:'dd-MM-yyyy' });
                                    $(".msjs-alert").hide();
                                    $("#divFechasRenBaja").hide();
                                    $("#divFechasAceptaRenBaja").hide();
                                    $("#divFechasAgraServBaja").hide();
                                    $("#txtObservacionBaja").val(dataRecord.observacion);
                                    $("#divMsjeError").hide();
                                    $("#tr_cargo_seleccionado_baja").html("");
                                    $("#lstMotivosBajas").focus();
                                    $("#hdnFechaRenBaja").val(0);
                                    $("#hdnFechaAceptaRenBaja").val(0);
                                    $("#hdnFechaAgraServBaja").val(0);
                                    agregarCargoSeleccionadoEnGrillaParaBaja(dataRecord.id_cargo,dataRecord.cargo_codigo,dataRecord.id_finpartida,dataRecord.finpartida,dataRecord.id_condicion,dataRecord.condicion,dataRecord.id_organigrama,dataRecord.gerencia_administrativa,dataRecord.departamento_administrativo,dataRecord.nivelsalarial,dataRecord.cargo,dataRecord.sueldo);
                                    cargarMotivosBajas(0,dataRecord.id_condicion);
                                    //habilitarCamposParaBajaRegistroDeRelacionLaboral(dataRecord.id_organigrama,dataRecord.id_fin_partida,dataRecord.id_condicion);
                                    var rutaImagen = obtenerRutaFoto(dataRecord.ci,dataRecord.num_complemento);
                                    $("#imgFotoPerfilBaja").attr("src",rutaImagen);
                                }else {
                                    alert("Para dar de baja un registro, este debe estar en estado ACTIVO inicialmente.")
                                }
                            }
                        }else {
                            alert("Debe seleccionar un registro necesariamente.")
                        }
                    });
                    // Movilidad de Personal.
                    $("#moverowbutton").on('click', function () {
                        var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                        if(selectedrowindex>=0) {
                            var dataRecord = $('#jqxgrid').jqxGrid('getrowdata', selectedrowindex);
                            if (dataRecord != undefined) {
                                var id_relaboral = dataRecord.id_relaboral;
                                /*
                                 *  La vista del historial se habilita para personas que tengan al menos un registro de relación sin importar su estado, ACTIVO, EN PROCESO o PASIVO.
                                 *  De esta vista se excluyen a personas que no tengan ningún registro de relación laboral.
                                 */
                                $(".msjs-alert").hide();
                                $("#hdnIdPersonaHistorialMovimiento").val(dataRecord.id_persona);
                                $("#NombreParaMoverRegistro").html(dataRecord.nombres);
                                if (dataRecord.tiene_contrato_vigente >= 0) {
                                    $('#jqxTabs').jqxTabs('enableAt', 0);
                                    $('#jqxTabs').jqxTabs('disableAt', 1);
                                    $('#jqxTabs').jqxTabs('disableAt', 2);
                                    $('#jqxTabs').jqxTabs('disableAt', 3);
                                    $('#jqxTabs').jqxTabs('enableAt', 4);
                                    $('#jqxTabs').jqxTabs('disableAt', 5);
                                    /**
                                     * Trasladamos el item seleccionado al que corresponde, el de vistas.
                                     */
                                    $('#jqxTabs').jqxTabs({ selectedItem: 4 });
                                    // Create jqxTabs.
                                    cargarGrillaMovilidad(dataRecord.id_relaboral);

                                    var rutaImagen = obtenerRutaFoto(dataRecord.ci,dataRecord.num_complemento);
                                    $("#imgFotoPerfilMover").attr("src",rutaImagen);

                                }else{
                                    alert("Para acceder a la asignación de Movilidad Funcionaria, el estado de registro de Relaci&oacute;n Laboral debe tener un estado ACTIVO.")
                                }                                   }
                        }else {
                            alert("Debe seleccionar un registro necesariamente.")
                        }
                    });
                    // Ver registro.
                    $("#viewrowbutton").on('click', function () {
                        var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                        if(selectedrowindex>=0) {
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
                                    $('#jqxTabs').jqxTabs('enableAt', 0);
                                    $('#jqxTabs').jqxTabs('disableAt', 1);
                                    $('#jqxTabs').jqxTabs('disableAt', 2);
                                    $('#jqxTabs').jqxTabs('disableAt', 3);
                                    $('#jqxTabs').jqxTabs('disableAt', 4);
                                    $('#jqxTabs').jqxTabs('enableAt', 5);
                                    /**
                                     * Trasladamos el item seleccionado al que corresponde, el de vistas.
                                     */
                                    $('#jqxTabs').jqxTabs({ selectedItem: 5 });
                                    // Create jqxTabs.
                                    $('#tabFichaPersonal').jqxTabs({
                                        theme: 'oasis',
                                        width: '100%',
                                        height: '100%',
                                        position: 'top'});
                                    // Focus jqxTabs.
                                    //$('#tabFichaPersonal').jqxTabs('focus');
                                    $('#tabFichaPersonal').jqxTabs({ selectedItem: 0 });
                                    $("#ddNombres").html(dataRecord.nombres);
                                    var rutaImagen = obtenerRutaFoto(dataRecord.ci,dataRecord.num_complemento);
                                    $("#imgFotoPerfilContactoPer").attr("src",rutaImagen);
                                    $("#imgFotoPerfilContactoInst").attr("src",rutaImagen);
                                    $("#imgFotoPerfil").attr("src",rutaImagen);
                                    cargarPersonasContactos(dataRecord.id_persona);
                                    $("#hdnIdRelaboralVista").val(id_relaboral);
                                    $("#hdnSwPrimeraVistaHistorial").val(0);
                                    cargarGestionesHistorialRelaboral(dataRecord.id_persona);
                                    /**
                                     * Para la primera cargada el valor para el parámetro gestión es 0 debido a que mostrará el historial completo.
                                     * Para el valor del parámetro sw el valor es 1 porque se desea que se limpie lo que haya y se cargue algo nuevo
                                     */
                                    cargarHistorialRelacionLaboral(dataRecord.id_persona,0,1);
                                    $("#divContent_"+dataRecord.id_relaboral).focus().select();
                                }else{
                                    alert("Para acceder a la vista del registro, la persona debe haber tenido al menos un registro de relaci&oacute,n laboral que implica un estado ACTIVO o PASIVO.")
                                }                                   }
                        }else {
                            alert("Debe seleccionar un registro necesariamente.")
                        }
                    });
                },
                    columns: [
                        {   text: 'Nro.',  datafield: 'numero',sortable: false, filterable: false, editable: false,
                            groupable: false, draggable: false, resizable: false,width: 40,cellsalign: 'center',align:'center'
                        },
                    {text: 'Memorandum',columntype: 'dropdownlist',datafield: 'memorandum',width: 100,align:'center'},
                    {text: 'Tipo',filtertype: 'checkedlist',datafield: 'tipo_memorandum',width: 130,align:'center'},
                    {text: 'Gerencia', filtertype: 'checkedlist', datafield: 'gerencia_administrativa', width: 130,align:'center'},
                    {text: 'Departamento',filtertype: 'checkedlist',datafield: 'departamento_administrativo',width: 130,align:'center'},
                    {text: 'Area',filtertype: 'checkedlist',datafield: 'area',width: 130,align:'center'},
                    {text: 'Ubicacion',filtertype: 'checkedlist',datafield: 'ubicacion',width: 100,cellsalign: 'center',align:'center'},
                    {text: 'Cargo',columntype: 'textbox',datafield: 'cargo',width: 130,cellsalign: 'center',align:'center'},
                    {text: 'Fecha Inicio', datafield: 'fecha_ini', filtertype: 'range', width: 90, cellsalign: 'center', cellsformat: 'dd-MM-yyyy',align:'center'},
                    {text: 'Fecha Fin', datafield: 'fecha_fin', filtertype: 'range', width: 90, cellsalign: 'center', cellsformat: 'dd-MM-yyyy' ,align:'center'},

                    /*{ text: 'First Name', columntype: 'textbox', datafield: 'firstname', width: 120 },
                     { text: 'Last Name', datafield: 'lastname', columntype: 'textbox', width: 120 },
                     { text: 'Product', columntype: 'dropdownlist', datafield: 'productname', width: 195 },
                     { text: 'Available', datafield: 'available', columntype: 'checkbox', width: 67 },
                     {
                     text: 'Ship Date', datafield: 'date', columntype: 'datetimeinput', width: 110, align: 'right', cellsalign: 'right', cellsformat: 'd',
                     validation: function (cell, value) {
                     if (value == "")
                     return true;
                     var year = value.getFullYear();
                     if (year >= 2015) {
                     return { result: false, message: "Ship Date should be before 1/1/2015" };
                     }
                     return true;
                     }
                     },
                     {
                     text: 'Quantity', datafield: 'quantity', width: 70, align: 'right', cellsalign: 'right', columntype: 'numberinput',
                     validation: function (cell, value) {
                     if (value < 0 || value > 150) {
                     return { result: false, message: "Quantity should be in the 0-150 interval" };
                     }
                     return true;
                     },
                     createeditor: function (row, cellvalue, editor) {
                     editor.jqxNumberInput({ decimalDigits: 0, digits: 3 });
                     }
                     },
                     { text: 'Price', datafield: 'price', align: 'right', cellsalign: 'right', cellsformat: 'c2', columntype: 'numberinput',
                     validation: function (cell, value) {
                     if (value < 0 || value > 15) {
                     return { result: false, message: "Price should be in the 0-15 interval" };
                     }
                     return true;
                     },
                     createeditor: function (row, cellvalue, editor) {
                     editor.jqxNumberInput({ digits: 3 });
                     }
                     }*/
                ]
            });
    }
    // events
    $("#jqxgridmovilidad").on('cellendedit', function (event) {
        var args = event.args;
        $("#cellendeditevent").text("Event Type: cellendedit, Column: " + args.datafield + ", Row: " + (1 + args.rowindex) + ", Value: " + args.value);
    });
}
/**
 * Función para cargar el combo de tipos de memorándums.
 * @param idTipoMemorandumPrederminado Identificador del tipo de memorándum predeterminado.
 */
/*
function cargarTiposMemorandumsParaMovilidad(idTipoMemorandumPrederminado){
    var agrupador = 1;
    var sw = 0;
    $.ajax({
        url:'/relaborales/listtiposmemorandums',
        type:'POST',
        datatype: 'json',
        async:false,
        cache:false,
        success: function(data) {
            var res = jQuery.parseJSON(data);
            $('#lstTipoMemorandum').html("");
            $('#lstTipoMemorandum').append("<option value='0'>Seleccionar...</option>");
            if(res.length>0){
                $.each( res, function( key, val ) {
                    if(val.agrupador==1){
                        if(idTipoMemorandumPrederminado==val.id){$selected='selected';}else{ $selected='';}
                        $('#lstTipoMemorandum').append("<option value="+val.id+" "+$selected+">"+val.tipo_memorandum+"</option>");
                        sw=1;
                    }
                });
               if(sw==0)$('#lstTipoMemorandum').prop("disabled","disabled");
            }else $('#lstTipoMemorandum').prop("disabled","disabled");
        }
    });
}
*/

function cargarTiposMemorandumsParaMovilidad(idTipoMemorandumPrederminado){
    var tiposMemorandumsSource =
    {
        dataType: "json",
        dataFields: [
            { name: 'tipo_memorandum'},
            { name: 'idff'}
        ],
        url: '/relaborales/listtiposmemorandums'
    };
    var tiposMemorandumsAdapter = new $.jqx.dataAdapter(tiposMemorandumsSource);
    $("#lstTipoMemorandum").jqxComboBox(
        {
            source: tiposMemorandumsAdapter,
            width: 300,
            height: 25,
            promptText: "Seleccione un tipo de memorandum...",
            displayMember: 'tipo_memorandum',
            valueMember: 'idff'
        });
}
/**
 * Función para cargar el combo de gestiones para memorándums.
 * @param gestionPredeterminada Gestión predeterminada para
 */
function cargarGestionesMemorandumsParaMovilidad(gestionPredeterminada){
    $.ajax({
        url:'/relaborales/listgestionesmemorandums',
        type:'POST',
        datatype: 'json',
        async:false,
        cache:false,
        success: function(data) {
            var res = jQuery.parseJSON(data);
            $('#lstGestionMemorandum').html("");
            $('#lstGestionMemorandum').append("<option value='0'>Seleccionar...</option>");
            if(res.length>0){
                $.each( res, function( key, val ) {
                    if(gestionPredeterminada==val.gestion){$selected='selected';}else{ $selected='';}
                    $('#lstGestionMemorandum').append("<option value="+val.gestion+" "+$selected+">"+val.gestion+"</option>");
                });
            }else $('#lstGestionMemorandum').prop("disabled","disabled");
        }
    });
}
/**
 * Función para la carga de los combos relacionados a las unidad administrativa a la cual corresponde la asignación de funciones.
 */
function cargarUnidadesOrganizacionalesParaMovilidad(idGerencia,idDepartamento,idArea){
    var gerenciasSource =
    {
        dataType: "json",
        dataFields: [
            { name: 'unidad_administrativa'},
            { name: 'id'}
        ],
        url: '/relaborales/listgerencias/'
    };
    var gerenciasAdapter = new $.jqx.dataAdapter(gerenciasSource);
    $("#lstGerenciasAdministrativasMovilidad").jqxComboBox(
        {
            source: gerenciasAdapter,
            width: 300,
            height: 25,
            promptText: "Seleccione una gerencia...",
            displayMember: 'unidad_administrativa',
            valueMember: 'id'
        });
    var departamentosSource =
    {
        dataType: "json",
        dataFields: [
            { name: 'padre_id'},
            { name: 'id'},
            { name: 'unidad_administrativa'},
        ],
        url: '/relaborales/listdepartamentosadministrativos/'
    };
    var departamentosAdapter = new $.jqx.dataAdapter(departamentosSource);

    $("#lstDepartamentosAdministrativosMovilidad").jqxComboBox(
        {

            width: 300,
            height: 25,
            disabled: true,
            promptText: "Seleccione Departamento Administrativo...",
            displayMember: 'unidad_administrativa',
            valueMember: 'id'
        });
    var areasSource =
    {
        dataType: "json",
        dataFields: [
            { name: 'padre_id'},
            { name: 'id'},
            { name: 'unidad_administrativa'},
        ],
        url: '/relaborales/listareasadministrativas/'
    };
    var areasAdapter = new $.jqx.dataAdapter(areasSource);

    $("#lstAreasAdministrativasMovilidad").jqxComboBox(
        {

            width: 300,
            height: 25,
            disabled: true,
            promptText: "Seleccione un Area Administrativa...",
            displayMember: 'unidad_administrativa',
            valueMember: 'id'
        });
    $("#lstGerenciasAdministrativasMovilidad").bind('select', function(event)
    {
        if (event.args)
        {
            $("#lstDepartamentosAdministrativosMovilidad").jqxComboBox({ disabled: false, selectedIndex: -1});
            var value = event.args.item.value;
            departamentosSource.data = {padre_id: value};
            departamentosAdapter = new $.jqx.dataAdapter(departamentosSource);
            $("#lstDepartamentosAdministrativosMovilidad").jqxComboBox({source: departamentosAdapter});
            /**
             * En caso de que una gerencia tenga un área dependiente
             */
            $("#lstAreasAdministrativasMovilidad").jqxComboBox({ disabled: false, selectedIndex: -1});
            var value = event.args.item.value;
            areasSource.data = {padre_id: value};
            areasAdapter = new $.jqx.dataAdapter(areasSource);
            $("#lstAreasAdministrativasMovilidad").jqxComboBox({source: areasAdapter});
        }
    });
    $("#lstDepartamentosAdministrativosMovilidad").bind('select', function(event)
    {
        if (event.args)
        {
            $("#lstAreasAdministrativasMovilidad").jqxComboBox({ disabled: false, selectedIndex: -1});
            var value = event.args.item.value;
            areasSource.data = {padre_id: value};
            areasAdapter = new $.jqx.dataAdapter(areasSource);
            $("#lstAreasAdministrativasMovilidad").jqxComboBox({source: areasAdapter});
        }
    });
}
/**
 * Función para cargar el combo de ubicaciones por movilidad.
 */
function cargarUbicacionesParaMovilidad(idUbicacion){
    var ubicacionesSource =
    {
        dataType: "json",
        dataFields: [
            { name: 'ubicacion'},
            { name: 'id'}
        ],
        url: '/relaborales/listubicaciones/'
    };
    var ubicacionesAdapter = new $.jqx.dataAdapter(ubicacionesSource);
    $("#lstUbicacionesMovilidad").jqxComboBox(
        {
            source: ubicacionesAdapter,
            width: 300,
            height: 25,
            promptText: "Seleccione una ubicacion...",
            displayMember: 'ubicacion',
            valueMember: 'id'
        });
}
/**
 * Función para obtener el listado de cargos que se disponen como autocompletables en el campo Cargo.
 * @param cargo
 */
function cargarCargosParaMovilidad(cargo){
    var source =
    {
        datatype: "json",
        datafields: [
            { name: 'cargo' },
        ],
        url: '/relaborales/listnombrecargos/'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#txtCargoMovilidad").jqxInput({ width: 300, height: 35,source: dataAdapter, placeHolder: "Introduzca el nombre del cargo", displayMember: "cargo", valueMember: "cargo"});
}
/**
 * Función para validar los datos del formulario de nuevo registro de relación laboral.
 * @returns {boolean} True: La validación fue correcta; False: La validación anuncia que hay errores en el formulario.
 */
function validaFormularioPorRegistroMovilidad(){
    var ok = true;
    var msje = "";
    var idRelaboral = $("#hdnIdRelaboralNuevaMovilidad").val();
    var swOrganigrama = 0;
    var swUbicacion=0;
    var swCargo = 0;
    var swFechaFin=0;
    $(".msjs-alert").hide();

    limpiarMensajesErrorPorValidacionMovilidad();

    //var idTipoMemoradundum = $("#lstTipoMemorandum").val();
    var itemTipoMemorandum = $("#lstTipoMemorandum").jqxComboBox('getSelectedItem');
    var correlativoMemoradundum  =$("#txtCorrelativoMemorandum").val();
    var gestionMemorandum  =$("#lstGestionMemorandum").val();
    var fechaMem= $('#txtFechaMem').jqxDateTimeInput('getText');
    var itemGerencia = $("#lstGerenciasAdministrativasMovilidad").jqxComboBox('getSelectedItem');
    var itemDepartamento = $("#lstDepartamentosAdministrativosMovilidad").jqxComboBox('getSelectedItem');
    var itemArea = $("#lstAreasAdministrativasMovilidad").jqxComboBox('getSelectedItem');
    var itemUbicacion = $("#lstUbicacionesMovilidad").jqxComboBox('getSelectedItem');
    var cargo = $("#txtCargoMovilidad").val();
    var fechaIni= $('#txtFechaIniMovilidad').jqxDateTimeInput('getText');
    var fechaFin= $('#txtFechaFinMovilidad').jqxDateTimeInput('getText');

    var enfoque=null;
    if(idRelaboral<=0){
        ok=false;
        var msje = "Existe un error en la especificación del registro de relación laboral. Comuniquese con el Administrador del Sistema.";
        $("#divMsjePorError").html("");
        $("#divMsjePorError").append(msje);
        $("#divMsjeNotificacionError").jqxNotification("open");
    }
    if(itemTipoMemorandum==null){
        ok=false;
        var msje = "Debe introducir el tipo de Memor&aacute;ndum necesariamente.";
        $("#divTiposMemorandums").addClass("has-error");
        $("#helpErrorTiposMemorandums").html(msje);
        if(enfoque==null)enfoque =$("#lstTipoMemorandum");
    }
    else{
        var idff = $("#lstTipoMemorandum").val();
        var arr = idff.split("-");
        var ff = arr[1];
        if(ff==1)swFechaFin=1;
        /*
         Se evalua si el tipo de memorándum establece el requerimiento de la fecha de finalización.
         */
        if(ff==1&&fechaFin==''){
            ok=false;
            var msje = "Debe introducir la fecha de finalizaci&oacute;n de aplicaci&oacute;n de la movilidad de personal necesariamente.";
            $("#divFechasFinMovilidad").show();
            $("#divFechasFinMovilidad").addClass("has-error");
            $("#helpErrorFechasFinMovilidad").html(msje);
            if(enfoque==null)enfoque =$("#txtFechaFinMovilidad");
        }
    }
    if(correlativoMemoradundum==''||gestionMemorandum==0){
        ok=false;
        var msje ="";
        $("#divCorrelativosMemorandums").addClass("has-error");
        if(correlativoMemoradundum==''){
            msje = "Debe introducir el correlativo del Memor&aacute;ndum necesariamente.";
            if(enfoque==null)enfoque =$("#txtCorrelativoMemorandum");
        }
        if(gestionMemorandum==0){
            if(msje!="")msje+="<br>";
            msje += "Debe seleccionar la gesti&oacute;n del memor&aacute;ndum necesariamente.";
            if(enfoque==null)enfoque =$("#lstGestionMemorandum");
        }
        $("#helpErrorCorrelativosMemorandums").html(msje);
    }
    if(fechaMem==''){
        ok=false;
        var msje = "Debe introducir la fecha de emisi&oacute;n del memor&aacute;ndum necesariamente.";
        $("#divFechasMemorandums").addClass("has-error");
        $("#helpErrorFechasMemorandums").html(msje);
        if(enfoque==null)enfoque =$("#txtFechaMem");
    }
    if(itemGerencia!=null){
        swOrganigrama=1;
    }
    if(itemUbicacion!=null){
        swUbicacion=1;
    }
    if(cargo!=""){
        swCargo=1;
    }
    var swTotal = parseFloat(swOrganigrama) + parseFloat(swUbicacion)+parseFloat(swCargo);
    if(swTotal==0){
        ok=false;
        var msje = "Debe seleccionar una <b>Gerencia</b>, <b>Ubicación</b> o <b>Cargo</b> para que se pueda registrar la movilidad de personal.";
        $("#divGerenciasAdministrativasMovilidad").addClass("has-error");
        $("#divUbicacionesMovilidad").addClass("has-error");
        $("#divCargosMovilidad").addClass("has-error");
        $("#helpErrorGerenciasAdministrativasMovilidad").html(msje);
        $("#helpErrorUbicacionesMovilidad").html(msje);
        $("#helpErrorCargosMovilidad").html(msje);
        if(enfoque==null)enfoque =$("#lstGerenciasAdministrativasMovilidad");
    }
    if(fechaIni==''){
        ok=false;
        var msje = "Debe introducir la fecha de inicio de aplicaci&oacute;n de la movilidad de personal necesariamente.";
        $("#divFechasIniMovilidad").addClass("has-error");
        $("#helpErrorFechasIniMovilidad").html(msje);
        if(enfoque==null)enfoque =$("#txtFechaIniMovilidad");
    }
    var sep='-';
    if(procesaTextoAFecha(fechaIni,sep)<procesaTextoAFecha(fechaMem,sep)){
        ok=false;
        msje = "La fecha de inicio debe ser igual o superior a la fecha del memor&aacute;ndum.";
        $("#divFechasIniMovilidad").addClass("has-error");
        $("#divFechasMemorandums").addClass("has-error");
        $("#helpErrorFechasIniMovilidad").html(msje);
        $("#helpErrorFechasMemorandums").html(msje);
        if(enfoque==null)enfoque =$("#txtFechaIniMovilidad");
    }
    if(swFechaFin==1){
        if(procesaTextoAFecha(fechaFin,sep)<procesaTextoAFecha(fechaIni,sep)){
            ok=false;
            msje = "La fecha de finalizaci&oacute;n debe ser igual o superior a la fecha de inicio.";
            $("#divFechasIniMovilidad").addClass("has-error");
            $("#divFechasFinMovilidad").addClass("has-error");
            $("#helpErrorFechasIniMovilidad").html(msje);
            $("#helpErrorFechasFinMovilidad").html(msje);
            if(enfoque==null)enfoque =$("#txtFechaIniMovilidad");
        }
    }
    if(enfoque!=null){
        enfoque.focus();
    }
    return ok;
}
/**
 * Función para la limpieza de los mensajes de error debido a la validación del formulario para registro de movilidad de personal.
 */
function limpiarMensajesErrorPorValidacionMovilidad(){
    $("#divTiposMemorandums").removeClass("has-error");
    $("#divFechasMemorandums").removeClass("has-error");
    $("#divCorrelativosMemorandums").removeClass("has-error");
    $("#divGerenciasAdministrativasMovilidad").removeClass("has-error");
    $("#divDepartamentosAdministrativosMovilidad").removeClass("has-error");
    $("#divAreasAdministrativasMovilidad").removeClass("has-error");
    $("#divUbicacionesMovilidad").removeClass("has-error");
    $("#divCargosMovilidad").removeClass("has-error");
    $("#divFechasIniMovilidad").removeClass("has-error");
    $("#divFechasFinMovilidad").removeClass("has-error");

    $("#helpErrorTiposMemorandums").html("");
    $("#helpErrorCorrelativosMemorandums").html("");
    $("#helpErrorFechasMemorandums").html("");
    $("#helpErrorGerenciasAdministrativasMovilidad").html("");
    $("#helpErrorDepartamentosAdministrativosMovilidad").html("");
    $("#helpErrorAreasAdministrativasMovilidad").html("");
    $("#helpErrorUbicacionesMovilidad").html("");
    $("#helpErrorCargosMovilidad").html("");
    $("#helpErrorFechasIniMovilidad").html("");
    $("#helpErrorFechasFinMovilidad").html("");
}
/**
 * Función para el registro de la movilidad de personal.
 */
function guardarRegistroMovilidad(){
    var ok=true;
    var swCargo = 0;
    var idRelaboral = $("#hdnIdRelaboralNuevaMovilidad").val();
    var idOrganigrama=0;
    var idUbicacion=0;
    var idArea=0;
    var swOrganigrama = 0;
    var swUbicacion=0;
    var swCargo = 0;
    var idff = $("#lstTipoMemorandum").val();
    var arr = idff.split("-");
    var idTipoMemorandum = arr[0];
    var swFechaFin = arr[1];

    var correlativoMemorandum = $("#txtCorrelativoMemorandum").val();
    var gestionMemorandum = $("#lstGestionMemorandum").val();
    var fechaMem= $('#txtFechaMem').jqxDateTimeInput('getText');
    var idGerencia = $("#lstGerenciasAdministrativasMovilidad").val();
    var idDepartamento = $("#lstDepartamentosAdministrativosMovilidad").val();
    var idArea = $("#lstAreasAdministrativasMovilidad").val();
    var idUbicacion = $("#lstUbicacionesMovilidad").val();
    var cargo = $("#txtCargoMovilidad").val();
    var fechaIni= $('#txtFechaIniMovilidad').jqxDateTimeInput('getText');
    var fechaFin= $('#txtFechaFinMovilidad').jqxDateTimeInput('getText');
    var observacion = $("#txtObservacionMovilidad").val();

    idGerencia = parseInt(idGerencia);
    idDepartamento = parseInt(idDepartamento);
    idArea = parseInt(idArea);
    idUbicacion = parseInt(idUbicacion);
    if(idGerencia!=null&&idGerencia!=undefined){
        swOrganigrama=1;
        if(!isNaN(idGerencia)){
            idOrganigrama = idGerencia;
        }
        if(!isNaN(idDepartamento)){
            idOrganigrama = idDepartamento;
        }
    }
    if(isNaN(idArea)){
        idArea=0;
    }
    if(!isNaN(idUbicacion)){
        idUbicacion = idUbicacion;
        swUbicacion=1;
    }else idUbicacion=0;
    if(cargo!=""){
        swCargo=1;
    }
    var swTotal = parseFloat(swOrganigrama) + parseFloat(swUbicacion) + parseFloat(swCargo);
    if(swFechaFin==0){
        fechaFin='';
    }
    if(idRelaboral>0&&idTipoMemorandum>0&&correlativoMemorandum!=''&&gestionMemorandum>0&&fechaMem!=''&&fechaIni!=''&&swTotal>0){
        var ok=$.ajax({
            url:'/relaborales/savemovilidad/',
            type:"POST",
            datatype: 'json',
            async:false,
            cache:false,
            data:{id:0,
                id_relaboral:idRelaboral,
                id_da:0,
                id_regional:0,
                id_organigrama:idOrganigrama,
                id_area:idArea,
                id_ubicacion:idUbicacion,
                cargo:cargo,
                id_tipomemorandum:idTipoMemorandum,
                correlativo:correlativoMemorandum,
                gestion:gestionMemorandum,
                fecha_mem:fechaMem,
                contenido:'',
                fecha_ini:fechaIni,
                fecha_fin:fechaFin,
                observacion:observacion
            },
            success: function(data) {  //alert(data);
                //alert(data);
                var res = jQuery.parseJSON(data);
                /**
                 * Si se ha realizado correctamente el registro de la relación laboral
                 */
                $(".msjes").hide();
                if(res.result==1){
                    /*$("#divMsjeExito").show();
                    $("#divMsjeExito").addClass('alert alert-success alert-dismissable');
                    $("#aMsjeExito").html(res.msj);*/
                    //alert(res.msj);
                    /**
                     * Se habilita nuevamente el listado actualizado con el registro realizado y
                     * se inhabilita el formulario para nuevo registro.
                     */
                    //$('#jqxTabs').jqxTabs('enableAt', 0);
                    //$('#jqxTabs').jqxTabs('disableAt', 1);
                    //deshabilitarCamposParaNuevoRegistroDeRelacionLaboral();
                    $("#jqxgridmovilidad").jqxGrid("updatebounddata");
                } else if(res.result==0){
                    /**
                     * En caso de haberse presentado un error al momento de especificar la ubicación del trabajo
                     */
                    $("#divMsjePeligro").show();
                    $("#divMsjePeligro").addClass('alert alert-warning alert-dismissable');
                    $("#aMsjePeligro").html(res.msj);
                }else{
                    /**
                     * En caso de haberse presentado un error crítico al momento de registrarse la relación laboral
                     */
                    $("#divMsjeError").show();
                    $("#divMsjeError").addClass('alert alert-danger alert-dismissable');
                    $("#aMsjeError").html(res.msj);
                }

            }, //mostramos el error
            error: function() { alert('Se ha producido un error Inesperado'); }
        });
    }else {
        ok = false;
    }
    return ok;
}