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
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="breadcomb-wp">
                                        <div class="breadcomb-icon">
                                            <i class="notika-icon notika-windows"></i>
                                        </div>
                                        <div class="breadcomb-ctn">
                                            <h2>Training and Testing of Various Dataset using Principal Component Analysis Based Decision Tree Forest </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
                            <input id="txt_trainpc" type="number" step="1" value="70" min="10" max="100" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Test DataSets(%)</label>
                            <input id="txt_testpc" type="number" step="1" value="30" readonly="" class="form-control" />
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Train and Test DataSet</label>
                            <input type="button" id="btn_train" value="Go!" class="btn btn-primary" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row display-algorithm-datasets" style="display:none">  
                <div class="col-md-6 display-training-dataset">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Training Dataset <input id="btn_dataset_compute" type="button" value="Execute Algorithm!" onclick="RGVPRandomForestAlgoWork()"  class="col-md-3 pull-right btn-primary" /></h3>
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
                                        <input id="txt_train_outputs" type="text" value="" readonly="" class="form-control" />
                                    </div>
                                </div>

                            </div>
                            <div class="row" style="overflow:scroll">
                                <div class="table-responsive demo-x content">
                                    <table id="table_NSEStockDataTraining" class="display-table table table-condensed table-hover table-bordered" cellspacing="0" width="100%">
                                        <thead class="btn-primary">
                                            <tr>
                                                <th>ID</th><th>Nifty50</th><th>SGXNifty</th><th>DJIA30</th><th>Nasdaq100</th><th>Russel2000</th><th>SnP500</th><th>FTSE100</th><th>Nikkei225</th><th>CAC40</th><th>DAX30</th><th>HangSeng</th><th>SSE180</th><th>MCXBulldex</th><th>GoldFutureIndia</th><th>CrudeOil</th><th>WebInfoData</th><th>IndianTVNews</th><th>SocialMediaFeed</th><th>BrokeragesHouseNews</th><th>FIISData</th><th>DIISData</th><th>GlobalTrend</th><th>Nifty50WeeklyExpiry</th><th>Nifty50MonthlyExpiry</th><th>PandemicWarSituation</th><th>Output</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="btn-primary">
                                            <tr>
                                                <th>ID</th><th>Nifty50</th><th>SGXNifty</th><th>DJIA30</th><th>Nasdaq100</th><th>Russel2000</th><th>SnP500</th><th>FTSE100</th><th>Nikkei225</th><th>CAC40</th><th>DAX30</th><th>HangSeng</th><th>SSE180</th><th>MCXBulldex</th><th>GoldFutureIndia</th><th>CrudeOil</th><th>WebInfoData</th><th>IndianTVNews</th><th>SocialMediaFeed</th><th>BrokeragesHouseNews</th><th>FIISData</th><th>DIISData</th><th>GlobalTrend</th><th>Nifty50WeeklyExpiry</th><th>Nifty50MonthlyExpiry</th><th>PandemicWarSituation</th><th>Output</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="div-display-datasets"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 display-testing-dataset">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Testing Dataset </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">NoOfRows</label>
                                        <input id="txt_test_numrows" type="number" step="1" readonly="" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Execution Time(Seconds)</label>
                                        <input id="txt_execution_time" type="number" step="0.01" readonly="" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Correct Estimations</label>
                                        <input id="txt_correct_estimations" type="number" readonly="" class="form-control" />
                                    </div>

                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Accuracy Percentage</label>
                                        <input id="txt_accuracy_percent" type="text" readonly="" class="form-control" />
                                    </div>
                                </div>

                            </div>
                            <div class="row" style="overflow:scroll">
                                <table class="table table-bordered table-hover table-responsive">
                                    <thead>
                                    <div class="table-responsive demo-x content">
                                        <table id="table_NSEStockDataTesting" class="display-table table table-condensed table-hover table-bordered" cellspacing="0" width="100%">
                                            <thead class="btn-primary">
                                                <tr>
                                                    <th>ID</th><th>Nifty50</th><th>SGXNifty</th><th>DJIA30</th><th>Nasdaq100</th><th>Russel2000</th><th>SnP500</th><th>FTSE100</th><th>Nikkei225</th><th>CAC40</th><th>DAX30</th><th>HangSeng</th><th>SSE180</th><th>MCXBulldex</th><th>GoldFutureIndia</th><th>CrudeOil</th><th>WebInfoData</th><th>IndianTVNews</th><th>SocialMediaFeed</th><th>BrokeragesHouseNews</th><th>FIISData</th><th>DIISData</th><th>GlobalTrend</th><th>Nifty50WeeklyExpiry</th><th>Nifty50MonthlyExpiry</th><th>PandemicWarSituation</th><th>Output</th><th>Prediction</th>
                                                </tr>
                                            </thead>
                                            <tfoot class="btn-primary">
                                                <tr>
                                                    <th>ID</th><th>Nifty50</th><th>SGXNifty</th><th>DJIA30</th><th>Nasdaq100</th><th>Russel2000</th><th>SnP500</th><th>FTSE100</th><th>Nikkei225</th><th>CAC40</th><th>DAX30</th><th>HangSeng</th><th>SSE180</th><th>MCXBulldex</th><th>GoldFutureIndia</th><th>CrudeOil</th><th>WebInfoData</th><th>IndianTVNews</th><th>SocialMediaFeed</th><th>BrokeragesHouseNews</th><th>FIISData</th><th>DIISData</th><th>GlobalTrend</th><th>Nifty50WeeklyExpiry</th><th>Nifty50MonthlyExpiry</th><th>PandemicWarSituation</th><th>Output</th><th>Prediction</th>
                                                </tr>
                                            </tfoot>
                                        </table>

                                        </thead>

                                </table>
