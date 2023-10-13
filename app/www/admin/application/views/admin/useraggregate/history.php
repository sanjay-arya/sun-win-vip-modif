<?php $this->load->view('admin/message', $this->data); ?>
<div class="">
    <h4 id="historyResultsearch"></h4>
    <div class="title">
        <h6>Lịch sử đăng nhập/ip/giftcode</h6>
    </div>
    <form class="list_filter form">
        <div class="formRow">
            <table>
                <tr>
                    <td>
                        <label for="param_name" class="formLeft" id="nameuser">Since:</label></td>
                    <td class="item">
                        <div class="input-group date" id="historyDatetimepicker1">
                            <input type="text" id="historyFromDate" name="fromDate"
                                   value="<?php echo $this->input->post('fromDate') ?>"> <span
                                    class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </td>
                    <td>
                        <label for="param_name" class="formLeft formtoDate"> To date: </label>
                    </td>
                    <td class="item">
                        <div class="input-group date" id="historyDatetimepicker2">
                            <input type="text" id="historyToDate" name="toDate"
                                   value="<?php echo $this->input->post('toDate') ?>"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="formRow">
            <table>
                <tr>
                    <td><label class="money-type-1" style="margin-left: 8px">Status:</label></td>
                    <td>
                        <select class="money-type-2" id="status" name="timkiemtheo">
                            <option value="1" <?php if ($this->input->post('timkiemtheo') == "1") {echo "selected";} ?>>Đăng nhập</option>
                            <option value="0" <?php if ($this->input->post('timkiemtheo') == "0") {echo "selected";} ?>>Đăng ký</option>
                        </select>
                    </td>
                    <td><label class="money-type-1">Ip:</label></td>
                    <td>
                        <input type="text" class="money-type-2" id="iplogin" value="<?php echo $this->input->post('iplogin') ?>" name="iplogin">
                    </td>
                </tr>
            </table>
        </div>
        <div class="formRow">
            <table>
                <tr>
                    <td style="">
                        <input type="button" id="history" value="Search" class="button blueB search">
                        <input type="button" id="history_hidden" value="history hidden" class="button blueB search" hidden>
                    </td>
                    <td>
                        <input type="button"
                               id="reset_history"
                               value="Reset" class="basic">
                    </td>
                </tr>
            </table>
        </div>
    </form>
    <div class="formRow"></div>
    <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck">
        <thead>
        <tr style="height: 20px;">
            <td>No</td>
            <td>Nick name</td>
            <td>IP</td>
            <td>Device</td>
            <td>Status</td>
            <td>Bảo mật</td>
            <td>Date created</td>
            <td>Số lượng</td>
            <td>Sử dụng giftcode</td>
        </tr>
        </thead>
        <tbody id="historyLogaction">
        </tbody>
    </table>
</div>
<div class="container">
    <h6 class="total-data">Total records:<span class="total-data-span" id="numuser"></span></h6>
    <div id="historySpinner" class="spinner image-loggameslot">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="historyPagination" class="pagination-lg"></ul>
    </div>
