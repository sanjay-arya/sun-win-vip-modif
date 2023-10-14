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
            <h6>Change Password</h6>
        </div>
        <div class="formRow">
            <table>
                <tr>
                    <td>
                        <label for="param_name" class="formLeft" id="nameuser"
                               style="margin-left: 400px;margin-bottom:7px;width: 200px">Enter old password:</label></td>
                    <td>
                        <span class="oneTwo"><input type="password" _autocheck="true" id="matkhaucu" value="" style="height: 30px;width: 200px" placeholder="Enter old password" name="matkhaucu"></span>
                    </td>
                    <td>
                        <label for="param_name" class="formLeft" id="nameuser"
                               style="margin-left: 20px;margin-bottom:7px;width: 200px"><span class="req" id="erroroldpass"></span></label>
                    </td>
                </tr>
            </table>

        </div>
        <div class="formRow">
            <table>
                <tr>
                    <td>
                        <label for="param_name" class="formLeft" id="nameuser"
                               style="margin-left: 400px;margin-bottom:7px;width: 200px">Enter your new password</label></td>
                    <td>
                        <span class="oneTwo"><input type="password" _autocheck="true" id="matkhaumoi" value="" style="height: 30px;width: 200px" placeholder="Enter your new password"
                                                    name="matkhaumoi"></span>
                    </td>
                    <td>
                        <label for="param_name" class="formLeft" id="nameuser"
                               style="margin-left: 20px;margin-bottom:7px;width: 200px"><span class="req" id="errornewpass"></span></label>
                    </td>
                </tr>
            </table>

        </div>
        <div class="formRow">
            <table>
                <tr>
                    <td>
                        <label for="param_name" class="formLeft" id="vinlabel"
                               style="margin-left: 400px;margin-bottom:7px;width: 200px">Enter a new password:
                        </label></td>
                    <td>
                        <span class="oneTwo"><input type="password" _autocheck="true" id="rematkhau" value="" placeholder="Enter a new password:" style="height: 30px;width: 200px" name="rematkhau"></span>
                    </td>
                    <td>
                        <label for="param_name" class="formLeft" id="nameuser"
                               style="margin-left: 20px;margin-bottom:7px;width: 200px"><span class="req" id="renewpass"></span></label>
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
                        <span class="oneTwo"><input type="button" _autocheck="true" class="button blueB" id="resetpass" style="margin-left: 600px"
                                                    value="Change Password"></span>
                    </td>
                </tr>
            </table>

        </div>    </div>
</div>

<script>
    $("#resetpass").click(function () {

        $.ajax({
            type: "POST",
            url: "<?php echo admin_url("agency/resetpassajax") ?>",
            data: {oldpass: $("#matkhaucu").val(), newpass: $("#matkhaumoi").val(),renewpass: $("#rematkhau").val()},
            dataType: 'text',
            success: function (data) {
                    console.log(data);
                    if(data == 1){

                        $("#erroroldpass").html("Cannot be left blank");
                    }else if(data == 2){
                    $("#erroroldpass").html("Old password is incorrect");
                }else if(data == 3){
                        $("#errornewpass").html("Cannot be left blank");
                    }

            }
        });

    })</script>
