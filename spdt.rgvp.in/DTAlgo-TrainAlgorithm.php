<?php
require_once 'include.php';
$RGVP = new \RGVPCore\RGVPCore();
$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB->GetConnection();
//$RGVP->Cookie->getCookieValue("UserID");
$UserType = $RGVP->Cookie->getCookieValue("UserType");
$LoginUID = $RGVP->Cookie->getCookieValue("UserID");
?>
<!doctype html>
<html class="no-js" lang="">

    <head>
        <?php include (RGVPAdminThemeHeaderSection); ?>
        <style>
            .collapse{
                height:300px;
            }
            .collapse p{
                text-align: center;
                color:white;
                font-size:16px;
                font-weight: bold;
            }
        </style>
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
                    <div class="">
                        <div class="breadcomb-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="breadcomb-wp">
                                        <div class="breadcomb-icon">
                                            <i class="notika-icon notika-windows"></i>
                                        </div>
                                        <div class="breadcomb-ctn">
                                            <h2>Training and Testing of Dataset using Random Forest Decision tree Algorithm </h2>
                                            <!--<p>Welcome to Online Examination Management System <span class="bread-ntd">Admin Template</span></p>-->
                                            <p>
                                            </p>
                                            <div class="" >

                                            </div>
<!--                                            <img class="img-responsive" src="images/Algorithms.jpeg" alt=""/>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                                    <div class="breadcomb-report">
                                        <button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="notika-icon notika-sent"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcomb area End-->
        <div class="container-fluid">
            <div class="row">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3>Select the Dataset and Training Percentage & Testing Percentage</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-md-4">
                            <label for="">Select DataSets</label>
                            <?php echo $RGVP->DB->FillSelectQuery("SELECT Name, DatasetID FROM Datasets;", 'Name', 'DatasetID', 'ddl_DataSetID', 'ddl_DataSetID', 'form-control  show-tick', 'true') ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Train DataSets(%)</label>
                            <input id="txt_trainpc" type="number" step="1" value="10" min="10" max="100" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Test DataSets(%)</label>
                            <input id="txt_testpc" type="number" step="1" readonly="" class="form-control" />
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Train and Test DataSet</label>
                            <input type="button" id="btn_train" value="Go!" class="btn btn-success" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row display-algorithm-datasets" style="display:none">  
                <div class="col-md-6 display-training-dataset">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Training Dataset <input id="txt_dataset_numrows" type="number" step="1" readonly="" class="col-md-3 pull-right" /></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">NoOfRows</label>
                                        <input id="txt_train_numrows" type="number" step="1" readonly="" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Attributes</label>
                                        <input id="txt_train_attributes" type="text" readonly="" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Outputs</label>
                                        <input id="txt_train_outputs" type="text" readonly="" class="form-control" />
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <table class="table table-bordered table-hover table-responsive">
                                    <thead>
                                    <div class="table-responsive demo-x content">
                                        <table id="table_NSEStockDataTraining" class="display-table table table-condensed table-hover table-bordered" cellspacing="0" width="100%">
                                            <thead class="btn-primary">
                                                <tr>
                                                    <th>ID</th><th>Date</th><th>Open</th><th>High</th><th>Low</th><th>Close</th><th>AdjClose</th><th>Volume</th><th>Output</th>
                                                </tr>
                                            </thead>
                                            <tfoot class="btn-primary">
                                                <tr>
                                                    <th>ID</th><th>Date</th><th>Open</th><th>High</th><th>Low</th><th>Close</th><th>AdjClose</th><th>Volume</th><th>Output</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>     
                                    </thead>

                                </table>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="div-display-datasets"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                
                <div class="col-md-6 display-testing-dataset">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Testing Dataset </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Execution Time(Seconds)</label>
                                        <input id="txt_execution_time" type="number" step="1" readonly="" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Correct Estimations</label>
                                        <input id="txt_correct_estimations" type="number" readonly="" class="form-control" />
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Accuracy Percentage</label>
                                        <input id="txt_accuracy_percent" type="text" readonly="" class="form-control" />
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <table class="table table-bordered table-hover table-responsive">
                                    <thead>
                                    <div class="table-responsive demo-x content">
                                        <table id="table_NSEStockDataTesting" class="display-table table table-condensed table-hover table-bordered" cellspacing="0" width="100%">
                                            <thead class="btn-primary">
                                                <tr>
                                                    <th>ID</th><th>Date</th><th>Open</th><th>High</th><th>Low</th><th>Close</th><th>AdjClose</th><th>Volume</th><th>Output</th>
                                                </tr>
                                            </thead>
                                            <tfoot class="btn-primary">
                                                <tr>
                                                    <th>ID</th><th>Date</th><th>Open</th><th>High</th><th>Low</th><th>Close</th><th>AdjClose</th><th>Volume</th><th>Output</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>     
                                    </thead>

                                </table>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="div-display-datasets"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        

        <!-- End Footer area-->
        <div >
            <?php include (RGVPAdminThemeFooter); ?>
            <?php include (RGVPAdminThemeFooterSection); ?>
        </div>
        <script>
            var action_url = '<?php echo RGVPAdminAPIURL ?>' + '/NSEStockData.php';
            var trainingdataset = {}, testingdataset = {};
            $("#txt_trainpc").on("change keypress keyup keydown blur focus", function () {
                $("#txt_testpc").val(100 - parseFloat($(this).val()));
            });
            $("#btn_train").click(function () {
                $(".display-algorithm-datasets").slideDown();
                
                var trainingurl = action_url + '?CommandType=SELECT-TRAINING-DATASET&Percent=' + $("#txt_trainpc").val();
                var testingurl = action_url + '?CommandType=SELECT-TESTING-DATASET&Percent=' + $("#txt_testpc").val();
                $('#table_NSEStockDataTraining').dataTable({
                    'aProcessing': true,
                    'aServerSide': true,
                    'ajax': {
                        "type": "GET",
                        "url": trainingurl,
                        "dataSrc": function (jsontrain) {
                            //Make your callback here.
                            alert("Training DataSet Fetched!");
                            $('#table_NSEStockDataTesting').dataTable({
                                'aProcessing': true,
                                'aServerSide': true,
                                'ajax': {
                                    "type": "GET",
                                    "url": testingurl,
                                    "dataSrc": function (jsontest) {
                                        alert("Testing DataSet Fetched!");
                                        //$("#txt_train_numrows").val(jsontest.data.length);
                                        //$("#txt_train_attributes").val(jsontest.data[0].length);
                                        testingdataset = jsontest.data;
                                        return jsontest.data;
                                    }
                                }
                            });
                            $("#txt_train_numrows").val(jsontrain.data.length);
                            $("#txt_train_attributes").val(jsontrain.data[0].length);
                            trainingdataset = jsontrain.data;
                            return jsontrain.data;
                        }
                    }

                });


            });
            $(document).ready(function () {
                // ATW
                // Initialize datatable

            });
        </script>
    </body>

</html>