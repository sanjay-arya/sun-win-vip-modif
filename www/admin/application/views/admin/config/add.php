<?php $this->load->view('admin/config/head', $this->data) ?>
<div class="line"></div>

<div class="wrapper">
    <p id="message" style="color: #7a6fbe"></p>
    
    <div class="widget">
        <h4 id="resultsearch" style="color: #e72929;margin-left: 10px"></h4>
        

        
        <?php if ($admin_info->Status == "A"): ?>
            <div class="title">
                <h4>Add config </span></h4>
            </div>
            <div class="formRow">
                <div class="row">
                    <div class="col-sm-1">
                        <label>Configuration name:</label>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtnameconfig">
                    </div>
                    <div class="col-sm-1">
                        <label>Version config:</label>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtversionconfig">
                    </div>
                    <div class="col-sm-1">
                        <label>Platform config:</label>
                    </div>
                    <div class="col-sm-2">
                        <select id="txtplatform" name="txtplatform">
                            <option value="ios">Ios</option>
                            <option value="ad">Android</option>
                            <option value="web">Web</option>
                            <option value="wp">WP</option>
                            <option value="common">Common</option>
                            <option value="otp">Otp</option>
                            <option value="dvt">Dvt</option>
                            <option value="brandname">Brandname</option>
                            <option value="billing">Billing</option>
                            <option value="other">Other</option>
                            <option value="game_bai">Card game</option>
                            <option value="i2b">I2b</option>
                            <option value="nganluong">Money</option>
                            <option value="admin">Admin</option>
                            <option value="vippoint_event">Vippoint Event</option>
                            <option value="vin_plus">Win Plus</option>
                            <option value="lucky_vip">Lucky Vip</option>
                            <option value="agent">Agent</option>
                            <option value="sms_plus">Sms Plus</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <input type="button" id="add_config" value="Add config" class="button blueB">
                    </div>
                </div>
            </div>

            <div class="formRow">
                <div class="row">
                    <div class="col-sm-4">
                        <textarea id="myTextArea" cols=100 rows=30 style="color: #7a6fbe;font-size: 20px"></textarea>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="bsModal3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                            <p style="color: #7a6fbe">Added config successfully</p>
                        </div>
                        <div class="modal-footer">
                            <input class="blueB logMeIn" type="button" value="Close" data-dismiss="modal"
                                   aria-hidden="true">
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="title">
                <h4>You are not authorized</h4>
            </div>
        <?php endif; ?>
    </div>
</div>
<style>.spinner {
        position: fixed;
        top: 50%;
        left: 50%;
        margin-left: -50px; /* half width of the spinner gif */
        margin-top: -50px; /* half height of the spinner gif */
        text-align: center;
        z-index: 1234;
        overflow: auto;
        width: 100px; /* width of the spinner gif */
        height: 102px; /*hight of the spinner gif +2px to fix IE8 issue */
    }</style>
<div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="<?php echo public_url('admin/images/loading.gif') ?>" alt="Loading"/>
</div>

<script>

function isValidJSON(string) {
        try {
            JSON.parse(string);
        } catch (e) {
            return false;
        }

        return true;
    }
   $(document).ready(function(){
        $("#add_config").click(function(){
            var data = $("#myTextArea").val();
            var myJSONString = data.replace(/\n/g, ' ').replace(/\t/g, ' ').replace(/  +/g, "");
            if (isValidJSON(myJSONString) == false) {
                $("#message").html("");
                $("#resultsearch").html("Not json data");
                return false;

            }
            var name_config = $("#txtnameconfig").val();
            var version = $("#txtversionconfig").val();
            var platform = $("#txtplatform").val();
            if(name_config == "" || version == "" || platform == ""){
                $("#resultsearch").html("Please enter complete data");
                return false;
            }
            $("#spinner").show();
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('confignew/addconfigajax')?>",
                data: {
                    name_config: name_config,
                    version: version,
                    platform: platform,
                    data: myJSONString
                }, dataType: 'json',
                success: function (result) {
                    $("#spinner").hide();
                    console.log(result);
                    $("#resultsearch").html("");
                    $("#bsModal3").modal("show");
                },
                error: function(data){
                    console.log(data);
                    $("#spinner").hide();
                    $("#resultsearch").html("System overload");
                }
            })
        })
   });

</script>