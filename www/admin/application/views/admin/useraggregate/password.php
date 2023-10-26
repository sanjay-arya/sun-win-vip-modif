<?php $this->load->view('admin/message', $this->data); ?>
<div>
  <div class="title">
    <h4>Change Password: <span style="color: #0000FF"><?= $nn ?></span></h4>
  </div>
  <div id="list_role">
    <!-- <div class="formRow">
      <div class="row">
        <label class="col-sm-1" style="width: 154px">Login name</label>
        <div class="col-sm-2">
          <input type="text" id="username" class="form-control" placeholder="Login name game">
        </div>
      </div>
    </div> -->
    <div class="formRow">
      <input type="button" id="resetpassword" value="Update" class="button blueB">
    </div>
  </div>
  <style>
    .spinner {
      position: fixed;
      top: 50%;
      left: 50%;
      margin-left: -50px;
      /* half width of the spinner gif */
      margin-top: -50px;
      /* half height of the spinner gif */
      text-align: center;
      z-index: 1234;
      overflow: auto;
      width: 100px;
      /* width of the spinner gif */
      height: 102px;
      /*hight of the spinner gif +2px to fix IE8 issue */
    }
  </style>
  <div class="container">
    <div id="spinner" class="spinner" style="display:none;">
      <img id="img-spinner" src="<?php echo public_url('admin/images/gif-load.gif') ?>" alt="Loading" />
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#resetpassword").click(function() {
        var request = $.ajax({
          url: "<?php echo admin_url('usergame/resetpassword') ?>",
          type: "POST",
          data: {
            username: "<?= $nn ?>",
          },
          dataType: "json"
        });

        request.done(function(msg) {
          alert('Change Password thành công');
          location.href = "<?php echo admin_url("useraggregate?nn=" . $nn)  ?>";
        });
      });

    });
  </script>