@extends('layouts.ebook-editor')
@section('angularjs')
<link rel="stylesheet" href="/dist/textAngular.css" type="text/css">
<script src='/dist/angular.js'></script>
<script src='/dist/textAngular-rangy.min.js'></script>
<script src='/dist/textAngular-sanitize.min.js'></script>
<script src='/dist/textAngular.min.js'></script>    
@endsection
@section('content')
	<div layout="column" layout-align="top center">
		<h1>Editor <span>@{{version}}</span></h1>
		<div text-angular ng-model="htmlContent" ng-model-options="{ debounce: 500 }" ng-change="updateContent()" name="demo-editor" ta-text-editor-class="clearfix border-around container" ta-html-editor-class="border-around"></div>
		@{{ chapters | json}}
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
		$scope.chapters = [];
		$scope.activeChapterIndex = 0;
		$scope.counter = 0;

		$scope.viewChapter = function(index) {
			$scope.htmlContent = $scope.chapters[index].content;
			$scope.activeChapterIndex = index;
		};

		$scope.addChapter = function() {
			$scope.counter++;
			const name = 'Chapter '+ $scope.counter;
			const content = '<h2>Try me!</h2><p>textAngular is a super cool WYSIWYG Text Editor directive for AngularJS</p><p><b>Features:</b></p><ol><li>Automatic Seamless Two-Way-Binding</li><li style="color: blue;">Super Easy <b>Theming</b> Options</li><li>Simple Editor Instance Creation</li><li>Safely Parses Html for Custom Toolbar Icons</li><li>Doesn&apos;t Use an iFrame</li><li>Works with Firefox, Chrome, and IE9+</li></ol><p><b>Code at GitHub:</b> <a href="https://github.com/fraywing/textAngular">Here</a></p>';
			$scope.chapters.push({name,content});
		};
		$scope.updateContent = function() {
			const index = $scope.activeChapterIndex;
			if(!angular.isUndefined($scope.chapters[index])){
				$scope.chapters[index].content = $scope.htmlContent;    
			}
		};
		$scope.deleteChapter = function(index) {
			$scope.chapters.splice(index, 1);
		};

		$scope.addChapter();
		$scope.viewChapter(0);
	}]);
</script>
@endsection