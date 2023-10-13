<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
        </div>
        <div class="clear"></div>
    </div>
</div>
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

    
    <script type="text/javascript" src="<?php echo public_url()?>/js/jquery.simplePagination.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo public_url()?>/admin/css/simplePagination.css" media="screen" />
    <div class="widget">
        <div class="title">
            <h6>List freezes money</h6>
        </div>
        <form class="list_filter form" action="<?php echo admin_url('transaction') ?>" method="get">
            <div class="formRow">

                <table>
                    <tr>
                        <td><label style="margin-left: 30px;margin-bottom:-2px;width: 100px">Nick name:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="filter_iname" value="<?php echo $this->input->get('name') ?>" name="name"></td>
                        <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Name game:</label></td>
                        <td class="">
                            <select id="namegame"
                                    style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                <option value="">Select</option>
                                <option value="BaCay">Three trees</option>
                                <option value="BaiCao">Scratch cards</option>
                                <option value="Binh">Binh</option>
                                <option value="Lieng">Lieng</option>
                                <option value="Poker">Poker</option>
                                <option value="Sam">Sam</option>
                                <option value="TaLa">Disturbance</option>
                                <option value="Tlmn">Head south</option>
                                <option value="XiTo">Poker element</option>
                                <option value="XocXoc">Xoc Xoc</option>

                            </select>
                        </td>
                        <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Type of money:</label></td>
                        <td class="">
                            <select id="money_type"
                                    style="margin-left: 0px;margin-bottom:-2px;width: 143px">
                                <option value="vin">Win</option>
                                <option value="xu">Coin</option>

                            </select>
                        </td>

                    </tr>

                </table>

            </div>
            <div class="formRow">

                <table>
                    <tr>
                        <td>
                            <label for="param_name" class="formLeft" id="nameuser"
                                   style="margin-left: 50px;margin-bottom:-2px;width: 100px">Since:</label></td>
                        <td class="item">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" id="toDate"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                            </div>                        </td>

                        <td>
                            <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                                   class="formLeft"> To date: </label>
                        </td>
                        <td class="item">

                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" id="fromDate"> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
</span>
                            </div>
                        </td>

                        <td style="">
                            <input type="button" id="search_tran" value="Search" class="button blueB"
                                   style="margin-left: 123px">
                        </td>
                        <td>
                            <input type="reset"
                                   onclick="window.location.href = '<?php echo admin_url('transaction/openmoney') ?>'; "
                                   value="Reset" class="basic" style="margin-left: 20px">
                        </td>

                    </tr>
                </table>
            </div>
        </form>
        <div class="formRow"></div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
            <tr style="height: 20px;">
                <td>No</td>
                <td>Session id</td>
                <td>Nickname</td>
                <td>Name game</td>
                <td>Room</td>
                <td>Money freezes</td>
                <td>Money</td>
                <td>Time</td>
                <td>Open freeze</td>
            </tr>
            </thead>
            <tbody id="logaction">
            </tbody>
        </table>
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
    <div class="pagination">
        <div id="pagination"></div>
    </div>
    <h1 id="resultsearch" style="position: absolute;top: 50%;left: 50%"></h1>
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
        if($("#filter_iname").val() == ""){
            alert('You have not entered a nickname');
            return false;
        }
        if($("#namegame").val() == ""){
            alert('You have not entered a game name');
            return false;
        }
        if (fromDatetime > toDatetime) {
            alert('The end date must be greater than the start date')
            return false;
        }

        listFrermoney();

    });    function resultSearchTransction(stt, sesionid, nickname, gamename, room, money, types, date) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + sesionid + "</td>";
        rs += "<td>" + nickname + "</td>";
        rs += "<td>" + gamename + "</td>";
        rs += "<td>" + commaSeparateNumber(room) + "</td>";
        rs += "<td>" + commaSeparateNumber(money) + "</td>";
        rs += "<td>" + types + "</td>";
        rs += "<td>" + moment.unix(date/1000).format("DD MMM YYYY hh:mm a") + "</td>";
        rs += "<td>" + "<input type = 'button' id= 'openmoney' value='Open freeze' >" + "<input type = 'hidden' id= 'sessionid' value='"+sesionid+"' >" + "</td>";
        rs += "</tr>";
        return rs;
    }
</script>
<script>
    function listFrermoney(){
        var result = "";
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('transaction/checkopenmoneyajax')?>",
            // url: "http://192.168.0.251:8082/api_backend",
            data: {
                nickname: $("#filter_iname").val(),
                namegame: $("#namegame").val(),
                money: $("#money_type").val(),
                toDate: $("#toDate").val(),
                fromDate: $("#fromDate").val()
            },

            dataType: 'json',
            success: function (result) {
                $("#spinner").hide();
                if(result == ""){
                    $("#resultsearch").html("No results were found");
                }else{
                    $("#resultsearch").html("");
                    stt = 1;
                    $.each(result, function (index, value) {
                        result += resultSearchTransction(stt, value.sessionId, value.nickname, value.gameName, value.roomId, value.money, value.moneyType, value.createTime)
                        stt ++
                    });
                    $('#logaction').html(result);
                }
                $("#openmoney").click(function () {
                    if(!confirm('Are you sure you want Open freeze?'))
                    {
                        return false;
                    }
                    $.ajax({
                        type: "POST",
                        url: "<?php echo admin_url('transaction/openmoneyajax')?>",
                        data: {
                            sid: $("#sessionid").val()

                        },

                        dataType: 'json',
                        success: function (res) {
                            alert("Open freeze successfully");
                            window.location.href = "<?php echo admin_url('transaction/freemoney') ?>"
                        }
                    })

                });
            }
        })

    }
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }

</script>