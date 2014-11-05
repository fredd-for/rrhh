/*
 *   Oasis - Sistema de Gestión para Recursos Humanos
 *   Empresa Estatal de Transporte por Cable "Mi Teleférico"
 *   Versión:  1.0.0
 *   Usuario Creador: Lic. Javier Loza
 *   Fecha Creación:  05-11-2014
 */
function cargarHistorialRelaboral(idPersona){
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
