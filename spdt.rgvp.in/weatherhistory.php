<?php
require_once 'include.php';
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <?php include (RGVPAdminThemeHeaderSection); ?>
    </head>
    <body>
        <!--[if lt IE 8]>
                <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
        <?php include (RGVPAdminThemeHeader); ?>
        <!-- Mobile Menu start -->
        <?php include (RGVPAdminThemeFolder . "mobile-navbar.php"); ?>
        <!-- Mobile Menu end -->
        <!-- Main Menu area start-->
        <?php include (RGVPAdminThemeFolder . "navbar.php"); ?>
        <!-- Main Menu area End-->
        <!-- Breadcomb area Start-->
        <div class="breadcomb-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcomb-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="breadcomb-wp">
                                        <div class="breadcomb-icon">
                                            <i class="notika-icon notika-windows"></i>
                                        </div>
                                        <div class="breadcomb-ctn">
                                            <h2>Weather History</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcomb area End-->
        <?php
        if (isset($_REQUEST['msg'])) {
            echo '<br><div class="alert" style="text-align: center; color: #ffffff; background-color: #e53238; border-color: #ffffff;">' . $_REQUEST['msg'] . '<a href="index.php"  style="padding: 5px; background-color: #fff; float:right;">&times;</a></div>';
        }
        ?>
        <div class="data-table-area">
            <div class="data-table-list">
                <div class="">
                    <h2>Weather History Management</h2>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="dynamic-content">
                            <!--dynamic content-->
<button type="button" style="padding:10px; margin:0 50px 15px 0;" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add-modal"><b>Add More Rows</b></button>
            <div class="row">
                <div class="col-md-12 marginT20">
                    <div class="table-responsive demo-x content">
                        <table id="table_weatherhistory" class="display-table table-hover table-bordered" cellspacing="0" width="100%">
                            <thead class="btn-primary">
                                <tr>
                                    <th>ID</th><th>FormattedDate</th><th>Summary</th><th>PrecipType</th><th>Temperature</th><th>ApparentTemperature</th><th>Humidity</th><th>WindSpeed</th><th>WindBearing</th><th>Visibility</th><th>LoudCover</th><th>Pressure</th><th>DailySummary</th>
                                    <th style="background-image: none">Edit</th>
                                </tr>
                            </thead>
                            <tfoot class="btn-primary">
                                <tr>
                                    <th>ID</th><th>FormattedDate</th><th>Summary</th><th>PrecipType</th><th>Temperature</th><th>ApparentTemperature</th><th>Humidity</th><th>WindSpeed</th><th>WindBearing</th><th>Visibility</th><th>LoudCover</th><th>Pressure</th><th>DailySummary</th>
                                    <th style="background-image: none">Edit</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div><div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-label"><div class="container-fluid" role="document"><div class="modal-content"><form name=form_weatherhistory id="add-weatherhistory"><div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="add-modal-label">Add weatherhistory</h4>
                        </div>
<div class="modal-body"><div class="row">

<div class='row'>

</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-FormattedDate" class=" col-sm-12 control-label">FormattedDate</label>
                                <div class="col-sm-12">
                                    <input type="datetime-local" class="form-control" id="add-FormattedDate" name="datetime_FormattedDate" placeholder="Enter FormattedDate" required>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-Summary" class=" col-sm-12 control-label">Summary</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="3000" class="form-control" id="add-Summary" name="txt_Summary" placeholder="Enter Summary" required></textarea>
                                </div></div><div class="form-group col-sm-6">
                                <label for="add-PrecipType" class=" col-sm-12 control-label">PrecipType</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="135" class="form-control" id="add-PrecipType" name="txt_PrecipType" placeholder="Enter PrecipType" required></textarea>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-Temperature" class=" col-sm-12 control-label">Temperature</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="0.00" max="9999999999.999999999" step="1.0E-6" maxlength="21" class="form-control" id="add-Temperature" name="txt_Temperature" placeholder="Enter Temperature"  required>
                                </div></div><div class="form-group col-sm-6">
                                <label for="add-ApparentTemperature" class=" col-sm-12 control-label">ApparentTemperature</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="0.00" max="9999999999.999999999" step="1.0E-6" maxlength="21" class="form-control" id="add-ApparentTemperature" name="txt_ApparentTemperature" placeholder="Enter ApparentTemperature"  required>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-Humidity" class=" col-sm-12 control-label">Humidity</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="0.00" max="999.99" step="0.01" maxlength="7" class="form-control" id="add-Humidity" name="txt_Humidity" placeholder="Enter Humidity"  required>
                                </div></div><div class="form-group col-sm-6">
                                <label for="add-WindSpeed" class=" col-sm-12 control-label">WindSpeed</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="0.00" max="999999.9999" step="0.0001" maxlength="12" class="form-control" id="add-WindSpeed" name="txt_WindSpeed" placeholder="Enter WindSpeed"  required>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-WindBearing" class=" col-sm-12 control-label">WindBearing</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-WindBearing" name="txt_WindBearing" placeholder="Enter WindBearing"  required>
                                </div></div><div class="form-group col-sm-6">
                                <label for="add-Visibility" class=" col-sm-12 control-label">Visibility</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="0.00" max="999999.99999" step="1.0E-6" maxlength="13" class="form-control" id="add-Visibility" name="txt_Visibility" placeholder="Enter Visibility"  required>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-LoudCover" class=" col-sm-12 control-label">LoudCover</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-LoudCover" name="txt_LoudCover" placeholder="Enter LoudCover"  required>
                                </div></div><div class="form-group col-sm-6">
                                <label for="add-Pressure" class=" col-sm-12 control-label">Pressure</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="0.00" max="999999.99" step="0.01" maxlength="10" class="form-control" id="add-Pressure" name="txt_Pressure" placeholder="Enter Pressure"  required>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-DailySummary" class=" col-sm-12 control-label">DailySummary</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="3000" class="form-control" id="add-DailySummary" name="txt_DailySummary" placeholder="Enter DailySummary" required></textarea>
                                </div></div></div></div></div>
