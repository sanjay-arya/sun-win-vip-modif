<?php $this->load->view('admin/usergame/head', $this->data) ?>
<div class="line"></div>
<?php if ($role == false): ?>
    <div class="wrapper">
        <div class="widget">
            <div class="title">
                <h6>You are not authorized</h6>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="wrapper">
        <?php $this->load->view('admin/message', $this->data); ?>
        
        
        
        
        <script src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>
        <div class="widget">
            <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>

            <div class="title">
                <h6>List of registered accounts</h6>
                <h6 style="float: right">Total account number:<span style="color:#0000ff" id="numuser"></span></h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('usergame') ?>" method="post">
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser"
                                       >Since:</label></td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="toDate" name="toDate"
                                           value="<?php echo $this->input->post('toDate') ?>">
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                            </td>
                            <td>
                                <label for="param_name" 
                                       class="formLeft"> To date: </label>
                            </td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" id="fromDate" name="fromDate"
                                           value="<?php echo $this->input->post('fromDate') ?>">
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="formRow">
                    <table>
                        <tr>
                            <td><label  class="formLeft">Nickname:</label></td>
                            <td><input type="text" style="width: 208px"
                                       id="nickname" value="<?php echo $this->input->post('nickname') ?>"
                                       name="nickname">
                            </td>
                            <td>
                                <label for="param_name" 
                                       class="formLeft"> Display: </label>
                            </td>
                            <td class="item"><select id="record" name="record"
                                                     style="width: 208px">
                                    <option value="50" <?php if ($this->input->post('record') == 50) {
                                        echo "selected";
                                    } ?> >50
                                    </option>
                                    <option value="100" <?php if ($this->input->post('record') == 100) {
                                        echo "selected";
                                    } ?>>100
                                    </option>
                                    <option value="200" <?php if ($this->input->post('record') == 200) {
                                        echo "selected";
                                    } ?>>200
                                    </option>
                                </select>
                            </td>

                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" 
                                       class="formLeft"> Type: </label>
                            </td>
                            <?php if ($admin_info->Status == "M" || $admin_info->Status == "LM"): ?>
                                <td class="item"><select id="typetaikhoan" name="timkiemtheo"
                                                         style="width: 208px">
                                        <option value="0">Select</option>
                                    </select>
                                </td>
                            <?php else: ?>
                                <td class="item"><select id="typetaikhoan" name="typetaikhoan"
                                                         style="width: 208px">
                                        <option value="0" <?php if ($this->input->post('typetaikhoan') == "0") {
                                            echo "selected";
                                        } ?>>Regular account
                                        </option>
                                        <option value="1" <?php if ($this->input->post('typetaikhoan') == "1") {
                                            echo "selected";
                                        } ?> >Agency
                                        </option>
                                    </select>
                                </td>
                            <?php endif; ?>
                            <td><label  class="formLeft">Kiểu:</label></td>
                            <td><select id="taikhoanbot" name="taikhoanbot"
                                        style="width: 208px">
                                    <?php if ($admin_info->Status == "M" || $admin_info->Status == "L" || $admin_info->Status == "LM"): ?>
                                        <option value="0" <?php if ($this->input->post('taikhoanbot') == "0") {
                                            echo "selected";
                                        } ?>>People
                                        </option>
                                    <?php else: ?>
                                        <option value="0" <?php if ($this->input->post('taikhoanbot') == "0") {
                                            echo "selected";
                                        } ?>>People
                                        </option>
                                        <option value="1" <?php if ($this->input->post('taikhoanbot') == "1") {
                                            echo "selected";
                                        } ?>>Bot
                                        </option>
                                    <?php endif; ?>
                                </select></td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td><label  class="formLeft">Phone:</label></td>
                            <td><input type="text" style="width: 208px"
                                       id="phone" value="<?php echo $this->input->post('phone') ?>" name="phone"></td>
                            <td><label  class="formLeft">Email:</label></td>
                            <td><input type="text" style="width: 208px"
                                       id="txtemail" value="<?php echo $this->input->post('txtemail') ?>"
                                       name="txtemail"></td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td style="">
                                <input type="submit" id="search_tran" value="Search" class="button blueB"
                                       style="margin-left: 70px">
                            </td>
                            <td>
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('usergame') ?>'; "
                                       value="Reset" class="basic" style="margin-left: 20px">
                            </td>
                        </tr>
                    </table>
                </div>

            </form>
            <input type="hidden" value="<?php echo $admin_info->Status ?>" id="status">

            <div class="formRow">
                <div class="row">
                    <div class="col-xs-12">
                        <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                            <thead>
                            <tr style="height: 20px;">
                                <?php if ($admin_info->Status == "L") : ?>
                                    <td>No</td>
                                    <td>Login name</td>
                                    <td>Nickname</td>
                                    <td>Surplus Win</td>
                                    <!--                            <td>Surplus xu</td>-->
                                    <td>Win the safe</td>
                                    <td>Vippoint</td>
                                    <td>Phone security</td>
                                    <td>Email Security</td>
                                    <td>DN Security</td>
                                    <td>TG Security</td>
                                    <td>Date created</td>
                                <?php elseif ($admin_info->Status == "M") : ?>
                                    <td>No</td>
                                    <td>Login name</td>
                                    <td>Nickname</td>
                                    <td>Phone security</td>
                                    <td>Email Security</td>
                                    <td>DN Security</td>
                                    <td>TG Security</td>
                                    <td>Date created</td>
                                <?php elseif ($admin_info->Status == "LM") : ?>
                                    <td>No</td>
                                    <td>Login name</td>
                                    <td>Nickname</td>
                                    <td>Surplus Win</td>
                                    <!--                            <td>Surplus xu</td>-->
                                    <td>Win the safe</td>
                                    <td>Phone security</td>
                                    <td>Email Security</td>
                                    <td>DN Security</td>
                                    <td>TG Security</td>
                                    <td>Date created</td>
                                <?php elseif ($admin_info->Status == "S" || $admin_info->Status == "D"): ?>
                                    <td>No</td>
                                    <td>Login name</td>
                                    <td>Nickname</td>
                                    <td>Phone number</td>
                                    <td>Surplus Win</td>
                                    <!--                            <td>Surplus xu</td>-->
                                    <td>Win the safe</td>
                                    <td>Vippoint</td>
                                    <td>Phone security</td>
                                    <td>Email Security</td>
                                    <td>DN Security</td>
                                    <td>TG Security</td>
                                    <td>Date created</td>
                                <?php
                                else: ?>
                                    <td>No</td>
                                    <td>Username</td>
                                    <td>Nickname</td>
                                    <td>Surplus Win</td>
                                    <!--                            <td>Surplus xu</td>-->
                                    <td>Win KS number</td>
                                    <td>Vippoint</td>
                                    <td>Phone security</td>
                                    <td>Email Security</td>
                                    <td>Email</td>
                                    <td>CMND</td>
                                    <td>Phone</td>
                                    <td>Account</td>
                                    <td>DN Security</td>
                                    <td>TG Security</td>
                                    <td>Date created</td>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody id="logaction">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<style>
    td {
        word-break: break-all;
    }

    thead {
        font-size: 12px;
    }

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
    }</style>
