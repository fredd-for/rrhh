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
            { name: 'organigrama_sigla', type: 'string' },
            { name: 'organigrama_orden', type: 'string' },
            { name: 'id_area', type: 'integer' },
            { name: 'area', type: 'string' },
            { name: 'id_ubicacion', type: 'integer' },
            { name: 'ubicacion', type: 'string' },
            { name: 'numero', type: 'integer' },
            { name: 'cargo', type: 'string' },
            { name: 'evento_id', type: 'integer' },
            { name: 'evento', type: 'string' },
            { name: 'motivo', type: 'string' },
            { name: 'id_pais', type: 'integer' },
            { name: 'pais', type: 'string' },
            { name: 'id_departamento', type: 'integer' },
            { name: 'departamento', type: 'string' },
            { name: 'lugar', type: 'string' },
            { name: 'fecha_ini', type: 'date' },
            { name: 'hora_ini', type: 'time' },
            { name: 'fecha_fin', type: 'date' },
            { name: 'hora_fin', type: 'time' },
            { name: 'id_tipomemorandum', type: 'integer' },
            { name: 'tipo_memorandum', type: 'string' },
            { name: 'memorandum_correlativo', type: 'string' },
            { name: 'memorandum_gestion', type: 'integer' },
            { name: 'memorandum', type: 'string' },/*Valor agrupado de memorandum_correltivo, memorandum_gestion y fecha_mem*/
            { name: 'fecha_mem', type: 'date' },
            { name: 'observacion', type: 'string' },
            { name: 'estado', type: 'integer' },
            { name: 'estado_descripcion', type: 'string' }

        ],
        url: '/relaborales/listhistorialmovilidad?id='+idRelaboral,
        id: 'id_relaboralmovilidad',
        cache: false
    };
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
                rendertoolbar: function (toolbar) {
                    var me = this;
                    var container = $("<div></div>");
                    toolbar.append(container);
                    container.append("<button id='addrowbuttonmove' class='btn btn-sm btn-primary' type='button'><i class='fa fa-plus-square fa-2x text-info' title='Nuevo Registro.'/></i></button>");
                    container.append("<button id='updaterowbuttonmove'  class='btn btn-sm btn-primary' type='button' ><i class='fa fa-pencil-square fa-2x text-info' title='Modificar registro.'/></button>");
                    /*container.append("<button id='deleterowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-minus-square fa-2x text-info' title='Dar de baja al registro.'/></i></button>");
                    container.append("<button id='moverowbutton' class='btn btn-sm btn-primary' type='button'><i class='fa fa-tag fa-2x text-info' title='Movilidad de Personal.'/></i></button>");
                    container.append("<button id='viewrowbutton' class='btn btn-sm btn-primary' type='button'><i class='gi gi-nameplate_alt fa-2x text-info' title='Vista Historial.'/></i></button>");*/

                    $("#addrowbuttonmove").jqxButton();
                    //$("#approverowbutton").jqxButton();
                    $("#updaterowbuttonmove").jqxButton();
                    /*$("#deleterowbutton").jqxButton();
                    $("#moverowbutton").jqxButton();
                    $("#viewrowbutton").jqxButton();*/


                    // Registrar nueva movilidad de personal.
                    $("#addrowbuttonmove").on('click', function () {
                        $("#hdnIdRelaboralPorMovilidad").val(idRelaboral);
                        $("#hdnIdRelaboralMovilidadModificar").val(0);
                        $("#chkAi").attr("checked",false);
                        $("#txtCorrelativoMemorandum").val("");
                        $("#txtCargoMovilidad").val("");
                        $("#lstUbicaciones").val("");

                        $("#txtFechaMem").val("");
                        $("#txtFechaIniMovilidad").val("");
                        $("#txtFechaFinMovilidad").val("");
                        $("#hdnIdOrganigramaPorSeleccionCargoSuperior").val(0);

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
                            /*var itemTipoMemorandum = $("#lstTipoMemorandum").jqxComboBox('getSelectedItem');*/
                            var itemTipoMemorandum = $("#lstTipoMemorandum").val();
                            if(itemTipoMemorandum!=0){
                                var id_agraupado = $("#lstTipoMemorandum").val();
                                var arr = id_agraupado.split("-");
                                var idTipoMemorandum = arr[0];/*Identificador del tipo de memorándum*/
                                var ff = arr[1];/*Requerir fecha de finalización*/
                                var hf = arr[2];/*Requerir hora de finalización*/
                                var cc = arr[3];/*Requerir cargo*/
                                var oo = arr[4];/*Requerir unidad organizacional*/
                                var uu = arr[5];/*Requerir ubicación*/
                                var mm = arr[6];/*Requerir motivo*/
                                var pp = arr[7];/*Requerir pais*/
                                var dd = arr[8];/*Requerir departamento o ciudad*/
                                var ll = arr[9];/*Requerir lugar del evento*/
                                /*
                                * Se evalua en función del tipo de memorándum seleccionado los datos requeridos.
                                 */
                                if(ff>=1){
                                    $("#divFechasFinMovilidad").show();
                                    $("#divHorasFinMovilidad").show();
                                }else{
                                    $("#divFechasFinMovilidad").hide();
                                    $("#divHorasFinMovilidad").hide();
                                }
                                if(mm>=1){
                                    $("#divMotivosMovilidad").show();
                                }else $("#divMotivosMovilidad").hide();

                                if(pp>=1){
                                    $("#divPaisesMovilidad").show();
                                    cargarPaisesCiudadesParaMovilidad(0,0);
                                }else $("#divPaisesMovilidad").hide();

                                if(dd>=1){
                                    $("#divCiudadesMovilidad").show();
                                }else $("#divCiudadesMovilidad").hide();

                                if(ll>=1){
                                    $("#divLugaresMovilidad").show();
                                }else $("#divLugaresMovilidad").hide();

                                if(cc>=1){
                                    $("#divCargosMovilidad").show();
                                    /**
                                     * Si es requerido el cargo y además el tipo de documento refiere a ASIGNACIÓN DE FUNCIONES
                                     * se pone visible la opción de añadir "a.i." al final del nombre del cargo.
                                     */
                                    if(idTipoMemorandum==2){
                                        $("#divChkAi").show();
                                        obtieneCargoInmediatoSuperior(idRelaboral);
                                    }else {
                                        $("#txtCargoMovilidad").val("");
                                        $("#divChkAi").hide();
                                    }
                                }else {
                                    $("#divCargosMovilidad").hide();
                                }
                                if(oo>=1){
                                    $("#divGerenciasAdministrativasMovilidad").show();
                                    $("#divDepartamentosAdministrativosMovilidad").show();
                                    $("#divAreasAdministrativasMovilidad").show();
                                }else{
                                    $("#divGerenciasAdministrativasMovilidad").hide();
                                    $("#divDepartamentosAdministrativosMovilidad").hide();
                                    $("#divAreasAdministrativasMovilidad").hide();
                                }
                                if(uu>=1){
                                    $("#divUbicacionesMovilidad").show();
                                }else{
                                    $("#divUbicacionesMovilidad").hide();
                                }
                            }else {
                                $("#divCargosMovilidad").hide();
                                $("#divChkAi").hide();

                                $("#divMotivosMovilidad").hide();
                                $("#divPaisesMovilidad").hide();
                                $("#divCiudadesMovilidad").hide();
                                $("#divLugaresMovilidad").hide();

                                $("#divGerenciasAdministrativasMovilidad").hide();
                                $("#divDepartamentosAdministrativosMovilidad").hide();
                                $("#divAreasAdministrativasMovilidad").hide();
                                $("#divUbicacionesMovilidad").hide();
                                $("#divFechasFinMovilidad").hide();
                                $("#divHorasFinMovilidad").hide();

                            }
                        });
                        $("#lstUbicaciones").change(function(){
                            $("#txtCargoMemorandum").focus();
                        });
                        $("#txtFechaMem").jqxDateTimeInput({ enableBrowserBoundsDetection: false, height: 24, formatString:'dd-MM-yyyy' });
                        var fechaActual=fechaHoy();
                        $('#txtFechaMem').jqxDateTimeInput('setMaxDate', fechaActual);
                        /*
                            Se establece como fecha mínima debido a que al inicio de operaciones de la empresa
                         */
                        $('#txtFechaMem').jqxDateTimeInput('setMinDate', new Date(2014, 3, 1));

                        $("#txtFechaIniMovilidad").jqxDateTimeInput({ enableBrowserBoundsDetection: false, height: 24, formatString:'dd-MM-yyyy' });
                        $("#txtFechaFinMovilidad").jqxDateTimeInput({ enableBrowserBoundsDetection: false, height: 24, formatString:'dd-MM-yyyy' });
                        /**
                         * Campos ocultos por defecto
                         */
                        $("#divCargosMovilidad").hide();
                        $("#divChkAi").hide();

                        $("#divMotivosMovilidad").hide();
                        $("#divPaisesMovilidad").hide();
                        $("#divCiudadesMovilidad").hide();
                        $("#divLugaresMovilidad").hide();

                        $("#divGerenciasAdministrativasMovilidad").hide();
                        $("#divDepartamentosAdministrativosMovilidad").hide();
                        $("#divAreasAdministrativasMovilidad").hide();
                        $("#divUbicacionesMovilidad").hide();
                        $("#divFechasFinMovilidad").hide();
                        $("#divHorasFinMovilidad").hide();

                        $("#txtHoraIniMovilidad").val("");
                        $("#txtHoraFinMovilidad").val("");
                        $("#txtObservacionMovilidad").jqxInput({ width: 300, height: 35, placeHolder: "Introduzca sus observaciones"});
                        $("#popupWindowNuevaMovilidad").jqxWindow('open');
                    });

                    // Modificar registro.
                    $("#updaterowbuttonmove").on('click', function () {
                        limpiarMensajesErrorPorValidacionMovilidad();
                        var selectedrowindex = $("#jqxgridmovilidad").jqxGrid('getselectedrowindex');
                        if(selectedrowindex>=0){
                            var dataRecord = $('#jqxgridmovilidad').jqxGrid('getrowdata', selectedrowindex);
                            if(dataRecord!=undefined) {
                                var idRelaboralMovilidad = dataRecord.id_relaboralmovilidad;
                                $("#divTitleRegistroMovilidad").html("");
                                $("#divTitleRegistroMovilidad").append("Modificaci&oacute;n Registro de Movilidad de Personal");
                                /**
                                 * Para el caso cuando la persona tenga un registro de relación laboral en estado EN PROCESO o ACTIVO.
                                 */
                                if (dataRecord.estado >= 1) {

                                    $("#hdnIdRelaboralPorMovilidad").val(idRelaboral);
                                    $("#hdnIdRelaboralMovilidadModificar").val(idRelaboralMovilidad);
                                    cargarGestionesMemorandumsParaMovilidad(dataRecord.memorandum_gestion);
                                    $("#txtCorrelativoMemorandum").val(dataRecord.memorandum_correlativo);
                                    $("#txtCorrelativoMemorandum").focus();
                                    $("#txtFechaMem").jqxDateTimeInput({ value:dataRecord.fecha_mem,enableBrowserBoundsDetection: false, height: 24, formatString:'dd-MM-yyyy' });
                                    var fechaActual=fechaHoy();
                                    $('#txtFechaMem').jqxDateTimeInput('setMaxDate', fechaActual);
                                    /*
                                     Se establece como fecha mínima debido a que al inicio de operaciones de la empresa
                                     */
                                    $('#txtFechaMem').jqxDateTimeInput('setMinDate', new Date(2014, 3, 1));
                                    $("#txtMotivoMovilidad").val(dataRecord.motivo);
                                    cargarCargosParaMovilidad('');
                                    $("#txtCargoMovilidad").val(dataRecord.cargo);
                                    var asignacionCargo=dataRecord.cargo;
                                    if(asignacionCargo!=null&&asignacionCargo!=''){
                                        var n=asignacionCargo.indexOf("a.i.");
                                        if(n>0){
                                            /**
                                             * Si el cargo mencional la palabra a.i.                                         *
                                             */
                                            $("#chkAi").prop("checked",true);
                                        }
                                    }
                                    cargarUnidadesOrganizacionalesParaMovilidad(dataRecord.id_gerencia_administrativa,dataRecord.id_departamento_administrativo,dataRecord.id_area);
                                    cargarUbicacionesParaMovilidad(dataRecord.id_ubicacion);
                                    cargarPaisesCiudadesParaMovilidad(dataRecord.id_pais,dataRecord.id_departamento);

                                    $("#txtFechaIniMovilidad").jqxDateTimeInput({ value:dataRecord.fecha_ini,enableBrowserBoundsDetection: false, height: 24, formatString:'dd-MM-yyyy' });
                                    if(dataRecord.hora_ini!=''){
                                        $("#txtHoraIniMovilidad").val(dataRecord.hora_ini);
                                    }else {
                                        $("#txtHoraIniMovilidad").val("")
                                    }
                                    if(dataRecord.hora_fin!=''){
                                         $("#txtHoraFinMovilidad").val(dataRecord.hora_fin);
                                    }else{
                                         $("#txtHoraFinMovilidad").val("");
                                    }

                                    if(dataRecord.fecha_fin!='')$("#txtFechaFinMovilidad").jqxDateTimeInput({ value:dataRecord.fecha_fin,enableBrowserBoundsDetection: false, height: 24, formatString:'dd-MM-yyyy' });
                                    $("#txtFechaFinMovilidad").jqxDateTimeInput({ enableBrowserBoundsDetection: false, height: 24, formatString:'dd-MM-yyyy' });

                                    $("#txtObservacionMovilidad").jqxInput({ value:dataRecord.observacion,width: 300, height: 35, placeHolder: "Introduzca sus observaciones"});

                                    cargarTiposMemorandumsParaMovilidad(dataRecord.id_tipomemorandum);
                                    /*
                                     * En base al tipo de memorándum preseleccionado se muestran a continuación los valores necesarios
                                     */
                                    var idTipoMemorandum = $("#lstTipoMemorandum").val();
                                    if(idTipoMemorandum!='0'){
                                        var id_agrupado = $("#lstTipoMemorandum").val();
                                        var arr = id_agrupado.split("-");
                                        var idTipoMemorandum = arr[0];/*Identificador del tipo de memorándum*/
                                        var ff = arr[1];/*Requerir fecha de finalización*/
                                        var hf = arr[2];/*Requerir hora de finalización*/
                                        var cc = arr[3];/*Requerir cargo*/
                                        var oo = arr[4];/*Requerir unidad organizacional*/
                                        var uu = arr[5];/*Requerir ubicación*/
                                        var mm = arr[6];/*Requerir motivo*/
                                        var pp = arr[7];/*Requerir pais*/
                                        var dd = arr[8];/*Requerir departamento o ciudad*/
                                        var ll = arr[9];/*Requerir lugar del evento*/
                                        /*
                                         * Se evalua en función del tipo de memorándum seleccionado los datos requeridos.
                                         */
                                        if(ff>=1){
                                            $("#divFechasFinMovilidad").show();
                                            $("#divHorasFinMovilidad").show();
                                        }else{
                                            $("#divFechasFinMovilidad").hide();
                                            $("#divHorasFinMovilidad").hide();
                                        }
                                        if(mm>=1){
                                            $("#divMotivosMovilidad").show();
                                        }else $("#divMotivosMovilidad").hide();

                                        if(pp>=1){
                                            $("#divPaisesMovilidad").show();
                                        }else $("#divPaisesMovilidad").hide();

                                        if(dd>=1){
                                            $("#divCiudadesMovilidad").show();
                                        }else $("#divCiudadesMovilidad").hide();

                                        if(ll>=1){
                                            $("#divLugaresMovilidad").show();
                                            $("#txtLugarMovilidad").val(dataRecord.lugar);
                                        }else $("#divLugaresMovilidad").hide();

                                        if(cc>=1){
                                            $("#divCargosMovilidad").show();
                                            /**
                                             * Si es requerido el cargo y además el tipo de documento refiere a ASIGNACIÓN DE FUNCIONES
                                             * se pone visible la opción de añadir "a.i." al final del nombre del cargo.
                                             */
                                            if(idTipoMemorandum==2){
                                                $("#divChkAi").show();
                                               // obtieneCargoInmediatoSuperior(idRelaboral);
                                            }else {
                                                $("#txtCargoMovilidad").val("");
                                                $("#divChkAi").hide();
                                            }
                                        }else {
                                            $("#divCargosMovilidad").hide();
                                        }
                                        if(oo>=1){
                                            $("#divGerenciasAdministrativasMovilidad").show();
                                            $("#divDepartamentosAdministrativosMovilidad").show();
                                            $("#divAreasAdministrativasMovilidad").show();
                                        }else{
                                            $("#divGerenciasAdministrativasMovilidad").hide();
                                            $("#divDepartamentosAdministrativosMovilidad").hide();
                                            $("#divAreasAdministrativasMovilidad").hide();
                                        }
                                        if(uu>=1){
                                            $("#divUbicacionesMovilidad").show();
                                        }else{
                                            $("#divUbicacionesMovilidad").hide();
                                        }
                                    }
                                    /*
                                     *
                                     */

                                    /*$("#chkAi").attr("checked",false);
                                    $("#txtCorrelativoMemorandum").val("");
                                    $("#txtCargoMovilidad").val("");
                                    $("#lstUbicaciones").val("");

                                    $("#txtFechaMem").val("");
                                    $("#txtFechaIniMovilidad").val("");
                                    $("#txtFechaFinMovilidad").val("");
                                    $("#hdnIdOrganigramaPorSeleccionCargoSuperior").val(0);*/




                                    $("#lstTipoMemorandum").focus();
                                    $("#lstTipoMemorandum").change(function(){
                                        $("#txtCorrelativoMemorandum").focus();
                                        //var itemTipoMemorandum = $("#lstTipoMemorandum").jqxComboBox('getSelectedItem');
                                        var idTipoMemorandum = $("#lstTipoMemorandum").val();
                                        if(idTipoMemorandum!='0'){
                                            var id_agrupado = $("#lstTipoMemorandum").val();
                                            var arr = id_agrupado.split("-");
                                            var idTipoMemorandum = arr[0];/*Identificador del tipo de memorándum*/
                                            var ff = arr[1];/*Requerir fecha de finalización*/
                                            var hf = arr[2];/*Requerir hora de finalización*/
                                            var cc = arr[3];/*Requerir cargo*/
                                            var oo = arr[4];/*Requerir unidad organizacional*/
                                            var uu = arr[5];/*Requerir ubicación*/
                                            var mm = arr[6];/*Requerir motivo*/
                                            var pp = arr[7];/*Requerir pais*/
                                            var dd = arr[8];/*Requerir departamento o ciudad*/
                                            var ll = arr[9];/*Requerir lugar del evento*/
                                            /*
                                             * Se evalua en función del tipo de memorándum seleccionado los datos requeridos.
                                             */
                                            if(ff>=1){
                                                $("#divFechasFinMovilidad").show();
                                                $("#divHorasFinMovilidad").show();
                                            }else{
                                                $("#divFechasFinMovilidad").hide();
                                                $("#divHorasFinMovilidad").hide();
                                            }
                                            if(mm>=1){
                                                $("#divMotivosMovilidad").show();
                                            }else $("#divMotivosMovilidad").hide();

                                            if(pp>=1){
                                                $("#divPaisesMovilidad").show();
                                            }else $("#divPaisesMovilidad").hide();

                                            if(dd>=1){
                                                $("#divCiudadesMovilidad").show();
                                            }else $("#divCiudadesMovilidad").hide();

                                            if(ll>=1){
                                                $("#divLugaresMovilidad").show();
                                            }else $("#divLugaresMovilidad").hide();

                                            if(cc>=1){
                                                $("#divCargosMovilidad").show();
                                                /**
                                                 * Si es requerido el cargo y además el tipo de documento refiere a ASIGNACIÓN DE FUNCIONES
                                                 * se pone visible la opción de añadir "a.i." al final del nombre del cargo.
                                                 */
                                                if(idTipoMemorandum==2){
                                                    $("#divChkAi").show();
                                                    obtieneCargoInmediatoSuperior(idRelaboral);
                                                }else {
                                                    $("#txtCargoMovilidad").val("");
                                                    $("#divChkAi").hide();
                                                }
                                            }else {
                                                $("#divCargosMovilidad").hide();
                                            }
                                            if(oo>=1){
                                                $("#divGerenciasAdministrativasMovilidad").show();
                                                $("#divDepartamentosAdministrativosMovilidad").show();
                                                $("#divAreasAdministrativasMovilidad").show();
                                            }else{
                                                $("#divGerenciasAdministrativasMovilidad").hide();
                                                $("#divDepartamentosAdministrativosMovilidad").hide();
                                                $("#divAreasAdministrativasMovilidad").hide();
                                            }
                                            if(uu>=1){
                                                $("#divUbicacionesMovilidad").show();
                                            }else{
                                                $("#divUbicacionesMovilidad").hide();
                                            }
                                        }
                                    });
                                    $("#lstUbicaciones").change(function(){
                                        $("#txtCargoMemorandum").focus();
                                    });
                                    /**
                                     * Campos ocultos por defecto
                                     */
                                    /*$("#divCargosMovilidad").hide();
                                    $("#divChkAi").hide();

                                    $("#divMotivosMovilidad").hide();
                                    $("#divPaisesMovilidad").hide();
                                    $("#divCiudadesMovilidad").hide();
                                    $("#divLugaresMovilidad").hide();

                                    $("#divGerenciasAdministrativasMovilidad").hide();
                                    $("#divDepartamentosAdministrativosMovilidad").hide();
                                    $("#divAreasAdministrativasMovilidad").hide();
                                    $("#divUbicacionesMovilidad").hide();
                                    $("#divFechasFinMovilidad").hide();
                                    $("#divHorasFinMovilidad").hide();*/




                                    $("#popupWindowNuevaMovilidad").jqxWindow('open');
                                }else {
                                    alert("Debe seleccionar un registro con estado ACTIVO para posibilitar la modificaci&oacute;n del registro de movilidad");
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
                    { text: 'Estado', filtertype: 'checkedlist', datafield: 'estado_descripcion', width: 100,cellsalign: 'center', align:'center',hidden:false,cellclassname: cellclass},
                    {text: 'Gerencia', filtertype: 'checkedlist', datafield: 'gerencia_administrativa', width: 130,align:'center'},
                    {text: 'Departamento',filtertype: 'checkedlist',datafield: 'departamento_administrativo',width: 130,align:'center'},
                    {text: 'Area',filtertype: 'checkedlist',datafield: 'area',width: 130,align:'center'},
                    {text: 'Ubicacion',filtertype: 'checkedlist',datafield: 'ubicacion',width: 100,cellsalign: 'center',align:'center'},
                    {text: 'Cargo',columntype: 'textbox',datafield: 'cargo',width: 130,cellsalign: 'center',align:'center'},
                    {text: 'Motivo',columntype: 'textbox',datafield: 'motivo',width: 130,cellsalign: 'center',align:'center'},
                    {text: 'Lugar',columntype: 'textbox',datafield: 'lugar',width: 130,cellsalign: 'center',align:'center'},
                    {text: 'Fecha Inicio', datafield: 'fecha_ini', filtertype: 'range', width: 90, cellsalign: 'center', cellsformat: 'dd-MM-yyyy',align:'center'},
                    {text: 'Hora Inicio', filtertype: 'checkedlist',datafield: 'hora_ini', width: 90, cellsalign: 'center', cellsformat: 't',align:'center'},
                    {text: 'Fecha Fin', datafield: 'fecha_fin', filtertype: 'range', width: 90, cellsalign: 'center',cellsformat: 'dd-MM-yyyy' , align:'center'},
                    {text: 'Hora Fin', filtertype: 'checkedlist',datafield: 'hora_fin', width: 90, cellsalign: 'center',cellsformat: 't' , align:'center'},
                    {text: 'Observaciones',columntype: 'textbox',datafield: 'observacion',width: 130,cellsalign: 'center',align:'center'},

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

function cargarTiposMemorandumsParaMovilidad(idTipoMemorandumPrederminado){
    var agrupador = 1;
    var sw = 0;
    $.ajax({
        url:'/relaborales/listtiposmemorandumsmovilidad',
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
                        if(idTipoMemorandumPrederminado==val.id){$selected='selected';}else{ $selected='';}
                        $('#lstTipoMemorandum').append("<option value="+val.id_agrupado+" "+$selected+">"+val.tipo_memorandum+"</option>");
                        sw=1;
                });
               if(sw==0)$('#lstTipoMemorandum').prop("disabled","disabled");
            }else $('#lstTipoMemorandum').prop("disabled","disabled");
        }
    });
}

/*
function cargarTiposMemorandumsParaMovilidad(idTipoMemorandumPrederminado){
    var tiposMemorandumsSource =
    {
        dataType: "json",
        dataFields: [
            { name: 'tipo_memorandum'},
            { name: 'id_agrupado'}
        ],
        url: '/relaborales/listtiposmemorandumsmovilidad'
    };
    var tiposMemorandumsAdapter = new $.jqx.dataAdapter(tiposMemorandumsSource);
    $("#lstTipoMemorandum").jqxComboBox(
        {
            source: tiposMemorandumsAdapter,
            width: 300,
            height: 25,
            promptText: "Seleccione un tipo de memorandum...",
            displayMember: 'tipo_memorandum',
            valueMember: 'id_agrupado'
        });

        $("#lstTipoMemorandum").jqxComboBox('selectItem','DESIGNACION DE FUNCIONES');
}*/
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
        async: false,
        dataFields: [
            { name: 'unidad_administrativa'},
            { name: 'id'}
        ],
        url: '/relaborales/listgerencias/'
    };
    var gerenciasAdapter = new $.jqx.dataAdapter(gerenciasSource);

    var departamentosSource =
    {
        dataType: "json",
        async: false,
        dataFields: [
            { name: 'padre_id'},
            { name: 'id'},
            { name: 'unidad_administrativa'},
        ],
        url: '/relaborales/listdepartamentosadministrativos/'
    };
    var departamentosAdapter = new $.jqx.dataAdapter(departamentosSource);
    var areasSource =
    {
        dataType: "json",
        async: false,
        dataFields: [
            { name: 'padre_id'},
            { name: 'id'},
            { name: 'unidad_administrativa'},
        ],
        url: '/relaborales/listareasadministrativas/'
    };
    var areasAdapter = new $.jqx.dataAdapter(areasSource);


    $("#lstGerenciasAdministrativasMovilidad").jqxComboBox(
        {
            source: gerenciasAdapter,
            width: 300,
            height: 25,
            promptText: "Seleccione una gerencia...",
            displayMember: "unidad_administrativa",
            valueMember: 'id',
            selectedIndex:0
        });
    $("#lstDepartamentosAdministrativosMovilidad").jqxComboBox(
        {

            width: 300,
            height: 25,
            disabled: true,
            promptText: "Seleccione Departamento Administrativo...",
            displayMember: 'unidad_administrativa',
            valueMember: 'id'
        });
    $("#lstAreasAdministrativasMovilidad").jqxComboBox(
        {
            width: 300,
            height: 25,
            disabled: true,
            promptText: "Seleccione un Area Administrativa...",
            displayMember: 'unidad_administrativa',
            valueMember: 'id'
        });
    if(idGerencia>0){
        $("#lstGerenciasAdministrativasMovilidad").jqxComboBox('selectItem', idGerencia);
        /**
         * Estableciendo el identificador del departamento predeterminado
         */
        $("#lstDepartamentosAdministrativosMovilidad").jqxComboBox({ disabled: false, selectedIndex: -1});
        departamentosSource.data = {padre_id: idGerencia};
        departamentosAdapter = new $.jqx.dataAdapter(departamentosSource);
        $("#lstDepartamentosAdministrativosMovilidad").jqxComboBox({source: departamentosAdapter});

        if(idDepartamento>0){
            $("#lstDepartamentosAdministrativosMovilidad").jqxComboBox('selectItem', idDepartamento);
            /**
             * Estableciendo el identificador del área predeterminada
             */
            $("#lstAreasAdministrativasMovilidad").jqxComboBox({ disabled: false, selectedIndex: -1});
            areasSource.data = {padre_id: idDepartamento};
            areasAdapter = new $.jqx.dataAdapter(areasSource);
            $("#lstAreasAdministrativasMovilidad").jqxComboBox({source: areasAdapter});
            if(idArea>0)
            {
                $("#lstAreasAdministrativasMovilidad").jqxComboBox('selectItem', idArea);
            }
        }
    }
    /**
     * Controlando los eventos sucedidos por cambios
     */
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
 * Función para la especificación de los combos dependientes de país y ciudad.
 * @param idPais Identificador del país.
 * @param idDepartamento Identificador del departamento.
 */
