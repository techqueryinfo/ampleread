
<div class="ample-header">
    <a href="{{ url('/') }}">
        <div class="ample-logo"></div>
    </a>
    <div class="ample-search">
        
        <input type="text" placeholder="Search by Title , Author , ISBN" id="bookSearchInput"  name="book_search" value="{{(!empty($search_text)) ? $search_text : ''}}">
        <div class="search-icon" id="search_pointer">
            <i class="fas fa-search"></i>
        </div>
    </div>
    {{-- Authentication Links --}}
    @if (Auth::guest())
    <div class="ample-login">
        <button class="btn-signup" data-toggle="modal" data-target="#myModal" id="authSignUp">{!! trans('titles.register') !!}</button>
        <label class="btn-signin" data-toggle="modal" data-target="#myModal" id="authSignIn" >{!! trans('titles.login') !!}</label>
    </div>
    @else
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="padding-top: 10px !important">
                <img src="/images/combined-shape.png" alt="{{ Auth::user()->name }}" class="user-avatar-nav" style="height: 16px; width: 16px">
                Tools<span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                    <img src="/uploads/admin.png" alt="{{ Auth::user()->name }}" class="user-avatar-nav">
                @else
                    <img src="/uploads/user.png" alt="{{ Auth::user()->name }}" class="user-avatar-nav">
                @endif
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'class=active' : null }}>
                    {!! HTML::link(url('/profile/'.Auth::user()->name), trans('titles.profile')) !!}
                </li>
                <li {{ Request::is('home','home/') ? 'class=active' : null }}>
                    {!! HTML::link(url('/home'), 'My Account') !!}
                </li>
                <li {{ Request::is('message','message/') ? 'class=active' : null }}>
                    {!! HTML::link(url('/message'), 'Message') !!}
                </li>
                @role('admin')
                    <li {{ Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'class=active' : null }}>{!! HTML::link(url('/users'), Lang::get('titles.adminUserList')) !!}</li>
                    <li {{ Request::is('admin/categories') ? 'class=active' : null }}>{!! HTML::link(url('/admin/categories'), Lang::get('titles.adminCategoryList')) !!}</li>
                    <li {{ Request::is('admin/plans') ? 'class=active' : null }}>{!! HTML::link(url('/admin/plans'), Lang::get('titles.adminPlanList')) !!}</li>
                    <li {{ Request::is('admin/settings') ? 'class=active' : null }}>{!! HTML::link(url('/admin/settings'), 'Admin Settings') !!}</li>
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
    <div class="menu-bar">
        <i class="fas fa-bars fa-2x"></i>
    </div>
</div>
<div class="ample-menu">
<ul>
    <li><a href="#">Browse Category</a><i class="fa fa-angle-down"></i></li>
    <li><a href="/books/category/fiction">Fiction</a></li>
    <li><a href="/books/category/non-fiction">Non Fiction</a></li>
    <li><a href="/books/category/popular">Most Popular Books</a></li>
    <li><a href="/books/category/new-releases">New Release</a> </li>
    <li {{ Request::is('book') ? 'class=active' : null }}>{!! HTML::link(url('/book/create/'), 'Create an e-Book') !!}</li>
    <li {{ Request::is('publishebook') ? 'class=active' : null }}>{!! HTML::link(url('/book/publishebook'), 'Publish an e-Book') !!}</li>
