<?php
include 'include.php';
?>
<!doctype html>
<html class="no-js" lang="en-in">
    <head>
        <?php include (RGVPAdminThemeHeaderSection); ?>
    </head>
    <body>
        <div class="breadcomb-area">

            <div class="login-content">
                <!-- Login -->
                <div class="nk-block toggled" id="l-login">
                    <form id="loginform" onsubmit="return false"><!-- -->
                        <div class="nk-form" style="min-height: 300px">
                            <div class="display-result" style=""><h2>Login</h2></div>
                            <div class="col-md-6">
                                <img src="images/a1logo.png" />
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                                    <div class="nk-int-st">
                                        <input type="email" class="form-control" id="email" placeholder="Email ID" required="">
                                    </div>
                                </div>
                                <div class="input-group mg-t-15">
                                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                                    <div class="nk-int-st">
                                        <input type="password" class="form-control" id="password" placeholder="Password" required="">
                                    </div>
                                </div>
                                <div class="input-group hidden">
                                    <label>Login Type</label>
                                    <select name="CommandType" id="ddl_CommandType" class=""><option value="LOGIN-ADMIN">Admin</option></select>
                                </div>
                            </div>
                            <button id="btn-login" class=" btn btn-login btn-success btn-float" type="submit"  value="SIGN IN" ><i class="notika-icon notika-right-arrow right-arrow-ant"></i></button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- End Footer area-->
        <script src="<?php echo RGVPAdminURL; ?>js/RGVPLibrary.js" type="text/javascript">
        </script>

        <script>
            var api_output;
            
            function formSubmit(event)
            {
                var api_url = "<?php echo RGVPWebAPIURL ?>usermanagement.php";
                event.preventDefault();
                $.ajax({url: api_url, data: {'username': $('#email').val(), 'password': $('#password').val(), 'CommandType': $('#ddl_CommandType').val()}, type: '<?php echo API_CALL_METHOD; ?>',
                    beforeSend: function ()
                    {
                        $('.display-result').html(RGVPReportMsg("Please Wait! We are Logging you into the System.", "Loading", "Signing In...", false));//RGVPReportMsg("<i class='fa fa-spin fa-refresh '></i> Signing In...")
                    },
                    success: function (result) {
                        console.log(result);
                        api_output = JSON.parse(result.trim());
                        if (api_output.status == "success")
                        {
                            $('.display-result').html(RGVPReportMsg("Redirecting you to Home Page.", "Success", "Login Successful!", true));
                            document.location.href = 'index.php';
                        } else {
                            $('.display-result').html(RGVPReportMsg(api_output.message, "Failed", "Login Failed!", true));
                        }
                    },
                    error: function (jqXHR, textStatus, texterrorThrown)
                    {
                        $('.display-result').html(RGVPReportMsg("result: jqXHR: " + jqXHR + "<br> textStatus: " + textStatus + "<br> texterrorThrown: " + texterrorThrown, "Failed", "Login Failed! Please Try Again Later.", false));
                        //$('#btn-login').val('Sign In');
                        console.log();
                    }
                });
                return false;
            }

            $(document).ready(function () {
                $('#loginform').submit(function (event) {
                    event.preventDefault();
                    formSubmit(event);

                });

            });
        </script>
    </body>

</html>