<!-- head -->
<?php $this->load->view('admin/useraggregate/head', $this->data) ?>
<div class="line"></div>
<link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.css">
<link rel="stylesheet" href="<?php echo public_url() ?>/site/css/loggamethirdparty.css">
<script src="<?php echo public_url() ?>/site/bootstrap/moment.js"></script>
<script src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.6.0/moment.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<div class="wrapper return-url">
    <a class="" href="<?= admin_url('usergame/uservinplay') . '?' . $uri ?>">
        <i class="fas fa-angle-double-left"></i> Come back
    </a>
</div>
<div class="wrapper">
    <ul class="nav nav-tabs tabs-menu">
        <li class="current active"><a href="#tab-1">Thông tin user</a></li>
        <li><a href="#tab-2">Nạp</a></li>
        <li><a href="#tab-3">Rút</a></li>
        <li><a href="#tab-4">TK ngân hàng</a></li>
        <li><a href="#tab-5">Check IP</a></li>
        <li><a href="#tab-6">Balance fluctuations</a></li>
        <li><a href="#tab-7">Lock account</a></li>
        <li><a href="#tab-8">Total bet và thắng</a></li>
        <li><a href="#tab-9">Change Password</a></li>
    </ul>
    <div class="widget">
        <div class="formRow">
            <div class="container">
                <div id="tabs-container">
                    <div id="tab-1" class="tab-content col-sm-12">
                        <!--  INFORMATION  -->
                        <?php $this->load->view('admin/useraggregate/information', $this->data) ?>
                    </div>
                    <div id="tab-2" class="tab-content col-sm-12">
                        <!--  DEPOSIT  -->
                        <?php $this->load->view('admin/useraggregate/deposit', $this->data) ?>
                    </div>
                    <div id="tab-3" class="tab-content col-sm-12">
                        <!--  WITHDRAW  -->
                        <?php $this->load->view('admin/useraggregate/withdraw', $this->data) ?>
                    </div>
                    <div id="tab-4" class="tab-content col-sm-12">
                        <!--  Bank account  -->
                        <?php $this->load->view('admin/useraggregate/bankaccount', $this->data) ?>
                    </div>
                    <div id="tab-5" class="tab-content col-sm-12">
                        <!--  Lịch sử đăng nhập/ip/giftcode  -->
                        <?php $this->load->view('admin/useraggregate/history', $this->data) ?>
                    </div>
                    <div id="tab-6" class="tab-content col-sm-12">
                        <!--  Balance fluctuations  -->
                        <?php $this->load->view('admin/useraggregate/balance', $this->data) ?>
                    </div>
                    <div id="tab-7" class="tab-content col-sm-12">
                        <!--  Cài đặt/khóa  -->
                        <?php $this->load->view('admin/useraggregate/setting', $this->data) ?>
                    </div>
                    <div id="tab-8" class="tab-content col-sm-12">
                        <!--  Total bet và Total money thắng của từng games  -->
                        <?php $this->load->view('admin/useraggregate/betwin', $this->data) ?>
                    </div>
                    <div id="tab-9" class="tab-content col-sm-12">
                        <!--  Thay đổi mật khẩu của user  -->
                        <?php $this->load->view('admin/useraggregate/password', $this->data) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear mt30"></div>
<style>
    .tab-content {
        width: 100%;
        padding: 20px;
        display: none;
    }

    #tab-1 {
        display: block;
    }

    td {
        word-break: break-all;
    }

    thead {
        font-size: 12px;
    }

    .return-url {
        margin-bottom: 12px;
    }

    .nav.nav-tabs.tabs-menu {
        border-top: none;
    }

    .nav.nav-tabs.tabs-menu li a {
        background-image: none;
    }

    .return-url a {
        text-decoration: underline;
        font-size: 18px;
    }
</style>

<script>
    $(document).ready(function() {
        $(".tabs-menu a").click(function(event) {
            event.preventDefault();
            $(this).parent().addClass("current");
            $(this).parent().siblings().removeClass("current");
            $(this).removeClass("active");
            $(this).parent().siblings().removeClass("active");
            var tab = $(this).attr("href");
            $(".tab-content").not(tab).css("display", "none");
            $(tab).fadeIn();
        });
    });
</script>