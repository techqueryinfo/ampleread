@extends('layouts.admin')

@section('content')

<!-- heading -->
<div class="admin-home">
    <!-- section one  -->
    <div class="heading">Main Slider</div>
    <div class="row-one">
        <div class="row add-banner">
            <div class="plus-banner">
                <i class="fas fa-plus" data-toggle="modal" data-target="#createHomeBannerModal"></i>

            </div>
            <div class="text">Add banner</div>

        </div>
        @if(!$banner_images->isEmpty())
        @php
        $image_name = "../images/bg-img.jpg";
        @endphp
        @foreach($banner_images as $banner_image)
        @if(!blank($banner_image->image_name))
        @php
        $image_name = $banner_image->image_name;
        @endphp
        @endif
        <div class="row">
            <div class="edit-delete image">
                <!-- <div class="edit"><a href="{{ url('/admin/homepage/' . $banner_image->id . '/edit') }}" title="Edit Book"><i class="fas fa-pencil-alt" data-toggle="modal" data-target="#editHomeBannerModal"></i></a></div> -->
                <form method="POST" action="{{ url('/admin/homepage' . '/' . $banner_image->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                <div class="delete" data-toggle = 'modal' data-target = '#confirmDelete' data-title = 'Delete Book' data-message = 'Are you sure you want to delete this banner image ?'><i class="far fa-trash-alt"></i></div>
                </form>
            </div>
            <img src="/uploads/ebook_logo/<?php echo $image_name ; ?>"/>
         <!-- <img src="../images/bg-img.jpg" /> -->
        <!-- <div class="layer"></div>-->

        </div>
        @endforeach
        @endif
        <!-- <div class="row last">
            <div class="edit-delete image">
                <div class="edit"><i class="fas fa-pencil-alt"></i></div>
                <div class="delete"><i class="far fa-trash-alt"></i></div>
            </div>
            <img src="../images/bg-img.jpg" />
            <!--<div class="layer"></div>-->

        <!-- </div> --> 
    </div>
    <!-- section two -->
    <div class="heading">Special Feature</div>
    <div class="row-two">
        <div class="row add-banner">
            <div class="plus-banner">
                <i class="fas fa-plus" data-toggle="modal" data-target="#createSpecialFeatureModal"></i>

            </div>
            <div class="text">Add banner</div>


        </div>
        @if(isset($home_books))
        @foreach($home_books as $home_book)
        <div class="slot-1">
            <div class="e-book1">
                @if(isset($home_book->home_books->ebook_logo))
                    @if($home_book->home_books->type == 'free')
                        <img src="/uploads/ebook_logo/{{ $home_book->home_books->ebook_logo }}"/>
                    @else
                        <img src="{{ $home_book->home_books->ebook_logo }}"/>
                    @endif
                @endif
            </div>
            @if(isset($home_book->home_books->ebooktitle))
            <div class="heading">{{$home_book->home_books->ebooktitle}}</div>
            @endif
            @if(isset($home_book->home_books->subtitle))
            <div class="sub-text">{{$home_book->home_books->subtitle}}</div>
            @endif
            <div class="edit-delete">
                <div class="edit">
                    @if(isset($home_book->home_books->id))
                    <a href="{{ url('/book/' . $home_book->home_books->id . '/edit') }}" title="Edit Book">
                    @endif
                    <i class="fas fa-pencil-alt"></i>
                    </a>
                </div>
                <form method="POST" action="{{ url('/admin/homepage/special_feature'. '/' . $home_book->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ csrf_field() }}
                <div class="delete" data-toggle = 'modal' data-target = '#confirmDelete' data-title = 'Delete Book' data-message = 'Are you sure you want to delete this e-Book from homepage ?'><i class="far fa-trash-alt"></i></div>
                </form>
            </div>
        </div>
        @endforeach
        @endif
        </div>
    <!-- section three-->
    <div class="section-three">
        <div class="left">
            <div class="circle">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
              <div class="text">Add banner</div>
              <div class="listing-category">
                <ul>
                    <li class="active">New Releases</li>
                    <li>Bestsellers</li>
                    <li>Classics</li>
                </ul>
              </div>
        </div>
        <div class="right">
            <div class="category-discription">
                <div class="category-name">
                    <div class="name">Bestsellers<i class="fas fa-pencil-alt"></i></div>
                    <div class="number">12 books</div>
                </div>
                <div class="category-action">
                    <i class="far fa-trash-alt"></i>
                    <span>Delete category</span>
                </div>
            </div>
            <div class="right-row-one">
                <div class="row add-banner">
                    <div class="plus-banner">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="text">Upload Book</div>
                </div>
                <div class=" row item">
                    <div class="edit-delete">
                        <div class="edit"><i class="fas fa-pencil-alt"></i></div>
                        <div class="delete"><i class="far fa-trash-alt"></i></div>
                    </div>
                    <div class="image"><img src="../images/image11.jpg" alt="img1"></div>
                    <div class="title">Kiss Me Someone: Stories book</div>
                    <div class="writer">Nathan Williams</div>
                </div>
                <div class=" row item">
                    <div class="edit-delete">
                        <div class="edit"><i class="fas fa-pencil-alt"></i></div>
                        <div class="delete"><i class="far fa-trash-alt"></i></div>
                    </div>
                    <div class="image"><img src="../images/image11.jpg" alt="img1"></div>
                    <div class="title">The Kinfolk Home: Interiors for Slow Living</div>
                    <div class="writer">Nathan Williams</div>
                </div>
            </div>
            <div class="right-row-one">
                <div class=" row item">
                    <div class="edit-delete">
                        <div class="edit"><i class="fas fa-pencil-alt"></i></div>
                        <div class="delete"><i class="far fa-trash-alt"></i></div>
                    </div>
                    <div class="image"><img src="../images/image11.jpg" alt="img1"></div>
                    <div class="title">The Kinfolk Home: Interiors for Slow Living</div>
                    <div class="writer">Nathan Williams</div>
                </div>
                <div class=" row item">
                    <div class="edit-delete">
                        <div class="edit"><i class="fas fa-pencil-alt"></i></div>
                        <div class="delete"><i class="far fa-trash-alt"></i></div>
                    </div>
                    <div class="image"><img src="../images/image11.jpg" alt="img1"></div>
                    <div class="title">The Kinfolk Home: Interiors for Slow Living</div>
                    <div class="writer">Nathan Williams</div>
                </div>
                <div class=" row item">
                    <div class="edit-delete">
                        <div class="edit"><i class="fas fa-pencil-alt"></i></div>
                        <div class="delete"><i class="far fa-trash-alt"></i></div>
                    </div>
                    <div class="image"><img src="../images/image11.jpg" alt="img1"></div>
                    <div class="title">The Kinfolk Home: Interiors for Slow Living</div>
                    <div class="writer">Nathan Williams</div>
                </div>
            </div>
        </div>
    </div>
    <!-- section three-->
