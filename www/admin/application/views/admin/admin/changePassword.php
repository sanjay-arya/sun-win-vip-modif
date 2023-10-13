<!-- head -->
<?php $this->load->view('admin/admin/head', $this->data) ?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">
        <?php if($admin_info->Status == "A"): ?>
            <div class="title">
                <h6>Change administrator password</h6>
            </div>
            <form id="form" class="form" enctype="multipart/form-data" method="post" action="">
                <fieldset>

                    <div class="formRow">
                        <label for="oldPassword" class="formLeft">Old password:<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneTwo"><input  _autocheck="true" type="text" id="oldPassword" name="oldPassword"></span>
                            <span class="autocheck" name="name_autocheck"></span>
                            <div class="clear error" name="name_error"><?php echo form_error('oldPassword') ?></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label for="newPassword" class="formLeft">A new password:<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneTwo"><input _autocheck="true"  type="password" id="newPassword" name="newPassword"></span>
                            <span class="autocheck" name="name_autocheck"></span>
                            <div class="clear error" name="name_error"><?php echo form_error('newPassword') ?></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label for="retypePassword" class="formLeft">Remind password:<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneTwo"><input _autocheck="true" type="password" id="retypePassword" name="retypePassword"></span>
                            <span class="autocheck" name="name_autocheck"></span>
                            <div class="clear error" name="name_error"><?php echo form_error('retypePassword') ?></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formSubmit">
                        <input type="submit" class="redB" value="Update">
                    </div>
                </fieldset>
            </form>
        <?php else: ?>
            <div class="title">
                <h6>You are not authorized</h6>
            </div>
        <?php endif; ?>
    </div>
</div>
