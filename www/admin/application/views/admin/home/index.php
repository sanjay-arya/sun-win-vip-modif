
<div class="home-view">
    <div style="display: flex;flex-direction: row">
        <h6Overview/h6>
        <select id="select_provider" name="select_provider"
                style="margin-left: 10px;margin-bottom:-2px;width: 143px">
            <option value="today">Today</option>
            <option value="yesterday">Yesterday</option>
            <option value="previousWeek">Last week</option>
            <option value="previousMonth">Last month</option>
        </select>
    </div>
    <div class="row container-fluid">
        <div class="col-6 col-md-4 card-three">
            <div class="card">
                <div class="header-card card-header">
                    <p>
                        New registered user
                    </p>
                    <p id="user-register">

                    </p>
                </div>
                <div class="content-card card-body">
                    <div class="item-flex">
                    <span id="user-charging">
                    </span>
                        <span>
                        User loads card
                    </span>
                    </div>
                    <div class="divider-horizontal"></div>
                    <div class="item-flex">
                    <span id="user-secure">
                    </span>
                        <span>
                        User security
                    </span>
                    </div>
                    <div class="divider-horizontal"></div>
                    <div class="item-flex">
                    <span id="user-secure-charging">
                    </span>
                        <span>
                        User has just loaded + secured
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 card-three">
            <div class="card">
                <div class="header-card card-header" style="background-color: #288e4c">
                    <p>
                        User logs in
                    </p>
                    <p id="login-total">
                    </p>
                </div>
                <div class="content-card card-body">
                    <div class="item-flex">
                    <span id="login-ios">
                    </span>
                        <span>
                        IOS
                    </span>
                    </div>
                    <div class="divider-horizontal"></div>
                    <div class="item-flex">
                    <span id="login-android">
                    </span>
                        <span>
                        ANDROID
                    </span>
                    </div>
                    <div class="divider-horizontal"></div>
                    <div class="item-flex">
                    <span id="login-web">
                    </span>
                        <span>
                        WEB
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 card-three">
            <div class="card">
                <div class="header-card card-header" style="background-color: #45c4f7">
                    <p>
                        Total deposit
                    </p>
                    <p id="total-charging">
                    </p>
                </div>
                <div class="content-card card-body">
                    <div class="item-flex">
                    <span id="charging-user">
                    </span>
                        <span>
                        Deposit money
                    </span>
                    </div>
                    <div class="divider-horizontal"></div>
                    <div class="item-flex">
                    <span id="charging-event">
                    </span>
                        <span>
                        Pre-event
                    </span>
                    </div>
                    <div class="divider-horizontal"></div>
                    <div class="item-flex">
                    <span id="convert-coin">

                    </span>
                        <span>
                        
                        Total exchange
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row container-fluid" style="margin-top: 15px;">
        <div class="col-6 col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title" id="total-user"></h5>
                    <p class="card-text">Total member</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title" id="giftcode-total"></h5>
                    <p class="card-text">Total amount from giftcode</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title" id="convert-game-card"></h5>
                    <p class="card-text">Change card</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title" id="lucky-rotation"></h5>
                    <p class="card-text">Lucky rotation</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row container-fluid" style="margin-top: 15px;">
        <div class="col-6 col-md-4">
            <div class="card">
                <div class="card-body header-card-list bg-primary">
                    <h5 class="card-title">Total fee</h5>
                    <p class="card-text" id="total-fee"></p>
                </div>
                <ul class="list-group list-group-flush" id="total-fee-list">
                </ul>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="card">
                <div class="card-body header-card-list bg-info">
                    <h5 class="card-title">ADMIN / Add and subtract money</h5>
                    <p class="card-text" id="other-admin"></p>
                </div>
                <ul class="list-group list-group-flush" id="other-admin-list">

                </ul>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title" id="user-recharge"></h5>
                    <p class="card-text">Total new users recharged during the day</p>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    var game_name = {
        "Audition": "Racing Slots",
        "BENLEY": "Slot Bitcoin",
        "BaCay": "Three-card card game",
        "BauCua": "Election crab",
        "CANDY": "Slot pokemon",
        "CaoThap": "High and low",
        "Exchange": "Money change",
        "MAYBACH": "Sports Slots",
        "MiniPoker": "Minipoker",
        "Spartan": "God of Fortune Slot",
        "TAMHUNG": "Crazy bird slot",
        "TaiXiu": "Over/under",
        "Tlmn": "Head south",
        "XocDia": "Xoc disc",
        "ag": "Game AG",
        "ibc2": "Game IBC",
        "wm": "Game WM"
    };

    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }


    function fetchAPI(time){
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('home/getDashboardStatisticsAjax  ')?>",
            data: {dateOption: time},
            success: function (res) {
                res = JSON.parse(res);
                $('#total-charging').html(res.totalIn ? commaSeparateNumber(res.totalIn) : "0")
                $('#charging-user').html(res.totalInUser ? commaSeparateNumber(res.totalInUser) : "0")
                $('#charging-event').html(res.totalInEvent ? commaSeparateNumber(res.totalInEvent) : "0")
                $('#convert-coin').html(res.ratioCashout ? commaSeparateNumber(res.ratioCashout) : "0")
                $('#giftcode-total').html(res.vinInEvent.GiftCode ? commaSeparateNumber(res.vinInEvent.GiftCode) : "0")
                $('#convert-game-card').html(res.vinOutUser.CashOutByCard ? commaSeparateNumber(res.vinOutUser.CashOutByCard) : "0")
                $('#lucky-rotation').html(res.vinInEvent.VQMM ? commaSeparateNumber(res.vinInEvent.VQMM) : "0")
                $('#user-recharge').html(JSON.parse(res.userRecharge).data ? JSON.parse(res.userRecharge).data : "0")
                $('#login-total').html(res.ccu.total + "")
                $('#login-ios').html(res.ccu.ios + "")
                $('#login-android').html(res.ccu.android + "")
                $('#login-web').html(res.ccu.web + "")
                $('#user-register').html(res.register.register + "")
                $('#total-user').html(res.register.register + "")
                $('#user-charging').html(res.register.recharge + "")
                $('#user-secure').html(res.register.secMobile + "")
                $('#user-secure-charging').html(res.register.both + "");
                var listPhe = [];
                listPhe.push({
                    name: game_name['Audition'],
                    value: res.actionGame.Audition && res.actionGame.Audition.fee ? commaSeparateNumber(res.actionGame.Audition.fee) : "0"
                });
                listPhe.push({
                    name: game_name['BENLEY'],
                    value: res.actionGame.BENLEY&&res.actionGame.BENLEY.fee ? commaSeparateNumber(res.actionGame.BENLEY.fee) : "0"
                });
                listPhe.push({
                    name: game_name['BaCay'],
                    value: res.actionGame.BaCay&&res.actionGame.BaCay.fee ? commaSeparateNumber(res.actionGame.BaCay.fee) : "0"
                });
                listPhe.push({
                    name: game_name['BauCua'],
                    value: res.actionGame.BauCua&&res.actionGame.BauCua.fee ? commaSeparateNumber(res.actionGame.BauCua.fee) : "0"
                });
                listPhe.push({
                    name: game_name['CANDY'],
                    value: res.actionGame.CANDY&&res.actionGame.CANDY.fee ? commaSeparateNumber(res.actionGame.CANDY.fee) : "0"
                });
                listPhe.push({
                    name: game_name['CaoThap'],
                    value: res.actionGame.CaoThap && res.actionGame.CaoThap.fee ? commaSeparateNumber(res.actionGame.CaoThap.fee) : "0"
                });
                listPhe.push({
                    name: game_name['Exchange'],
                    value: res.actionGame.Exchange && res.actionGame.Exchange.fee ? commaSeparateNumber(res.actionGame.Exchange.fee) : "0"
                });
                listPhe.push({
                    name: game_name['MAYBACH'],
                    value: res.actionGame.MAYBACH && res.actionGame.MAYBACH.fee ? commaSeparateNumber(res.actionGame.MAYBACH.fee) : "0"
                });
                listPhe.push({
                    name: game_name['MiniPoker'],
                    value: res.actionGame.MiniPoker && res.actionGame.MiniPoker.fee ? commaSeparateNumber(res.actionGame.MiniPoker.fee) : "0"
                });
                listPhe.push({
                    name: game_name['Spartan'],
                    value: res.actionGame.Spartan && res.actionGame.Spartan.fee ? commaSeparateNumber(res.actionGame.Spartan.fee) : "0"
                });
                listPhe.push({
                    name: game_name['TAMHUNG'],
                    value: res.actionGame.TAMHUNG && res.actionGame.TAMHUNG.fee ? commaSeparateNumber(res.actionGame.TAMHUNG.fee) : "0"
                });
                listPhe.push({
                    name: game_name['TaiXiu'],
                    value: res.actionGame.TaiXiu && res.actionGame.TaiXiu.fee ? commaSeparateNumber(res.actionGame.TaiXiu.fee) : "0"
                });
                listPhe.push({
                    name: game_name['Tlmn'],
                    value: res.actionGame.Tlmn && res.actionGame.Tlmn.free ? commaSeparateNumber(res.actionGame.Tlmn.fee) : "0"
                });
                listPhe.push({
                    name: game_name['XocDia'],
                    value: res.actionGame.XocDia && res.actionGame.XocDia.fee ? commaSeparateNumber(res.actionGame.XocDia.fee) : "0"
                });
                listPhe.push({
                    name: game_name['ag'],
                    value: res.actionGame.ag && res.actionGame.ag.fee ? commaSeparateNumber(res.actionGame.ag.fee) : "0"
                });
                listPhe.push({
                    name: game_name['ibc2'],
                    value: res.actionGame.ibc2 && res.actionGame.ibc2.fee ? commaSeparateNumber(res.actionGame.ibc2.fee) : "0"
                });
                listPhe.push({
                    name: game_name['wm'],
                    value: res.actionGame.wm && res.actionGame.wm.fee ? commaSeparateNumber(res.actionGame.wm.fee) : "0"
                });
                var tongPhe = 0;
                listPhe.forEach((value => {
                    tongPhe = tongPhe + parseInt((value.value + "").replace(/,/g, ''));
                    $('#total-fee-list').append(`<li class="list-group-item">
                        <div style="display:flex;">
                            <span style="flex:1;">
                                 ${value.name}
                            </span>

                            <div><span class="badge badge-pill badge-dark"
                                       style="justify-content: center;align-items: center;">${value.value}</span></div>
                        </div>
                    </li>`)
                }));
                $("#total-fee").html(commaSeparateNumber(tongPhe));
                var listOther = [];
                listOther.push({
                    name: "Transfer fees",
                    value: res.vinOther.TransferMoney ? commaSeparateNumber(res.vinOther.TransferMoney) : "0"
                });
                listOther.push({
                    name: "Agents issue giftcodes",
                    value: res.vinOther.GcAgentExport ? commaSeparateNumber(res.vinOther.GcAgentExport) : "0"
                });
                listOther.forEach((value => {
                    $('#other-admin-list').append(`<li class="list-group-item">
                        <div style="display:flex;">
                            <span style="flex:1;">
                                 ${value.name}
                            </span>

                            <div><span class="badge badge-pill badge-dark"
                                       style="justify-content: center;align-items: center;">${value.value}</span></div>
                        </div>
                    </li>`)
                }));
                $("#other-admin").html(res.vinOther.Admin ? commaSeparateNumber(res.vinOther.Admin) : "0")
            },
            error: function (e) {
            }
        });
    }

    $("#select_provider").on("change",function () {
        fetchAPI(this.value);
    });

    $(document).ready(function () {
        fetchAPI("today");
    });
</script>