<div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary pull-right">Save changes</button>
                        </div></form></div></div></div><div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"><div class="container-fluid" role="document"><div class="modal-content"><form name=form_weatherhistory id="edit-weatherhistory"><div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="edit-modal-label">Edit weatherhistory</h4>
                        </div>
<div class="modal-body">
<div class='row'>

</div>
<div class='row'>
<div class="form-group col-sm-6"><label for="edit-ID" class=" col-sm-12 control-label">ID</label><div class=" col-sm-12"><input type="text" maxlength="11" class="form-control" id="edit-ID" name="txt_ID" placeholder="Unable to Fetch ID" readonly required></div></div><div class="form-group col-sm-6">
                                <label for="add-FormattedDate" class=" col-sm-12 control-label">FormattedDate</label>
                                <div class="col-sm-12">
                                    <input type="datetime-local" class="form-control" id="edit-FormattedDate" name="datetime_FormattedDate" placeholder="Enter FormattedDate" required>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="edit-Summary" class=" col-sm-12 control-label">Summary</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="3000" class="form-control" id="edit-Summary" name="txt_Summary" placeholder="Enter Summary" required></textarea>
                                </div></div><div class="form-group col-sm-6">
                                <label for="edit-PrecipType" class=" col-sm-12 control-label">PrecipType</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="135" class="form-control" id="edit-PrecipType" name="txt_PrecipType" placeholder="Enter PrecipType" required></textarea>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="edit-Temperature" class=" col-sm-12 control-label">Temperature</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="0.00" max="9999999999.999999999" step="1.0E-6" maxlength="21" class="form-control" id="edit-Temperature" name="txt_Temperature" placeholder="Enter Temperature"  required>
                                </div></div><div class="form-group col-sm-6">
                                <label for="edit-ApparentTemperature" class=" col-sm-12 control-label">ApparentTemperature</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="0.00" max="9999999999.999999999" step="1.0E-6" maxlength="21" class="form-control" id="edit-ApparentTemperature" name="txt_ApparentTemperature" placeholder="Enter ApparentTemperature"  required>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="edit-Humidity" class=" col-sm-12 control-label">Humidity</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="0.00" max="999.99" step="0.01" maxlength="7" class="form-control" id="edit-Humidity" name="txt_Humidity" placeholder="Enter Humidity"  required>
                                </div></div><div class="form-group col-sm-6">
                                <label for="edit-WindSpeed" class=" col-sm-12 control-label">WindSpeed</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="0.00" max="999999.9999" step="0.0001" maxlength="12" class="form-control" id="edit-WindSpeed" name="txt_WindSpeed" placeholder="Enter WindSpeed"  required>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="edit-WindBearing" class=" col-sm-12 control-label">WindBearing</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-WindBearing" name="txt_WindBearing" placeholder="Enter WindBearing"  required>
                                </div></div><div class="form-group col-sm-6">
                                <label for="edit-Visibility" class=" col-sm-12 control-label">Visibility</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="0.00" max="999999.99999" step="1.0E-6" maxlength="13" class="form-control" id="edit-Visibility" name="txt_Visibility" placeholder="Enter Visibility"  required>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="edit-LoudCover" class=" col-sm-12 control-label">LoudCover</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-LoudCover" name="txt_LoudCover" placeholder="Enter LoudCover"  required>
                                </div></div><div class="form-group col-sm-6">
                                <label for="edit-Pressure" class=" col-sm-12 control-label">Pressure</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="0.00" max="999999.99" step="0.01" maxlength="10" class="form-control" id="edit-Pressure" name="txt_Pressure" placeholder="Enter Pressure"  required>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="edit-DailySummary" class=" col-sm-12 control-label">DailySummary</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="3000" class="form-control" id="edit-DailySummary" name="txt_DailySummary" placeholder="Enter DailySummary" required></textarea>
                                </div></div></div></div>
<div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary pull-right">Save changes</button>
                        </div></form></div></div></div>
                            <!--dynamic content-->
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- End Footer area-->
        <?php include (RGVPAdminThemeFooter); ?>
        <?php include (RGVPAdminThemeFooterSection); ?>
