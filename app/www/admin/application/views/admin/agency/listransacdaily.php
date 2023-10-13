<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Transaction adding and subtracting money from the system</h5>
        </div>

        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget">
        <div class="title">
            <h6>System transaction history</h6>
        </div>
        <div class="formRow">
            <form class="list_filter form" action="<?php echo admin_url('listransacdaily').'/'.$username ?>" method="get">
                <table>
                    <tr>
                        <td><label style="margin-left: 50px;margin-bottom:-2px;width: 100px">Money:</label></td>
                        <td class="">
                            <select id="money_type" name="money"
                                    style="margin-left: 20px;margin-bottom:-2px;width: 100px">
                                <option value="Win">Win</option>
                                <option value="xu">Coin</option>
                            </select>
                        </td>
                        <td>
                            <label for="param_name" class="formLeft" id="nameuser"
                                   style="margin-left: 50px;margin-bottom:-2px;width: 100px">Since:</label></td>
                        <td class="item"><input name="created"
                                                value="<?php echo $this->input->get('created') ?>"
                                                id="toDate" type="text" class="datepicker"/></td>
                        <td>
                            <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                                   class="formLeft"> To date: </label>
                        </td>
                        <td class="item"><input name="created_to"
                                                value="<?php echo $this->input->get('created_to') ?>"
                                                id="fromDate" type="text" class="datepicker-input"/></td>
                        <td>
                            <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                                   class="formLeft"> Name game: </label>
                        </td>
                        <td class="item"><select id="servicename" name="servicename"
                                                 style="margin-left: 20px;margin-bottom:-2px;width: 100px">
                                <option value="">Name Game</option>
                                <option value="Sam">Sam</option>
                                <option value="BaCay">Three trees</option>
                                <option value="Binh">Binh</option>
                                <option value="Tlml">TLML</option>
                                <option value="VQMM">VQMM</option>
                                <option value="TaiXiu">Over/under</option>
                                <option value="MiniPoker">Mini Poker</option>
                                <option value="CaoThap">Cao Thấp</option>
                                <option value="BauCua">Bầu Cua</option>
                                <option value="Safe Money">Safe Money</option>
                                <option value="Top Up">Top Up</option>
                                <option value="Internet Banking">Internet Banking</option>
                                <option value="Cash Out">Cash Out</option>
                                <option value="Transfer Money">Transfer Money</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </td>
                        <td style="">
                            <input type="button" id="search_tran" value="Search" class="button blueB"
                                   style="margin-left: 20px">
                        </td>
                        <td>
                            <input type="reset"
                                   onclick="window.location.href = '<?php echo admin_url('listransacdaily').'/'.$username ?>'; "
                                   value="Reset" class="basic" style="margin-left: 20px">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <input type="hidden" name="daily" id="daily" value="<?php echo $username ?>">
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
            <tr style="height: 20px;">
                <td>Date created</td>
                <td>Nick name</td>
                <td>Act</td>
                <td>Describe</td>
                <td style="width:100px;">Surplus</td>
                <td>Money changes</td>
                <td>Name game</td>
                <td>Waste</td>
            </tr>
            </thead>
            <tbody id="logaction">
            </tbody>
        </table>
    </div>
</div>
<div class="pagination">
    <div id="pagination"></div>
</div>
<h1 id="resultsearch" style="position: absolute;top: 50%;left: 50%"></h1>
<div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="<?php echo public_url('admin/images/ajax-loader.gif') ?>" alt="Loading"/>
</div>
<style>.spinner {
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
<script>
    $("#toDate").datepicker({dateFormat: 'yy-mm-dd'});
    $("#fromDate").datepicker({dateFormat: 'yy-mm-dd'});
    $("#search_tran").click(function(){
        var from=$("#fromDate").datepicker('getDate');
        var to =$("#toDate").datepicker('getDate');
        if(to>from)
        {
            alert('The end date must be greater than the start date')
            return false;
        }
    });
    $("#search_tran").click(function(){
        var result="";
        $.ajax({
            type: "POST",
            url: "http://103.117.145.122:8082/api_backend",
            data: {c:3,nn:$("#daily").val(),ts:$("#toDate").val(),te:$("#fromDate").val(),mt:$("#money_type").val(), sn: $("#servicename").val()},
            dataType: 'json',
            success: function (result) {
                if (result == "") {
                    $("#resultsearch").html("No results were found");
                } else {
                    $("#resultsearch").html("");
                }
                $("#spinner").bind("ajaxSend", function () {
                    $(this).show();
                }).bind("ajaxStop", function () {
                    $(this).hide();
                }).bind("ajaxError", function () {
                    $(this).hide();
                });

                $.each(result, function(index, value) {
                    result += resultSearchTransction(value.transactionTime, value.nickName, value.actionName, value.description, commaSeparateNumber(value.currentMoney), commaSeparateNumber(value.moneyExchange), value.serviceName, commaSeparateNumber(value.fee))
                });
                $('#logaction').html(result);
                Pagging();
            }
        })
    });
    function resultSearchTransction(transactionTime, nickName, actionName, description, currentMoney, moneyExchange, serviceName, fee) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + transactionTime + "</td>";
        rs += "<td>" + nickName + "</td>";
        rs += "<td>" + actionName + "</td>";
        rs += "<td>" + description + "</td>";
        rs += "<td>" + currentMoney + "</td>";
        rs += "<td>" + moneyExchange + "</td>";

        rs += "<td>" + serviceName + "</td>";
        rs += "<td>" + fee + "</td>";
        rs += "</tr>";
        return rs;
    }
    $(document).ready(function () {
        var result="";
        $.ajax({
            type: "POST",
            url: "http://103.117.145.122:8082/api_backend",
            data: {c:3,nn:$("#daily").val(),ts:$("#toDate").val(),te:$("#fromDate").val(),mt:$("#money_type").val(), sn: $("#servicename").val()},

            dataType: 'json',
            success: function (result) {
                if (result == "") {
                    $("#resultsearch").html("No results were found");
                } else {
                    $("#resultsearch").html("");
                }
                $("#spinner").bind("ajaxSend", function () {
                    $(this).show();
                }).bind("ajaxStop", function () {
                    $(this).hide();
                }).bind("ajaxError", function () {
                    $(this).hide();
                });

                $.each(result, function(index, value) {
                    result += resultSearchTransction(value.transactionTime, value.nickName, value.actionName, value.description, commaSeparateNumber(value.currentMoney), commaSeparateNumber(value.moneyExchange), value.serviceName, commaSeparateNumber(value.fee))
                });
                $('#logaction').html(result);
                Pagging();
            }
        })

    });

</script>
<script>
    function commaSeparateNumber(val){
        while (/(\d+)(\d{3})/.test(val.toString())){
            val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
        }
        return val;
    }
    function Pagging(){
        var items = $("#checkAll tbody tr");
        var numItems = items.length;
        var perPage = 20;
        // only show the first 2 (or "first per_page") items initially
        items.slice(perPage).hide();

        // now setup pagination
        $("#pagination").pagination({
            items: numItems,
            itemsOnPage: perPage,
            cssStyle: "light-theme",
            onPageClick: function(pageNumber) { // this is where the magic happens
                // someone changed page, lets hide/show trs appropriately
                var showFrom = perPage * (pageNumber - 1);
                var showTo = showFrom + perPage;

                items.hide() // first hide everything, then show for the new page
                    .slice(showFrom, showTo).show();
            }
        });
    }
</script>