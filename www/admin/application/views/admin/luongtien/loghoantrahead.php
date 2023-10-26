<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Hoàn trả</h5>
        </div>
        <div class="horControlB menu_action">
            <ul>
                <li><a data-toggle="modal" id="my-bootstrap-create">
                        <img src="<?php echo public_url('admin')?>/images/icons/control/16/add.png">
                        <span>Tạo hoàn trả</span>
                    </a></li>
                <li><a data-toggle="modal" id="my-bootstrap-send">
                        <img src="<?php echo public_url('admin')?>/images/icons/control/16/add.png">
                        <span>Gửi tiền hoàn trả</span>
                    </a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>

<script>
    $(document).ready(function (){
    })
    $(function() {
        $('#my-bootstrap-create').click( function (e){
            e.preventDefault()

            bootbox.prompt({
                title: `Nhập Day tạo hoàn trả yyyy-mm-dd`,
                message: "<p><span class='text-warning'>Chú ý:</span> Hệ thống sẽ xóa dữ liệu cũ nếu có</p>",
                inputType: 'date',
                value: '<?= date("Y-m-d")?>',
                callback: function (result) {
                    if(result) {
                        $("#spinner").show();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo admin_url('luongtien/createhoantraajax')?>",
                            data: {
                                "date": new Date(result).getTime()
                            },
                            dataType: 'json',
                            success: function (response) {
                                $("#spinner").hide();
                                if (response.success) {
                                    $("#resultsearch").html("");

                                    if(response.data) {
                                        bootbox.alert({
                                            message: `<div>${response.data.join("</br>")}</div>`,
                                            backdrop: true,
                                            centerVertical: true
                                        })
                                    }

                                    initData()
                                } else {

                                    bootbox.alert({
                                        message: `<i class="fa fa-times-circle text-danger" aria-hidden="true"></i> An error has occurred ${response.errorCode} : ${response.message}`,
                                        backdrop: true,
                                        centerVertical: true
                                    })
                                    initData()
                                }

                            }, error: function (e) {
                                console.error(e.message)
                                $("#spinner").hide();
                                $("#resultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
                            }, timeout: 20000})
                    }
                }
            });

        })

        $('#my-bootstrap-send').click( function (e){
            e.preventDefault()

            bootbox.prompt({
                title: `Nhập Day send hoàn trả yyyy-mm-dd`,
                inputType: 'date',
                value: '<?= date("Y-m-d")?>',
                message: "<p><span class='text-warning'>Chú ý:</span> Money sẽ được Add trực tiếp vào tài khoản People chơi</p>",
                callback: function (result) {
                    if(result) {
                        $("#spinner").show();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo admin_url('luongtien/sendhoantraajax')?>",
                            data: {
                                "date": new Date(result).getTime()
                            },
                            dataType: 'json',
                            success: function (response) {
                                $("#spinner").hide();
                                if (response.success) {
                                    $("#resultsearch").html("");

                                    if(response.data) {
                                        bootbox.alert({
                                            message: `<div>${response.data.join("</br>")}</div>`,
                                            backdrop: true,
                                            centerVertical: true
                                        })
                                    }

                                    initData()
                                } else {

                                    bootbox.alert({
                                        message: `<i class="fa fa-times-circle text-danger" aria-hidden="true"></i> An error has occurred ${response.errorCode} : ${response.message}`,
                                        backdrop: true,
                                        centerVertical: true
                                    })
                                    initData()
                                }

                            }, error: function (e) {
                                console.error(e.message)
                                $("#spinner").hide();
                                $("#resultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
                            }, timeout: 20000})
                    }
                }
            });

        })
    });

</script>