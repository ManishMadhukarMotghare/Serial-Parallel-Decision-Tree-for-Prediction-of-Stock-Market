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
                                            <h2>INTERNET DATASET</h2>
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
                    <h2>Internet Dataset Management</h2>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="dynamic-content">
                            <!--dynamic content-->
<button type="button" style="padding:10px; margin:0 50px 15px 0;" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add-modal"><b>Add More Rows</b></button>
            <div class="row">
                <div class="col-md-12 marginT20">
                    <div class="table-responsive demo-x content">
                        <table id="table_internetdataset" class="display-table table-hover table-bordered" cellspacing="0" width="100%">
                            <thead class="btn-primary">
                                <tr>
                                    <th>ID</th><th>SourceID</th><th>Sourcename</th><th>Author</th><th>Title</th><th>Description</th><th>Url</th><th>UrlToImage</th><th>PublishedAt</th><th>Content</th><th>TopArticle</th><th>EngagementReactionCount</th><th>EngagementCommentCount</th><th>EngagementShareCount</th><th>EngagementCommentPluginCount</th>
                                    <th style="background-image: none">Edit</th>
                                </tr>
                            </thead>
                            <tfoot class="btn-primary">
                                <tr>
                                    <th>ID</th><th>SourceID</th><th>Sourcename</th><th>Author</th><th>Title</th><th>Description</th><th>Url</th><th>UrlToImage</th><th>PublishedAt</th><th>Content</th><th>TopArticle</th><th>EngagementReactionCount</th><th>EngagementCommentCount</th><th>EngagementShareCount</th><th>EngagementCommentPluginCount</th>
                                    <th style="background-image: none">Edit</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div><div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-label"><div class="container-fluid" role="document"><div class="modal-content"><form name=form_internetdataset id="add-internetdataset"><div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="add-modal-label">Add internetdataset</h4>
                        </div>
<div class="modal-body"><div class="row">

<div class='row'>

</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-SourceID" class=" col-sm-12 control-label">SourceID</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="1200" class="form-control" id="add-SourceID" name="txt_SourceID" placeholder="Enter SourceID" required></textarea>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-Sourcename" class=" col-sm-12 control-label">Sourcename</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="1500" class="form-control" id="add-Sourcename" name="txt_Sourcename" placeholder="Enter Sourcename" required></textarea>
                                </div></div><div class="form-group col-sm-6">
                                <label for="add-Author" class=" col-sm-12 control-label">Author</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="1500" class="form-control" id="add-Author" name="txt_Author" placeholder="Enter Author" required></textarea>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-Title" class=" col-sm-12 control-label">Title</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="1500" class="form-control" id="add-Title" name="txt_Title" placeholder="Enter Title" required></textarea>
                                </div></div><div class="form-group col-sm-6">
                                <label for="add-Description" class=" col-sm-12 control-label">Description</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="3000" class="form-control" id="add-Description" name="txt_Description" placeholder="Enter Description" required></textarea>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-Url" class=" col-sm-12 control-label">Url</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="1500" class="form-control" id="add-Url" name="txt_Url" placeholder="Enter Url" required></textarea>
                                </div></div><div class="form-group col-sm-6">
                                <label for="add-UrlToImage" class=" col-sm-12 control-label">UrlToImage</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="6144" class="form-control" id="add-UrlToImage" name="txt_UrlToImage" placeholder="Enter UrlToImage" required></textarea>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-PublishedAt" class=" col-sm-12 control-label">PublishedAt</label>
                                <div class="col-sm-12">
                                    <input type="datetime-local" class="form-control" id="add-PublishedAt" name="datetime_PublishedAt" placeholder="Enter PublishedAt" required>
                                </div></div><div class="form-group col-sm-6">
                                <label for="add-Content" class=" col-sm-12 control-label">Content</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="1500" class="form-control" id="add-Content" name="txt_Content" placeholder="Enter Content" required></textarea>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-TopArticle" class=" col-sm-12 control-label">TopArticle</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-TopArticle" name="txt_TopArticle" placeholder="Enter TopArticle"  required>
                                </div></div><div class="form-group col-sm-6">
                                <label for="add-EngagementReactionCount" class=" col-sm-12 control-label">EngagementReactionCount</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-EngagementReactionCount" name="txt_EngagementReactionCount" placeholder="Enter EngagementReactionCount"  required>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-EngagementCommentCount" class=" col-sm-12 control-label">EngagementCommentCount</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-EngagementCommentCount" name="txt_EngagementCommentCount" placeholder="Enter EngagementCommentCount"  required>
                                </div></div><div class="form-group col-sm-6">
                                <label for="add-EngagementShareCount" class=" col-sm-12 control-label">EngagementShareCount</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-EngagementShareCount" name="txt_EngagementShareCount" placeholder="Enter EngagementShareCount"  required>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-EngagementCommentPluginCount" class=" col-sm-12 control-label">EngagementCommentPluginCount</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-EngagementCommentPluginCount" name="txt_EngagementCommentPluginCount" placeholder="Enter EngagementCommentPluginCount"  required>
                                </div></div></div></div></div>
