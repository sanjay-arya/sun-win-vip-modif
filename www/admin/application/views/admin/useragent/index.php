<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Agency</h5>
        </div>
        <div class="horControlB menu_action">
            <ul>
                <li>
                    <a href="<?php echo admin_url('userAgency/create')?>">
                        <img src="<?php echo public_url('admin')?>/images/icons/control/16/add.png">
                        <span>Add new</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>
<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>

    <div class="widget backaccount">
        <form class="list_filter form" action="<?php echo admin_url('userAgency') ?>" method="post">
            <div class="formRow row">
                <div class="col-sm-1">
                    <label for="giftCode">Code : </label>
                </div>
                <div class="col-sm-2">
                    <input type="text" id="code" value="<?php echo $this->input->post('code') ?>" name="code">
                </div>

                <div class="col-sm-1">
                    <label for="giftCode">Key : </label>
                </div>
                <div class="col-sm-2">
                    <input type="text" id="key" value="<?php echo $this->input->post('key') ?>" name="key">
                </div>
                <div class="col-sm-1">
                    <label for="giftCode">Level : </label>
                </div>
                <div class="col-sm-2">
                    <input type="number" id="level" value="<?php echo $this->input->post('level') ?>" name="level">
                </div>
            </div>
            <div class="formRow row">
                <div class="col-sm-1">
                    <input type="submit" id="search_tran" value="Search" class="button blueB">
                </div>
                <div class="col-sm-1">
                    <input type="reset" onclick="window.location.href = '<?php echo admin_url('userAgency') ?>';" value="Reset" class="basic">
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-sm-12">
                <h3 class="float-right">Total records:<span style="color:#0000ff" id="total"></span></h3>
            </div>
            <div class="col-sm-12">
                <div id="resultsearch" class="float-left text-danger"></div>
            </div>
        </div>
        <div class="formRow">
            <div class="row">
                <div class="col-xs-12">
                    <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>User name </th>
                            <th>Nick name</th>
                            <th>Name agent</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Code</th>
                            <th>Login times</th>
                            <th>Last login time</th>
                            <th>Status</th>
                            <th>Act</th>
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
        initData()
    })
    function resultList(stt, value) {
        var rs = "";
        rs += "<tr>";
        rs += "<td>" + stt + "</td>";
        rs += "<td>" + value.username + "</td>";
        rs += "<td>" + value.nickname + "</td>";
        rs += "<td>" + value.nameagent + "</td>";
        rs += "<td>" + value.address + "</td>";
        rs += "<td>" + value.phone + "</td>";
        rs += "<td>" + value.email + "</td>";
        rs += "<td>" + value.level + "</td>";
        rs += "<td>" + value.code + "</td>";
        rs += "<td>" + value.login_times + "</td>";
        rs += "<td>" + value.last_login_time + "</td>";
        rs += "<td>" + maskActive(value.active) + "</td>";
        rs += "<td class='option'>" +
            `<a href="<?= admin_url('userAgency/edit')?>/${value.id}" class="text-decoration"> Edit</a>` +
            `<a target="_blank" href="<?= admin_url('userAgency/player?cd=')?>${value.code}" class="text-decoration"> Detail</a>` +
            "</td>";
        return rs;
    }

    function initData() {
        var oldPage = 0;
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('userAgency/getListAjax')?>",
            data: {
                code: $('#code').val(),
                key: $('#key').val(),
                level: $('#level').val(),
                pages : 1,
                size: page_size
            },
            dataType: 'json',
            success: function (response) {
                var totalRecords = response.totalRecords;
                $("#total").html(totalRecords);
                $("#spinner").hide();
                if (totalRecords == 0) {
                    list_data = []
                    $('#pagination-demo').css("display", "none");
                    $("#resultsearch").html("No results were found");
                }else {
                    list_data = response.data
                    $("#resultsearch").html("");
                    var totalPage = Math.floor(totalRecords/page_size) + (totalRecords%page_size?1:0);
                    let str = ''
                    let stt = 1;
                    $.each(response.data, function (index, value) {
                        str += resultList(stt, value);
                        stt++;
                    });
                    $('#logaction').html(str);
                    $('#pagination-demo').twbsPagination({
                        totalPages: totalPage,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            if (oldPage > 0) {
                                $("#spinner").show();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo admin_url('userAgency/getListAjax')?>",
                                    data: {
                                        code: $('#code').val(),
                                        key: $('#key').val(),
                                        level: $('#level').val(),
                                        pages : page,
                                        size: page_size
                                    },
                                    dataType: 'json',
                                    success: function (response) {
                                        list_data = response.data
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = (page -1) * page_size + 1;
                                        let str = ''
                                        $.each(response.data, function (index, value) {
                                            str += resultList(stt, value);
                                            stt++;
                                        });
                                        $('#logaction').html(str);
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
    function maskActive(val) {
        if (val == 1) {
            return 'Activated';
        }
        return 'Void';
    }
</script>
<style>
    .img-banner {
        max-height: 200px;
    }

    .text-decoration {
        color: blue;
        text-decoration: underline;
    }
</style>