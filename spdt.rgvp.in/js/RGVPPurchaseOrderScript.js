/**
 * 
 */

//adds extra table rows
var i = $('#invoice-table tr').length;
$(".addmore").on('click', function () {
    var html = "";
    html += '<tr>';
    html += '<td><input class="case" type="checkbox"/></td>';
    html += '<td><input type="hidden" name="itemID[]" id="itemID_' + i + '" class="form-control autocomplete_txt text-right" autocomplete="off"><input type="text" data-type="SKU" name="itemNo[]" id="itemNo_' + i + '" class="form-control autocomplete_txt text-right" autocomplete="off"></td>';
    html += '<td><input type="text" data-type="CodeName" name="itemName[]" id="itemName_' + i + '" class="form-control autocomplete_txt" autocomplete="off"><input type="hidden" name="hsn[]" id="hsncode_' + i + '" class="form-control changesNo text-right" autocomplete="off" readonly="" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
//    html += '<td><input type="number" name="hsn[]" id="hsncode_' + i + '" class="form-control changesNo text-right" autocomplete="off" readonly="" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"><input type="number" name="stock[]" id="stock_' + i + '" class="form-control changesNo text-right" autocomplete="off" readonly="" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
    html += '<td><select name="stock[]" id="stock_' + i + '" class="form-control"></select></td>';
    html += '<td><input type="number" name="quantity[]" id="quantity_' + i + '" class="form-control changesNo text-right" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"><span id="htmlquantityunit_' + i + '"></span><input type="hidden" name="quantityunit[]" id="quantityunit_' + i + '" class="form-control changesNo text-right" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
//    html += '<td><input type="number" name="quantityunit[]" id="quantityunit_' + i + '" class="form-control changesNo text-right" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
    html += '<td><input type="hidden" name="mrp[]" id="mrp_' + i + '" class="form-control changesNo text-right" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"><input type="number" name="rate[]" id="rate_' + i + '" class="form-control changesNo text-right" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
    html += '<td><input type="number" name="discount[]" id="discount_' + i + '" class="form-control changesNo text-right" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
    html += '<td><input type="number" name="taxableamt[]" id="taxableamt_' + i + '" class="form-control changesNo text-right taxableamount" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
    html += '<td class="cgst"><input type="number" name="cgst[]" id="cgst_' + i + '" class="cgstval form-control changesNo text-right" readonly autocomplete="off"  ondrop="return false;" onpaste="return false;">@(<span name="cgstrate[]" id="cgstrate_' + i + '"></span>)</td>';
    html += '<td class="sgst"><input type="number" name="sgst[]" id="sgst_' + i + '" class="sgstval form-control changesNo text-right" readonly autocomplete="off"  ondrop="return false;" onpaste="return false;">@(<span name="sgstrate[]" id="sgstrate_' + i + '"></span>)</td>';
    html += '<td class="igst"><input type="number" name="igst[]" id="igst_' + i + '" class="igstval form-control changesNo text-right" readonly autocomplete="off"  ondrop="return false;" onpaste="return false;">@(<span name="igstrate[]" id="igstrate_' + i + '"></span>)</td>';
    html += '<td class="cess"><input type="number" name="cess[]" id="cess_' + i + '" class="cessval form-control changesNo text-right" readonly autocomplete="off"  ondrop="return false;" onpaste="return false;">@(<span name="cessrate[]" id="cessrate_' + i + '"></span>)</td>';
    html += '<td><input type="hidden" name="GstRate[]" id="GstRate_' + i + '" class="form-control changesNo text-right" readonly autocomplete="off"  ondrop="return false;" onpaste="return false;"><input type="number" name="total[]" id="total_' + i + '" class="form-control totalLinePrice text-right" readonly autocomplete="off" ondrop="return false;" onpaste="return false;"></td>';
    html += '</tr>';
    $('table').append(html);
 //   DisplayTax($('#add-UStateCode').val(), $('#add-PlaceOfSupply').val());
//UpdateRows($('#quntity_' + i + ''));
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
    calculateTotal();
});
/*
 * Tax Fucntion is used to determnine the Tax within state and outside state,i.e., IGST or CGST-SGST
 * @param string UserState It defines the state of the user
 * @param string CustomerState It defines the state of the Customer
 *  
 */
function DisplayTax(UserState, CustomerState)
{
    if (UserState == CustomerState)
    {
        $('.igst').hide();
        $('.cgst, .sgst, .cess').show();
    } else
    {
        $('.cgst, .sgst').hide();
        $('.igst, .cess').show();
    }
}

