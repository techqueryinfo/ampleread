@extends('layouts.app')
@section('template_title')
    {{ Auth::user()->name }}'s' Homepage
@endsection
@section('template_fastload_css')
@endsection
@section('content')
<div class="ample-slider">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
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
                            <button>Read Now</button>
                            <!-- <div class="add-library">
                                <img src="images/plus.png" src="plus">
                                <span>Add to my library</span>
                            </div> -->
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
<div class="ample-signin-manage">
    <div class="sign-in-manage-left homeBooks">
        <div class="unit active"><a data-section="currently" href="javascript:void(0)">Currently reading</a></div>
        <div class="unit"><a data-section="saved-books" href="javascript:void(0)">My saved books</a></div>
        <div class="unit"><a data-section="publish-books" href="javascript:void(0)">My published books</a></div>
    </div>
    <div class="sign-in-manage-right">
        <!-- <img src="images/gear.png" alt="manage">
        <div>Manage</div> -->
    </div>
</div>
<div class="ample-signin-manage-section currently">
    @if(!$reading_books->isEmpty())
        @foreach($reading_books as $key => $val)
            <div class="unit">
                <div class="image">
                    <a href="{{url('books/ebook/'.$val->id.'/'.$val->ebooktitle)}}">
                    @if(substr($val->ebook_logo, 0, 4) == "http")
                        <img src="{{ $val->ebook_logo }}" />
                    @else
                        <img src="/uploads/ebook_logo/{{ $val->ebook_logo }}"/>
                    @endif
                    </a>
                </div>
                <div class="title">{{$val->ebooktitle}}</div>
            </div>
        @endforeach
    @else
        Data not available !
    @endif
</div>
<div class="ample-signin-manage-section saved-books" style="display: none;">
    @if(!$save_books->isEmpty())
        @foreach($save_books as $key => $val)
            <div class="unit">
                <div class="image">
                    <a href="{{ url('/book/' . $val->id . '/edit') }}" title="Edit Book">
                    @if(substr($val->ebook_logo, 0, 4) == "http")
                        <img src="{{ $val->ebook_logo }}" />
                    @else
                        <img src="/uploads/ebook_logo/{{ $val->ebook_logo }}"/>
                    @endif
                    </a>
                </div>
                <div class="bar">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 27%" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="text">
                        27%
                    </div>
                </div>
            </div>
        @endforeach
    @else
        Data not available !
    @endif
</div>
<div class="ample-signin-manage-section publish-books" style="display: none;">
    @if(!$publish_books->isEmpty())
        @foreach($publish_books as $key => $val)
            <div class="unit">
                <div class="image">
                    <a href="{{url('books/ebook/'.$val->id.'/'.$val->ebooktitle)}}">
                    @if(substr($val->ebook_logo, 0, 4) == "http")
                        <img src="{{ $val->ebook_logo }}" />
                    @else
                        <img src="/uploads/ebook_logo/{{ $val->ebook_logo }}"/>
                    @endif
                    </a>
                </div>
                <div class="title">{{$val->ebooktitle}}</div>
                <!-- <div class="bar">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 27%" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="text">
                        27%
                    </div>
                </div> -->
            </div>
        @endforeach
    @else
        Data not available !
    @endif
