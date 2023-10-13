<!-- head -->
<?php $this->load->view('admin/admin/head', $this->data) ?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">
        <?php if($admin_info->Status == "A"): ?>
        <div class="title">
            <h6>Update administrator information</h6>
        </div>
        <form id="form" class="form" enctype="multipart/form-data" method="post" action="">
            <fieldset>

                <div class="formRow">
                    <label for="param_username" class="formLeft">Username:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo $info->UserName ?>" readonly id="param_username" name="username"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('username') ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_name" class="formLeft">Nickname:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" id="param_name" value="<?php echo $info->FullName ?>" readonly name="name"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('name') ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_name" class="formLeft">Part:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"> <select for="inputEmail3" id="selectchucnang" name="typeaccount">
                                <option value="W" <?php if($info->Status == "W"){echo "selected";} ?>>Operate</option>
                                <option value="LM" <?php if($info->Status == "LM"){echo "selected";} ?>>Leader Maketing</option>
                                <option value="M" <?php if($info->Status == "M"){echo "selected";} ?>>Maketing</option>
                                <option value="S" <?php if($info->Status == "S"){echo "selected";} ?>>Customer care</option>
                                <option value="L" <?php if($info->Status == "L"){echo "selected";} ?>>Leader</option>
                                <option value="D" <?php if($info->Status == "D"){echo "selected";} ?>>Dealer care</option>
                                <option value="Q" <?php if($info->Status == "Q"){echo "selected";} ?>>General Management</option>
                                <option value="K" <?php if($info->Status == "K"){echo "selected";} ?>>Operate</option>
                                <option value="C" <?php if($info->Status == "C"){echo "selected";} ?>>Developer</option>
                                <option value="A" <?php if($info->Status == "A"){echo "selected";} ?>>Admin</option>

                            </select></span>
                        <div class="clear error" name="name_error"><?php echo form_error('typeaccount') ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_phone" class="formLeft">Decentralization:<span class="req"></span></label>
                    <div class="formRight">
                        <a href="<?php echo admin_url('admin/role/' . $info->ID) ?>" title="Decentralization" class="tipS">
                            Decentralization
                        </a>
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
