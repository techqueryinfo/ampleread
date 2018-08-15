@extends('layouts.app')
@section('free-book-css')
<link rel="stylesheet" href="/css/free-book.css"> @endsection
@section('content')
<div class="free-ebook">
	<div class="page-path"> <span class="start-text">Authors | </span><span class="end-text">Barbara Nickless</span>
	</div>
	<div class="book-section author">
		<div class="book">
			<img src="/images/image10.jpg" alt="image1">
		</div>
		<div class="content">
			<div class="heading-book">Barbara Nickless</div>
			<div class="book-details">
				<div class="star-container"> <span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
				</div>
			</div>
			<div class="book-description">A young woman is found brutally murdered, and the main suspect is the victim’s fiancé, a hideously scarred Iraq War vet known as the Burned Man. But railroad police Special Agent Sydney Rose Parnell, brought in by the Denver Major Crimes unit to help investigate, can't shake the feeling that larger forces are behind this apparent crime of passion.</div>
		</div>
	</div>
	<div class="ample-book-slot-slider">
		<div class="ample-row">
			<div class="ample-book-slot">Related Books</div>
			<div class="ample-book-view-all"> <i class="fa fa-arrow-right"></i>
				<div class="view-all">view all</div>
			</div>
		</div>
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
	@if(Auth::check() && empty($bookReview))
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
				<div class="heading">Rate this book</div>
				<form method="POST" enctype="multipart/form-data" action="{{ url('/book/review') }}" onsubmit="return validateForm()">
					{{ csrf_field() }}
					<textarea name="review_content" placeholder="Write your review !!"></textarea>
					<input type="hidden" name="book_id" value="{{$book->id}}">
					<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
					<input type="hidden" name="star" id="star_value" />
					<button type="submit">Submit review</button>       
				</form>
			</div>
		</div>
		@elseif(!empty($bookReview))
		<div class="sign-in-review">
			<i class="fas fa-lock"></i>
			<span>Already, You have given review for this book.</span>
		</div>
		@else
		<div class="sign-in-review">
			<i class="fas fa-lock"></i>
			<span>Sign in to write a review</span>
		</div>
	@endif
	<div class="sign-in-panel">
		<div class="heading">2 reviews</div>
		<div class="review-container">
			<div class="left">
				<div class="author-details">
					<div class="image">
						<img src="/images/user.png" alt="autor-image">
					</div>
					<div class="name">
						<div class="title">Barbara Nickless</div>
						<div class="sub-title">2 month ago</div>
					</div>
				</div>
			</div>
			<div class="right">
				<div class="star-container"> <span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star"></span>
					<span class="fa fa-star"></span>
				</div>
				<div class="author-des">Speaking as someone who has not read very many mystery / detective novels, I thought this one was much more than a whodunnit. Nickless adds a terrific human element with her main character's back story in the Middle East that influences and colors her actions in the main storyline. Even better though is her relationship with her partner, her dog Clyde. The way Nickless taught the reader to appreciate the way the two understand, work together and trust each other was worth an entire extra star! There is at least one more twist in the investigation than I expected, so probably just the right amount... A good dose of railroading too, if you find that interesting like I do; in fact it was one of the reasons I chose it.</div>
			</div>
		</div>
		<div class="review-container">
			<div class="left">
				<div class="author-details">
					<div class="image">
						<img src="/images/user.png" alt="autor-image">
					</div>
					<div class="name">
						<div class="title">Barbara Nickless</div>
						<div class="sub-title">2 month ago</div>
					</div>
				</div>
			</div>
			<div class="right">
				<div class="star-container"> <span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star"></span>
					<span class="fa fa-star"></span>
				</div>
				<div class="author-des">I was hooked from the first chapter - drawn in by the main character, Sydney, who hides her complex and compassionate nature beneath a stoic exterior. Blood on the Tracks unfolds with insight, wit, and crisp, tight dialog. I haven't read a novel straight through in a long time, but this one kept me captivated from beginning to end. Sometimes I swear my heart was thumping out of my chest!
					<br>
					<br>The book is also relevant to our times with its exploration of PTSD, homelessness, brokenness - and through it all - Hope. Nickless looks at the underbelly of life with obvious respect, integrity and understanding of heart, and shows what it means to keep going when everything is against you. An impressive and thrilling ride into dark and twisted places - honoring the courage and strength of the human spirit.
					<br>
					<br>I highly recommend this book, and look forward to the next in the series!</div>
			</div>
		</div>
	</div>
</div>
@endsection @section('footer_scripts') 
<style type="text/css">
.rating-stars ul > li.star {
    display: inline-block;
}
/* Idle State of the stars */
.rating-stars ul > li.star > i.fa {
    font-size: 2.5em;
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