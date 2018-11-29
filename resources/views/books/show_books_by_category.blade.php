@extends('layouts.app') @section('template_title') Category @endsection @section('template_fastload_css') @endsection @section('content')
<div class="book-header">@if(!blank($category_name)) {{ucwords(str_replace('-', ' ', $category_name))}} @endif</div>
@if($category_name != 'popular' && $category_name != 'new-releases')
<div class="ebook-slot-1">
    <ul>
                    <li @if($category_name == 'all-books') class="active" @endif ><a style="color:black;" href="/books/category/all-books">All Books</a></li>
                    @if(!$categories->isEmpty()) @foreach ($categories as $optionKey => $optionValue) @if(!blank($optionValue->is_delete) && $optionValue->is_delete==0)
                    <li @if($optionValue->category_slug == $category_slug) class="active" @endif ><a style="color:black;" href="/books/category/{{$optionValue->category_slug}}">{{$optionValue->name}}</a></li>
                    @if($subcategory && $category_slug == $optionValue->category_slug)
                    <ul style="padding-left: 50px">
                        @foreach ($subcategory as $sKey => $sValue) 
                        @if(!blank($sValue->is_delete) && $sValue->is_delete==0)
                        <li @if($sValue->id == $category->id) class="active" @endif ><a style="color:#ff7335; font-size: 13px;" href="/books/category/{{$optionValue->category_slug}}/{{$sValue->category_slug}}">{{$sValue->name}}</a></li>
                        @endif @endforeach
                    </ul>
                    @endif
                    @endif @endforeach @else Data not available ! @endif
                </ul>
</div>

