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
            <div class="title">
                <h6>Reset Password</h6>
            </div>
            <form class="list_filter form" action="" method="">
                <div class="formRow">
                    <div class="row">
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-2"><label id="errorname" style="color: red;"></label></div>
                    </div>
                </div>
                <div class="formRow">
                    <div class="row">
                        <div class="col-sm-2">

                        </div>
                        <div class="col-sm-2"><label>Enter a nickname</label></div>
                        <div class="col-sm-2"><input class="form-control" id="filter_iname" placeholder="Enter your nickname" type="text"></div>
                        <div class="col-sm-1">
                            <input type="button" id="search_tran" value="Reset password" class="button blueB">
                        </div>
                    </div>

                </div>
            </form>
            <div class="formRow"></div>
            <div class="modal fade" id="bsModal3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                            <p style="color: #0000ff">You changed your password successfully</p>
                        </div>
                        <div class="modal-footer">
                            <input class="blueB logMeIn" type="button" value="Close" data-dismiss="modal"
                                   aria-hidden="true">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<style>.spinner {
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
</div>
<script>

    $("#search_tran").click(function () {
        if($("#filter_iname").val() == ""){
            alert("You have not entered a nickname");
            return false;
        }
        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('usergame/resetpwajax')?>",
            data: {
                nickname: $("#filter_iname").val()
            },

            dataType: 'json',
            success: function (result) {
                if(result == 0){
                    $("#errorname").html("");
                    $("#filter_iname").val("");
                    $("#bsModal3").modal("show");
                    $("#spinner").hide();

                }else{
                    $("#errorname").html("Nickname does not exist");
                    $("#spinner").hide();
                }
            }
        });
    });

</script>
