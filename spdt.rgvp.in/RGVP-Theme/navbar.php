<?php
//$UserType = $RGVP->Cookie->getCookieValue("UserType");
?>
<div class="navbar navbar-dark bg-primary ">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="col-xs-4 hidden-md hidden-lg" href="<?php echo RGVPAdminURL ?>"><img class="img-responsive" src="images/logo.png"></a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php"><i class="notika-icon notika-house"></i> Dashboard</a></li>

                <!--<li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="notika-icon notika-edit"></i>About<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class=""><a href="manish.php" class="" >About Manish</a></li>
                        <li class=""><a href="phd.php" class="" >About PhD</a></li>
                    </ul>
                </li>-->
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="notika-icon notika-edit"></i>DataSets<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class=""><a href="Datasets.php" class="" >Manage DataSets</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="notika-icon notika-edit"></i>PCABDT Forest - NSE <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class=""><a href="RFAlgo-TrainAlgorithm.php" class="" >Train Dataset</a></li>
                        <li class=""><a href="RFAlgo-TrainAlgorithm.php" class="" >Test Dataset</a></li>
                        <li class=""><a href="RFAlgo-TrainAlgorithm.php" class="" >Algorithm Estimations</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="notika-icon notika-edit"></i>PCABDTForest - Nifty50 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class=""><a href="RFNAlgo-TrainAlgorithm.php" class="" >Train Dataset</a></li>
                        <li class=""><a href="RFNAlgo-TrainAlgorithm.php" class="" >Test Dataset</a></li>
                        <li class=""><a href="RFNAlgo-TrainAlgorithm.php" class="" >Algorithm Estimations</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="notika-icon notika-edit"></i>Linear Discriminant Analysis Based Decision Tree Forest <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class=""><a href="RFAAlgo-TrainAlgorithm.php" class="" >Train Dataset</a></li>
                        <li class=""><a href="TestAlgorithm.php" class="" >Test Dataset</a></li>
                        <li class=""><a href="Testcases.php" class="" >Algorithm Estimations</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="notika-icon notika-edit"></i>Histogram Based Decision Tree for Non-Stationary Data<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                  <li class=""><a href="NiftyDataset-TrainAlgorithm.php" class="" >Train Nifty Data Set Histograms</a></li>
                     <li class=""><a href="NSEDataset-TrainAlgorithm.php" class="" >Train NSE Data set Histograms</a></li>
                        <li class=""><a href="internetdataset-TrainAlgorithm.php" class="" >Train Internet Dataset Histograms</a></li>
                        <li class=""><a href="weatherhistory-TrainAlgorithm.php" class="" >Train Weather History Histograms</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="notika-icon notika-edit"></i>Sentiment Analysis<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class=""><a href="FetchHTMLCode.php" class="" >Fetch HTML Code and Display</a></li>
                        <li class=""><a href="GetSentiments.php" class="" >MoneyControl Sentiments</a></li>
                        <li class=""><a href="UpdateSentiments.php" class="" >Save Latest Sentiments</a></li>
                    </ul>
                </li>
                <!--<li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="notika-icon notika-edit"></i>Shipping Management<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="thc-arrival-list.php">List THC Arrival</a></li>
                        <li><a href="branch-stock.php">View Available Stock</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="notika-icon notika-edit"></i>Delivery Management<b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Delivery Runsheet</a>
                            <ul class="dropdown-menu">
                                <li><a href="add-drs.php">Add DRS</a></li>
                                <li><a href="listintransit-drs.php">List Intransit DRS</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">POD</a>
                            <ul class="dropdown-menu">
                                <li><a href="view-pod.php">Add POD</a></li>
                                <li><a href="#">List Uploaded POD</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">PFN</a>
                            <ul class="dropdown-menu">
                                <li><a href="add-pfn.php">Add PFN</a></li>
                                <li><a href="list-pfn.php">List PFN</a></li>
                                <li><a href="list-Arrived-pfn.php">Arrived PFN</a></li>
                                <li><a href="list-Arrived-pfn-pod.php">List Arrived PFN POD</a></li>
                            </ul>
                        </li>
                        <li><a href="pod-handover.php">POD Handover</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="notika-icon notika-edit"></i>Report<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="daily-cutomer-reports.php">Daily Customer Reports</a></li>
                        <li><a href="dynamic-mis-reports.php">Dynamic Mis Reports</a></li>
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">OPERATIONAL</a>
                            <ul class="dropdown-menu">
                                <li><a href="sales-register.php">Sales Register</a></li>
                                <li><a href="pending-stock.php">Pending Stock(DWB)</a></li>
                                <li><a href="pending-DRS.php">Pending DRS</a></li>
                                <li><a href="delivery-without-POD.php">Delivery Without POD</a></li> 
                                <li><a href="pod-Not-handover.php">POD Not Handover</a></li> 
                                <li><a href="performances.php">Performances</a></li>  
                                <li><a href="auto-MIS.php">Auto MIS</a></li> 
                                <li><a href="expected-arrival.php">Expected Arrival</a></li> 
                                <li><a href="delivery.php">Delivery</a></li> 
                                <li><a href="sales-actual-target.php">Sales Actual VS Target</a></li> 
                            </ul>
                        </li> 
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">ACCOUNTS</a>
                            <ul class="dropdown-menu">
                                <li><a href="customer-ledger.php"> Customer Ledger</a></li>
                                <li><a href="account-ledger.php">Account Ledger</a></li>
                                <li><a href="bill-not-generated.php">Bill NOT Generated</a></li>
                                <li><a href="payment-not-collected.php">Payment NOT Collected</a></li> 
                            </ul>
                        </li> 
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="notika-icon notika-edit"></i>Tracking<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="track-operation.php">Track Operation</a></li>
                        <li><a href="track-vehicle.php">Track Vehicle</a></li>
                    </ul>
                </li>

                <?php if ($UserType == "Admin") { ?>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="notika-icon notika-edit"></i>Admin Menu<b class="caret"></b></a>
                            <ul class="dropdown-menu multi-level">
                                <li><a href="company-view.php">Company</a></li>
                               
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin User</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="adminuser-add.php">ADD AdminUser</a></li>
                                        <li><a href="adminuser-view.php">View AdminUser</a></li>
                                        <li><a href="adminuser-list.php">List AdminUser</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Branch</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="branch-add.php">ADD Branch</a></li>
                                        <li><a href="branch-view.php">View Branch</a></li>
                                        <li><a href="branch-list.php">List Branch</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Route</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="route-add.php">ADD Route</a></li>
                                        <li><a href="route-view.php">View Route</a></li>
                                        <li><a href="route-list.php">List Route</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">City</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="location-add.php">ADD City</a></li>
                                        <li><a href="location-view.php">View City</a></li>
                                        <li><a href="location-list.php">List City</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">GST Rate</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="gstrate-add.php">ADD GST Rate</a></li>
                                        <li><a href="gstrate-view.php">View GST Rate</a></li>
                                        <li><a href="gstrate-list.php">List GST Rate</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                <?php } ?>
                <li><a href="https://ewaybillgst.gov.in/"><i class="notika-icon notika-edit"></i>Generate E-Way Bill</a></li>-->

            </ul>
        </div>
    </div>
</div>

