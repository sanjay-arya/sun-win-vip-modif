<?php $this->load->view('admin/bankaccount/head', $this->data) ?>
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

    <div class="widget backaccount">
        <h4 id="resultsearch" style="color: red;margin-left: 20px"></h4>
        <div class="title">
            <h6>List Account ngân hàng</h6>
            <h6 style="float: right">Total số bản ghi:<span style="color:#0000ff" id="total"></span></h6>
        </div>

        <form class="list_filter form" action="<?php echo admin_url('bankaccount/userbot') ?>" method="post">
            <div class="formRow">
                <table>
                    <tr>
                        <td><label for="nickName" style="margin-left: 30px;margin-bottom:-2px;width: 120px">Nick Name:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="nickName" value="<?php echo $this->input->post('nickName') ?>" name="nickName">
                        </td>

                        <td><label for="customerName" style="margin-left: 50px;margin-bottom:-2px;width: 100px">Name:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="customerName" value="<?php echo $this->input->post('customerName') ?>" name="customerName">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="formRow">
                <table>
                    <tr>
                        <td><label for="bankNumber" style="margin-left: 50px;margin-bottom:-2px;width: 100px">Số tài khoản:</label></td>
                        <td><input type="text" style="margin-left: 20px;margin-bottom:-2px;width: 150px"
                                   id="bankNumber" value="<?php echo $this->input->post('bankNumber') ?>" name="bankNumber">
                        </td>

                        <td><label for="bankName" style="margin-left: 50px;margin-bottom:-2px;width: 100px">Ngân hàng:</label></td>
                        <td>
                            <?php $this->load->view('/admin/component/selection/bankname'); ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="formRow">
                <table>
                    <tr>

                        <td style="">
                            <input type="submit" id="search_tran" value="Search" class="button blueB"
                                   style="margin-left: 70px">
                        </td>
                        <td>
                            <input type="reset"
                                   onclick="window.location.href = '<?php echo admin_url('bankaccount/userbot') ?>'; "
                                   value="Reset" class="basic" style="margin-left: 20px">
                        </td>
                        <td>
                            <span style="margin-left: 20px">
                                <?php $this->load->view('/admin/component/exportexcel', ['pre_file_name'=>'bankacount', 'columns_excel' => "0,1,2,3,4,5,6"]); ?>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <div class="formRow">
            <div class="row">
                <div class="col-xs-12">
                    <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                        <thead>
                        <tr style="height: 20px;">
                            <th style="width:40px">No</th>
                            <th style="width:40px" hidden>Id</th>
                            <th>Nick Name</th>
                            <th>Name</th>
                            <th>Chi nhánh</th>
                            <th>Name ngân hàng</th>
                            <th>Account</th>
                            <th style="width: 70px;">Active</th>
                            <th>Người sửa cuối cùng</th>
                            <th>Ngày chỉnh sửa cuối cùng</th>
                            <th style="width:100px;">Act</th>
                        </tr>
                        </thead>
                        <tbody id="logaction">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<style>
    .backaccount td{
        word-break: break-all;
    }
    .backaccount thead{
        font-size: 12px;
    }
    .backaccount .spinner {
        position: fixed;
        top: 50%;
        left: 50%;
        margin-left: -50px; /* half width of the spinner gif */
        margin-top: -50px; /* half height of the spinner gif */
        text-align: center;
        z-index: 1234;
        overflow: auto;
        width: 100px; /* width of the spinner gif */
        height: 102px; /*hight of the spinner gif +2px to fix IE8 issue */
    }</style>
<div class="container">
    <div id="spinner" class="spinner" style="display:none;">
        <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
    </div>
    <div class="text-center">
        <ul id="pagination-demo" class="pagination-lg"></ul>
    </div>
