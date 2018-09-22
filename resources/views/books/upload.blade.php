@extends('layouts.admin') 
@section('angularjs')
<link rel="stylesheet" href="/css/datepicker.css"> 
@endsection
@section('content')
<!-- admin edit page -->
<form action="{{ url('/book/upload') }}" method="POST" enctype="multipart/form-data">
<div class="admin-edit">{{ csrf_field() }}
	<div class="edit-three">
		<div class="image">
			<img src="../images/image1.jpg" id="uploadbookImg" />
		</div>
		<div class="button">
			<input type="button" value="UPLOAD COVER" onclick="document.getElementById('uploadCover').click();"/>
			<input id="uploadCover" type="file" name="ebook_logo" accept="image/*" style="display: none;"/>
		</div>
		<div class="button upload-book">
			<input type="button" value="UPLOAD EBOOK" onclick="document.getElementById('uploadEbook').click();">
			<input id="uploadEbook" type="file" name="file_name" accept="pdf/*" style="display: none;"/>
		</div>
	</div>
	<div class="edit-two">
		<div class="unit-1">
			<div class="form-unit">
				<div class="heading">eBook Type</div>
				<div class="content">
					<select class="js-example-basic-single" name="type" id="uploadBook">
						<option value="free">Free</option>
						<option value="paid">Paid</option>
					</select>
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
							<option value="{{ $item->id }}">{{ $item->name }}</option>
							@endforeach
						@endif
					</select>
					<input type="hidden" name="status" value="2"/>
				</div>
			</div>
		</div>
		<div class="unit-3">
			<div class="form-unit">
				<div class="heading">eBook Title</div>
				<div class="content">
					<input type="text" id="ebook" name="ebooktitle" required="required" placeholder="eBook Title" />
					<input type="hidden" name="user_id" value="{{ Auth::user()->id}}" />
				</div>
			</div>
		</div>
		<div class="unit-1">
			<div class="form-unit">
				<div class="heading">Sub Title</div>
				<div class="content">
					<input type="text" id="subtitle" name="subtitle" required="required" placeholder="Sub title" />
				</div>
			</div>
		</div>
		<div class="unit-2">
			<div class="form-unit">
				<div class="heading">Author</div>
				<div class="content">
					<select class="js-example-basic-single" id="author" name="author">
						@if(!$authors->isEmpty())
							@foreach($authors as $author)
							@if($author->isUser())
							<option value="{{ $author->id }}">{{ ucfirst($author->name) }}</option>
							@endif
							@endforeach
						@endif
					</select>
					<!-- <input type="text" name="author" id="author" class="form-control" placeholder="Author" /> -->
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
		<div class="unit-1">
			<div class="form-unit">
				<div class="heading">Print Pages</div>
				<div class="content">
					<input type="number" name="pageCount" placeholder="Print Pages">
				</div>
			</div>
		</div>
		<div class="unit-2">
			<div class="form-unit">
				<div class="heading">Publisher</div>
				<div class="content">
					<input type="text" name="publisher" id="publish" class="form-control" placeholder="Publisher">
				</div>
			</div>
		</div>
		<div class="unit-1">
			<div class="form-unit">
				<div class="heading">Publication Date</div>
				<div class="content">
					<input type="text" name="publisher_date" class="docs-date" placeholder="Publication Date">
				</div>
			</div>
		</div>
		<div class="unit-2">
			<div class="form-unit">
				<div class="heading">Language</div>
				<div class="content">
					<input type="text" name="book_language" placeholder="Language">
				</div>
			</div>
		</div>
		<div class="unit-1">
			<div class="form-unit">
				<div class="heading">ASIN</div>
				<div class="content">
					<input type="text" name="asin" placeholder="ASIN">
				</div>
			</div>
		</div>
		<div class="unit-2 bookAmt" style="display: none;">
			<div class="form-unit">
				<div class="heading">Book Price</div>
				<div class="content">
					<input type="text" name="retailPrice" placeholder="Book Price">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="save-cancel-btn edit">
	<div class="save">
		<input type="submit" id="submitBtn" value="Save" />
	</div>
	<div class="cancel">
		<label>Cancel</label>
	</div>
</div>
</form>
@endsection
@section('footer_scripts')
<script type="text/javascript" src="/js/datepicker.js"></script>
<script type="text/javascript">
	var $date = $('.docs-date');
  // var $container = $('.docs-datepicker-container');
  // var $trigger = $('.docs-datepicker-trigger');
	  var options = {
	  	autoHide:true,
	  	format:'yyyy-mm-dd',
	    show: function (e) {
	      console.log(e.type, e.namespace);
	    },
	    hide: function (e) {
	      console.log(e.type, e.namespace);
	    },
	    pick: function (e) {
	      console.log(e.type, e.namespace, e.view);
	    }
	  };

	  $date.on({
	    'show.datepicker': function (e) {
	      console.log(e.type, e.namespace);
	    },
	    'hide.datepicker': function (e) {
	      console.log(e.type, e.namespace);
	    },
	    'pick.datepicker': function (e) {
	      console.log(e.type, e.namespace, e.view);
	    }
	  }).datepicker(options);

	function readURL(input) {

	  if (input.files && input.files[0]) {
	    var reader = new FileReader();

	    reader.onload = function(e) {
	    	// console.log('e.target.result', e.target.result);
	      $('#uploadbookImg').attr('src', e.target.result);
	    }

	    reader.readAsDataURL(input.files[0]);
	  }
	}

	$("#uploadCover").change(function() {
	  readURL(this);
	});

	$("#uploadBook").on("change",function(){
        resizemenu();
        var index=$("#uploadBook option:selected").index();
        if(index==0){
             $(".book-compare-price").addClass("inactive");
             $(".button.upload-book").removeClass("inactive");
             $('#submitBtn').val('Submit');
             $('.bookAmt').hide();
        }
        if(index==1){
            $(".book-compare-price").removeClass("inactive");
            $(".button.upload-book").addClass("inactive");
            $('#submitBtn').val('Next');
            $('.bookAmt').show();
        }
    });
</script>
@endsection