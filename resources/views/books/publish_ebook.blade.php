@extends('layouts.app') @section('template_fastload_css') @endsection @section('content')
<form action="{{ url('/book/upload') }}" method="POST" enctype="multipart/form-data">{{ csrf_field() }}
	<div class="upload-book">
		<div class="heading-upload">Publish eBook</div>
		<div class="upload-book">
			<div class="content">
				<img src="/images/plus2.png" alt="plus-icon" /> <span style="cursor: pointer;" onclick="document.getElementById('uploadEbook').click();">Upload Book</span>
				<input id="uploadEbook" type="file" name="file_name" accept="pdf/*" style="display: none;"/>
			</div>
		</div>
		<div class="upload-form">
			<div class="form-left">
				<div class="unit-3">
					<div class="form-unit">
						<div class="heading">Publisher</div>
						<div class="content">
							<input type="text" name="publisher" id="publish" class="form-control"  placeholder="Publisher"/>
						</div>
					</div>
				</div>
				<div class="units">
					<div class="unit-1">
						<div class="form-unit">
							<div class="heading">eBook Title</div>
							<div class="content">
								<input type="text" id="ebook" name="ebooktitle" required="required" placeholder="eBook Title" />
							</div>
						</div>
					</div>
					<div class="unit-2">
						<div class="form-unit">
							<div class="heading">Sub Title</div>
							<div class="content">
								<input type="text" id="subtitle" name="subtitle" required="required" placeholder="Sub title" />
							</div>
						</div>
					</div>
				</div>
				<div class="units">
					<div class="unit-1">
						<div class="form-unit">
							<div class="heading">Author</div>
							<div class="content">
								<input type="text" name="author" id="author" class="form-control" placeholder="Author" />
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
										<option value="{{$item->id}}">{{$item->name}}</option>
										@endforeach
									@endif
                                </select>
                                <input type="hidden" name="status" value="0"/>
							</div>
						</div>
					</div>
				</div>
				<div class="unit-3">
					<div class="form-unit">
						<div class="heading">Description</div>
						<div class="content">
							<textarea name="desc" rows="5" id="comment" placeholder="Enter Description..." required="required"></textarea>
						</div>
					</div>
				</div>
				<div class="unit-3 submit-button">
					<input type="submit" value="Publish eBook"/>
				</div>
			</div>
			<div class="form-right">
				<div class="image-container">
					<img src="/images/cs.png" />
				</div>
				<div class="upload-button">
					<input type="submit" value="UPLOAD COVER" onclick="document.getElementById('uploadCover').click();"/>
					<input id="uploadCover" type="file" name="ebook_logo" accept="image/*" style="display: none;"/>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection @section('footer_scripts')<link rel="stylesheet" href="/css/uploadbook.css"> @endsection