function cargarPaisesCiudadesParaMovilidad(idPais,idDepartamento){
    var paisesSource =
    {
        dataType: "json",
        async: false,
        dataFields: [
            { name: 'pais'},
            { name: 'id'}
        ],
        url: '/relaborales/listpaises/'
    };
    var paisesAdapter = new $.jqx.dataAdapter(paisesSource);
    $("#lstPaisesMovilidad").jqxComboBox(
        {
            source: paisesAdapter,
            width: 300,
            height: 25,
            promptText: "Seleccione un país...",
            displayMember: 'pais',
            valueMember: 'id'
        });
    var departamentosSource =
    {
        dataType: "json",
        async: false,
        dataFields: [
            { name: 'pais_id'},
            { name: 'id'},
            { name: 'departamento'},
        ],
        url: '/relaborales/listdepartamentos/'
    };
    var departamentosAdapter = new $.jqx.dataAdapter(departamentosSource);

    $("#lstCiudadesMovilidad").jqxComboBox(
        {

            width: 300,
            height: 25,
            disabled: true,
            promptText: "Seleccione la ciudad...",
            displayMember: 'departamento',
            valueMember: 'id'
        });
    if(idPais>0){
        $("#lstPaisesMovilidad").jqxComboBox('selectItem', idPais);
        /**
         * Controlando si se ha seleccionado una ciudad
         */
        $("#lstCiudadesMovilidad").jqxComboBox({ disabled: false, selectedIndex: -1});
        departamentosSource.data = {pais_id: idPais};
        departamentosAdapter = new $.jqx.dataAdapter(departamentosSource);
        $("#lstCiudadesMovilidad").jqxComboBox({source: departamentosAdapter});

        if(idDepartamento>0){
            $("#lstCiudadesMovilidad").jqxComboBox('selectItem', idDepartamento);
        }
    }

    /**
     * Controlando los cambios de selector
     */
    $("#lstPaisesMovilidad").bind('select', function(event)
    {
        if (event.args)
        {
            $("#lstCiudadesMovilidad").jqxComboBox({ disabled: false, selectedIndex: -1});
            var value = event.args.item.value;
            departamentosSource.data = {pais_id: value};
            departamentosAdapter = new $.jqx.dataAdapter(departamentosSource);
            $("#lstCiudadesMovilidad").jqxComboBox({source: departamentosAdapter});
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
        async: false,
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
    if(idUbicacion>0){
        $("#lstUbicacionesMovilidad").jqxComboBox('selectItem', idUbicacion);
    }
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
    var idRelaboral = $("#hdnIdRelaboralPorMovilidad").val();
    var idRelaboralMovilidad = $("#hdnIdRelaboralMovilidadModificar").val();
    var idOrganigrama=0;
    var idUbicacion=0;
    var idArea=0;
    var swOrganigrama = 0;
    var swUbicacion=0;
    var swCargo = 0;
    var swFechaFin=0;
    $(".msjs-alert").hide();

    limpiarMensajesErrorPorValidacionMovilidad();

    /*var itemTipoMemorandum = $("#lstTipoMemorandum").jqxComboBox('getSelectedItem');*/
    var idTipoMemorandum = $("#lstTipoMemorandum").val();
    var correlativoMemoradundum  =$("#txtCorrelativoMemorandum").val();
    var gestionMemorandum  =$("#lstGestionMemorandum").val();
    var fechaMem= $('#txtFechaMem').jqxDateTimeInput('getText');
    var idGerencia = $("#lstGerenciasAdministrativasMovilidad").val();
    var idDepartamentoAdministrativo = $("#lstDepartamentosAdministrativosMovilidad").val();
    var idArea = $("#lstAreasAdministrativasMovilidad").val();
    var idUbicacion = $("#lstUbicacionesMovilidad").val();
    var cargo = $("#txtCargoMovilidad").val();
    var motivo = $("#txtMotivoMovilidad").val();
    var idPais = $("#lstPaisesMovilidad").val();
    var idDepartamento = $("#lstDepartamentosMovilidad").val();
    var lugar = $("#txtLugarMovilidad").val();
    var fechaIni= $('#txtFechaIniMovilidad').jqxDateTimeInput('getText');
    var horaIni= $('#txtHoraIniMovilidad').val();
    var fechaFin= $('#txtFechaFinMovilidad').jqxDateTimeInput('getText');
    var horaFin= $('#txtHoraFinMovilidad').val();

    idPais = parseInt(idPais);
    idDepartamento = parseInt(idDepartamento);
    if(isNaN(idPais))idPais=0;
    if(isNaN(idDepartamento))idDepartamento=0;
    idGerencia = parseInt(idGerencia);
    idDepartamentoAdministrativo = parseInt(idDepartamentoAdministrativo);
    idArea = parseInt(idArea);
    idUbicacion = parseInt(idUbicacion);
    if(idGerencia!=null&&idGerencia!=undefined){
        swOrganigrama=1;
        if(!isNaN(idGerencia)){
            idOrganigrama = idGerencia;
        }
        if(!isNaN(idDepartamentoAdministrativo)){
            idOrganigrama = idDepartamentoAdministrativo;
        }
    }
    var enfoque=null;
    if(idRelaboral<=0){
        ok=false;
        var msje = "Existe un error en la especificación del registro de relación laboral. Comuniquese con el Administrador del Sistema.";
        $("#divMsjePorError").html("");
        $("#divMsjePorError").append(msje);
        $("#divMsjeNotificacionError").jqxNotification("open");
    }
    if(idTipoMemorandum==0){
        ok=false;
        var msje = "Debe introducir el tipo de Memor&aacute;ndum necesariamente.";
        $("#divTiposMemorandums").addClass("has-error");
        $("#helpErrorTiposMemorandums").html(msje);
        if(enfoque==null)enfoque =$("#lstTipoMemorandum");
    }
    else{
        var id_agraupado = $("#lstTipoMemorandum").val();
        var arr = id_agraupado.split("-");
        var ff = arr[1];/*Requerir fecha de finalización*/
        var hf = arr[2];/*Requerir hora de finalización*/
        var cc = arr[3];/*Requerir cargo*/
        var oo = arr[4];/*Requerir unidad organizacional*/
        var uu = arr[5];/*Requerir ubicación*/
        var mm = arr[6];/*Requerir motivo*/
        var pp = arr[7];/*Requerir pais*/
        var dd = arr[8];/*Requerir departamento o ciudad*/
        var ll = arr[9];/*Requerir lugar del evento*/
         /*
         * Se evalua en función del tipo de memorándum seleccionado los datos requeridos.
         */
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
        if(horaIni!=''&&fechaIni==''){
            ok=false;
            var msje = "Si desea registrar una hora de inicio debe especificar la fecha de inicio necesariamente.";
            $("#divHorasIniMovilidad").show();
            $("#divHorasIniMovilidad").addClass("has-error");
            $("#helpErrorHorasIniMovilidad").html(msje);
            if(enfoque==null)enfoque =$("#txtHoraIniMovilidad");
        }
        if(horaFin!=''&&fechaFin==''){
            ok=false;
            var msje = "Si desea registrar una hora de finalizaci&oacute;n debe especificar la fecha de finalizaci&oacute;n necesariamente.";
            $("#divHorasFinMovilidad").show();
            $("#divHorasFinMovilidad").addClass("has-error");
            $("#helpErrorHorasFinMovilidad").html(msje);
            if(enfoque==null)enfoque =$("#txtHoraFinMovilidad");
        }
        if(cc==1&&cargo==''){
            ok=false;
            var msje = "Debe introducir la asignaci&oacute;n del cargo necesariamente.";
            $("#divCargosMovilidad").addClass("has-error");
            $("#helpErrorCargosMovilidad").html(msje);
            if(enfoque==null)enfoque =$("#txtCargoMovilidad");
        }
        if(oo==1&&idOrganigrama==0){
            ok=false;
            var msje = "Debe seleccionar una Gerencia y/o Departamento para el registro requerido.";
            $("#divGerenciasAdministrativasMovilidad").addClass("has-error");
            $("#helpErrorGerenciasAdministrativasMovilidad").html(msje);
            if(enfoque==null)enfoque =$("#lstGerenciasAdministrativasMovilidad");
        }
        if(mm==1&&motivo==''){
            ok=false;
            var msje = "Debe registrar un motivo para la designaci&oacute;n.";
            $("#divLugaresMovilidad").addClass("has-error");
            $("#helpErrorLugaresMovilidad").html(msje);
            if(enfoque==null)enfoque =$("#txtLugarMovilidad");
        }
        /*
        Se oculta temporalmente
        if(pp==1&&idPais==0){
            var msje = "Debe seleccionar un pa&iacute;s necesariamente.";
            $("#divPaisesMovilidad").addClass("has-error");
            $("#helpErrorPaisesMovilidad").html(msje);
            if(enfoque==null)enfoque =$("#lstPaisesMovilidad");
        }
        if(dd==1&&idDepartamento==0){
            var msje = "Debe registrar una ciudad necesariamente.";
            $("#divCiudadesMovilidad").addClass("has-error");
            $("#helpErrorCiudadesMovilidad").html(msje);
            if(enfoque==null)enfoque =$("#lstCiudadMovilidad");
        }*/
        if(ll==1&&lugar==''){
            var msje = "Debe registrar un lugar para la designaci&oacute;n.";
            $("#divMotivosMovilidad").addClass("has-error");
            $("#helpErrorMotivosMovilidad").html(msje);
            if(enfoque==null)enfoque =$("#txtMotivoMovilidad");
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
    var ok=false;
    var swCargo = 0;
    var idRelaboral = $("#hdnIdRelaboralPorMovilidad").val();
    var idRelaboralMovilidad = $("#hdnIdRelaboralMovilidadModificar").val();
    var idOrganigrama=0;
    var idUbicacion=0;
    var idArea=0;
    var swOrganigrama = 0;
    var swUbicacion=0;
    var swCargo = 0;
    var chAi = 0;
    if($("#chkAi").is(':checked')) {
        chAi=1;
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
    var fechaMem= $('#txtFechaMem').jqxDateTimeInput('getText');
    var idGerencia = $("#lstGerenciasAdministrativasMovilidad").val();
    var idDepartamentoAdministrativo = $("#lstDepartamentosAdministrativosMovilidad").val();
    var idArea = $("#lstAreasAdministrativasMovilidad").val();
    var idUbicacion = $("#lstUbicacionesMovilidad").val();
   // var asignacionCargo = $("#txtCargoMovilidad").val();
    var asignacionCargo = $("#txtCargoMovilidad").jqxInput('val');;

    if(asignacionCargo!=''&&chAi==1){
        asignacionCargo+=" a.i.";
    }
    var motivo = $("#txtMotivoMovilidad").val();
    var idPais = $("#lstPaisesMovilidad").val();
    var idDepartamento = $("#lstDepartamentosMovilidad").val();
    var lugar = $("#txtLugarMovilidad").val();
    var fechaIni= $('#txtFechaIniMovilidad').jqxDateTimeInput('getText');
    var horaIni= $('#txtHoraIniMovilidad').val();
    var fechaFin= $('#txtFechaFinMovilidad').jqxDateTimeInput('getText');
    var horaFin= $('#txtHoraFinMovilidad').val();
    var observacion = $("#txtObservacionMovilidad").val();

    idPais = parseInt(idPais);
    idDepartamento = parseInt(idDepartamento);
    if(isNaN(idPais))idPais=0;
    if(isNaN(idDepartamento))idDepartamento=0;
    idGerencia = parseInt(idGerencia);
    idDepartamentoAdministrativo = parseInt(idDepartamentoAdministrativo);
    idArea = parseInt(idArea);
    idUbicacion = parseInt(idUbicacion);
    if(idGerencia!=null&&idGerencia!=undefined){
        if(!isNaN(idGerencia)){
            idOrganigrama = idGerencia;
        }
        if(!isNaN(idDepartamentoAdministrativo)){
            idOrganigrama = idDepartamentoAdministrativo;
        }
    }
    if(idOrganigrama==0){
        /**
         * En caso de que se haya seleccionado el cargo superior y no se haya especificado Gerencia, Departamento ni área
         * se establece el valor de acuerdo al id_organigrama del cargo del jefe
         */
        if($("#hdnIdOrganigramaPorSeleccionCargoSuperior").val()>0)
            idOrganigrama=$("#hdnIdOrganigramaPorSeleccionCargoSuperior").val();
    }
    if(isNaN(idArea)){
        idArea=0;
    }
    if(!isNaN(idUbicacion)){
        idUbicacion = idUbicacion;
        swUbicacion=1;
    }else {
        /*
         * En caso de que se haya seleccionado el cargo superior y no se haya especificado la ubicación
         * se establece el valor de acuerdo al lugar donde esta situado del cargo del jefe
         */
        if($("#hdnIdOrganigramaPorSeleccionCargoSuperior").val()>0){
            idUbicacion=-1;
        }
        else idUbicacion=0;

    }

    if(swFechaFin==0){
        fechaFin='';
    }
    if(idRelaboral>0&&idTipoMemorandum>0&&correlativoMemorandum!=''&&gestionMemorandum>0&&fechaMem!=''&&fechaIni!=''){
        $.ajax({
            url:'/relaborales/savemovilidad/',
            type:"POST",
            datatype: 'json',
            async:false,
            cache:false,
            data:{id:idRelaboralMovilidad,
                id_relaboral:idRelaboral,
                id_da:0,
                id_regional:0,
                id_organigrama:idOrganigrama,
                id_area:idArea,
                id_ubicacion:idUbicacion,
                cargo:asignacionCargo,
                id_evento:0,
                motivo:motivo,
                id_pais:idPais,
                id_departamento:idDepartamento,
                lugar:lugar,
                id_tipomemorandum:idTipoMemorandum,
                correlativo:correlativoMemorandum,
                gestion:gestionMemorandum,
                fecha_mem:fechaMem,
                contenido:'',
                fecha_ini:fechaIni,
                hora_ini:horaIni,
                fecha_fin:fechaFin,
                hora_fin:horaFin,
                observacion:observacion
            },
            success: function(data) {  //alert(data);
                var res = jQuery.parseJSON(data);
                /**
                 * Si se ha realizado correctamente el registro de la relación laboral y la movilidad
                 */
                $(".msjes").hide();
                if(res.result==1){
                    ok=true;
                    $("#jqxgridmovilidad").jqxGrid("updatebounddata");
                    $("#divMsjePorSuccess").html("");
                    $("#divMsjePorSuccess").append(res.msj);
                    $("#divMsjeNotificacionSuccess").jqxNotification("open");
                } else if(res.result==0){
                    /**
                     * En caso de presentarse un error subsanable
                     */
                    $("#divMsjePorWarning").html("");
                    $("#divMsjePorWarning").append(res.msj);
                    $("#divMsjeNotificacionWarning").jqxNotification("open");
                }else{
                    /**
                     * En caso de haberse presentado un error crítico al momento de registrarse la relación laboral
                     */
                    $("#divMsjePorError").html("");
                    $("#divMsjePorError").append(res.msj);
                    $("#divMsjeNotificacionError").jqxNotification("open");
                }

            }, //mostramos el error
            error: function() { alert('Se ha producido un error Inesperado'); }
        });
    }
    return ok;
}
/**
 * Función para obtener registro correspondiente al cargo del inmediato superior considerando el identificador de la relación laboral.
 * @param idRelaboral
 */
function obtieneCargoInmediatoSuperior(idRelaboral){
    if(idRelaboral>0){
        var resultado = $.ajax({
            url: '/relaborales/getcargosuperiorrelaboral',
            type: 'POST',
            datatype: 'json',
            async: false,
            cache: false,
            data: {id: idRelaboral},
            success: function (data) {
            }
        }).responseText;
        var res = jQuery.parseJSON(resultado);
        if(res.cargo!=''){
            if(confirm("Desea usar el cargo '"+res.cargo+"' del inmediato superior \nen la asignacion de funciones?"))
            {$("#txtCargoMovilidad").val(res.cargo);
                $("#chkAi").prop("checked","checked");
                /*
                   Si se ha seleccionado el cargo del nivel superior se debería asignar de igual modo el organigrama del jefe para la asignación de funciones.
                 */
                $("#hdnIdOrganigramaPorSeleccionCargoSuperior").val(res.organigrama_id);
            }else{ $("#txtCargoMovilidad").val("");
                $("#chkAi").attr("checked",false);
            }
        }
    }
}