</div>
<script>
    var page_size = '<?php echo $this->input->post('page_size') ?>' || 10
    var list_data =[]
    $(document).ready(function (){
        $("#inputStatus").bootstrapToggle()
        initData()
    })

    function resultSearchTransction(stt, value) {
        var date_ob = new Date(value.updateDate);

        var date = ("0" + date_ob.getDate()).slice(-2);

        var month = ("0" + (date_ob.getMonth() + 1)).slice(-2);

        var year = date_ob.getFullYear();

        if(date_ob.getHours() < 10) {
            var hours = ("0" + date_ob.getHours());
        } else {
            var hours = date_ob.getHours();
        }

        if(date_ob.getMinutes() < 10) {
            var minutes = ("0" + date_ob.getMinutes());
        } else {
            var minutes = date_ob.getMinutes();
        }

        if(date_ob.getSeconds() < 10) {
            var seconds = ("0" + date_ob.getSeconds());
        } else {
            var seconds = date_ob.getSeconds();
        }

        var updateDate = (year + "-" + month + "-" + date + " " + hours + ":" + minutes + ":" + seconds);

        var rs = "";
        rs += "<tr>";
        rs += "<td class='stt'>" + stt + "</td>";
        rs += "<td class='' style='display: none'>" + value.id + "</td>";
        rs += "<td class=''>" + value.nickName + "</td>";
        rs += "<td class=''>" + value.customerName + "</td>";
        rs += "<td >" + (value.branch || '-') + "</td>";
        rs += "<td class=''>" + value.bankName + "</td>";
        rs += "<td class=''>" + value.bankNumber + "</td>";
        rs += "<td class='' style='text-align: center;'><i class='" + (value.status == 1 ? 'fa fa-check' :'' ) + "' aria-hidden='true'></i></td>";
        rs += "<td class=''>" + (value.lastEditor || '-') + "</td>";
        rs += "<td class=''>" + (updateDate) + "</td>";
        rs += "<td class='option'>" +
                "<a href='' title='Edit' class='tipS edit-action'> <img src=' <?php echo public_url('admin') ?>/images/icons/color/edit.png'/></a>" +
                "<a href='' title='Erase' class='tipS delete-action verify_action'> <img src='<?php echo public_url('admin') ?>/images/icons/color/delete.png'/></a>" +
               "</td>";
        return rs;
    }
    function handleActionListener() {
        $('.tipS.edit-action').click( function (e){
            e.preventDefault()

            $('#my-bootstrap-modal').modal('show')

            let item_index = $(this).closest('td').siblings('.stt').text()
            let value = list_data[(item_index -1)%page_size]

            $("#inputId").val(value.id)
            $("#inputType").val(1) // edit
            $("#inputNickName").val(value.nickName)
            $("#inputCustomerName").val(value.customerName)
            $("#inputBankNumber").val(value.bankNumber)
            $("#inputBankName").val(value.bankName)
            $("#inputBranchName").val(value.branch)
            $("#inputStatus").bootstrapToggle(value.status === 1 ? 'on' : 'off')
        })

        $('.tipS.delete-action').click( function (e){
            e.preventDefault()

            let item_index = $(this).closest('td').siblings('.stt').text()
            let value = list_data[(item_index -1)%page_size]

            bootbox.confirm({
                message: 'Bạn có chắc chắn xóa <b>' + value.nickName + '</b></br>' + messageBody(value),
                backdrop: true,
                centerVertical: true,
                callback: function (result) {
                    if (result) {
                        // call to send data
                        $.ajax({
                            type: "POST",
                            url: "<?php echo admin_url('bankaccount/delete_ajax')?>",
                            data: {
                                "id":  value.id,
                            },
                            dataType: 'json',
                            success: function (response) {
                                $("#spinner").hide();
                                if (response.success) {
                                    $("#resultsearch").html("");
                                    initData()
                                } else {
                                    bootbox.alert({
                                        message: `<i class="fa fa-times-circle text-danger" aria-hidden="true"></i> Đã có lỗi xảy ra ${response.errorCode} : ${response.message}`,
                                        backdrop: true,
                                        centerVertical: true
                                    })
                                    initData()
                                }

                            }, error: function (e) {
                                console.error(e.message)
                                $("#spinner").hide();
                                $("#resultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
                            }, timeout: 20000
                        })
                    }
                }
            });
        })
    }

    function messageBody(value) {
        return '<table class="table"><tr><th>Trường dữ liệu<th/><th>Thuộc tính<th/></tr>' +
            '<tr><td>Số tài khoản<td/><td>' + value.bankNumber + '<td/></tr>' +
            '<tr><td>Nickname<td/><td>' + value.nickName + '<td/></tr>' +
            '<tr><td>Name<td/><td>' + value.customerName + '<td/></tr>' +
            '<tr><td>Ngân hàng<td/><td>' + value.bankName + '<td/></tr>' +
            '<tr><td>Chi nhánh<td/><td>' + (value.branch || '-') + '<td/></tr>' +
            '</table>'
    }

    function initData() {
        var oldPage = 0;
        var result = "";
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('bankaccount/indexajax')?>",
            data: {
                nickName: $("#nickName").val(),
                bankName: $("#bankName").val(),
                bankNumber: $("#bankNumber").val(),
                customerName: $("#customerName").val(),
                pages : 1,
                size: page_size
            },

            dataType: 'json',
            success: function (response) {
                let result = JSON.parse(response.data)
                $("#total").html(result.total);
                $("#spinner").hide();

                if (result.total == 0 || result.data.length == 0) {
                    list_data = []
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("No results were found");
                }else {
                    list_data = result.data
                    $("#resultsearch").html("");
                    let totalPage = Math.floor(result.total/page_size) + (result.total%page_size?1:0);
                    stt = 1;
                    let str = ''
                    $.each(result.data, function (index, value) {
                        str += resultSearchTransction(stt, value);
                        stt++;
                    });
                    $('#logaction').html(str);
                    handleActionListener();

                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldPage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('bankaccount/indexajax')?>",
                                    data: {
                                        nickName: $("#nickName").val(),
                                        bankName: $("#bankName").val(),
                                        bankNumber: $("#bankNumber").val(),
                                        customerName: $("#customerName").val(),
                                        pages : page,
                                        size: page_size
                                    },
                                    dataType: 'json',
                                    success: function (response) {
                                        let result = JSON.parse(response.data)
                                        list_data = result.data
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = (page -1) * page_size + 1;
                                        let str  = ''
                                        $.each(result.data, function (index, value) {
                                            str += resultSearchTransction(stt, value);
                                            stt++;
                                        });
                                        $('#logaction').html(str);
                                        handleActionListener()
                                    }, error: function () {
                                        list_data = []
                                        $("#spinner").hide();
                                        $('#logaction').html("");
                                        $("#resultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
                                    },timeout : 20000
                                });
                            }
                            oldPage = page;
                        }
                    });
                }

            }, error: function () {
                list_data = []
                $("#spinner").hide();
                $('#logaction').html("");
                $("#resultsearch").html("System overload. Please call 19008698 or F5 to return to the pages");
            },timeout : 20000
        })

    };
</script>
<script>
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }
</script>