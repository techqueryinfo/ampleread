@extends('layouts.admin')
@section('content')
<div class="book-header">@if(!blank($category)) {{$category->name}} <div class="edit">
                                <button data-toggle="modal" data-target="#editCategoryModal">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </div> @endif</div>
  <div class="ebook-slot-1">
  	<div class="sorting-right" style="width:125px">
            <button data-toggle="modal" data-target="#createCategoryModal">
            <div class="circle">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <label>Add Category</label>
            </button>
        </div>
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
      <!-- <div class="ample-row">
           <div class="ample-book-slot">New Releases</div>
           <div class="ample-book-view-all">
               <i class="fa fa-arrow-right"></i>
               <div class="view-all">view all</div>

           </div>
       </div> -->
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
           
       </div>
   </div>
   
       </div>

       <!-- modal -->
<div id="createCategoryModal" class="modal fade createbook-Modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-text">category info</div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="ample-login-signup">
        <div class="ample-login-section">
          <form method="POST" action="{{ url('/admin/categories') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}

        @include ('admin.categories.form')

    </form>
      </div>

    </div>
  </div>
  <div class="modal-footer">
  </div>
</div>
</div>
</div>

<!-- modal -->
<div id="editCategoryModal" class="modal fade createbook-Modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-text">category info</div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="ample-login-signup">
        <div class="ample-login-section">
          <form method="POST" action="{{ url('/admin/categories/' . $category->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.categories.form', ['submitButtonText' => 'Update'])

                        </form>
      </div>

    </div>
  </div>
  <div class="modal-footer">
  </div>
</div>
</div>
</div>


@include('modals.modal-delete')
@endsection
@section('footer_scripts')
    @include('scripts.delete-modal-script')
@endsection