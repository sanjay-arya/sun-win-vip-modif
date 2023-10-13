<!-- head -->
<?php $this->load->view('admin/admin/head', $this->data) ?>
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
            <?php if ($admin_info->Status == "A"): ?>
                <div class="title">
                    <h6>List admin</h6> <span hidden><?php echo $_SERVER['SERVER_ADDR'] ?></span>

                </div>
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck"
                       id="checkAll">

                    <thead>
                    <tr>
                        <td style="width:80px;">No</td>
                        <td>Username</td>
                        <td>Nickname</td>
                        <td>Group</td>
                        <td style="width:100px;">Act</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($list as $row): ?>
                        <tr>
                            <td class="textC"><?php echo $i; ?></td>
                            <td>
						<span title="<?php echo $row->UserName ?>" class="tipS">
							<?php echo $row->UserName ?>
						</span></td>
                            <td><span title="<?php echo $row->FullName ?>" class="tipS">
							<?php echo $row->FullName ?>
						</span></td>
                            <td><span class="tipS">
                            	<?php echo $row->Name ?>
						</span></td>

                            <td class="option">
                                <a href="<?php echo admin_url('admin/changePassword/' . $row->ID) ?>" title="Change Password"
                                   class="tipS ">
                                    <img src="<?php echo public_url('admin') ?>/images/icons/color/locks.png"/>
                                </a>
                                <a href="<?php echo admin_url('admin/edit/' . $row->ID) ?>" title="Edit"
                                   class="tipS ">
                                    <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png"/>
                                </a>
                                <a href="<?php echo admin_url('admin/delete/' . $row->ID.'/'.$row->FullName) ?>" title="Erase"
                                   class="tipS verify_action">
                                    <img src="<?php echo public_url('admin') ?>/images/icons/color/delete.png"/>
                                </a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="title">
                    <h6>You are not authorized</h6>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<div class="clear mt30"></div>

<script>
    $('a.verify_action').click(function () {
        if (!confirm('Are you sure you want to delete ??')) {
            return false;
        }
    });
</script>