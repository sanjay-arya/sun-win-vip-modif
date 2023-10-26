<?php $this->load->view('admin/usergame/head', $this->data) ?>
<div class="line"></div>
<?php if($role == false): ?>
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


    <div class="widget">
        <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>
        <div class="title">
            <h6>List of vippoint accounts</h6>
            <h6 style="float: right">Total account number:<span style="color:#0000ff" id="numuser"></span></h6>
        </div>
        <form class="list_filter form" action="<?php echo admin_url('usergame/uservippoint') ?>" method="post">
            <div class="formRow">
                <table>
                    <tr>
                        <td>
                            <label for="param_name" class="formLeft" id="nameuser"
                                   style="margin-left: 70px;margin-bottom:-2px;width: 100px">Since:</label></td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" id="toDate" name="toDate" value="<?php echo $this->input->post('toDate') ?>"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                            </div>                        </td>

                        <td>
                            <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                                   class="formLeft"> To date: </label>
                        </td>
                        <td class="item">

                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" id="fromDate" name="fromDate" value="<?php echo $this->input->post('fromDate') ?>"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="formRow">

                <table>
                    <tr>
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 120px">Login name:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="username" value="<?php echo $this->input->post('username') ?>" name="username">
                        </td>
                        <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Nickname:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="nickname" value="<?php echo $this->input->post('nickname') ?>" name="nickname">
                        </td>                    </tr>
                </table>
            </div>

            <div class="formRow">
                <table>
                    <tr>
                        <td>
                            <label for="param_name" style="width: 120px;margin-bottom:-3px;margin-left: 23px;"
                                   class="formLeft"> Sắp xếp theo: </label>
                        </td>
                        <td class="item"><select id="fieldname" name="fieldname"
                                                 style="margin-left: 27px;margin-bottom:-2px;width: 142px">
                                <option value="">Select</option>
                                <option value="1" <?php if($this->input->post('fieldname') == 1 ){echo "selected";} ?>>Win</option>
                                <option value="3" <?php if($this->input->post('fieldname') == 3 ){echo "selected";} ?>>Safe</option>
                                <option value="4" <?php if($this->input->post('fieldname') == 4 ){echo "selected";} ?>>Vippoint</option>
                                <option value="5" <?php if($this->input->post('fieldname') == 5 ){echo "selected";} ?>>Vippoint accumulation</option>
                                <option value="6" <?php if($this->input->post('fieldname') == 6 ){echo "selected";} ?>>Nạp tiền</option>
                            </select>
                        </td>
                        <td>
                            <label for="param_name" style="width: 115px;margin-bottom:-3px;margin-left: 47px;"
                                   class="formLeft"> Điều kiện: </label>
                        </td>
                        <td class="item"><select id="timkiemtheo" name="timkiemtheo"
                                                 style="margin-left: 5px;margin-bottom:-2px;width: 150px">
                                <option value="">Select</option>
                                <option value="1" <?php if($this->input->post('timkiemtheo') == 1 ){echo "selected";} ?>>Tăng dần</option>
                                <option value="2" <?php if($this->input->post('timkiemtheo') == 2 ){echo "selected";} ?> >Giảm dần</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="formRow">
                <table>
                    <tr>

                        <td>
                            <label for="param_name" style="width: 115px;margin-bottom:-3px;margin-left: 47px;"
                                   class="formLeft"> Type tài khoản: </label>
                        </td>
                        <?php if($admin_info->Status == "M" || $admin_info->Status == "S" ): ?>
                            <td class="item"><select id="typetaikhoan" name="timkiemtheo"
                                                     style="margin-left: 5px;margin-bottom:-2px;width: 150px">
                                    <option value="0">Select</option>
                                </select>
                            </td>
                        <?php else:?>
                            <td class="item"><select id="typetaikhoan" name="typetaikhoan"
                                                     style="margin-left: 5px;margin-bottom:-2px;width: 150px">
                                    <option value=""<?php if($this->input->post('typetaikhoan') == "" ){echo "selected";} ?>>Select</option>
                                    <option value="0" <?php if($this->input->post('typetaikhoan') == "0" ){echo "selected";} ?>>Regular account</option>
                                    <option value="1" <?php if($this->input->post('typetaikhoan') == "1" ){echo "selected";} ?> >Agency cấp 1</option>
                                </select>
                            </td>
                        <?php endif ;?>
                        <td>
                            <label for="param_name" style="width: 115px;margin-bottom:-3px;margin-left: 47px;"
                                   class="formLeft"> Display: </label>
                        </td>
                        <td class="item"><select id="record" name="record"
                                                 style="margin-left: 5px;margin-bottom:-2px;width: 150px">
                                <option value="50" <?php if($this->input->post('record') == 50 ){echo "selected";} ?> >50</option>
                                <option value="100" <?php if($this->input->post('record') == 100 ){echo "selected";} ?>>100</option>
                                <option value="200" <?php if($this->input->post('record') == 200 ){echo "selected";} ?>>200</option>
                                <option value="500" <?php if($this->input->post('record') == 500 ){echo "selected";} ?>>500</option>
                                <option value="1000" <?php if($this->input->post('record') == 1000 ){echo "selected";} ?>>1000</option>
                                <option value="2000" <?php if($this->input->post('record') == 2000 ){echo "selected";} ?>>2000</option>
                                <option value="5000" <?php if($this->input->post('record') == 5000 ){echo "selected";} ?>>5000</option>
                            </select>
                        </td>

                    </tr>
                </table>
            </div>

            <div class="formRow">
                <table>
                    <tr>
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Phone:</label></td>
                        <td><input type="text" style="margin-left: 40px;margin-bottom:-2px;width: 150px"
                                   id="phone" value="<?php echo $this->input->post('phone') ?>" name="phone"></td>
                        <td><label style="margin-left: 47px;margin-bottom:-2px;width: 100px">Email:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="txtemail" value="<?php echo $this->input->post('txtemail') ?>" name="txtemail"></td>

                    </tr>
                </table>
            </div>
            <div class="formRow">
                <table>
                    <tr>

                        <td><label style="margin-left: 47px;margin-bottom:-2px;width: 100px">Type tìm kiếm:</label></td>
                        <td><select id="typetimkiem" name="typetimkiem"
                                    style="margin-left: 20px;margin-bottom:-2px;width: 150px">
                                <?php if ($admin_info->Status == "M" || $admin_info->Status == "L" || $admin_info->Status == "LM"): ?>
                                    <option value="0" <?php if ($this->input->post('typetimkiem') == "0") {
                                        echo "selected";
                                    } ?>>Tìm chính xác
                                    </option>
                                <?php else: ?>
                                    <option value="0" <?php if ($this->input->post('typetimkiem') == "0") {
                                        echo "selected";
                                    } ?>>Tìm chính xác
                                    </option>
                                    <option value="1" <?php if ($this->input->post('typetimkiem') == "1") {
                                        echo "selected";
                                    } ?>>Tìm gần đúng
                                    </option>
                                <?php endif; ?>
                            </select></td>
                        <td style="">
                            <input type="submit" id="search_tran" value="Search" class="button blueB"
                                   style="margin-left: 70px">
                        </td>
                        <td>
                            <input type="reset"
                                   onclick="window.location.href = '<?php echo admin_url('usergame/uservippoint') ?>'; "
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
                                <td>No</td>
                                <td>Username</td>
                                <td>Nickname</td>
                                <td>Surplus Win</td>
                                <td>No. Win the safe</td>
                                <td>Vippoint h iện tại</td>
                                <td>Vippoint accumulation</td>
                                <td>Vippoint event</td>
                                <td>VIP level</td>
                                <td>Money loaded</td>
                                <td>Date created</td>
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
    td{
        word-break: break-all;
    }
    thead{
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
    $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD 00:00:00'
    });
    $('#datetimepicker2').datetimepicker({
        format: 'YYYY-MM-DD 23:59:59'
    });

});
$("#search_tran").click(function () {
    var fromDatetime = $("#toDate").val();
    var toDatetime = $("#fromDate").val();
    if (fromDatetime > toDatetime) {
        alert('The end date must be greater than the start date')
        return false;
    }
});
function resultSearchTransction(stt, username, nickname, vin, xu, safe, vippoint,vpsave,vpevent,recharge, date,googleid,facebookid) {

    var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        if(username == null){
            if(googleid != null){
                rs += "<td>"+"GG_"+ googleid + "</td>";
            }else if(facebookid != null){
                rs += "<td>" +"FB_"+ facebookid + "</td>";
            }
        }else{
            rs += "<td>" + username + "</td>";
        }
        rs += "<td>" + nickname + "</td>";
        rs += "<td>" + commaSeparateNumber(vin) + "</td>";
        rs += "<td>" + commaSeparateNumber(safe) + "</td>";
        rs += "<td>" + vippoint + "</td>";
        rs += "<td>" + vpsave + "</td>";
        rs += "<td>" + vpevent + "</td>";
        rs += "<td>" + bacVippoint(vpsave) + "</td>";
        rs += "<td>" + commaSeparateNumber(recharge) + "</td>";
        rs += "<td>" + date + "</td>";
    return rs;
}
$(document).ready(function () {
    var oldPage = 0;
    var result = "";
    $('#pagination-demo').css("display", "block");
    $("#spinner").show();
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('usergame/uservinplayajax')?>",
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
            pages : 1,
            record: $("#record").val(),
            typetk : $("#typetimkiem").val(),
            email : $("#txtemail").val()

        },

        dataType: 'json',
        success: function (result) {
            $("#numuser").html(result.totalRecord);
            $("#spinner").hide();
            if (result.transactions == "") {
                $('#pagination-demo').css("display", "none");
                $("#resultsearch").html("No results were found");
            }else {
                $("#resultsearch").html("");
                var totalPage = result.total;
                stt = 1;
                $.each(result.transactions, function (index, value) {
                    result += resultSearchTransction(stt, value.username, value.nickname, value.vinTotal, value.xuTotal, value.safe, value.vippoint, value.vippointSave, 0, value.rechargeMoney, value.createTime, value.google_id, value.facebook_id);
                    stt++;
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
                                url: "<?php echo admin_url('usergame/uservinplayajax')?>",
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
                                    pages : page,
                                    record: $("#record").val(),
                                    typetk : $("#typetimkiem").val(),
                                    email : $("#txtemail").val()

                                },
                                dataType: 'json',
                                success: function (result) {
                                    $("#resultsearch").html("");
                                    $("#spinner").hide();
                                    stt = 1;
                                    $.each(result.transactions, function (index, value) {
                                        result += resultSearchTransction(stt, value.username, value.nickname, value.vinTotal, value.xuTotal, value.safe, value.vippoint, value.vippointSave, 0, value.rechargeMoney, value.createTime, value.google_id, value.facebook_id);
                                        stt++;
                                    });
                                    $('#logaction').html(result);
                                }, error: function () {
                                    $("#spinner").hide();
                                    $('#logaction').html("");
                                    $("#resultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
                                },timeout : 20000
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
        },timeout : 20000
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

    function bacVippoint(strVip){
        var strresult;
        if(strVip>=0 && strVip <= 800){
            strresult = "Đồng";
        }else if(strVip > 800 && strVip <= 4500){
            strresult = "Bạc";
        }else if(strVip > 4500 && strVip <= 8600){
            strresult = "Vàng";
        }else if(strVip > 8600 && strVip <= 50000){
            strresult = "Bạch Kim";
        }else if(strVip > 50000){
            strresult = "Kim Cương";
        }
        return strresult;
    }
</script>