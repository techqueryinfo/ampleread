@extends('layouts.app')
@section('content')
<div class="ample-slider">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            @if(!empty($banner_images))
            @foreach($banner_images as $key => $banner_image)
            @if($banner_image->image_name !='')
                @php
                    $active = ($key == 0)  ? 'active' : '';
                @endphp
                <div class="item {{$active}}">
                    <div class="ample-banner">
                        <a href="{{$banner_image->banner_link}}" target="_blank"><img src="/uploads/ebook_logo/{{$banner_image->image_name}}" border="0" /></a>
                    </div>
                </div>
            @endif
            @endforeach
            @else
            <div class="item active">
                <div class="ample-banner">
                    <div class="ample-banner-left">
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image1.jpg"></div>
                            <div class="unit-one-two"><img src="images/image2.jpg"></div>
                        </div>
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image3.jpg"></div>
                            <div class="unit-one-two"><img src="images/image4.jpg"></div>
                        </div>
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image5.jpg"></div>
                            <div class="unit-one-two"><img src="images/image6.png"></div>
                        </div>
                    </div>
                    <div class="ample-banner-right">
                        <div class="ample-banner-heading">10 inspiring books<br>
                            for the autumn begining</div>
                        <div class="ample-banner-subheading">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            donec et quam id nunc finibus efficitur molestie</div>
                        <div class="ample-banner-button">
                            <button>Learn More</button>
                        </div>
                    </div>
                    <div class="ample-banner-mobile">
                        <div class="unit-1">
                            <img src="images/image7.jpg" />
                        </div>
                        <div class="unit-1">
                            <img src="images/image8.jpg" />
                        </div>
                        <div class="unit-1">
                            <img src="images/image9.jpg" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ample-banner">
                    <div class="ample-banner-left">
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image7.jpg"></div>
                            <div class="unit-one-two"><img src="images/image8.jpg"></div>
                        </div>
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image9.jpg"></div>
                            <div class="unit-one-two"><img src="images/image2.jpg"></div>
                        </div>
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image4.jpg"></div>
                            <div class="unit-one-two"><img src="images/image5.jpg"></div>
                        </div>
                    </div>
                    <div class="ample-banner-right">
                        <div class="ample-banner-heading">10 inspiring books<br>
                            for the autumn begining</div>
                        <div class="ample-banner-subheading">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            donec et quam id nunc finibus efficitur molestie</div>
                        <div class="ample-banner-button">
                            <button>Learn More</button>
                        </div>
                    </div>
                    <div class="ample-banner-mobile">
                        <div class="unit-1">
                            <img src="images/image4.jpg" />
                        </div>
                        <div class="unit-1">
                            <img src="images/image5.jpg" />
                        </div>
                        <div class="unit-1">
                            <img src="images/image6.png" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ample-banner">
                    <div class="ample-banner-left">
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image9.jpg"></div>
                            <div class="unit-one-two"><img src="images/image8.jpg"></div>
                        </div>
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image7.jpg"></div>
                            <div class="unit-one-two"><img src="images/image5.jpg"></div>
                        </div>
                        <div class="unit-one">
                            <div class="unit-one-one"><img src="images/image4.jpg"></div>
                            <div class="unit-one-two"><img src="images/image3.jpg"></div>
                        </div>

                    </div>
                    <div class="ample-banner-right">
                        <div class="ample-banner-heading">10 inspiring books<br>
                            for the autumn begining</div>
                        <div class="ample-banner-subheading">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            donec et quam id nunc finibus efficitur molestie</div>
                        <div class="ample-banner-button">
                            <button>Learn More</button>
                        </div>
                    </div>
                    <div class="ample-banner-mobile">
                        <div class="unit-1">
                            <img src="images/image1.jpg" />
                        </div>
                        <div class="unit-1">
                            <img src="images/image2.jpg" />
                        </div>
                        <div class="unit-1">
                            <img src="images/image1.jpg" />
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <i class="fas fa-chevron-left"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <i class="fas fa-chevron-right"></i>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<div class="ample-book-slot-1">
    @if(!$special_features->isEmpty())
        @foreach($special_features as $key => $val)
            @if($key <= 2 )
            @if($val->book_id && $val->home_books)
                <div class="slot-1">
                    <div class="e-book1">
                        @if($val->home_books)
                        <img src="{{ (substr($val->home_books->ebook_logo, 0, 4) == 'http') ? $val->home_books->ebook_logo : '/uploads/ebook_logo/'.$val->home_books->ebook_logo }}" alt="image">
                        <img src="{{ (substr($val->home_books->ebook_logo, 0, 4) == 'http') ? $val->home_books->ebook_logo : '/uploads/ebook_logo/'.$val->home_books->ebook_logo }}" alt="image">
                        <img src="{{ (substr($val->home_books->ebook_logo, 0, 4) == 'http') ? $val->home_books->ebook_logo : '/uploads/ebook_logo/'.$val->home_books->ebook_logo }}" alt="image">
                        @endif
                    </div>
                    <div class="heading">{{ $val->home_books->ebooktitle }}</div>
                    <!-- <div class="sub-text">{{ $val->home_books->subtitle }}</div> -->
                </div>
            @else
                <div class="slot-1">
                    <div class="e-book1">
                        @if($val->banner_image)
                        <a href="{{$val->banner_link}}" target="_blank">
                            <img src="{{ (substr($val->banner_image, 0, 4) == 'http') ? $val->banner_image : '/uploads/ebook_logo/'.$val->banner_image }}" alt="image" border="0">
                            <img src="{{ (substr($val->banner_image, 0, 4) == 'http') ? $val->banner_image : '/uploads/ebook_logo/'.$val->banner_image }}" alt="image" border="0">
                            <img src="{{ (substr($val->banner_image, 0, 4) == 'http') ? $val->banner_image : '/uploads/ebook_logo/'.$val->banner_image }}" alt="image" border="0">
                        </a>
                        @endif
                    </div>
                    <div class="heading">{{ $val->banner_title }}</div>
                </div>
            @endif
            @endif
        @endforeach
    @else
        Data not available !
    @endif
