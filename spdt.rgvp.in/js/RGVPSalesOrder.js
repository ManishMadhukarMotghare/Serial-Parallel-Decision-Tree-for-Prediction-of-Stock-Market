/**
 * 
 */
//For Raw Material


$("#invoice-table").keyup(function (e) {
    if (e.ctrlKey && (e.which == 81 || e.which == 113)) {
        $('.addmore').click();
    }

    if (e.ctrlKey && (e.which == 66 || e.which == 98)) {
        $('.delete').click();
    }
});



//adds extra table rows
var i = $('#invoice-table tr').length;
$(".addmore").on('click', function () {
    var html = "";
    html += '<tr>';
    html += '<td><input class="case" type="checkbox"/></td>';
    html += '<td><input type="text" data-type="SKU" name="item[]" id="item_' + i + '" class="form-control autocomplete_txt" autocomplete="off"></td>';
    html += '<td><input type="text" data-type="CodeName" name="itemName[]" id="itemName_' + i + '" class="form-control autocomplete_txt" autocomplete="off"></td>';
    html += '<td><input type="number" name="quantity[]" id="quantity_' + i + '" class="form-control changesNo text-right" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"><span id="htmlquantityunit_' + i + '"></span><input type="hidden" name="quantityunit[]" id="quantityunit_' + i + '" class="form-control changesNo text-right" autocomplete="off" ondrop="return false;" onpaste="return false;"></td>';
    html += '<td><input type="number" step="0.01" name="rate[]" id="rate_' + i + '" class="form-control changesNo text-right" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
    html += '</tr>';
    $('.table').append(html);
    // UpdateRows($('#quntity_' + i + ''));
    i++;
});

//to check all checkboxes
$(document).on('change', '#check_all', function () {
    $('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$(".delete").on('click', function () {
    $('.case:checkbox:checked').parents("tr").remove();
    $('#check_all').prop("checked", false);

});



