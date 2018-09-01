<div class="ample-book-slot-slider">
  <div class="ample-row">
    <div class="ample-book-slot">New Release</div>
    <div class="ample-book-view-all"> <i class="fa fa-arrow-right"></i>
      <div class="view-all">view all</div>
    </div>
  </div>
  <div class="owl-carousel owl-theme home-slider">@if(!$new_releases->isEmpty()) @foreach($new_releases as $book)
    <div class="item">@if($book->home_books->type == 'free')
      <div class="image"><a href="{{url('books/ebook/'.$book->home_books->id.'/'.$book->home_books->ebooktitle)}}">
                      @if(substr($book->home_books->ebook_logo, 0, 4) == "http")
                        <img src="{{ $book->home_books->ebook_logo }}" alt="img1" />
                      @else
                        <img src="/uploads/ebook_logo/{{ $book->home_books->ebook_logo }}" alt="img1" />
                      @endif
                   </a>
      </div>
      <div class="ample-button">
        <button>FREE</button>
      </div>
      <div class="title">{{$book->home_books->ebooktitle}}</div>
      <div class="writer">{{$book->home_books->subtitle}}</div>
      <div class="star-container">
        <div class='rating-stars' style="margin: 0 -40px;">
          <ul id='stars'>
            <li class="star @if($book->home_books->star >= 1) selected @endif" title='Poor' data-value='1'> <i class='fa fa-star fa-fw'></i>
            </li>
            <li class="star @if($book->home_books->star >= 2) selected @endif" title='Fair' data-value='2'> <i class='fa fa-star fa-fw'></i>
            </li>
            <li class="star @if($book->home_books->star >= 3) selected @endif" title='Good' data-value='3'> <i class='fa fa-star fa-fw'></i>
            </li>
            <li class="star @if($book->home_books->star >= 4) selected @endif" title='Excellent' data-value='4'> <i class='fa fa-star fa-fw'></i>
            </li>
            <li class="star @if($book->home_books->star >= 5) selected @endif" title='WOW!!!' data-value='5'> <i class='fa fa-star fa-fw'></i>
            </li>
          </ul>
        </div>
      </div>@endif @if($book->home_books->type == 'paid')
      <div class="image"><a href="{{url('books/ebook/'.$book->home_books->id.'/'.$book->home_books->ebooktitle)}}">
                        @if(substr($book->home_books->ebook_logo, 0, 4) == "http")
                          <img src="{{ $book->home_books->ebook_logo }}" alt="img1" />
                        @else
                          <img src="/uploads/ebook_logo/{{ $book->home_books->ebook_logo }}" alt="img1" />
                        @endif
                   </a>
      </div>
      <div class="ample-button">
        <button style="width: auto; background-color: #868686; border: #868686;">FROM $ {{$book->home_books->retailPrice}}</button>
      </div>
      <div class="title">{{$book->home_books->ebooktitle}}</div>
      <div class="writer">{{$book->home_books->subtitle}}</div>
      <div class="star-container">
        <div class='rating-stars' style="margin: 0 -40px;">
          <ul id='stars'>
            <li class="star @if($book->home_books->star >= 1) selected @endif" title='Poor' data-value='1'> <i class='fa fa-star fa-fw'></i>
            </li>
            <li class="star @if($book->home_books->star >= 2) selected @endif" title='Fair' data-value='2'> <i class='fa fa-star fa-fw'></i>
            </li>
            <li class="star @if($book->home_books->star >= 3) selected @endif" title='Good' data-value='3'> <i class='fa fa-star fa-fw'></i>
            </li>
            <li class="star @if($book->home_books->star >= 4) selected @endif" title='Excellent' data-value='4'> <i class='fa fa-star fa-fw'></i>
            </li>
            <li class="star @if($book->home_books->star >= 5) selected @endif" title='WOW!!!' data-value='5'> <i class='fa fa-star fa-fw'></i>
            </li>
          </ul>
        </div>
      </div>@endif</div>@endforeach @else Data not available. @endif</div>
</div>