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
                                            <h2>Manage Various DataSets</h2>
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
                                        <table id="table_Datasets" class="display-table table-hover table-bordered" cellspacing="0" width="100%">
                                            <thead class="btn-primary">
                                                <tr>
                                                    <th>DatasetID</th><th>Name</th><th>TableName</th><th>RowsNum</th><th>ColumnNum</th><th>Description</th><th>Attributes</th><th>Output</th><th>UpdateDate</th><th>CreatedDate</th>
                                                    <th style="background-image: none">Edit</th>
                                                </tr>
                                            </thead>
                                            <tfoot class="btn-primary">
                                                <tr>
                                                    <th>DatasetID</th><th>Name</th><th>TableName</th><th>RowsNum</th><th>ColumnNum</th><th>Description</th><th>Attributes</th><th>Output</th><th>UpdateDate</th><th>CreatedDate</th>
                                                    <th style="background-image: none">Edit</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div><div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-label"><div class="container-fluid" role="document"><div class="modal-content"><form name=form_Datasets id="add-Datasets"><div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="add-modal-label">Add Datasets</h4>
                                            </div>
                                            <div class="modal-body"><div class="row">

                                                    <div class='row'>

                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-Name" class=" col-sm-12 control-label">Name</label>
                                                            <div class=" col-sm-12">
                                                                <textarea maxlength="1000" class="form-control" id="add-Name" name="txt_Name" placeholder="Enter Name" required></textarea>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-TableName" class=" col-sm-12 control-label">TableName</label>
                                                            <div class=" col-sm-12">
                                                                <textarea maxlength="1000" class="form-control" id="add-TableName" name="txt_TableName" placeholder="Enter TableName" required></textarea>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-RowsNum" class=" col-sm-12 control-label">RowsNum</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-RowsNum" name="txt_RowsNum" placeholder="Enter RowsNum"  required>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-ColumnNum" class=" col-sm-12 control-label">ColumnNum</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-ColumnNum" name="txt_ColumnNum" placeholder="Enter ColumnNum"  required>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-Description" class=" col-sm-12 control-label">Description</label>
                                                            <div class=" col-sm-12">
                                                                <textarea maxlength="1000" class="form-control" id="add-Description" name="txt_Description" placeholder="Enter Description" required></textarea>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-Attributes" class=" col-sm-12 control-label">Attributes</label>
                                                            <div class=" col-sm-12">
                                                                <textarea maxlength="1000" class="form-control" id="add-Attributes" name="txt_Attributes" placeholder="Enter Attributes" required></textarea>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-Output" class=" col-sm-12 control-label">Output</label>
                                                            <div class=" col-sm-12">
                                                                <textarea maxlength="1000" class="form-control" id="add-Output" name="txt_Output" placeholder="Enter Output" required></textarea>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                    </div></div></div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary pull-right">Save changes</button>
                                            </div></form></div></div></div><div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"><div class="container-fluid" role="document"><div class="modal-content"><form name=form_Datasets id="edit-Datasets"><div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="edit-modal-label">Edit Datasets</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class='row'>

                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6"><label for="edit-DatasetID" class=" col-sm-12 control-label">DatasetID</label><div class=" col-sm-12"><input type="text" maxlength="11" class="form-control" id="edit-DatasetID" name="txt_DatasetID" placeholder="Unable to Fetch DatasetID" readonly required></div></div><div class="form-group col-sm-6">
                                                        <label for="edit-Name" class=" col-sm-12 control-label">Name</label>
                                                        <div class=" col-sm-12">
                                                            <textarea maxlength="1000" class="form-control" id="edit-Name" name="txt_Name" placeholder="Enter Name" required></textarea>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-TableName" class=" col-sm-12 control-label">TableName</label>
                                                        <div class=" col-sm-12">
                                                            <textarea maxlength="1000" class="form-control" id="edit-TableName" name="txt_TableName" placeholder="Enter TableName" required></textarea>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-RowsNum" class=" col-sm-12 control-label">RowsNum</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-RowsNum" name="txt_RowsNum" placeholder="Enter RowsNum"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-ColumnNum" class=" col-sm-12 control-label">ColumnNum</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-ColumnNum" name="txt_ColumnNum" placeholder="Enter ColumnNum"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-Description" class=" col-sm-12 control-label">Description</label>
                                                        <div class=" col-sm-12">
                                                            <textarea maxlength="1000" class="form-control" id="edit-Description" name="txt_Description" placeholder="Enter Description" required></textarea>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-Attributes" class=" col-sm-12 control-label">Attributes</label>
                                                        <div class=" col-sm-12">
                                                            <textarea maxlength="1000" class="form-control" id="edit-Attributes" name="txt_Attributes" placeholder="Enter Attributes" required></textarea>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-Output" class=" col-sm-12 control-label">Output</label>
                                                        <div class=" col-sm-12">
                                                            <textarea maxlength="1000" class="form-control" id="edit-Output" name="txt_Output" placeholder="Enter Output" required></textarea>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                </div></div>
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
            var action_url = '<?php echo RGVPAdminAPIURL ?>' + '/Datasets.php';
            $('btn-reload').on('click', function ()
            {
                // Initialize datatable
                $('#table_Datasets').dataTable({
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
                $('#table_Datasets').dataTable({
                    'aProcessing': true,
                    'aServerSide': true,
                    'ajax': action_url + '?CommandType=SELECT'
                });
                // Save edited row
                $('#edit-Datasets').on('submit', function (event) {
                    event.preventDefault();
                    $.post(action_url + '?CommandType=UPDATE-SAVE&id=' + $('#edit-DatasetID').val(), $(this).serialize(), function (data) {
                        var obj = $.parseJSON(data);
                        var tr = $('a[data-id="row-' + $('#edit-DatasetID').val() + '"]').parent().parent();
                        $('td:eq(0)', tr).html(obj.DatasetID);
                        $('td:eq(1)', tr).html(obj.Name);
                        $('td:eq(2)', tr).html(obj.TableName);
                        $('td:eq(3)', tr).html(obj.RowsNum);
                        $('td:eq(4)', tr).html(obj.ColumnNum);
                        $('td:eq(5)', tr).html(obj.Description);
                        $('td:eq(6)', tr).html(obj.Attributes);
                        $('td:eq(7)', tr).html(obj.Output);
                        $('#edit-modal').modal('hide');
                    }).fail(function () {
                        alert('Unable to save data, please try again later.');
                    });
                });
                // Add new row
                $('#add-Datasets').on('submit', function (event) {
                    event.preventDefault();
                    $.post(action_url + '?CommandType=INSERT', $(this).serialize(), function (data) {
                        var obj = $.parseJSON(data);
                        $('#table_Datasets tbody tr:last').after('<tr role="row"><td class="sorting_1">' + obj.txt_DatasetID + '</td><td>' + obj.Name + '</td><td>' + obj.TableName + '</td><td>' + obj.RowsNum + '</td><td>' + obj.ColumnNum + '</td><td>' + obj.Description + '</td><td>' + obj.Attributes + '</td><td>' + obj.Output + '</td><td><a data-id="row-' + obj.id + '" href="javascript:editRow(' + obj.id + ');" class="btn btn-default btn-sm">edit</a>&nbsp;<a href="javascript:removeRow(' + obj.id + ');" class="btn btn-default btn-sm">remove</a></td></tr>');
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
                        $('#edit-DatasetID').val(obj.DatasetID);
                        $('#edit-Name').val(obj.Name);
                        $('#edit-TableName').val(obj.TableName);
                        $('#edit-RowsNum').val(obj.RowsNum);
                        $('#edit-ColumnNum').val(obj.ColumnNum);
                        $('#edit-Description').val(obj.Description);
                        $('#edit-Attributes').val(obj.Attributes);
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