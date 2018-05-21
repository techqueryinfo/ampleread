<div class="admin-left">
    <!-- <div class="admin-img">
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
    </div> -->
    <div class="admin-menu">
        <ul>
            <li><a href="javascript:void(0)">TABLE OF CONTENTS</a></li>
            <li><a href="javascript:void(0)">BOOK INFO</a></li>
            <li><a href="javascript:void(0)">NOTES</a></li>
            <li><a href="javascript:void(0)">IMAGES</a></li>
        </ul>
    </div>
    <!-- <div class="admin-line"></div> -->
    <div class="logout">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="icon"><i class="fas fa-power-off"></i></div>
            <div class="text">Log out</div>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
</div>