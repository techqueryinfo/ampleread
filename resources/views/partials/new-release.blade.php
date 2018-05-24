<div class="ample-book-slot-slider">
    <div class="ample-row">
        <div class="ample-book-slot">New Release</div>
        <div class="ample-book-view-all">
            <i class="fa fa-arrow-right"></i>
            <div class="view-all">view all</div>

        </div>
    </div>
    <div class="owl-carousel owl-theme">
        
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
            
        
<!--         <div class="item">
            <div class="image"><img src="images/image11.jpg" alt="img1" /></div>
            <div class="ample-button"><button>FREE</button></div>
            <div class="title">The Kinfolk Home: Interiors for Slow Living</div>
            <div class="writer">Nathan Williams</div>
            <div class="star-container">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </div>

        </div>
        <div class="item">
            <div class="image"><img src="images/image12.jpg" alt="img1" /></div>
            <div class="ample-button"><button>FREE</button></div>
            <div class="title">The Kinfolk Home: Interiors for Slow Living</div>
            <div class="writer">Nathan Williams</div>
            <div class="star-container">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </div>
        </div>
        <div class="item">
            <div class="image"><img src="images/image22.jpg" alt="img1" /></div>
            <div class="ample-button"><button>FREE</button></div>
            <div class="title">The Kinfolk Home: Interiors for Slow Living</div>
            <div class="writer">Nathan Williams</div>
            <div class="star-container">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </div>
        </div>
        <div class="item">
            <div class="image"><img src="images/image21.png" alt="img1" /></div>
            <div class="ample-button"><button>FREE</button></div>
            <div class="title">The Kinfolk Home: Interiors for Slow Living</div>
            <div class="writer">Nathan Williams</div>
            <div class="star-container">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </div>
        </div>
        <div class="item">
            <div class="image"><img src="images/image15.png" alt="img1" /></div>
            <div class="ample-button"><button>FREE</button></div>
            <div class="title">The Kinfolk Home: Interiors for Slow Living</div>
            <div class="writer">Nathan Williams</div>
            <div class="star-container">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </div>
        </div>
        <div class="item">
            <div class="image"><img src="images/image17.jpg" alt="img1" /></div>
            <div class="ample-button"><button>FREE</button></div>
            <div class="title">The Kinfolk Home: Interiors for Slow Living</div>
            <div class="writer">Nathan Williams</div>
            <div class="star-container">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>

        </div>
        <div class="item">
            <div class="image"><img src="images/image19.jpg" alt="img1" /></div>
            <div class="ample-button"><button>FREE</button></div>
            <div class="title">The Kinfolk Home: Interiors for Slow Living</div>
            <div class="writer">Nathan Williams</div>
            <div class="star-container">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </div>

        </div>
        <div class="item">
            <div class="image"><img src="images/image18.jpg" alt="img1" /></div>
            <div class="ample-button"><button>FREE</button></div>
            <div class="title">The Kinfolk Home: Interiors for Slow Living</div>
            <div class="writer">Nathan Williams</div>
            <div class="star-container">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>

        </div>
        <div class="item">
            <div class="image"><img src="images/image14.jpg" alt="img1" /></div>
            <div class="ample-button"><button>FREE</button></div>
            <div class="title">The Kinfolk Home: Interiors for Slow Living</div>
            <div class="writer">Nathan Williams</div>
            <div class="star-container">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>

        </div>
        <div class="item"><div class="image"><img src="images/image11.jpg" alt="img1" /></div>
            <div class="ample-button"><button>FREE</button></div>
            <div class="title">The Kinfolk Home: Interiors for Slow Living</div>
            <div class="writer">Nathan Williams</div>
            <div class="star-container">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
            </div>
        <div class="item">
            <div class="image"><img src="images/image13.jpg" alt="img1" /></div>
            <div class="ample-button"><button>FREE</button></div>
            <div class="title">The Kinfolk Home: Interiors for Slow Living</div>
            <div class="writer">Nathan Williams</div>
            <div class="star-container">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
            </div>
    </div> -->
</div>