<script type='text/javascript' language='javascript' class='init'>
                        var action_url= '<?php echo RGVPAdminAPIURL ?>'+'/weatherhistory.php';
        $('btn-reload').on('click', function ()
        {
                // Initialize datatable
                $('#table_weatherhistory').dataTable({
                    'aProcessing': true,
                    'aServerSide': true,
                    'ajax': action_url + '?CommandType=SELECT'
                });            
        });  
        $(document).ready(function () {
            // ATW
                if (top.location.href != location.href)
                    top.location.href = location.href;
                // Initialize datatable
                $('#table_weatherhistory').dataTable({
                    'aProcessing': true,
                    'aServerSide': true,
                    'ajax': action_url + '?CommandType=SELECT'
                }); 
            // Save edited row
                $('#edit-weatherhistory').on('submit', function (event) {
                    event.preventDefault();
                    $.post(action_url + '?CommandType=UPDATE-SAVE&id=' + $('#edit-ID').val(), $(this).serialize(), function (data) {
                        var obj = $.parseJSON(data);
                        var tr = $('a[data-id="row-' + $('#edit-ID').val() + '"]').parent().parent();
                        $('td:eq(0)', tr).html(obj.ID);$('td:eq(1)', tr).html(obj.FormattedDate);$('td:eq(2)', tr).html(obj.Summary);$('td:eq(3)', tr).html(obj.PrecipType);$('td:eq(4)', tr).html(obj.Temperature);$('td:eq(5)', tr).html(obj.ApparentTemperature);$('td:eq(6)', tr).html(obj.Humidity);$('td:eq(7)', tr).html(obj.WindSpeed);$('td:eq(8)', tr).html(obj.WindBearing);$('td:eq(9)', tr).html(obj.Visibility);$('td:eq(10)', tr).html(obj.LoudCover);$('td:eq(11)', tr).html(obj.Pressure);$('td:eq(12)', tr).html(obj.DailySummary);
                        $('#edit-modal').modal('hide');
                    }).fail(function () {
                        alert('Unable to save data, please try again later.');
                    });
                }); 
            // Add new row
                $('#add-weatherhistory').on('submit', function (event) {
                    event.preventDefault();
                    $.post(action_url + '?CommandType=INSERT', $(this).serialize(), function (data) {
                        var obj = $.parseJSON(data);
                        $('#table_weatherhistory tbody tr:last').after('<tr role="row"><td class="sorting_1">' + obj.txt_ID + '</td><td>' + obj.FormattedDate + '</td><td>' + obj.Summary + '</td><td>' + obj.PrecipType + '</td><td>' + obj.Temperature + '</td><td>' + obj.ApparentTemperature + '</td><td>' + obj.Humidity + '</td><td>' + obj.WindSpeed + '</td><td>' + obj.WindBearing + '</td><td>' + obj.Visibility + '</td><td>' + obj.LoudCover + '</td><td>' + obj.Pressure + '</td><td>' + obj.DailySummary + '</td><td><a data-id="row-' + obj.id + '" href="javascript:editRow(' + obj.id + ');" class="btn btn-default btn-sm">edit</a>&nbsp;<a href="javascript:removeRow(' + obj.id + ');" class="btn btn-default btn-sm">remove</a></td></tr>');
                        $('#add-modal').modal('hide');
                    }).fail(function () {
                        alert('Unable to save data, please try again later.'); });
                });
        });
            // Edit row
            function editRow(id) {
                if ('undefined' != typeof id) {
                    $.getJSON(action_url + '?CommandType=SELECT-WITH-ID&id=' + id, function (obj) {
                        $('#edit-ID').val(obj.ID);$('#edit-FormattedDate').val(obj.FormattedDate);$('#edit-Summary').val(obj.Summary);$('#edit-PrecipType').val(obj.PrecipType);$('#edit-Temperature').val(obj.Temperature);$('#edit-ApparentTemperature').val(obj.ApparentTemperature);$('#edit-Humidity').val(obj.Humidity);$('#edit-WindSpeed').val(obj.WindSpeed);$('#edit-WindBearing').val(obj.WindBearing);$('#edit-Visibility').val(obj.Visibility);$('#edit-LoudCover').val(obj.LoudCover);$('#edit-Pressure').val(obj.Pressure);$('#edit-DailySummary').val(obj.DailySummary);
                        $('#edit-modal').modal('show')
                    }).fail(function () {
                        alert('Unable to fetch data, please try again later.')
                    });
                } else
                    alert('Unknown row id.');
            }
            // Remove row
            function removeRow(id) {
                if ('undefined' != typeof id) {
                    $.get(action_url + '?CommandType=DELETE&id=' + id, function () {
                        $('a[data-id="row-' + id + '"]').parent().parent().remove();
                    }).fail(function () {
                        alert('Unable to fetch data, please try again later.')
                    });
                } else
                    alert('Unknown row id.');
            }
</script>
    </body>

</html>
