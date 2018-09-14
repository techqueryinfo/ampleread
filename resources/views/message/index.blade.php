@extends('layouts.admin-message')@section('angularjs')
<script src='/dist/angular.js'></script>
@endsection
@section('content')
<!-- admin message -->
<div class="message-contact">
	<div class="search-sec"> <i class="fas fa-search"></i>
		<input type="text" placeholder="Search" />
	</div>
	<div ng-repeat="user in users track by $index">
		<div class="user-sec" ng-class="{ active: isSet($index) }" style="cursor: pointer;">
			<div class="image" ng-click="setTab($index)">
				<img src="../images/user.png" />
				<div class="icon">@{{user.badge}}</div>
			</div>
			<div class="content">
				<div class="nameandtime">
					<div class="name">@{{user.name}}</div>
					<div class="time">@{{user.time}}</div>
				</div>
				<div class="discrip">@{{user.desc}}</div>
			</div>
		</div>
	</div>
</div>
<div class="message-textpanel">
	<div class="user-sec">
		<div class="image">
			<img src="../images/user.png" />
		</div>
		<div class="content">
			<div class="nameandtime">
				<div class="name">Ryan Coraci</div>
				<div class="time">last seen 5 mins ago</div>
			</div>
		</div>
	</div>
	<div class="chat-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse metus turpis, rhoncus non purus in, hendrerit mollis felis. Quisque risus arcu, accumsan ut felis in, elementum feugiat erat. Morbi rutrum dui ac dui pellentesque, nec consectetur tortor</div>
	<div class="chat-right">Proin fermentum iaculis suscipit</div>
	<div class="sendm-essage">
		<input type="text" placeholder="Your message">
		<button class="sub-mes" type="submit">Send</button>
	</div>
</div>
<!-- end admin message -->
@endsection @section('footer_scripts')
<script type="text/javascript">
	var app = angular.module('app', []);
	app.controller('MessageController', function($scope) {
		$scope.users = [
			{ id : 1, name : "Saurabh Saxena", badge : 5, desc : "This is testing", time : "02:30 AM" },
			{ id : 2, name : "Ujjwal Saxena", badge : 2, desc : "Yes, It's Working fine", time : "05:00 PM" },
		];
		$scope.setTab = function(newTab) {
            $scope.tab = newTab;
        };

        $scope.isSet = function(tabNum) {
            return $scope.tab === tabNum;
        };
	});
</script>@endsection