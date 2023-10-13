<?php if($role == false): ?>
    <section class="content-header">
        <h1>
            You are not authorized yet
        </h1>
    </section>
<?php else: ?>
<section class="content-header">
    <h1>
      Add deduct money
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <label class="col-sm-2  control-label" style="color: red" id="errorvin"></label>
                        </div>
                    </div>
					 <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <label class="col-sm-1 control-label">Act:</label>
                            <div class="col-sm-2">
                                <select  id="actionname" class="form-control" >
                                    <option value="Admin">Add deduct money Admin</option>
                                    <option value="EventVP">Pay Vippoint Event Bonus</option>
                                    </select>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <label class="col-sm-1 control-label">Nick name:</label>
							  <input id="checknickname" type="hidden">
                            <div class="col-sm-2">
                                <input type="text" id="nickname" class="form-control" onblur="myFunction()">
                            </div>
							<label id="lblnickname" style="color: blueviolet"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <label class="col-sm-1 control-label">Surplus Win:</label>
                            <div class="col-sm-2">
                                <span id="balance-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <label class="col-sm-1 control-label">Amount of money:</label>

                            <div class="col-sm-2">
                                <input type="text" id="tienchuyen" class="form-control">
                            </div>
                            <label id="numchuyen" style="color: blueviolet"></label>
                        </div>
                    </div>
                    <div class="form-group" hidden>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <label class="col-sm-1 control-label">Type of money:</label>

                            <div class="col-sm-2">
                                <select id="money_type" class="form-control">
                                    <option value="vin">Win</option>
                                    <option value="xu">Coin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <label class="col-sm-1 control-label">Reason:</label>

                            <div class="col-sm-2">
                                <input type="text" id="reasonchuyen" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-1">
                                <input type="button" id="chuyentien"
                                       value="Add money" class="btn btn-primary pull-left">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="trutien"
                                       value="Deduction" class="btn btn-primary pull-left">
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="bsModal3" tabindex="-1" role="dialog"
                         aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content" style="width: 500px">
                                <div class="modal-header" style="display: block">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Enter OTP</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-5"><input class="form-control" type="text" id="maotpcong"
                                                                     placeholder="Enter OTP"></div>
                                        <div class="col-sm-4"><select class="form-control" id="otpselectcong">
                                                <option value="0">OTP SMS</option>
                                                <option value="1">OTP APP</option>
                                            </select></div>
                                        <div class="col-sm-3"><input type="button" class="btn btn-primary" value="Add money" id="congotp">
                                        </div>                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5 style="margin-right: 50px"><span style="color: #0000ff">SMS OTP:</span> Please compose message <span style="color: #0000ff">VIN OTP</span>
                                                send <span style="color: #0000ff">8079</span> to receive the authentication code</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5 style="margin-right: 25px"><span style="color: #0000ff">APP OTP:</span> If you have installed <span style="color: #0000ff">APP OTP</span>
                                                .Please turn it on <span style="color: #0000ff">APP OTP</span>  to get the authentication code.</h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="bsModal4" tabindex="-1" role="dialog"
                         aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content" style="width: 500px; display: block">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Enter OTP</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-5"><input class="form-control" type="text" id="maotptru"
                                                                     placeholder="Enter OTP"></div>
                                        <div class="col-sm-4"><select class="form-control" id="otpselecttru">
                                                <option value="0">OTP SMS</option>
                                                <option value="1">OTP APP</option>
                                            </select></div>
                                        <div class="col-sm-3"><input type="button" class="btn btn-primary" value="Deduction" id="truotp">
                                        </div>                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5 style="margin-right: 50px"><span style="color: #0000ff">SMS OTP:</span> Please compose message <span style="color: #0000ff">VIN OTP</span>
                                                send <span style="color: #0000ff">8079</span> to receive the authentication code</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5 style="margin-right: 25px"><span style="color: #0000ff">APP OTP:</span> If you have installed <span style="color: #0000ff">APP OTP</span>
                                                .Please turn it on <span style="color: #0000ff">APP OTP</span>  to get the authentication code.</h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php endif; ?>
<style>
    .spinner {
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
    }

</style>

