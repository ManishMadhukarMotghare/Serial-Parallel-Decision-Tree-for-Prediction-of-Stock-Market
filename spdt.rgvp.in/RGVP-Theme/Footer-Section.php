<!-- jquery UI============================================ -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<!-- bootstrap JS ============================================ -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- wow JS ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/RGVPLibrary.js" type="text/javascript"></script>
<script src="<?php echo RGVPAdminURL; ?>js/wow.min.js"></script>
<!-- price-slider JS ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/jquery-price-slider.js"></script>
<!-- owl.carousel JS ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/owl.carousel.min.js"></script>
<!-- scrollUp JS ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/jquery.scrollUp.min.js"></script>
<!-- meanmenu JS ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/meanmenu/jquery.meanmenu.js"></script>
<!-- counterup JS ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/counterup/jquery.counterup.min.js"></script>
<script src="<?php echo RGVPAdminURL; ?>js/counterup/waypoints.min.js"></script>
<script src="<?php echo RGVPAdminURL; ?>js/counterup/counterup-active.js"></script>
<!-- mCustomScrollbar JS ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- sparkline JS ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo RGVPAdminURL; ?>js/sparkline/sparkline-active.js"></script>
<!-- flot JS ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/flot/jquery.flot.js"></script>
<script src="<?php echo RGVPAdminURL; ?>js/flot/jquery.flot.resize.js"></script>
<script src="<?php echo RGVPAdminURL; ?>js/flot/flot-active.js"></script>
<!-- knob JS
            ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/knob/jquery.knob.js"></script>
<script src="<?php echo RGVPAdminURL; ?>js/knob/jquery.appear.js"></script>
<script src="<?php echo RGVPAdminURL; ?>js/knob/knob-active.js"></script>
<!--  Chat JS
            ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/chat/jquery.chat.js"></script>
<!--  todo JS
            ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/todo/jquery.todo.js"></script>
<!--  wave JS
        ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/wave/waves.min.js"></script>
<script src="<?php echo RGVPAdminURL; ?>js/wave/wave-active.js"></script>
<!-- plugins JS
            ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/plugins.js"></script>
<!-- Data Table JS
            ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/data-table/jquery.dataTables.min.js"></script>
<script src="<?php echo RGVPAdminURL; ?>js/data-table/data-table-act.js"></script>
<!-- main JS ============================================ -->
<script src="<?php echo RGVPAdminURL; ?>js/main.js"></script>
<script src="<?php echo RGVPAdminURL; ?>js/bootstrap-select.js"></script>
<!-- ckeditor============================================ -->


<!--<script>
    $(document).ready(function () {
        var mySelect = $('#first-disabled2');

        $('#special').on('click', function () {
            mySelect.find('option:selected').prop('disabled', true);
            mySelect.selectpicker('refresh');
        });

        $('#special2').on('click', function () {
            mySelect.find('option:disabled').prop('disabled', false);
            mySelect.selectpicker('refresh');
        });

        $('#basic2').selectpicker({
            liveSearch: true,
            maxOptions: 1
        });
    });
</script>-->

<script>$.fn.dataTable.ext.errMode = 'none';</script>
<script type="text/javascript">
    $("#btn-logout").click(function () {
        //event.preventDefault();
        if (confirm("Are you sure, You want to Log Out")) {
            $.ajax({url: '<?php echo RGVPWebAPIURL ?>usermanagement.php', data: {'CommandType': 'LOGOUT'}, type: '<?php echo API_CALL_METHOD; ?>',
                beforeSend: function ()
                {
                    $('.display-result').html('<div class="btn btn-primary btn-block"><i class="fa fa-refresh fa-spin"></i> Signing Out...</div>');
                },
                success: function (result) {
                    if (result == "true" || result == " true")
                    {
                        $('.display-result').html("Logout Successful. Redirecting to Login Page.");
                        document.location.href = '<?php echo RGVPWebURL ?>';
                    } else {
                        $('.display-result').html('<span type="button" class="alert alert-danger col-md-12" title="Ajax Response"><i class="fa fa-ban "></i>&nbsp; ' + result + ' </button>');
                    }
                    //$('#btn-login').val('Signed In');
                },
                error: function (jqXHR, textStatus, texterrorThrown)
                {
                    $('.display-result').html('Error:' + textStatus);
                }
            });
        }
    });
</script>