</div>
<div class="ample-book-slot-2">
    @if(!$special_features->isEmpty())
        @foreach($special_features as $key => $val)
            @if($key >= 3 )
            @if($val->book_id && $val->home_books)
                <div class="slot-1">
                    <div class="heading">{{ $val->home_books->ebooktitle }}</div>
                    <div class="sub-text">{{ $val->home_books->subtitle }}</div>
                    <div class="ebook">
                        <img src="{{ (substr($val->home_books->ebook_logo, 0, 4) == 'http') ? $val->home_books->ebook_logo : '/uploads/ebook_logo/'.$val->home_books->ebook_logo }}" alt=""><img src="{{ (substr($val->home_books->ebook_logo, 0, 4) == 'http') ? $val->home_books->ebook_logo : '/uploads/ebook_logo/'.$val->home_books->ebook_logo }}" alt="">
                    </div>
                </div>
            @else
            HIIII
            @endif    
            @endif
        @endforeach
    @else
        Data not available !
    @endif
</div>
@if(!$new_releases->isEmpty())
@include('partials.new-release')
@endif
@if(!$bestsellers->isEmpty())
@include('partials.best-seller')
@endif
@if(!$classics->isEmpty())
@include('partials.classic')
@endif
@endsection @section('footer_scripts')
<style type="text/css">
.rating-stars ul > li.star {
    display: inline-block;
}
/* Idle State of the stars */
.rating-stars ul > li.star > i.fa {
    font-size: 1em; /* Change the size of the stars */
    color: #ccc; /* Color on idle state */
}
/* Hover state of the stars */
.rating-stars ul > li.star.hover > i.fa {
    color: #FFCC36;
}
/* Selected state of the stars */
.rating-stars ul > li.star.selected > i.fa {
    color: #FF912C;
}
</style> @endsection