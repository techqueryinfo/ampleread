@extends('layouts.app') @section('template_title') E-Book Detail Page @endsection @section('free-book-css')
<link rel="stylesheet" href="/css/free-book.css"> @endsection @section('content')
<div class="free-ebook">
    <div class="page-path">
        <span class="start-text">Special Features | </span><span class="end-text">Thriller & Crime</span>
    </div>
    <div class="book-section">
        <div class="book">
            @if(substr($book->ebook_logo, 0, 4) == "http")
                <img src="{{ $book->ebook_logo }}" alt="image1"/>
            @else
                <img src="/uploads/ebook_logo/{{ $book->ebook_logo }}" alt="image1" />
            @endif
        </div>
        <div class="content">
            <div class="heading-book">{{$book->ebooktitle}}</div>
            <div class="book-details">
                <span class="writer-name">{{$book->subtitle}}</span><span class="year"><?php
                    $date=date_create($book->created_at);
                    echo date_format($date,"j M, Y");
                    ?></span>
                <div class="star-container">
                    <div class='rating-stars' style="margin: 0 0 0 -40px;">
                        <ul id='starss'>
                            <li class="star @if($book->star >= 1) selected @endif" title='Poor' data-value='1'>
                               <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class="star @if($book->star >= 2) selected @endif" title='Fair' data-value='2'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class="star @if($book->star >= 3) selected @endif" title='Good' data-value='3'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class="star @if($book->star >= 4) selected @endif" title='Excellent' data-value='4'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class="star @if($book->star >= 5) selected @endif" title='WOW!!!' data-value='5'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="free-book">
                <div class="button">
                    @if($book->type == 'free')
                        <a lass="submit-button" href="{{url('book/reading/'.$book->id.'/'.$book->ebooktitle)}}">Read Book</a>
                    @else
                        <button type="submit" class="submit-button">FROM ${{$book->retailPrice}}</button>
                    @endif
                </div>
                @if($book->type == 'free')
                    <div class="text"><a href="{{url('book/readlater/'.$book->id.'/'.$book->ebooktitle)}}"><i class="far fa-clock"></i> SAVE FOR LATER</a></div>
                    @if($book->book_ext && $book->book_ext !='')
                    <div class="text"><a href="{{url('/uploads/ebook_logo/'.$book->buyLink)}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> DOWNLOAD </div>
                    @endif
                @else
                    <div class="text"><i class="fab fa-gitter"></i> <a name="comparePrice" href="#comparePrice">COMPARE PRICE</a></div>    
                @endif
            </div>
            <div class="book-description">{{$book->desc}}</div>
        </div>
    </div>
    <div class="book-author-description">
        <div class="book-description">
            <div class="left">
                <ul>
                    @if($book->book_size)
                    <li>File size</li>
                    @endif
                    @if($book->pageCount)
                    <li>Print pages</li>
                    @endif
                    @if($book->publisher)
                    <li>Publisher</li>
                    @endif
                    @if($book->publisher_date)
                    <li>Publication date</li>
                    @endif
                    @if($book->book_language)
                    <li>Language</li>
                    @endif
                    @if($book->asin)
                    <li>ASIN</li>
                    @endif
                </ul>
            </div>
            <div class="left des">
                <ul>
                    @if($book->book_size)
                    <li>{{$book->book_size/1000}} KB</li>
                    @endif
                    @if($book->pageCount)
                    <li>{{$book->pageCount}}</li>
                    @endif
                    @if($book->publisher)
                    <li>{{$book->publisher}}</li>
                    @endif
                    @if($book->publisher_date)
                    <li><?php
                    $date=date_create($book->publisher_date);
                    echo date_format($date,"F j, Y");
                    ?></li>
                    @endif
                    @if($book->book_language)
                    <li>{{$book->book_language}}</li>
                    @endif
                    @if($book->asin)
                    <li>{{$book->asin}}</li>
                    @endif
                </ul>
            </div>
        </div>
        @if($author)
        <div class="author-description">
            <div class="author-details">
                <div class="image">
                    <a href="{{ url("/book/$book->id/author/$book->author/$author->name") }}" style="text-decoration: none; color: #fff;"><img src="/images/user.png" alt="autor-image" border="0"></a>
                </div>
                <div class="name">
                    <div class="title"><a href="{{ url("/book/$book->id/author/$book->author/$author->name") }}" style="text-decoration: none; color: #000000;">{{$author->name}}</a></div>
                    <div class="sub-title">Author</div>
                </div>

            </div>
            <div class="author-des">
                {{substr($author->about_us,0, 250)}}...
            </div>
            <div class="button">
                <a href="{{ url("/book/$book->id/author/$book->author/$author->name") }}" style="text-decoration: none; color: #fff;"><button>Learn more</button></a>
            </div>
        </div>
        @endif
    </div>
    @if($book->type == 'paid')
        @if(!$paid->isEmpty())
        <div class="book-compare-price" id="comparePrice">
            <div class="heading">Compare Prices</div>
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
                        <img src="/uploads/storeimage/{{$val->store_logo}}" width="100%" alt="image" />
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
                    <div class="price">$ {{ $val->price }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="book-compare-price">
            <div class="heading">Available Discount</div>
            @if(!$paidDiscount->isEmpty())
            @foreach($paidDiscount as $val)
            <div class="row-compare-one sec-two">
                <div class="unit-compare-sec">
                    <div class="image-box">
                        <img src="/uploads/storeimage/{{ $val->store_logo }}" width="100%" alt="image" />
                    </div>
                </div>
                <div class="unit-compare-sec-three">
                    <div class="heading">{{ $val->discount }} % OFF & Free shipping</div>
                    <div class="content">{{ $val->desc }}</div>
                </div>
                <div class="unit-compare-sec-four">
                    <button >Get this deal</button>
                </div>
                <div class="unit-compare-sec-five">
                    <i class="fas fa-thumbs-up"></i>
                    <i class="fas fa-thumbs-down"></i>
                </div>
            </div>
            @endforeach
            @else
            No Discount available
            @endif
        </div>
        @endif
    @endif
    <div class="ample-book-slot-slider">
        <div class="ample-row">
            <div class="ample-book-slot">Related Books</div>
            <div class="ample-book-view-all">
                <i class="fa fa-arrow-right"></i>
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
                <div class="star-container">
                    <div class='rating-stars' style="margin: 0 0 0 -40px;">
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
    @if(!$book_reviews->isEmpty())    
    <div class="sign-in-panel">
        <div class="heading">{{$book_review_count}} reviews</div>
        @foreach($book_reviews as $val)
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