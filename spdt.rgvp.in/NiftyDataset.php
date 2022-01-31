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
                                            <h2>NiftyDataset</h2>
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
                            <button type="button" style="padding:10px; margin:0 50px 15px 0;" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add-modal"><b>Add More Rows</b></button>
                            <div class="row">
                                <div class="col-md-12 marginT20">
                                    <div class="table-responsive demo-x content">
                                        <table id="table_NiftyDataset" class="display-table table-hover table-bordered" cellspacing="0" width="100%">
                                            <thead class="btn-primary">
                                                <tr>
                                                    <th>ID</th><th>Nifty50</th><th>SGXNifty</th><th>DJIA30</th><th>Nasdaq100</th><th>Russel2000</th><th>SnP500</th><th>FTSE100</th><th>Nikkei225</th><th>CAC40</th><th>DAX30</th><th>HangSeng</th><th>SSE180</th><th>MCXBulldex</th><th>GoldFutureIndia</th><th>CrudeOil</th><th>WebInfoData</th><th>IndianTVNews</th><th>SocialMediaFeed</th><th>BrokeragesHouseNews</th><th>FIISData</th><th>DIISData</th><th>GlobalTrend</th><th>Nifty50WeeklyExpiry</th><th>Nifty50MonthlyExpiry</th><th>PandemicWarSituation</th><th>Output</th>
                                                    <th style="background-image: none">Edit</th>
                                                </tr>
                                            </thead>
                                            <tfoot class="btn-primary">
                                                <tr>
                                                    <th>ID</th><th>Nifty50</th><th>SGXNifty</th><th>DJIA30</th><th>Nasdaq100</th><th>Russel2000</th><th>SnP500</th><th>FTSE100</th><th>Nikkei225</th><th>CAC40</th><th>DAX30</th><th>HangSeng</th><th>SSE180</th><th>MCXBulldex</th><th>GoldFutureIndia</th><th>CrudeOil</th><th>WebInfoData</th><th>IndianTVNews</th><th>SocialMediaFeed</th><th>BrokeragesHouseNews</th><th>FIISData</th><th>DIISData</th><th>GlobalTrend</th><th>Nifty50WeeklyExpiry</th><th>Nifty50MonthlyExpiry</th><th>PandemicWarSituation</th><th>Output</th>
                                                    <th style="background-image: none">Edit</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div><div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-label"><div class="container-fluid" role="document"><div class="modal-content"><form name=form_NiftyDataset id="add-NiftyDataset"><div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="add-modal-label">Add NiftyDataset</h4>
                                            </div>
                                            <div class="modal-body"><div class="row">

                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-Nifty50" class=" col-sm-12 control-label">Nifty50</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="add-Nifty50" name="txt_Nifty50" placeholder="Enter Nifty50"  required>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-SGXNifty" class=" col-sm-12 control-label">SGXNifty</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="add-SGXNifty" name="txt_SGXNifty" placeholder="Enter SGXNifty"  required>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-DJIA30" class=" col-sm-12 control-label">DJIA30</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="add-DJIA30" name="txt_DJIA30" placeholder="Enter DJIA30"  required>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-Nasdaq100" class=" col-sm-12 control-label">Nasdaq100</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="add-Nasdaq100" name="txt_Nasdaq100" placeholder="Enter Nasdaq100"  required>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-Russel2000" class=" col-sm-12 control-label">Russel2000</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="999999.99" step="0.01" maxlength="10" class="form-control" id="add-Russel2000" name="txt_Russel2000" placeholder="Enter Russel2000"  required>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-SnP500" class=" col-sm-12 control-label">SnP500</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="999999.99" step="0.01" maxlength="10" class="form-control" id="add-SnP500" name="txt_SnP500" placeholder="Enter SnP500"  required>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-FTSE100" class=" col-sm-12 control-label">FTSE100</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="999999.99" step="0.01" maxlength="10" class="form-control" id="add-FTSE100" name="txt_FTSE100" placeholder="Enter FTSE100"  required>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-Nikkei225" class=" col-sm-12 control-label">Nikkei225</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="add-Nikkei225" name="txt_Nikkei225" placeholder="Enter Nikkei225"  required>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-CAC40" class=" col-sm-12 control-label">CAC40</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="999999.99" step="0.01" maxlength="10" class="form-control" id="add-CAC40" name="txt_CAC40" placeholder="Enter CAC40"  required>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-DAX30" class=" col-sm-12 control-label">DAX30</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="9999.99" step="0.01" maxlength="8" class="form-control" id="add-DAX30" name="txt_DAX30" placeholder="Enter DAX30"  required>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-HangSeng" class=" col-sm-12 control-label">HangSeng</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="add-HangSeng" name="txt_HangSeng" placeholder="Enter HangSeng"  required>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-SSE180" class=" col-sm-12 control-label">SSE180</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="add-SSE180" name="txt_SSE180" placeholder="Enter SSE180"  required>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-MCXBulldex" class=" col-sm-12 control-label">MCXBulldex</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="999999.99" step="0.01" maxlength="10" class="form-control" id="add-MCXBulldex" name="txt_MCXBulldex" placeholder="Enter MCXBulldex"  required>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-GoldFutureIndia" class=" col-sm-12 control-label">GoldFutureIndia</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="add-GoldFutureIndia" name="txt_GoldFutureIndia" placeholder="Enter GoldFutureIndia"  required>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-CrudeOil" class=" col-sm-12 control-label">CrudeOil</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="0.00" max="9999.99" step="0.01" maxlength="8" class="form-control" id="add-CrudeOil" name="txt_CrudeOil" placeholder="Enter CrudeOil"  required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-WebInfoData" class=" col-sm-12 control-label">WebInfoData</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-WebInfoData" name="txt_WebInfoData" placeholder="Enter WebInfoData"  required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-IndianTVNews" class=" col-sm-12 control-label">IndianTVNews</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-IndianTVNews" name="txt_IndianTVNews" placeholder="Enter IndianTVNews"  required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-SocialMediaFeed" class=" col-sm-12 control-label">SocialMediaFeed</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-SocialMediaFeed" name="txt_SocialMediaFeed" placeholder="Enter SocialMediaFeed"  required>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-BrokeragesHouseNews" class=" col-sm-12 control-label">BrokeragesHouseNews</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-BrokeragesHouseNews" name="txt_BrokeragesHouseNews" placeholder="Enter BrokeragesHouseNews"  required>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-FIISData" class=" col-sm-12 control-label">FIISData</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-FIISData" name="txt_FIISData" placeholder="Enter FIISData"  required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-DIISData" class=" col-sm-12 control-label">DIISData</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-DIISData" name="txt_DIISData" placeholder="Enter DIISData"  required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-GlobalTrend" class=" col-sm-12 control-label">GlobalTrend</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-GlobalTrend" name="txt_GlobalTrend" placeholder="Enter GlobalTrend"  required>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-Nifty50WeeklyExpiry" class=" col-sm-12 control-label">Nifty50WeeklyExpiry</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-Nifty50WeeklyExpiry" name="txt_Nifty50WeeklyExpiry" placeholder="Enter Nifty50WeeklyExpiry"  required>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-Nifty50MonthlyExpiry" class=" col-sm-12 control-label">Nifty50MonthlyExpiry</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-Nifty50MonthlyExpiry" name="txt_Nifty50MonthlyExpiry" placeholder="Enter Nifty50MonthlyExpiry"  required>
                                                            </div></div><div class="form-group col-sm-6">
                                                            <label for="add-PandemicWarSituation" class=" col-sm-12 control-label">PandemicWarSituation</label>
                                                            <div class=" col-sm-12">
                                                                <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="add-PandemicWarSituation" name="txt_PandemicWarSituation" placeholder="Enter PandemicWarSituation"  required>
                                                            </div></div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class="form-group col-sm-6">
                                                            <label for="add-Output" class=" col-sm-12 control-label">Output</label>
                                                            <div class=" col-sm-12">
                                                                <input type="text" maxlength="12" class="form-control" id="add-Output" name="txt_Output" placeholder="Enter Output" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary pull-right">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"><div class="container-fluid" role="document"><div class="modal-content"><form name=form_NiftyDataset id="edit-NiftyDataset"><div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="edit-modal-label">Edit NiftyDataset</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class='row'>

                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6"><label for="edit-ID" class=" col-sm-12 control-label">ID</label><div class=" col-sm-12"><input type="text" maxlength="11" class="form-control" id="edit-ID" name="txt_ID" placeholder="Unable to Fetch ID" readonly required></div></div><div class="form-group col-sm-6">
                                                        <label for="edit-Nifty50" class=" col-sm-12 control-label">Nifty50</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="edit-Nifty50" name="txt_Nifty50" placeholder="Enter Nifty50"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-SGXNifty" class=" col-sm-12 control-label">SGXNifty</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="edit-SGXNifty" name="txt_SGXNifty" placeholder="Enter SGXNifty"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-DJIA30" class=" col-sm-12 control-label">DJIA30</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="edit-DJIA30" name="txt_DJIA30" placeholder="Enter DJIA30"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-Nasdaq100" class=" col-sm-12 control-label">Nasdaq100</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="edit-Nasdaq100" name="txt_Nasdaq100" placeholder="Enter Nasdaq100"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-Russel2000" class=" col-sm-12 control-label">Russel2000</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="999999.99" step="0.01" maxlength="10" class="form-control" id="edit-Russel2000" name="txt_Russel2000" placeholder="Enter Russel2000"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-SnP500" class=" col-sm-12 control-label">SnP500</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="999999.99" step="0.01" maxlength="10" class="form-control" id="edit-SnP500" name="txt_SnP500" placeholder="Enter SnP500"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-FTSE100" class=" col-sm-12 control-label">FTSE100</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="999999.99" step="0.01" maxlength="10" class="form-control" id="edit-FTSE100" name="txt_FTSE100" placeholder="Enter FTSE100"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-Nikkei225" class=" col-sm-12 control-label">Nikkei225</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="edit-Nikkei225" name="txt_Nikkei225" placeholder="Enter Nikkei225"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-CAC40" class=" col-sm-12 control-label">CAC40</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="999999.99" step="0.01" maxlength="10" class="form-control" id="edit-CAC40" name="txt_CAC40" placeholder="Enter CAC40"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-DAX30" class=" col-sm-12 control-label">DAX30</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="9999.99" step="0.01" maxlength="8" class="form-control" id="edit-DAX30" name="txt_DAX30" placeholder="Enter DAX30"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-HangSeng" class=" col-sm-12 control-label">HangSeng</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="edit-HangSeng" name="txt_HangSeng" placeholder="Enter HangSeng"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-SSE180" class=" col-sm-12 control-label">SSE180</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="edit-SSE180" name="txt_SSE180" placeholder="Enter SSE180"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-MCXBulldex" class=" col-sm-12 control-label">MCXBulldex</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="999999.99" step="0.01" maxlength="10" class="form-control" id="edit-MCXBulldex" name="txt_MCXBulldex" placeholder="Enter MCXBulldex"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-GoldFutureIndia" class=" col-sm-12 control-label">GoldFutureIndia</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="9999999.99" step="0.01" maxlength="11" class="form-control" id="edit-GoldFutureIndia" name="txt_GoldFutureIndia" placeholder="Enter GoldFutureIndia"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-CrudeOil" class=" col-sm-12 control-label">CrudeOil</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="0.00" max="9999.99" step="0.01" maxlength="8" class="form-control" id="edit-CrudeOil" name="txt_CrudeOil" placeholder="Enter CrudeOil"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-WebInfoData" class=" col-sm-12 control-label">WebInfoData</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-WebInfoData" name="txt_WebInfoData" placeholder="Enter WebInfoData"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-IndianTVNews" class=" col-sm-12 control-label">IndianTVNews</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-IndianTVNews" name="txt_IndianTVNews" placeholder="Enter IndianTVNews"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-SocialMediaFeed" class=" col-sm-12 control-label">SocialMediaFeed</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-SocialMediaFeed" name="txt_SocialMediaFeed" placeholder="Enter SocialMediaFeed"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-BrokeragesHouseNews" class=" col-sm-12 control-label">BrokeragesHouseNews</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-BrokeragesHouseNews" name="txt_BrokeragesHouseNews" placeholder="Enter BrokeragesHouseNews"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-FIISData" class=" col-sm-12 control-label">FIISData</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-FIISData" name="txt_FIISData" placeholder="Enter FIISData"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-DIISData" class=" col-sm-12 control-label">DIISData</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-DIISData" name="txt_DIISData" placeholder="Enter DIISData"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-GlobalTrend" class=" col-sm-12 control-label">GlobalTrend</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-GlobalTrend" name="txt_GlobalTrend" placeholder="Enter GlobalTrend"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-Nifty50WeeklyExpiry" class=" col-sm-12 control-label">Nifty50WeeklyExpiry</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-Nifty50WeeklyExpiry" name="txt_Nifty50WeeklyExpiry" placeholder="Enter Nifty50WeeklyExpiry"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-Nifty50MonthlyExpiry" class=" col-sm-12 control-label">Nifty50MonthlyExpiry</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-Nifty50MonthlyExpiry" name="txt_Nifty50MonthlyExpiry" placeholder="Enter Nifty50MonthlyExpiry"  required>
                                                        </div></div><div class="form-group col-sm-6">
                                                        <label for="edit-PandemicWarSituation" class=" col-sm-12 control-label">PandemicWarSituation</label>
                                                        <div class=" col-sm-12">
                                                            <input type="number" min="10000000000" max="99999999999" maxlength="11" class="form-control" id="edit-PandemicWarSituation" name="txt_PandemicWarSituation" placeholder="Enter PandemicWarSituation"  required>
                                                        </div></div>
                                                </div>
                                                <div class='row'>
                                                    <div class="form-group col-sm-6">
                                                        <label for="edit-Output" class=" col-sm-12 control-label">Output</label>
                                                        <div class=" col-sm-12">
                                                            <input type="text" maxlength="12" class="form-control" id="edit-Output" name="txt_Output" placeholder="Enter Output" required>
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
    var action_url = '<?php echo RGVPAdminAPIURL ?>' + '/NiftyDataset.php';
    $('btn-reload').on('click', function ()
    {
        // Initialize datatable
        $('#table_NiftyDataset').dataTable({
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
        $('#table_NiftyDataset').dataTable({
            'aProcessing': true,
            'aServerSide': true,
            'ajax': action_url + '?CommandType=SELECT'
        });
        // Save edited row
        $('#edit-NiftyDataset').on('submit', function (event) {
            event.preventDefault();
            $.post(action_url + '?CommandType=UPDATE-SAVE&id=' + $('#edit-ID').val(), $(this).serialize(), function (data) {
                var obj = $.parseJSON(data);
                var tr = $('a[data-id="row-' + $('#edit-ID').val() + '"]').parent().parent();
                $('td:eq(0)', tr).html(obj.ID);
                $('td:eq(1)', tr).html(obj.Nifty50);
                $('td:eq(2)', tr).html(obj.SGXNifty);
                $('td:eq(3)', tr).html(obj.DJIA30);
                $('td:eq(4)', tr).html(obj.Nasdaq100);
                $('td:eq(5)', tr).html(obj.Russel2000);
                $('td:eq(6)', tr).html(obj.SnP500);
                $('td:eq(7)', tr).html(obj.FTSE100);
                $('td:eq(8)', tr).html(obj.Nikkei225);
                $('td:eq(9)', tr).html(obj.CAC40);
                $('td:eq(10)', tr).html(obj.DAX30);
                $('td:eq(11)', tr).html(obj.HangSeng);
                $('td:eq(12)', tr).html(obj.SSE180);
                $('td:eq(13)', tr).html(obj.MCXBulldex);
                $('td:eq(14)', tr).html(obj.GoldFutureIndia);
                $('td:eq(15)', tr).html(obj.CrudeOil);
                $('td:eq(16)', tr).html(obj.WebInfoData);
                $('td:eq(17)', tr).html(obj.IndianTVNews);
                $('td:eq(18)', tr).html(obj.SocialMediaFeed);
                $('td:eq(19)', tr).html(obj.BrokeragesHouseNews);
                $('td:eq(20)', tr).html(obj.FIISData);
                $('td:eq(21)', tr).html(obj.DIISData);
                $('td:eq(22)', tr).html(obj.GlobalTrend);
                $('td:eq(23)', tr).html(obj.Nifty50WeeklyExpiry);
                $('td:eq(24)', tr).html(obj.Nifty50MonthlyExpiry);
                $('td:eq(25)', tr).html(obj.PandemicWarSituation);
                $('td:eq(26)', tr).html(obj.Output);
                $('#edit-modal').modal('hide');
            }).fail(function () {
                alert('Unable to save data, please try again later.');
            });
        });
        // Add new row
        $('#add-NiftyDataset').on('submit', function (event) {
            event.preventDefault();
            $.post(action_url + '?CommandType=INSERT', $(this).serialize(), function (data) {
                var obj = $.parseJSON(data);
                $('#table_NiftyDataset tbody tr:last').after('<tr role="row"><td class="sorting_1">' + obj.txt_ID + '</td><td>' + obj.Nifty50 + '</td><td>' + obj.SGXNifty + '</td><td>' + obj.DJIA30 + '</td><td>' + obj.Nasdaq100 + '</td><td>' + obj.Russel2000 + '</td><td>' + obj.SnP500 + '</td><td>' + obj.FTSE100 + '</td><td>' + obj.Nikkei225 + '</td><td>' + obj.CAC40 + '</td><td>' + obj.DAX30 + '</td><td>' + obj.HangSeng + '</td><td>' + obj.SSE180 + '</td><td>' + obj.MCXBulldex + '</td><td>' + obj.GoldFutureIndia + '</td><td>' + obj.CrudeOil + '</td><td>' + obj.WebInfoData + '</td><td>' + obj.IndianTVNews + '</td><td>' + obj.SocialMediaFeed + '</td><td>' + obj.BrokeragesHouseNews + '</td><td>' + obj.FIISData + '</td><td>' + obj.DIISData + '</td><td>' + obj.GlobalTrend + '</td><td>' + obj.Nifty50WeeklyExpiry + '</td><td>' + obj.Nifty50MonthlyExpiry + '</td><td>' + obj.PandemicWarSituation + '</td><td>' + obj.Output + '</td><td><a data-id="row-' + obj.id + '" href="javascript:editRow(' + obj.id + ');" class="btn btn-default btn-sm">edit</a>&nbsp;<a href="javascript:removeRow(' + obj.id + ');" class="btn btn-default btn-sm">remove</a></td></tr>');
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
                $('#edit-Nifty50').val(obj.Nifty50);
                $('#edit-SGXNifty').val(obj.SGXNifty);
                $('#edit-DJIA30').val(obj.DJIA30);
                $('#edit-Nasdaq100').val(obj.Nasdaq100);
                $('#edit-Russel2000').val(obj.Russel2000);
                $('#edit-SnP500').val(obj.SnP500);
                $('#edit-FTSE100').val(obj.FTSE100);
                $('#edit-Nikkei225').val(obj.Nikkei225);
                $('#edit-CAC40').val(obj.CAC40);
                $('#edit-DAX30').val(obj.DAX30);
                $('#edit-HangSeng').val(obj.HangSeng);
                $('#edit-SSE180').val(obj.SSE180);
                $('#edit-MCXBulldex').val(obj.MCXBulldex);
                $('#edit-GoldFutureIndia').val(obj.GoldFutureIndia);
                $('#edit-CrudeOil').val(obj.CrudeOil);
                $('#edit-WebInfoData').val(obj.WebInfoData);
                $('#edit-IndianTVNews').val(obj.IndianTVNews);
                $('#edit-SocialMediaFeed').val(obj.SocialMediaFeed);
                $('#edit-BrokeragesHouseNews').val(obj.BrokeragesHouseNews);
                $('#edit-FIISData').val(obj.FIISData);
                $('#edit-DIISData').val(obj.DIISData);
                $('#edit-GlobalTrend').val(obj.GlobalTrend);
                $('#edit-Nifty50WeeklyExpiry').val(obj.Nifty50WeeklyExpiry);
                $('#edit-Nifty50MonthlyExpiry').val(obj.Nifty50MonthlyExpiry);
                $('#edit-PandemicWarSituation').val(obj.PandemicWarSituation);
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