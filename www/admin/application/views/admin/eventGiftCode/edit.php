<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Marketing</h5>
        </div>
        <div class="horControlB menu_action">
            <ul>
                <li>
                    <a href="<?php echo admin_url('eventGiftCode') ?>">
                        <img src="<?php echo public_url('admin') ?>/images/icons/control/16/list.png">
                        <span>List</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="wrapper return-url">
    <a class="" href="<?= admin_url('eventGiftCode')?>">
        <i class="fas fa-angle-double-left"></i> Come back
    </a>
</div>
<div class="wrapper">
    <div class="widget backaccount">
        <section class="content-header">
            <h1>
            Edit event
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <form class="box">
                        <div class="box-body">
                            <div class="form-group successful">
                                <div class="row">
                                    <label class="control-label col-sm-2 text-danger" id="errorgift"></label>
                                </div>
                                <div class="row">
                                    <label class="control-label col-sm-2 text-success" id="success-gift"></label>
                                </div>
                            </div>
                            <div id="hideForType0" class="form-group">
                                <div class="row">
                                    <label class="col-sm-2 control-label" for="inputGiftCode">Name: (*)</label>
                                    <input class="col-sm-3 form-control" type="text" id="title" name="title" value="<?= $eventGiftCode['name']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-2 control-label" for="datetimepicker1">Expiration date : (*)</label>
                                    <div class="col-sm-3 input-group" id="datetimepicker1">
                                        <input class="form-control" type="text" id="expiredTime" name="expiredTime" value="<?= $eventGiftCode['expired_date']?>"> <span class="input-group-addon ">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-2 control-label" for="inputType">Amount: (*)</label>
                                    <div class="col-sm-3" style="padding-left: 0;">
                                        <input class="form-control" type="text" id="amount" name="amount" value="<?= $eventGiftCode['amount']?>">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input type="submit" value="Send" name="submit" class="btn btn-primary" id="edit_gift_code">
                                        <input type="reset" value="Reset" name="submit" style="min-width: 120px"
                                               class="btn btn-primary ml-3" id="reset"
                                               onclick="window.location.href ='<?php echo admin_url('eventGiftCode/edit?id=' . $id) ?>';">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
</div>
<style>
</style>
<script>
    $(document).ready(function () {
        $("#reset").on('click', function (e){
            reset()
        })
    })
    $(function () {
        var startDate = moment(new Date()).hours(0).minutes(0).seconds(0).milliseconds(0);
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            defaultDate: startDate,
            useCurrent : false
        });
    });
    function reset() {
        $(this).find("input").val('')
    }

    $("#edit_gift_code").click(function (e) {
        e.preventDefault()
        if(!$("#title").val() || !$("#amount").val() || !$("#expiredTime").val()) {
            $('#errorgift').html('Nhập đầy đủ các trường bắt buộc');
            return;
        }
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?= admin_url('eventGiftCode/storeAjax') ?>",
            data: {
                n: $("#title").val(),
                am: $("#amount").val(),
                ed: $("#expiredTime").val(),
                id: '<?= $id?>'
            },
            dataType: 'json',
            success: function (response) {
                $("#spinner").hide();
                if (response.success) {
                    reset()
                    $('#success-gift').html('Sửa sự kiện thành công');
                    window.location.href = '<?= admin_url('eventGiftCode') ?>'
                } else {
                    $("#errorgift").html(response.message)
                }
            }, error: function () {
                $("#spinner").hide();
                $("#errorgift").html("Hệ thống quá tải. Vui lòng thử lại!");
            }, timeout: 60000
        })
    });
</script>
