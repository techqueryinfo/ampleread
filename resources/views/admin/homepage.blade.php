@extends('layouts.admin') @section('content') @if(Session::has('flash_message'))
<div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> {{Session::get('flash_message')}}.
</div>
@endif
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
        @if(!$banner_images->isEmpty()) @php $image_name = "../images/bg-img.jpg"; @endphp @foreach($banner_images as $banner_image) @if(!blank($banner_image->image_name)) @php $image_name = $banner_image->image_name; @endphp @endif
        <div class="row">
            <div class="edit-delete image">
                <form method="POST" action="{{ url('/admin/homepage' . '/' . $banner_image->id) }}" accept-charset="UTF-8" style="display:inline">
                    {{ method_field('DELETE') }} {{ csrf_field() }}
                    <div class="delete" data-toggle='modal' data-target='#confirmDelete' data-title='Delete Book' data-message='Are you sure you want to delete this banner image ?'><i class="far fa-trash-alt"></i></div>
                </form>
            </div>
            <img src="/uploads/ebook_logo/<?php echo $image_name ; ?>" />
        </div>
        @endforeach @endif
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
        @if(isset($home_books)) @foreach($home_books as $home_book)
        <div class="slot-1">
            <div class="e-book1">
                @if(isset($home_book->home_books->ebook_logo)) @if($home_book->home_books->type == 'free')
                <img src="/uploads/ebook_logo/{{ $home_book->home_books->ebook_logo }}" /> @else
                <img src="{{ $home_book->home_books->ebook_logo }}" /> @endif @endif
            </div>
            @if(isset($home_book->home_books->ebooktitle))
            <div class="heading">{{str_limit($home_book->home_books->ebooktitle, 20)}}</div>
            @endif @if(isset($home_book->home_books->subtitle))
            <div class="sub-text">{{str_limit($home_book->home_books->subtitle, 50)}}</div>
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
                    <div class="delete" data-toggle='modal' data-target='#confirmDelete' data-title='Delete Book' data-message='Are you sure you want to delete this e-Book from homepage ?'><i class="far fa-trash-alt"></i></div>
                </form>
            </div>
        </div>
        @endforeach @endif
    </div>
    <!-- section three-->
    <div class="section-three">
        <div class="left">
            <div class="circle">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <div class="text" data-toggle="modal" data-target="#creatcategoryModal" style="cursor: pointer;">Add Category</div>
            <div class="listing-category">
                <ul>
                    <li @if(isset($category_name) && $category_name=='new_releases' ) class="active" @elseif(!isset($category_name)) class="active" @endif><a href="/admin/homepage/new_releases">New Releases</a></li>
                    <li @if(isset($category_name) && $category_name=='bestsellers' ) class="active" @endif><a href="/admin/homepage/bestsellers">Bestsellers</a></li>
                    <li @if(isset($category_name) && $category_name=='classics' ) class="active" @endif><a href="/admin/homepage/classics">Classics</a></li>
                </ul>
            </div>
        </div>
        <div class="right">
            <div class="category-discription">
                <div class="category-name">
                    <div class="name">
                        @if(isset($category_name)) {{ ucwords(str_replace("_", " ", $category_name))}} @else New Releases @endif
                    </div>
                    <div class="number">@if(isset($count)){{$count}} books @endif</div>
                </div>
                <div class="category-action">
                    <i class="far fa-trash-alt"></i>
                    <span>Delete category</span>
                </div>
            </div>
            <div class="right-row-one">
                <div class="row add-banner">
                    <div class="plus-banner">
                        <i class="fas fa-plus" data-toggle="modal" data-target="#uploadBook"></i>
                    </div>
                    <div class="text">Upload Book</div>
                </div>
                @if(!$new_releases->isEmpty()) @foreach($new_releases as $key => $val) @if($key
                <=1 ) <div class=" row item">
                    <div class="edit-delete">
                        <div class="edit"><a href="{{ url('/book/' . $val->home_books->id . '/edit') }}" title="Edit Book"><i class="fas fa-pencil-alt"></i></a></div>
                        <div class="delete">
                            <form method="POST" action="{{ url('/admin/homepage/special_feature'. '/' . $val->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ csrf_field() }}
                                <div class="delete" data-toggle='modal' data-target='#confirmDelete' data-title='Delete Book' data-message='Are you sure you want to delete this e-Book from homepage list ?'><i class="far fa-trash-alt"></i></div>
                            </form>
                        </div>
                    </div>
                    <div class="image">
                        @if(isset($val->home_books->ebook_logo)) @if($val->home_books->type == 'free')
                        <img src="/uploads/ebook_logo/{{ $val->home_books->ebook_logo }}" alt="img1" /> @else
                        <img src="{{ $val->home_books->ebook_logo }}" alt="img1" /> @endif @endif
                    </div>
                    <div class="title">{{ str_limit($val->home_books->ebooktitle, 10) }}</div>
                    <div class="writer">{{ str_limit($val->home_books->subtitle, 20) }}</div>
            </div>
            @endif @endforeach @else Data not available ! @endif
        </div>
        <div class="right-row-one">
            @if(!$new_releases->isEmpty()) @foreach($new_releases as $key => $val) @if($key >= 2)
            <div class=" row item">
                <div class="edit-delete">
                    <div class="edit"><a href="{{ url('/book/' . $val->home_books->id . '/edit') }}" title="Edit Book"><i class="fas fa-pencil-alt"></i></a></div>
                    <div class="delete">
                        <form method="POST" action="{{ url('/admin/homepage/special_feature'. '/' . $val->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ csrf_field() }}
                            <div class="delete" data-toggle='modal' data-target='#confirmDelete' data-title='Delete Book' data-message='Are you sure you want to delete this e-Book from homepage list ?'><i class="far fa-trash-alt"></i></div>
                        </form>
                    </div>
                </div>
                <div class="image">
                    @if(isset($val->home_books->ebook_logo)) @if($val->home_books->type == 'free')
                    <img src="/uploads/ebook_logo/{{ $val->home_books->ebook_logo }}" alt="img1" /> @else
                    <img src="{{ $val->home_books->ebook_logo }}" alt="img1" /> @endif @endif
                </div>
                <div class="title">{{ $val->home_books->ebooktitle }}</div>
                <div class="writer">{{ $val->home_books->subtitle }}</div>
            </div>
            @endif @endforeach @else Data not available ! @endif
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
                                    <input type="file" name="home_logo">
                                    <br/>
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
                                            <select name="book_id" class="form-control" id="selectbook">
                                                <option value="">Please select Book</option>
                                                @if(isset($books)) @foreach ($books as $optionKey => $optionValue)
                                                <option data-value="{{ $optionValue->id }}" value="{{ $optionValue->id }}"> {{ $optionValue->ebooktitle }}</option>
                                                @endforeach @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                    <br/>
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
<div id="uploadBook" class="modal fade createbook-Modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- <div class="modal-text">Add Special Feature Books</div> -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="ample-login-signup">
                    <div class="ample-login-section">
                        <form action="{{ url('/admin/homepage/add_book') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="unit1">
                                <div class="form-group">
                                    <div class="form-unit">
                                        <div class="heading">Books</div>
                                        <div class="content">
                                            <select name="book_id" class="form-control" id="selectbook">
                                                <option value="">Please select Book</option>
                                                @if(isset($books)) @foreach ($books as $optionKey => $optionValue)
                                                <option data-value="{{ $optionValue->id }}" value="{{ $optionValue->id }}"> {{ $optionValue->ebooktitle }}</option>
                                                @endforeach @endif
                                            </select>
                                            <select name="type" class="form-control" id="book_tag">
                                                <option value="new_releases">New Releases</option>
                                                <option value="bestsellers">Bestsellers</option>
                                                <option value="classics">Classics</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br/>
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
<div id="creatcategoryModal" class="modal fade createbook-Modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-text">Add Category</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="ample-login-signup">
                    <div class="ample-login-section">
                        <form method="POST" action="{{ url('/admin/categories') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="unit1" style="width: 30%">
                                <div class="form-group">
                                    <div class="heading">Name</div>
                                </div>
                            </div>
                            <div class="unit2">
                                <div class="form-group">
                                    <input class="form-control" name="status" type="hidden" id="status" value="Active" required="required">
                                    <input class="form-control" name="name" type="text" id="name" required="required"> {!! $errors->first('name', '
                                    <p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="unit1">
                                <div class="form-group">
                                    <button type="submit" class="submit-button">Save</button>
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
@include('modals.modal-delete') @endsection @section('footer_scripts') @include('scripts.delete-modal-script') @endsection