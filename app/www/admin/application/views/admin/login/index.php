<html>
<head>
    <link href="<?php echo public_url() ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo public_url() ?>/site/fonts/login/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet"/>

    <link href="<?php echo public_url() ?>/site/css/login/main.css" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo public_url() ?>/site/bootstrap/jquery.min.js"></script>
    <script src="<?php echo public_url() ?>/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.md5.js" type="text/javascript"></script>
    <title>Admin</title>
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="<?php echo public_url() ?>/site/images/login/img-01.png" alt="IMG">
            </div>

            <div class="login100-form validate-form">
					<span class="login100-form-title">
						Admin Login
					</span>

                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" id="param_username" name="username" placeholder="Username">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" id="param_password" type="password" name="pass" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div style="color:red;font-weight:blod;text-align:center"
                     id="validate-text"><?php if (isset($message) && $message): ?>
                        <?php echo $message ?><?php endif; ?></div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" id="login">
                        Login
                    </button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="bsModal3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="mySmallModalLabel">Enter odp</h4>
                </div>
                <div class="modal-body" style="height: 100px">

                    <input class="form-control" type="text" id="odplogin" placeholder="Nhập ODP">
                    <input type="button" class="blueB logMeIn pull-right" style="margin-top: 10px" value="Đăng nhập"
                           id="loginodp">
                </div>
                <div class="modal-footer">
                    <input type="button" class="blueB logMeIn pull-left" value="Get ODP" id="getodp">
                    <input type="button" class="dredB logMeIn" value="Get ODP back" id="getreodp">
                </div>
            </div>
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
        }
    </style>
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="
<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
</div>
<script>
    $('#param_password').keyup(function (e) {
        var enterKey = 13;
        if (e.which == enterKey) {
            if ($("#param_password").val() == "" && $("#param_username").val() == "") {
                $("#validate-text").html("You have not entered your username and password");
                return false;
            }
            if ($("#param_username").val() == "") {
                $("#validate-text").html("You have not entered your username");
                return false;
            }
            if ($("#param_password").val() == "") {
                $("#validate-text").html("You have not entered a password");
                return false;
            }
            $("#spinner").show();

            alert("<?php echo admin_url('login/loginODP')?>");
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('login/loginODP')?>",
                data: {
                    username: $("#param_username").val(),
                    password: $.md5($("#param_password").val())
                },
                dataType: 'json',
                success: function (res) {
                    $("#spinner").hide();
                    //alert(res);
                    if (res == 1) {
                        var baseurl = "<?php print admin_url(); ?>";
                        window.location.href = baseurl;
                    } else if (res == 2) {
                        $("#validate-text").html("The account is not an admin or agent");
                    } else if (res == 3) {
                        $("#validate-text").html("System interruption ");
                    } else if (res == 4) {
                        $("#validate-text").html("Username does not exist");
                    } else if (res == 5) {
                        $("#validate-text").html("Incorrect password");
                    } else if (res == 6) {
                        $("#validate-text").html("Account locked");
                    } else if (res == 7) {
                        $("#validate-text").html("Maintenance system");
                    } else if (res == 8) {
                        $("#validate-text").html("Account has not updated nickname");
                    } else if (res == 9) {
                        $("#validate-text").html("Account has not registered OTP");
                    }
                }, error: function () {
                    $("#spinner").hide();
                    alert("System interruption ");
                }
            });
        }
    });
    $("#login").click(function () {
        if ($("#param_password").val() == "" && $("#param_username").val() == "") {
            $("#validate-text").html("You have not entered your username and password");
            return false;
        }
        if ($("#param_username").val() == "") {
            $("#validate-text").html("You have not entered your username");
            return false;
        }
        if ($("#param_password").val() == "") {
            $("#validate-text").html("You have not entered a password");
            return false;
        }
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('login/loginODP')?>",
            data: {
                username: $("#param_username").val(),
                password: $.md5($("#param_password").val())
            },
            dataType: 'json',
            success: function (res) {
                $("#spinner").hide();
                console.log(res);
                if (res == 1) {
                    var baseurl = "<?php print admin_url(); ?>";
                    window.location.href = baseurl;
                } else if (res == 2) {
                    $("#validate-text").html("The account is not an admin or agent");
                } else if (res == 3) {
                    $("#validate-text").html("System interruption ");
                } else if (res == 4) {
                    $("#validate-text").html("Username does not exist");
                } else if (res == 5) {
                    $("#validate-text").html("Incorrect password");
                } else if (res == 6) {
                    $("#validate-text").html("Account locked");
                } else if (res == 7) {
                    $("#validate-text").html("Maintenance system");
                } else if (res == 8) {
                    $("#validate-text").html("Account has not updated nickname");
                } else if (res == 9) {
                    $("#validate-text").html("Account has not registered OTP");
                }
            }, error: function (xhr, textStatus, errorThrown) {
                console.log(xhr);
                $("#spinner").hide();
                alert("System interruption");
            }
        });
    })

    $("#getodp").click(function () {
        $.ajax({
            type: "GET",
            url: "http://103.117.145.122:8081/api?c=131&nn=" + $("#nickname").val(),
            crossDomain: true,
            contentType: "application/x-www-form-urlencoded",
            async: false,
            dataType: 'json',
            processData: false,
            cache: false,
            success: function (result) {
                if (result == 0) {
                    alert("You have successfully obtained the odp code")
                } else if (result == 1) {
                    alert("System error")
                } else if (result == 2) {
                    alert("Nickname does not exist")
                } else if (result == 4) {
                    alert("You have not registered for security on the win123.club site")
                } else if (result == 5) {
                    alert("You already got the odp, send a message to get it back")
                }

            }
        });
    });
    $("#getreodp").click(function () {
        alert("Please text OZZ ODP to 8041 to retrieve ODP")
    })

    $("#loginodp").click(function () {
        if ($("#odplogin").val() == "") {
            alert("You have not entered ODP yet");
            return false;
        }
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('login/loginODP')?>",
            data: {
                nickname: $("#nickname").val(),
                otp: $("#odplogin").val()
            },
            dataType: 'json',
            success: function (res) {
                if (res == 0) {

                    var baseurl = "<?php print admin_url(); ?>";
                    window.location.href = baseurl;
                } else if (res == 88) {
                    alert("The account is not authorized");
                } else if (res == 1) {
                    alert("System error")
                } else if (res == 2) {
                    alert("Nickname does not exist")
                } else if (res == 4) {
                    alert("You have not registered for security on vinplay.com")
                } else if (res == 5) {
                    alert("ODP is wrong")
                } else if (res == 6) {
                    alert("ODP expired")
                }
            }

        });
    })</script>
</body>
</html>

