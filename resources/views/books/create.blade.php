@extends('layouts.app')
@section('template_fastload_css')
@endsection
@section('content')
<div class="ample-slider">
	<div id="myCarousel" class="carousel slide sign-slider" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>
		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<div class="item active">
				<div class="ample-signin-banner">
					<div class="ample-banner-right">
						<div class="ample-banner-heading">The Girl on the Train</div>
						<div class="ample-banner-subheading">The #1 New York Times Bestseller, USA Today Book
							of the Year, now a major motion picture starring Emily Blunt.
							Don't miss Paula Hawkins' new novel, Into the Water,
							coming May 2017.</div>
							<div class="ample-banner-button">
								<!-- Trigger the modal with a button -->
								<button type="button" data-toggle="modal" data-target="#eBookModal">Get Started</button>
								<div class="add-library">
									<img src="/images/plus.png" src="plus">
									<span>Create an E-Book</span>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="item">
					<div class="ample-signin-banner">
						<div class="ample-banner-right">
							<div class="ample-banner-heading">The Girl on the Train</div>
							<div class="ample-banner-subheading">The #1 New York Times Bestseller, USA Today Book
								of the Year, now a major motion picture starring Emily Blunt.
								Don't miss Paula Hawkins' new novel, Into the Water,
								coming May 2017.</div>
								<div class="ample-banner-button">
									<!-- Trigger the modal with a button -->
									<button type="button" data-toggle="modal" data-target="#eBookModal">Get Started</button>
									<div class="add-library">
										<img src="/images/plus.png" src="plus">
										<span>Create an E-Book</span>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="item">
						<div class="ample-signin-banner">
							<div class="ample-banner-right">
								<div class="ample-banner-heading">The Girl on the Train</div>
								<div class="ample-banner-subheading">The #1 New York Times Bestseller, USA Today Book
									of the Year, now a major motion picture starring Emily Blunt.
									Don't miss Paula Hawkins' new novel, Into the Water,
									coming May 2017.</div>
									<div class="ample-banner-button">
										<!-- Trigger the modal with a button -->
										<button type="button" data-toggle="modal" data-target="#eBookModal">Get Started</button>
										<div class="add-library">
											<img src="/images/plus.png" src="plus">
											<span>Create an E-Book</span>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
						<!--<span class="glyphicon glyphicon-chevron-left"></span>-->
						<i class="fas fa-chevron-left"></i>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
						<!--<span class="glyphicon glyphicon-chevron-right"></span>-->
						<i class="fas fa-chevron-right"></i>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
<div class="ample-signin-manage"></div>			
<!-- Modal -->
<div id="eBookModal" class="modal fade" role="dialog">
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
						<input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
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
						<textarea id="desc" name="desc" class="form-control" placeholder="Enter Description..." required="required"></textarea>
					</div>
					<label for="ebookimage">Image</label>
					<input type="file" name="ebook_logo"><br/>
					@if ($item->ebook_logo)
				    <div class="col-md-2">
				    	<img src="/uploads/ebook_logo/{{ $setting->ebook_logo }}" width="80px"/>
				    </div>
				    @endif
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div><br>
@endsection
@section('footer_scripts')
@endsection