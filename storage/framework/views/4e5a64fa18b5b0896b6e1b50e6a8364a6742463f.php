<div class="ample-header">
    <a href="<?php echo e(url('/')); ?>">
        <div class="ample-logo"></div>
    </a>
    <div class="ample-search">
        <div class="search-icon">
            <i class="fas fa-search"></i>
        </div>
        <input type="text" placeholder="Search by Title , Author , ISBN">
    </div>
    
    <?php if(Auth::guest()): ?>
    <div class="ample-login">
        <button class="btn-signup" data-toggle="modal" data-target="#myModal" id="authSignUp"><?php echo trans('titles.register'); ?></button>
        <label class="btn-signin" data-toggle="modal" data-target="#myModal" id="authSignIn" ><?php echo trans('titles.login'); ?></label>
    </div>
    <?php else: ?>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="padding-top: 10px !important">
                <img src="/images/combined-shape.png" alt="<?php echo e(Auth::user()->name); ?>" class="user-avatar-nav" style="height: 16px; width: 16px">
                Tools<span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <?php if((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1): ?>
                    <img src="/uploads/avatar/admin.png" alt="<?php echo e(Auth::user()->name); ?>" class="user-avatar-nav">
                <?php else: ?>
                    <img src="/uploads/user.png" alt="<?php echo e(Auth::user()->name); ?>" class="user-avatar-nav">
                <?php endif; ?>
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li <?php echo e(Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'class=active' : null); ?>>
                    <?php echo HTML::link(url('/profile/'.Auth::user()->name), trans('titles.profile')); ?>

                </li>
                <?php if (Auth::check() && Auth::user()->hasRole('admin')): ?>
                    <li <?php echo e(Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'class=active' : null); ?>><?php echo HTML::link(url('/users'), Lang::get('titles.adminUserList')); ?></li>
                    <li <?php echo e(Request::is('admin/categories') ? 'class=active' : null); ?>><?php echo HTML::link(url('/admin/categories'), Lang::get('titles.adminCategoryList')); ?></li>
                    <li <?php echo e(Request::is('admin/plans') ? 'class=active' : null); ?>><?php echo HTML::link(url('/admin/plans'), Lang::get('titles.adminPlanList')); ?></li>
                    <li <?php echo e(Request::is('admin/settings') ? 'class=active' : null); ?>><?php echo HTML::link(url('/admin/settings'), 'Admin Settings'); ?></li>
                    <li <?php echo e(Request::is('users/create') ? 'class=active' : null); ?>><?php echo HTML::link(url('/users/create'), Lang::get('titles.adminNewUser')); ?></li>
                    <li <?php echo e(Request::is('themes','themes/create') ? 'class=active' : null); ?>><?php echo HTML::link(url('/themes'), Lang::get('titles.adminThemesList')); ?></li>
                    <li <?php echo e(Request::is('logs') ? 'class=active' : null); ?>><?php echo HTML::link(url('/logs'), Lang::get('titles.adminLogs')); ?></li>
                    <li <?php echo e(Request::is('activity') ? 'class=active' : null); ?>><?php echo HTML::link(url('/activity'), Lang::get('titles.adminActivity')); ?></li>
                    <li <?php echo e(Request::is('phpinfo') ? 'class=active' : null); ?>><?php echo HTML::link(url('/phpinfo'), Lang::get('titles.adminPHP')); ?></li>
                    <li <?php echo e(Request::is('routes') ? 'class=active' : null); ?>><?php echo HTML::link(url('/routes'), Lang::get('titles.adminRoutes')); ?></li>
                    <li <?php echo e(Request::is('active-users') ? 'class=active' : null); ?>><?php echo HTML::link(url('/active-users'), Lang::get('titles.activeUsers')); ?></li>
                <?php endif; ?>
                <li>
                    <a href="<?php echo e(route('logout')); ?>"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <?php echo trans('titles.logout'); ?>

                    </a>

                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo e(csrf_field()); ?>

                    </form>
                </li>
            </ul>
        </li>
    </ul>
    <?php endif; ?>
    <div class="menu-bar">
        <i class="fas fa-bars fa-2x"></i>
    </div>
</div>
<div class="ample-menu">
<ul>
    <li><a href="#">Browse Category</a><i class="fa fa-angle-down"></i></li>
    <li><a href="#">Fiction</a></li>
    <li><a href="#">Non Fiction</a></li>
    <li><a href="#">Most Popular Books</a></li>
    <li><a href="#">New Release</a> </li>
    <li <?php echo e(Request::is('book') ? 'class=active' : null); ?>><?php echo HTML::link(url('/book/create/'), 'Create an e-Book'); ?></li>
    <li><a href="#">Publish an e-book</a></li>
</ul>
</div>
<div class="ample-sub-menu">
    <div class="ample-sub-menu-left">
        <div class="ample-sub-menu-row">
            <div class="heading">Subjects</div>
            <ul>
                <li <?php if(isset($category_name) && $category_name == 'all-books'): ?> class="active" <?php endif; ?>><a style="color:black;" href="/books/category/all-books">All Books</a></li>
                <?php $__currentLoopData = Session::get('categories')->slice(0,8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!blank($optionValue->is_delete) && $optionValue->is_delete==0): ?>
                    <li <?php if(isset($category_name) && $category_name == $optionValue->category_slug): ?> class="active" <?php endif; ?>><a style="color:black;" href="/books/category/<?php echo e($optionValue->category_slug); ?>"><?php echo e($optionValue->name); ?></a></li>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <div class="ample-sub-menu-row">
           <ul>
                <?php $__currentLoopData = Session::get('categories')->slice(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!blank($optionValue->is_delete) && $optionValue->is_delete==0): ?>
                    <li <?php if(isset($category_name) && $category_name == $optionValue->category_slug): ?> class="active" <?php endif; ?>><a style="color:black;" href="/books/category/<?php echo e($optionValue->category_slug); ?>"><?php echo e($optionValue->name); ?></a></li>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <div class="ample-sub-menu-right">
        <div class="ample-book-section">
            <img src="/images/image1.jpg"/>
        </div>
        <div class="ample-text-section">
            <div class="heading">Coming soon</div>
            <div class="content">Pre-order tommorow's
                bestsellers today</div>
            <button>Learn More</button>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="ample-login-signup">
                    <div class="ample-signup-login-text">
                        <div class="ample-login" id="ampleLogin" onclick="Setactive(this)">Sign in</div>
                        <div class="ample-login-active" id="ampleSignin" onclick="Setactive(this)">Sign up</div>
                    </div>
                    <div class="ample-login-section">
                        <div id="success-msg" class="hide">
                            <div class="alert alert-info alert-dismissible fade in" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                              <strong>Success!</strong> Check your mail for login confirmation!!
                            </div>
                        </div>
                             <form id="formRegister" class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/register')); ?>">

                            <?php echo e(csrf_field()); ?>  
                            <div class="form-group">
                                <div class="heading">Name</div>
                                <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'id' => 'name']); ?>

                                <small class="help-block"></small>
                            </div>
                            <div class="form-group">
                                <div class="heading">Email</div>
                                <?php echo Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'E-Mail Address']); ?>

                                <small class="help-block"></small>
                            </div>
                            <div class="form-group">
                                <div class="heading">Country</div>

                            </div>
                            <select name="country" class="form-control js-example-basic-single" id="country" >
                                <option value="" selected="">Please select country</option>
                                <?php if(isset($countries)): ?>
                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($optionValue->code); ?>"><img src="/flags/<?php echo e($optionValue->code); ?>.png'"/> <?php echo e($optionValue->countryname); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <div class="form-group">
                                <div class="heading">Password</div>
                                <?php echo Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password']); ?>

                                <small class="help-block"><strong></small>
                            </div>
                            <div class="form-group">
                                <div class="heading">Confirm Password</div>
                                <?php echo Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirm', 'placeholder' => 'Confirm Password']); ?>

                                <small class="help-block"><strong></strong></small>
                            </div>
                            <?php if(config('settings.reCaptchStatus')): ?>
                                <div class="form-group">
                                    <div class="col-sm-6 col-sm-offset-4">
                                        <div class="g-recaptcha" data-sitekey="<?php echo e(env('RE_CAP_SITE')); ?>"></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <button type="submit" id="submitForm" class="submit-button">SIGN UP</button>
                            </div>
                            <div class="form-group">
                                <div class="label-signup">or sign in with</div>
                            </div>
                            <div class="form-group">
                                <?php echo HTML::icon_link(route('social.redirect',['provider' => 'facebook']), 'fab fa-facebook-f', '  Facebook', array('class' => 'social')); ?>


                                <?php echo HTML::icon_link(route('social.redirect',['provider' => 'google']), 'fab fa-google', '  Google', array('class' => 'social')); ?>

                            </div>
                        <?php echo Form::close(); ?>

                    </div>
                    <div class="ample-register-section">
                        <?php if(Session::has('message')): ?>
                            <div class="alert alert-warning"><?php echo e(Session::get('message')); ?></div>
                        <?php endif; ?>
                        <form id="formSignIn" class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login')); ?>">
                        <?php echo e(csrf_field()); ?>

                            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                <div class="heading">Email</div>
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                <div class="heading">Password</div>
                                <div class="heading-right" id="openForgot" onclick="Showforgot()"><a href="#">Forgot password</a></div>
                                <input id="password" type="password" class="form-control" name="password" required>
                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="submitLoginForm" class="submit-button">SIGN IN</button>
                            </div>
                            <div class="form-group">
                                <div class="label-signup">or sign in with</div>
                            </div>
                            <div class="form-group">
                                <?php echo HTML::icon_link(route('social.redirect',['provider' => 'facebook']), 'fab fa-facebook-f', '  Facebook', array('class' => 'social')); ?>


                                <?php echo HTML::icon_link(route('social.redirect',['provider' => 'google']), 'fab fa-google', '  Google', array('class' => 'social')); ?>

                            </div>
                        </form>
                    </div>
                    <div class="ample-forgot-password">
                        <div class="heading-forgot-password">Forgot password</div>
                        <div class="forgot-password-content">Enter your email address<br>
                            and we’ll send you password reset instructions</div>
                        <form class="form-horizontal" id="forgotPassword" role="form" method="POST" action="<?php echo e(route('password.email')); ?>">
                        <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <div class="heading">Email</div>
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="submit-button">Send Password Reset Link</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<?php if(count($errors) > 0): ?>
  <?php if($errors->first('email') != 'We can\'t find a user with that e-mail address.'): ?>
  
    <script>
        $( document ).ready(function() {
            setTimeout(function(){ $('#authSignIn').click(); }, 500);
        });
    </script>
  <?php else: ?>
    <script>
        $( document ).ready(function() {
            setTimeout(function(){ $('#authSignIn').click(); $('#openForgot').click();}, 500);
        });
    </script>
  <?php endif; ?>    
<?php endif; ?>