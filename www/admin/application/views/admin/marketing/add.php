<!-- head -->
<?php $this->load->view('admin/marketing/head', $this->data) ?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">
        <div class="title">
            <h6>Add new campaigns</h6>
        </div>
        <form id="form_marketing" class="form" enctype="multipart/form-data" method="post" action="">

            <fieldset>
                <div class="formRow">
                    <label for="param_name" class="formLeft">Website URL:<span class="req">*</span></label>

                    <div class="formRight">
                        <span class="oneTwo"><input type="text" id="url_web" name="url_web" _autocheck="true" value="<?php echo set_value('url_web')?>"></span>
                        <span style="width: 100%;float: left;">(ví dụ: http://www.urchin.com/download.html)</span>

                        <div class="clear error" ><?php echo form_error('url_web')?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_name" class="formLeft">Campaign source:<span class="req">*</span></label>

                    <div class="formRight">
                        <select name="utm_source"  value="<?php echo set_value('utm_source')?>" class="left">
                            <option value=""></option>
                            <?php foreach ($utm_source as $row): ?>
                                <option value="<?php echo $row->name ?>"><?php echo $row->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span
                            style="width: 100%;float: left;">(Referral links: google, citysearch, newsletter4)</span>
                        <div class="clear error" id="utm_source_error"><?php echo form_error('utm_source')?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_name" class="formLeft">Campaign means:<span class="req">*</span></label>

                    <div class="formRight">
                        <select name="utm_medium"  value="<?php echo set_value('utm_medium')?>" class="left">
                            <option value=""></option>
                            <?php foreach ($utm_medium as $row): ?>
                                <option value="<?php echo $row->name ?>"><?php echo $row->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span style="width: 100%;float: left;">(Marketing media: cpc, banner, email)</span>

                        <div class="clear error" id="utm_medium_error"><?php echo form_error('utm_medium')?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_name" class="formLeft">Campaign keywords:</label>

                    <div class="formRight">
                        <span class="oneTwo"><input type="text" id="utm_term" name="utm_term" _autocheck="true" value="<?php echo set_value('utm_term')?>"></span>
                        <span style="width: 100%;float: left;">Identify paid keywords</span>

                        <div class="clear error" id="utm_term_error"><?php echo form_error('utm_term')?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_name" class="formLeft">Campaign content:</label>

                    <div class="formRight">
                        <span class="oneTwo"><input type="text" id="utm_content" name="utm_content" _autocheck="true" value="<?php echo set_value('utm_content')?>"></span>
                        <span style="width: 100%;float: left;">(Used to differentiate advertising)</span>

                        <div class="clear error" id="utm_content_error"><?php echo form_error('utm_content')?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label for="param_name" class="formLeft">Campaign name:<span class="req">*</span></label>

                    <div class="formRight">
                        <select name="utm_campaign"  value="<?php echo set_value('utm_campaign')?>" class="left">
                            <option value=""></option>
                            <?php foreach ($utm_campain as $row): ?>
                                <option value="<?php echo $row->name ?>"><?php echo $row->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span style="width: 100%;float: left;">(Product, promotional code or slogan)</span>

                        <div class="clear error" id="utm_campaign_error"><?php echo form_error('utm_campaign')?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formSubmit">
                    <input type="submit" class="redB" id="btnCreate" name="btnCreate" value="Create url">
                </div>
            </fieldset>
        </form>
    </div>
</div>