</div>
@if(empty($related_book) || !$related_book->isEmpty())
<div class="sign-in-page-bar"></div>
<div class="ample-book-slot-slider">
    <div class="ample-row">
        <div class="ample-book-slot">Related Books</div>
        <div class="ample-book-view-all">
            <i class="fa fa-arrow-right"></i>
            <div class="view-all"><a href="{{url('books/related_books')}}" target="blank" style="text-decoration: none;">view all</a></div>
        </div>
    </div>
    <div class="owl-carousel owl-theme home-slider owl-loaded owl-drag">
        <div class="owl-stage-outer">
            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: 0s; width: 3178px;">
                
                @foreach($related_book as $book)
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image">
                            <a href="{{url('books/ebook/'.$book->id.'/'.$book->ebooktitle)}}">
                            @if(substr($book->ebook_logo, 0, 4) == "http")
                                <img src="{{ $book->ebook_logo }}" alt="img1" />
                            @else
                                <img src="/uploads/ebook_logo/{{ $book->ebook_logo }}" alt="img1" />
                            @endif
                            </a>
                        </div>
                        <div class="ample-button">
                            @if($book->type == 'free')
                                <button>FREE</button>
                            @else
                                <button style="width: auto; background-color: #868686; border: #868686;">FROM $ {{$book->retailPrice}}</button>
                            @endif    
                        </div>
                        <div class="title">{{$book->ebooktitle}}</div>
                        <div class="writer">{{$book->subtitle}}</div>
                        <div class="star-container">
                            <div class='rating-stars' style="margin: 0 -40px;">
                              <ul id='stars'>
                                <li class="star @if($book->star >= 1) selected @endif" title='Poor' data-value='1'> <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class="star @if($book->star >= 2) selected @endif" title='Fair' data-value='2'> <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class="star @if($book->star >= 3) selected @endif" title='Good' data-value='3'> <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class="star @if($book->star >= 4) selected @endif" title='Excellent' data-value='4'> <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class="star @if($book->star >= 5) selected @endif" title='WOW!!!' data-value='5'> <i class='fa fa-star fa-fw'></i>
                                </li>
                              </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach    
            </div>
        </div>
        <div class="owl-nav">
            <button type="button" role="presentation" class="owl-prev disabled"><span aria-label="Previous">‹</span></button>
            <button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button>
        </div>
        <div class="owl-dots disabled"></div>
    </div>
</div>
@endif
<div class="sign-in-page-bar"></div>
<div class="ample-book-slot-slider">
    <div class="ample-row">
        <div class="ample-book-slot">Featured Books</div>
        <div class="ample-book-view-all">
            <i class="fa fa-arrow-right"></i>
            <div class="view-all"><a href="{{url('books/featured_books')}}" target="blank" style="text-decoration: none;">view all</a></div>

        </div>
    </div>
    <div class="owl-carousel owl-theme home-slider owl-loaded owl-drag">
        <div class="owl-stage-outer">
            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: 0s; width: 3178px;">
                @if(!$featured_book->isEmpty())
                @foreach($featured_book as $val)
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image">
                            <a href="{{url('books/ebook/'.$val->id.'/'.$val->ebooktitle)}}">
                            @if(substr($val->ebook_logo, 0, 4) == "http")
                                <img src="{{$val->ebook_logo}}" alt="img1" />
                            @else
                                <img src="/uploads/ebook_logo/{{$val->ebook_logo}}" alt="img1" />
                            @endif
                            </a>
                        </div>
                        <div class="ample-button">
                            @if($val->type == 'free')
                                <button>FREE</button>
                            @else
                                <button style="width: auto; background-color: #868686; border: #868686;">FROM $ {{$val->retailPrice}}</button>
                            @endif
                        </div>
                        <div class="title">{{$val->ebooktitle}}</div>
                        <div class="writer">{{$val->subtitle}}</div>
                        <div class="star-container">
                            <div class='rating-stars' style="margin: 0 -40px;">
                              <ul id='stars'>
                                <li class="star @if($val->star >= 1) selected @endif" title='Poor' data-value='1'> <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class="star @if($val->star >= 2) selected @endif" title='Fair' data-value='2'> <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class="star @if($val->star >= 3) selected @endif" title='Good' data-value='3'> <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class="star @if($val->star >= 4) selected @endif" title='Excellent' data-value='4'> <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class="star @if($val->star >= 5) selected @endif" title='WOW!!!' data-value='5'> <i class='fa fa-star fa-fw'></i>
                                </li>
                              </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                 No data
                @endif
            </div>
        </div>
        <div class="owl-nav">
            <button type="button" role="presentation" class="owl-prev disabled"><span aria-label="Previous">‹</span></button>
            <button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button>
        </div>
        <div class="owl-dots disabled"></div>
    </div>
</div>
@endsection
@section('footer_scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('.homeBooks a').click(function(){
      console.log($(this).attr('data-section'));
      var cSection = $(this).attr('data-section');
      $('.ample-signin-manage-section').hide();
      if($('.ample-signin-manage-section').hasClass(cSection)){
        $('div.ample-signin-manage-section.'+cSection).show();  
      }
      
    })
  })
</script>
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
@endsection