@extends('layouts.app') @section('template_title') Category @endsection @section('template_fastload_css') @endsection @section('content')
<div class="book-header">Search - {{$search_text}}</div>
<div class="ebook-slot-2sss">
	<div class="ample-book-slot-slider">
		<div class="ample-row"></div>
		<div class="owl-carousel owl-theme home-slider">
			@if(!$books->isEmpty()) @foreach($books as $book)
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
			@endforeach @else Data not available @endif
		</div>
	</div>
	<div class="line"></div>
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
@endsection