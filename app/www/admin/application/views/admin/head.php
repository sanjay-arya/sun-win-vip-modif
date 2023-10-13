<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>GamePortal</title>

<meta name="robots" content="noindex, nofollow" /><link rel="shortcut icon" href="<?php echo public_url('admin')?>/images/icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="<?php echo public_url('admin/crown') ?>/css/accordion-menu.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo public_url('admin/crown') ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo public_url('admin')?>/css/css.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo public_url('admin')?>/css/bs_leftnavi.css" media="screen" />
<link href="<?php echo public_url() ?>/bootstrap/css/bootstrap.css" rel="stylesheet">
<link type="text/javascript" href="<?php echo public_url() ?>/bootstrap/js/bootstrap.js">
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<link href="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript">
	var admin_url 	= '';
	var base_url 	= '';
	var public_url 	= '';
</script>

<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/spinner/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/forms/uniform.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/tables/datatable.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/tables/tablesort.min.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/tables/resizable.min.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.sourcerer.js"></script>
<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/scrollTo/jquery.scrollTo.js"></script>
<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/number/jquery.number.min.js"></script>
<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/formatCurrency/jquery.formatCurrency-1.4.0.min.js"></script>
<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/zclip/jquery.zclip.js"></script>
<script type="text/javascript" src="<?php echo public_url()?>/js/jquery.simplePagination.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo public_url()?>/admin/css/simplePagination.css" media="screen" />
<script type="text/javascript" src="<?php echo public_url()?>/js/bs_leftnavi.js"></script>
<script type="text/javascript" src="<?php echo public_url()?>/js/common.js"></script>
<link type="text/javascript" href="<?php echo public_url() ?>/js/popper.min.js">
<script type="text/javascript" src="<?php echo public_url() ?>/site/bootstrap/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo public_url() ?>/js/jquery.twbsPagination.js"></script>
<script type="text/javascript" src="<?php echo public_url() ?>/site/bootstrap/moment.js"></script>
<script type="text/javascript" src="<?php echo public_url() ?>/site/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo public_url() ?>/js/bootbox.min.js"></script>
<link rel="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap-toggle.min.css">
<script type="text/javascript" src="<?php echo public_url() ?>/site/bootstrap/bootstrap-toggle.min.js"></script>
<link type="stylesheet" href="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.css">
<script type="text/javascript" src="<?php echo public_url() ?>/js/jquery/number/jquery.number.js"></script>
<script src="<?php echo public_url() ?>/site/bootstrap/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo public_url()?>/js/jquery.table2excel.js"></script>

<script>
    var timeOutApi = 600000;
    $(document).ready(function() {
        $(".tabs a").click(function(event) {
            event.preventDefault();
            $(this).parent().addClass("activeTab");
            $(this).parent().siblings().removeClass("activeTab");
            var tab = $(this).attr("href");
            $(".tab-content").not(tab).css("display", "block");
            $(tab).fadeIn();
        });
    });

    jQuery(function ($) {
        $("ul a").click(function(e) {
            var link = $(this);
            var item = link.parent("li");
            if (item.hasClass("active")) {
                item.removeClass("active").children("a").removeClass("active");
            } else {
                item.addClass("active").children("a").addClass("active");
            }
            if (item.children("ul").length > 0) {
                var href = link.attr("href");
                link.attr("href", "#");
                setTimeout(function () {
                    link.attr("href", href);
                }, 100);
                e.preventDefault();
            }
        })
            .each(function() {
                var link = $(this);
                if (link.get(0).href === location.origin + location.pathname) {
                    link.addClass("active").parents("li").addClass("active");
                    $(".active .sidebar-submenu").css({"display": "block"});
                    return false;
                }
            });
    });
</script>
