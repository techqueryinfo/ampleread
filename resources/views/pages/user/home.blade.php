@extends('layouts.app')
@section('template_title')
    {{ Auth::user()->name }}'s' Homepage
@endsection
@section('template_fastload_css')
@endsection
@section('content')
<div class="ample-slider">
    <div id="myCarousel" class="carousel slide sign-slider" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="ample-signin-banner">
                    <div class="ample-banner-right">
                        <div class="ample-banner-heading">The Girl on the Train</div>
                        <div class="ample-banner-subheading">The #1 New York Times Bestseller, USA Today Book of the Year, now a major motion picture starring Emily Blunt. Don't miss Paula Hawkins' new novel, Into the Water, coming May 2017.</div>
                        <div class="ample-banner-button">
                            <button>Read Now</button>
                            <div class="add-library">
                                <img src="images/plus.png" src="plus">
                                <span>Add to my library</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="item">
                <div class="ample-signin-banner">
                    <div class="ample-banner-right">
                        <div class="ample-banner-heading">The Girl on the Train</div>
                        <div class="ample-banner-subheading">The #1 New York Times Bestseller, USA Today Book of the Year, now a major motion picture starring Emily Blunt. Don't miss Paula Hawkins' new novel, Into the Water, coming May 2017.</div>
                        <div class="ample-banner-button">
                            <button>Read Now</button>
                            <div class="add-library">
                                <img src="images/plus.png" src="plus">
                                <span>Add to my library</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="item">
                <div class="ample-signin-banner">
                    <div class="ample-banner-right">
                        <div class="ample-banner-heading">The Girl on the Train</div>
                        <div class="ample-banner-subheading">The #1 New York Times Bestseller, USA Today Book of the Year, now a major motion picture starring Emily Blunt. Don't miss Paula Hawkins' new novel, Into the Water, coming May 2017.</div>
                        <div class="ample-banner-button">
                            <button>Read Now</button>
                            <div class="add-library">
                                <img src="images/plus.png" src="plus">
                                <span>Add to my library</span>
                            </div>
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
    <div class="sign-in-manage-left">
        <div class="unit active"><a href="javascript:void(0)">Currently reading</a></div>
        <div class="unit"><a href="javascript:void(0)">My library</a></div>
        <div class="unit"><a href="javascript:void(0)">My published books</a></div>
    </div>
    <div class="sign-in-manage-right">
        <img src="images/gear.png" alt="manage">
        <div>Manage</div>
    </div>
</div>
<div class="ample-signin-manage-section">
    <div class="unit">
        <div class="image">
            <img src="images/image5.jpg" alt="image">
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
    <div class="unit">
        <div class="image">
            <img src="images/image1.jpg" alt="image">
        </div>
        <div class="bar">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="text">
                10%
            </div>
        </div>
    </div>
    <div class="unit">
        <div class="image">
            <img src="images/image2.jpg" alt="image">
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
    <div class="unit">
        <div class="image">
            <img src="images/image3.jpg" alt="image">
        </div>
        <div class="bar">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="text">
                20%
            </div>
        </div>
    </div>
    <div class="unit">
        <div class="image">
            <img src="images/image4.jpg" alt="image">
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

</div>
<div class="sign-in-page-bar"></div>
<div class="ample-book-slot-slider">
    <div class="ample-row">
        <div class="ample-book-slot">Related Books</div>
        <div class="ample-book-view-all">
            <i class="fa fa-arrow-right"></i>
            <div class="view-all">view all</div>
        </div>
    </div>
    <div class="owl-carousel owl-theme home-slider owl-loaded owl-drag">
        <div class="owl-stage-outer">
            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: 0s; width: 3178px;">
                <div class="owl-item active" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image11.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item active" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image23.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item active" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image24.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item active" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image25.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image18.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image26.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image27.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image35.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image29.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image12.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image21.png" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image11.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
            </div>
        </div>
        <div class="owl-nav">
            <button type="button" role="presentation" class="owl-prev disabled"><span aria-label="Previous">‹</span></button>
            <button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button>
        </div>
        <div class="owl-dots disabled"></div>
    </div>
</div>
<div class="sign-in-page-bar"></div>
<div class="ample-book-slot-slider">
    <div class="ample-row">
        <div class="ample-book-slot">Featured Books</div>
        <div class="ample-book-view-all">
            <i class="fa fa-arrow-right"></i>
            <div class="view-all">view all</div>

        </div>
    </div>
    <div class="owl-carousel owl-theme home-slider owl-loaded owl-drag">
        <div class="owl-stage-outer">
            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: 0s; width: 3178px;">
                <div class="owl-item active" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image14.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item active" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image30.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item active" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image31.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item active" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image32.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image33.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image34.png" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image35.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image36.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image12.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image24.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image18.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
                <div class="owl-item" style="width: 244.805px; margin-right: 20px;">
                    <div class="item">
                        <div class="image"><img src="images/image26.jpg" alt="img1"></div>
                        <div class="ample-button">
                            <button>FREE</button>
                        </div>
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
@endsection