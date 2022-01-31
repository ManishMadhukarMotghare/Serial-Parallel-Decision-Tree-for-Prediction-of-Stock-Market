/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Used to Fetch Branches as per the BranchType Like BRANCH/HUB/BOTH

function AjaxBranchList(url, BranchType, fillselectid)
{
    if (BranchType != "") {
        $.ajax({
            url: url,
            data: {BranchType: BranchType},
            type: 'GET',
            success: function (response) {
                var output = JSON.parse(response);
                //console.log(response);
                if (output.status == "success") {
                    $(fillselectid).html(output.result.Data);
                    //console.log(response);
                } else {
                    $(fillselectid).html("<option>Unable to fetch data.</option>");
                    //console.log(response);
                }
            }
        });
    } else {
        $(fillselectid).html("<option>Select proper BranchType.</option>");
    }
}
 function JsonToHtmltable(data, classes,elemid)
                {
                    jsondata = JSON.parse(data);
                    console.log(jsondata);
                    var cols = Object.keys(jsondata[0]);
                    var headerrow = '';
                    var footerrow = '';
                    var tablebodyrows = '';

                    classes = classes || '';
                    cols.map(function (col) {
                        headerrow += '<th class="btn-primary" style="color:white;">' + col + '</th>';
                        footerrow += '<th class="btn-primary" style="color:white;">' + col + '</th>';
                    });
                    jsondata.map(function (row) {
                        tablebodyrows += '<tr  style="background-color:white;">';
                        cols.map(function (col) {
                            tablebodyrows += '<td>' + row[col] + '</td>';
                        });
                        tablebodyrows += '</tr>';
                    });
                    return '<table class="' + classes + '" id="' + elemid + '"><thead><tr>' + headerrow + '</tr></thead><tbody>' + tablebodyrows + '</tbody><tfoot><tr>' + footerrow + '</tr></tfoot></table>';
                }

function RGVPValidNos(e, t) {
    try {
        if (window.event) {
            var charCode = window.event.keyCode;
        } else if (e) {
            var charCode = e.which;
        } else {
            return true;
        }
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    } catch (err) {
        alert(err.Description);
    }
}

function CurrencyFormator(x) {
    x = x.toString();
    x = x.replace(/,/g, "");
    var lastThree = x.substring(x.length - 3);
    var otherNumbers = x.substring(0, x.length - 3);
    if (otherNumbers != '')
        lastThree = ',' + lastThree;
    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
    return res;
}
function RGVPReportMsg(Msg, MsgType, MsgTitle, IncludeCloseButton)
{
    var ReturnHTML = "", MsgClass = 'alert-primary', MsgIcon = "fa-check", btnClose = "";
    if (MsgType == "Success") {
        MsgClass = 'alert-success';
        MsgIcon = "fa-check";
    } else if (MsgType == "Failed") {
        MsgClass = 'alert-danger';
        MsgIcon = "fa-ban";
    } else if (MsgType == "Warning") {
        MsgClass = 'alert-warning';
        MsgIcon = "fa-warning";
    } else if (MsgType == "Loading") {
        MsgClass = 'alert-warning';
        MsgIcon = "fa fa-refresh";
    } else if (MsgType == "Info") {
        MsgClass = 'alert-info';
        MsgIcon = "fa-info";
    } else {
        MsgClass = 'alert-success';
        MsgIcon = "fa-check";
    }

    if (MsgTitle != '')
        MsgTitle = '<h4><i class="icon fa ' + MsgIcon + '"></i> ' + MsgTitle + '</h4>';
    else
        MsgTitle = '';

    if (IncludeCloseButton)
        btnClose = '<button class="close" aria-hidden="true" type="button" data-dismiss="alert">×</button>';
    else
        btnClose = '';
    ReturnHTML = '<div class="alert ' + MsgClass + ' alert-dismissible">' + btnClose + MsgTitle + Msg + '</div>';

    return ReturnHTML;
}

function  RGVPCheckDuplicate(mobile, displayclass)
{
    if (mobile.length == 10) {
        Pace.track(function () {
            $.ajax({url: "Actions/CheckDuplicateClientReg.php",
                type: "get",
                data: {"ChkData": mobile, "ChkField": "Mobile", "ChkTable": "client", "ChkReturnID": "X"},
                success: function (response) {
                    // you will get response from your php page (what you echo or print) 
                    if (response == 'true')
                        $(displayclass).html(RGVPReportMsg('Mobile is already registered, Contact Customer Care to restore Account.', 'Failed', 'Already Registered.', false));
                    else
                        $(displayclass).html('');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //$(".preloader").hide();
                    //$("#client_form").hide();
                    $(displayclass).html(textStatus + errorThrown);
                },
                beforeSend: function () {
                    $(displayclass).html('<button type="button" class="btn btn-primary btn-block btn-flat" title="Ajax Response"><i class="fa fa-spin fa-refresh"></i>&nbsp; Processing... </button>')
                }
            });
        });
    }

}

function  RGVPCheckRegistered(mobile, displayclass, storeInputID)
{

    Pace.track(function () {
        $.ajax({url: "RGVP-API/CheckDuplicateClientReg.php",
            type: "POST",
            data: {"ChkData": mobile, "ChkField": "Mobile", "ChkTable": "userdetails", "ChkReturnID": "UserID"},
            success: function (response) {
                // you will get response from your php page (what you echo or print) 
                if (response != 'false') {
                    $(displayclass).html('');
                    $(storeInputID).val(response);
                } else {
                    $(displayclass).html(RGVPReportMsg('Mobile / Email is not registered, Contact Customer Care to restore Account. OR Create New one', 'Warning', 'No Such User.', false));
                    $(storeInputID).val(0);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //$(".preloader").hide();
                //$("#client_form").hide();
                $(displayclass).html(textStatus + errorThrown);
            },
            beforeSend: function () {
                $(displayclass).html('<button type="button" class="btn btn-primary btn-block btn-flat" title="Ajax Response"><i class="fa fa-spin fa-refresh"></i>&nbsp; Processing... </button>')
            }
        });
    });

}