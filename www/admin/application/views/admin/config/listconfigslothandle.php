<!-- head -->
<?php $this->load->view('admin/config/head', $this->data) ?>
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
        <div class="widget">
            <?php if($admin_info ->Status == "A"): ?>
                <div class="title">
                    <h6>List of jackpot slot games and funds</h6>
                </div>
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                    <thead>
                    <tr>
                        <td>Id</td>
                        <td>Name config</td>
                        <td>Act</td>
                    </tr>
                    </thead>
                    <tbody id="logaction">
                    <tr>
                        <td>1</td>
                        <td>Jackpot slot bitcoin</td>
                        <td>
                            <a href='<?php echo admin_url('confignew/editslothandle') ?>?t=0'>
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jackpot slot westward</td>
                        <td>
                            <a href='<?php echo admin_url('confignew/editslothandle') ?>?t=2'>
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Crazy bird slot jackpot</td>
                        <td>
                            <a href='<?php echo admin_url('confignew/editslothandle') ?>?t=4'>
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Jackpot slot god of wealth</td>
                        <td>
                            <a href='<?php echo admin_url('confignew/editslothandle') ?>?t=6'>
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Sports slot jackpot</td>
                        <td>
                            <a href='<?php echo admin_url('confignew/editslothandle') ?>?t=8'>
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Jackpot slot Kim Bình Mai</td>
                        <td>
                            <a href='<?php echo admin_url('confignew/editslothandle') ?>?t=10'>
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Fund slot bitcoin</td>
                        <td>
                            <a href='<?php echo admin_url('confignew/editslothandle') ?>?t=12'>
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Fund slot west travel</td>
                        <td>
                            <a href='<?php echo admin_url('confignew/editslothandle') ?>?t=14'>
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Fund slot crazy bird</td>
                        <td>
                            <a href='<?php echo admin_url('confignew/editslothandle') ?>?t=16'>
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Fund slot god of wealth</td>
                        <td>
                            <a href='<?php echo admin_url('confignew/editslothandle') ?>?t=18'>
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Fund sports slots</td>
                        <td>
                            <a href='<?php echo admin_url('confignew/editslothandle') ?>?t=20'>
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Fund slot kim Binh mai</td>
                        <td>
                            <a href='<?php echo admin_url('confignew/editslothandle') ?>?t=22'>
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png">
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="title">
                    <h6>You are not authorized</h6>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif;?>
<div class="clear mt30"></div>

<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
</script>