<div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary pull-right">Save changes</button>
                        </div></form></div></div></div><div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"><div class="container-fluid" role="document"><div class="modal-content"><form name=form_internetdataset id="edit-internetdataset"><div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="edit-modal-label">Edit internetdataset</h4>
                        </div>
<div class="modal-body">
<div class='row'>

</div>
<div class='row'>
<div class="form-group col-sm-6"><label for="edit-ID" class=" col-sm-12 control-label">ID</label><div class=" col-sm-12"><input type="text" maxlength="11" class="form-control" id="edit-ID" name="txt_ID" placeholder="Unable to Fetch ID" readonly required></div></div><div class="form-group col-sm-6">
                                <label for="edit-SourceID" class=" col-sm-12 control-label">SourceID</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="1200" class="form-control" id="edit-SourceID" name="txt_SourceID" placeholder="Enter SourceID" required></textarea>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="edit-Sourcename" class=" col-sm-12 control-label">Sourcename</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="1500" class="form-control" id="edit-Sourcename" name="txt_Sourcename" placeholder="Enter Sourcename" required></textarea>
                                </div></div><div class="form-group col-sm-6">
                                <label for="edit-Author" class=" col-sm-12 control-label">Author</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="1500" class="form-control" id="edit-Author" name="txt_Author" placeholder="Enter Author" required></textarea>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="edit-Title" class=" col-sm-12 control-label">Title</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="1500" class="form-control" id="edit-Title" name="txt_Title" placeholder="Enter Title" required></textarea>
                                </div></div><div class="form-group col-sm-6">
                                <label for="edit-Description" class=" col-sm-12 control-label">Description</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="3000" class="form-control" id="edit-Description" name="txt_Description" placeholder="Enter Description" required></textarea>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="edit-Url" class=" col-sm-12 control-label">Url</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="1500" class="form-control" id="edit-Url" name="txt_Url" placeholder="Enter Url" required></textarea>
                                </div></div><div class="form-group col-sm-6">
                                <label for="edit-UrlToImage" class=" col-sm-12 control-label">UrlToImage</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="6144" class="form-control" id="edit-UrlToImage" name="txt_UrlToImage" placeholder="Enter UrlToImage" required></textarea>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="add-PublishedAt" class=" col-sm-12 control-label">PublishedAt</label>
                                <div class="col-sm-12">
                                    <input type="datetime-local" class="form-control" id="edit-PublishedAt" name="datetime_PublishedAt" placeholder="Enter PublishedAt" required>
                                </div></div><div class="form-group col-sm-6">
                                <label for="edit-Content" class=" col-sm-12 control-label">Content</label>
                                <div class=" col-sm-12">
                                    <textarea maxlength="1500" class="form-control" id="edit-Content" name="txt_Content" placeholder="Enter Content" required></textarea>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="edit-TopArticle" class=" col-sm-12 control-label">TopArticle</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-TopArticle" name="txt_TopArticle" placeholder="Enter TopArticle"  required>
                                </div></div><div class="form-group col-sm-6">
                                <label for="edit-EngagementReactionCount" class=" col-sm-12 control-label">EngagementReactionCount</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-EngagementReactionCount" name="txt_EngagementReactionCount" placeholder="Enter EngagementReactionCount"  required>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="edit-EngagementCommentCount" class=" col-sm-12 control-label">EngagementCommentCount</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-EngagementCommentCount" name="txt_EngagementCommentCount" placeholder="Enter EngagementCommentCount"  required>
                                </div></div><div class="form-group col-sm-6">
                                <label for="edit-EngagementShareCount" class=" col-sm-12 control-label">EngagementShareCount</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-EngagementShareCount" name="txt_EngagementShareCount" placeholder="Enter EngagementShareCount"  required>
                                </div></div>
