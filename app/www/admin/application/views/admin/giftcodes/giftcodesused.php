<?php $this->load->view('admin/giftcodes/giftcodesusedhead', $this->data) ?>
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

        <div class="widget backaccount">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title">
                        <h6 class="p-4">Giftcode used</h6>
                    </div>
                </div>
            </div>

            <form class="list_filter form" action="<?php echo admin_url('giftcodes/giftcodesused') ?>" method="post">
                <div class="formRow row">
                    <div class="col-sm-1">
                        <label for="giftCode">Name:</label>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" id="nickName" value="<?php echo $this->input->post('nickName') ?>" name="nickName">
                    </div>

                    <div class="col-sm-1">
                        <label for="giftCode">Code ID:</label>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" id="giftCodeId" value="<?php echo $this->input->post('giftCodeId') ?>" name="giftCodeId">
                    </div>

                    <div class="col-sm-1">
                        <label for="giftCode">Event :</label>
                    </div>
                    <div class="col-sm-2">
                        <select id="bonusType" name="bonusType">
                            <option value="">Select</option>
                            <?php
                            foreach($eventConfig as $item) {?>
                                <option value="<?= $item['id']?>" <?php if ($this->input->post('bonusType') == $item['id']) { echo "selected";} ?>>
                                    <?= $item['name']?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="formRow row">
                    <div class="col-sm-1">
                        <label for="giftCode">Flag time : </label>
                    </div>
                    <div class="col-sm-2">
                        <select id="flagtime" name="flagtime">
                            <option  <?php if ($this->input->post('flagtime') == 1) { echo "selected";} ?> value="1">bettime</option>
                            <option <?php if ($this->input->post('flagtime') == 0) { echo "selected";} ?> value="0">payouttime</option>
                        </select>
                    </div>

                    <div class="col-sm-1">
                        <label for="giftCode">Since :</label>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group date" id="datetimepicker1">
                            <input type="text" id="fromTime" name="fromTime" value="<?php echo $this->input->post('fromTime') ?>" autocomplete="off">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-sm-1">
                        <label for="giftCode">To date :</label>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group date" id="datetimepicker2">
                            <input type="text" id="endTime" name="endTime" value="<?php echo $this->input->post('endTime') ?>" autocomplete="off">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="formRow row">
                    <div class="col-sm-1">
                        <input type="submit" id="search_tran" value="Search" class="button blueB">
                    </div>
                    <div class="col-sm-1">
                        <input type="reset"  onclick="window.location.href = '<?php echo admin_url('giftcodes/giftcodesused') ?>';" value="Reset" class="basic">
                    </div>
                    <div class="col-sm-2">
                        <span>
                            <?php $this->load->view('/admin/component/exportexcel', ['pre_file_name' => 'giftcodes']); ?>
                        </span>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="float-right"> | Total records:<span style="color:#0000ff" id="total"></span></h3>
                    <h3 class="float-right">Total price: <span style="color:#0000ff" id="sum-price"></span></h3>
                </div>
                <div class="col-sm-12">
                    <div id="resultsearch" class="float-left text-danger"></div>
                </div>
            </div>
            <div class="formRow">
                <div class="row">
                    <div class="col-xs-12">
                        <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                            <thead>
                            <tr style="height: 20px;">
                                <th style="width:40px">No</th>
                                <th>Giftcode ID</th>
                                <th>Nick Name used</th>
                                <th>Time of use</th>
<!--                                <th>Update</th>-->
                                <th hidden>ID Number</th>

                                <th>Code</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Number of uses</th>
                                <th>Magnetic effect</th>
                                <th>Term</th>
                                <th>Event</th>
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
<div class="container">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>
</div>
<script>
    var page_size = '<?php echo $this->input->post('page_size') ?>' || 10
    var list_data = []
    $(document).ready(function () {
        $("#inputStatus").bootstrapToggle()
        let fromDatetime = $("#fromTime").val();
        let toDatetime = $("#endTime").val();
        if (fromDatetime > toDatetime) {
            bootbox.alert({
                message: '<i class="fa fa-times-circle text-danger" aria-hidden="true"></i> The end date must be greater than the start date',
                backdrop: true,
                centerVertical: true
            })
            return false;
        }
        initData()
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    })

    function handleActionListener() {

    }

    function resultSearchTransction(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td class='stt'>" + stt + "</td>";
        rs += "<td>" + (value.giftcode_id || '-') + "</td>";
        rs += "<td>" + (value.username || '-') + "</td>";
        rs += "<td>" + timestampToString(value.created_at) + "</td>";
        // rs += "<td>" + timestampToString(value.updated_at) + "</td>";
        rs += "<td hidden>" + value.id_number + "</td>";
        rs += "<td>" + value.giftcode + "</td>";
        rs += "<td>" + value.type + "</td>";
        rs += "<td>" + value.money + "</td>";
        rs += "<td>" + (value.time_used + "/" + value.max_use) + "</td>";
        rs += "<td>" + timestampToString(value.from) + "</td>";
        rs += "<td>" + timestampToString(value.exprired) + "</td>";
        rs += "<td>" + value.event + "</td>";
        return rs;
    }

    function timestampToString(t) {
        if(!t) {
            return "-"
        }
        let date = new Date(t);
        return date.getDate()+
        "/"+(date.getMonth()+1)+
        "/"+date.getFullYear()+
        " "+date.getHours()+
        ":"+date.getMinutes()+
        ":"+date.getSeconds()
    }

    function initData() {
        var oldPage = 0;
        var result = "";
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('giftcodes/giftcodesusedajax')?>",
            data: {
                nickName: $('#nickName').val(),
                giftCodeId: $('#giftCodeId').val(),
                fromTime: $('#fromTime').val(),
                endTime: $('#endTime').val(),
                bonusType: $('#bonusType').val(),
                flagtime: $('#flagtime').val(),
                pages: 1,
                size: page_size
            },

            dataType: 'json',
            success: function (response) {
                // result = JSON.parse(response.data)
                let result = response
                result.total = result.totalRecords
                $("#total").html(result.total);
                if (result.statistic != undefined && result.statistic.totalValue != undefined) {
                    let sum = parseInt(result.statistic.totalValue);
                    sum = new Intl.NumberFormat().format(sum);
                    $("#sum-price").html(sum);
                } else {
                    $("#sum-price").html(0);
                }
                $("#spinner").hide();

                if (result.total == 0) {
                    list_data = []
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("No results were found");
                } else {
                    list_data = result.data
                    $("#resultsearch").html("");
                    let totalPage = Math.floor(result.total / page_size) + (result.total % page_size ? 1 : 0);
                    stt = 1;
                    let str = ''
                    $.each(result.data, function (index, value) {
                        str += resultSearchTransction(stt, value);
                        stt++;
                    });
                    $('#logaction').html(str);
                    handleActionListener();

                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldPage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('giftcodes/giftcodesusedajax')?>",
                                    data: {
                                        nickName: $('#nickName').val(),
                                        giftCodeId: $('#giftCodeId').val(),
                                        fromTime: $('#fromTime').val(),
                                        endTime: $('#endTime').val(),
                                        bonusType: $('#bonusType').val(),
                                        flagtime: $('#flagtime').val(),
                                        pages: page,
                                        size: page_size
                                    },
                                    dataType: 'json',
                                    success: function (response) {
                                        let result = response
                                        list_data = result.data
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = (page - 1) * page_size + 1;
                                        let str = ''
                                        $.each(result.data, function (index, value) {
                                            str += resultSearchTransction(stt, value);
                                            stt++;
                                        });
                                        $('#logaction').html(str);
                                        handleActionListener()
                                    }, error: function () {
                                        list_data = []
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
                list_data = []
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
            }, timeout: 20000
        })

    };
</script>
<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent : false
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent : false
        });
    });
</script>