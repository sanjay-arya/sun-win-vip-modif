<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>List of banners</h5>
        </div>
        <div class="horControlB menu_action">
            <ul>
                <li>
                    <a href="<?php echo admin_url('banner/create')?>">
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
            <form class="list_filter form" action="<?php echo admin_url('banner') ?>" method="post">
                <div class="formRow row">
                    <div class="col-sm-1">
                        <label for="giftCode">Name : </label>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" id="title" value="<?php echo $this->input->post('title') ?>" name="title">
                    </div>

                    <div class="col-sm-1">
                        <label for="giftCode">Status : </label>
                    </div>
                    <div class="col-sm-2">
                        <select id="status" name="status">
                            <option value="">Select</option>
                            <option value="1" <?php if ($this->input->post('status') == 1) { echo "selected";} ?>>Active</option>
                            <option value="0" <?php if ($this->input->post('status') === '0') { echo "selected";} ?>>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="formRow row">
                    <div class="col-sm-1">
                        <input type="submit" id="search_tran" value="Search" class="button blueB">
                    </div>
                    <div class="col-sm-1">
                        <input type="reset" onclick="window.location.href = '<?php echo admin_url('banner') ?>';" value="Reset" class="basic">
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
                            <tr style="height: 20px;">
                                <th style="width:40px">No</th>
                                <th style="width:40px" hidden>Id</th>
                                <th style="width: 250px">Name </th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Action</th>
                                <th>Url</th>
                                <!-- <th>Act</th> -->
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
        rs += "<td class='stt'>" + stt + "</td>";
        rs += "<td>" + value.title + "</td>";
        rs += "<td>" + maskStatus(value.status) + "</td>";
        rs += "<td>" + '<img class="img-banner" src="' + value.image_path + '">'  + "</td>";
        rs += "<td>" + value.action + "</td>";
        rs += "<td>" + value.url + "</td>";
        rs += "<td class='option'>" +
            `<a href="<?= admin_url('banner/edit')?>?id=${value.id}" class="text-decoration"> Edit</a>` +
            `<a href="#" class="text-decoration" onclick="myfuntion('`+value.title+`','`+value.id+`')"> Erase</a>` +
            "</td>";
        return rs;
    }

    function myfuntion(tt, id) {
        bootbox.confirm("Are you sure you want to delete the banner? : " + tt,
            function(result)
            {
                if(result) {
                    window.location.href = '<?= admin_url('banner/delete'). '?id=' ?>' + id;
                }
            });
    }

    function initData() {
        var oldPage = 0;
        var result = "";
        $('#pagination-demo').css("display", "block");
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('banner/getListAjax')?>",
            data: {
                sts: $('#status').val(),
                tt: $('#title').val(),
                pages : 1,
                size: page_size
            },
            dataType: 'json',
            success: function (response) {
                let result = response
                console.log(result);
                result.total = response.totalRecords
                $("#total").html(result.total);
                $("#spinner").hide();

                if (result.total == 0) {
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
                                    url: "<?php echo admin_url('banner/getListAjax')?>",
                                    data: {
                                        sts: $('#status').val(),
                                        tt: $('#title').val(),
                                        pages : page,
                                        size: page_size
                                    },
                                    dataType: 'json',
                                    success: function (response) {
                                        let result = response
                                        list_data = result.data
                                        $("#resultsearch").html("");
                                        $("#spinner").hide();
                                        stt = (page -1) * page_size + 1;
                                        let str = ''
                                        $.each(result.data, function (index, value) {
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
    function maskStatus(val) {
        if (val == 1) {
            return 'Active';
        }
        return 'Inactive';
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