<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Balance fluctuations</h5>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div><link rel="stylesheet"
      href="<?php echo public_url() ?>/site/css/loggamethirdparty.css"><?php if($role == false): ?>
    <div class="wrapper">
        <div class="widget">
            <div class="title">
                <h6>You are not authorized</h6>
            </div>
        </div>
    </div>
<?php else: ?>
	<?php $this->load->view('admin/error')?>
    <div class="wrapper">
			<?php $this->load->view('admin/message', $this->data); ?>
        <div class="widget">
            <h4 id="resultsearch"></h4>
            <div class="title">
                <h6>Balance fluctuations</h6>
                <h6 class="total">Total bet:<span class="total-number" style="color:#0000ff" id="totalBet"></span></h6>
                <h6 class="total">Total waste:<span class="total-number" style="color:#0000ff" id="totalFee"></span></h6>
                <h6 class="total">Total betting round:<span class="total-number" id="totalSoVongcuoc"></span></h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('report/userwin') ?>" method="post">
                <div class="formRow">
                    <table>
                        <tr class="nickname">
                            <td><label>Nick name:</label></td>
                            <td><input type="text"
                                       id="nickName" value="<?php echo $this->input->post('nickName') ?>" name="nickName"></td>
                            <td><label class="session-1">Number of gaming sessions:</label></td>
                            <td><input type="text" class="session-2"
                                       id="transId" value="<?php echo $this->input->post('transId') ?>" name="transId"></td>
                        </tr>
                    </table>
                </div>

                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser">Since:</label></td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="fromDate" name="fromDate" value="<?php echo $this->input->post('fromDate') ?>"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>                            </td>
                            <td>
                                <label for="param_name" class="formLeft formtoDate"> To date: </label>
                            </td>
                            <td class="item">

                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" id="toDate" name="toDate" value="<?php echo $this->input->post('toDate') ?>"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div hidden class="formRow">
                    <table>
                        <tr>
                            <td><label class="session-1">User id:</label></td>
                            <td><input type="text" class="session-2"
                                       id="userId" value="<?php echo $this->input->post('userId') ?>" name="userId"></td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td><label class="session-1">Money exchange&nbsp;&nbsp;>=</label></td>
                            <td><input type="text" class="session-2"
                                       id="moneyExchange" value="<?php echo $this->input->post('moneyExchange') ?>" name="moneyExchange"></td>
                            <td><label class="money-type-1">Waste&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>=</label></td>
                            <td><input type="text" class="money-type-2"
                                       id="fee_win" value="<?php echo $this->input->post('fee_win') ?>" name="fee_win"></td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td><label class="money-type-1" style="margin-left: 7px">Action name:</label></td>
                            <td><select class="money-type-2" style="margin-left: 1px; width: 219px!important;" id="actionName" name="actionName">
                                    <option value="" <?php if($this->input->post('actionName') == ""){echo "selected";} ?>>Select</option>
                                    <option value="Admin" <?php if($this->input->post('actionName') == "Admin"){echo "selected";} ?>>Admin</option>
                                    <option value="Audition" <?php if($this->input->post('actionName') == "Audition"){echo "selected";} ?>>Slot Racing</option>
                                    <option value="BENLEY" <?php if($this->input->post('actionName') == "BENLEY"){echo "selected";} ?>>Slot Bitcoin</option>
                                    <option value="BaCay" <?php if($this->input->post('actionName') == "BaCay"){echo "selected";} ?>>Three-card game card</option>
                                    <option value="BauCua" <?php if($this->input->post('actionName') == "BauCua"){echo "selected";} ?>>Election crab</option>
                                    <option value="CANDY" <?php if($this->input->post('actionName') == "CANDY"){echo "selected";} ?>>Slot pokemon</option>
                                    <option value="CaoThap" <?php if($this->input->post('actionName') == "CaoThap"){echo "selected";} ?>>High and low</option>
                                    <option value="CashOutByClickPay" <?php if($this->input->post('actionName') == "CashOutByClickPay"){echo "selected";} ?>>Withdraw money from ClickPay</option>
                                    <option value="CashOutByPrincePay" <?php if($this->input->post('actionName') == "CashOutByPrincePay"){echo "selected";} ?>>Withdraw money from PrincePay</option>
                                    <option value="Exchange" <?php if($this->input->post('actionName') == "Exchange"){echo "selected";} ?>>Money change</option>
                                    <option value="GIFT_CODE" <?php if($this->input->post('actionName') == "GIFT_CODE"){echo "selected";} ?>>GIFT_CODE</option>
                                    <option value="GiftCode" <?php if($this->input->post('actionName') == "GiftCode"){echo "selected";} ?>>GiftCode</option>
                                    <option value="MAYBACH" <?php if($this->input->post('actionName') == "MAYBACH"){echo "selected";} ?>>Sports Slots</option>
                                    <option value="MiniPoker" <?php if($this->input->post('actionName') == "MiniPoker"){echo "selected";} ?>>Minipoker</option>
                                    <option value="RechargeByPaywell" <?php if($this->input->post('actionName') == "RechargeByPaywell"){echo "selected";} ?>>Deposit with Paywell</option>
                                    <option value="RechargeByPrincePay" <?php if($this->input->post('actionName') == "RechargeByPrincePay"){echo "selected";} ?>>Deposit with PrincePay</option>
                                    <option value="Spartan" <?php if($this->input->post('actionName') == "Spartan"){echo "selected";} ?>>Slot God of wealth</option>
                                    <option value="TAMHUNG" <?php if($this->input->post('actionName') == "TAMHUNG"){echo "selected";} ?>>Crazy bird slot</option>
                                    <option value="TaiXiu" <?php if($this->input->post('actionName') == "TaiXiu"){echo "selected";} ?>>Over/under</option>
                                    <option value="Tlmn" <?php if($this->input->post('actionName') == "Tlmn"){echo "selected";} ?>>Head south</option>
                                    <option value="XocDia" <?php if($this->input->post('actionName') == "XocDia"){echo "selected";} ?>>Xoc disc</option>
                                    <option value="ag" <?php if($this->input->post('actionName') == "ag"){echo "selected";} ?>>Game AG</option>
                                    <option value="ibc2" <?php if($this->input->post('actionName') == "ibc2"){echo "selected";} ?>>Game IBC</option>
                                    <option value="wm" <?php if($this->input->post('actionName') == "wm"){echo "selected";} ?>>Game WM</option>
                                    <option value="cmd" <?php if($this->input->post('actionName') == "cmd"){echo "selected";} ?>>Game CMD</option>
                                    <option value="CHIEMTINH" <?php if($this->input->post('actionName') == "CHIEMTINH"){echo "selected";} ?>>Horoscope</option>
                                    <option value="taixiusieutoc" <?php if($this->input->post('actionName') == "taixiusieutoc"){echo "selected";} ?>>Over/under siêu tốc</option>
                                    <option value="ROLL_ROYE" <?php if($this->input->post('actionName') == "ROLL_ROYE"){echo "selected";} ?>>God card</option>
                                    <option value="BIKINI" <?php if($this->input->post('actionName') == "BIKINI"){echo "selected";} ?>>Bikini</option>
                                    <option value="GALAXY" <?php if($this->input->post('actionName') == "GALAXY"){echo "selected";} ?>>Galaxy</option>
                                    <option value="sbo" <?php if($this->input->post('actionName') == "sbo"){echo "selected";} ?>>Sbo</option>
                                    <option value="fish" <?php if($this->input->post('actionName') == "fish"){echo "selected";} ?>>Shoot Fish</option>
									<option value="TransferMoney" <?php if($this->input->post('actionName') == "TransferMoney"){echo "selected";} ?>>TransferMoney</option>
                                    <option value="ebet" <?php if($this->input->post('actionName') == "ebet"){echo "selected";} ?>>ebet</option>
                                    <option value="DIEM_DANH" <?php if($this->input->post('actionName') == "DIEM_DANH"){echo "selected";} ?>>Điểm danh</option>
                                </select></td>
                            <td><label class="money-type-1">Current<br>money&nbsp;&nbsp;&nbsp;&nbsp;>=</label></td>
                            <td><input type="text" class="money-type-2"
                                       id="currentMoney" value="<?php echo $this->input->post('currentMoney') ?>" name="currentMoney"></td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td style="">
                                <input type="submit" id="search_tran" value="Search" class="button blueB search">
                            </td>
                            <td>
                                <input type="reset"
                                       onclick="window.location.href = '<?php echo admin_url('report/userwin') ?>'; "
                                       value="Reset" class="basic">
                            </td>
                            <td>
                            <span style="margin-left: 20px">
                                <?php $this->load->view('/admin/component/exportexcel', ['pre_file_name'=>'biendongsodu', 'columns_excel' => "0,1,2,3,4,5,6,7,8"]); ?>
                            </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                <tr class="list-loggameslot">
                    <td>No</td>
                    <td style="width: 0px;">Transaction id</td>
                    <td>Nick name</td>
                    <td>Current money</td>
                    <td>Money exchange</td>
                    <td style="width: 0px;">Waste</td>
                    <td>Trans time</td>
                    <td>Action name</td>
                    <td>Description</td>
                </tr>
                </thead>
                <tbody id="logaction">
                </tbody>
            </table>
        </div>
    </div>
