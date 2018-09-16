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
				<div class="name">@{{username}}</div>
				<div class="time">@{{time}}</div>
			</div>
		</div>
	</div>
	<div ng-repeat="message in chatmessages track by $index">
		<div class="chat-left">@{{message.message_left}}</div>
		<div class="chat-right">@{{message.message_right}}</div>
	</div>
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
			{ id : 3, name : "Sudhakar MIshra", badge : 4, desc : "Testing Purpose", time : "05:10 PM" },
		];
		$scope.messages = [
			[
				{ id : 1, message_left : "Hello Sonu", message_right : "Hi Monu" },
				{ id : 2, message_left : "Test", message_right : "Working" },
				{ id : 2, message_left : "Yes", message_right : "No" },
			],
			[{ id : 2, message_left : "Namaskar Riti", message_right : "Namaskar Arun" }],
			[{ id : 3, message_left : "Hello Rekha", message_right : "Hi Anil" }],
		];
		$scope.setTab = function(index) { console.log($scope.messages); 
			console.log($scope.messages[index]);
			$scope.username = $scope.users[index].name;
			$scope.time = $scope.users[index].time;
			$scope.chatmessages = $scope.messages[index];
        	$scope.tab = index;
        };
        $scope.isSet = function(index) {
        	return $scope.tab === index;
        };
        $scope.setTab(1);
        $scope.isSet(1);
	});
</script>@endsection