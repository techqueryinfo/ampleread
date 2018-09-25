@extends('layouts.app-message') @section('angularjs')
<script src='/dist/angular.js'></script>
@endsection @section('content')
<div class="message-textpanel">
	<div class="user-sec">
		<div class="image">
			<img src="../images/user.png" />
		</div>
		<div class="content">
			<div class="nameandtime">
				<div class="name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</div>
				<div class="time">{{Auth::user()->updated_at}}</div>
			</div>
		</div>
	</div>
	<div ng-repeat="message in user_messages track by $index">
		<div ng-class="getClass(message.from_type)">@{{message.message}}</div>
	</div>
	<div class="sendm-essage">
		<input type="hidden" ng-model="userID">
		<input type="hidden" ng-model="from_type" ng-value="user">
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
		var user_id = <?php echo Auth::user()->id; ?>;
		$scope.onGetUserMessages = function(user_id) {
        	$http.get("/user_messages/"+user_id)
        	.then(function successCallback(response){
        		$scope.user_messages = response.data;
        		//console.log($scope.user_messages);
        	}, function errorCallback(error){
        		console.log("Unable to perform get request");
        	});
        };

        $scope.onGetUserMessages(user_id);
        $scope.getClass =  function(userType) {
        	return userType == 'user' ? 'chat-right' : 'chat-left';
        };
        $scope.onClickPost = function(adminid){
        	var data = {'admin_id': adminid, 'user_id': user_id, 'from_type': 'user', 'message': $scope.sendtext };
        	$http.post("admin/save_message", data)
            .then(function successCallback(response){
            	//console.log(response.data);
            	$scope.onGetUserMessages(user_id);
            	delete $scope.sendtext;
            }, function errorCallback(response){
                console.log("POST-ing of data failed");
            });
        };
    }]);
</script>@endsection