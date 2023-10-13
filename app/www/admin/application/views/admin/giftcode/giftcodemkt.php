<?php $this->load->view('admin/giftcode/head', $this->data) ?>
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
        <div class="widget">
            <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>

            <div class="title">
                <h6>List of giftcodes</h6>

                <div class="num f12">Total number of giftcodes: <b id="num"></b></div>
            </div>
            <form class="list_filter form">
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser"
                                       style="margin-left: 70px;margin-bottom:-2px;width: 100px">Since:</label></td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="toDate" name="toDate"
                                           value="<?php echo $this->input->post('toDate') ?>"> <span
                                        class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>                            </td>

                            <td>
                                <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                                       class="formLeft"> To date: </label>
                            </td>
                            <td class="item">

                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" id="fromDate" name="fromDate"
                                           value="<?php echo $this->input->post('fromDate') ?>"> <span
                                        class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>
                            </td>                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td hidden><label style="margin-left: 90px;margin-bottom:-2px;width: 60px">Money:</label></td>
                            <td hidden>
                                <select id="money" name="money"
                                        style="margin-left: 20px;margin-bottom:-2px;width: 145px">
                                    <option value="1">Win</option>
                                    <option value="0">Coin</option>
                                </select>
                            </td>                            <td><label id="labelvin" style="margin-left: 60px;margin-bottom:-2px;width: 70px;">Status</label></td>
                            <td><select id="gcuse" name="gcuse"
                                        style="margin-left: 35px;margin-bottom:-2px;width: 145px;">
                                    <option value="">Select</option>
                                    <option value="1">Used</option>
                                    <option value="0">Not yet used</option>
                                </select></td>
                            <td><label id="labelvin" style="margin-left: 50px;margin-bottom:-2px;width: 100px;">Denominations Win</label></td>
                            <td><select id="menhgiavin" name="menhgiavin"
                                        style="margin-left: 20px;margin-bottom:-2px;width: 145px;">
                                    <option value="">Select</option>
                                    <option value="10">10K Win</option>
                                    <option value="20">20K Win</option>
                                    <option value="50">50K Win</option>
                                    <option value="100">100K Win</option>
                                    <option value="200">200K Win</option>
                                </select></td>
                        </tr>
                    </table>

                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td hidden><label id="labelvin" style="margin-left: 45px;margin-bottom:-2px;width: 100px;">Denominations coin</label></td>
                            <td hidden><select id="menhgiaxu" name="menhgiaxu"
                                        style="margin-left: 20px;margin-bottom:-2px;width: 145px;">
                                    <option value="">Select</option>
                                    <option value="1">1M coin</option>
                                    <option value="3">3M coin</option>
                                    <option value="5">5M coin</option>
                                    <option value="9">9M coin</option>
                                </select></td>
                        </tr>
                    </table>
                </div>

                <div class="formRow">
                    <table>
                        <tr>

                            <td>
                                <label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Nickname:</label></td>
                            <td>
                                <input style="margin-left: 20px;height:25px;width: 145px" id="nickname" name="nickname">
                            </td>
                            <td>
                                <label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Giftcode:</label></td>
                            <td>
                                <input style="height:25px;width: 145px;margin-left:20px;" id="giftcode" name="giftcode">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Output source:</label>
                            </td>
                            <td class="item">
                                <select id="nguonxuat" class="" name="nguonxuat" style="margin-left: 20px;width:138px">
                                    <option value="">All</option>
                                    <option value="">Giftcode Marketing</option>
                                    <?php foreach ($sourcemkt as $row): ?>
                                        <option
                                            value="<?php echo $row->key ?>" <?php if ($this->input->post("nguonxuat") == $row->key) {
                                            echo "selected";
                                        } ?>><?php echo '------' . $row->name ?></option>
                                    <?php endforeach; ?>
                                    <option value="">Giftcode operates</option>
                                    <?php foreach ($sourcevh as $row): ?>
                                        <option
                                            value="<?php echo $row->key ?>" <?php if ($this->input->post("nguonxuat") == $row->key) {
                                            echo "selected";
                                        } ?>><?php echo '------' . $row->name ?></option>
                                    <?php endforeach; ?>
                                    <option value="">Giftcode agent</option>
                                    <?php foreach ($sourcedl as $row): ?>
                                        <option
                                            value="<?php echo $row->key ?>" <?php if ($this->input->post("nguonxuat") == $row->key) {
                                            echo "selected";
                                        } ?>><?php echo '------' . $row->nameagent . '(' . $row->nickname . ')' ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </td>
                            <td>
                                <label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Giftcode type:</label>
                            </td>
                            <td class="item">
                                <select id="typegiftcode" class="" name="typegiftcode"
                                        style="margin-left: 20px;width:138px">
                                    <option value="" <?php if ($this->input->post("typegiftcode") == "") {
                                        echo "selected";
                                    } ?>>Select
                                    </option>
                                    <option value="1" <?php if ($this->input->post("typegiftcode") == "1") {
                                        echo "selected";
                                    } ?>>Giftcode agent
                                    </option>
                                    <option value="2" <?php if ($this->input->post("typegiftcode") == "2") {
                                        echo "selected";
                                    } ?>>Giftcode marketing
                                    </option>
                                    <option value="3" <?php if ($this->input->post("typegiftcode") == "3") {
                                        echo "selected";
                                    } ?>>Giftcode operates
                                    </option>                                </select>
                            </td>

                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Search by:</label>
                            </td>
                            <td>
                            <select name="filterdate"  id="filterdate"  style="margin-left: 20px;width:138px">
                                <option value="1" <?php if ($this->input->post("filterdate") == "1") {echo "selected";} ?>>Date created</option>
                                <option value="2" <?php if ($this->input->post("filterdate") == "2") {echo "selected";} ?>>Date</option>
                            </select>
                            </td>
                            <td style="">
                                <input type="button" id="search_tran" value="Search" class="button blueB"
                                       style="margin-left: 55px">
                            </td>
                            <td>
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('giftcode/giftcodemkt') ?>'; "
                                       value="Reset" class="basic" style="margin-left: 20px">
                            </td>
                        </tr>
                    </table>
                </div>

            </form>
            <div class="formRow">
            </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                <tr style="height: 20px;">
                    <td>No</td>
                    <td>Denominations</td>
                    <td>GiftCode</td>
                    <td>Nickname</td>
                    <td>Salary amount</td>
                    <td>Status</td>
                    <td>Date created</td>
                    <td>Date</td>
                </tr>
                </thead>
                <tbody id="logaction">
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div class="container" style="margin-top:150px;">
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-sm"></ul>
    </div>
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
</div>
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
    }</style>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<script>
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });

    });
    $("#search_tran").click(function () {
        var fromDatetime = $("#toDate").val();
        var toDatetime = $("#fromDate").val();
        if (fromDatetime > toDatetime) {
            alert('The end date must be greater than the start date')
            return false;
        }
        if ($("#nickname").val() == "" && $("#giftcode").val() == "") {
            alert("You have not entered a nickname or giftcode");
            return false;
        }
        $('#pagination-demo').css("display", "block");
        if ($("#money").val() == 1) {
            $("#spinner").show();
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('giftcode/giftcodemktajax') ?>",
                data: {
                    nickname: $("#nickname").val(),
                    giftcode: $("#giftcode").val(),
                    menhgiavin: $("#menhgiavin").val(),
                    source: $("#nguonxuat").val(),
                    toDate: $("#toDate").val(),
                    fromDate: $("#fromDate").val(),
                    money: $("#money").val(),
                    pages: 1,
                    gcuse: $("#gcuse").val(),
                    typegc: $("#typegiftcode").val(),
                    filterdate: $("#filterdate").val()
                },
                dataType: 'json',
                success: function (result) {
                    $("#spinner").hide();
                    var totalPage = result.total;
                    var countrow = result.totalRecord;
                    $("#num").html(countrow);
                    if (result.transactions == "") {
                        $('#pagination-demo').css("display", "none");
                        $("#resultsearch").html("No results were found");
                        $('#logaction').html("");
                    } else {
                        $("#resultsearch").html("");
                        stt = 1;
                        $.each(result.transactions, function (index, value) {
                            result += resultgiftcodevin(stt, value.price, value.giftCode, value.nickName, value.quantity, value.createTime, value.useGiftCode, value.updateTime);
                            stt++;
                        });
                        $('#logaction').html(result);
                        var table = $('#checkAll').DataTable({
                            "ordering": true,
                            "searching": true,
                            "paging": false,
                            "draw": false,
                            "retrieve": true

                        });
                    }

                }, error: function () {
                    $("#spinner").hide();
                    $('#logaction').html("");
                    $("#resultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
                }, timeout: 40000
            })
        } else if ($("#money").val() == 0) {
            $("#spinner").show();
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('giftcode/giftcodemktajax') ?>",
                data: {
                    nickname: $("#nickname").val(),
                    giftcode: $("#giftcode").val(),
                    menhgiaxu: $("#menhgiaxu").val(),
                    source: $("#nguonxuat").val(),
                    toDate: $("#toDate").val(),
                    fromDate: $("#fromDate").val(),
                    money: $("#money").val(),
                    pages: 1,
                    gcuse: $("#gcuse").val(),
                    typegc: $("#typegiftcode").val(),
                    filterdate: $("#filterdate").val()
                },
                dataType: 'json',
                success: function (result) {
                    $("#spinner").hide();
                    var totalPage1 = result.total;
                    var countrow = result.totalRecord;
                    $("#num").html(countrow);
                    if (result.transactions == "") {
                        $('#pagination-demo').css("display", "none");
                        $("#resultsearch").html("No results were found");
                        $('#logaction').html("");
                    } else {
                        $("#resultsearch").html("");
                        stt = 1;
                        $.each(result.transactions, function (index, value) {
                            result += resultgiftcodevin(stt, value.price, value.giftCode, value.nickName, value.quantity, value.createTime, value.useGiftCode, value.updateTime);
                            stt++;
                        });
                        $('#logaction').html(result);
                        var table = $('#checkAll').DataTable({
                            "ordering": true,
                            "searching": true,
                            "paging": false,
                            "draw": false,
                            "retrieve": true
                        });

                    }                }, error: function () {
                    $("#spinner").hide();
                    $('#logaction').html("");
                    $("#resultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
                }, timeout: 40000
            })
        }
    });
    function resultgiftcodevin(stt, price, giftcode, nickname, quantity, createtime, status, usetime) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        if ($("#money").val() == 1) {
            rs += "<td>" + price + "K" + "</td>";
        } else if ($("#money").val() == 0) {
            rs += "<td>" + price + "M" + "</td>";
        }
        rs += "<td>" + giftcode + "</td>";
        rs += "<td>" + nickname + "</td>";
        rs += "<td>" + quantity + "</td>";

        if (status == 1) {
            rs += "<td>" + "Used" + "</td>";
        } else {
            rs += "<td>" + "Not yet used" + "</td>";
        }
        rs += "<td>" + createtime + "</td>";
        rs += "<td>" + usetime + "</td>";
        rs += "</tr>";
        return rs;
    }
    $(document).ready(function () {
    });
</script>
