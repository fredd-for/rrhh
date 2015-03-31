/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  30-03-2015
 */
/**
 * Función para la obtención de los reportes correspondientes a horarios y marcaciones considerando los cálculos en base a un rango de fechas.
 * @param option
 * @param idRelaboral
 */
function exportarReporteCalculosHorariosYMarcaciones(option,fechaIni,fechaFin){
    columna = new Object();
    filtros = new Object();
    agrupados = new Object();
    ordenados = new Object();

    nombres = $('#divGridControlCalculos').jqxGrid('getcolumn','nombres');
    ci = $('#divGridControlCalculos').jqxGrid('getcolumn','ci');
    expd = $('#divGridControlCalculos').jqxGrid('getcolumn','expd');

    gestion = $('#divGridControlCalculos').jqxGrid('getcolumn','gestion');
    mes_nombre = $('#divGridControlCalculos').jqxGrid('getcolumn','mes_nombre');
    turno = $('#divGridControlCalculos').jqxGrid('getcolumn','turno');
    modalidad_marcacion = $('#divGridControlCalculos').jqxGrid('getcolumn','modalidad_marcacion');

    d1 = $('#divGridControlCalculos').jqxGrid('getcolumn','d1');
    estado1 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado1');
    estado1_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado1_descripcion');

    d2 = $('#divGridControlCalculos').jqxGrid('getcolumn','d2');
    estado2 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado2');
    estado2_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado2_descripcion');

    d3 = $('#divGridControlCalculos').jqxGrid('getcolumn','d3');
    estado3 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado3');
    estado3_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado3_descripcion');

    d4 = $('#divGridControlCalculos').jqxGrid('getcolumn','d4');
    estado4 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado4');
    estado4_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado4_descripcion');

    d5 = $('#divGridControlCalculos').jqxGrid('getcolumn','d5');
    estado5 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado5');
    estado5_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado5_descripcion');

    d6 = $('#divGridControlCalculos').jqxGrid('getcolumn','d6');
    estado6 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado6');
    estado6_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado6_descripcion');

    d7 = $('#divGridControlCalculos').jqxGrid('getcolumn','d7');
    estado7 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado7');
    estado7_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado7_descripcion');

    d8 = $('#divGridControlCalculos').jqxGrid('getcolumn','d8');
    estado8 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado8');
    estado8_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado8_descripcion');

    d9 = $('#divGridControlCalculos').jqxGrid('getcolumn','d9');
    estado9 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado9');
    estado9_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado9_descripcion');

    d10 = $('#divGridControlCalculos').jqxGrid('getcolumn','d10');
    estado10 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado10');
    estado10_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado10_descripcion');

    d11 = $('#divGridControlCalculos').jqxGrid('getcolumn','d11');
    estado11 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado11');
    estado11_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado11_descripcion');

    d12 = $('#divGridControlCalculos').jqxGrid('getcolumn','d12');
    estado12 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado12');
    estado12_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado12_descripcion');

    d13 = $('#divGridControlCalculos').jqxGrid('getcolumn','d13');
    estado13 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado13');
    estado13_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado13_descripcion');

    d14 = $('#divGridControlCalculos').jqxGrid('getcolumn','d14');
    estado14 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado14');
    estado14_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado14_descripcion');

    d15 = $('#divGridControlCalculos').jqxGrid('getcolumn','d15');
    estado15 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado15');
    estado15_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado15_descripcion');

    d16 = $('#divGridControlCalculos').jqxGrid('getcolumn','d16');
    estado16 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado16');
    estado16_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado16_descripcion');

    d17 = $('#divGridControlCalculos').jqxGrid('getcolumn','d17');
    estado17 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado17');
    estado17_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado17_descripcion');

    d18 = $('#divGridControlCalculos').jqxGrid('getcolumn','d18');
    estado18 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado18');
    estado18_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado18_descripcion');

    d19 = $('#divGridControlCalculos').jqxGrid('getcolumn','d19');
    estado19 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado19');
    estado19_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado19_descripcion');

    d20 = $('#divGridControlCalculos').jqxGrid('getcolumn','d20');
    estado20 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado20');
    estado20_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado20_descripcion');

    d21 = $('#divGridControlCalculos').jqxGrid('getcolumn','d21');
    estado21 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado21');
    estado21_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado21_descripcion');

    d22 = $('#divGridControlCalculos').jqxGrid('getcolumn','d22');
    estado22 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado22');
    estado22_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado22_descripcion');

    d23 = $('#divGridControlCalculos').jqxGrid('getcolumn','d23');
    estado23 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado23');
    estado23_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado23_descripcion');

    d24 = $('#divGridControlCalculos').jqxGrid('getcolumn','d24');
    estado24 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado24');
    estado24_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado24_descripcion');

    d25 = $('#divGridControlCalculos').jqxGrid('getcolumn','d25');
    estado25 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado25');
    estado25_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado25_descripcion');

    d26 = $('#divGridControlCalculos').jqxGrid('getcolumn','d26');
    estado26 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado26');
    estado26_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado26_descripcion');

    d27 = $('#divGridControlCalculos').jqxGrid('getcolumn','d27');
    estado27 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado27');
    estado27_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado27_descripcion');

    d28 = $('#divGridControlCalculos').jqxGrid('getcolumn','d28');
    estado28 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado28');
    estado28_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado28_descripcion');

    d29 = $('#divGridControlCalculos').jqxGrid('getcolumn','d29');
    estado29 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado29');
    estado29_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado29_descripcion');

    d30 = $('#divGridControlCalculos').jqxGrid('getcolumn','d30');
    estado30 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado30');
    estado30_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado30_descripcion');

    d31 = $('#divGridControlCalculos').jqxGrid('getcolumn','d31');
    estado31 = $('#divGridControlCalculos').jqxGrid('getcolumn','estado31');
    estado31_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado31_descripcion');

    ultimo_dia = $('#divGridControlCalculos').jqxGrid('getcolumn','ultimo_dia');
    atrasos = $('#divGridControlCalculos').jqxGrid('getcolumn','atrasos');
    faltas = $('#divGridControlCalculos').jqxGrid('getcolumn','faltas');
    abandono = $('#divGridControlCalculos').jqxGrid('getcolumn','abandono');
    omision = $('#divGridControlCalculos').jqxGrid('getcolumn','omision');
    lsgh = $('#divGridControlCalculos').jqxGrid('getcolumn','lsgh');
    compensacion = $('#divGridControlCalculos').jqxGrid('getcolumn','compensacion');
    observacion = $('#divGridControlCalculos').jqxGrid('getcolumn','observacion');
    estado = $('#divGridControlCalculos').jqxGrid('getcolumn','estado');
    estado_descripcion = $('#divGridControlCalculos').jqxGrid('getcolumn','estado_descripcion');

    columna[nombres.datafield] = {text: nombres.text, hidden: nombres.hidden};
    columna[ci.datafield] = {text: ci.text, hidden: ci.hidden};
    columna[expd.datafield] = {text: expd.text, hidden: expd.hidden};

    columna[gestion.datafield] = {text: gestion.text, hidden: gestion.hidden};
    columna[mes_nombre.datafield] = {text: mes_nombre.text, hidden: mes_nombre.hidden};
    columna[turno.datafield] = {text: turno.text, hidden: turno.hidden};
    columna[modalidad_marcacion.datafield] = {text: modalidad_marcacion.text, hidden: modalidad_marcacion.hidden};
    columna[estado_descripcion.datafield] = {text: modalidad_marcacion.text, hidden: estado_descripcion.hidden};

    columna[d1.datafield] = {text: d1.text, hidden: d1.hidden};
    /*columna[estado1.datafield] = {text: estado1.text, hidden: estado1.hidden};
    columna[estado1_descripcion.datafield] = {text: estado1_descripcion.text, hidden: estado1_descripcion.hidden};*/

    columna[d2.datafield] = {text: d2.text, hidden: d2.hidden};
    /*columna[estado2.datafield] = {text: estado2.text, hidden: estado2.hidden};
    columna[estado2_descripcion.datafield] = {text: estado2_descripcion.text, hidden: estado2_descripcion.hidden};
*/
    columna[d3.datafield] = {text: d3.text, hidden: d3.hidden};
    /*columna[estado3.datafield] = {text: estado3.text, hidden: estado3.hidden};
    columna[estado3_descripcion.datafield] = {text: estado3_descripcion.text, hidden: estado3_descripcion.hidden};*/

    columna[d4.datafield] = {text: d4.text, hidden: d4.hidden};
    /*columna[estado4.datafield] = {text: estado4.text, hidden: estado4.hidden};
    columna[estado4_descripcion.datafield] = {text: estado4_descripcion.text, hidden: estado4_descripcion.hidden};*/

    columna[d5.datafield] = {text: d5.text, hidden: d5.hidden};
    /*columna[estado5.datafield] = {text: estado5.text, hidden: estado5.hidden};
    columna[estado5_descripcion.datafield] = {text: estado5_descripcion.text, hidden: estado5_descripcion.hidden};*/

    columna[d6.datafield] = {text: d6.text, hidden: d6.hidden};
    /*columna[estado6.datafield] = {text: estado6.text, hidden: estado6.hidden};
    columna[estado6_descripcion.datafield] = {text: estado6_descripcion.text, hidden: estado6_descripcion.hidden};*/

    columna[d7.datafield] = {text: d7.text, hidden: d7.hidden};
    /*columna[estado7.datafield] = {text: estado7.text, hidden: estado7.hidden};
    columna[estado7_descripcion.datafield] = {text: estado7_descripcion.text, hidden: estado7_descripcion.hidden};*/

    columna[d8.datafield] = {text: d8.text, hidden: d8.hidden};
    /*columna[estado8.datafield] = {text: estado8.text, hidden: estado8.hidden};
    columna[estado8_descripcion.datafield] = {text: estado8_descripcion.text, hidden: estado8_descripcion.hidden};*/

    columna[d9.datafield] = {text: d9.text, hidden: d9.hidden};
    /*columna[estado9.datafield] = {text: estado9.text, hidden: estado9.hidden};
    columna[estado9_descripcion.datafield] = {text: estado9_descripcion.text, hidden: estado9_descripcion.hidden};*/

    columna[d10.datafield] = {text: d10.text, hidden: d10.hidden};
    /*columna[estado10.datafield] = {text: estado10.text, hidden: estado10.hidden};
    columna[estado10_descripcion.datafield] = {text: estado10_descripcion.text, hidden: estado10_descripcion.hidden};*/

    columna[d11.datafield] = {text: d11.text, hidden: d11.hidden};
    /*columna[estado11.datafield] = {text: estado11.text, hidden: estado11.hidden};
    columna[estado11_descripcion.datafield] = {text: estado11_descripcion.text, hidden: estado11_descripcion.hidden};*/

    columna[d12.datafield] = {text: d12.text, hidden: d12.hidden};
    /*columna[estado12.datafield] = {text: estado12.text, hidden: estado12.hidden};
    columna[estado12_descripcion.datafield] = {text: estado12_descripcion.text, hidden: estado12_descripcion.hidden};*/

    columna[d13.datafield] = {text: d13.text, hidden: d13.hidden};
    /*columna[estado13.datafield] = {text: estado13.text, hidden: estado13.hidden};
    columna[estado13_descripcion.datafield] = {text: estado13_descripcion.text, hidden: estado13_descripcion.hidden};*/

    columna[d14.datafield] = {text: d14.text, hidden: d14.hidden};
    /*columna[estado14.datafield] = {text: estado14.text, hidden: estado14.hidden};
    columna[estado14_descripcion.datafield] = {text: estado14_descripcion.text, hidden: estado14_descripcion.hidden};*/

    columna[d15.datafield] = {text: d15.text, hidden: d15.hidden};
    /*columna[estado15.datafield] = {text: estado15.text, hidden: estado15.hidden};
    columna[estado15_descripcion.datafield] = {text: estado15_descripcion.text, hidden: estado15_descripcion.hidden};*/

    columna[d16.datafield] = {text: d16.text, hidden: d16.hidden};
    /*columna[estado16.datafield] = {text: estado16.text, hidden: estado16.hidden};
    columna[estado16_descripcion.datafield] = {text: estado16_descripcion.text, hidden: estado16_descripcion.hidden};*/

    columna[d17.datafield] = {text: d17.text, hidden: d17.hidden};
    /*columna[estado17.datafield] = {text: estado17.text, hidden: estado17.hidden};
    columna[estado17_descripcion.datafield] = {text: estado17_descripcion.text, hidden: estado17_descripcion.hidden};*/

    columna[d18.datafield] = {text: d18.text, hidden: d18.hidden};
    /*columna[estado18.datafield] = {text: estado18.text, hidden: estado18.hidden};
    columna[estado18_descripcion.datafield] = {text: estado18_descripcion.text, hidden: estado18_descripcion.hidden};*/

    columna[d19.datafield] = {text: d19.text, hidden: d19.hidden};
    /*columna[estado19.datafield] = {text: estado19.text, hidden: estado19.hidden};
    columna[estado19_descripcion.datafield] = {text: estado19_descripcion.text, hidden: estado19_descripcion.hidden};*/

    columna[d20.datafield] = {text: d20.text, hidden: d20.hidden};
    /*columna[estado20.datafield] = {text: estado20.text, hidden: estado20.hidden};
    columna[estado20_descripcion.datafield] = {text: estado20_descripcion.text, hidden: estado20_descripcion.hidden};*/

    columna[d21.datafield] = {text: d21.text, hidden: d21.hidden};
    /*columna[estado21.datafield] = {text: estado21.text, hidden: estado21.hidden};
    columna[estado21_descripcion.datafield] = {text: estado21_descripcion.text, hidden: estado21_descripcion.hidden};*/

    columna[d22.datafield] = {text: d22.text, hidden: d22.hidden};
    /*columna[estado22.datafield] = {text: estado22.text, hidden: estado22.hidden};
    columna[estado22_descripcion.datafield] = {text: estado22_descripcion.text, hidden: estado22_descripcion.hidden};*/

    columna[d23.datafield] = {text: d23.text, hidden: d23.hidden};
    /*columna[estado23.datafield] = {text: estado23.text, hidden: estado23.hidden};
    columna[estado23_descripcion.datafield] = {text: estado23_descripcion.text, hidden: estado23_descripcion.hidden};*/

    columna[d24.datafield] = {text: d24.text, hidden: d24.hidden};
    /*columna[estado24.datafield] = {text: estado24.text, hidden: estado24.hidden};
    columna[estado24_descripcion.datafield] = {text: estado24_descripcion.text, hidden: estado24_descripcion.hidden};*/

    columna[d25.datafield] = {text: d25.text, hidden: d25.hidden};
    /*columna[estado25.datafield] = {text: estado25.text, hidden: estado25.hidden};
    columna[estado25_descripcion.datafield] = {text: estado25_descripcion.text, hidden: estado25_descripcion.hidden};*/

    columna[d26.datafield] = {text: d26.text, hidden: d26.hidden};
    /*columna[estado26.datafield] = {text: estado26.text, hidden: estado26.hidden};
    columna[estado26_descripcion.datafield] = {text: estado26_descripcion.text, hidden: estado26_descripcion.hidden};*/

    columna[d27.datafield] = {text: d27.text, hidden: d27.hidden};
    /*columna[estado27.datafield] = {text: estado27.text, hidden: estado27.hidden};
    columna[estado27_descripcion.datafield] = {text: estado27_descripcion.text, hidden: estado27_descripcion.hidden};*/

    columna[d28.datafield] = {text: d28.text, hidden: d28.hidden};
    /*columna[estado28.datafield] = {text: estado28.text, hidden: estado28.hidden};
    columna[estado28_descripcion.datafield] = {text: estado28_descripcion.text, hidden: estado28_descripcion.hidden};*/

    columna[d29.datafield] = {text: d29.text, hidden: d29.hidden};
    /*columna[estado29.datafield] = {text: estado29.text, hidden: estado29.hidden};
    columna[estado29_descripcion.datafield] = {text: estado29_descripcion.text, hidden: estado29_descripcion.hidden};*/

    columna[d30.datafield] = {text: d30.text, hidden: d30.hidden};
    /*columna[estado30.datafield] = {text: estado30.text, hidden: estado30.hidden};
    columna[estado30_descripcion.datafield] = {text: estado30_descripcion.text, hidden: estado30_descripcion.hidden};*/

    columna[d31.datafield] = {text: d31.text, hidden: d31.hidden};
    /*columna[estado31.datafield] = {text: estado31.text, hidden: estado31.hidden};
    columna[estado31_descripcion.datafield] = {text: estado31_descripcion.text, hidden: estado31_descripcion.hidden};*/

    columna[ultimo_dia.datafield] = {text: ultimo_dia.text, hidden: ultimo_dia.hidden};
    columna[atrasos.datafield] = {text: atrasos.text, hidden: atrasos.hidden};
    columna[faltas.datafield] = {text: faltas.text, hidden: faltas.hidden};
    columna[abandono.datafield] = {text: abandono.text, hidden: abandono.hidden};
    columna[omision.datafield] = {text: omision.text, hidden: omision.hidden};
    columna[lsgh.datafield] = {text: lsgh.text, hidden: lsgh.hidden};
    columna[observacion.datafield] = {text: observacion.text, hidden: observacion.hidden};


    var groups = $('#divGridControlCalculos').jqxGrid('groups');
    if(groups==null||groups=='')groups='null';
    //var sorteds = $('#divGridControlCalculos').jqxGrid('getsortcolumn');

    var sortinformation = $('#divGridControlCalculos').jqxGrid('getsortinformation');
    if(sortinformation.sortcolumn!=undefined){
        // The sortcolumn rep   resents the sort column's datafield. If there's no sort column, the sortcolumn is null.
        var sortcolumn = sortinformation.sortcolumn;
        // The sortdirection is an object with two fields: 'ascending' and 'descending'. Ex: { 'ascending': true, 'descending': false }
        var sortdirection = sortinformation.sortdirection;
        ordenados[sortcolumn] = {asc: sortdirection.ascending, desc: sortdirection.descending};
    }else ordenados='';


    var rows = $('#divGridControlCalculos').jqxGrid('getrows');
    var filterGroups = $('#divGridControlCalculos').jqxGrid('getfilterinformation');
    var counter = 0;
    for (var i = 0; i < filterGroups.length; i++) {
        var filterGroup = filterGroups[i];
        var filters = filterGroup.filter.getfilters();
        for (var j = 0; j < filters.length; j++) {
            if (j>0){
                counter++;
            }
            var indice = i+counter;
            filtros[indice] = {columna: filterGroup.filtercolumn, valor: filters[j].value,
                condicion: filters[j].condition, tipo: filters[j].type};
        }
    }
    var n_rows = rows.length;
    var json_filter = JSON.stringify(filtros);
    var json_columns = JSON.stringify(columna);
    var json_sorteds = JSON.stringify(ordenados);
    json_columns = btoa(utf8_encode(json_columns));
    json_filter = btoa(utf8_encode(json_filter));
    json_sorteds = btoa(utf8_encode(json_sorteds));
    var json_groups =  btoa(utf8_encode(groups));

    json_columns = json_columns.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
    json_filter = json_filter.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
    json_groups = json_groups.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
    json_sorteds = json_sorteds.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
    var ruta='';
    switch (option){
        case 1: ruta = "/horariosymarcaciones/exportcalculosexcel/";break;
        case 2: ruta = "/horariosymarcaciones/exportcalculospdf/";break;
    }

    if(ruta!='')
        window.open(ruta+fechaIni+"/"+fechaFin+"/"+n_rows+"/"+json_columns+"/"+json_filter+"/"+json_groups+"/"+json_sorteds ,"_blank");
}
function utf8_encode(argString) {
    //  discuss at: http://phpjs.org/functions/utf8_encode/
    // original by: Webtoolkit.info (http://www.webtoolkit.info/)
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: sowberry
    // improved by: Jack
    // improved by: Yves Sucaet
    // improved by: kirilloid
    // bugfixed by: Onno Marsman
    // bugfixed by: Onno Marsman
    // bugfixed by: Ulrich
    // bugfixed by: Rafal Kukawski
    // bugfixed by: kirilloid
    //   example 1: utf8_encode('Kevin van Zonneveld');
    //   returns 1: 'Kevin van Zonneveld'

    if (argString === null || typeof argString === 'undefined') {
        return '';
    }

    var string = (argString + ''); // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");
    var utftext = '',
        start, end, stringl = 0;

    start = end = 0;
    stringl = string.length;
    for (var n = 0; n < stringl; n++) {
        var c1 = string.charCodeAt(n);
        var enc = null;

        if (c1 < 128) {
            end++;
        } else if (c1 > 127 && c1 < 2048) {
            enc = String.fromCharCode(
                (c1 >> 6) | 192, (c1 & 63) | 128
            );
        } else if ((c1 & 0xF800) != 0xD800) {
            enc = String.fromCharCode(
                (c1 >> 12) | 224, ((c1 >> 6) & 63) | 128, (c1 & 63) | 128
            );
        } else { // surrogate pairs
            if ((c1 & 0xFC00) != 0xD800) {
                throw new RangeError('Unmatched trail surrogate at ' + n);
            }
            var c2 = string.charCodeAt(++n);
            if ((c2 & 0xFC00) != 0xDC00) {
                throw new RangeError('Unmatched lead surrogate at ' + (n - 1));
            }
            c1 = ((c1 & 0x3FF) << 10) + (c2 & 0x3FF) + 0x10000;
            enc = String.fromCharCode(
                (c1 >> 18) | 240, ((c1 >> 12) & 63) | 128, ((c1 >> 6) & 63) | 128, (c1 & 63) | 128
            );
        }
        if (enc !== null) {
            if (end > start) {
                utftext += string.slice(start, end);
            }
            utftext += enc;
            start = end = n + 1;
        }
    }

    if (end > start) {
        utftext += string.slice(start, stringl);
    }

    return utftext;
};