<!-- modal for adding home banner image -->
<div id="createHomeBannerModal" class="modal fade createbook-Modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-text">Add Home Banner</div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="ample-login-signup">
        <div class="ample-login-section">
          <form action="{{ url('/admin/homepage') }}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}

           <div class="unit1">
            <div class="form-group">
              <input type="file" name="home_logo"><br/>
              <div class="col-md-2">
              </div>
              <button type="submit" class="submit-button">Upload Banner Image</button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
  <div class="modal-footer">
  </div>
</div>
</div>
</div>
<!-- modal for adding home special feature books -->
<div id="createSpecialFeatureModal" class="modal fade createbook-Modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-text">Add Special Feature Books</div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="ample-login-signup">
        <div class="ample-login-section">
          <form action="{{ url('/admin/homepage/special_feature') }}" method="POST">
            {{ csrf_field() }}
           <div class="unit1">
            <div class="form-group">
              <div class="form-unit">
            <div class="heading">Books</div>
            <div class="content">
                <input type="hidden" value="special_feature" name="type">
                <select name="book_id" class="form-control" id="selectbook" >
                  <option value="">Please select Book</option>
                    @if(isset($books))
                        @foreach ($books as $optionKey => $optionValue)
                            <option data-value="{{ $optionValue->id }}" value="{{ $optionValue->id }}"> {{ $optionValue->ebooktitle }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
              <div class="col-md-2">
              </div>
              <button type="submit" class="submit-button">Add</button>
            </div>
          </div>
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