function UpdateRows(object)
{
    id_arr = $(object).attr('id');
    //id_arr = $(object).selector;
    
    //console.log(object);
    id = id_arr.split("_");
    quantity = $('#quantity_' + id[1]).val();
    price = $('#rate_' + id[1]).val();
    discount = $('#discount_' + id[1]).val();
    
    if (quantity == "NaN" || quantity == "")
        quantity = 0;
    if (price == "NaN" || price == "")
        price = 0;
    if (discount == "NaN" || discount == "")
        discount = 0;
    taxableamt = ((parseFloat(price) - parseFloat(discount)) * parseFloat(quantity)).toFixed(2);
    $('#taxableamt_' + id[1]).val(taxableamt);
    cgst = 0;
    sgst = 0;
    igst = 0;
    cess = 0;
    if ($('#add-CompStateCode').val() == $('#add-PlaceOfSupply').val())
    {
        igst = 0;
        cgst = CalculatePercent(taxableamt, $('#cgstrate_' + id[1]).html().split('%')[0]);
        sgst = (parseFloat($('#sgstrate_' + id[1]).html().split('%')[0]) * parseFloat(taxableamt) / 100).toFixed(2);
        cess = (parseFloat($('#cessrate_' + id[1]).html().split('%')[0]) * parseFloat(taxableamt) / 100).toFixed(2);
    } else {
        cgst = 0;
        sgst = 0;
        igst = (parseFloat($('#igstrate_' + id[1]).html().split('%')[0]) * parseFloat(taxableamt) / 100).toFixed(2);
        cess = (parseFloat($('#cessrate_' + id[1]).html().split('%')[0]) * parseFloat(taxableamt) / 100).toFixed(2);
    }

//console.log(taxableamt + " " + cgst + " " + sgst + " " + igst + " " + cess + " " + total)
    $('#cgst_' + id[1]).val(cgst);
    $('#sgst_' + id[1]).val(sgst);
    $('#igst_' + id[1]).val(igst);
    $('#cess_' + id[1]).val(cess);
    total = (parseFloat(taxableamt) + parseFloat(cgst) + parseFloat(sgst) + parseFloat(igst) + parseFloat(cess)).toFixed(2);
    $('#total_' + id[1]).val(total);
    calculateTotal();
}

//price change
$(document).on('change keyup blur', '.changesNo', function () {
    UpdateRows(this);
});


//total price calculation 
function calculateTotal() {
    subTotal = 0;
    total = 0;
    total_cgst = 0;
    total_sgst = 0;
    total_igst = 0;
    total_cess = 0;
    $('.cgstval').each(function () {
        if ($(this).val() != '')
            total_cgst += parseFloat($(this).val());
    });
    $('.sgstval').each(function () {
        if ($(this).val() != '')
            total_sgst += parseFloat($(this).val());
    });
    $('.igstval').each(function () {
        if ($(this).val() != '')
            total_igst += parseFloat($(this).val());
    });
    $('.cessval').each(function () {
        if ($(this).val() != '')
            total_cess += parseFloat($(this).val());
    });
    $('.taxableamount').each(function () {
        if ($(this).val() != '')
            subTotal += parseFloat($(this).val());
    });
    $('.totalLinePrice').each(function () {
        if ($(this).val() != '')
            total += parseFloat($(this).val());
    });

    $('#total_cgst').val(total_cgst.toFixed(2));
    $('#total_sgst').val(total_sgst.toFixed(2));
    $('#total_igst').val(total_igst.toFixed(2));
    $('#total_cess').val(total_cess.toFixed(2));

    $('#total_taxableamt , #subTotal').val(subTotal.toFixed(2));
//$('#Total')
    tax = total_cgst + total_sgst + total_igst + total_cess;

    var dollar = total / 71.46;

    $('#tax').val(tax.toFixed(2));
    $('#totalAftertax, #total_total').val(total.toFixed(2));
    $('#AmountInDoller').val(dollar.toFixed(2));
    DisplayTax($('#add-CompStateCode').val(), $('#add-PlaceOfSupply').val());
}

//$(document).on('change keyup blur', '#amountPaid', function () {
//    calculateAmountDue();
//});

//It restrict the non-numbers
var specialKeys = new Array();
specialKeys.push(8, 46); //Backspace
function IsNumeric(e) {
    var keyCode = e.which ? e.which : e.keyCode;
    console.log(keyCode);
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;
}
function CalculatePercent(amount, percentvalue)
{
    return parseFloat(parseFloat(amount) * parseFloat(percentvalue) / 100).toFixed(2);
}

