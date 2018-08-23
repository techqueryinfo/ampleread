<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php if(trim($__env->yieldContent('template_title'))): ?><?php echo $__env->yieldContent('template_title'); ?> | <?php endif; ?> <?php echo e(config('app.name', Lang::get('titles.app'))); ?></title>
        <meta name="description" content="">
        <meta name="author" content="Vinod Kumar">
        <link rel="shortcut icon" href="/favicon.ico">
        
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <?php echo $__env->yieldContent('template_linked_fonts'); ?>
        
        <link rel="icon" type="image/gif" href="images/LogoOrange.png" />
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/fontawesome/css/fontawesome-all.css">
        <link rel="stylesheet" href="/css/owl.carousel.css">
        <link rel="stylesheet" href="/css/owl.theme.default.css">
        <link rel="stylesheet" href="/css/popup.css">
        <link rel="stylesheet" href="/css/select.css">
        <link rel="stylesheet" href="/css/ampleread.css">
        <link rel="stylesheet" href="/css/freecategory.css">
        <link rel="stylesheet" href="/css/createbookinfo.css">
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <?php echo $__env->yieldContent('free-book-css'); ?>
        <?php echo $__env->yieldContent('template_linked_css'); ?>
        <style type="text/css">
            <?php echo $__env->yieldContent('template_fastload_css'); ?>
            <?php if(Auth::User() && (Auth::User()->profile) && (Auth::User()->profile->avatar_status == 0)): ?>
                .user-avatar-nav {
                    background: url(<?php echo e(Gravatar::get(Auth::user()->email)); ?>) 50% 50% no-repeat;
                    background-size: auto 100%;
                }
            <?php endif; ?>
        </style>
        
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>;
        </script>
        <?php echo $__env->yieldContent('head'); ?>
        <?php echo $__env->yieldContent('angularjs'); ?>
    </head>
    <body class="ample-trim" ng-app="app" ng-controller="TabController">
        <div id="app">
            <?php echo $__env->make('partials.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="container">
                <?php echo $__env->make('partials.form-status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <?php echo $__env->yieldContent('content'); ?>
            <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        
        <script type="text/javascript" src="/js/owl.carousel.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/popup.js"></script>
        <script type="text/javascript" src="/js/select.js"></script>
        <script type="text/javascript" src="/js/main.js"></script>
        <script type="text/javascript" src="/js/ampleread.js"></script>
        <?php if(config('settings.googleMapsAPIStatus')): ?>
            <!-- <?php echo HTML::script('//maps.googleapis.com/maps/api/js?key='.env("GOOGLEMAPS_API_KEY").'&libraries=places&dummy=.js', array('type' => 'text/javascript')); ?> -->
        <?php endif; ?>
        <?php echo $__env->yieldContent('footer_scripts'); ?>
    </body>
</html>