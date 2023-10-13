<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
        </div>
        <div class="clear"></div>
    </div>
</div>
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

    <script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.table2excel.js"></script>
    <div class="widget">
        <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>

        <div class="title">
            <h6>Win conversion history</h6>
        </div>
        <form class="list_filter form" action="<?php echo admin_url('transaction/logchuyendoivinngoc') ?>"
              method="post">
            <div class="formRow">
                <table>
                    <tr>
                        <td>
                            <label for="param_name" class="formLeft" id="nameuser"
                                   style="margin-left: 120px;margin-bottom:-2px;width: 100px">Since:</label></td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" id="toDate" name="toDate"
                                       value="<?php echo $start_time; ?>"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                            </div>

                        </td>

                        <td>
                            <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                                   class="formLeft"> To date: </label>
                        </td>
                        <td class="item">

                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" id="fromDate" name="fromDate"
                                       value="<?php echo $end_time; ?>"> <span class="input-group-addon">
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
                        <td><label style="margin-left: 100px;margin-bottom:-2px;width: 100px">Nick name:</label>
                        </td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="filter_iname" value="<?php echo $this->input->post('name') ?>" name="name">
                        </td>                        <td>
                            <label for="param_name" style="width: 115px;margin-bottom:-3px;margin-left: 47px;"
                                   class="formLeft"> Error code: </label>
                        </td>
                        <td class="item"><select id="select_error" name="select_error"
                                                 style="margin-left: 5px;margin-bottom:-2px;width: 150px">
                                <option value="-1" <?php if ($this->input->post('select_error') == "-1") {
                                    echo "selected";
                                } ?> >All
                                </option>
                                <option value="0" <?php if ($this->input->post('select_error') == "0") {
                                    echo "selected";
                                } ?>>Success
                                </option>
                                <option value="8" <?php if ($this->input->post('select_error') == "8") {
                                    echo "selected";
                                } ?>>Not enough money
                                </option>
                                <option value="10" <?php if ($this->input->post('select_error') == "10") {
                                    echo "selected";
                                } ?>>Exceeded currency exchange limit
                                </option>
                                <option value="11" <?php if ($this->input->post('select_error') == "11") {
                                    echo "selected";
                                } ?>>Currency exchange is prohibited
                                </option>
                            </select>
                        </td>

                    </tr>

                </table>

            </div>

            <div class="formRow">

                <table>
                    <tr>
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 170px">Trading code
                                Merchant:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="txt_merchant" value="<?php echo $this->input->post('txt_merchant') ?>"
                                   name="txt_merchant"></td>                        <td>
                            <label for="param_name" style="width: 115px;margin-bottom:-3px;margin-left: 47px;"
                                   class="formLeft"> Merchant: </label>
                        </td>
                        <td class="item"><select id="select_merchant" name="select_merchant"
                                                 style="margin-left: 5px;margin-bottom:-2px;width: 150px">
                                <option
                                    value="HamCaMap" <?php if ($this->input->post('select_merchant') == "HamCaMap") {
                                    echo "selected";
                                } ?> >Shark's jaw
                                </option>
                            </select>
                        </td>
                    </tr>

                </table>

            </div>
            <div class="formRow">

                <table>
                    <tr>
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 170px">Trading code
                                Win123Club:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="txt_vinplay" value="<?php echo $this->input->post('txt_vinplay') ?>"
                                   name="txt_vinplay"></td>                        <td>
                            <label for="param_name" style="width: 115px;margin-bottom:-3px;margin-left: 47px;"
                                   class="formLeft">Convert: </label>
                        </td>
                        <td class="item"><select id="select_type" name="select_type"
                                                 style="margin-left: 5px;margin-bottom:-2px;width: 150px">
                                <option value="" <?php if ($this->input->post('select_type') == "") {
                                    echo "selected";
                                } ?> >All
                                </option>
                                <option value="0" <?php if ($this->input->post('select_type') == "0") {
                                    echo "selected";
                                } ?> >Add Win
                                </option>
                                <option value="1" <?php if ($this->input->post('select_type') == "1") {
                                    echo "selected";
                                } ?> >Except Win
                                </option>
                            </select>
                        </td>
                        <td style="">
                            <input type="submit" id="search_tran" value="Search" class="button blueB"
                                   style="margin-left: 123px">
                        </td>
                    </tr>

                </table>

            </div>

        </form>
        <div class="formRow">
            <div class="row">
                <div class="col-sm-2">
                    <h5>Total money:<span style="color: #0000ff" id="summoney"></span></h5>
                </div>
                <div class="col-sm-3">
                    <h5>Total money changed:<span style="color: #0000ff" id="summoneychange"></span></h5>
                </div>
                <div class="col-sm-2">
                    <h5>Conversion fee:<span style="color: #0000ff" id="feechange"></span></h5>
                </div>
                <div class="col-sm-2">
                    <h5>Total transactions:<span style="color: #0000ff" id="sumgd"></span></h5>
                </div>
            </div>

        </div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
            <tr style="height: 20px;">
                <td>Nickname</td>
                <td>MerchantId</td>
                <td>MerchantTransId</td>
                <td>transNo</td>
                <td>Money</td>
                <td>Type of money</td>
                <td>Type conversion</td>
                <td>ExchangeMoney</td>
                <td>Fee</td>
                <td>Code</td>
                <td>IP</td>
                <td>Date created</td>
            </tr>
            </thead>
            <tbody id="logaction">
            </tbody>
        </table>
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
        <ul id="pagination-demo" class="pagination-sm"></ul>
    </div>

