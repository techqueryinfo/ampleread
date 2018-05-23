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
    <div layout="column" class="admin-menu" ng-cloak>
        <ul>
            <md-sidenav
            class="md-sidenav-left"
            md-component-id="left"
            md-is-locked-open="$mdMedia('gt-md')"
            md-whiteframe="4">
            <section>
                <md-list class='nav nav-pills'>
                  <md-list-item ng-class="{active: panel.isSelected(1) }">
                    <li><a href="#" ng-click="panel.selectTab(1)">TABLE OF CONTENTS</a></li>
                </md-list-item>
                <md-list-item ng-class="{active: panel.isSelected(2) }">
                    <li><a href="#" ng-click="panel.selectTab(2)">BOOK INFO</a></li>
                </md-list-item>
                <md-list-item ng-class="{active: panel.isSelected(3) }">
                    <li><a href="#" ng-click="panel.selectTab(3)">NOTES</a></li>
                </md-list-item>
                <md-list-item ng-class="{active: panel.isSelected(4) }">
                    <li><a href="#" ng-click="panel.selectTab(4)">IMAGES</a></li>
                </md-list-item>
            </md-list>
            </section>
        </md-sidenav>
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