</ul>
</div>
@if(Session::get('categories'))
<div class="ample-sub-menu">
    <div class="ample-sub-menu-left">
        <div class="ample-sub-menu-row">
            <div class="heading">Subjects</div>
            
            <ul>
                <li @if(isset($category_name) && $category_name == 'all-books') class="active" @endif><a style="color:black;" href="/books/category/all-books">All Books</a>

                </li>
                @foreach (Session::get('categories')->slice(0,8) as $optionKey => $optionValue)
                    @if(!blank($optionValue->is_delete) && $optionValue->is_delete==0)
                    <li @if(isset($category_name) && $category_name == $optionValue->category_slug) class="active" @endif><a style="color:black;" href="/books/category/{{$optionValue->category_slug}}">{{$optionValue->name}}</a></li>
                @endif
                @endforeach
            </ul>
        </div>
        @if(Session::get('categories'))
        <div class="ample-sub-menu-row">
           <ul>
                @foreach (Session::get('categories')->slice(8,9) as $optionKey => $optionValue)
                @if(!blank($optionValue->is_delete) && $optionValue->is_delete==0)
                    <li @if(isset($category_name) && $category_name == $optionValue->category_slug) class="active" @endif><a style="color:black;" href="/books/category/{{$optionValue->category_slug}}">{{$optionValue->name}}</a></li>
                @endif
                @endforeach
            </ul>
        </div>
        @endif
        @if(Session::get('categories'))
        <div class="ample-sub-menu-row">
           <ul>
                @foreach (Session::get('categories')->slice(17,10) as $optionKey => $optionValue)
                @if(!blank($optionValue->is_delete) && $optionValue->is_delete==0)
                    <li @if(isset($category_name) && $category_name == $optionValue->category_slug) class="active" @endif><a style="color:black;" href="/books/category/{{$optionValue->category_slug}}">{{$optionValue->name}}</a></li>
                @endif
                @endforeach
                <li style="margin-left: 137px;" @if(isset($category_name) && $category_name == 'all-books') class="active" @endif><a style="color:blue;" href="/category">See more <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </li>
            </ul>
        </div>
        @endif
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
@endif
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
                             <form id="formRegister" class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">

                            {{ csrf_field() }}  
                            <div class="form-group">
                                <div class="heading">Name</div>
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'id' => 'name']) !!}
                                <small class="help-block"></small>
                            </div>
                            <div class="form-group">
                                <div class="heading">Email</div>
                                {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'E-Mail Address']) !!}
                                <small class="help-block"></small>
                            </div>
                            <div class="form-group">
                                <div class="heading">Country</div>

                            </div>
                            <select name="country" class="form-control js-example-basic-single" id="country" >
                                <option value="" selected="">Please select country</option>
                                @if(isset($countries))
                                    @foreach ($countries as $optionKey => $optionValue)
                                        <option value="{{ $optionValue->code }}"> {{ $optionValue->countryname }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="form-group">
                                <div class="heading">Password</div>
                                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password']) !!}
                                <small class="help-block"><strong></strong></small>
                            </div>
                            <div class="form-group">
                                <div class="heading">Confirm Password</div>
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirm', 'placeholder' => 'Confirm Password']) !!}
                                <small class="help-block"><strong></strong></small>
                            </div>
                            @if(config('settings.reCaptchStatus'))
                                <div class="form-group">
                                    <div class="col-sm-6 col-sm-offset-4">
                                        <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <button type="submit" id="submitForm" class="submit-button">SIGN UP</button>
                            </div>
                            <div class="form-group">
                                <div class="label-signup">or sign in with</div>
                            </div>
                            <div class="form-group">
                                {!! HTML::icon_link(route('social.redirect',['provider' => 'facebook']), 'fab fa-facebook-f', '  Sign up with Facebook', array('class' => 'social')) !!}

                                {!! HTML::icon_link(route('social.redirect',['provider' => 'google']), 'fab fa-google', '  Sign up with Google', array('class' => 'gsocial')) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="ample-register-section">
                        @if (Session::has('message'))
                            <div class="alert alert-warning">{{ Session::get('message') }}</div>
                        @endif
                        <form id="formSignIn" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="heading">Email</div>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="heading">Password</div>
                                <div class="heading-right" id="openForgot" onclick="Showforgot()"><a href="#">Forgot password</a></div>
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" id="submitLoginForm" class="submit-button">SIGN IN</button>
                            </div>
                            <div class="form-group">
                                <div class="label-signup">or sign in with</div>
                            </div>
                            <div class="form-group">
                                {!! HTML::icon_link(route('social.redirect',['provider' => 'facebook']), 'fab fa-facebook-f', '  Sign in with Facebook', array('class' => 'social')) !!}

                                {!! HTML::icon_link(route('social.redirect',['provider' => 'google']), 'fab fa-google', '  Sign in with Google', array('class' => 'gsocial')) !!}
                            </div>
                        </form>
                    </div>
                    <div class="ample-forgot-password">
                        <div class="heading-forgot-password">Forgot password</div>
                        <div class="forgot-password-content">Enter your email address<br>
                            and we’ll send you password reset instructions</div>
                        <form class="form-horizontal" id="forgotPassword" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <div class="heading">Email</div>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="submit-button">Send Password Reset Link</button>
                            </div>
                        </form>
                    </div>
                </div>
            <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@if (count($errors) > 0)
  @if ($errors->first('email') != 'We can\'t find a user with that e-mail address.')
  {{-- Scripts --}}
    <script>
        $( document ).ready(function() {
            setTimeout(function(){ $('#authSignIn').click(); }, 500);
        });
    </script>
  @else
    <script>
        $( document ).ready(function() {
            setTimeout(function(){ $('#authSignIn').click(); $('#openForgot').click();}, 500);
        });
    </script>
  @endif    
@endif