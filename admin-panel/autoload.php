<?php 

$page = 'dashboard';
if (!empty($_GET['page'])) {
    $page = PT_Secure($_GET['page']);
}


$page_loaded = '';
$pages = array(
    'dashboard', 
    'general-settings', 
    'site-settings', 
    'email-settings', 
    'social-login',
    's3',
    'prosys-settings',
    'manage-payments',
    'payment-requests', 
    'manage-users', 
    'manage-videos', 
    'import-from-youtube', 
    'import-from-dailymotion', 
    'manage-video-ads', 
    'create-video-ad', 
    'edit-video-ad', 
    'manage-website-ads', 
    'manage-user-ads',
    'manage-themes', 
    'change-site-desgin', 
    'create-new-sitemap', 
    'manage-pages', 
    'changelog',
    'backup',
    'create-article',
    'edit-article',
    'manage-articles',
    'manage-profile-fields',
    'add-new-profile-field',
    'edit-profile-field',
    'payment-settings',
    'verification-requests',
    'manage-announcements',
    'ban-users',
    'custom-design',
    'api-settings',
    'manage-video-reports',
    'manage-languages',
    'add-language',
    'edit-lang'
);

if (in_array($page, $pages)) {
    $page_loaded = PT_LoadAdminPage("$page/content");
} 

if (empty($page_loaded)) {
    header("Location: " . PT_Link('admincp'));
    exit();
}