<?php endif;?>
<div class="container">
    <h6 class="total-data">Total records:<span class="total-data-span" id="totalData"></span></h6>
    <div id="spinner" class="spinner image-loggameslot">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>
</div>

<script>
    var page_size = '<?php echo $this->input->post('page_size') ?>' || 10
    $("#search_tran").click(function () {        var fromDatetime = $("#fromDate").val();
        var toDatetime = $("#toDate").val();
        if (fromDatetime > toDatetime) {
            alert('The end date must be greater than the start date')
            return false;
        }

    });

    $(function () {
        var startDate = moment(new Date()).hours(0).minutes(0).seconds(0).milliseconds(0);
        var endDate = moment(new Date()).hours(23).minutes(59).seconds(59).milliseconds(59);
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            defaultDate: startDate,
            useCurrent : false,
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            defaultDate: endDate,
            useCurrent : false,
        });

    });
    $(document).ready(function () {
        initData()
    });

    function initData() {
        var fromdate;
        var todate;
        var oldpage = 0;
        if($("#toDate").val()!=""){
            var match = $("#toDate").val().match(/^(\d+)-(\d+)-(\d+) (\d+)\:(\d+)\:(\d+)$/)
            var date = new Date(match[1], match[2] - 1, match[3], match[4], match[5], match[6])
            todate = moment.unix(date.getTime()/1000).format("YYYY-MM-DD HH:mm:ss")
        }
        else{
            todate =  "";
        }
        if($("#fromDate").val()!=""){
            var match = $("#fromDate").val().match(/^(\d+)-(\d+)-(\d+) (\d+)\:(\d+)\:(\d+)$/)
            var date = new Date(match[1], match[2] - 1, match[3], match[4], match[5], match[6])
            fromdate = moment.unix(date.getTime()/1000).format("YYYY-MM-DD HH:mm:ss")
        }
        else{
            fromdate =  "";
        }
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('report/userwinajax')?>",
            data: {
                nickName: $("#nickName").val(),
                actionName: $("#actionName").val(),
                serviceName: $("#serviceName").val(),
                toDate: todate,
                fromDate: fromdate,
                transId : $("#transId").val(),
                userId: $("#userId ").val(),
                currentMoney: $("#currentMoney").val(),
                moneyExchange: $("#moneyExchange").val(),
                fee: $("#fee_win").val(),
                page : 1,
                maxItem: page_size
            },
            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.data == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("No results were found");
                } else {
                    let totalPage = Math.floor(result.totalData/10) + (result.totalData%10?1:0);
                    $("#totalData").html($.number(result.totalData, undefined, '.', ','));
                    $("#totalBet").html($.number(result.totalBet, undefined, '.', ','));
                    $("#totalFee").html($.number(result.totalFee, undefined, '.', ','));
                    $("#totalSoVongcuoc").html($.number(result.totalSoVongcuoc, undefined, '.', ','));
                    $("#resultsearch").html("");
                    stt = 1;
                    $.each(result.data, function (index, value) {
                        result += resultSearchTransction(stt,value);
                        stt ++;
                    });
                    $('#logaction').html(result);
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if(oldpage>0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('report/userwinajax')?>",
                                    data: {
                                        nickName: $("#nickName").val(),
                                        actionName: $("#actionName").val(),
                                        serviceName: $("#serviceName").val(),
                                        toDate: todate,
                                        fromDate: fromdate,
                                        transId : $("#transId").val(),
                                        userId: $("#userId ").val(),
                                        currentMoney: $("#currentMoney").val(),
                                        moneyExchange: $("#moneyExchange").val(),
                                        fee: $("#fee_win").val(),
                                        page : page,
                                        maxItem: page_size
                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#spinner").hide();
                                        stt = (page - 1) * page_size + 1;
                                        $.each(result.data, function (index, value) {
                                            result += resultSearchTransction(stt, value);
                                            stt++;
                                        });
                                        $('#logaction').html(result);
                                    }, error: function () {
                                        $('#logaction').html("");
                                        $("#spinner").hide();
                                        $("#error-popup").modal("show");
                                    }, timeout: 40000
                                });
                            }
                            oldpage = page;
                        }
                    });
                }
            }, error: function () {
                $('#logaction').html("");
                $("#spinner").hide();
                $("#error-popup").modal("show");
            }, timeout: 40000
        })
    }
    function resultSearchTransction(stt,value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + value.trans_id + "</td>";
        rs += "<td>" + value.nick_name + "</td>";
        rs += "<td>" + $.number(value.current_money, undefined, '.', ',') + "</td>";
        rs += "<td>" + $.number(value.money_exchange, undefined, '.', ',') + "</td>";
        rs += "<td>" + $.number(value.fee, undefined, '.', ',') + "</td>";
        rs += "<td>" + value.trans_time + "</td>";
        var actionName = $("#actionName").val();
        switch (actionName) {
            case 'Admin':
                rs += "<td>" + 'Admin' + "</td>";
                break;
            case 'Audition':
                rs += "<td>" + 'Slot Racing' + "</td>";
                break;
            case 'BENLEY':
                rs += "<td>" + 'Slot Bitcoin' + "</td>";
                break;
            case 'BaCay':
                rs += "<td>" + 'Three-card game card' + "</td>";
                break;
            case 'BauCua':
                rs += "<td>" + 'Election crab' + "</td>";
                break;
            case 'CANDY':
                rs += "<td>" + 'Slot pokemon' + "</td>";
                break;
            case 'CaoThap':
                rs += "<td>" + 'High and low' + "</td>";
                break;
            case 'CashOutByClickPay':
                rs += "<td>" + 'Withdraw money from ClickPay' + "</td>";
                break;
            case 'CashOutByPrincePay':
                rs += "<td>" + 'Withdraw money from PrincePay' + "</td>";
                break;
            case 'Exchange':
                rs += "<td>" + 'Money change' + "</td>";
                break;
            case 'GIFT_CODE':
                rs += "<td>" + 'GIFT_CODE' + "</td>";
                break;
            case 'GiftCode':
                rs += "<td>" + 'GiftCode' + "</td>";
                break;
            case 'MAYBACH':
                rs += "<td>" + 'Sports Slots' + "</td>";
                break;
            case 'MiniPoker':
                rs += "<td>" + 'Minipoker' + "</td>";
                break;
            case 'RechargeByPaywell':
                rs += "<td>" + 'Deposit with Paywell' + "</td>";
                break;
            case 'RechargeByPrincePay':
                rs += "<td>" + 'Deposit with PrincePay' + "</td>";
                break;
            case 'Spartan':
                rs += "<td>" + 'Slot God of wealth' + "</td>";
                break;
            case 'TAMHUNG':
                rs += "<td>" + 'Crazy bird slot' + "</td>";
                break;
            case 'TaiXiu':
                rs += "<td>" + 'Over/under' + "</td>";
                break;
            case 'Tlmn':
                rs += "<td>" + 'Head south' + "</td>";
                break;
            case 'XocDia':
                rs += "<td>" + 'Xoc disc' + "</td>";
                break;
            case 'ag':
                rs += "<td>" + 'Game AG' + "</td>";
                break;
            case 'ibc2':
                rs += "<td>" + 'Game IBC' + "</td>";
                break;
            case 'wm':
                rs += "<td>" + 'Game WM' + "</td>";
                break;
            case 'ROLL_ROYE':
                rs += "<td>" + 'God card' + "</td>";
                break;
            case 'BIKINI':
                rs += "<td>" + 'Bikini' + "</td>";
                break;
            case 'fish':
                rs += "<td>" + 'Shoot Fish' + "</td>";
                break;
				case 'TransferMoney':
                rs += "<td>" + 'TransferMoney' + "</td>";
                break;
            default:
                switch (value.action_name) {
                    case 'Admin':
                        rs += "<td>" + 'Admin' + "</td>";
                        break;
                    case 'Audition':
                        rs += "<td>" + 'Slot Racing' + "</td>";
                        break;
                    case 'BENLEY':
                        rs += "<td>" + 'Slot Bitcoin' + "</td>";
                        break;
                    case 'BaCay':
                        rs += "<td>" + 'Three-card game card' + "</td>";
                        break;
                    case 'BauCua':
                        rs += "<td>" + 'Election crab' + "</td>";
                        break;
                    case 'CANDY':
                        rs += "<td>" + 'Slot pokemon' + "</td>";
                        break;
                    case 'CaoThap':
                        rs += "<td>" + 'High and low' + "</td>";
                        break;
                    case 'CashOutByClickPay':
                        rs += "<td>" + 'Withdraw money from ClickPay' + "</td>";
                        break;
                    case 'CashOutByPrincePay':
                        rs += "<td>" + 'Withdraw money from PrincePay' + "</td>";
                        break;
                    case 'Exchange':
                        rs += "<td>" + 'Money change' + "</td>";
                        break;
                    case 'GIFT_CODE':
                        rs += "<td>" + 'GIFT_CODE' + "</td>";
                        break;
                    case 'GiftCode':
                        rs += "<td>" + 'GiftCode' + "</td>";
                        break;
                    case 'MAYBACH':
                        rs += "<td>" + 'Sports Slots' + "</td>";
                        break;
                    case 'MiniPoker':
                        rs += "<td>" + 'Minipoker' + "</td>";
                        break;
                    case 'RechargeByPaywell':
                        rs += "<td>" + 'Deposit with Paywell' + "</td>";
                        break;
                    case 'RechargeByPrincePay':
                        rs += "<td>" + 'Deposit with PrincePay' + "</td>";
                        break;
                    case 'Spartan':
                        rs += "<td>" + 'Slot God of wealth' + "</td>";
                        break;
                    case 'TAMHUNG':
                        rs += "<td>" + 'Crazy bird slot' + "</td>";
                        break;
                    case 'TaiXiu':
                        rs += "<td>" + 'Over/under' + "</td>";
                        break;
                    case 'Tlmn':
                        rs += "<td>" + 'Head south' + "</td>";
                        break;
                    case 'XocDia':
                        rs += "<td>" + 'Xoc disc' + "</td>";
                        break;
                    case 'ag':
                        rs += "<td>" + 'Game AG' + "</td>";
                        break;
                    case 'ibc2':
                        rs += "<td>" + 'Game IBC' + "</td>";
                        break;
                    case 'wm':
                        rs += "<td>" + 'Game WM' + "</td>";
                        break;
                    case 'ROLL_ROYE':
                        rs += "<td>" + 'God card' + "</td>";
                        break;
                    case 'BIKINI':
                        rs += "<td>" + 'Bikini' + "</td>";
                        break;
                    case 'fish':
                        rs += "<td>" + 'Shoot Fish' + "</td>";
                        break;
						case 'TransferMoney':
                        rs += "<td>" + 'TransferMoney' + "</td>";
                        break;
                    default:
                        rs += "<td>" + value.action_name + "</td>";
                }
        }
        rs += "<td title='" + value.description + "'>" + value.description + "</td>";
        rs += "</tr>";
        return rs;
    }
</script>