<script>
    $("#chuyentien").click(function () {
        if ($("#nickname").val() == "") {
            $("#errorvin").html("You have not entered a nickname nhận");
            return false;
        }
        else if ($("#tienchuyen").val() == "") {
            $("#errorvin").html("You have not entered the transfer amount");
            return false;
        }
        else if ($("#tienchuyen").val() > 50000000) {
            $("#errorvin").html("Maximum transfer amount is 50,000,000");
            return false;
        } else if ($("#reasonchuyen").val() == "") {
            $("#errorvin").html("You have not entered a reason for the transfer");
            return false;
        } else if($("#checknickname").val() == -1) {
            $("#errorvin").html("Nickname does not exist");
            return false;
        }
        else if($("#checknickname").val() == -2) {
            $("#errorvin").html("System interruption");
            return false;
        }
		else {
            let isMobileSecure = <?= $this->session->userdata('isMobileSecure') ?>;
            if (isMobileSecure == 1) $("#bsModal3").modal('show');
            else contien();
            $("#errorvin").html("");
        }
    })
    $("#trutien").click(function () {
        if ($("#nickname").val() == "") {
            $("#errorvin").html("You have not entered a nickname");
            return false;
        }
        else if ($("#tienchuyen").val() == "") {
            $("#errorvin").html("You have not entered the deduction amount");
            return false;
        }
         else if ($("#reasonchuyen").val() == "") {
            $("#errorvin").html("You have not entered a reason for deduction");
            return false;
        } 
		 else if($("#checknickname").val() == -1) {
            $("#errorvin").html("Nickname does not exist");
            return false;
        }
        else if($("#checknickname").val() == -2) {
            $("#errorvin").html("System interruption");
            return false;
        } else {
            let isMobileSecure = <?= $this->session->userdata('isMobileSecure') ?>;
            if (isMobileSecure == 1) $("#bsModal4").modal('show');
            else trutien();
            $("#errorvin").html("");
        }
    })

    function contien() {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url("user/congtienajax") ?>",
            data: {
                nickname: $("#nickname").val(),
                tienchuyen: $("#tienchuyen").val(),
                money_type: $("#money_type").val(),
                reasonchuyen: $("#reasonchuyen").val(),
                maotpcong: $("#maotpcong").val(),
                otpselectcong:  $("#otpselectcong").val(),
                actionname :  $("#actionname").val()
            },
            dataType: 'json',
            success: function (result) {
                if(result == 1){
                    alert("You transferred money successfully");
                    $("#nickname").val("");
                    $("#tienchuyen").val("");
                    $("#reasonchuyen").val("");
                    $("#maotpcong").val("");
                    $("#otpselectcong").val("");
                    $("#numchuyen").text("");
                    $("#lblnickname").text("");
                    var baseurl = "<?php echo admin_url('user/congtrutien') ?>";
                    window.location.href = baseurl;
                }else if(result == 2){
                    alert("You failed to transfer money")
                }
                else if(result == 4){
                    alert("You entered the OTP incorrectly")
                }
                else if(result == 5){
                    alert("OTP code is wrong")
                }
                else if(result == 3){
                    alert("Account does not have enough money")
                }else if(result == 6){
                    alert("Account does not exist")
                }

            }
        })
    }

    $("#congotp").click(function () {
        contien();
    });

    function trutien() {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url("user/trutienajax") ?>",
            data: {
                nickname: $("#nickname").val(),
                tienchuyen: -$("#tienchuyen").val(),
                money_type: $("#money_type").val(),
                reasonchuyen: $("#reasonchuyen").val(),
                maotptru: $("#maotptru").val(),
                otpselecttru:  $("#otpselecttru").val(),
                actionname :  $("#actionname").val()
            },
            dataType: 'json',
            success: function (result) {
                if(result == 1){
                    alert("You deducted money successfully");
                    $("#nickname").val("");
                    $("#tienchuyen").val("");
                    $("#reasonchuyen").val("");
                    $("#maotptru").val("");
                    $("#otpselecttru").val("");
                    $("#numchuyen").text("");
                    $("#lblnickname").text("");
                    var baseurl = "<?php echo admin_url('user/congtrutien') ?>";
                    window.location.href = baseurl;
                }else if(result == 2){
                    alert("You failed to deduct money")
                }
                else if(result == 4){
                    alert("You entered the OTP incorrectly")
                }
                else if(result  == 5){
                    alert("OTP code is wrong")
                }
                else if(result == 3){
                    alert("Account does not have enough money")
                }else if(result == 6){
                    alert("Account does not exist")
                }

            }
        })
    }

    $("#truotp").click(function () {
        trutien();
    });

    $(document).ready(function () {
		  $( "#actionname" ).change(function() {
            if($("#actionname").val() == "Admin"){
                $("#trutien").show();
            }else if($("#actionname").val() == "EventVP"){
                $("#trutien").hide();
            }
        });
        $('#tienchuyen').on('paste', function (e) {
            let pastedData = e.originalEvent.clipboardData.getData('text');
            let money = parseInt(pastedData);
            if(isNaN(money) || money <= 0) {
                alert("Please enter a number greater than 0");
                e.preventDefault();
            }
        });
        $("#tienchuyen").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

    });
    var format = function(num){
        var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
        if(str.indexOf(".") > 0) {
            parts = str.split(".");
            str = parts[0];
        }
        str = str.split("").reverse();
        for(var j = 0, len = str.length; j < len; j++) {
            if(str[j] != ",") {
                output.push(str[j]);
                if(i%3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
            }
        }
        formatted = output.reverse().join("");
        return(formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };
    $("#tienchuyen").keyup(function (e) {
        $(this).val(($(this).val()));
        $("#numchuyen").text(format($(this).val()));

    });
	 function myFunction() {
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url("user/getnicknameajax") ?>",
            data: {
                nickname: $("#nickname").val()
            },
            dataType: 'json',
            success: function (res) {
                $("#checknickname").val(res);
                if (res == -2) {
                    $("#lblnickname").text("System interruption");
                    $("#errorvin").html("");
                }
                else if (res == -1) {
                    $("#lblnickname").text("Nickname does not exist");
                    $("#errorvin").html("");
                }
                else if (res == 0) {
                    $("#lblnickname").text("Regular account");
                    $("#errorvin").html("");
                }
                else if (res == 1) {
                    $("#lblnickname").text("Level 1 agent account");
                    $("#errorvin").html("");
                }
                else if (res == 2) {
                    $("#lblnickname").text("Level 2 agent account");
                    $("#errorvin").html("");
                }
                else if (res == 100) {
                    $("#lblnickname").text("Admin account");
                    $("#errorvin").html("");
                }
            }
        })
        if (!$("#nickname").val()) {
            return $('#balance-user').html('');
        }
        $.ajax({
         type: "POST",
         url: "<?php echo admin_url("usergame/uservinplayajax") ?>",
         data: {
             nickname: $("#nickname").val(),
             fieldname: 5,
             timkiemtheo: 2,
             pages: 1,
             record: 50
         },
         dataType: 'json',
         success: function (res) {
             if (res.transactions === 'undefined') {
                 return $('#balance-user').html('');
             }
             if (res.totalRecord != 1) {
                 return $('#balance-user').html('');
             }
             $('#balance-user').html(new Intl.NumberFormat().format(parseInt(res.transactions[0].vinTotal)));
         }
        })
    }
</script>