</div>
<div class='row'>
<div class="form-group col-sm-6">
                                <label for="edit-EngagementCommentPluginCount" class=" col-sm-12 control-label">EngagementCommentPluginCount</label>
                                <div class=" col-sm-12">
                                    <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-EngagementCommentPluginCount" name="txt_EngagementCommentPluginCount" placeholder="Enter EngagementCommentPluginCount"  required>
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
                        var action_url= '<?php echo RGVPAdminAPIURL ?>'+'/internetdataset.php';
        $('btn-reload').on('click', function ()
        {
                // Initialize datatable
                $('#table_internetdataset').dataTable({
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
                $('#table_internetdataset').dataTable({
                    'aProcessing': true,
                    'aServerSide': true,
                    'ajax': action_url + '?CommandType=SELECT'
                }); 
            // Save edited row
                $('#edit-internetdataset').on('submit', function (event) {
                    event.preventDefault();
                    $.post(action_url + '?CommandType=UPDATE-SAVE&id=' + $('#edit-ID').val(), $(this).serialize(), function (data) {
                        var obj = $.parseJSON(data);
                        var tr = $('a[data-id="row-' + $('#edit-ID').val() + '"]').parent().parent();
                        $('td:eq(0)', tr).html(obj.ID);$('td:eq(1)', tr).html(obj.SourceID);$('td:eq(2)', tr).html(obj.Sourcename);$('td:eq(3)', tr).html(obj.Author);$('td:eq(4)', tr).html(obj.Title);$('td:eq(5)', tr).html(obj.Description);$('td:eq(6)', tr).html(obj.Url);$('td:eq(7)', tr).html(obj.UrlToImage);$('td:eq(8)', tr).html(obj.PublishedAt);$('td:eq(9)', tr).html(obj.Content);$('td:eq(10)', tr).html(obj.TopArticle);$('td:eq(11)', tr).html(obj.EngagementReactionCount);$('td:eq(12)', tr).html(obj.EngagementCommentCount);$('td:eq(13)', tr).html(obj.EngagementShareCount);$('td:eq(14)', tr).html(obj.EngagementCommentPluginCount);
                        $('#edit-modal').modal('hide');
                    }).fail(function () {
                        alert('Unable to save data, please try again later.');
                    });
                }); 
            // Add new row
                $('#add-internetdataset').on('submit', function (event) {
                    event.preventDefault();
                    $.post(action_url + '?CommandType=INSERT', $(this).serialize(), function (data) {
                        var obj = $.parseJSON(data);
                        $('#table_internetdataset tbody tr:last').after('<tr role="row"><td class="sorting_1">' + obj.txt_ID + '</td><td>' + obj.SourceID + '</td><td>' + obj.Sourcename + '</td><td>' + obj.Author + '</td><td>' + obj.Title + '</td><td>' + obj.Description + '</td><td>' + obj.Url + '</td><td>' + obj.UrlToImage + '</td><td>' + obj.PublishedAt + '</td><td>' + obj.Content + '</td><td>' + obj.TopArticle + '</td><td>' + obj.EngagementReactionCount + '</td><td>' + obj.EngagementCommentCount + '</td><td>' + obj.EngagementShareCount + '</td><td>' + obj.EngagementCommentPluginCount + '</td><td><a data-id="row-' + obj.id + '" href="javascript:editRow(' + obj.id + ');" class="btn btn-default btn-sm">edit</a>&nbsp;<a href="javascript:removeRow(' + obj.id + ');" class="btn btn-default btn-sm">remove</a></td></tr>');
                        $('#add-modal').modal('hide');
                    }).fail(function () {
                        alert('Unable to save data, please try again later.'); });
                });
        });
            // Edit row
            function editRow(id) {
                if ('undefined' != typeof id) {
                    $.getJSON(action_url + '?CommandType=SELECT-WITH-ID&id=' + id, function (obj) {
                        $('#edit-ID').val(obj.ID);$('#edit-SourceID').val(obj.SourceID);$('#edit-Sourcename').val(obj.Sourcename);$('#edit-Author').val(obj.Author);$('#edit-Title').val(obj.Title);$('#edit-Description').val(obj.Description);$('#edit-Url').val(obj.Url);$('#edit-UrlToImage').val(obj.UrlToImage);$('#edit-PublishedAt').val(obj.PublishedAt);$('#edit-Content').val(obj.Content);$('#edit-TopArticle').val(obj.TopArticle);$('#edit-EngagementReactionCount').val(obj.EngagementReactionCount);$('#edit-EngagementCommentCount').val(obj.EngagementCommentCount);$('#edit-EngagementShareCount').val(obj.EngagementShareCount);$('#edit-EngagementCommentPluginCount').val(obj.EngagementCommentPluginCount);
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
