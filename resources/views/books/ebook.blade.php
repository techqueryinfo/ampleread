@extends('layouts.ebook-editor')
@section('angularjs')
<link rel="stylesheet" href="http://textangular.com/dist/textAngular.css" type="text/css">
<script src= "https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.js"></script>
<script src='http://textangular.com/dist/textAngular-rangy.min.js'></script>
<script src='http://textangular.com/dist/textAngular-sanitize.min.js'></script>
<script src='http://textangular.com/dist/textAngular.min.js'></script>    
@endsection
@section('content')
	<div layout="column" layout-align="top center">
		<h1>Editor <span>@{{version}}</span></h1>
		<div text-angular="text-angular" name="htmlcontent" ng-model="htmlcontent" ta-disabled='disabled'></div>
		<h1>Raw HTML in a text area</h1>
		<textarea ng-model="htmlcontent" rows="5" style="width: 100%"></textarea>
	</div>
@endsection
@section('footer_scripts')
<script type="text/javascript">
	var app = angular.module('app', ['textAngular']);
	app.controller('TabController', ['$scope', 'textAngularManager', function($scope, textAngularManager) {
		$scope.tab = 1;
		$scope.setTab = function(newTab){
			$scope.tab = newTab;
		};

		$scope.isSet = function(tabNum){
			return $scope.tab === tabNum;
		};

		$scope.version = textAngularManager.getVersion();
		$scope.versionNumber = $scope.version.substring(1);
		$scope.orightml = '<h2>Try me!</h2><p>textAngular is a super cool WYSIWYG Text Editor directive for AngularJS</p><p><b>Features:</b></p><ol><li>Automatic Seamless Two-Way-Binding</li><li>Super Easy <b>Theming</b> Options</li><li style="color: green;">Simple Editor Instance Creation</li><li>Safely Parses Html for Custom Toolbar Icons</li><li class="text-danger">Doesn&apos;t Use an iFrame</li><li>Works with Firefox, Chrome, and IE9+</li></ol><p><b>Code at GitHub:</b> <a href="https://github.com/fraywing/textAngular">Here</a> </p><h4>Supports non-latin Characters</h4><p>This is text</p>';
		$scope.htmlcontent = $scope.orightml;
		$scope.disabled = false;
		$scope.choices = [{id: 'choice1', name: 'Title'}, {id: 'choice2', name: 'Chapter 1'}];
   
		$scope.addNewChapter = function() {
			var newItemNo = $scope.choices.length+1;
			$scope.choices.push({'id' : 'choice' + newItemNo, 'name' : 'Chapter ' + newItemNo});
		};
		$scope.removeNewChapter = function() {
			var newItemNo = $scope.choices.length-1;
			if ( newItemNo !== 0 ) {
				$scope.choices.pop();
			}
		};
		$scope.showAddChapter = function(choice) {
			return choice.id === $scope.choices[$scope.choices.length-1].id;
		};
		$scope.chapterContent = function(choice){
			alert(choice.id);
		};
	}]);
</script>
@endsection