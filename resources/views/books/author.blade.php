@extends('layouts.app')
@section('free-book-css')
<link rel="stylesheet" href="/css/free-book.css"> @endsection
@section('content')
<div class="free-ebook">
	<div class="page-path"> <span class="start-text">Authors | </span><span class="end-text">{{$author->name}}</span>
	</div>
	<div class="book-section author">
		<div class="book">
			<img src="/images/image10.jpg" alt="image1">
		</div>
		<div class="content">
			<div class="heading-book">{{$author->name}}</div>
			<div class="book-details">
				<div class="star-container"> 
					<div class='rating-stars' style="margin: 0 0 0 -40px;">
                        <ul id='starss'>
                            <li class="star @if($author_review_star >= 1) selected @endif" title='Poor' data-value='1'>
                               <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class="star @if($author_review_star >= 2) selected @endif" title='Fair' data-value='2'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class="star @if($author_review_star >= 3) selected @endif" title='Good' data-value='3'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class="star @if($author_review_star >= 4) selected @endif" title='Excellent' data-value='4'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class="star @if($author_review_star >= 5) selected @endif" title='WOW!!!' data-value='5'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                        </ul>
                    </div>
				</div>
			</div>
			<div class="book-description">{{$author->about_us}}</div>
		</div>
	</div>
	<div class="ample-book-slot-slider">
		<div class="owl-carousel owl-theme home-slider">
			@foreach($related_book as $val)
			<div class="item">
				<div class="image"><a href="{{url('books/ebook/'.$val->id.'/'.$val->ebooktitle)}}">
                    @if(substr($val->ebook_logo, 0, 4) == "http")
                        <img src="{{ $val->ebook_logo }}" alt="image1"/>
                    @else
                        <img src="/uploads/ebook_logo/{{ $val->ebook_logo }}" alt="image1" />
                    @endif
                </a></div>
				<div class="ample-button">
					@if($val->type == 'free')
                        <button>FREE</button>
                    @else
                        <button style="width: auto; background-color: #868686; border: #868686;">FROM $ {{$val->retailPrice}}</button>
                    @endif
				</div>
				<div class="title">{{$val->ebooktitle}}: {{$val->subtitle}}</div>
				<div class="writer">{{$val->subtitle}}</div>
				<div class="star-container"> <span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star"></span>
					<span class="fa fa-star"></span>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<div class="sign-in-page-bar bar-extend"></div>
	@if(!Auth::check())
	<div class="sign-in-review">
		<i class="fas fa-lock"></i>
		<span>Sign in to write a review</span>
	</div>
	@elseif(Auth::check() && empty($authorReview) && Auth::user()->id != $author->id)
		<div class="rate-this-book">
			<div class="left-sec">
				<div class="heading">Rate this book</div>
				<div class='rating-stars text-center'>
					<ul id='stars'>
						<li class='star' title='Poor' data-value='1'>
							<i class='fa fa-star fa-fw'></i>
						</li>
						<li class='star' title='Fair' data-value='2'>
							<i class='fa fa-star fa-fw'></i>
						</li>
						<li class='star' title='Good' data-value='3'>
							<i class='fa fa-star fa-fw'></i>
						</li>
						<li class='star' title='Excellent' data-value='4'>
							<i class='fa fa-star fa-fw'></i>
						</li>
						<li class='star' title='WOW!!!' data-value='5'>
							<i class='fa fa-star fa-fw'></i>
						</li>
					</ul>
				</div>
				<div class='success-box'>
					<div class='clearfix'></div>
					<div class='text-message'></div>
					<div class='clearfix'></div>
				</div>
			</div>
			<div class="right-sec">
				<div class="heading">Rate this Author</div>
				<form method="POST" enctype="multipart/form-data" action="{{ url('/book/author_review') }}" onsubmit="return validateForm()">
					{{ csrf_field() }}
					<textarea name="review_content" placeholder="Write your review about author !!"></textarea>
					<input type="hidden" name="book_id" value="{{$book->id}}">
					<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
					<input type="hidden" name="author_id" value="{{$author->id}}">
					<input type="hidden" name="star" id="star_value" />
					<button type="submit">Submit review</button>       
				</form>
			</div>
		</div>
		@elseif(Auth::user()->id == $author->id)
		<div class="sign-in-review">
			<i class="fas fa-lock"></i>
			<span>You cannot write review for yourself !</span>
		</div>
		@elseif(!empty($authorReview))
		<div class="sign-in-review">
			<i class="fas fa-lock"></i>
			<span>Already, You have given review for this author.</span>
		</div>
		@endif
	@if(!$author_reviews->isEmpty())    
    <div class="sign-in-panel">
        <div class="heading">{{$author_review_count}} reviews</div>
        @foreach($author_reviews as $val)
        <div class="review-container">
            <div class="left">
                <div class="author-details">
                    <div class="image">
                        <img src="/images/user.png" alt="autor-image">
                    </div>
                    <div class="name">
                        <div class="title">{{ucwords($val->first_name)}} {{ucwords($val->last_name)}}</div>
                        <div class="sub-title">User</div>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="star-container">
                    <div class='rating-stars' style="margin: 0 0 0 -50px;">
                        <ul id='starss'>
                            <li class="star @if($val->star >= 1) selected @endif" title='Poor' data-value='1'>
                               <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class="star @if($val->star >= 2) selected @endif" title='Fair' data-value='2'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class="star @if($val->star >= 3) selected @endif" title='Good' data-value='3'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class="star @if($val->star >= 4) selected @endif" title='Excellent' data-value='4'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class="star @if($val->star >= 5) selected @endif" title='WOW!!!' data-value='5'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="author-des">{{$val->review_content}}</div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection @section('footer_scripts') 
<style type="text/css">
.rating-stars ul > li.star {
    display: inline-block;
}
/* Idle State of the stars */
.rating-stars ul > li.star > i.fa {
    font-size: 1em;
    /* Change the size of the stars */
    color: #ccc;
    /* Color on idle state */
}
/* Hover state of the stars */
.rating-stars ul > li.star.hover > i.fa {
    color: #FFCC36;
}
/* Selected state of the stars */
.rating-stars ul > li.star.selected > i.fa {
    color: #FF912C;
}
</style>
<script type="text/javascript">
$(document).ready(function () {
    /* 1. Visualizing things on Hover - See next part for action on click */
    $('#stars li').on('mouseover', function () {
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function (e) {
            if (e < onStar) {
                $(this).addClass('hover');
            } else {
                $(this).removeClass('hover');
            }
        });
    }).on('mouseout', function () {
        $(this).parent().children('li.star').each(function (e) {
            $(this).removeClass('hover');
        });
    });
    /* 2. Action to perform on click */
    $('#stars li').on('click', function () {
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');
        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }
        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }
        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        var msg = "";
        if (ratingValue > 1) {
            msg = "Thanks! You rated this " + ratingValue + " stars.";
        } else {
            msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
        }
        $('#star_value').val(ratingValue);
        responseMessage(msg);
    });
});
function responseMessage(msg) {
    $('.success-box').fadeIn(200);
    $('.success-box div.text-message').html("<span>" + msg + "</span>");
}
function validateForm() 
{
    var x = $('#star_value').val();
    if (x == "") {
        alert("Select the rating !");
        return false;
    }
}
</script>
@endsection