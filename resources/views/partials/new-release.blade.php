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
                   @if(!blank($book->ebook_logo))
                   <div class="image"><img src="{{($book->ebook_logo) ? '/uploads/ebook_logo/'.$book->ebook_logo :images/image10.jpg }}" alt="img1" /></div>
                   @endif
                   <div class="ample-button"><button>FREE</button></div>
                   <div class="title">{{$book->ebooktitle}}</div>
                   <div class="writer">Nathan Williams</div>
                    <div class="star-container">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>