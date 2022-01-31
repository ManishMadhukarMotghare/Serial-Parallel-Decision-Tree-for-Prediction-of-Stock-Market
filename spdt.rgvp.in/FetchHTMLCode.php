<?php
require_once 'include.php';
$htmlcode = "";
$sentimenturl = "";
$htmlcodesentiment = "";
$sentimentunfiltered = "";
$sentimentunfiltered = "";
if (isset($posted["txt_url"])) {
    $sentimenturl = $posted['txt_url'];
    $sentimentparentnode = '<ul id="cagetory">';
    $sentmentparentnodeend = "</ul>";
    $htmlcode = file_get_contents($sentimenturl);
    $htmlcodefiltered = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $htmlcode);
    $htmlcodefiltered = preg_replace('/<iframe.*?\/iframe>/i', '', $htmlcodefiltered);

    $sentimenthtmlcodearray = explode($sentimentparentnode, $htmlcodefiltered);


    $sentimenthtmlcodearrayend = explode('</ul>', $sentimenthtmlcodearray[1]);
    //$htmlcodesentiment = $RGVP->StrContains($sentimentparentcode, $htmlcode);
    $htmlcodesentiment = $sentimenthtmlcodearrayend[0];
    //echo $htmlcodesentimentend = strpos($sentmentparentnodeend, $sentimenthtmlcodearray[1]);

    $sentimentunfiltered = trim(strip_tags($htmlcodesentiment));
    $sentimentunfiltered = $RGVP->StrReplace("\t", " ", $sentimentunfiltered);
    while ($RGVP->StrContains("     ", $sentimentunfiltered))
        $sentimentunfiltered = $RGVP->StrReplace("     ", " ", $sentimentunfiltered);
    $sentimentunfiltered = $RGVP->StrReplace("    ", "|*|", $sentimentunfiltered);
    $sentimentunfiltered = $RGVP->StrReplace("\n", "|^|", $sentimentunfiltered);
    $sentimentrows = explode("|^|", $sentimentunfiltered);
    //print_r($sentimentrows);  
    $sentimentfiltered = "<table class='table table-bordered table-hover'>";
    $sentimentfiltered .= "<thead><tr><th>DateTime</th><th>Headline</th><th>Description</th></tr></thead><tbody>";
    foreach ($sentimentrows as $sentimentrow)
    {
        $rowdata = explode("|*|", $sentimentrow);
        
         $sentimentfiltered .= "<tr><td>$rowdata[0]</td><td>$rowdata[1]</td><td>$rowdata[2]</td></tr>";
    }
//foreach()
        $sentimentfiltered .= "";
    $sentimentfiltered .= "</tbody></table>";
    //echo $htmlcodesentiment;
}
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
                                            <h2>Fetch HTML Code</h2>
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
            echo '<br><div class="alert" style="text-align: center; color: #ffffff; background-color: #e53238; border-color: #ffffff;">' . $posted['msg'] . '<a href="index.php"  style="padding: 5px; background-color: #fff; float:right;">&times;</a></div>';
        }
        ?>
        <div class="data-table-area">
            <div class="data-table-list">
                <div class="">
                    <h2>Fetch HTML Management</h2>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="dynamic-content">
                            <!--dynamic content-->
                            <form method="get">
                                <div class="form-group col-md-4">
                                    <label for="">Enter The URL:</label>
                                    <input name="txt_url" type="text" max="2048" class="form-control" value="<?php echo $sentimenturl; ?>" />

                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Fetch Sentiments</label><!--SVM-->
                                    <input type="submit" id="btn_submit" value="Fetch HTML!" class="btn btn-success" />
                                </div>

                            </form>
                            <div class="clearfix"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">HTML Data:</label>
                                    <textarea id="txt_htmldata" type="text" class="form-control" style="min-height: 200px;" ><?php echo $htmlcode ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Sentiment HTML Data:</label>
                                    <textarea id="txt_htmldata" type="text" class="form-control" style="min-height: 200px;" ><?php echo $htmlcodesentiment ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Sentiment Plain Data:</label>
                                    <textarea id="txt_htmldata" type="text" class="form-control" style="min-height: 200px;" ><?php echo $sentimentunfiltered ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Sentiment Collection Data:</label>
                                    <div><?php echo $sentimentfiltered ?></div>
                                </div>
                            </div>
                            <!--dynamic content-->
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- End Footer area-->
        <?php include (RGVPAdminThemeFooter); ?>
        <?php include (RGVPAdminThemeFooterSection); ?>

    </body>

</html>