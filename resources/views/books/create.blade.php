@extends('layouts.admin')
@section('content')
<div class="sorting-section">
	<div class="sorting-left">
	</div>
	<div class="sorting-right">
		<!-- <a href="{{ url('/book/create') }}">
			<div class="circle">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</div>
			<label>Add Book</label>
		</a> -->
	</div>
</div>
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Get Started</button>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">EBOOK INFO</h4>
			</div>
			<div class="modal-body">
				<form action="{{ url('/book') }}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
					<label for="ebook">E-Book Title</label>
						<input type="text" class="form-control" id="ebook" name="ebooktitle" required="required" placeholder="E-Book title">
					</div>
					<div class="form-group">
						<label for="subtitle">Sub Title</label>
						<input type="text" class="form-control" id="subtitle" name="subtitle" required="required" placeholder="Sub title">
					</div>
					<div class="form-group">
						<label for="type">Type</label>
						<select class="form-control" name="type" id="type">
							<option value="paid">Paid</option>
							<option value="free">Free</option>
						</select>
					</div>
					<div class="form-group">
						<label for="category">Category</label>
						<select class="form-control" id="category" name="category">
							@foreach($categories as $item)
								<option value="{{ $item->category_slug }}">{{ $item->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="desc">Description</label>
						<textarea id="desc" name="desc" class="form-control">Enter Description...</textarea>
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection