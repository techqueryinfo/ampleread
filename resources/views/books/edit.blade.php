@extends('layouts.admin')
@section('content')
	<h3>Edit Page</h3>
	<div class="container">
		<form action="{{ url('/book/'.$book->id) }}" method="POST" enctype="multipart/form-data">
			{{ method_field('PATCH') }}
			{{ csrf_field() }}
			<div class="form-group">
				<label for="ebook">E-Book Title</label>
				<input type="text" class="form-control" id="ebook" name="ebooktitle" required="required" placeholder="E-Book title" value="{{$book->ebooktitle}}">
			</div>
			<div class="form-group">
				<label for="subtitle">Sub Title</label>
				<input type="text" class="form-control" id="subtitle" name="subtitle" required="required" placeholder="Sub title" value="{{$book->subtitle}}">
			</div>
			<div class="form-group">
				<label for="type">Type</label>
				<select class="form-control" name="type" id="type">
					@if($book->type == 'paid')
						<option value="paid" selected="selected">Paid</option>
						<option value="free">Free</option>
					@else
						<option value="paid">Paid</option>
						<option value="free" selected="selected">Free</option>
					@endif
				</select>
			</div>
			<div class="form-group">
				<label for="category">Category</label>
				<select class="form-control" id="category" name="category">
					@foreach($categories as $item)
						@if($item->category_slug === $book->category)
							<option value="{{ $item->category_slug }}" selected="selected">{{ $item->name }}</option>
						@else
							<option value="{{ $item->category_slug }}">{{ $item->name }}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="desc">Description</label>
				<textarea id="desc" name="desc" class="form-control" value="{{$book->desc}}">Enter Description...</textarea>
			</div>
			<button type="submit" class="btn btn-default">Update</button>
		</form>
	</div>
@endsection