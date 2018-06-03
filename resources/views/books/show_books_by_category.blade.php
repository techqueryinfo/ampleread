@extends('layouts.app')

@section('template_title')
   Category 
@endsection

@section('template_fastload_css')
@endsection

@section('content')
  <div class="book-header">@if(!blank($category_name)) {{$category_name}} @endif</div>
  <div class="ebook-slot-1">
  <ul>
     @if (Session::get('category_list'))
                @foreach (Session::get('category_list') as $optionKey => $optionValue)
                <li @if($optionValue->name == $category_name) class="active" @endif ><a style="color:black;" href="/books/category/{{$optionValue->name}}">{{$optionValue->name}}</a></li>
                @endforeach
                @endif
      <!-- <li class="active">All books</li>
      <li>Biography</li>
      <li>Business</li>
      <li>Cookbooks, Food & Wine</li>
      <li>Diet, Health & Fitness</li>
      <li>Fiction</li>
      <li>Graphic Novels & Comics</li>
      <li>History</li>
      <li>Mystery & Crime</li>
      <li>Non-fiction
          <ul class="sub-list">
              <li>All books</li>
              <li>New releases</li>
              <li>Bestsellers<li>
              <li>New releases</li>
              <li>Trending now</li>
          </ul>
      </li> -->

  </ul>
  </div>
 <div class="ebook-slot-2">
   <div class="ample-book-slot-slider">
      <div class="ample-row">
           <div class="ample-book-slot">New Releases</div>
           <div class="ample-book-view-all">
               <i class="fa fa-arrow-right"></i>
               <div class="view-all">view all</div>

           </div>
       </div>
       <div class="owl-carousel owl-theme category-slider">
        @if(!$books->isEmpty())
        @foreach($books as $book)
           <div class="item">
                   <div class="image"><img src="{{($book->ebook_logo) ? '/uploads/ebook_logo/'.$book->ebook_logo : '/images/image10.jpg' }}" alt="img1" /></div>
               <div class="ample-button"><button>FREE</button></div>
               <div class="title">{{$book->ebooktitle}}</div>
               <div class="writer">{{$book['user_name']['first_name']}} {{$book['user_name']['last_name']}}</div>
               <div class="star-container">
                   <span class="fa fa-star checked"></span>
                   <span class="fa fa-star checked"></span>
                   <span class="fa fa-star checked"></span>
                   <span class="fa fa-star"></span>
                   <span class="fa fa-star"></span>
               </div>
           </div>
           @endforeach
           @else
           Data not available
           @endif
           
           <!-- <div class="item"><div class="image"><img src="images/image18.jpg" alt="img1" /></div>
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
           </div> -->
       </div>
   </div>
   <div class="line"></div>
   <div class="ample-book-slot-slider">
      <div class="ample-row">
           <div class="ample-book-slot">Bestsellers</div>
           <div class="ample-book-view-all">
               <i class="fa fa-arrow-right"></i>
               <div class="view-all">view all</div>

           </div>
       </div>
       <div class="owl-carousel owl-theme category-slider">
           
           @if(!$books->isEmpty())
        @foreach($books as $book)
           <div class="item">
               @if(!blank($book->ebook_logo))
                   <div class="image"><img src="{{($book->ebook_logo) ? '/uploads/ebook_logo/'.$book->ebook_logo :images/image10.jpg }}" alt="img1" /></div>
                   @endif
               <div class="ample-button"><button>FREE</button></div>
               <div class="title">{{$book->ebooktitle}}</div>
               <div class="writer">{{$book['user_name']['first_name']}} {{$book['user_name']['last_name']}}</div>
               <div class="star-container">
                   <span class="fa fa-star checked"></span>
                   <span class="fa fa-star checked"></span>
                   <span class="fa fa-star checked"></span>
                   <span class="fa fa-star"></span>
                   <span class="fa fa-star"></span>
               </div>
           </div>
           @endforeach
           @else
           Data not available
           @endif
       </div>
   </div>
   <div class="line"></div>
   <div class="ample-book-slot-slider">
      <div class="ample-row">
           <div class="ample-book-slot">Trending Now</div>
           <div class="ample-book-view-all">
               <i class="fa fa-arrow-right"></i>
               <div class="view-all">view all</div>

           </div>
       </div>
       <div class="owl-carousel owl-theme category-slider">
           
           @if(!$books->isEmpty())
        @foreach($books as $book)
           <div class="item">
               @if(!blank($book->ebook_logo))
                   <div class="image"><img src="{{($book->ebook_logo) ? '/uploads/ebook_logo/'.$book->ebook_logo :images/image10.jpg }}" alt="img1" /></div>
                   @endif
               <div class="ample-button"><button>FREE</button></div>
               <div class="title">{{$book->ebooktitle}}</div>
               <div class="writer">{{$book['user_name']['first_name']}} {{$book['user_name']['last_name']}}</div>
               <div class="star-container">
                   <span class="fa fa-star checked"></span>
                   <span class="fa fa-star checked"></span>
                   <span class="fa fa-star checked"></span>
                   <span class="fa fa-star"></span>
                   <span class="fa fa-star"></span>
               </div>
           </div>
           @endforeach
           @else
           Data not available
           @endif
       </div>
   </div>
   <div class="line"></div>
   <div class="ample-book-slot-slider">
      <div class="ample-row">
           <div class="ample-book-slot">All Non-Fiction Books</div>
           <div class="ample-book-view-all">
               <i class="fa fa-arrow-right"></i>
               <div class="view-all">view all</div>

           </div>
       </div>
       <div class="filter">
         <select id="userSorting">
             <option>A-Z</option>
             <option>B-Z</option>
             <option>C-Z</option>
             <option>D-Z</option>
             <option>E-Z</option>
             <option>F-Z</option>

         </select>
       </div>

       <div class="owl-carousel owl-theme category-slider">
           
           @if(!$books->isEmpty())
        @foreach($books as $book)
           <div class="item">
               @if(!blank($book->ebook_logo))
                   <div class="image"><img src="{{($book->ebook_logo) ? '/uploads/ebook_logo/'.$book->ebook_logo :images/image10.jpg }}" alt="img1" /></div>
                   @endif
               <div class="ample-button"><button>FREE</button></div>
               <div class="title">{{$book->ebooktitle}}</div>
               <div class="writer">{{$book['user_name']['first_name']}} {{$book['user_name']['last_name']}}</div>
               <div class="star-container">
                   <span class="fa fa-star checked"></span>
                   <span class="fa fa-star checked"></span>
                   <span class="fa fa-star checked"></span>
                   <span class="fa fa-star"></span>
                   <span class="fa fa-star"></span>
               </div>
           </div>
           @endforeach
           @else
           Data not available
           @endif
       </div>
   </div>
 </div>

@endsection

@section('footer_scripts')
@endsection