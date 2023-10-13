<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Đại Lý</h5>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="wrapper return-url">
    <a class="" href="<?= admin_url('userAgency')?>">
        <i class="fas fa-angle-double-left"></i> Come back
    </a>
</div>
<div class="wrapper">
    <div class="widget backaccount">
        <section class="content-header">
            <h1>
                Thêm đại lý
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <form class="box">
                        <div class="box-body">
                            <div class="form-group successful">
                                <div class="row">
                                    <label class="control-label col-sm-2 text-danger" id="error-validate"></label>
                                </div>
                                <div class="row">
                                    <label class="control-label col-sm-2 text-success" id="success-gift"></label>
                                </div>
                            </div>
                            <div id="hideForType0" class="form-group">
                                <div class="row">
                                    <label class="col-sm-2 control-label" for="inputGiftCode">User name (*) </label>
                                    <input class="col-sm-3 form-control" type="text" name="un" id="un">
                                </div>
                            </div>

                            <div id="hideForType0" class="form-group">
                                <div class="row">
                                    <label class="col-sm-2 control-label" for="inputGiftCode">Nick name (*) </label>
                                    <input class="col-sm-3 form-control" type="text" name="nn" id="nn">
                                </div>
                            </div>

                            <div id="hideForType0" class="form-group">
                                <div class="row">
                                    <label class="col-sm-2 control-label" for="inputGiftCode">Name agent (*) </label>
                                    <input class="col-sm-3 form-control" type="text" name="na" id="na">
                                </div>
                            </div>

                            <div id="hideForType0" class="form-group">
                                <div class="row">
                                    <label class="col-sm-2 control-label" for="inputGiftCode">Password (*) </label>
                                    <input class="col-sm-3 form-control" type="password" name="ps" id="ps">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-2 control-label" for="inputGiftCode">Address</label>
                                    <input class="col-sm-3 form-control" type="text" name="ad" id="ad">
                                </div>
                            </div>

                            <div id="hideForType0" class="form-group">
                                <div class="row">
                                    <label class="col-sm-2 control-label" for="inputGiftCode">Phone (*) </label>
                                    <input class="col-sm-3 form-control" type="text" name="ph" id="ph">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-2 control-label" for="inputType">Email </label>
                                    <div class="col-sm-3" style="padding-left: 0;">
                                        <input class="form-control" type="text" id="em" name="em">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-2 control-label" for="inputType">Level </label>
                                    <div class="col-sm-3" style="padding-left: 0;">
                                        <input class="form-control" type="number" id="le" name="le">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-2 control-label" for="inputType">Status</label>
                                    <div class="col-sm-3" style="padding-left: 0;">
                                        <select class="form-control" id="ac" name="ac">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input value="Add new" name="submit"
                                               class="btn btn-primary" id="edit">
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
    $(document).ready(function (){
        $("#reset").on('click', function (e){
            reset()
        })
    })

    function reset() {
        $(this).find("input").val('')
    }

    $("#edit").click(function (e) {
        e.preventDefault()
        if (!$("#un").val() || !$("#nn").val() || !$("#na").val() || !$("#ph").val() || !$("#ps").val()) {
            $('#error-validate').html('Nhập đầy đủ các trường bắt buộc');
            return;
        }
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?= admin_url('userAgency/createAjax') ?>",
            data: {
                un: $("#un").val(),
                nn: $("#nn").val(),
                na: $("#na").val(),
                ad: $("#ad").val(),
                em: $("#em").val(),
                lv: $("#le").val(),
                ph: $("#ph").val(),
                ps: $("#ps").val(),
                ac: $("#ac").val()
            },
            dataType: 'json',
            success: function (response) {
                $("#spinner").hide();
                if (response.success) {
                    reset()
                    $('#success-gift').html('Update thành công');
                    window.location.href = '<?= admin_url('userAgency')?>'
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