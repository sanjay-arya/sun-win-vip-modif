<?php $this->load->view('admin/event/head', $this->data) ?>
<div class="line"></div>
<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget">
        <div class="title">
            <h6>List of VQMM rotations </h6>
            <div  class="num f12">Total: <b id ="num"></b></div>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead class="filter">
            <tr>
                <td colspan="13">
                    <form class="list_filter form" action="<?php echo admin_url('event') ?>" method="get">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                            <tr>
                                <td style="..." class="label"><label for="filter_id"></label></td>
                                <td style="..." class="label"><label for="filter_id"></label></td>
                                <td style="..." class="label"><label for="filter_id">Nick name</label></td>
                                <td style="..." class="item"><input type="text" style="width:155px;" id="filter_iname" value="<?php echo $this->input->get('name') ?>" name="name"></td>
                                <td style="">
                                    <input type="submit" id="search_tran" value="Search" class="button blueB"></td>
                                <td>
                                    <input type="reset" onclick="window.location.href = '<?php echo admin_url('event')?>'; " value="Reset"  class="basic">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </td>
            </tr>
            </thead>
            <thead>
            <tr style="height: 20px;">
                <td style="width:80px;">No</td>
                <td>Login date</td>
                <td>Nick name</td>
                <td>Number of spins per day</td>
                <td>Number of free spins</td>
                <td>Number of turns drawn during the day</td>
            </tr>
            </thead>
            <tbody id="logdongbang">
            <?php $i = 1; ?>
            <?php foreach($list as $row): ?>
                <tr>
                    <td class="textC"><?php echo $i; ?></td>
                    <td><?php echo $row->login_date ?></td>
                    <td><?php echo $row->nick_name ?></td>
                    <td><?php echo $row->rotate_daily ?></td>
                    <td><?php echo $row->rotate_free ?></td>
                    <td><?php echo $row->rotate_in_day ?></td>

                </tr>
                <?php $i++; ?>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<div class="pagination">
    <div id="pagination"></div>
</div>
<script>
    $("#toDate").datepicker({dateFormat: 'yy-mm-dd'});
    $("#fromDate").datepicker({dateFormat: 'yy-mm-dd'});
    $("#search_tran").click(function(){
        var from=$("#fromDate").datepicker('getDate');
        var to =$("#toDate").datepicker('getDate');
        if(to>from)
        {
            alert('The end date must be greater than the start date')
            return false;
        }
    });
    $("#search_tran").click(function(){
        Pagging();
    });
    $(document).ready(function () {

        function commaSeparateNumber(val){
            while (/(\d+)(\d{3})/.test(val.toString())){
                val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
            }
            return val;
        }
        Pagging();

    });
    function Pagging(){
        var items = $("#checkAll #logdongbang tr");
        var numItems = items.length;
        $("#num").html(numItems) ;
        var perPage = 50;
        // only show the first 2 (or "first per_page") items initially
        items.slice(perPage).hide();
        // now setup pagination
        $("#pagination").pagination({
            items: numItems,
            itemsOnPage: perPage,
            cssStyle: "light-theme",
            onPageClick: function(pageNumber) { // this is where the magic happens
                // someone changed page, lets hide/show trs appropriately
                var showFrom = perPage * (pageNumber - 1);
                var showTo = showFrom + perPage;

                items.hide() // first hide everything, then show for the new page
                    .slice(showFrom, showTo).show();
            }
        });
    }
</script>