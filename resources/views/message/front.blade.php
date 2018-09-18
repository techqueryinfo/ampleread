@extends('layouts.app-message') @section('angularjs')
<script src='/dist/angular.js'></script>
@endsection @section('content')
<!-- admin message -->
<div class="message-contact">
	<div class="search-sec"> <i class="fas fa-search"></i>
		<input type="text" placeholder="Search" />
	</div>
	<div ng-repeat="user in users track by $index">
		<div class="user-sec" ng-class="{active: isSet($index)}" style="cursor: pointer;">
			<div class="image" ng-click="setTab($index)">
				<img src="../images/user.png" />
				<div class="icon">5</div>
			</div>
			<div class="content">
				<div class="nameandtime">
					<div class="name">@{{user.first_name}} @{{user.last_name}}</div>
					<div class="time">@{{user.created_at}}</div>
				</div>
				<div class="discrip">@{{user.about_us}}</div>
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
	app.controller('MessageController',['$scope', '$http', function($scope, $http) {
		$scope.users = [];
		$scope.messages = [
			[
				{ id : 1, message_left : "Hello Sonu", message_right : "Hi Monu" },
				{ id : 2, message_left : "Test", message_right : "Working" },
				{ id : 2, message_left : "Yes", message_right : "No" },
			],
			[{ id : 2, message_left : "Namaskar Riti", message_right : "Namaskar Arun" }],
			[{ id : 3, message_left : "Hello Rekha", message_right : "Hi Anil" }],
		];
		$scope.onGetUsers = function() {
			$http.get("/getusers")
            .then(function successCallback(response){
				$scope.users = response.data;
				$scope.setTab(1);
        		$scope.isSet(1);
				//console.log($scope.users);
            }, function errorCallback(error){
                console.log("Unable to perform get request");
            });
        };
        $scope.onGetUsers();
        $scope.setTab = function(index) { 
        	$scope.username = $scope.users[index].first_name + ' ' + $scope.users[index].last_name;
			$scope.time = '05:00PM';
			$scope.chatmessages = $scope.messages[index];
        	$scope.tab = index;
        	//console.log('Index '+ index + "Users " + $scope.users[index].name);
        };
        $scope.isSet = function(index) {
        	return $scope.tab === index;
        };
	}]);
</script>@endsection