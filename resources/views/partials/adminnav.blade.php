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
            <li {{ Request::is('admin/dashboard') ? 'class=active' : null }}>{!! HTML::link(url('/admin/dashboard'), 'Stats') !!}</li>
            <li {{ Request::is('admin/homepage') ? 'class=active' : null }}>{!! HTML::link(url('/admin/homepage'), 'Homepage') !!}</li>
            <!--<li {{ Request::is('admin/books/category/{category_name}') ? 'class=active' : null }}>{!! HTML::link(url('/admin/books/category/all-books'), 'Books') !!}</li>-->
            <li id="book_id_click">
                                  <a href="#">
                                    Books
                                    <span class="pull-right-container circle-padding" id="change_icon">
                                      <i class="fa fa-angle-down pull-right"></i>
                                    </span>
                                  </a>
                                  <ul class="treeview-menu" id="treeviewshow">
                                    <li>{!! HTML::link(url('/books/type/free/all-books'), 'Free Books') !!}</li>
                                    <li>{!! HTML::link(url('/books/type/paid/all-books'), 'Paid Books') !!}</li>

                                  </ul>
                                </li>
            <li {{ Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'class=active' : null }}>{!! HTML::link(url('/users'), Lang::get('titles.adminUserList')) !!}</li>

            <!-- <li {{ Request::is('admin/categories') ? 'class=active' : null }}>{!! HTML::link(url('/admin/categories'), 'Category Management') !!}</li> -->
            <li {{ Request::is('admin/plans') ? 'class=active' : null }}>{!! HTML::link(url('/admin/plans'), 'Plan Management') !!}</li>
            <li {{ Request::is('/admin/transaction') ? 'class=active' : null }}>{!! HTML::link(url('/admin/transaction'), 'Transactions') !!}</li>
            <li {{ Request::is('admin/settings') ? 'class=active' : null }}>{!! HTML::link(url('/admin/settings'), 'Admin Settings') !!}</li>
            <li {{ Request::is('admin/review') ? 'class=active' : null }}>{!! HTML::link(url('/admin/review'), 'Books for review') !!}</li>
            <li {{ Request::is('admin/message') ? 'class=active' : null }}>{!! HTML::link(url('/admin/message'), 'Messages') !!}<!-- <span class="badge">5</span> --></li>
        </ul>
    </div>
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
<script>
$(document).ready(function(){
    $("#book_id_click").click(function(){
        $("i").toggleClass("fa fa-angle-up fa fa-angle-down");
//        document.getElementById('treeviewshow').style.cssText = 'display: block;';
        $("#treeviewshow").slideToggle("slow");



    });
});
</script>