<!--                                    <a class="twitter-timeline hidden" data-theme="dark" href="https://twitter.com/AnilSinghvi_?ref_src=twsrc%5Etfw">Tweets by AnilSinghvi_</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> -->
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
            <script type="text/javascript">
                var action_url = '<?php echo RGVPAdminAPIURL ?>' + 'NiftyDataset.php';
                var trainingdataset, testingdataset;
                var executiontime = 0, correctprediction = 0;
            </script>
            <script src="<?php echo RGVPWebURL; ?>js/rgvp-ml-library/decision-tree.js"></script>
            <script type="text/javascript">

                $("#txt_trainpc").on("change keypress keyup keydown blur focus", function () {
                    $("#txt_testpc").val(100 - parseFloat($(this).val()));
                });
                $("#btn_train").click(function () {
                    $(".display-algorithm-datasets").slideDown();
                    var trainingurl = action_url + '?CommandType=SELECT-TRAINING-DATASET&Percent=' + $("#txt_trainpc").val();
                    var testingurl = action_url + '?CommandType=SELECT-TESTING-DATASET&Percent=' + $("#txt_testpc").val();
                    $.ajax({url: trainingurl, async: true, success: function (jsontrain) {
                            trainingdataset = JSON.parse(jsontrain);
                            console.log("trainingdataset: " + trainingdataset);
                            $.each(trainingdataset.data, function (key, rowvalues) {

                                rowvalues.Nifty50 = parseFloat(rowvalues.Nifty50);
                                rowvalues.SGXNifty = parseFloat(rowvalues.SGXNifty);
                                rowvalues.DJIA30 = parseFloat(rowvalues.DJIA30);
                                rowvalues.Nasdaq100 = parseFloat(rowvalues.Nasdaq100);
                                rowvalues.Russel2000 = parseFloat(rowvalues.Russel2000);
                                rowvalues.SnP500 = parseFloat(rowvalues.SnP500);
                                rowvalues.FTSE100 = parseFloat(rowvalues.FTSE100);
                                rowvalues.Nikkei225 = parseFloat(rowvalues.Nikkei225);
                                rowvalues.CAC40 = parseFloat(rowvalues.CAC40);
                                rowvalues.DAX30 = parseFloat(rowvalues.DAX30);
                                rowvalues.HangSeng = parseFloat(rowvalues.HangSeng);
                                rowvalues.SSE180 = parseFloat(rowvalues.SSE180);
                                rowvalues.MCXBulldex = parseFloat(rowvalues.MCXBulldex);
                                rowvalues.GoldFutureIndia = parseFloat(rowvalues.GoldFutureIndia);
                                rowvalues.CrudeOil = parseFloat(rowvalues.CrudeOil);
                                rowvalues.WebInfoData = parseInt(rowvalues.WebInfoData);
                                rowvalues.IndianTVNews = parseInt(rowvalues.IndianTVNews);
                                rowvalues.SocialMediaFeed = parseInt(rowvalues.SocialMediaFeed);
                                rowvalues.BrokeragesHouseNews = parseInt(rowvalues.BrokeragesHouseNews);
                                rowvalues.FIISData = parseInt(rowvalues.FIISData);
                                rowvalues.DIISData = parseInt(rowvalues.DIISData);
                                rowvalues.GlobalTrend = parseInt(rowvalues.GlobalTrend);
                                rowvalues.Nifty50WeeklyExpiry = parseInt(rowvalues.Nifty50WeeklyExpiry);
                                rowvalues.Nifty50MonthlyExpiry = parseInt(rowvalues.Nifty50MonthlyExpiry);
                                rowvalues.PandemicWarSituation = parseInt(rowvalues.PandemicWarSituation);




                            });
                            $("#txt_train_numrows").val(trainingdataset.data.length);
                            $("#txt_train_attributes").val("6");
                            $("#txt_train_outputs").val("Buy,Sell");

                        }});
                    $.ajax({url: testingurl, async: true, success: function (jsontest) {
                            //console.log(jsontest);
                            testingdataset = JSON.parse(jsontest);
                            console.log("testingdataset: " + testingdataset);
                            $.each(testingdataset.data, function (key, rowvalues) {

                                rowvalues.Nifty50 = parseFloat(rowvalues.Nifty50);
                                rowvalues.SGXNifty = parseFloat(rowvalues.SGXNifty);
                                rowvalues.DJIA30 = parseFloat(rowvalues.DJIA30);
                                rowvalues.Nasdaq100 = parseFloat(rowvalues.Nasdaq100);
                                rowvalues.Russel2000 = parseFloat(rowvalues.Russel2000);
                                rowvalues.SnP500 = parseFloat(rowvalues.SnP500);
                                rowvalues.FTSE100 = parseFloat(rowvalues.FTSE100);
                                rowvalues.Nikkei225 = parseFloat(rowvalues.Nikkei225);
                                rowvalues.CAC40 = parseFloat(rowvalues.CAC40);
                                rowvalues.DAX30 = parseFloat(rowvalues.DAX30);
                                rowvalues.HangSeng = parseFloat(rowvalues.HangSeng);
                                rowvalues.SSE180 = parseFloat(rowvalues.SSE180);
                                rowvalues.MCXBulldex = parseFloat(rowvalues.MCXBulldex);
                                rowvalues.GoldFutureIndia = parseFloat(rowvalues.GoldFutureIndia);
                                rowvalues.CrudeOil = parseFloat(rowvalues.CrudeOil);
                                rowvalues.WebInfoData = parseInt(rowvalues.WebInfoData);
                                rowvalues.IndianTVNews = parseInt(rowvalues.IndianTVNews);
                                rowvalues.SocialMediaFeed = parseInt(rowvalues.SocialMediaFeed);
                                rowvalues.BrokeragesHouseNews = parseInt(rowvalues.BrokeragesHouseNews);
                                rowvalues.FIISData = parseInt(rowvalues.FIISData);
                                rowvalues.DIISData = parseInt(rowvalues.DIISData);
                                rowvalues.GlobalTrend = parseInt(rowvalues.GlobalTrend);
                                rowvalues.Nifty50WeeklyExpiry = parseInt(rowvalues.Nifty50WeeklyExpiry);
                                rowvalues.Nifty50MonthlyExpiry = parseInt(rowvalues.Nifty50MonthlyExpiry);
                                rowvalues.PandemicWarSituation = parseInt(rowvalues.PandemicWarSituation);


                            });
                            $("#txt_test_numrows").val(testingdataset.data.length);
                        }});
                    //LoadDataTables();
                });
                function RGVPRandomForestAlgoWork()
                {
                    var starttime = new Date();
                    var starttimemsec = starttime.getMilliseconds();
                    var traindata = trainingdataset.data;
                    var testdata = testingdataset.data;

                    //console.log(rowvalue.);
                    //$.each(rowvalue, function (index, data) {

                    //     console.log('index', data);
                    //});
                    //
                    console.log(traindata);
                    var config = {
                        trainingSet: traindata,
                        categoryAttr: 'Output',
                        ignoredAttributes: ['ID']
                    };
                    LoadDataTables();
                    var numberOfTrees = 3;
                    var randomForest = new dt.RandomForest(config, numberOfTrees);
                    console.log(randomForest);
                    correctprediction = 0;
                    $.each(testdata, function (key, rowvalue) {
                        var randomForestPrediction = randomForest.predict(rowvalue);
                        //console.log(key + ": ");
                        console.log(randomForestPrediction);
                        if (randomForestPrediction.Buy > randomForestPrediction.Sell)
                            rowvalue.Prediction = "Buy";
                        else
                            rowvalue.Prediction = "Sell";
                        if (rowvalue.Prediction === rowvalue.Output)
                            correctprediction++;
                    });

                    var endtime = new Date();
                    var endtimemsec = endtime.getMilliseconds();
                    executiontime = endtimemsec - starttimemsec;
                    $("#txt_execution_time").val(executiontime);
                    $("#txt_correct_estimations").val(correctprediction);
                    $("#txt_accuracy_percent").val((correctprediction / testdata.length * 100) + "%");


                    //                                
                    //                                [{person: 'Homer', hairLength: 0, weight: 250, age: 36, sex: 'male'},
                    //                                    {person: 'Marge', hairLength: 10, weight: 150, age: 34, sex: 'female'},
                    //                                    {person: 'Bart', hairLength: 2, weight: 90, age: 10, sex: 'male'},
                    //                                    {person: 'Lisa', hairLength: 6, weight: 78, age: 8, sex: 'female'},
                    //                                    {person: 'Maggie', hairLength: 4, weight: 20, age: 1, sex: 'female'},
                    //                                    {person: 'Abe', hairLength: 1, weight: 170, age: 70, sex: 'male'},
                    //                                    {person: 'Selma', hairLength: 8, weight: 160, age: 41, sex: 'female'},
                    //                                    {person: 'Otto', hairLength: 10, weight: 180, age: 38, sex: 'male'},
                    //                                    {person: 'Krusty', hairLength: 6, weight: 200, age: 45, sex: 'male'}];

                    // Configuration

                    // Building Decision Tree
                    //var decisionTree = new dt.DecisionTree(config);
                    // Building Random Forest
                    // Testing Decision Tree and Random Forest
                    //var comic = {person: 'Comic guy', hairLength: 8, weight: 290, age: 38};

                    //var decisionTreePrediction = decisionTree.predict(comic);

                }
                $(document).ready(function () {
                    // ATW
                    // Initialize datatable


                });
                function LoadDataTables()
                {
                    $('#table_NSEStockDataTraining').dataTable({

                        'data': trainingdataset.data,
                        'columns': [
                            {"data": "ID"},
                            {"data": "Nifty50"},
                            {"data": "SGXNifty"},
                            {"data": "DJIA30"},
                            {"data": "Nasdaq100"},
                            {"data": "Russel2000"},
                            {"data": "SnP500"},
                            {"data": "FTSE100"},
                            {"data": "Nikkei225"},
                            {"data": "CAC40"},
                            {"data": "DAX30"},
                            {"data": "HangSeng"},
                            {"data": "SSE180"},
                            {"data": "MCXBulldex"},
                            {"data": "GoldFutureIndia"},
                            {"data": "CrudeOil"},
                            {"data": "WebInfoData"},
                            {"data": "IndianTVNews"},
                            {"data": "SocialMediaFeed"},
                            {"data": "BrokeragesHouseNews"},
                            {"data": "FIISData"},
                            {"data": "DIISData"},
                            {"data": "GlobalTrend"},
                            {"data": "Nifty50WeeklyExpiry"},
                            {"data": "Nifty50MonthlyExpiry"},
                            {"data": "PandemicWarSituation"},
                            {"data": "Output"}

                        ]
                    });
                    $('#table_NSEStockDataTesting').dataTable({

                        'data': testingdataset.data,
                        'columns': [
                            {"data": "ID"},
                            {"data": "Nifty50"},
                            {"data": "SGXNifty"},
                            {"data": "DJIA30"},
                            {"data": "Nasdaq100"},
                            {"data": "Russel2000"},
                            {"data": "SnP500"},
                            {"data": "FTSE100"},
                            {"data": "Nikkei225"},
                            {"data": "CAC40"},
                            {"data": "DAX30"},
                            {"data": "HangSeng"},
                            {"data": "SSE180"},
                            {"data": "MCXBulldex"},
                            {"data": "GoldFutureIndia"},
                            {"data": "CrudeOil"},
                            {"data": "WebInfoData"},
                            {"data": "IndianTVNews"},
                            {"data": "SocialMediaFeed"},
                            {"data": "BrokeragesHouseNews"},
                            {"data": "FIISData"},
                            {"data": "DIISData"},
                            {"data": "GlobalTrend"},
                            {"data": "Nifty50WeeklyExpiry"},
                            {"data": "Nifty50MonthlyExpiry"},
                            {"data": "PandemicWarSituation"},
                            {"data": "Output"},
                            {"data": "Prediction"}

                        ]
                    });
                }
            </script>
    </body>

</html>
