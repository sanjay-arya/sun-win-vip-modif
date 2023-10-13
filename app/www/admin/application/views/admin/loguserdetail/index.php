<?php $this->load->view('admin/loguserdetail/head', $this->data) ?>
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

        <div class="widget">
            <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>
            <div class="title">
                <h6>Thống kê user</h6>
                <table style="float: right">
                    <tr>
                        <td>Total: </td>
                        <td style="color:#0000ff" id="total_success"></td>
                    </tr>
                </table>
            </div>
            <form class="list_filter form" action="" method="post">
                <div class="formRow">
                    <table>
                        <tr>
                            <td>
                                <label for="param_name" class="formLeft" id="nameuser">Since:</label>
                            </td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" id="fromTime" name="fromTime" value="<?php echo $this->input->post('fromTime') ?>">
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <label for="param_name" class="formLeft formtoDate"> To date: </label>
                            </td>
                            <td class="item">
                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" id="endTime" name="endTime" value="<?php echo $this->input->post('endTime') ?>">
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td><label class="formLeft">Nick name: </label></td>
                            <td><input type="text" class="my-input-class"
                                       id="nickName" value="<?php echo $this->input->post('nickName') ?>" name="nickName"></td>
                            <td>
                                <label for="showDataGameBet" class="formLeft">Hiện cược:</label>
                            </td>
                            <td>
                                <span class="my-input-class">
                                    <input id="showDataGameBet" type="checkbox" checked data-toggle="toggle" data-style="ios" data-size="mini">
                                </span>
                            </td>
                            <td>
                                <label for="showDataGameWin" class="formLeft">Hiện thắng:</label>
                            </td>
                            <td>
                                <span class="my-input-class">
                                    <input id="showDataGameWin" type="checkbox" checked data-toggle="toggle" data-style="ios" data-size="mini">
                                </span>
                            </td>
                            <td>
                                <label for="showDataDetail" class="formLeft">Hiện chi tiết:</label>
                            </td>
                            <td>
                                <span class="my-input-class">
                                    <input id="showDataDetail" type="checkbox" checked data-toggle="toggle" data-style="ios" data-size="mini">
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="formRow">
                    <table>
                        <tr>
                            <td style="">
                                <input type="submit" id="search_tran" value="Search" class="button blueB search"
                                       style="margin-left: 70px">
                            </td>
                            <td>
                                <input type="reset" style="margin-left: 20px"
                                       onclick="window.location.href = ''; "
                                       value="Reset" class="basic">
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <div class="formRow">
                <div class="row">
                    <div class="col-xs-12">
                        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                            <thead>
                            <tr class="list-loggameslot">
                                <td style='width: 40px; min-width: 50px'>No</td>
                                <td>Time</td>
                                <td>Nick Name</td>

                                <td>Deposit</td>
                                <td>Withdraw</td>

                                <td class="data-game-total data-game-bet">∑ cược
                                    <br/>
                                    (e) + (c) + (s)
                                </td>
                                <td class="data-game-total data-game-win">∑ thắng
                                    <br/>
                                    (ew) + (cw) + (sw)
                                </td>

                                <td class="data-game-total data-game-bet">∑ Egame
                                    <br/>
                                    (e)
                                    <i class="fas fa-info-circle"
                                       data-toggle="tooltip"
                                       data-html="true"
                                       data-placement="right"
                                       title="
<div style='text-align: left;'>
bacay + xocdia + minipoker + slot_pokemon + baucua + taixiu + caothap +
                slot_bitcoin + slot_taydu + slot_angrybird + slot_thantai + slot_thethao
                +Math.abs(tlmn) + Math.abs(tlmn_win)
</div>
                                "></i>
                                </td>
                                <td class="data-game-total data-game-win">∑ Egame win
                                    <br/>
                                    (ew)
                                    <i class="fas fa-info-circle"
                                       data-toggle="tooltip"
                                       data-html="true"
                                       data-placement="right"
                                       title="
<div style='text-align: left;'>
bacay_win + xocdia_win + minipoker_win + slot_pokemon_win + baucua_win + taixiu_win +
                caothap_win + slot_bitcoin_win + slot_taydu_win + slot_angrybird_win + slot_thantai_win +
                slot_thethao_win + tlmn_win
</div>
                                "></i>
                                </td>
                                <td class="data-game-total data-game-bet">∑ Sport
                                    <br/>
                                    (s)
                                    <i class="fas fa-info-circle"
                                       data-toggle="tooltip"
                                       data-html="true"
                                       data-placement="right"
                                       title="
