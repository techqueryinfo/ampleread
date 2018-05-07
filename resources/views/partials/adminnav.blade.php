<div class="admin-left">
    <div class="admin-img">
        @if (Auth::User() && (Auth::User()->profile) && (Auth::User()->profile->avatar_status == 0))
            <img src="{{ Gravatar::get(Auth::user()->email) }}"/>
        @else
            <img src="/uploads/{{ Auth::User()->profile->avatar }}"/>
        @endif
    </div>
    <div class="admin-name">
        <div class="name">{{Auth::user()->name}}<i class="fas fa-angle-down"></i> </div>

    </div>
    <div class="admin-pro">
        <div class="admin-button"><a href="">Admin</a></div>
    </div>
    <div class="admin-line"></div>
    <div class="admin-menu">
        <ul>
            <li {{ Request::is('admin/dashboard') ? 'class=active' : null }}>{!! HTML::link(url('/admin/plans'), 'Stats') !!}</li>
            <li><a href="javascript:void(0)">Homepage</a></li>
            <li><a href="javascript:void(0)">Books</a></li>
            <li {{ Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'class=active' : null }}>{!! HTML::link(url('/users'), Lang::get('titles.adminUserList')) !!}</li>
            <li {{ Request::is('admin/categories') ? 'class=active' : null }}>{!! HTML::link(url('/admin/categories'), 'Category Management') !!}</li>
                    
            <li {{ Request::is('admin/plans') ? 'class=active' : null }}>{!! HTML::link(url('/admin/plans'), 'Plan Management') !!}</li>
            <li {{ Request::is('admin/settings') ? 'class=active' : null }}>{!! HTML::link(url('/admin/settings'), 'Admin Settings') !!}</li>
            <!-- <li><a href="javascript:void(0)">Users</a></li> -->
            <!-- <li><a href="javascript:void(0)">Plan Management</a></li> -->
            <li><a href="javascript:void(0)">Messages<span class="badge">5</span></a></li>
            <li><a href="javascript:void(0)">Books for review<span class="badge">5</span></a></li>

        </ul>
    </div>
    <div class="logout">
        <div class="icon"><i class="fas fa-power-off"></i></div>
        <div class="text">Log out</div>
    </div>
</div>