</div>

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

    });
    function resultSearchTransction(nickname, merchantId, merchantTransId, transNo, money, moneyType, type, exchangeMoney, fee, code, ip, createTime) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + nickname + "</td>";
        rs += "<td>" + merchantId + "</td>";
        if (merchantTransId != null) {
            rs += "<td>" + merchantTransId + "</td>";
        } else {
            rs += "<td>" + "" + "</td>";
        }

        rs += "<td>" + transNo + "</td>";
        rs += "<td>" + commaSeparateNumber(money) + "</td>";
        rs += "<td>" + moneyType + "</td>";
        if (type == 1) {
            rs += "<td>" + "Except Win" + "</td>";
        } else if (type == 0) {
            rs += "<td>" + "Add Win" + "</td>";
        }
        rs += "<td>" + commaSeparateNumber(exchangeMoney) + "</td>";
        rs += "<td>" + commaSeparateNumber(fee) + "</td>";
        rs += "<td>" + commaSeparateNumber(code) + "</td>";
        rs += "<td>" + ip + "</td>";
        rs += "<td>" + createTime + "</td>";
        rs += "</tr>";
        return rs;
    }
    $(document).ready(function () {
        var oldPage = 0;
        var result = "";
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('transaction/logchuyendoivinngocajax')?>",
            data: {
                nickname: $("#filter_iname").val(),
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                mid: $("#select_merchant").val(),
                tid: $("#txt_merchant").val(),
                tno: $("#txt_vinplay").val(),
                type: $("#select_type").val(),
                code: $("#select_error").val(),
                pages: 1
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.trans == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("No results were found");
                    $('#summoney').html("");
                    $('#summoneychange').html("");
                    $('#feechange').html("");
                    $('#sumgd').html("");
                    $('#logaction').html("");
                } else {
                    $("#resultsearch").html("");
                    $('#summoney').html(commaSeparateNumber(result.totalMoney));
                    $('#summoneychange').html(commaSeparateNumber(result.totalExchangeMoney));
                    $('#feechange').html(commaSeparateNumber(result.totalFee));
                    $('#sumgd').html(commaSeparateNumber(result.totalTrans));

                    $.each(result.trans, function (index, value) {
                        result += resultSearchTransction(value.nickname, value.merchantId, value.merchantTransId, value.transNo, value.money, value.moneyType, value.type, value.exchangeMoney, value.fee, value.code, value.ip, value.createTime);
                    });
                    $('#logaction').html(result);
                    $('#pagination-demo').twbsPagination({
                        totalPages: 10,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldPage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('transaction/logchuyendoivinngocajax')?>",
                                    data: {
                                        nickname: $("#filter_iname").val(),
                                        toDate: $("#toDate").val(),
                                        fromDate: $("#fromDate").val(),
                                        mid: $("#select_merchant").val(),
                                        tid: $("#txt_merchant").val(),
                                        tno: $("#txt_vinplay").val(),
                                        type: $("#select_type").val(),
                                        code: $("#select_error").val(),
                                        pages: page
                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#spinner").hide();
                                        if (result.trans == "") {
                                            $('#pagination-demo').css("display", "none");
                                            $("#resultsearch").html("No results were found");
                                            $('#summoney').html("");
                                            $('#summoneychange').html("");
                                            $('#feechange').html("");
                                            $('#sumgd').html("");
                                            $('#logaction').html("");
                                        } else {
                                            $("#resultsearch").html("");

                                            $.each(result.trans, function (index, value) {
                                                result += resultSearchTransction(value.nickname, value.merchantId, value.merchantTransId, value.transNo, value.money, value.moneyType, value.type, value.exchangeMoney, value.fee, value.code, value.ip, value.createTime);

                                            });
                                            $('#logaction').html(result);
                                        }
                                    }, error: function () {
                                        $("#spinner").hide();
                                        $('#logaction').html("");
                                        $('#summoney').html("");
                                        $('#summoneychange').html("");
                                        $('#feechange').html("");
                                        $('#sumgd').html("");
                                        $("#resultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
                                    }, timeout: timeOutApi
                                });
                            }
                            oldPage = page;
                        }
                    });
                }
            }, error: function () {
                $("#spinner").hide();
                $('#logaction').html("");
                $('#summoney').html("");
                $('#summoneychange').html("");
                $('#feechange').html("");
                $('#sumgd').html("");
                $("#resultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
            }, timeout: timeOutApi
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