/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  27-05-2014
 */

/**
 * Función para desplegar la planilla generada en función del identificador de la planilla salarial enviada como parámetro.
 * @param idPlanillaSal
 */
function mostrarPlanilla(idPlanillaSal){
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
        url: '/planillassal/displayplanefectiva?id='+idPlanillaSal,
        cache: false
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    var columnCheckBox = null;
    var updatingCheckState = false;
    cargarRegistrosLaborales();
    function cargarRegistrosLaborales() {
        var theme = prepareSimulator("grid");
        $("#divGridPlanillasSalView").jqxGrid(
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
                pagesize: 20,
                columns: [
                    {
                        text: 'Nro.',
                        filterable: false,
                        columntype: 'number',
                        width: 40,
                        cellsalign: 'center',
                        align: 'center',
                        cellsrenderer: rownumberrenderer,
                        aggregates: [{
                         '#':function (aggregatedValue, currentValue, column, record) {
                            return aggregatedValue + 1;
                            }
                         }]
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
                            var renderstring ='<div id="divTotalView" style="float: right; margin: 4px; overflow: hidden;">Totales:</div>';
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
                        aggregates: [{
                            '':function (aggregatedValue, currentValue, column, record) {
                                var total = 0;
                                if(!isNaN(record['sueldo'])){
                                    total = Number(parseFloat(record['sueldo']));
                                }
                                return aggregatedValue + total;
                            }
                        }]
                    },
                    {
                        text: 'D&iacute;as Efectivos',
                        filtertype: 'checkedlist',
                        datafield: 'dias_efectivos',
                        width: 60,
                        align: 'center',
                        cellsalign: 'right',
                        aggregates: [{
                            '':function (aggregatedValue, currentValue, column, record) {
                                var total = 0;
                                if(!isNaN(record['dias_efectivos'])){
                                    total = Number(parseFloat(record['dias_efectivos']));
                                }
                                return aggregatedValue + total;
                            }
                        }]
                    },
                    {
                        text: 'LSGHs',
                        filtertype: 'checkedlist',
                        datafield: 'lsgh',
                        width: 60,
                        align: 'center',
                        cellsalign: 'right',
                        columngroup: 'DescuentoDias',
                        aggregates: [{
                            '':function (aggregatedValue, currentValue, column, record) {
                                var total = 0;
                                if(!isNaN(record['lsgh'])){
                                    total = Number(parseFloat(record['lsgh']));
                                }
                                return aggregatedValue + total;
                            }
                        }]
                    },
                    {
                        text: 'Omisi&oacute;n',
                        filtertype: 'checkedlist',
                        datafield: 'omision',
                        width: 60,
                        align: 'center',
                        cellsalign: 'right',
                        columngroup: 'DescuentoDias',
                        aggregates: [{
                            '':function (aggregatedValue, currentValue, column, record) {
                                var total = 0;
                                if(!isNaN(record['omision'])){
                                    total = Number(parseFloat(record['omision']));
                                }
                                return aggregatedValue + total;
                            }
                        }]
                    },
                    {
                        text: 'Abandono',
                        filtertype: 'checkedlist',
                        datafield: 'abandono',
                        width: 65,
                        align: 'center',
                        cellsalign: 'right',
                        columngroup: 'DescuentoDias',
                        aggregates: [{
                            '':function (aggregatedValue, currentValue, column, record) {
                                var total = 0;
                                if(!isNaN(record['abandono'])){
                                    total = Number(parseFloat(record['abandono']));
                                }
                                return aggregatedValue + total;
                            }
                        }]
                    },
                    {
                        text: 'Faltas',
                        filtertype: 'checkedlist',
                        datafield: 'faltas',
                        width: 60,
                        align: 'center',
                        cellsalign: 'right',
                        columngroup: 'DescuentoDias',
                        aggregates: [{
                            '':function (aggregatedValue, currentValue, column, record) {
                                var total = 0;
                                if(!isNaN(record['faltas'])){
                                    total = Number(parseFloat(record['faltas']));
                                }
                                return aggregatedValue + total;
                            }
                        }]
                    },
                    {
                        text: 'Atrasos',
                        filtertype: 'checkedlist',
                        datafield: 'atrasos',
                        width: 60,
                        align: 'center',
                        cellsalign: 'right',
                        columngroup: 'DescuentoDias',
                        aggregates: [{
                            '':function (aggregatedValue, currentValue, column, record) {
                                var total = 0;
                                if(!isNaN(record['atrasos'])){
                                    total = Number(parseFloat(record['atrasos']));
                                }
                                return aggregatedValue + total;
                            }
                        }]
                    },
                    {
                        text: 'F. & A.',
                        filtertype: 'checkedlist',
                        datafield: 'faltas_atrasos',
                        width: 60,
                        align: 'center',
                        cellsalign: 'right',
                        columngroup: 'DescuentoMonetario',
                        aggregates: [{
                            '':function (aggregatedValue, currentValue, column, record) {
                                var total = 0;
                                if(!isNaN(record['faltas_atrasos'])){
                                    total = Number(parseFloat(record['faltas_atrasos']));
                                }
                                return aggregatedValue + total;
                            }
                        }]
                    },
                    {
                        text: 'Otros',
                        filtertype: 'checkedlist',
                        datafield: 'otros',
                        width: 60,
                        align: 'center',
                        cellsalign: 'right',
                        columngroup: 'DescuentoMonetario',
                        aggregates: [{
                            '':function (aggregatedValue, currentValue, column, record) {
                                var total = 0;
                                if(!isNaN(record['otros'])){
                                    total = Number(parseFloat(record['otros']));
                                }
                                return aggregatedValue + total;
                            }
                        }]
                    },
                    {
                        text: 'Total Ganado',
                        filtertype: 'checkedlist',
                        datafield: 'total_ganado',
                        width: 90,
                        align: 'center',
                        cellsalign: 'right',
                        aggregates: [{
                            '':function (aggregatedValue, currentValue, column, record) {
                                var total = 0;
                                if(!isNaN(record['total_ganado'])){
                                    total = Number(parseFloat(record['total_ganado']));
                                }
                                return aggregatedValue + total;
                            }
                        }]
                    },
                    {
                        text: 'Total L&iacute;quido',
                        filtertype: 'checkedlist',
                        datafield: 'total_liquido',
                        width: 90,
                        align: 'center',
                        cellsalign: 'right',
                        aggregates: [{
                            '':function (aggregatedValue, currentValue, column, record) {
                                var total = 0;
                                if(!isNaN(record['total_liquido'])){
                                    total = Number(parseFloat(record['total_liquido']));
                                }
                                return aggregatedValue + total;
                            }
                        }]
                    }
                ],
                columngroups:
                    [
                        { text: 'Descuento en D&iacute;as', align: 'center', name: 'DescuentoDias' },
                        { text: 'Descuento en Bs.', align: 'center', name: 'DescuentoMonetario' }
                    ]
            });
        $('#divGridPlanillasSalView').off();
        /**
         * Control cuando se completa la construcción de la grilla correspondiente a la planilla previa.
         */
        $("#divGridPlanillasSalView").on("bindingcomplete",function(){
            var rows = $('#divGridPlanillasSalView').jqxGrid('getrows');
            if(rows.length>0){
                $("#btnGenerarPlanillaSalView").show();
            }else{
                $("#btnGenerarPlanillaSalView").hide();
            }
        });
    }
}