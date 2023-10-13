<!-- head -->
<?php $this->load->view('admin/menu/head', $this->data) ?>
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
        <div class="title">
            <h6>Menu list</h6>
            <div class="num f12">Total:<b><?php echo $total ?></b></div>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
            <tr>
                <td style="width:80px;">No</td>
                <td>Group name</td>
                <td>Order</td>
                <td style="width:100px;">Operation</td>
            </tr>
            </thead>
            <tbody>
            <?php echo $list; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>
<div class="clear mt30"></div>
