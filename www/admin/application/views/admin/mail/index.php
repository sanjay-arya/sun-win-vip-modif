<?php $this->load->view('admin/usergame/head', $this->data) ?>
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
        <h4 id="resultsearch" style="color: red"></h4>
        <div class="title">
            <h6>List mail send</h6>
        </div>
        <form class="list_filter form" method="get">
            <div class="formRow row">
                <div class="col-sm-1">
                    <label for="giftCode">Nickname:</label>
                </div>
                <div class="col-sm-2">
                    <input type="text" id="nickname" value="<?php echo $this->input->get('username') ?>" name="username">
                </div>

            </div>
            <div class="formRow row">
                <div class="col-sm-1">
                    <input type="button" id="search_tran" value="Search" class="button blueB">
                </div>
                <div class="col-sm-2">
                    <input type="reset" onclick="window.location.href = '<?php echo admin_url('mail') ?>';" value="Reset" class="basic">
                </div>
            </div>
        </form>
        <div class="formRow">
            <div class="row">
                <div class="col-xs-12">
                    <table id="checkAll" class="table table-bordered" style="table-layout: fixed">
                        <thead>
                        <tr style="height: 20px;">
                            <td>No</td>
                            <td>Tiêu đề</td>
                            <td>People send</td>
                            <td>Content</td>
                            <td>Date created</td>
                            <td>Erase mail</td>
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
    .spinner {
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
        <ul id="pagination-demosearch" class="pagination-sm"></ul>
    </div>

</div>
<script>
$("#search_tran").click(function () {
    init();
});
init();
function resultSearchTransction(stt,title,user,content,date,mid) {
    var rs = "";
    rs += "<tr>";
    rs += "<td>" + stt + "</td>";
    rs += "<td>" + title + "</td>";
    rs += "<td>" + user + "</td>";
    rs += "<td>" + stripHtml(content) + "</td>";
    rs += "<td>" + date + "</td>";
    rs += "<td>" + "<input type='button' id='deletemail' value='Erase' class='button redB' style='margin-left: 70px' onclick=\"xoamail('" + mid + "')\" >" + "</td>";
    rs += "</tr>";
    return rs;
}

function stripHtml(html) {
    let doc = new DOMParser().parseFromString(html, 'text/html');
    let sring  = doc.body.textContent || "";
    return sring.substring(0, 120) + '...';
}

function xoamail(mid) {
    if(!confirm('Are you sure you want to delete ?mail ?'))
    {
        return false;
    }
    $("#spinner").show();
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('mail/delmail')?>",
        data: {
            mid: mid
        },
        dataType: 'json',
        success: function (res) {
        }
    });
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('mail/indexajax')?>",
        data: {
            nickname : $("#nickname").val(),
            pages : 1
        },
        dataType: 'json',
        success: function (result) {
            $("#spinner").hide();
            var totalPage = result.totalPages;
            console.log(totalPage);
            if (result.transactions == "") {
                $('#pagination-demosearch').css("display", "none");
                $("#resultsearch").html("No results were found");
            } else {
                $("#resultsearch").html("");
                $('#pagination-demosearch').twbsPagination({
                    totalPages: 10,
                    visiblePages: 5,
                    onPageClick: function (event, page) {
                        $("#spinner").show();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo admin_url('mail/indexajax')?>",
                            data: {
                                nickname : $("#nickname").val(),
                                pages : page
                            },
                            dataType: 'json',
                            success: function (result) {
                                $("#spinner").hide();
                                stt = 1;
                                $.each(result.transactions, function (index, value) {
                                    result += resultSearchTransction(stt,value.title, value.author, value.content, value.createTime,value.mail_id);
                                    stt++
                                });
                                $('#logaction').html(result);
                            }
                        });
                    }
                });
            }
            stt = 1;
            $.each(result.transactions, function (index, value) {
                result += resultSearchTransction(stt,value.title, value.author, value.content, value.createTime,value.mail_id);
                stt++
            });
            $('#logaction').html(result);
        }
    });
}
function init() {
    $('#pagination-demosearch').css("display", "block");
    $("#spinner").show();
    $.ajax({
        type: "POST",
        url: "<?php echo admin_url('mail/indexajax')?>",
        data: {
            nickname : $("#nickname").val(),
            pages : 1
        },
        dataType: 'json',
        success: function (result) {
            $("#spinner").hide();
            var totalPage = result.totalPages;
            if (result.transactions == "") {
                $('#pagination-demosearch').css("display", "none");
                $("#resultsearch").html("No results were found");
            } else {
                var stt = 1;
                $("#resultsearch").html("");
                $('#pagination-demosearch').twbsPagination('destroy');
                $('#pagination-demosearch').twbsPagination({
                    totalPages: totalPage,
                    visiblePages: 5,
                    onPageClick: function (event, page) {
                        $("#spinner").show();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo admin_url('mail/indexajax')?>",
                            data: {
                                nickname : $("#nickname").val(),
                                pages : page
                            },
                            dataType: 'json',
                            success: function (result) {
                                $("#spinner").hide();
                                $.each(result.transactions, function (index, value) {
                                    result += resultSearchTransction(stt,value.title, value.author, value.content, value.createTime,value.mail_id);
                                    stt++
                                });
                                $('#logaction').html(result);
                            }
                        });
                    }
                });
            }
            $.each(result.transactions, function (index, value) {
                result += resultSearchTransction(stt,value.title, value.author, value.content, value.createTime,value.mail_id);
                stt++
            });
            $('#logaction').html(result);
        }
    })
}
</script>