<div style='text-align: left;'>
ibc
</div>
                                "></i>
                                </td>
                                <td class="data-game-total data-game-win">∑ Sport win
                                    <br/>
                                    (sw)
                                    <i class="fas fa-info-circle"
                                       data-toggle="tooltip"
                                       data-html="true"
                                       data-placement="right"
                                       title="
<div style='text-align: left;'>
ibc_win
</div>
                                "></i>
                                </td>
                                <td class="data-game-total data-game-bet">∑ Casino
                                    <br/>
                                    (c)
                                    <i class="fas fa-info-circle"
                                       data-toggle="tooltip"
                                       data-html="true"
                                       data-placement="right"
                                       title="
<div style='text-align: left;'>
wm + ag
</div>
                                "></i>
                                </td>
                                <td class="data-game-total data-game-win">∑ Casino win
                                    <br/>
                                    (cw)
                                    <i class="fas fa-info-circle"
                                       data-toggle="tooltip"
                                       data-html="true"
                                       data-placement="right"
                                       title="
wm_win + ag_win
                                "></i>
                                </td>

                                <td class="data-detail data-game-bet">wm <br/>(1)</td>
                                <td class="data-detail data-game-win">wm win <br/>(2)</td>
                                <td class="data-detail data-game-bet">ibc <br/>(3)</td>
                                <td class="data-detail data-game-win">ibc win <br/>(4)</td>
                                <td class="data-detail data-game-bet">ag <br/>(5)</td>
                                <td class="data-detail data-game-win">ag win <br/>(6)</td>
                                <td class="data-detail data-game-bet">tlmn lost<br/>(7)</td>
                                <td class="data-detail data-game-win">tlmn win<br/>(8)</td>
                                <td class="data-detail data-game-bet">bacay <br/>(9)</td>
                                <td class="data-detail data-game-win">bacay win <br/>(10)</td>
                                <td class="data-detail data-game-bet">xocdia <br/>(11)</td>
                                <td class="data-detail data-game-win">xocdia win <br/>(12)</td>
                                <td class="data-detail data-game-bet">minipoker <br/>(13)</td>
                                <td class="data-detail data-game-win">minipoker win <br/>(14)</td>
                                <td class="data-detail data-game-bet">slot pokemon <br/>(15)</td>
                                <td class="data-detail data-game-win">slot pokemon win <br/>(16)</td>
                                <td class="data-detail data-game-bet">baucua <br/>(17)</td>
                                <td class="data-detail data-game-win">baucua win <br/>(18)</td>
                                <td class="data-detail data-game-bet">taixiu <br/>(19)</td>
                                <td class="data-detail data-game-win">taixiu win <br/>(20)</td>
                                <td class="data-detail data-game-bet">caothap <br/>(21)</td>
                                <td class="data-detail data-game-win">caothap win <br/>(22)</td>
                                <td class="data-detail data-game-bet">slot bitcoin <br/>(23)</td>
                                <td class="data-detail data-game-win">slot bitcoin win <br/>(24)</td>
                                <td class="data-detail data-game-bet">slot taydu <br/>(25)</td>
                                <td class="data-detail data-game-win">slot taydu win <br/>(26)</td>
                                <td class="data-detail data-game-bet">slot angrybird <br/>(27)</td>
                                <td class="data-detail data-game-win">slot angrybird win <br/>(28)</td>
                                <td class="data-detail data-game-bet">slot thantai <br/>(29)</td>
                                <td class="data-detail data-game-win">slot thantai win <br/>(30)</td>
                                <td class="data-detail data-game-bet">slot thethao <br/>(31)</td>
                                <td class="data-detail data-game-win">slot thethao win <br/>(32)</td>
                                <td class="data-detail data-game-bet">taixiusieutoc<br/>(33)</td>
                                <td class="data-detail data-game-win">taixiusieutoc win <br/>(34)</td>
                                <td class="data-detail data-game-bet">slot bikini<br/>(35)</td>
                                <td class="data-detail data-game-win">slot bikini win<br/>(36)</td>
                                <td class="data-detail data-game-bet">sbo<br/>(37)</td>
                                <td class="data-detail data-game-win">sbo win<br/>(38)</td>
                                <td class="data-detail data-game-bet">galaxy<br/>(39)</td>
                                <td class="data-detail data-game-win">galaxy win<br/>(40)</td>
                                <td class="data-detail data-game-bet">fish<br/>(39)</td>
                                <td class="data-detail data-game-win">fish win<br/>(40)</td>
                                <td class="data-detail data-game-bet">ebet<br/>(41)</td>
                                <td class="data-detail data-game-win">ebet win<br/>(42)</td>
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
    .withCheck thead tr:first-child td {
        word-break: keep-all;
    }
    .formRow .toggle.btn {
        margin-top: 0;
    }
    .sTable tbody tr td {
        text-align: right;
    }
