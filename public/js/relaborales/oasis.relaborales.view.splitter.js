/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  05-11-2014
 */
/**
 * Función para cargar el listado de años en los cuales la persona (Identificada por el parámetro idPersona) ha trabajado o trabaja en la empresa.
 * @param idPersona Identificador de la persona de la cual se desea obtener la información respectiva.
 */
function cargarGestionesHistorialRelaboral(idPersona){
    var gestiones = [];
    $('#HistorialSplitter').jqxSplitter('expand');
    $.ajax({
        url:'/relaborales/listgestionesporpersona',
        type:'POST',
        datatype: 'json',
        async:false,
        cache:false,
        data:{id:idPersona},
        success: function(data) {
            var res = jQuery.parseJSON(data);
            if(res.length>0){
                $.each( res, function( key, val ) {
                    gestiones.push(val.gestion);
                });
            }
        }
    });
    // Create a jqxListBox
    $("#listboxGestiones").jqxListBox({width: 200, source: gestiones, checkboxes: true, height: '100%'});
    // Se checkean todos los items por defecto, pues se mostrará el total del historial por defecto.
    if(gestiones.length>0){
        $.each( gestiones, function( key, val ) {
            $("#listboxGestiones").jqxListBox('checkIndex', key);
        });
    }
    if(gestiones.length==1){
        $('#HistorialSplitter').jqxSplitter('collapse');
    }
    $("#listboxGestiones").on('checkChange', function (event) {
        var args = event.args;
        if (args.checked) {
            $("#Events").text("Checked: " + args.label);
        }
        else {
            $("#Events").text("Unchecked: " + args.label);
        }
        var items = $("#listboxGestiones").jqxListBox('getCheckedItems');
        var checkedItems = "";
        $.each(items, function (index) {
            if (index < items.length - 1) {
                checkedItems += this.label + ", ";
            }
            else checkedItems += this.label;
        });
        $("#CheckedItems").text(checkedItems);
    });
}
/**
 * Función para cargar el historial de relación laboral para una persona en particular considerando un gestión específica (Si el valor para el parámetro gestion es mayor a cero)
 * @param idPersona Identificador de la persona de la cual se requiere obtener el historial.
 * @param gestion Gestión específica de la cual se desea obtener la información. En caso de que su valor sea cero el historial mostrará el total del historial.
 */
function cargarHistorialRelacionLaboral(idPersona,gestion){
    var gestiones = [];
    //$('#HistorialTimeLine').html("");
    $.ajax({
        url:'/relaborales/listhistorial',
        type:'POST',
        datatype: 'json',
        async:false,
        cache:false,
        data:{id:idPersona},
        success: function(data) {
            /*var res = jQuery.parseJSON(data);
            if(res.length>0){
                $.each( res, function( key, val ) {
                    //gestiones.push(val.gestion);
                });
            }*/
        }
    });

}
