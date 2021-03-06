@extends('layouts.admin') @section('content')
<form action="{{ url('/book/'.$book->id) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('PATCH') }} {{ csrf_field() }}
    <div class="admin-edit">
        <div class="edit-three">
            @if ($book->ebook_logo)
            <div class="image">
                @if(substr($book->ebook_logo, 0, 4) == "http")
                    <img src="{{ $book->ebook_logo }}" width="180px" />
                @else
                    <img src="/uploads/ebook_logo/{{ $book->ebook_logo }}" width="180px" />
                @endif
            </div>
            <div class="button">
                <input type="button" value="CHANGE COVER" onclick="document.getElementById('fileInput').click();">
                <input type="file" id="fileInput" name="ebook_logo" style="display: none;">
            </div>
            @endif
        </div>
        <div class="edit-two">
            <div class="unit-1">
                <div class="form-unit">
                    <div class="heading">eBook Type</div>
                    <div class="content">
                        <input type="text" name="type" value="{{ucwords($book->type)}}" disabled="disabled">
                    </div>
                </div>
            </div>
            <div class="unit-2">
                <div class="form-unit">
                    <div class="heading">Author</div>
                    <div class="content">
                        <select class="js-example-basic-single" id="author" name="author">
                            <?php
                            $b = $book->author;
                            $authors = DB::select("select * from users where id='$b'");
                            foreach ($authors as $sKey => $author){
                            ?>
                            <option value="<?php echo $author->id; ?>" selected="selected"><?php echo $author->name; ?></option>
                            <?php } ?>
                                <?php
                                $b = $book->author;
                                $authors = DB::select("select * from users where id !='$b'");
                                foreach ($authors as $sKey => $author){
                                ?>
                                <option value="<?php echo $author->id; ?>"><?php echo $author->name; ?></option>
                                <?php } ?>
                        </select>
                       <!-- <input type="text" name="author" id="author" class="form-control" value="{{$book->author}}"/>-->
                    </div>
                </div>
            </div>
            <div class="unit-1">
                <div class="form-unit">
                    <div class="heading">Category</div>
                    <div class="content">
                        <select name="category" id="ebookcategory" data-select2-id="ebookcategory" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true" required onchange="selectSubCat(this)">
                            @foreach($categories as $item) @if($item->id === $book->category)
                            <option value="{{ $item->id }}" selected="selected">{{ $item->name }}</option>
                            @else
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endif @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="unit-2">
            <div class="form-unit">
                <div class="heading">Sub Category</div>
                <div class="content">
                    <select class="js-example-basic-single book-sub-category" id="sub_category" name="sub_category">
                        <option value="">Select Subcategory</option>
                        @if($subcategories)
                        @foreach($subcategories as $item) @if($item->id === $book->sub_category)
                            <option value="{{ $item->id }}" selected="selected">{{ $item->name }}</option>
                        @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
            <div class="unit-1">
                <div class="form-unit">
                    <div class="heading">eBook Title</div>
                    <div class="content">
                        <input type="text" id="ebook" name="ebooktitle" required="required" placeholder="E-Book title" value="{{$book->ebooktitle}}">
                    </div>
                </div>
            </div>
            <div class="unit-2">
                <div class="form-unit">
                    <div class="heading">Sub Title</div>
                    <div class="content">
                        <input type="text" id="subtitle" name="subtitle" required="required" placeholder="Free e-Book" value="{{$book->subtitle}}">
                    </div>
                </div>
            </div>
            
            <div class="unit-3">
                <div class="form-unit">
                    <div class="heading">Description</div>
                    <div class="content">
                        <textarea id="desc" name="desc" placeholder="Enter Description...">{{$book->desc}}</textarea>
                    </div>
                </div>
            </div>
            <div class="unit-1">
                <div class="form-unit">
                    <div class="heading">Print Pages</div>
                    <div class="content">
                        <input type="number" name="print_page" id="printPages" min="1" placeholder="Print Pages" value="{{$book->pageCount}}">
                    </div>
                </div>
            </div>
            <div class="unit-2">
                <div class="form-unit">
                    <div class="heading">Publisher</div>
                    <div class="content">
                        <input type="text" name="publisher" id="publish" class="form-control" value="@if($book->publisher) {{$book->publisher}} @else {{$username}} @endif"/>
                    </div>
                </div>
            </div>
            <div class="unit-1">
                <div class="form-unit">
                    <div class="heading">Publication Date</div>
                    <div class="content">
                        <input type="text" name="created_at" class="docs-date" id="publishDate" value="{{$book->publisher_date}}">
                    </div>
                </div>
            </div>
            <div class="unit-2">

                <div class="form-unit">
                    <div class="heading">Price</div>
                    <div class="content">
                        <input type="text" name="retailPrice" class="form-control" id="retailPrice" value="{{$book->retailPrice}}">
                    </div>
                </div>
            </div>
            <div class="unit-3">
                <div class="form-unit">
                    <div class="heading">ISBN</div>
                    <div class="content">
                        <input type="text" name="asin" id="asin" value="{{$book->asin}}">
                    </div>
                </div>
            </div>
            <div class="unit-1">
                <div class="form-unit">
                    <div class="heading">eBook Status Type</div>
                    <div class="content">
                        <select id="status" name="status" data-select2-id="ebooktype" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
                            <option value="0" @if($book->status == 0) selected="selected" @endif>Inactive</option>
                            <option value="1" @if($book->status == 1) selected="selected" @endif>Active</option>
                            <option value="2" @if($book->status == 2) selected="selected" @endif>Publish</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="unit-1">
                <div class="form-unit">
                    <div class="heading">Featured Book</div>
                    <div class="content">
                        <select id="status" name="is_featured" data-select2-id="ebooktype" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
                            <option value="0" @if($book->is_featured == 0) selected="selected" @endif>No</option>
                            <option value="1" @if($book->is_featured == 1) selected="selected" @endif>Yes</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="save-cancel-btn edit" style="display: none;">
        <div class="save">
            <input type="submit" value="Save" id="editBookBtn" />
        </div>
        <div class="cancel">
            <label>Cancel</label>
        </div>
    </div>    
