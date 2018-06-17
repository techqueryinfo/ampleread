<div class="ample-book-slot-slider">
    <div class="ample-row">
        <div class="ample-book-slot">New Release</div>
        <div class="ample-book-view-all">
            <i class="fa fa-arrow-right"></i>
            <div class="view-all">view all</div>
        </div>
    </div>
    <div class="owl-carousel owl-theme home-slider">
        @if(!$books->isEmpty())
            @foreach($books as $book)
                <div class="item">
                   @if($book->type == 'free')
                   <div class="image"><a href="{{url('books/ebook/'.$book->id.'/'.$book->ebooktitle)}}"><img src="{{($book->ebook_logo) ? '/uploads/ebook_logo/'.$book->ebook_logo :uploads/ebook_logo/image10.jpg }}" alt="img1" /></a></div>
                   <div class="ample-button"><button>FREE</button></div>
                   <div class="title">{{$book->ebooktitle}}</div>
                   <div class="writer">{{$book->subtitle}}</div>
                    <div class="star-container">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                   @endif
                   @if($book->type == 'paid')
                   <div class="image"><a href="{{$book->buyLink}}"><img src="{{$book->ebook_logo}}" alt="img1" /></a></div>
                   <div class="ample-button"><button>PAID</button></div>
                   <div class="title">{{$book->ebooktitle}}</div>
                   <div class="writer">{{$book->subtitle}}</div>
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
        @endif
    </div>
</div>