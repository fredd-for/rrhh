function cargarHistorialRelaboral(){
    var source = [
        "2012",
        "2013",
        "2014"
    ];
    // Create a jqxListBox
    $("#listboxGestiones").jqxListBox({width: 200, source: source, checkboxes: true, height: '100%'});
    // Check several items.
    $("#listboxGestiones").jqxListBox('checkIndex', 0);
    $("#listboxGestiones").jqxListBox('checkIndex', 1);
    $("#listboxGestiones").jqxListBox('checkIndex', 2);
    $("#listboxGestiones").jqxListBox('checkIndex', 5);
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
