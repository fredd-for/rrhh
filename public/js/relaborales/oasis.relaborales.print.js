/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  09-11-2014
 */
function exportarPDF(){
    columna = new Object();
    filtros = new Object();
    agrupados = new Object();
    //nro_row = $('#jqxgrid').jqxGrid('getcolumn','nro_row');
    ubicacion = $('#jqxgrid').jqxGrid('getcolumn','ubicacion');
    condicion = $('#jqxgrid').jqxGrid('getcolumn','condicion');
    estado_descripcion = $('#jqxgrid').jqxGrid('getcolumn','estado_descripcion');
    nombres = $('#jqxgrid').jqxGrid('getcolumn','nombres');
    ci = $('#jqxgrid').jqxGrid('getcolumn','ci');
    expd = $('#jqxgrid').jqxGrid('getcolumn','expd');
    num_complemento = $('#jqxgrid').jqxGrid('getcolumn','num_complemento');
    gerencia_administrativa = $('#jqxgrid').jqxGrid('getcolumn','gerencia_administrativa');
    cargo = $('#jqxgrid').jqxGrid('getcolumn','cargo');
    sueldo = $('#jqxgrid').jqxGrid('getcolumn','sueldo');
    departamento_administrativo = $('#jqxgrid').jqxGrid('getcolumn','departamento_administrativo');
    area = $('#jqxgrid').jqxGrid('getcolumn','area');
    proceso_codigo = $('#jqxgrid').jqxGrid('getcolumn','proceso_codigo');
    nivelsalarial = $('#jqxgrid').jqxGrid('getcolumn','nivelsalarial');
    fecha_ini = $('#jqxgrid').jqxGrid('getcolumn','fecha_ini');
    fecha_incor = $('#jqxgrid').jqxGrid('getcolumn','fecha_incor');
    fecha_fin = $('#jqxgrid').jqxGrid('getcolumn','fecha_fin'),
    fecha_baja = $('#jqxgrid').jqxGrid('getcolumn','fecha_baja');
    motivo_baja = $('#jqxgrid').jqxGrid('getcolumn','motivo_baja');
    observacion = $('#jqxgrid').jqxGrid('getcolumn','observacion');
    /*id_relaboral = $('#jqxgrid').jqxGrid('getcolumn','id_relaboral');
    id_persona = $('#jqxgrid').jqxGrid('getcolumn','id_persona');
    fecha_nac = $('#jqxgrid').jqxGrid('getcolumn','fecha_nac');
    edad = $('#jqxgrid').jqxGrid('getcolumn','edad');
    lugar_nac = $('#jqxgrid').jqxGrid('getcolumn','lugar_nac');
    genero = $('#jqxgrid').jqxGrid('getcolumn','genero');
    e_civil = $('#jqxgrid').jqxGrid('getcolumn','e_civil');
    tiene_contrato_vigente = $('#jqxgrid').jqxGrid('getcolumn','tiene_contrato_vigente');
    id_fin_partida = $('#jqxgrid').jqxGrid('getcolumn','id_fin_partida');
    finpartida = $('#jqxgrid').jqxGrid('getcolumn','finpartida');
     id_area = $('#jqxgrid').jqxGrid('getcolumn','id_area');
    id_condicion = $('#jqxgrid').jqxGrid('getcolumn','id_condicion');
    id_organigrama = $('#jqxgrid').jqxGrid('getcolumn','id_organigrama');
    id_ubicacion = $('#jqxgrid').jqxGrid('getcolumn','id_ubicacion');
    num_contrato = $('#jqxgrid').jqxGrid('getcolumn','num_contrato');
    id_proceso = $('#jqxgrid').jqxGrid('getcolumn','id_proceso');
    id_cargo = $('#jqxgrid').jqxGrid('getcolumn','id_cargo');
    cargo_codigo = $('#jqxgrid').jqxGrid('getcolumn','cargo_codigo');

    */
    //columna[nro_row] = {text: 'Nro.', hidden: false};
    columna[ubicacion.datafield] = {text: ubicacion.text, hidden: ubicacion.hidden};
    columna[condicion.datafield] = {text: condicion.text, hidden: condicion.hidden};
    columna[estado_descripcion.datafield] = {text: estado_descripcion.text, hidden: estado_descripcion.hidden};
    columna[nombres.datafield] = {text: nombres.text, hidden: nombres.hidden};
    columna[ci.datafield] = {text: ci.text, hidden: ci.hidden};
    columna[expd.datafield] = {text: expd.text, hidden: expd.hidden};
    columna[num_complemento.datafield] = {text: num_complemento.text, hidden: num_complemento.hidden};
    columna[gerencia_administrativa.datafield] = {text: gerencia_administrativa.text, hidden: gerencia_administrativa.hidden};
    columna[departamento_administrativo.datafield] = {text: departamento_administrativo.text, hidden: departamento_administrativo.hidden};
    columna[area.datafield] = {text: area.text, hidden: area.hidden};
    columna[proceso_codigo.datafield] = {text: proceso_codigo.text, hidden: proceso_codigo.hidden};
    columna[cargo.datafield] = {text: cargo.text, hidden: cargo.hidden};
    columna[sueldo.datafield] = {text: sueldo.text, hidden: sueldo.hidden};
    columna[fecha_ini.datafield] = {text: fecha_ini.text, hidden: fecha_ini.hidden};
    columna[fecha_incor.datafield] = {text: fecha_incor.text, hidden: fecha_incor.hidden};
    columna[nivelsalarial.datafield] = {text: nivelsalarial.text, hidden: nivelsalarial.hidden};
    columna[fecha_fin.datafield] = {text: fecha_fin.text, hidden: fecha_fin.hidden};
    columna[fecha_baja.datafield] = {text: fecha_baja.text, hidden: fecha_baja.hidden};
    columna[motivo_baja.datafield] = {text: motivo_baja.text, hidden: motivo_baja.hidden};
    columna[observacion.datafield] = {text: observacion.text, hidden: observacion.hidden};

    /*
    columna[id_relaboral.datafield] = {text: id_relaboral.text, hidden: id_relaboral.hidden};
    columna[id_persona.datafield] = {text: id_persona.text, hidden: id_persona.hidden};
    columna[fecha_nac.datafield] = {text: fecha_nac.text, hidden: fecha_nac.hidden};
    columna[edad.datafield] = {text: edad.text, hidden: edad.hidden};
    columna[lugar_nac.datafield] = {text: lugar_nac.text, hidden: lugar_nac.hidden};
    columna[genero.datafield] = {text: genero.text, hidden: genero.hidden};
    columna[e_civil.datafield] = {text: e_civil.text, hidden: e_civil.hidden};
    columna[tiene_contrato_vigente.datafield] = {text: tiene_contrato_vigente.text, hidden: tiene_contrato_vigente.hidden};
    columna[id_fin_partida.datafield] = {text: id_fin_partida.text, hidden: id_fin_partida.hidden};
    columna[finpartida.datafield] = {text: finpartida.text, hidden: finpartida.hidden};
    columna[ubicacion.datafield] = {text: ubicacion.text, hidden: ubicacion.hidden};
    columna[id_condicion.datafield] = {text: id_condicion.text, hidden: id_condicion.hidden};
    columna[estado.datafield] = {text: estado.text, hidden: estado.hidden};
    columna[id_organigrama.datafield] = {text: id_organigrama.text, hidden: id_organigrama.hidden};
    columna[id_area.datafield] = {text: id_area.text, hidden: id_area.hidden};
    columna[id_ubicacion.datafield] = {text: id_ubicacion.text, hidden: id_ubicacion.hidden};
    columna[num_contrato.datafield] = {text: num_contrato.text, hidden: num_contrato.hidden};
    columna[id_proceso.datafield] = {text: id_proceso.text, hidden: id_proceso.hidden};
    columna[id_cargo.datafield] = {text: id_cargo.text, hidden: id_cargo.hidden};
    columna[cargo_codigo.datafield] = {text: cargo_codigo.text, hidden: cargo_codigo.hidden};
    */

    var groups = $('#jqxgrid').jqxGrid('groups');
    var rows = $('#jqxgrid').jqxGrid('getrows');
    var filterGroups = $('#jqxgrid').jqxGrid('getfilterinformation');
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
    json_columns = btoa(utf8_encode(json_columns));
    json_filter = btoa(utf8_encode(json_filter));
    var json_groups =  btoa(utf8_encode(groups));
    json_columns= json_columns.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
    json_filter= json_filter.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
    json_groups= json_groups.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
    window.open("/relaborales/print/"+n_rows+"/"+json_columns+"/"+json_filter+"/"+json_groups, "_blank");
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