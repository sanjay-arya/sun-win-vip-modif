<?php $this->load->view('admin/logminigame/head', $this->data) ?>
<div class="line"></div>
<link rel="stylesheet" href="<?php echo public_url() ?>/site/css/loggamethirdparty.css">
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
            <h4 id="resultsearch"></h4>
            <div class="title">
                <h6>Lịch sử tài khoản chơi Over/under</h6>
            </div>
            <form class="list_filter form" action="<?php echo admin_url('logminigame') ?>" method="post">
                <div class="formRow">

                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser">Since:</label></td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="toDate" name="toDate" value="<?= empty($this->input->get('toDate')) ? $this->input->post('toDate') : $this->input->get('toDate')?>"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>                            </td>

                            <td>
                                <label for="param_name" class="formLeft formtoDate"> To date: </label>
                            </td>
                            <td class="item">

                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" id="fromDate" name="fromDate" value="<?= empty($this->input->get('fromDate')) ? $this->input->post('fromDate') : $this->input->get('fromDate')?>"> <span class="input-group-addon">
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
                            <td>
                                <label for="param_name"
                                       class="session-1">Session: </label>
                            </td>
                            <td><input type="text" class="session-2"
                                       id="phientx" value="<?= empty($this->input->get('phientx')) ? $this->input->post('phientx') : $this->input->get('phientx')?>"
                                       name="phientx"></td>
                            <td hidden><label class="money-type-1">Money:</label></td>
                            <td hidden>
                                <select id="money_type" name="money"
                                        class="money-type-2">
                                    <option value="1" <?php if($this->input->post('money') == "1"){echo "selected";} ?>>Vin</option>
                                    <option value="0" <?php if($this->input->post('money') == "0"){echo "selected";} ?>>Coin</option>
                                </select>
                            </td>
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
                                       onclick="window.location.href = '<?php echo admin_url('logminigame') ?>'; "
                                       value="Reset" class="basic">
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <div class="formRow"></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                <tr class="list-logminigame">
                    <td>Phiên</td>
                    <td>Money đặt xỉu</td>
                    <td>Total đặt xỉu</td>
                    <td>Hoàn trả cửa xỉu</td>
                    <td>Money đặt tài</td>
                    <td>Total đặt tài</td>
                    <td>Hoàn trả cửa tài</td>
                    <td>Jackpot</td>
                    <td>Kết quả</td>
                    <td>Kết quả giải</td>
                    <td>Type of money</td>
                    <td>Date created</td>
                </tr>
                </thead>
                <tbody id="logaction">
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<div class="container">
    <h6 class="total-data">Total records:<span class="total-data-span" id="totalData"></span></h6>
    <div id="spinner" class="spinner image-logminigame">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>
</div>
<script>

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

    $("#search_tran").click(function () {
        var fromDatetime = $("#toDate").val();
        var toDatetime = $("#fromDate").val();
        if (fromDatetime > toDatetime) {
            alert('The end date must be greater than the start date')
            return false;
        }
    });
    function resultSearchtaixiu(referenceId,totalxiu, totaltai, numxiu, numtai, dice1, dice2, dice3,result,totalrefundtai,totalrefundxiu,money,datetime,total_jackpot) {
        var rs = "";
        rs += "<tr>";
        rs += "<td><a style='color: #0000FF' href='logminigame/detailphientaixiu/"+referenceId+ "/history"+ query() +"'>"+referenceId+"</a></td>";
        rs += "<td>" + commaSeparateNumber(numxiu) + "</td>";
        rs += "<td>" + commaSeparateNumber(totalxiu) + "</td>";
        rs += "<td>" + commaSeparateNumber(totalrefundxiu) + "</td>";
        rs += "<td>" + commaSeparateNumber(numtai) + "</td>";
        rs += "<td>" + commaSeparateNumber(totaltai) + "</td>";
        rs += "<td>" + commaSeparateNumber(totalrefundtai) + "</td>";
        rs += "<td>" + (total_jackpot) + "</td>";
        rs += "<td>" + dice1 + "," +dice2+"," + dice3 + "</td>";
        if(result == 1){
            rs += "<td>" + "Finance" + "</td>";
        }else  if(result == 0){
            rs += "<td>" + "Faint" + "</td>";
        }
        if(money == 1){
            rs += "<td>" + "Win" + "</td>";
        }else  if(money == 0){
            rs += "<td>" + "Coin" + "</td>";
        }
        rs += "<td>" + datetime + "</td>";
        rs += "</tr>";
        return rs;
    }
    $(document).ready(function () {
        var result = "";
        var oldPage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('logminigame/indexajax')?>",
            data: {
                phientx: $("#phientx").val(),
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val(),
                money: $("#money_type").val(),
                pages : 1
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if (result.transactions == "") {
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("No results were found");
                }else {
                    $("#totalData").html($.number(result.totalRecord, undefined, '.', ','));
                    $("#resultsearch").html("");
                    var totalPage = result.total;
                    $.each(result.transactions, function (index, value) {
                        result += resultSearchtaixiu(value.reference_id, value.total_xiu, value.total_tai, value.num_bet_xiu, value.num_bet_tai, value.dice1, value.dice2, value.dice3, value.result,value.total_refund_tai,value.total_refund_xiu,value.money_type,value.timestamp,value.total_jackpot);
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
                                    url: "<?php echo admin_url('logminigame/indexajax')?>",
                                    data: {
                                        phientx: $("#phientx").val(),
                                        toDate: $("#toDate").val(),
                                        fromDate: $("#fromDate").val(),
                                        money: $("#money_type").val(),
                                        pages : page
                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        $.each(result.transactions, function (index, value) {
                                            result += resultSearchtaixiu(value.reference_id, value.total_xiu, value.total_tai, value.num_bet_xiu, value.num_bet_tai, value.dice1, value.dice2, value.dice3, value.result,value.total_refund_tai,value.total_refund_xiu,value.money_type,value.timestamp,value.total_jackpot);
                                        });
                                        $('#logaction').html(result);

                                    }, error: function () {
                                        $("#spinner").hide();
                                        $('#logaction').html("");
                                        $("#resultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
                                    },timeout : 10000
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
            },timeout : 10000
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
    function query() {
        let query = '?';
        if ($('#toDate').val() != '') {
            query += 'toDate=' + $('#toDate').val()+ '&';
        }
        if ($('#fromDate').val() != '') {
            query += 'fromDate=' + $('#fromDate').val() + '&';
        }
        if ($('#phientx').val() != '') {
            query += 'phientx=' + $('#phientx').val() + '&';
        }
        return query;
    }
</script>

