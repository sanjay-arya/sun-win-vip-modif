<!-- head -->
<?php $this->load->view('admin/admin/head', $this->data) ?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">
        <div class="title">
            <h6>Add new users</h6>
        </div>
        <form id="form" class="form" enctype="multipart/form-data" method="post" action="<?= admin_url('admin/create')?>">
            <fieldset>
                <div class="formRow">
                    <label for="param_name" class="formLeft">Username:<span class="req">*</span></label>

                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" id="param_name" value="<?php echo set_value('username') ?>" name="username"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('username') ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_username" class="formLeft">Nickname:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo set_value('fullname') ?>" id="param_username" name="fullname"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('fullname') ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_name" class="formLeft">Part:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"> <select for="inputEmail3" id="selectchucnang" name="typeaccount">
                                <option value="W">Operate</option>
                                <option value="LM">Leader Maketing</option>
                                <option value="M">Maketing</option>
                                <option value="S">Customer care</option>
                                <option value="LS">Customer care leader</option>
                                <option value="L">Leader</option>
                                <option value="D">Dealer care</option>
                                <option value="Q">General Management</option>
                                <option value="K">Accountant</option>
                                <option value="C">Developer</option>
                                <option value="A">Admin</option>
                            </select></span>
                        <div class="clear error" name="name_error"><?php echo form_error('typeaccount') ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formSubmit">
                    <input type="submit" class="redB" value="Add new">
                </div>
            </fieldset>
        </form>
    </div>
</div>