<div class="container">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>
</div>
<script>

    $(function () {
        var startDate = moment(new Date()).hours(0).minutes(0).seconds(0).milliseconds(0)
        var endDate = moment(new Date()).hours(23).minutes(59).seconds(59).milliseconds(59)

        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            // defaultDate: startDate,
            useCurrent: false,
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            // defaultDate: endDate,
            useCurrent: false,
        });
        // $('#datetimepicker1').data("DateTimePicker").maxDate(endDate);
        // $('#datetimepicker2').data("DateTimePicker").minDate(startDate);
        //
        // $("#datetimepicker1").on("dp.change", function (e) {
        //     $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
        //
        // });
        // $("#datetimepicker2").on("dp.change", function (e) {
        //     $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
        // });
    });

    $("#search_tran").click(function () {
        var fromDatetime = $("#toDate").val();
        var toDatetime = $("#fromDate").val();
        if (fromDatetime > toDatetime) {
            alert('The end date must be greater than the start date')
            return false;
        }
    });

    function resultSearchTransction(stt, username, nickname, vin, xu, safe, vippoint, phone, date, status, serphone, sermail, email, cmnd, taikhoan, iotp, time, googleid, facebookid) {

        var rs = "";

        if ($("#status").val() == "L") {
            rs += "<tr>";
            rs += "<td>" + stt + "</td>";
            if (username == null) {
                if (googleid != null) {
                    rs += "<td><a title='Repair the bridge'  style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + "GG_" + googleid + "</a></td>";
                } else if (facebookid != null) {
                    rs += "<td><a title='Repair the bridge'  style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + "FB_" + facebookid + "</a></td>";
                }
            } else {
                rs += "<td><a title='Repair the bridge'  style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + username + "</a></td>";
            }
            rs += "<td>" + nickname + "</td>";
            rs += "<td>" + commaSeparateNumber(vin) + "</td>";
            // rs += "<td>" + commaSeparateNumber(xu) + "</td>";
            rs += "<td>" + commaSeparateNumber(safe) + "</td>";
            rs += "<td>" + vippoint + "</td>";

            if (serphone == 1) {

                rs += "<td>" + "Have" + "</td>";
            } else {
                rs += "<td>" + "Are not" + "</td>";
            }
            if (sermail == 1) {
                rs += "<td>" + "Have" + "</td>";
            } else {
                rs += "<td>" + "Are not" + "</td>";
            }
            if (iotp < 0) {
                rs += "<td>" + "Are not" + "</td>";
            } else if (iotp >= 0) {
                rs += "<td>" + "Have" + "</td>";
            }
            if (time == null) {
                rs += "<td>" + "" + "</td>";
            } else {
                rs += "<td>" + time + "</td>";
            }
            rs += "<td>" + date + "</td>";
            rs += "</tr>";
        } else if ($("#status").val() == "M") {
            rs += "<tr>";
            rs += "<td>" + stt + "</td>";
            if (username == null) {
                if (googleid != null) {
                    rs += "<td><a title='Repair the bridge'  style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + "GG_" + googleid + "</a></td>";
                } else if (facebookid != null) {
                    rs += "<td><a title='Repair the bridge'  style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + "FB_" + facebookid + "</a></td>";
                }
            } else {
                rs += "<td><a title='Repair the bridge'  style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + username + "</a></td>";
            }
            rs += "<td>" + nickname + "</td>";
            if (serphone == 1) {

                rs += "<td>" + "Have" + "</td>";
            } else {
                rs += "<td>" + "Are not" + "</td>";
            }
            if (sermail == 1) {
                rs += "<td>" + "Have" + "</td>";
            } else {
                rs += "<td>" + "Are not" + "</td>";
            }
            if (iotp < 0) {
                rs += "<td>" + "Are not" + "</td>";
            } else if (iotp >= 0) {
                rs += "<td>" + "Have" + "</td>";
            }
            if (time == null) {
                rs += "<td>" + "" + "</td>";
            } else {
                rs += "<td>" + time + "</td>";
            }
            rs += "<td>" + date + "</td>";
            rs += "</tr>";
        } else if ($("#status").val() == "LM") {
            rs += "<tr>";
            rs += "<td>" + stt + "</td>";
            if (username == null) {
                if (googleid != null) {
                    rs += "<td><a title='Repair the bridge'  style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + "GG_" + googleid + "</a></td>";
                } else if (facebookid != null) {
                    rs += "<td><a title='Repair the bridge'  style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + "FB_" + facebookid + "</a></td>";
                }
            } else {
                rs += "<td><a title='Repair the bridge'  style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + username + "</a></td>";
            }
            rs += "<td>" + nickname + "</td>";
            rs += "<td>" + commaSeparateNumber(vin) + "</td>";
            // rs += "<td>" + commaSeparateNumber(xu) + "</td>";
            rs += "<td>" + commaSeparateNumber(safe) + "</td>";
            if (serphone == 1) {

                rs += "<td>" + "Have" + "</td>";
            } else {
                rs += "<td>" + "Are not" + "</td>";
            }
            if (sermail == 1) {
                rs += "<td>" + "Have" + "</td>";
            } else {
                rs += "<td>" + "Are not" + "</td>";
            }
            if (iotp < 0) {
                rs += "<td>" + "Are not" + "</td>";
            } else if (iotp >= 0) {
                rs += "<td>" + "Have" + "</td>";
            }
            if (time == null) {
                rs += "<td>" + "" + "</td>";
            } else {
                rs += "<td>" + time + "</td>";
            }
            rs += "<td>" + date + "</td>";
            rs += "</tr>";
        } else if ($("#status").val() == "S" || $("#status").val() == "D") {

            rs += "<tr>";
            rs += "<td>" + stt + "</td>";
            if (username == null) {
                if (googleid != null) {
                    rs += "<td><a title='Repair the bridge'  style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + "GG_" + googleid + "</a></td>";
                } else if (facebookid != null) {
                    rs += "<td><a title='Repair the bridge'  style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + "FB_" + facebookid + "</a></td>";
                }
            } else {
                rs += "<td><a title='Repair the bridge'  style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + username + "</a></td>";
            }
            rs += "<td>" + nickname + "</td>";
            if (phone == null) {
                rs += "<td>" + "" + "</td>";
            } else {
                rs += "<td>" + phone + "</td>";
            }
            rs += "<td>" + commaSeparateNumber(vin) + "</td>";
            // rs += "<td>" + commaSeparateNumber(xu) + "</td>";
            rs += "<td>" + commaSeparateNumber(safe) + "</td>";
            rs += "<td>" + vippoint + "</td>";
            if (serphone == 1) {

                rs += "<td>" + "Have" + "</td>";
            } else {
                rs += "<td>" + "Are not" + "</td>";
            }
            if (sermail == 1) {
                rs += "<td>" + "Have" + "</td>";
            } else {
                rs += "<td>" + "Are not" + "</td>";
            }
            if (iotp < 0) {
                rs += "<td>" + "Are not" + "</td>";
            } else if (iotp >= 0) {
                rs += "<td>" + "Have" + "</td>";
            }
            if (time == null) {
                rs += "<td>" + "" + "</td>";
            } else {
                rs += "<td>" + time + "</td>";
            }
            rs += "<td>" + date + "</td>";
            rs += "</tr>";
        } else {

            rs += "<tr>";
            rs += "<td>" + stt + "</td>";
            if (username == null) {
                if (googleid != null) {
                    rs += "<td><a title='Repair the bridge'  style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + "GG_" + googleid + "</a></td>";
                } else if (facebookid != null) {
                    rs += "<td><a title='Repair the bridge'  style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + "FB_" + facebookid + "</a></td>";
                }
            } else {
                rs += "<td><a title='Repair the bridge'  style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + username + "</a></td>";
            }
            rs += "<td><a title='Repair the bridge' style = 'color:#0000FF' class='open' href='<?php echo admin_url('usergame/lockuser') ?>" + "/" + nickname + "/" + status + "'>" + nickname + "</a></td>";
            rs += "<td>" + commaSeparateNumber(vin) + "</td>";
            // rs += "<td>" + commaSeparateNumber(xu) + "</td>";
            rs += "<td>" + commaSeparateNumber(safe) + "</td>";
            rs += "<td>" + vippoint + "</td>";
            if (serphone == 1) {

                rs += "<td>" + "Have" + "</td>";
            } else {
                rs += "<td>" + "Are not" + "</td>";
            }
            if (sermail == 1) {
                rs += "<td>" + "Have" + "</td>";
            } else {
                rs += "<td>" + "Are not" + "</td>";
            }
            if (email == null) {
                rs += "<td>" + "" + "</td>";
            } else {
                rs += "<td>" + email + "</td>";
            }
            if (cmnd == null) {
                rs += "<td>" + "" + "</td>";
            } else {
                rs += "<td>" + cmnd + "</td>";
            }
            if (phone == null) {
                rs += "<td>" + "" + "</td>";
            } else {
                rs += "<td>" + phone + "</td>";
            }
            if (taikhoan == 0) {
                rs += "<td>" + "Often" + "</td>";
            } else if (taikhoan == 1) {
                rs += "<td>" + "Bot" + "</td>";
            }
            if (iotp < 0) {
                rs += "<td>" + "Are not" + "</td>";
            } else if (iotp >= 0) {
                rs += "<td>" + "Have" + "</td>";
            }
            if (time == null) {
                rs += "<td>" + "" + "</td>";
            } else {
                rs += "<td>" + time + "</td>";
            }
            rs += "<td>" + date + "</td>";
            rs += "</tr>";
        }
        return rs;
    }

    $(document).ready(function () {
        var oldPage = 0;
        var result = "";
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('usergame/indexajax')?>",
            // url: "http://192.168.0.251:8082/api_backend",
            data: {
                username: $("#username").val(),
                nickname: $("#nickname").val(),
                phone: $("#phone").val(),
                fieldname: $("#fieldname").val(),
                timkiemtheo: $("#timkiemtheo").val(),
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                typetaikhoan: $("#typetaikhoan").val(),
                pages: 1,
                record: $("#record").val(),
                taikhoanbot: $("#taikhoanbot").val(),
                typetk: $("#typetimkiem").val(),
                email: $("#txtemail").val()
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.transactions == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("No results were found");
                } else {
                    $("#resultsearch").html("");
                    $("#numuser").html(result.totalRecord);
                    var totalPage = result.total;
                    stt = 1;
                    $.each(result.transactions, function (index, value) {
                        result += resultSearchTransction(stt, value.username, value.nickname, value.vinTotal, value.xuTotal, value.safe, value.vippoint, value.mobile, value.createTime, value.status, value.hasMobileSecurity, value.hasEmailSecurity, value.email, value.identification, value.bot, value.loginOtp, value.securityTime, value.google_id, value.facebook_id);
                        stt++
                    });
                    $('#logaction').html(result);
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldPage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('usergame/indexajax')?>",
                                    // url: "http://192.168.0.251:8082/api_backend",
                                    data: {
                                        username: $("#username").val(),
                                        nickname: $("#nickname").val(),
                                        phone: $("#phone").val(),
                                        fieldname: $("#fieldname").val(),
                                        timkiemtheo: $("#timkiemtheo").val(),
                                        toDate: $("#toDate").val(),
                                        fromDate: $("#fromDate").val(),
                                        typetaikhoan: $("#typetaikhoan").val(),
                                        pages: page,
                                        record: $("#record").val(),
                                        taikhoanbot: $("#taikhoanbot").val(),
                                        typetk: $("#typetimkiem").val(),
                                        email: $("#txtemail").val()

                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = 1;
                                        $.each(result.transactions, function (index, value) {
                                            result += resultSearchTransction(stt, value.username, value.nickname, value.vinTotal, value.xuTotal, value.safe, value.vippoint, value.mobile, value.createTime, value.status, value.hasMobileSecurity, value.hasEmailSecurity, value.email, value.identification, value.bot, value.loginOtp, value.securityTime, value.google_id, value.facebook_id);
                                            stt++
                                        });
                                        $('#logaction').html(result);
                                    }, error: function () {
                                        $("#spinner").hide();
                                        $('#logaction').html("");
                                        $("#resultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
                                    }, timeout: 20000
                                });
                            }
                            oldPage = page;
                        }
                    });

                }
            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
            }, timeout: 20000
        })

    });
</script>
<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
</script>