<div class="ebook-slot-2">
    <div class="ample-book-slot-slider">
        <div class="ample-row">
            <div class="ample-book-slot">New Releases</div>
            @if(!$records->isEmpty())
            <div class="ample-book-view-all">
                <i class="fa fa-arrow-right"></i>
                <div class="view-all">
                    @if($category)
                    <a href="{{url('books/'.$category_slug.'/all')}}" style="text-decoration: none;">view all</a>
                    @else
                    <a href="{{url('books/'.$category_slug)}}" style="text-decoration: none;">view all</a>
                    @endif
                </div>
            </div>
            @endif
        </div>
        <div class="owl-carousel owl-theme category-slider">
            @if(!$records->isEmpty()) @foreach($records as $book)
            <div class="item">
                <div class="image"><a href="{{url('books/ebook/'.$book->id.'/'.$book->ebooktitle)}}">
                    @if(substr($book->ebook_logo, 0, 4) == "http")
                        <img src="{{ $book->ebook_logo }}" alt="img1" />
                    @else
                        <img src="/uploads/ebook_logo/{{ $book->ebook_logo }}" alt="img1" />
                    @endif</a>
                </div>
                <div class="ample-button">
                    @if($book->type == 'free')
                        <button>FREE</button>
                    @else
                        <button style="width: auto; background-color: #868686; border: #868686;">FROM $ {{$book->retailPrice}}</button>
                    @endif
                </div>
                <div class="title">{{$book->ebooktitle}}</div>
                <div class="writer">{{$book->first_name}} {{$book->last_name}}</div>
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
            @endforeach @else Data not available @endif
        </div>
    </div>
    <div class="line"></div>
    <div class="ample-book-slot-slider">
        <div class="ample-row">
            <div class="ample-book-slot">Bestsellers</div>
            @if(!$records->isEmpty())
            <div class="ample-book-view-all">
                <i class="fa fa-arrow-right"></i>
                <div class="view-all">
                @if($category)
                <a href="{{url('books/'.$category_slug.'/all')}}" style="text-decoration: none;">view all</a>
                @else
                <a href="{{url('books/'.$category_slug)}}" style="text-decoration: none;">view all</a>
                @endif
                </div>
            </div>
            @endif
        </div>
        <div class="owl-carousel owl-theme category-slider">
            @if(!$records->isEmpty()) @foreach($records as $book)
            <div class="item">
                @if(!blank($book->ebook_logo))
                <div class="image"><a href="{{url('books/ebook/'.$book->id.'/'.$book->ebooktitle)}}">
                    @if(substr($book->ebook_logo, 0, 4) == "http")
                        <img src="{{ $book->ebook_logo }}" alt="img1" />
                    @else
                        <img src="/uploads/ebook_logo/{{$book->ebook_logo}}" alt="img1" />
                    @endif</a>
                </div>
                @endif
                <div class="ample-button">
                    @if($book->type == 'free')
                        <button>FREE</button>
                    @else
                        <button style="width: auto; background-color: #868686; border: #868686;">FROM $ {{$book->retailPrice}}</button>
                    @endif
                </div>
                <div class="title">{{$book->ebooktitle}}</div>
                <div class="writer">{{$book->first_name}} {{$book->last_name}}</div>
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
            @endforeach @else Data not available @endif
        </div>
    </div>
    <div class="line"></div>
    <div class="ample-book-slot-slider">
        <div class="ample-row">
            <div class="ample-book-slot">Trending Now</div>
            @if(!$records->isEmpty())
            <div class="ample-book-view-all">
                <i class="fa fa-arrow-right"></i>
                <div class="view-all">
                @if($category)
                <a href="{{url('books/'.$category_slug.'/all')}}" style="text-decoration: none;">view all</a>
                @else
                <a href="{{url('books/'.$category_slug)}}" style="text-decoration: none;">view all</a>
                @endif
                </div>
            </div>
            @endif
        </div>
        <div class="owl-carousel owl-theme category-slider">
            @if(!$records->isEmpty()) @foreach($records as $book)
            <div class="item">
                @if(!blank($book->ebook_logo))
                <div class="image"><a href="{{url('books/ebook/'.$book->id.'/'.$book->ebooktitle)}}">
                    @if(substr($book->ebook_logo, 0, 4) == "http")
                        <img src="{{ $book->ebook_logo }}" alt="img1" />
                    @else
                        <img src="/uploads/ebook_logo/{{ $book->ebook_logo }}" alt="img1" />
                    @endif</a>
                </div>
                @endif
                <div class="ample-button">
                    @if($book->type == 'free')
                        <button>FREE</button>
                    @else
                        <button style="width: auto; background-color: #868686; border: #868686;">FROM $ {{$book->retailPrice}}</button>
                    @endif
                </div>
                <div class="title">{{$book->ebooktitle}}</div>
                <div class="writer">{{$book->first_name}} {{$book->last_name}}</div>
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
            @endforeach @else Data not available @endif
        </div>
    </div>
</div>
@else
<div class="ebook-slot-2">
    <div class="ample-book-slot-slider">
        <div class="ample-row">
            <!-- <div class="ample-book-slot">New Releases</div> -->
           <!--  @if(!$records->isEmpty())
            <div class="ample-book-view-all">
                <i class="fa fa-arrow-right"></i>
                <div class="view-all">
                    <a href="{{url('books/new_releases')}}" style="text-decoration: none;">view all</a>
                </div>
            </div>
            @endif -->
        </div>
        <div class="owl-carousel owl-theme category-slider">
            @if(!$records->isEmpty()) @foreach($records as $book)
            <div class="item">
                <div class="image"><a href="{{url('books/ebook/'.$book->id.'/'.$book->ebooktitle)}}">
                    @if(substr($book->ebook_logo, 0, 4) == "http")
                        <img src="{{ $book->ebook_logo }}" alt="img1" />
                    @else
                        <img src="/uploads/ebook_logo/{{ $book->ebook_logo }}" alt="img1" />
                    @endif</a>
                </div>
                <div class="ample-button">
                    @if($book->type == 'free')
                        <button>FREE</button>
                    @else
                        <button style="width: auto; background-color: #868686; border: #868686;">FROM $ {{$book->retailPrice}}</button>
                    @endif
                </div>
                <div class="title">{{$book->ebooktitle}}</div>
                <div class="writer">{{$book->first_name}} {{$book->last_name}}</div>
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
            @endforeach @else Data not available @endif
        </div>
    </div>
</div>
@endif
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
@endsection