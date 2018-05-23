@extends('layouts.ebook-editor')
@section('angularjs')
<link rel="stylesheet" href="http://textangular.com/dist/textAngular.css" type="text/css">
<script src= "https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-animate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-aria.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.8/angular-material.min.js"></script>
<script src='http://textangular.com/dist/textAngular-rangy.min.js'></script>
<script src='http://textangular.com/dist/textAngular-sanitize.min.js'></script>
<script src='http://textangular.com/dist/textAngular.min.js'></script>    
@endsection
@section('content')
<md-content flex layout-padding>
	<div layout="column" layout-align="top center">
		<div class='panel' ng-show='panel.isSelected(1)'>
			<div ng-controller="wysiwygeditor" class="container app">
				<h1>Editor <span>@{{version}}</span></h1>
				<div text-angular="text-angular" name="htmlcontent" ng-model="htmlcontent" ta-disabled='disabled' style="width: 85%"></div>
				<h1>Raw HTML in a text area</h1>
				<textarea ng-model="htmlcontent" style="width: 85%"></textarea>
			</div>
		</div>
		<div class='panel' ng-show='panel.isSelected(2)'>
			<h4>What is Lorem Ipsum?</h4>
			<p>
				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
			</p>
		</div>
		<div class='panel' ng-show='panel.isSelected(3)'>
			<h4>Where can I get some?</h4>
			<p>
				There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
			</p>
		</div>
		<div class='panel' ng-show='panel.isSelected(4)'>
			<h4>Where does it come from?</h4>
			<p>
				Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.
			</p>
		</div>
	</div>
	<div flex></div>
</md-content>
@endsection
@section('footer_scripts')
<script type="text/javascript">
	var app = angular.module('app', ['ngMaterial', 'textAngular']);
	app.controller('tabs', function ($scope, $timeout, $mdSidenav, $log) {
		this.tab = 1;
		this.selectTab = function(setTab){
			this.tab = setTab;
		}
		this.isSelected = function(checkTab){
			return this.tab === checkTab;
		}
	});
	app.controller('wysiwygeditor', ['$scope', 'textAngularManager', function wysiwygeditor($scope, textAngularManager) {
		$scope.version = textAngularManager.getVersion();
		$scope.versionNumber = $scope.version.substring(1);
		$scope.orightml = '<h2>Try me!</h2><p>textAngular is a super cool WYSIWYG Text Editor directive for AngularJS</p><p><b>Features:</b></p><ol><li>Automatic Seamless Two-Way-Binding</li><li>Super Easy <b>Theming</b> Options</li><li style="color: green;">Simple Editor Instance Creation</li><li>Safely Parses Html for Custom Toolbar Icons</li><li class="text-danger">Doesn&apos;t Use an iFrame</li><li>Works with Firefox, Chrome, and IE9+</li></ol><p><b>Code at GitHub:</b> <a href="https://github.com/fraywing/textAngular">Here</a> </p><h4>Supports non-latin Characters</h4><p>This is text</p>';
		$scope.htmlcontent = $scope.orightml;
		$scope.disabled = false;
	}]);
</script>
@endsection