<div class="admin-left">
    <div class="admin-img">
        <?php if(Auth::User() && (Auth::User()->profile) && (Auth::User()->profile->avatar_status == 0)): ?>
            <img src="<?php echo e(Gravatar::get(Auth::user()->email)); ?>"/>
        <?php else: ?>
            <img src="/uploads/<?php echo e(Auth::User()->profile->avatar); ?>"/>
        <?php endif; ?>
    </div>
    <div class="admin-name">
        <div class="name"><?php echo e(Auth::user()->name); ?><i class="fas fa-angle-down"></i> </div>
    </div>
    <div class="admin-pro">
        <div class="admin-button"><a href="">Admin</a></div>
    </div>
    <div class="admin-line"></div>
    <div class="admin-menu">
        <ul>
            <li <?php echo e(Request::is('admin/dashboard') ? 'class=active' : null); ?>><?php echo HTML::link(url('/admin/dashboard'), 'Stats'); ?></li>
            <li <?php echo e(Request::is('admin/homepage') ? 'class=active' : null); ?>><?php echo HTML::link(url('/admin/homepage'), 'Homepage'); ?></li>
            <li <?php echo e(Request::is('admin/books/category/{category_name}') ? 'class=active' : null); ?>><?php echo HTML::link(url('/admin/books/category/all-books'), 'Books'); ?></li>
            <li <?php echo e(Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'class=active' : null); ?>><?php echo HTML::link(url('/users'), Lang::get('titles.adminUserList')); ?></li>
            <!-- <li <?php echo e(Request::is('admin/categories') ? 'class=active' : null); ?>><?php echo HTML::link(url('/admin/categories'), 'Category Management'); ?></li> -->
            <li <?php echo e(Request::is('admin/plans') ? 'class=active' : null); ?>><?php echo HTML::link(url('/admin/plans'), 'Plan Management'); ?></li>
            <li <?php echo e(Request::is('/admin/transaction') ? 'class=active' : null); ?>><?php echo HTML::link(url('/admin/transaction'), 'Transactions'); ?></li>
            <li <?php echo e(Request::is('admin/settings') ? 'class=active' : null); ?>><?php echo HTML::link(url('/admin/settings'), 'Admin Settings'); ?></li>
            <li <?php echo e(Request::is('admin/review') ? 'class=active' : null); ?>><?php echo HTML::link(url('/admin/review'), 'Books for review'); ?></li>
            <li><a href="javascript:void(0)">Messages<span class="badge">5</span></a></li>
        </ul>
    </div>
    <div class="logout">
        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="icon"><i class="fas fa-power-off"></i></div>
            <div class="text">Log out</div>
        </a>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo e(csrf_field()); ?>

        </form>
    </div>
</div>