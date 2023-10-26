<!-- head -->
<?php $this->load->view('admin/groupuser/head', $this->data) ?>
<div class="line"></div>
<?php if($role == false): ?>
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
        <?php if ($list != null) : ?>
            <div class="title">
                <h6>List of groups People use</h6>
                <div class="num f12">Total: <b><?php echo $total ?></b></div>
            </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                <tr>
                    <td style="width:80px;">No</td>
                    <td>Group Name</td>
                    <td>Note</td>
                    <td style="width:100px;">Operation</td>
                </tr>

                </thead>
                <tbody>
                <?php $stt = 1; ?>
                <?php foreach ($list as $row): ?>
                    <tr>
                        <td class="textC"><?php echo $stt ?></td>
                        <td>
						<span title="<?php echo $row->Name ?>" class="tipS">
							<?php echo $row->Name ?>
						</span></td>
                        <td>
						<span title="<?php echo $row->Description ?>" class="tipS">
							<?php echo $row->Description ?>
						</span></td>
                        <td class="option">
                            <a href="<?php echo admin_url('groupuser/edit/' . $row->Id) ?>" title="Edit"
                               class="tipS ">
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png"/>
                            </a>
                            <a hidden href="<?php echo admin_url('groupuser/delete/' . $row->Id) ?>" title="Erase"
                               class="tipS verify_action">
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/delete.png"/>
                            </a>
                        </td>
                    </tr>
                    <?php $stt++; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif ?>
        <?php if ($list == null): ?>
            You do not have access
        <?php endif ?>
    </div>
</div>
<?php endif ?>
<div class="clear mt30"></div>