</div>
<script src="<?php echo public_url('js') ?>/jquery/jquery.colorbox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo public_url('admin') ?>/css/colorbox.css" media="screen"/>
<script>
    $(function () {
        var startDate = moment(new Date()).hours(0).minutes(0).seconds(0).milliseconds(0);
        var endDate = moment(new Date()).hours(23).minutes(59).seconds(59).milliseconds(59);
        $('#historyDatetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            defaultDate: startDate,
            useCurrent: false,
        });
        $('#historyDatetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            defaultDate: endDate,
            useCurrent: false,
        });

    });

    $('#reset_history').click(function () {
        var fromDate = moment(new Date()).hours(0).minutes(0).seconds(0).milliseconds(0).format("YYYY-MM-DD HH:mm:ss");
        $('#historyFromDate').val(fromDate);
        var todate = moment(new Date()).hours(23).minutes(59).seconds(59).milliseconds(59).format("YYYY-MM-DD HH:mm:ss");
        $('#historyToDate').val(todate);
        $('#iplogin').val('');
        historyInitData()
    });

    $(document).ready(function () {
        historyInitData()
    });

    $("#history, #history_hidden").click(function () {
        var fromDatetime = $("#historyFromDate").val();
        var toDatetime = $("#historyToDate").val();
        if (fromDatetime > toDatetime) {
            alert('The end date must be greater than the start date');
            return false;
        }
        historyInitData()
    });

    function historyResultSearchTransction(stt, username, nickname, ip, agent, type, security, date, numbergc) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + nickname + "</td>";
        rs += "<td class='ip'>" + '<a style="cursor: pointer;text-decoration-line: underline;" class="check-ip">'+ ip +'</a>' + "</td>";
        rs += "<td class='col-sm-3'>" + agent + "</td>";
        if (type == 1) {
            rs += "<td>" + " Đăng nhập" + "</td>";
        } else {
            rs += "<td>" + "Đăng ký" + "</td>";
        }
        if (security == 1) {
            rs += "<td>" + "Có" + "</td>";
        } else if (security == 0) {
            rs += "<td>" + "Không" + "</td>";
        }
        rs += "<td>" + date + "</td>";
        rs += "<td>" + (numbergc || '-') + "</td>";
        rs += "<td>" + "<a class='ajax' style = 'color:blue;' href='<?php echo admin_url('usergame/detailgc') ?>" + "/" + nickname + "'>" + "Detail" + "</a>";
        rs += "</tr>";
        return rs;
    }

    function historyInitData() {
        var fromdate;
        var todate;
        var oldPage = 0;
        if ($("#historyToDate").val() != "") {
            var match = $("#historyToDate").val().match(/^(\d+)-(\d+)-(\d+) (\d+)\:(\d+)\:(\d+)$/)
            var date = new Date(match[1], match[2] - 1, match[3], match[4], match[5], match[6])
            todate = moment.unix(date.getTime() / 1000).format("YYYY-MM-DD HH:mm:ss")
        } else {
            todate = "";
        }
        if ($("#historyFromDate").val() != "") {
            var match = $("#historyFromDate").val().match(/^(\d+)-(\d+)-(\d+) (\d+)\:(\d+)\:(\d+)$/)
            var date = new Date(match[1], match[2] - 1, match[3], match[4], match[5], match[6])
            fromdate = moment.unix(date.getTime() / 1000).format("YYYY-MM-DD HH:mm:ss")
        } else {
            fromdate = "";
        }
        $('#historyPagination').css("display", "block");
        $("#historySpinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('useraggregate/historyajax')?>",
            data: {
                nickname: '<?= !empty($nn) ? $nn : ''?>',
                iplogin: $("#iplogin").val(),
                toDate: todate,
                fromDate: fromdate,
                status: $("#status").val(),
                pages: 1
            },

            dataType: 'json',
            success: function (result) {
                $("#historySpinner").hide();
                if (result.transactions == "") {
                    $('#historyPagination').css("display", "none");
                    $("#historyResultsearch").html("No results were found");
                    $("#historyLogaction").html("");
                    $("#numuser").html("");
                } else {
                    $("#historyResultsearch").html("");
                    $("#numuser").html(result.totalRecord);
                    var totalPage = result.total;
                    stt = 1;
                    $.each(result.transactions, function (index, value) {
                        result += historyResultSearchTransction(stt, value.user_name, value.nick_name, value.ip, value.agent, value.type, value.security, value.time_log);
                        stt++

                    });
                    $('#historyLogaction').html(result);
                    checkip();
                    $(".ajax").colorbox({iframe: true, innerWidth: 1000, innerHeight: 300});
                    $('#historyPagination').twbsPagination('destroy');
                    $('#historyPagination').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldPage > 0) {
                                $("#historySpinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('useraggregate/historyajax')?>",
                                    data: {
                                        nickname: '<?= !empty($nn) ? $nn : ''?>',
                                        iplogin: $("#iplogin").val(),
                                        toDate: todate,
                                        fromDate: fromdate,
                                        status: $("#status").val(),
                                        pages: page
                                    },
                                    dataType: 'json',
                                    success: function (result) {
                                        $("#historyResultsearch").html("");
                                        $("#historySpinner").hide();
                                        stt = (page - 1) * 50 + 1;
                                        $.each(result.transactions, function (index, value) {
                                            result += historyResultSearchTransction(stt, value.user_name, value.nick_name, value.ip, value.agent, value.type, value.security, value.time_log);
                                            stt++
                                        });
                                        $('#historyLogaction').html(result);
                                        checkip();
                                        $(".ajax").colorbox({iframe: true, innerWidth: 1000, innerHeight: 300});
                                    }, error: function () {
                                        $("#historySpinner").hide();
                                        $('#historyLogaction').html("");
                                        $("#historyResultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
                                    }, timeout: 20000
                                });
                            }
                            oldPage = page;
                        }
                    });
                }
            }, error: function () {
                $("#historySpinner").hide();
                $('#historyLogaction').html("");
                $("#historyResultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
            }, timeout: 20000
        });

    }

    function checkip() {
        $('.check-ip').click(function() {
            var ip = $(this).parents('.ip').text();
            $('#iplogin').val(ip);
            jQuery('#history_hidden').click();
        });
    }

</script>