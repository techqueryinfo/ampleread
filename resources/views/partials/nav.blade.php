<div class="ample-header">
    <a href="{{ url('/') }}">
        <div class="ample-logo"></div>
    </a>
    <div class="ample-search">
        <div class="search-icon">
            <i class="fas fa-search"></i>
        </div>
        <input type="text" placeholder="Search by Title , Author , ISBN">
    </div>
    {{-- Authentication Links --}}
    @if (Auth::guest())
    <div class="ample-login">
        <a href="{{ route('register') }}"><button>{!! trans('titles.register') !!}</button></a>
        <a href="{{ route('login') }}"><label>{!! trans('titles.login') !!}</label></a>
    </div>
    @else
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                    <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="user-avatar-nav">
                @else
                    <div class="user-avatar-nav"></div>
                @endif

                {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'class=active' : null }}>
                    {!! HTML::link(url('/profile/'.Auth::user()->name), trans('titles.profile')) !!}
                </li>
                @role('admin')
                    <li {{ Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'class=active' : null }}>{!! HTML::link(url('/users'), Lang::get('titles.adminUserList')) !!}</li>
                    <li {{ Request::is('admin/categories') ? 'class=active' : null }}>{!! HTML::link(url('/admin/categories'), Lang::get('titles.adminCategoryList')) !!}</li>
                    
                    <li {{ Request::is('admin/plans') ? 'class=active' : null }}>{!! HTML::link(url('/admin/plans'), Lang::get('titles.adminPlanList')) !!}</li>

                    <li {{ Request::is('users/create') ? 'class=active' : null }}>{!! HTML::link(url('/users/create'), Lang::get('titles.adminNewUser')) !!}</li>
                    <li {{ Request::is('themes','themes/create') ? 'class=active' : null }}>{!! HTML::link(url('/themes'), Lang::get('titles.adminThemesList')) !!}</li>
                    <li {{ Request::is('logs') ? 'class=active' : null }}>{!! HTML::link(url('/logs'), Lang::get('titles.adminLogs')) !!}</li>
                    <li {{ Request::is('activity') ? 'class=active' : null }}>{!! HTML::link(url('/activity'), Lang::get('titles.adminActivity')) !!}</li>
                    <li {{ Request::is('phpinfo') ? 'class=active' : null }}>{!! HTML::link(url('/phpinfo'), Lang::get('titles.adminPHP')) !!}</li>
                    <li {{ Request::is('routes') ? 'class=active' : null }}>{!! HTML::link(url('/routes'), Lang::get('titles.adminRoutes')) !!}</li>
                    <li {{ Request::is('active-users') ? 'class=active' : null }}>{!! HTML::link(url('/active-users'), Lang::get('titles.activeUsers')) !!}</li>
                @endrole
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        {!! trans('titles.logout') !!}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    </ul>
    @endif
    <!-- <div class="ample-login">
        <button>Sign Up</button>
        <label>Sign In</label>
    </div> -->
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
    <li><a href="#">Create an e-Book</a></li>
    <li><a href="#">Publish an e-book</a></li>
</ul>
</div>
<div class="ample-sub-menu">
    <div class="ample-sub-menu-left">
        <div class="ample-sub-menu-row">
            <div class="heading">Customer favourites</div>
            <ul>
                <li><a href="#">Classics</a></li>
                <li><a href="">Exclusives</a></li>
                <li><a href="">Top 100</a></li>
                <li><a href="">By Authors</a></li>
                <li><a href="">By Series</a></li>
                <li><a href="">Collectible Editions</a></li>
                <li><a href="">Coming Soon</a></li>
                <li><a href="">New Releases</a></li>
            </ul>
        </div>
        <div class="ample-sub-menu-row">
            <div class="heading">Subjects</div>
            <ul>
                <li><a href="#">Biography</a></li>
                <li><a href="">Business</a></li>
                <li><a href="">Cookbooks, Food & Wine</a></li>
                <li><a href="">Diet, Health & Fitness</a></li>
                <li><a href="">Fiction</a></li>
                <li><a href="">Graphic Novels & Comics</a></li>
                <li><a href="">History</a></li>
                <li><a href="">Mystery & Crime</a></li>
            </ul>
        </div>
        <div class="ample-sub-menu-row">
           <ul>
               <li><a href="#">Romance</a></li>
               <li><a href="">Science Fiction & Fantasy</a></li>
               <li><a href="">Self-Help & Relationships</a></li>
               <li><a href="">Social Sciences</a></li>
               <li><a href="">Travel</a></li>
               <li><a href="">True Crime</a></li>

            </ul>
        </div>
    </div>
    <div class="ample-sub-menu-right">
        <div class="ample-book-section">
            <img src="images/image1.jpg"/>
        </div>
        <div class="ample-text-section">
            <div class="heading">Coming soon</div>
            <div class="content">Pre-order tommorow's
                bestsellers today</div>
            <button>Learn More</button>
        </div>
    </div>
</div>