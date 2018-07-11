@extends('layouts.admin')
@section('content')
<div class="stat-container">
<div class="stat-one">
    <div class="stat-one-left">
        <div class="row-stat">
            <div class="unit-stat-one">
                <div class="heading">Free Users
                    Signed Up</div>
                <div class="day">Today <i class="fa fa-angle-down"></i></div>
                <div class="date free-signup">8</div>
            </div>
            <div class="unit-stat-one">
                <div class="heading">Paid Users
                    Signed Up</div>
                <div class="day">This Month <i class="fa fa-angle-down"></i></div>
                <div class="date paid-signup">23</div>
            </div>
        </div>
        <div class="row-stat">
            <div class="unit-stat-one">
                <div class="heading">Users Redirected
                    to Paid eBooks</div>
                <div class="day">Today <i class="fa fa-angle-down"></i></div>
                <div class="date paid-ebook">1,492</div>
            </div>
            <div class="unit-stat-one">
                <div class="heading">Books Created
                    by Users</div>
                <div class="day">Lifetime <i class="fa fa-angle-down"></i></div>
                <div class="date book-created">86</div>
            </div>
        </div>
    </div>
    <div class="stat-one-right">
        <div id="chartdiv"></div>
    </div>
</div>
</div>
@endsection