@extends('layouts.ebook-editor')
@section('angularjs')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script> 
<!-- <script src= "https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-animate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-aria.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-messages.min.js"></script> -->
<!-- Angular Material Library -->
<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.8/angular-material.min.js"></script>    
@endsection
@section('content')
<md-content flex layout-padding>
	<div layout="column" layout-align="top center">
		<div class='panel' ng-show='panel.isSelected(1)'>
			<h4>Why do we use it?</h4>
			<p>
				It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
			</p>
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
	angular
	.module('demoApp', ['ngMaterial'])
	.controller('AppCtrl', function ($scope, $timeout, $mdSidenav, $log) {
		this.tab = 1;
		this.selectTab = function(setTab){
			this.tab = setTab;
		}
		this.isSelected = function(checkTab){
			return this.tab === checkTab;
		}
	});
</script>
@endsection