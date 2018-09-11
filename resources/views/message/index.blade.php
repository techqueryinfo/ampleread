@extends('layouts.admin')
@section('content')
<!-- admin message -->
<div class="message-contact">
	<div class="search-sec"> <i class="fas fa-search"></i>
		<input type="text" placeholder="Search" />
	</div>
	<div class="user-sec">
		<div class="image">
			<img src="../images/user.png" />
			<div class="icon">3</div>
		</div>
		<div class="content">
			<div class="nameandtime">
				<div class="name">Ryan Coraci</div>
				<div class="time">02:14 AM</div>
			</div>
			<div class="discrip">Lorem ipsum dolor sit ametc…</div>
		</div>
	</div>
	<div class="user-sec">
		<div class="image">
			<img src="../images/user.png" />
			<div class="icon">3</div>
		</div>
		<div class="content">
			<div class="nameandtime">
				<div class="name">Ryan Coraci</div>
				<div class="time">02:14 AM</div>
			</div>
			<div class="discrip">Lorem ipsum dolor sit ametc…</div>
		</div>
	</div>
	<div class="user-sec active">
		<div class="image">
			<img src="../images/user.png" />
			<div class="icon">3</div>
		</div>
		<div class="content">
			<div class="nameandtime">
				<div class="name">Ryan Coraci</div>
				<div class="time">02:14 AM</div>
			</div>
			<div class="discrip">Lorem ipsum dolor sit ametc…</div>
		</div>
	</div>
	<div class="user-sec">
		<div class="image">
			<img src="../images/user.png" />
			<div class="icon">3</div>
		</div>
		<div class="content">
			<div class="nameandtime">
				<div class="name">Ryan Coraci</div>
				<div class="time">02:14 AM</div>
			</div>
			<div class="discrip">Lorem ipsum dolor sit ametc…</div>
		</div>
	</div>
	<div class="user-sec">
		<div class="image">
			<img src="../images/user.png" />
			<div class="icon">3</div>
		</div>
		<div class="content">
			<div class="nameandtime">
				<div class="name">Ryan Coraci</div>
				<div class="time">02:14 AM</div>
			</div>
			<div class="discrip">Lorem ipsum dolor sit ametc…</div>
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
				<div class="name">Ryan Coraci</div>
				<div class="time">last seen 5 mins ago</div>
			</div>
		</div>
	</div>
	<div class="chat-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse metus turpis, rhoncus non purus in, hendrerit mollis felis. Quisque risus arcu, accumsan ut felis in, elementum feugiat erat. Morbi rutrum dui ac dui pellentesque, nec consectetur tortor</div>
	<div class="chat-right">Proin fermentum iaculis suscipit</div>
	<div class="sendm-essage">
		<input type="text" placeholder="Your message">
		<button class="sub-mes" type="submit">Send</button>
	</div>
</div>
<!-- end admin message -->
@endsection