if ($page == 'dashboard') {
    if ($pt->config->last_admin_collection < (time() - 1800)) {
        $update_information = PT_UpdateAdminDetails();
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>管理后台 | <?php echo $pt->config->title; ?></title>
    <link rel="icon" href="<?php echo $pt->config->theme_url ?>/img/icon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <script src="<?php echo PT_LoadAdminLink('plugins/jquery/jquery.min.js'); ?>"></script>
    <link href="<?php echo PT_LoadAdminLink('plugins/bootstrap/css/bootstrap.css'); ?>" rel="stylesheet">
    <link href="<?php echo PT_LoadAdminLink('plugins/node-waves/waves.css'); ?>" rel="stylesheet" />
    <link href="<?php echo PT_LoadAdminLink('plugins/animate-css/animate.css'); ?>" rel="stylesheet" />
    <link href="<?php echo PT_LoadAdminLink('plugins/morrisjs/morris.css'); ?>" rel="stylesheet" />
    <link href="<?php echo PT_LoadAdminLink('plugins/bootstrap-tagsinput/src/bootstrap-tagsinput.css'); ?>" rel="stylesheet" />
    <link href="<?php echo PT_LoadAdminLink('css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo PT_LoadAdminLink('plugins/sweetalert/sweetalert.css'); ?>" rel="stylesheet" />
    <link href="<?php echo PT_LoadAdminLink('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css'); ?>" rel="stylesheet">
    <link href="<?php echo PT_LoadAdminLink('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css'); ?>" rel="stylesheet">
    <link href="<?php echo PT_LoadAdminLink('css/themes/all-themes.css'); ?>" rel="stylesheet" />
    <link href="<?php echo PT_LoadAdminLink('plugins/bootstrap-select/css/bootstrap-select.css'); ?>" rel="stylesheet" />
    <link href="<?php echo PT_LoadAdminLink('plugins/sweetalert/sweetalert.css'); ?>" rel="stylesheet" />
    <link href="<?php echo PT_LoadAdminLink('plugins/m-popup/magnific-popup.css'); ?>" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo $pt->config->theme_url; ?>/js/jquery.form.min.js"></script>
    <link href="<?php echo $pt->config->theme_url; ?>/css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>请稍后...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?php echo PT_Link(''); ?>"><?php echo $pt->config->title ?></a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?php echo $user->avatar; ?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name"><a href="<?php echo $user->url; ?>" target="_blank"><?php echo $user->name; ?></a></div>
                    <div class="email"><?php echo $user->email; ?></div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li <?php echo ($page == 'dashboard') ? 'class="active"' : ''; ?>>
                        <a href="<?php echo PT_LoadAdminLinkSettings(''); ?>">
                            <i class="material-icons">dashboard</i>
                            <span>仪表盘</span>
                        </a>
                    </li>
                    <li <?php echo ($page == 'general-settings' || $page == 'site-settings' || $page == 'payment-settings' || $page == 'email-settings' || $page == 'social-login' || $page == 's3') ? 'class="active"' : ''; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">settings</i>
                            <span>设置</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ($page == 'general-settings') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('general-settings'); ?>">常规设置</a>
                            </li>
                            <li <?php echo ($page == 'site-settings') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('site-settings'); ?>">网站设置</a>
                            </li>
                            <li <?php echo ($page == 'email-settings') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('email-settings'); ?>">电子邮件设置</a>
                            </li>
                            <li <?php echo ($page == 'social-login') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('social-login'); ?>">社交登陆设置</a>
                            </li>
                            <li <?php echo ($page == 's3') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('s3'); ?>">Amazon S3 & FTP设置</a>
                            </li>

                            <li <?php echo ($page == 'payment-settings') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('payment-settings'); ?>">支付设置</a>
                            </li>   
                        </ul>
                    </li>
                    <li <?php echo ($page == 'manage-languages' || $page == 'add-language' || $page == 'edit-lang') ? 'class="active"' : ''; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">language</i>
                            <span>语言设置</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ($page == 'add-language') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('add-language'); ?>">添加语言</a>
                            </li>
                            <li <?php echo ($page == 'manage-languages') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('manage-languages'); ?>">管理语言</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo ($page == 'manage-users'  || $page == 'add-new-profile-field' || $page == 'edit-profile-field' || $page == 'verification-requests') ? 'class="active"' : ''; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">account_circle</i>
                            <span>用户</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ($page == 'manage-users') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('manage-users'); ?>">管理用户</a>
                            </li>
                            <li <?php echo ($page == 'manage-profile-fields') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('manage-profile-fields'); ?>">管理自定义资料字段</a>
                            </li>
                            <li <?php echo ($page == 'verification-requests') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('verification-requests'); ?>">管理认证请求</a>
                            </li>
                        </ul>
                        
                    </li>
                    <li <?php echo ($page == 'manage-videos' || $page == 'import-from-youtube' || $page == 'import-from-dailymotion') ? 'class="active"' : ''; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">video_library</i>
                            <span>视频</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ($page == 'manage-videos') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('manage-videos'); ?>">管理视频</a>
                            </li>
                            <li <?php echo ($page == 'import-from-youtube' || $page == 'import-from-dailymotion') ? 'class="active"' : ''; ?>>
                                <a href="javascript:void(0);" class="menu-toggle">导入视频</a>
                                <ul class="ml-menu">
                                    <li <?php echo ($page == 'import-from-youtube') ? 'class="active"' : ''; ?>>
                                        <a href="<?php echo PT_LoadAdminLinkSettings('import-from-youtube'); ?>">导入YouTube</a>
                                    </li>
                                    <li <?php echo ($page == 'import-from-dailymotion') ? 'class="active"' : ''; ?>>
                                        <a href="<?php echo PT_LoadAdminLinkSettings('import-from-dailymotion'); ?>">导入Dailymotion</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo ($page == 'manage-articles' || $page == 'create-article' || $page == 'edit-article') ? 'class="active"' : ''; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">library_books</i>
                            <span>文章</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ($page == 'create-article') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('create-article'); ?>">发布文章</a>
                            </li>
                            <li <?php echo ($page == 'manage-articles') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('manage-articles'); ?>">管理文章</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo ($page == 'manage-video-ads' || $page == 'create-video-ad' || $page == 'edit-video-ad' || $page == 'payment-requests' || $page == 'manage-website-ads' || $page == 'manage-user-ads') ? 'class="active"' : ''; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">attach_money</i>
                            <span>广告</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ($page == 'manage-video-ads') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('manage-video-ads'); ?>">管理视频广告</a>
                            </li>
                            <li <?php echo ($page == 'manage-website-ads') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('manage-website-ads'); ?>">管理网站广告</a>
                            </li>
                            <li <?php echo ($page == 'manage-user-ads') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('manage-user-ads'); ?>">管理用户广告</a>
                            </li>
                            <li <?php echo ($page == 'payment-requests') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('payment-requests'); ?>">支付请求</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo ($page == 'prosys-settings' || $page == 'manage-payments') ? 'class="active"' : ''; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">star</i>
                            <span>专业版系统</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ($page == 'prosys-settings') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('prosys-settings'); ?>">专业版系统设置</a>
                            </li>
                            <li <?php echo ($page == 'manage-payments') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('manage-payments'); ?>">近期付款</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li <?php echo ($page == 'manage-themes' || $page == 'change-site-desgin' || $page == 'custom-design') ? 'class="active"' : ''; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">color_lens</i>
                            <span>设计</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ($page == 'manage-themes') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('manage-themes'); ?>">主题</a>
                            </li>
                            <li <?php echo ($page == 'change-site-desgin') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('change-site-desgin'); ?>">更改网站设计</a>
                            </li>
                            <li <?php echo ($page == 'custom-design') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('custom-design'); ?>">自定义设计</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo ($page == 'manage-announcements' || $page == 'ban-users') ? 'class="active"' : ''; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">build</i>
                            <span>工具</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ($page == 'manage-announcements') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('manage-announcements'); ?>">管理公告</a>
                            </li>
                            <li <?php echo ($page == 'ban-users') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('ban-users'); ?>">禁止用户</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo ($page == 'manage-video-reports') ? 'class="active"' : ''; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">flag</i>
                            <span>举报</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ($page == 'manage-video-reports') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('manage-video-reports'); ?>">
                                    管理视频举报
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo ($page == 'manage-pages') ? 'class="active"' : ''; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">description</i>
                            <span>页面</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ($page == 'manage-pages') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('manage-pages'); ?>">管理页面</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo ($page == 'create-new-sitemap') ? 'class="active"' : ''; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">power_input</i>
                            <span>地图</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ($page == 'create-new-sitemap') ? 'class="active"' : ''; ?>>
                                <a href="<?php echo PT_LoadAdminLinkSettings('create-new-sitemap'); ?>">创建地图</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo ($page == 'api-settings') ? 'class="active"' : ''; ?>>
                        <a href="<?php echo PT_LoadAdminLinkSettings('api-settings'); ?>">
                            <i class="material-icons">compare_arrows</i>
                            <span>手机 & API 设置</span>
                        </a>
                    </li>
                    <li <?php echo ($page == 'backup') ? 'class="active"' : ''; ?>>
                        <a href="<?php echo PT_LoadAdminLinkSettings('backup'); ?>">
                            <i class="material-icons">backup</i>
                            <span>备份</span>
                        </a>
                    </li>
                    <li <?php echo ($page == 'changelog') ? 'class="active"' : ''; ?>>
                        <a href="<?php echo PT_LoadAdminLinkSettings('changelog'); ?>">
                            <i class="material-icons">update</i>
                            <span>更新日志</span>
                        </a>
                    </li>
                     <li >
                        <a href="https://www.pineal.cn/" target="_blank">
                            <i class="material-icons">more_vert</i>
                            <span>帮助文档</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    Copyright &copy; <?php  echo date('Y') ?> <a href="javascript:void(0);"><?php echo $pt->config->name; ?></a>.
                </div>
                <div class="version">
                    <b>版本: </b> <?php echo $pt->config->script_version ?>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        <?php echo $page_loaded; ?>
    </section>
    
    <!-- Bootstrap Core Js -->
    <script src="<?php echo PT_LoadAdminLink('plugins/bootstrap/js/bootstrap.js'); ?>"></script>

    <script src="<?php echo PT_LoadAdminLink('plugins/jquery-datatable/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo PT_LoadAdminLink('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'); ?>"></script>
    <script src="<?php echo PT_LoadAdminLink('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?php echo PT_LoadAdminLink('plugins/jquery-datatable/extensions/export/buttons.flash.min.js'); ?>"></script>
    <script src="<?php echo PT_LoadAdminLink('plugins/jquery-datatable/extensions/export/jszip.min.js'); ?>"></script>
    <script src="<?php echo PT_LoadAdminLink('plugins/jquery-datatable/extensions/export/pdfmake.min.js'); ?>"></script>
    <script src="<?php echo PT_LoadAdminLink('plugins/jquery-datatable/extensions/export/vfs_fonts.js'); ?>"></script>
    <script src="<?php echo PT_LoadAdminLink('plugins/jquery-datatable/extensions/export/buttons.html5.min.js'); ?>"></script>
    <script src="<?php echo PT_LoadAdminLink('plugins/jquery-datatable/extensions/export/buttons.print.min.js'); ?>"></script>
    <script src="<?php echo PT_LoadAdminLink('js/pages/tables/jquery-datatable.js'); ?>"></script>

    <!-- Select Plugin Js -->
    <script src="<?php echo PT_LoadAdminLink('plugins/bootstrap-select/js/bootstrap-select.js'); ?>"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo PT_LoadAdminLink('plugins/jquery-slimscroll/jquery.slimscroll.js'); ?>"></script>

    <!-- ColorPicker Plugin Js -->
    <script src="<?php echo PT_LoadAdminLink('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js'); ?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo PT_LoadAdminLink('plugins/node-waves/waves.js'); ?>"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="<?php echo PT_LoadAdminLink('plugins/jquery-countto/jquery.countTo.js'); ?>"></script>

    <!-- Morris Plugin Js -->
    <script src="<?php echo PT_LoadAdminLink('plugins/raphael/raphael.min.js'); ?>"></script>
    <script src="<?php echo PT_LoadAdminLink('plugins/morrisjs/morris.js'); ?>"></script>
    <!-- Sparkline Chart Plugin Js -->
    <script src="<?php echo PT_LoadAdminLink('plugins/jquery-sparkline/jquery.sparkline.js'); ?>"></script>
    <!-- TinyMce Text Editor  -->
    <script src="<?php echo PT_LoadAdminLink('plugins/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
    <!-- Bootstrap tagsinput Plugin Js  -->
    <script src="<?php echo PT_LoadAdminLink('plugins/bootstrap-tagsinput/src/bootstrap-tagsinput.js'); ?>"></script>

    <!-- Jquery Alert Plugin Js-->
    <script src="<?php echo PT_LoadAdminLink('plugins/sweetalert/sweetalert.min.js'); ?>"></script>

     <!-- Jquery Magnific Pop-up Plugin Js-->
    <script src="<?php echo PT_LoadAdminLink('plugins/m-popup/jquery.magnific-popup.min.js'); ?>"></script>


    <script src="<?php echo PT_LoadAdminLink('plugins/codemirror-5.30.0/lib/codemirror.js'); ?>"></script>
    <script src="<?php echo PT_LoadAdminLink('plugins/codemirror-5.30.0/mode/css/css.js'); ?>"></script>
    <script src="<?php echo PT_LoadAdminLink('plugins/codemirror-5.30.0/mode/javascript/javascript.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo PT_LoadAdminLink('plugins/codemirror-5.30.0/lib/codemirror.css'); ?>">
    <!-- Custom Js -->
    <script src="<?php echo PT_LoadAdminLink('js/admin.js'); ?>"></script>
    <script src="<?php echo PT_LoadAdminLink('js/pages/index.js'); ?>"></script>
</body>

</html>
<style> 
.sidebar .user-info {
    background: #0095d8;
}
[type="checkbox"]:checked + label:before {
    border-right: 2px solid #333;
}
</style>
<script>
<?php echo PT_LoadAdminPage('js/main'); ?>
</script>
