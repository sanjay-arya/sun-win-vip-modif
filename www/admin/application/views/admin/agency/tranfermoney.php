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
            <h6>Switch win account</h6>
        </div>
        <div class="formRow">
            <table>
                <tr>
                    <td>
                        <label for="param_name" class="formLeft" id="nameuser"
                               style="margin-left: 400px;margin-bottom:7px;width: 200px">Enter your nickname to transfer:</label></td>
                    <td>
                 <span class="oneTwo"><input type="text" _autocheck="true" id="nametran" value="" style="height: 30px;width: 200px" placeholder="Enter your nickname" name="nametran"></span>
                    </td>
                </tr>
            </table>

        </div>
        <div class="formRow">
            <table>
                <tr>
                    <td>
                        <label for="param_name" class="formLeft" id="nameuser"
                               style="margin-left: 400px;margin-bottom:7px;width: 200px">Re-enter the nickname you want to transfer:</label></td>
                    <td>
                        <span class="oneTwo"><input type="text" _autocheck="true" id="nametranre" value="" style="height: 30px;width: 200px" placeholder="Re-enter your nickname"
                                                    name="nametranre"></span>
                    </td>
                </tr>
            </table>

        </div>
        <div class="formRow">
            <table>
                <tr>
                    <td>
                        <label for="param_name" class="formLeft" id="vinlabel"
                               style="margin-left: 400px;margin-bottom:7px;width: 200px">Transmitted vin number:
                        </label></td>
                    <td>
                        <span class="oneTwo"><input type="text" _autocheck="true" id="vintran" value="" placeholder="Enter the win number to transfer" style="height: 30px;width: 200px" name="vintran"></span>
                    </td>
                </tr>
            </table>

        </div>
        <div class="formRow">
            <table>
                <tr>
                    <td>
                        <label for="param_name" class="formLeft" id="nameuser"
                               style="margin-left: 400px;margin-bottom:7px;width: 200px">OTP code:
                        </label></td>
                    <td>
                        <span class="oneTwo"><input type="text" _autocheck="true" id="maotp" value="" placeholder="Enter the otp code" style="height: 30px;width: 200px"
                                                    name="maotp"></span>
                    </td>
                </tr>
            </table>

        </div>
        <div class="formRow">
            <table>
                <tr>
                    <td>
                        <span class="oneTwo"><input type="button" _autocheck="true" class="button blueB" id="chuyenkhoan" style="margin-left: 600px"
                                                    value="Transfer"></span>
                    </td>
                </tr>
            </table>

        </div>    </div>
</div>

<script>
    $("#chuyenkhoan").click(function () {    })</script>
