@extends('layouts.app') @section('template_fastload_css') @endsection @section('content')
<form action="{{ url('/book/'.$book->id) }}" method="POST" enctype="multipart/form-data">
	{{ method_field('PATCH') }} {{ csrf_field() }}
	<div class="upload-book">
		<div class="heading-upload">Edit eBook</div>
		<div class="upload-book">
			<div class="content">
			</div>
		</div>
		<div class="upload-form">
			<div class="form-left">
				<div class="unit-3">
					<div class="form-unit">
						<div class="heading">Publisher</div>
						<div class="content">
							<input type="text" name="publisher" id="publish" class="form-control"  placeholder="Publisher" value="@if($book->publisher) {{$book->publisher}} @else {{$username}} @endif" />
						</div>
					</div>
				</div>
				<div class="units">
					<div class="unit-1">
						<div class="form-unit">
							<div class="heading">eBook Title</div>
							<div class="content">
								<input type="text" id="ebook" name="ebooktitle" required="required" placeholder="eBook Title" value="{{$book->ebooktitle}}" />
							</div>
						</div>
					</div>
					<div class="unit-2">
						<div class="form-unit">
							<div class="heading">Sub Title</div>
							<div class="content">
								<input type="text" id="subtitle" name="subtitle" required="required" placeholder="Sub title"value="{{$book->subtitle}}" />
							</div>
						</div>
					</div>
				</div>
				<div class="units">
					<div class="unit-1">
						<div class="form-unit">
							<div class="heading">Author</div>
							<div class="content">
								<input type="text" name="author" id="author" class="form-control" placeholder="Author" value="{{$book->author}}" />
							</div>
						</div>
					</div>
					<div class="unit-2">
						<div class="form-unit">
							<div class="heading">Category</div>
							<div class="content">
								<select class="js-example-basic-single" id="category" name="category">
									@if(!$categories->isEmpty())
										@foreach($categories as $item)
										<option value="{{$item->id}}" @if($item->id == $book->category) selected="selected" @endif>{{$item->name}}</option>
										@endforeach
									@endif
                                </select>
                                <input type="hidden" name="status" value="0"/>
							</div>
						</div>
					</div>
					<div class="unit-2">
						<div class="form-unit">
							<div class="heading">Status</div>
							<div class="content">
								<select class="js-example-basic-single" id="status" name="status">
									<option value="1" @if($book->status === 1) selected="selected" @endif>Active</option>
									<option value="0" @if($book->status === 0) selected="selected" @endif>Inactive</option>
									<option value="0" @if($book->status === 2) selected="selected" @endif>Publish</option>
                                </select>
							</div>
						</div>
					</div>
				</div>
				<div class="unit-3">
					<div class="form-unit">
						<div class="heading">Description</div>
						<div class="content">
							<textarea name="desc" rows="10" id="comment" placeholder="Enter Description..." required="required">{{$book->desc}}</textarea>
						</div>
					</div>
				</div>
				<div class="unit-3 submit-button">
					<input type="submit" value="Update eBook"/>
				</div>
			</div>
			<div class="form-right">
				<div class="image-container">
					@if($book->ebook_logo)
						@if(substr($book->ebook_logo, 0, 4) == "http")
							<img src="{{ $book->ebook_logo }}" width="200px" style="margin-top: 0%; margin-left: 0%;" />
						@else
							<img src="/uploads/ebook_logo/{{ $book->ebook_logo }}" width="200px" style="margin-top: 0%; margin-left: 0%;"/>
						@endif
					@else
					<img src="/images/cs.png" />
					@endif
				</div>
				<div class="upload-button">
					<input type="submit" value="CHANGE COVER" onclick="document.getElementById('uploadCover').click();"/>
					<input id="uploadCover" type="file" name="ebook_logo" accept="image/*" style="display: none;"/>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection @section('footer_scripts')<link rel="stylesheet" href="/css/uploadbook.css"> @endsection