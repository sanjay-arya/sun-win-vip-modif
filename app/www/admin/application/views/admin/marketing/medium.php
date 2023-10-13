<?php $this->load->view('admin/marketing/head', $this->data) ?>
<div class="line"></div>
<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget">
        <div class="title">
            <h6>List medium </h6>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
            <tr style="height: 20px;">
                <td style="width:80px;">No</td>
                <td>Name</td>
                <td>Name Display</td>
                <td>Act</td>
            </tr>
            </thead>
            <tbody id="logdongbang">
            <?php $i = 1; ?>
            <?php foreach($list as $row): ?>
                <tr>
                    <td class="textC"><?php echo $i; ?></td>
                    <td><?php echo $row->name ?></td>
                    <td><?php echo $row->name_display ?></td>
                    <td class="option">
                        <a href="<?php echo admin_url('marketing/editmedium/' . $row->id) ?>" title="Edit" class="tipS ">
                            <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png"/>
                        </a>
                        <a href="<?php echo admin_url('maketing/deletemedium/' . $row->id) ?>" title="Erase"
                           class="tipS verify_action">
                            <img src="<?php echo public_url('admin') ?>/images/icons/color/delete.png"/>
                        </a>
                    </td>

                </tr>
                <?php $i++; ?>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<script>
</script>