</style>
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
    var showDataGameBet = true, showDataGameWin = true, showDataDetail = true
    $(document).ready(function(){

        var startDate = moment(new Date()).hours(0).minutes(0).seconds(0).milliseconds(0)
        var endDate = moment(new Date()).hours(23).minutes(59).seconds(59).milliseconds(59)

        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            defaultDate: startDate,
            useCurrent: false,
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            defaultDate: endDate,
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
        initData()
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
            $("#showDataGameBet").bootstrapToggle()
            $("#showDataGameWin").bootstrapToggle()
            $("#showDataDetail").bootstrapToggle()

            $('#showDataGameBet').change(function() {
                showDataGameBet = $(this).prop('checked')
                showBet()
            })
            $('#showDataGameWin').change(function() {
                showDataGameWin = $(this).prop('checked')
                showWin()
            })
            $('#showDataDetail').change(function() {
                showDataDetail = $(this).prop('checked')
                showDetail()
            })
        })
    })

    function showData() {
        $(document).ready(function (){
            if (showDataGameBet) {
                if(showDataDetail){
                } else {
                    $(document).find('.data-detail.data-game-bet').hide()
                }
            } else {
                $(document).find('.data-game-bet').hide()
            }

            if (showDataGameWin) {
                if(showDataDetail){
                } else {
                    $(document).find('.data-detail.data-game-win').hide()
                }
            } else {
                $(document).find('.data-game-win').hide()
            }
        })
    }

    function showBet() {
        if (showDataGameBet) {
            if(showDataDetail){
                $(document).find('.data-game-bet').show()
            } else {
                $(document).find('.data-game-total.data-game-bet').show()
            }
        } else {
            $(document).find('.data-game-bet').hide()
        }
    }

    function showWin() {
        if (showDataGameWin) {
            if(showDataDetail){
                $(document).find('.data-game-win').show()
            } else {
                $(document).find('.data-game-total.data-game-win').show()
            }
        } else {
            $(document).find('.data-game-win').hide()
        }
    }

    function showDetail() {
        if (showDataDetail) {
            if(showDataGameBet){
                $(document).find('.data-detail.data-game-bet').show()
            }
            if(showDataGameWin){
                $(document).find('.data-detail.data-game-win').show()
            }
        } else {
            $(document).find('.data-detail').hide()
        }
    }

    $("#search_tran").click(function () {
        var fromDatetime = $("#fromTime").val();
        var toDatetime = $("#endTime").val();
        if (fromDatetime > toDatetime) {
            bootbox.alert({
                message: '<i class="fa fa-times-circle text-danger" aria-hidden="true"></i> The end date must be greater than the start date',
                backdrop: true,
                centerVertical: true
            })
            return false;
        }
    });

    function resultSearchTransction(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + value.time_report + "</td>";
        rs += "<td title='" + value.nick_name + "'>" + value.nick_name + "</td>";

        let egame = getMoneyMyGame(value);
        let egamewin = getMoneyWinMyGame(value);
        let sport = getMoneySport(value);
        let sportwin = getMoneyWinSport(value);
        let casino = getMoneyLiveCasino(value);
        let casinowin = getMoneyWinCasino(value);

        rs += "<td>" + $.number(value.deposit, undefined, '.', ',') + "</td>";
        rs += "<td>" + $.number(value.withdraw, undefined, '.', ',') + "</td>";

        rs += "<td class='data-game-total data-game-bet'>" + $.number((egame + sport + casino), undefined, '.', ',') + "</td>";
        rs += "<td class='data-game-total data-game-win'>" + $.number((egamewin + sportwin + casinowin), undefined, '.', ',') + "</td>";

        rs += "<td class='data-game-total data-game-bet'>" + $.number(egame , undefined, '.', ',') + "</td>";
        rs += "<td class='data-game-total data-game-win'>" + $.number(egamewin , undefined, '.', ',') + "</td>";
        rs += "<td class='data-game-total data-game-bet'>" + $.number(sport , undefined, '.', ',') + "</td>";
        rs += "<td class='data-game-total data-game-win'>" + $.number(sportwin , undefined, '.', ',') + "</td>";
        rs += "<td class='data-game-total data-game-bet'>" + $.number(casino , undefined, '.', ',') + "</td>";
        rs += "<td class='data-game-total data-game-win'>" + $.number(casinowin , undefined, '.', ',') + "</td>";

        rs += "<td class='data-detail data-game-bet'>" + $.number(value.wm , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.wm_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.ibc , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.ibc_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.ag , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.ag_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.tlmn , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.tlmn_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.bacay , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.bacay_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.xocdia , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.xocdia_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.minipoker , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.minipoker_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.slot_pokemon , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.slot_pokemon_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.baucua , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.baucua_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.taixiu , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.taixiu_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.caothap , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.caothap_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.slot_bitcoin , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.slot_bitcoin_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.slot_taydu , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.slot_taydu_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.slot_angrybird , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.slot_angrybird_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.slot_thantai , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.slot_thantai_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.slot_thethao , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.slot_thethao_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.taixiu_st , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.taixiu_st_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.slot_bikini , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.slot_bikini_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.sbo , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.sbo_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.slot_galaxy , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.slot_galaxy_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.fish , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.fish_win , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-bet'>" + $.number(value.ebet , undefined, '.', ',') + "</td>";
        rs += "<td class='data-detail data-game-win'>" + $.number(value.ebet_win , undefined, '.', ',') + "</td>";
        rs += "</tr>";
        return rs;
    }

    function getMoneyMyGame(value) {
        return value.bacay + value.xocdia + value.minipoker + value.slot_pokemon + value.baucua + value.taixiu + value.caothap +
            value.slot_bitcoin + value.slot_taydu + value.slot_angrybird + value.slot_thantai + value.slot_thethao
            +Math.abs(value.tlmn) + Math.abs(value.tlmn_win);
    }
    function getMoneyWinMyGame(value) {
        return value.bacay_win + value.xocdia_win + value.minipoker_win + value.slot_pokemon_win + value.baucua_win + value.taixiu_win +
            value.caothap_win + value.slot_bitcoin_win + value.slot_taydu_win + value.slot_angrybird_win + value.slot_thantai_win +
            value.slot_thethao_win + value.tlmn_win;
    }
    function getMoneySport(value) {
        return value.ibc;
    }
    function getMoneyWinSport(value) {
        return value.ibc_win;
    }
    function getMoneyLiveCasino(value) {
        return value.wm + value.ag;
    }
    function getMoneyWinCasino(value) {
        return value.wm_win + value.ag_win;
    }

    function crPoppover(value) {
        return ' data-toggle="popover" data-title="Thông tin chi tiết" data-html=true data-trigger="hover" data-placement="left" ' +
            'data-content="' +
            Object.entries(value).map( ([x,y]) => `${x} : ${y}`).join("<br/>")
            + '" '
    }
    function handleActionListener() {
        showData()
    }

    function initData() {
        var oldPage = 0;
        var result = "";
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('loguserdetail/indexajax')?>",
            data: {
                nickName: $("#nickName").val(),
                fromTime: $("#fromTime").val(),
                endTime: $("#endTime").val(),
                pages: 1,
                size: page_size
            },

            dataType: 'json',
            success: function (response) {
                let result = response.data
                let total = response.totalRecords
                $("#total_success").html(response.totalRecords);

                $("#spinner").hide();

                if (total == 0 || response.data.length == 0) {
                    list_data = []
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("No results were found");
                } else {
                    list_data = result
                    $("#resultsearch").html("");
                    var totalPage = Math.floor(total / page_size) + (total % page_size ? 1 : 0);
                    stt = 1;
                    let str = ''
                    $.each(list_data, function (index, value) {
                        str += resultSearchTransction(stt, value);
                        stt++;
                    });
                    $('#logaction').html(str);
                    handleActionListener();
                    $('[data-toggle="popover"]').popover()
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldPage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('loguserdetail/indexajax')?>",
                                    data: {
                                        nickName: $("#nickName").val(),
                                        fromTime: $("#fromTime").val(),
                                        endTime: $("#endTime").val(),
                                        pages: page,
                                        size: page_size
                                    },
                                    dataType: 'json',
                                    success: function (response) {
                                        let result = response.data
                                        let total = response.totalRecords
                                        $("#total_success").html(response.totalRecords);

                                        $("#spinner").hide();

                                        if (total == 0 || response.data.length == 0) {
                                            list_data = []
                                            $('#pagination-demo').css("display", "none");
                                            $("#resultsearch").html("No results were found");
                                        } else {
                                            list_data = result
                                            $("#resultsearch").html("");
                                            $("#spinner").hide();
                                            stt = (page - 1) * page_size + 1;
                                            let str = ''
                                            $.each(list_data, function (index, value) {
                                                str += resultSearchTransction(stt, value);
                                                stt++;
                                            });
                                            $('#logaction').html(str);
                                            handleActionListener();
                                            $('[data-toggle="popover"]').popover()
                                        }
                                    }, error: function (e) {
                                        list_data = []
                                        console.error(e)
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

            }, error: function (e) {
                list_data = []
                console.error(e)
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
</script>