@extends('layouts.admin-message')@section('angularjs')
<script src='/js/angular.js'></script>
<script type="text/javascript" src="/js/angular-sanitize.js"></script>
<script type="text/javascript" src="/lodash/lodash.min.js"></script>
<!-- <script src="/dist/autocomplete.js"></script> -->
<link rel="stylesheet" type="text/css" href="/angular-auto-complete/angular-auto-complete.css" />
<script type="text/javascript" src="/angular-auto-complete/angular-auto-complete.js"></script>
<!-- <link rel="stylesheet" href="/dist/style.css"> -->
<!-- <link rel="stylesheet" href="/dist/autocomplete.css"> -->
@endsection
@section('content')
<!-- admin message -->
<div class="message-contact">
	<div class="search-sec"> <i class="fas fa-search"></i>
        <!-- <autocomplete ng-model="result" attr-placeholder="Search" click-activation="true" data="users" on-type="doSomething" on-select="doSomethingElse"></autocomplete> -->
        <input type="text"
                   ng-model="selectedUser"
                   class="form-control"
                   style="width:300px"
                   placeholder="Name. Try 'a' or 'g'"
                   auto-complete="autoCompleteOptions" />
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
    if (!String.prototype.startsWith) {
        String.prototype.startsWith = function (searchString, position) {
            position = position || 0;
            return this.substr(position, searchString.length) === searchString;
        };
    }

    if (!String.prototype.includes) {
        String.prototype.includes = function (search, start) {
            'use strict';
            if (typeof start !== 'number') {
                start = 0;
            }

            if (start + search.length > this.length) {
                return false;
            } else {
                return this.indexOf(search, start) !== -1;
            }
        };
    }

	var app = angular.module('app', ['autoCompleteModule']).filter('highlight', function () {
        function escapeRegexp(queryToEscape) {
            // Regex: capture the whole query string and replace it with the string that will be used to match
            // the results, for example if the capture is "a" the result will be \a
            return ('' + queryToEscape).replace(/([.?*+^$[\]\\(){}|-])/g, '\\$1');
        }

        return function (matchItem, query) {
            // Replaces the capture string with a the same string inside of a "<span>" tag
            return query && matchItem ? ('' + matchItem).replace(new RegExp(escapeRegexp(query), 'gi'), '<span class="search-text-highlight">$&</span>') : matchItem;
        };
    });
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




        $scope.userData = null;

        $scope.autoCompleteOptions = {
            minimumChars: 1,
            dropdownWidth: '500px',
            dropdownHeight: '200px',
            data: function (searchTerm) {
                return $http.get('/getusers')
                    .then(function (response) {
                        // ideally filtering should be done on the server
                        // searchTerm = searchTerm.toUpperCase();
                        return _.filter(response.data, function (userData) {
                            return userData.name == searchTerm ||
                                userData.name.startsWith(searchTerm);
                        });
                    });
            },
            renderItem: function (item) {
                return {
                    value: item.name,
                    label: "<p class='auto-complete' ng-bind-html='entry.item.name'></p>"
                };
            },
            itemSelected: function (e) {
                $scope.userData = e.item;
                $scope.messages.push($scope.userData);
                $scope.userID = $scope.userData.id;
                let index = ($scope.messages.length > 0) ? $scope.messages.length - 1 : 0;
                $scope.username = $scope.messages[index].name;
                $scope.tab = index;
                $scope.userID = $scope.messages[index].user_id;
                $scope.onGetUserMessages($scope.messages[index].id);
            }
        };



        $scope.onGetUserMessages = function(user_id) {
        	$http.get("/user_messages/"+user_id)
        	.then(function successCallback(response){
        		$scope.user_messages = response.data;
        	}, function errorCallback(error){
        		console.log("Unable to perform get request");
        	});
        };
        
        $scope.onGetMessages = function(user_id) {
        	$http.get("/message_data")
        	.then(function successCallback(response){
        		$scope.messages = response.data;
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
            }, function errorCallback(error){
                console.log("Unable to perform get request");
            });
        };
        $scope.getUsersList();
    }]);
    
</script>@endsection