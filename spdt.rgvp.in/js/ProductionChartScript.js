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
    html += '<td><input type="text" data-type="SKU" name="item[]" id="item_' + i + '" class="form-control autocomplete_txt text-right" autocomplete="off"></td>';
    html += '<td><input type="text" data-type="CodeName" name="itemName[]" id="itemName_' + i + '" class="form-control autocomplete_txt" autocomplete="off"><input type="hidden" name="hsn[]" id="hsncode_' + i + '" class="form-control changesNo text-right" autocomplete="off" readonly="" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
    html += '<td><input type="number" name="quantity[]" id="quantity_' + i + '" class="form-control changesNo text-right" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"><span id="htmlquantityunit_' + i + '"></span><input type="hidden" name="quantityunit[]" id="quantityunit_' + i + '" class="form-control changesNo text-right" autocomplete="off" ondrop="return false;" onpaste="return false;"></td>';
    html += '</tr>';
    $('.table-raw-material').append(html);
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



//For Output Material


//$("#invoice-table-output").keyup(function (e) {
//    if (e.ctrlKey && (e.which == 81 || e.which == 113)) {
//        $('.outputaddmore').click();
//    }
//
//    if (e.ctrlKey && (e.which == 66 || e.which == 98)) {
//        $('.outputdelete').click();
//    }
//});




jQuery("#invoice-table-output").on("keyup", "input[name*='outputrate[]']", function(event){
    event.preventDefault();
    if($(this).val().length == 1) {
        $('.outputaddmore').click();
    }
});




var j = $('#invoice-table-output tr').length;
$(".outputaddmore").on('click', function () {
    var html = "";
    html += '<tr>';
    html += '<td><input class="case" type="checkbox"/></td>';
    html += '<td><input type="text" data-type="SKU" name="outputitem[]" id="outputitem_' + j + '" class="form-control output_autocomplete_txt text-right" autocomplete="off"></td>';
    html += '<td><input type="text" data-type="CodeName" name="outputitemName[]" id="outputitemName_' + j + '" class="form-control output_autocomplete_txt" autocomplete="off"><input type="hidden" name="hsn[]" id="hsncode_' + i + '" class="form-control changesNo text-right" autocomplete="off" readonly="" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
    html += '<td><input type="number" name="outputquantity[]" id="outputquantity_' + j + '" class="form-control changesNo text-right" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"><span id="htmloutputquantityunit_' + i + '"></span><input type="hidden" name="outputquantityunit[]" id="outputquantityunit_' + j + '" class="form-control changesNo text-right" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
    html += '<td><input type="number" name="outputrate[]" id="outputrate_' + j + '" class="form-control changesNo text-right" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
    html += '<td><input type="number" name="outputtotal[]" id="outputtotal_' + j + '" class="form-control totalLinePrice text-right" readonly autocomplete="off" ondrop="return false;" onpaste="return false;"></td>';
    html += '</tr>';
    $('.table-output').append(html);
    // UpdateRows($('#quntity_' + i + ''));
    j++;
});

//to check all checkboxes
$(document).on('change', '#check_all', function () {
    $('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$(".outputdelete").on('click', function () {
    $('.case:checkbox:checked').parents("tr").remove();
    $('#check_all').prop("checked", false);
    calculateTotal();
});



function UpdateRows(object)
{
    id_arr = $(object).attr('id');
    //id_arr = $(object).selector;

    //console.log(object);
    id = id_arr.split("_");
    quantity = $('#outputquantity_' + id[1]).val();
    price = $('#outputrate_' + id[1]).val();


    if (quantity == "NaN" || quantity == "")
        quantity = 0;
    if (price == "NaN" || price == "")
        price = 0;

    taxableamt = (parseFloat(price) * parseFloat(quantity)).toFixed(2);
    $('#taxableamt_' + id[1]).val(taxableamt);


    total = (parseFloat(taxableamt)).toFixed(2);
    $('#outputtotal_' + id[1]).val(total);
    calculateTotal();
}

//price change
$(document).on('change keyup blur', '.changesNo', function () {
    UpdateRows(this);
});


//total price calculation 
function calculateTotal() {

    total = 0;

    $('.totalLinePrice').each(function () {
        if ($(this).val() != '')
            total += parseFloat($(this).val());
    });

//$('#Total')
    $('#total_total').val(total.toFixed(2));
}



