@extends('layouts.admin') @section('content')
<!-- admin edit page -->
<form action="{{ url('/book/upload') }}" method="POST" enctype="multipart/form-data">
<div class="admin-edit">{{ csrf_field() }}
	<div class="edit-three">
		<div class="image">
			<img src="../images/image1.jpg" />
		</div>
		<div class="button">
			<input type="submit" value="UPLOAD COVER" onclick="document.getElementById('uploadCover').click();"/>
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
					<input type="hidden" name="status" value="1"/>
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
					<select id="ebookauthor">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
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
					<input type="text" placeholder="Print Pages">
				</div>
			</div>
		</div>
		<div class="unit-2">
			<div class="form-unit">
				<div class="heading">Publisher</div>
				<div class="content">
					<input type="text" placeholder="Publisher">
				</div>
			</div>
		</div>
		<div class="unit-1">
			<div class="form-unit">
				<div class="heading">Publication Date</div>
				<div class="content">
					<input type="text" placeholder="Publication Date">
				</div>
			</div>
		</div>
		<div class="unit-2">
			<div class="form-unit">
				<div class="heading">Publication Date</div>
				<div class="content">
					<input type="text" placeholder="Publication Date">
				</div>
			</div>
		</div>
		<div class="unit-3">
			<div class="form-unit">
				<div class="heading">ASIN</div>
				<div class="content">
					<input type="text" placeholder="ASIN">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="book-compare-price inactive">
    <div class="heading">Store</div>
    <div class="add-section"><img src="../images/plus-icon.png" alt=""/> <span>ADD STORE<span></div>
    <div class="row-compare-one">
        <div class="unit-compare">Store</div>
        <div class="unit-compare">Rating</div>
        <div class="unit-compare">Availability</div>
        <div class="unit-compare">Price</div>
     </div>
    <div class="row-compare-one sec-two">
        <div class="unit-compare-sec">
            <div class="image-box">
                <img src="../images/amaz.png" alt="amazon"/>
            </div>
        </div>
        <div class="unit-compare-sec">
            <div class="star-container">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
            </div>
        </div>
        <div class="unit-compare-sec">
            <div class="stock">In Stock</div>
            <div class="days">Free shipping 5 - 7 days</div>
        </div>
        <div class="unit-compare-sec">
            <div class="price">$14.99</div>
        </div>
        <div class="unit-compare-delete"><i class="fas fa-pencil-alt" data-toggle="modal" data-target="#createbookModal"></i><i class="far fa-trash-alt"></i></div>
    </div>
</div>
<div class="book-compare-price inactive">
    <div class="heading">Discount</div>
    <div class="add-section"><img src="../images/plus-icon.png" alt=""/> <span>ADD DISCOUNT</span></div>
    <div class="row-compare-one sec-two">
        <div class="unit-compare-sec">
            <div class="image-box">
                <img src="../images/amaz.png" alt="amazon"/>
            </div>
        </div>
        <div class="unit-compare-sec-three">
            <div class="heading">20% OFF & Free shipping</div>
            <div class="content">92 uses today</div>
        </div>
        <div class="unit-compare-delete"><i class="fas fa-pencil-alt" data-toggle="modal" data-target="#editDiscount"></i><i class="far fa-trash-alt"></i></div>
    </div>
</div>
<div class="save-cancel-btn edit">
	<div class="save">
		<input type="submit" value="Save" />
	</div>
	<div class="cancel">
		<label>Cancel</label>
	</div>
</div>
</form>
@endsection
@section('footer_scripts')
<script type="text/javascript">
	$("#uploadBook").on("change",function(){
        resizemenu();
        var index=$("#uploadBook option:selected").index();
        if(index==0){
             $(".book-compare-price").addClass("inactive");
             $(".button.upload-book").removeClass("inactive");
        }
        if(index==1){
            $(".book-compare-price").removeClass("inactive");
            $(".button.upload-book").addClass("inactive");
        }
    });
</script>
@endsection