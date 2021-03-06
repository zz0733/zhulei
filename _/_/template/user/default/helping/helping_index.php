<?php if(!defined('PIGCMS_PATH')) exit('deny access!');?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/> 
		<title>微助力 - <?php echo $store_session['name']; ?> | <?php echo $config['site_name'];?></title>
		<meta name="author" content="小猪CMS"/>
		<meta name="generator" content="小猪CMS微店程序"/>
		<meta name="copyright" content="pigcms.com"/>
		<link href="<?php echo TPL_URL;?>css/base.css" type="text/css" rel="stylesheet"/>
		<link href="<?php echo TPL_URL;?>css/wx_sidebar.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo TPL_URL;?>css/appmarket.css" type="text/css" rel="stylesheet"/>

		<script type="text/javascript" src="<?php echo STATIC_URL;?>js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo TPL_URL;?>js/base.js"></script>
        <script type="text/javascript" src="<?php echo STATIC_URL;?>js/layer/layer.min.js"></script>

        <script type="text/javascript" src="<?php echo STATIC_URL;?>js/date/WdatePicker.js"></script>
        <link href="<?php echo STATIC_URL;?>js/date/skin/WdatePicker.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="<?php echo STATIC_URL;?>js/plugin/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo STATIC_URL;?>css/jquery.ui.css" />
        <script type="text/javascript" src="<?php echo STATIC_URL;?>js/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo STATIC_URL;?>js/plugin/jquery-ui-timepicker-addon.js"></script>


        <script type="text/javascript" charset="utf-8" src="<?php echo STATIC_URL;?>js/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo STATIC_URL;?>js/ueditor/ueditor.all.js"></script>

		<script type="text/javascript">
			var load_url="<?php dourl('load');?>";
			var do_helping_add="<?php dourl('_do_helping_add');?>";
			var do_helping_edit="<?php dourl('_do_helping_edit');?>";
			var coupon_list_select='<?php echo $coupon_list_select;?>';
            var lottery_qrcode_url = "<?php echo option("config.site_url") ?>/source/qrcode.php?type=helping";
		</script>
		<script type="text/javascript" src="<?php echo TPL_URL;?>js/helping.js"></script>
	</head>
	<body class="font14 usercenter">
		<?php include display('public:header');?>
		<div class="wrap_1000 clearfix container">
			<?php include display('public:yx_sidebar');?>
			<div class="app">
				<div class="app-inner clearfix">
					<div class="app-init-container">
						<div class="clearfix"></div>
						<div class="nav-wrapper--app"></div>
						<div class="app__content"></div>
					</div>
				</div>
			</div>
		</div>
		<?php include display('public:footer');?>
		<div id="nprogress"><div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div></div>
	</body>
</html>