</form>
@if($book->type == 'paid')
<div class="book-compare-price">
    <div class="heading">Store</div>
    <div class="add-section"  data-toggle="modal" data-target="#storeModal"><img src="/images/plus-icon.png" alt=""/> <span>ADD STORE<span></div>
    <div class="row-compare-one">
        <div class="unit-compare">Store</div>
        <div class="unit-compare">Rating</div>
        <div class="unit-compare">Availability</div>
        <div class="unit-compare">Price</div>
     </div>
    @foreach($paid as $val) 
    <div class="row-compare-one sec-two">
        <div class="unit-compare-sec">
            <div class="image-box">
                @if($val->store_logo)
                <img src="/uploads/storeimage/{{ $val->store_logo }}" width="100%" alt="image" />
                @else
                <img src="{{ $book->ebook_logo }}" width="100%" style="height:100%; padding:0px" alt="image" />
                @endif
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
            <div class="price">{{ $val->price }}</div>
        </div>
        <div class="unit-compare-delete">
            <form method="POST" action="{{ url('/paid' . '/' . $val->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }} {{ csrf_field() }}
                <div class="delete" data-toggle='modal' data-target='#confirmDelete' data-title='Delete Store' data-message='Are you sure you want to delete this Store ?'><i class="far fa-trash-alt"></i></div>
            </form>
        </div>
    </div>
    @endforeach
</div>
<div class="book-compare-price">
    <div class="heading">Discount</div>
    <div class="add-section" data-toggle="modal" data-target="#discountModal"><img src="/images/plus-icon.png" alt=""/> <span>ADD DISCOUNT</span></div>
    @foreach($paidDiscount as $val)
    <div class="row-compare-one sec-two">
        <div class="unit-compare-sec">
            <div class="image-box">
                @if($val->store_logo)
                <img src="/uploads/storeimage/{{ $val->store_logo }}" width="100%" alt="image" />
                @else
                <img src="{{ $book->ebook_logo }}" width="100%" style="height:100%; padding:0px" alt="image" />
                @endif
            </div>
        </div>
        <div class="unit-compare-sec-three">
            <div class="heading">{{ $val->discount }} % OFF & Free shipping</div>
            <div class="content">{{ $val->desc }}</div>
        </div>
        <div class="unit-compare-delete">
            <form method="POST" action="{{ url('/paid/deleteDiscount' . '/' . $val->id) }}" accept-charset="UTF-8" style="display:inline">
                <!-- {{ method_field('DELETE') }} -->
                {{ csrf_field() }}
                <div class="delete" data-toggle='modal' data-target='#confirmDelete' data-title='Delete Discount' data-message='Are you sure you want to delete this discount ?'><i class="far fa-trash-alt"></i></div>
            </form>
        </div>
    </div>
    @endforeach
