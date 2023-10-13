<?php if ($role == false): ?>
    <section class="content-header">
        <h1>
            You are not authorized yet
        </h1>
    </section>
<?php else: ?>
    <section class="content-header">
        <h1>
            Add giftcode
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form class="box">
                    <div class="box-body">
                        <div class="form-group successful">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <label class="control-label col-sm-2" id="errorgift" style="color: red"></label>
                            </div>
                        </div>
                        <div id="hideForType0" class="form-group">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-1 control-label" for="inputGiftCode">Code: (*)</label>
                                <input class="col-sm-3 form-control" type="text" id="inputGiftCode">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-1 control-label" for="inputType">Type:</label>
                                <div class="col-sm-3" style="    padding-left: 0;">
                                    <select class="form-control" id="inputType" name="Type">
                                        <option value="0" selected>Type 0: Used for that same user, only used once</option>
                                        <option value="1">Type 1: Used for all users, each user can use it once</option>
<!--                                        <option value="2">Type 2: User nào cũng có thể dùng, duy nhất 1 lần</option>-->
<!--                                        <option value="3">Type 3: Một user chỉ được sử dụng 1 Giftcode trong event, gift-->
<!--                                            code dùng tối đa 1 lần-->
<!--                                        </option>-->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-1 control-label" for="inputAmount">Value: (*)</label>
                                <div class="col-sm-3 input-group">
                                    <div  style="display: flex; flex-wrap: nowrap;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="height: 34px;">Win</span>
                                        </div>
                                        <input type="number" class="form-control text-right" id="inputAmount"
                                               aria-label="Tính x1000 Win">
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="height: 34px;">x1000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="showForType0" class="form-group">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-1 control-label" for="inputNickName">Nick Name: (*)</label>
                                <input class="col-sm-3 form-control" type="text" id="inputNickName">
                            </div>
                        </div>
                        <div id="showForType3" class="form-group">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-1 control-label" for="inputEvent">Event: (*)</label>
                                <input class="col-sm-3 form-control" type="text" id="inputEvent">
                            </div>
                        </div>
                        <div id="showForType1" class="form-group">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-1 control-label" for="inputNumberUsed">Number of uses: (*)</label>
                                <input class="col-sm-3 form-control" type="number" id="inputNumberUsed">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-1 control-label" for="datetimepicker1">Start using:</label>
                                <div class="col-sm-3 input-group" id="datetimepicker1">
                                    <input class="form-control" type="text" id="fromTime" name="fromTime"
                                            value="<?php echo $this->input->post('fromTime') ?>"> <span
                                            class="input-group-addon ">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-1 control-label" for="datetimepicker2">Expiry:</label>
                                <div class="col-sm-3 input-group" id="datetimepicker2">
                                    <input class="form-control" type="text" id="endTime" name="endTime"
                                            value="<?php echo $this->input->post('endTime') ?>"> <span
                                            class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <input type="submit" value="Add giftcode" name="submit"
                                                             class="btn btn-primary" id="search_tran">
                                    <input type="reset" value="Reset" name="submit" style="min-width: 120px"
                                                             class="btn btn-primary ml-3" id="reset"
                                                             onclick="window.location.href =
                                                                     '<?php echo admin_url('giftcodes/addgiftcode') ?>';
                                                                     ">
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
<?php endif; ?>
<div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading"/>
</div>
<style>
</style>
<script>
    $(document).ready(function (){
        showOrHideInput()
        $("#inputType").change(function (){
            showOrHideInput()
        })
        $("#reset").on('click', function (e){
            reset()
        })

        let today = moment(new Date()).hours(23).minutes(59).seconds(59).milliseconds(59).subtract(1, 'day')
        let endDate = moment(new Date()).hours(23).minutes(59).seconds(59).milliseconds(59).add(1, 'month')

        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            defaultDate: today,
            useCurrent : false,
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            defaultDate: endDate,
            useCurrent : false,
        });
        $('#datetimepicker1').data("DateTimePicker").minDate(today);
        $('#datetimepicker2').data("DateTimePicker").minDate(today);
    })

    function reset() {
        $(this).find("input").val('')
    }
    function showOrHideInput() {
        let type = $("#inputType").val()
        switch (type) {
            case "0":
                $("#hideForType0").hide()
                $("#showForType0").show()
                $("#showForType1").hide()
                $("#showForType3").hide()
                break
            case "1":
                $("#hideForType0").show()
                $("#showForType0").hide()
                $("#showForType1").show()
                $("#showForType3").hide()
                break
            case "3":
                $("#hideForType0").show()
                $("#showForType3").show()
                $("#showForType1").hide()
                $("#showForType0").hide()
                break
            default:
                $("#hideForType0").hide()
                $("#showForType3").hide()
                $("#showForType1").hide()
                $("#showForType0").hide()
        }
    }

    $("#search_tran").click(function (e) {
        e.preventDefault()
        let giftCode = $("#inputGiftCode").val()
        let type = $("#inputType").val()
        let mount = $("#inputAmount").val()
        let nick_name = $("#inputNickName").val()
        let numberUsed = $("#inputNumberUsed").val()
        let inputEvent = $("#inputEvent").val()
        let startTime = $("#fromTime").val();
        let endTime = $("#endTime").val();        if (startTime > endTime) {
            $("#errorgift").html("The end date must be greater than the start date")
            return false;
        }

        if (!mount) {
            $("#errorgift").html("The giftcode value cannot be left blank")
            return false;
        }

        $("#spinner").show();
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('giftcodes/addgiftcodecskhajax') ?>",
            data: {
                inputGiftCode: $("#inputGiftCode").val(),
                inputType: $("#inputType").val(),
                inputAmount: $("#inputAmount").val() + "000",
                inputNickName: $("#inputNickName").val(),
                inputNumberUsed: $("#inputNumberUsed").val(),
                inputEvent: $("#inputEvent").val(),
                fromTime: getTimestamp($("#fromTime").val()),
                endTime: getTimestamp($("#endTime").val())
            },
            dataType: 'json',
            success: function (response) {
                console.log("response", response)
                $("#spinner").hide();
                if(response.success) {
                    reset()
                    bootbox.alert({
                        message: `Added giftcode successfully`,
                        backdrop: true,
                        centerVertical: true
                    })
                    window.location.href = '<?php echo admin_url('giftcodes/addgiftcode') ?>'
                } else {
                    $("#errorgift").html(response.message)
                }

            }, error: function () {
                $("#spinner").hide();
                $("#errorgift").html("System overload. Please try again!");
            }, timeout: 60000
        })
    });

    function getTimestamp(str){
        if($("#toDate").val()!=""){
            var match = str.match(/^(\d+)-(\d+)-(\d+) (\d+)\:(\d+)\:(\d+)$/)
            var date = new Date(match[1], match[2] - 1, match[3], match[4], match[5], match[6])
            return  date.getTime();
        }
        else{
            return   "";
        }
    }
</script>
