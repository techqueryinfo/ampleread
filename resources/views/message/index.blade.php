@extends('layouts.admin-message')@section('angularjs')
<script src='/dist/angular.js'></script>
<script src="/dist/autocomplete.js"></script>
<link rel="stylesheet" href="/dist/style.css">
<link rel="stylesheet" href="/dist/autocomplete.css">
@endsection
@section('content')
<!-- admin message -->
<div class="message-contact">
	<div class="search-sec"> <i class="fas fa-search"></i>
        <autocomplete ng-model="result" attr-placeholder="Search" click-activation="true" data="users" on-type="doSomething" on-select="doSomethingElse"></autocomplete>
	</div>
	<div ng-repeat="message in messages track by $index">
		<div class="user-sec" ng-class="{active: isSet($index)}" style="cursor: pointer;">
			<div class="image" ng-click="setTab($index)">
				<img src="@{{(message.avatar) ? '../uploads/avatar/'+message.avatar : '../images/user.png'}}" />
				<!-- <div class="icon">5</div> -->
			</div>
			<div class="content" ng-click="setTab($index)">
				<div class="nameandtime">
					<div class="name">@{{message.name}}</div>
					<div class="time">@{{message.formattedDate}}</div>
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
	var app = angular.module('app', ['autocomplete']);
	app.controller('MessageController',['$scope', '$http', function($scope, $http) {
		$scope.user_messages = [];
		$scope.messages = [];
        $scope.users = [];
        $scope.setTab = function(index) { 
        	$scope.username = $scope.messages[index].name;
			$scope.time = $scope.messages[index].formattedDate;
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
        
        $scope.getUsersList = function(){
            $http.get("/getusers")
            .then(function successCallback(response){
                $scope.users = response.data;
                //console.log($scope.users);
            }, function errorCallback(error){
                console.log("Unable to perform get request");
            });
        };
        $scope.getUsersList();

        $scope.doSomething = function(typedthings){
            console.log("Do something like reload data with this: " + typedthings );
        };

        $scope.doSomethingElse = function(suggestion){
            console.log("Suggestion selected: " + suggestion );
        };
    }]);
</script>@endsection