<div class="titleArea">
	<div class="wrapper">
		<div class="pageTitle">
			<h5>Bank management</h5>
		</div>
        <div class="horControlB menu_action">
            <ul>
                <li><a data-toggle="modal" data-target="#my-bootstrap-modal">
                        <img src="<?php echo public_url('admin')?>/images/icons/control/16/add.png">
                        <span>Add new</span>
                    </a></li>
            </ul>
        </div>
		<div class="clear"></div>
	</div>
</div><div class="modal fade" id="my-bootstrap-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Bank management</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 id="resultSubmit" style="color: red;margin-left: 20px"></h4>
                <form class="tagForm needs-validation" action="<?php echo admin_url('bankname/save_ajax')?>" novalidate>
                    <input id="inputId" type="text" hidden>
                    <input id="inputType" type="text" hidden>
                    <div class="form-group">
                        <label for="inputBankName" class="col-form-label">Bank Name:</label>
                        <input id="inputBankName" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputBankCode" class="col-form-label">Bank Code:</label>
                        <input id="inputBankCode" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputLogo" class="col-form-label">Logo URL:</label>
                        <input id="inputLogo" type="text" class="form-control" >
                        <img id="logo_item" src='' alt=" no-image" />
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-form-label">Active:</label>
                        <input id="inputStatus" type="checkbox" checked data-toggle="toggle" data-style="ios" class="ml-3">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tag-form-submit">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
        $("#inputStatus").bootstrapToggle()
        $("#inputLogo").on('input', function (e){
            $("#logo_item").attr("src", $("#inputLogo").val())
        })
    })
    $(function() {
        $('#my-bootstrap-modal').on('hidden.bs.modal', function (e) {
            $("#resultSubmit").html("")
            $(this).find("input").val('')
            $("#inputStatus").bootstrapToggle('on')
            $("#inputType").val('')
            $("#logo_item").attr("src", "")
        })

        $('#tag-form-submit').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('bankname/save_ajax')?>",
                data: {
                    id: $("#inputId").val(),
                    bankName: $("#inputBankName").val(),
                    bankCode: $("#inputBankCode").val(),
                    logo: $("#inputLogo").val(),
                    "status": $("#inputStatus").parent().hasClass('off') ? 0 : 1,
                    "type": $("#inputType").val() || 0
                },
                dataType: 'json',
                success: function (response) {
                    $("#spinner").hide();
                    if (response.success) {
                        $("#resultSubmit").html("");
                        $('#my-bootstrap-modal').modal('hide')
                        initData()
                    } else {
                        $("#resultSubmit").html(response.errorCode + ": " + response.message);
                    }

                }, error: function () {
                    $("#spinner").hide();
                    $("#resultSubmit").html("System overload. Please call 19008698 or F5 to return to the pages");
                },timeout : 20000
            });
            return false;
        });

    });

</script>
<style>
    .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; margin-top: 0px; }
    .toggle.ios .toggle-handle { border-radius: 20px; }

    /* for input dropdown */
    #inputBankName {
        width: -webkit-fill-available;
        width: -moz-available;
    }
</style>

