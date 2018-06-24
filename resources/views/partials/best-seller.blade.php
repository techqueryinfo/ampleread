<div class="ample-book-slot-slider">
    <div class="ample-row">
        <div class="ample-book-slot">Bestsellers</div>
        <div class="ample-book-view-all">
            <i class="fa fa-arrow-right"></i>
            <div class="view-all">view all</div>
        </div>
    </div>
    <div class="owl-carousel owl-theme home-slider">
        @if(!$bestsellers->isEmpty())
            @foreach($bestsellers as $book)
                <div class="item">
                   @if($book->home_books->type == 'free')
                   <div class="image"><a href="{{url('books/ebook/'.$book->home_books->id.'/'.$book->home_books->ebooktitle)}}"><img src="{{($book->home_books->ebook_logo) ? '/uploads/ebook_logo/'.$book->home_books->ebook_logo :uploads/ebook_logo/image10.jpg }}" alt="img1" /></a></div>
                   <div class="ample-button"><button>FREE</button></div>
                   <div class="title">{{$book->home_books->ebooktitle}}</div>
                   <div class="writer">{{$book->home_books->subtitle}}</div>
                    <div class="star-container">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                   @endif
                   @if($book->home_books->type == 'paid')
                   <div class="image"><a href="{{$book->home_books->buyLink}}"><img src="{{$book->home_books->ebook_logo}}" alt="img1" /></a></div>
                   <div class="ample-button"><button>PAID</button></div>
                   <div class="title">{{$book->home_books->ebooktitle}}</div>
                   <div class="writer">{{$book->home_books->subtitle}}</div>
                    <div class="star-container">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    @endif
                </div>
            @endforeach
        @else
          Data not available.    
        @endif
    </div>
</div>