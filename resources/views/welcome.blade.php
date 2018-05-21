@extends('layouts.app')

@section('content')
<!-- {{$books}} -->
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
<div class="ample-book-slot-1">
<div class="slot-1">
    <div class="e-book1">
        <img src="images/image4.jpg" alt=""/>
        <img src="images/image2.jpg" alt=""/>
        <img src="images/image6.png" alt=""/>
    </div>

    <div class="heading">Gaiman, McGuane, Chirovici</div>
    <div class="sub-text">Lorem ipsum dolor</div>
</div>
<div class="slot-2">
    <div class="e-book1">
        <img src="images/image8.jpg" alt=""/>
        <img src="images/image9.jpg" alt=""/>
    </div>

    <div class="heading">Gaiman, McGuane, Chirovici</div>
    <div class="sub-text">Lorem ipsum dolor</div>
</div>
<div class="slot-1">
    <div class="e-book1">
        <img src="images/image4.jpg" alt=""/>
        <img src="images/image2.jpg" alt=""/>
        <img src="images/image5.jpg" alt=""/>
    </div>
    <div class="heading">Gaiman, McGuane, Chirovici</div>
    <div class="sub-text">Lorem ipsum dolor</div>
</div>
</div>
<div class="ample-book-slot-2">
    <div class="slot-1">
        <div class="heading">All about food</div>
        <div class="sub-text">Lorem ipsum dolor</div>
        <div class="ebook"><img src="images/image3.jpg" alt=""><img src="images/image7.jpg" alt=""></div>
    </div>
    <div class="slot-1">
        <div class="heading">Ultimate classics</div>
        <div class="sub-text">Lorem ipsum dolor</div>
        <div class="ebook"><img src="images/image6.png" alt=""><img src="images/image2.jpg" alt=""></div>
    </div>
</div>

 @include('partials.new-release')
 @include('partials.best-seller')
 @include('partials.classic')
<!-- <div class="ample-book-slot-slider">
    <div class="ample-row">
        <div class="ample-book-slot">New Release</div>
        <div class="ample-book-view-all">
            <i class="fa fa-arrow-right"></i>
            <div class="view-all">view all</div>

        </div>
    </div>
    <div class="owl-carousel owl-theme">
        <div class="item">
            <div class="image"><img src="images/image10.jpg" alt="img1" /></div>
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
    </div>
</div> -->
<!-- <div class="ample-book-slot-slider">

    <div class="ample-row">
        <div class="ample-book-slot">Bestsellers</div>
        <div class="ample-book-view-all">
            <i class="fa fa-arrow-right"></i>
            <div class="view-all">view all</div>

        </div>
    </div>
    <div class="owl-carousel owl-theme">
        <div class="item">
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
            <div class="image"><img src="images/image23.jpg" alt="img1" /></div>
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
            <div class="image"><img src="images/image24.jpg" alt="img1" /></div>
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
            <div class="image"><img src="images/image25.jpg" alt="img1" /></div>
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
            <div class="image"><img src="images/image26.jpg" alt="img1" /></div>
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
            <div class="image"><img src="images/image27.jpg" alt="img1" /></div>
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
            <div class="image"><img src="images/image35.jpg" alt="img1" /></div>
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
            <div class="image"><img src="images/image29.jpg" alt="img1" /></div>
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
        <div class="item"><div class="image"><img src="images/image21.png" alt="img1" /></div>
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
    </div>
</div> -->
<!-- <div class="ample-book-slot-slider">
   <div class="ample-row">
        <div class="ample-book-slot">Classics</div>
        <div class="ample-book-view-all">
            <i class="fa fa-arrow-right"></i>
            <div class="view-all">view all</div>

        </div>
    </div>
    <div class="owl-carousel owl-theme">
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
        <div class="item">
            <div class="image"><img src="images/image30.jpg" alt="img1" /></div>
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
            <div class="image"><img src="images/image31.jpg" alt="img1" /></div>
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
            <div class="image"><img src="images/image32.jpg" alt="img1" /></div>
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
            <div class="image"><img src="images/image33.jpg" alt="img1" /></div>
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
            <div class="image"><img src="images/image34.png" alt="img1" /></div>
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
            <div class="image"><img src="images/image35.jpg" alt="img1" /></div>
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
            <div class="image"><img src="images/image36.jpg" alt="img1" /></div>
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
            <div class="image"><img src="images/image24.jpg" alt="img1" /></div>
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
        <div class="item"><div class="image"><img src="images/image18.jpg" alt="img1" /></div>
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
            <div class="image"><img src="images/image26.jpg" alt="img1" /></div>
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
    </div>
</div> -->
@endsection