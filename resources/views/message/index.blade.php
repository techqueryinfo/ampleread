@extends('layouts.admin-message')@section('angularjs')
<script src='/dist/angular.js'></script>
@endsection
@section('content')
<!-- admin message -->
<div class="message-contact">
	<div class="search-sec"> <i class="fas fa-search"></i>
		<input type="text" placeholder="Search" />
	</div>
	<div ng-repeat="message in messages track by $index">
		<div class="user-sec" ng-class="{active: isSet($index)}" style="cursor: pointer;">
			<div class="image" ng-click="setTab($index)">
				<img src="../images/user.png" />
				<div class="icon">5</div>
			</div>
			<div class="content">
				<div class="nameandtime">
					<div class="name">@{{message.first_name}} @{{message.last_name}}</div>
					<div class="time">@{{message.created_at}}</div>
				</div>
				<div class="discrip">@{{message.last_message}}</div>
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
	<div ng-repeat="message in user_messages track by $index">
		<div ng-class="getClass(message.from_type)">@{{message.message}}</div>
	</div>
	<div class="sendm-essage">
		<input type="hidden" ng-model="userID">
		<input type="hidden" ng-model="from_type" ng-value="admin">
		<input type="text" ng-model="sendtext" placeholder="Your message">
		<button class="sub-mes" type="submit" ng-click="onClickPost(1)">Send</button>
	</div>
</div>
<!-- end admin message -->
@endsection @section('footer_scripts')
<script type="text/javascript">
	var app = angular.module('app', []);
	app.controller('MessageController',['$scope', '$http', function($scope, $http) {
		$scope.user_messages = [];
		$scope.messages = [];
        $scope.setTab = function(index) { 
        	$scope.username = $scope.messages[index].first_name + ' ' + $scope.messages[index].last_name;
			$scope.time = '05:00PM';
        	$scope.tab = index;
        	$scope.userID = $scope.messages[index].user_id;
        	$scope.onGetUserMessages($scope.messages[index].id);
        	//console.log($scope.messages[index].id);
        };
        $scope.isSet = function(index) {
        	return $scope.tab === index;
        };
        $scope.onGetUserMessages = function(user_id) {
        	$http.get("/user_messages/"+user_id)
        	.then(function successCallback(response){
        		$scope.user_messages = response.data;
        		//console.log($scope.user_messages);
        	}, function errorCallback(error){
        		console.log("Unable to perform get request");
        	});
        };

        $scope.onGetMessages = function(user_id) {
        	$http.get("/message_data")
        	.then(function successCallback(response){
        		$scope.messages = response.data;
        		//console.log($scope.messages);
        	}, function errorCallback(error){
        		console.log("Unable to perform get request");
        	});
        };
        $scope.onGetMessages();
        $scope.getClass =  function(userType) {
        	return userType == 'admin' ? 'chat-right' : 'chat-left';
        };
        $scope.onClickPost = function(adminid){
        	var data = {'admin_id': adminid, 'user_id': $scope.userID, 'from_type': 'admin', 'message': $scope.sendtext };
        	$http.post("/save_message", data)
            .then(function successCallback(response){
            	//console.log(response.data);
            	$scope.onGetUserMessages($scope.userID);
            	delete $scope.sendtext;
            }, function errorCallback(response){
                console.log("POST-ing of data failed");
            });
        };
    }]);
</script>@endsection