</div>
<!-- Modal -->
<div id="storeModal" class="modal fade createbook-Modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-text">Add Store</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="ample-login-signup">
                    <div class="ample-login-section">
                        <form action="{{ url('/paid') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <!-- <div class="unit-compare-sec">
                                <div class="image-box">
                                    <img src="/uploads/storeimage/amaz.png" alt="amazon">
                                </div>
                            </div> -->
                            <div class="button-paid-book"><input type="submit" value="CHANGE LOGO" onclick="document.getElementById('fileInputStore').click();"></div>
                            <input type="file" id="fileInputStore" name="store_logo" style="display: none;">
                            <div class="form-group">
                                <div class="heading">STORE NAME</div>
                                <input type="text" name="store_name" id="store_name" required="required" placeholder="Enter store name">
                            </div>
                            <div class="unit1">
                                <div class="form-group">
                                    <div class="heading">PRICE</div>
                                    <input type="number" name="price" min="0" id="price"/>
                                </div>
                            </div>
                            <div class="unit2">
                                <div class="form-group">
                                    <div class="heading">LINK</div>
                                    <input type="url" id="link" name="link" required="required" placeholder="Enter URL"/>
                                </div>
                            </div>
                            <div class="unit1">
                                <div class="form-group">
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="submit-button">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer no-border">
            </div>
        </div>
    </div>
</div>
<div id="discountModal" class="modal fade createbook-Modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-text">Add/EDIT DISCOUNT</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="ample-login-signup">
                    <div class="ample-login-section">
                        <form action="{{ url('/paid/discountSave') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="unit1 first-sec">
                                <div class="form-group">
                                    <div class="heading">STORE</div>
                                    <select class="form-control" name="paid_ebook_id" id="store">
                                        @foreach($paid as $val)
                                        <option value="{{ $val->id }}">{{ $val->store_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="unit2 second-sec">
                                <div class="form-group">
                                    <div class="heading">DISCOUNT</div>
                                    <input type="number" name="discount" min="1" id="discount" placeholder="Discount %" required="required"/>
                                </div>
                            </div>
                            <div class="unit1 first-sec">
                                <div class="form-group">
                                    <div class="heading">Additional Options</div>
                                    <select id="addOption" name="additional_options" class="form-control">
                                        <option value="free_shipping">Free Shipping</option>
                                        <option value="paid">Online Code</option><option value="online_sale">Online Sale</option>
                                    </select>
                                </div>
                            </div>
                            <div class="unit1 first-sec" id="cc" style="width:15%;">
                                <div class="form-group">
                                    <div class="heading">Coupon Code</div>
                                    <input type="text" name="coupon" >
                                </div>
                            </div>
                            <div class="unit3">
                                <div class="form-group">
                                    <div class="heading">DESCRIPTION</div>
                                    <textarea id="desc" name="desc" placeholder="Enter Description" required="required" style="margin-top: 10px;"></textarea>
                                </div>
                            </div>
                            <div class="unit1">
                                <div class="form-group">
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="submit-button">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer no-border">
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
@foreach($paid as $val)
<div id="storeEditModal-{{$val->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">EDIT LINK</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('/paid/'.$val->id) }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PATCH') }} {{ csrf_field() }}
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="url" name="link" class="form-control" required="required" value="{{$val->link}}">
                    </div>
                    <button type="submit" class="btn btn-default">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	var $date = $('#publishDate');
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
<script>
    $(document).ready(function() {
        $("#cc").hide();
        $('select[name="additional_options"]').change(function () {
            if ($(this).val() == "paid") {
                $("#cc").show();
            }else if ($(this).val() == "free_shipping") {
                $("#cc").hide();
            }else if ($(this).val() == "online_sale") {
                $("#cc").hide();
            }
        });
    });
</script>
@endforeach 
@include('modals.modal-delete') 
@endif 
<div class="save-cancel-btn edit">
    <div class="save">
        <input type="button" id="submitEditFormBtn" value="Save"/>
    </div>
    <div class="cancel">
        <label>Cancel</label>
    </div>
</div>
@endsection 

@section('footer_scripts') @include('scripts.delete-modal-script') @endsection
