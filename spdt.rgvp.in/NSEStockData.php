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
                                            <h2>NSEStockData</h2>
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

                <div class="container-fluid">
                    <div class="row">
                        <div class="dynamic-content">
                            <!--dynamic content-->
                            <button type="button" style="padding:10px; margin:0 50px 15px 0;" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add-modal"><b>Add More Rows</b></button>
                            <div class="row">
                                <div class="col-md-12 marginT20">
                                    <div class="table-responsive demo-x content">
                                        <table id="table_NSEStockData" class="display-table table-hover table-bordered" cellspacing="0" width="100%">
                                            <thead class="btn-primary">
                                                <tr>
                                                    <th>ID</th><th>Date</th><th>Open</th><th>High</th><th>Low</th><th>Close</th><th>AdjClose</th><th>Volume</th><th>Output</th>
                                                    <th style="background-image: none">Edit</th>
                                                </tr>
                                            </thead>
                                            <tfoot class="btn-primary">
                                                <tr>
                                                    <th>ID</th><th>Date</th><th>Open</th><th>High</th><th>Low</th><th>Close</th><th>AdjClose</th><th>Volume</th><th>Output</th>
                                                    <th style="background-image: none">Edit</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div><div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-label"><div class="container-fluid" role="document"><div class="modal-content"><form name=form_NSEStockData id="add-NSEStockData"><div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="add-modal-label">Add NSEStockData</h4>
                                            </div>
                                            <div class="modal-body"><div class="row">

                                                    <div class='row'>

                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-Date" class=" col-sm-12 control-label">Date</label>
                                                            <div class=" col-sm-12">
                                                                <input type="date" class="form-control" id="add-Date" name="date_Date" placeholder="Enter Date" required>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-Open" class=" col-sm-12 control-label">Open</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="add-Open" name="txt_Open" placeholder="Enter Open"  required>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-High" class=" col-sm-12 control-label">High</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="add-High" name="txt_High" placeholder="Enter High"  required>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-Low" class=" col-sm-12 control-label">Low</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="add-Low" name="txt_Low" placeholder="Enter Low"  required>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-Close" class=" col-sm-12 control-label">Close</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="add-Close" name="txt_Close" placeholder="Enter Close"  required>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-AdjClose" class=" col-sm-12 control-label">AdjClose</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="add-AdjClose" name="txt_AdjClose" placeholder="Enter AdjClose"  required>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-Volume" class=" col-sm-12 control-label">Volume</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0" max="999999999999999999999999" step="1" maxlength="20" class="form-control" id="add-Volume" name="txt_Volume" placeholder="Enter Volume"  required>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-Output" class=" col-sm-12 control-label">Output</label>
                                                            <div class=" col-sm-12">
                                                                <select name="ddl_Output" id="add-Output" class="form-control"><option value="Hold">Hold</option><option value="Buy">Buy</option><option value="Sell">Sell</option></select>
                                                            </div></div></div></div></div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary pull-right">Save changes</button>
                                            </div></form></div></div></div><div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"><div class="container-fluid" role="document"><div class="modal-content"><form name=form_NSEStockData id="edit-NSEStockData"><div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="edit-modal-label">Edit NSEStockData</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class='row'>

                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6"><label for="edit-ID" class=" col-sm-12 control-label">ID</label><div class=" col-sm-12"><input type="text" maxlength="11" class="form-control" id="edit-ID" name="txt_ID" placeholder="Unable to Fetch ID" readonly required></div></div><div class="form-group col-sm-6">
                                                        <label for="edit-Date" class=" col-sm-12 control-label">Date</label>
                                                        <div class=" col-sm-12">
                                                            <input type="date" class="form-control" id="edit-Date" name="date_Date" placeholder="Enter Date" required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-Open" class=" col-sm-12 control-label">Open</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="999999999.99" step="0.01" maxlength="11" class="form-control" id="edit-Open" name="txt_Open" placeholder="Enter Open"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-High" class=" col-sm-12 control-label">High</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="999999999.99" step="0.01" maxlength="11" class="form-control" id="edit-High" name="txt_High" placeholder="Enter High"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-Low" class=" col-sm-12 control-label">Low</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="999999999.99" step="0.01" maxlength="11" class="form-control" id="edit-Low" name="txt_Low" placeholder="Enter Low"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-Close" class=" col-sm-12 control-label">Close</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="999999999.99" step="0.01" maxlength="11" class="form-control" id="edit-Close" name="txt_Close" placeholder="Enter Close"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-AdjClose" class=" col-sm-12 control-label">AdjClose</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="999999999.99" step="0.01" maxlength="11" class="form-control" id="edit-AdjClose" name="txt_AdjClose" placeholder="Enter AdjClose"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-Volume" class=" col-sm-12 control-label">Volume</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0" max="99999999999999999999999" step="1" maxlength="20" class="form-control" id="edit-Volume" name="txt_Volume" placeholder="Enter Volume"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-Output" class=" col-sm-12 control-label">Output</label>
                                                        <div class=" col-sm-12">
                                                            <select name="ddl_Output" id="edit-Output" class="form-control"><option value="Hold">Hold</option><option value="Buy">Buy</option><option value="Sell">Sell</option></select>
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
            var action_url = '<?php echo RGVPAdminAPIURL ?>' + '/NSEStockData.php';
            $('btn-reload').on('click', function ()
            {
                // Initialize datatable
                $('#table_NSEStockData').dataTable({
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
                $('#table_NSEStockData').dataTable({
                    'aProcessing': true,
                    'aServerSide': true,
                    'ajax': action_url + '?CommandType=SELECT'
                });
                // Save edited row
                $('#edit-NSEStockData').on('submit', function (event) {
                    event.preventDefault();
                    $.post(action_url + '?CommandType=UPDATE-SAVE&id=' + $('#edit-ID').val(), $(this).serialize(), function (data) {
                        var obj = $.parseJSON(data);
                        var tr = $('a[data-id="row-' + $('#edit-ID').val() + '"]').parent().parent();
                        $('td:eq(0)', tr).html(obj.ID);
                        $('td:eq(1)', tr).html(obj.Date);
                        $('td:eq(2)', tr).html(obj.Open);
                        $('td:eq(3)', tr).html(obj.High);
                        $('td:eq(4)', tr).html(obj.Low);
                        $('td:eq(5)', tr).html(obj.Close);
                        $('td:eq(6)', tr).html(obj.AdjClose);
                        $('td:eq(7)', tr).html(obj.Volume);
                        $('td:eq(8)', tr).html(obj.Output);
                        $('#edit-modal').modal('hide');
                    }).fail(function () {
                        alert('Unable to save data, please try again later.');
                    });
                });
                // Add new row
                $('#add-NSEStockData').on('submit', function (event) {
                    event.preventDefault();
                    $.post(action_url + '?CommandType=INSERT', $(this).serialize(), function (data) {
                        var obj = $.parseJSON(data);
                        $('#table_NSEStockData tbody tr:last').after('<tr role="row"><td class="sorting_1">' + obj.txt_ID + '</td><td>' + obj.Date + '</td><td>' + obj.Open + '</td><td>' + obj.High + '</td><td>' + obj.Low + '</td><td>' + obj.Close + '</td><td>' + obj.AdjClose + '</td><td>' + obj.Volume + '</td><td>' + obj.Output + '</td><td><a data-id="row-' + obj.id + '" href="javascript:editRow(' + obj.id + ');" class="btn btn-default btn-sm">edit</a>&nbsp;<a href="javascript:removeRow(' + obj.id + ');" class="btn btn-default btn-sm">remove</a></td></tr>');
                        $('#add-modal').modal('hide');
                    }).fail(function () {
                        alert('Unable to save data, please try again later.');
                    });
                });
            });
            // Edit row
            function editRow(id) {
                if ('undefined' != typeof id) {
                    $.getJSON(action_url + '?CommandType=SELECT-WITH-ID&id=' + id, function (obj) {
                        $('#edit-ID').val(obj.ID);
                        $('#edit-Date').val(obj.Date);
                        $('#edit-Open').val(obj.Open);
                        $('#edit-High').val(obj.High);
                        $('#edit-Low').val(obj.Low);
                        $('#edit-Close').val(obj.Close);
                        $('#edit-AdjClose').val(obj.AdjClose);
                        $('#edit-Volume').val(obj.Volume);
                        $('#edit-Output').val(obj.Output);
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