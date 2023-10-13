<!-- head -->

<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Management agent</h5>
        </div>

        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget">
        <div class="title">
            <h6>Agency transactions</h6>
        </div>
        <div class="formRow">
            <form class="list_filter form" action="<?php echo admin_url('agency/doanhso')."/".$username ?>"
                  method="get">
                <table>
                    <tr>
                        <td>
                            <label for="param_name" class="formLeft" id="nameuser"
                                   style="margin-left: 250px;margin-bottom:-2px;width: 100px">Since:</label></td>
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
                        <td style="">
                            <input type="submit" id="search_tran" value="Search" class="button blueB" style="margin-left: 20px">
                        </td>
                        <td>
                            <input type="reset"
                                   onclick="window.location.href = '<?php echo admin_url('agency/doanhso')."/".$username ?>'; "
                                   value="Reset" class="basic" style="margin-left: 20px">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="formRow">
            <table>
                <tr>
                    <td><h3 style="margin-left: 50px">Sales</h3></td>
                    <td>
                        <label for="param_name" class="formLeft" id="nameuser"
                               style="margin-left: 258px;margin-bottom:-2px;width: 100px"> Total sale:</label></td>
                    <td>
                        <span class="req" id="usernamespan"><?php echo $totalban; ?></span>
                    </td>
                    <td>
                        <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                               class="formLeft"> Total purchase: </label>
                    </td>
                    <td><span class="req"><?php echo $totalmua; ?></span></td>
                    <td>
                        <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                               class="formLeft"> Total purchase sold:</label>
                    </td>
                    <td>  <span
                            class="req"><?php echo $totalban + $totalmua; ?></span></td>
                </tr>
            </table>

        </div>
        <div class="formRow">
            <table>
                <tr>
                    <td>
                        <label for="param_name" class="formLeft" id="nameuser"
                               style="margin-left: 400px;margin-bottom:-2px;width: 100px"> Total vin sold:</label>
                    </td>
                    <td>
                        <span class="req" id="usernamespan"><?php echo number_format($totalbanmoney) ?></span>
                    </td>
                    <td>
                        <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                               class="formLeft"> Total Win buy: </label>
                    </td>
                    <td><span class="req"><?php echo number_format($totalmuamoney) ?></span></td>
                    <td>
                        <label for="param_name" style="margin-left: 20px;width: 106px;margin-bottom:-3px;"
                               class="formLeft"> Total Win buy sell:</label>
                    </td>
                    <td>  <span
                            class="req"><?php echo number_format($totalbanmoney + $totalmuamoney) ?></span></td>
                </tr>
            </table>

        </div>
        <div class="formRow">
            <table>
                <tr>
                    <td><h3 style="margin-left: 50px">Transaction fees</h3></td>
                    <td>
                        <label for="param_name" class="formLeft" id="nameuser"
                               style="margin-left: 226px;margin-bottom:-2px;width: 100px"> Vin selling fee:</label>
                    </td>
                    <td>
                        <span class="req" id="usernamespan"><?php echo number_format($totalbanmoney - $totalmoneyrece) ?></span>
                    </td>
                    <td>
                        <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                               class="formLeft"> Win purchase fee: </label>
                    </td>
                    <td><span class="req"><?php echo number_format($totalmuamoney - $totalmoneyrecemua) ?></span></td>
                    <td>
                        <label for="param_name" style="margin-left: 20px;width: 131px;margin-bottom:-3px;"
                               class="formLeft"> Total Win fee for buying and selling:</label>
                    </td>
                    <td>  <span
                            class="req"><?php echo number_format($totalbanmoney + $totalmuamoney - $totalmoneyrecemua - $totalmoneyrece) ?></span></td>
                </tr>
            </table>

        </div>
        <div class="formRow">
            <table>
                <tr>
                    <td><h3 style="margin-left: 50px">Refunds and rewards</h3></td>
                    <td>
                        <label for="param_name" style="margin-left: 159px;width: 100px;margin-bottom:-3px;"
                               class="formLeft">Refund fee:</label>
                    </td>
                    <td>  <span
                            class="req"><?php echo number_format(($totalbanmoney + $totalmuamoney - $totalmoneyrecemua - $totalmoneyrece)/2) ?></span></td>
                    <td>
                        <label for="param_name" style="margin-left: 20px;width: 100px;margin-bottom:-3px;"
                               class="formLeft">Bonus:</label>
                    </td>
                    <td>
                        <?php if(($totalbanmoney + $totalmuamoney)< 500000000): ?>
                        <span class="req"><?php echo "0" ?></span>
                        <?php elseif(($totalbanmoney + $totalmuamoney) >= 500000000 && ($totalbanmoney + $totalmuamoney) < 1000000000 ): ?>
                        <span class="req"><?php echo number_format("2000000") ?></span>
                        <?php elseif(($totalbanmoney + $totalmuamoney) >= 1000000000 && ($totalbanmoney + $totalmuamoney) < 3000000000 ): ?>
                        <span class="req"><?php echo number_format("5000000") ?></span>
                        <?php elseif(($totalbanmoney + $totalmuamoney) >= 3000000000 ): ?>
                        <span class="req"><?php echo number_format("10000000") ?></span>
                        <?php endif ;?>
                    </td>
                </tr>
            </table>

        </div>

    </div>
</div>
<div class="pagination">
    <div id="pagination"></div>
</div>
<input type="hidden" id="tranussername" value="<?php echo $username ?>">
<script>
    $("#toDate").datepicker({dateFormat: 'yy-mm-dd'});
    $("#fromDate").datepicker({dateFormat: 'yy-mm-dd'});
    $("#search_tran").click(function () {
        var from = $("#fromDate").datepicker('getDate');
        var to = $("#toDate").datepicker('getDate');
        if (to > from) {
            alert('The end date must be greater than the start date')
            return false;
        }
    });</script>
