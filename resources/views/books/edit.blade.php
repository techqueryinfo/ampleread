@extends('layouts.admin')
@section('content')
	<h3>Edit Page</h3>
	<div class="col-md-4">
	@if ($book->ebook_logo)
		<img src="/uploads/ebook_logo/{{ $book->ebook_logo }}" width="180px"/><br>
	@endif
	</div>
	<div class="col-md-8">
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
			<label for="ebookimage">Image</label>
			<input type="file" name="ebook_logo"><br/>
			@if($book->type == 'paid')
			<div class="col-md-6">
				<div class="form-group">
					<label for="printPages">Print Pages</label>
					<input type="number" name="print_page" class="form-control" id="printPages" min="1">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="publish">Publisher</label>
					<input type="text" name="publisher" id="publish" class="form-control">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="publishDate">Publish Date</label>
					<input type="date" name="publish_date" class="form-control" id="publishDate">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="lang">Language</label>
					<input type="text" name="language" class="form-control" id="lang" min="1">
				</div>
			</div>
			<div class="form-group">
				<label  for="asin">ASIN</label>
				<input type="text" name="asin" id="asin" class="form-control">
			</div>
			@endif
			<button type="submit" class="btn btn-default">Update</button>
		</form>
	</div>
@if($book->type == 'paid')
	<div class="col-md-12">
		<div class="sorting-section">
			<div class="sorting-left">
				<h4>STORES</h4>
			</div>
			<div class="sorting-right" style="width: 100px !important;">
				<a href="#" data-toggle="modal" data-target="#storeModal">
					<div class="circle">
						<i class="fa fa-plus" aria-hidden="true"></i>
					</div>
					<label>Add Store</label>
				</a>
			</div>
		</div>
		<div class="container">        
			<table class="table">
				<thead>
					<tr>
						<th>STORE</th>
						<th>RATING</th>
						<th>AVAILABILITY</th>
						<th>PRICE</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($paid as $val)
					<tr>
						<td>{{ $val->store_name }}</td>
						<td>
							<img src="/uploads/storeimage/{{ $val->store_logo }}" width="50px">
						</td>
						<td></td>
						<td>{{ $val->price }}</td>
						<td>
							<div class="edit">
								<a href="#" title="Edit Store" data-toggle="modal" data-target="#storeEditModal-{{$val->id}}">
									<i class="fas fa-pencil-alt"></i>
								</a>
							</div>
							<form method="POST" action="{{ url('/paid' . '/' . $val->id) }}" accept-charset="UTF-8" style="display:inline">
								{{ method_field('DELETE') }}
								{{ csrf_field() }}
								<div class="delete" data-toggle = 'modal' data-target = '#confirmDelete' data-title = 'Delete Store' data-message = 'Are you sure you want to delete this Store ?'><i class="far fa-trash-alt"></i></div>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-12">
		<div class="sorting-section">
			<div class="sorting-left">
				<h4>DISCOUNTS</h4>
			</div>
			<div class="sorting-right" style="width: 100px !important;">
				<a href="#" data-toggle="modal" data-target="#discountModal">
					<div class="circle">
						<i class="fa fa-plus" aria-hidden="true"></i>
					</div>
					<label>Add Discount</label>
				</a>
			</div>
		</div>
	</div>
<!-- Modal -->
<div id="storeModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Store</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('/paid') }}" method="POST" enctype="multipart/form-data">
        	{{ csrf_field() }}
        	<div class="form-group">
				<input type="file" id="img" name="store_logo">
			</div>
			<div class="form-group">
				<label for="store_name">Store Name</label>
				<input type="text" name="store_name" class="form-control" id="store_name" required="required" placeholder="Enter store name">
			</div>
			<div class="form-group">
				<label for="link">Link</label>
				<input type="url" class="form-control" id="link" name="link" required="required" placeholder="Enter URL">
			</div>
			<div class="form-group">
				<label for="price">Price</label>
				<input type="number" name="price" class="form-control" min="0" id="price">
			</div>
			<!-- <div class="form-group">
				<label for="discount">Discount</label>
				<input type="number" name="discount" class="form-control" min="0" id="discount">
			</div> -->
			<input type="hidden" name="book_id" value="{{ $book->id }}">
			<button type="submit" class="btn btn-default">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="discountModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT DISCOUNT</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('/paid/discountSave') }}" method="POST" enctype="multipart/form-data">
        	{{ csrf_field() }}
        	<div class="form-group">
        		<label for="store">Store</label>
        		<select class="form-control" name="store_name" id="store">
        			@foreach($paid as $val)
        				<option value="{{ $val->store_name }}">{{ $val->store_name }}</option>
        			@endforeach
        		</select>
        	</div>
        	<div class="form-group">
				<label for="discount">Discount</label>
				<input type="number" name="discount" class="form-control" min="1" id="discount" placeholder="Enter Discount %" required="required">
			</div>
        	<div class="form-group">
        		<label for="addOption">Additional Options</label>
        		<select id="addOption" name="additional_options" class="form-control">
        			<option value="free_shipping">Free Shipping</option>
        			<option value="paid">Paid</option>
        		</select>
        	</div>
        	<div class="form-group">
        		<label for="desc">Description</label>
        		<textarea id="desc" class="form-control" name="desc" placeholder="Enter Description" required="required"></textarea>
        	</div>
        	<input type="hidden" name="book_id" value="{{ $book->id }}">
			<button type="submit" class="btn btn-default">Save</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        	{{ method_field('PATCH') }}
			{{ csrf_field() }}
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
@endforeach
@include('modals.modal-delete')
@endif
@endsection
@section('footer_scripts')
    @include('scripts.delete-modal-script')
@endsection