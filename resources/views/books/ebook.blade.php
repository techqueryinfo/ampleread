@extends('layouts.admin')
@section('angularjs')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>   
@endsection
@section('content')
<div class="container">
	<h3>E-Book Page</h3>
	<h4>AngularJS is active</h4>
	<div ng-app="myApp" ng-controller="myCtrl">
		First Name: <input type="text" ng-model="firstName"><br><br>
		Last Name:  <input type="text" ng-model="lastName"><br>
		<br>
		Full Name: @{{firstName + " " + lastName}}
    </div>
</div>
<div class="ample-signin-manage"></div>
<div class="ample-signin-manage-section"></div>
<div class="sign-in-page-bar"></div>
<div class="ample-book-slot-slider"></div>
@endsection
@section('footer_scripts')
<script type="text/javascript">
	var app = angular.module('myApp', []); 
	app.controller('myCtrl', function($scope) {   
		$scope.firstName = "Saurabh";
    	$scope.lastName  = "Saxena";
	});
</script>
@endsection