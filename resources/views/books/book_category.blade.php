@extends('layouts.admin') @section('content')
<!-- heading -->
<div class="admin-home">
    <!-- search bar-->
    <div class="search-section book-search">
        <div class="search-icon">
            <i class="fas fa-search"></i>
        </div>
        <input type="text" placeholder="Search by Title, Author, ISBN">
    </div>
    <!-- section three-->
    <div class="section-three">
        <div class="left">
            <div class="circle">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <div class="text" style="cursor: pointer;"><a data-toggle="modal" data-target="#creatcategoryModal">Add Category</a></div>
            <div class="listing-category">
                <ul>
                    @if(!$categories->isEmpty()) @foreach ($categories as $optionKey => $optionValue) @if(!blank($optionValue->is_delete) && $optionValue->is_delete==0)
                    <li @if($optionValue->category_slug == $category_name) class="active" @endif ><a style="color:black;" href="/books/category/{{$optionValue->category_slug}}">{{$optionValue->name}}</a></li>
                    @endif @endforeach @else Data not available ! @endif
                </ul>
            </div>
        </div>
        <div class="right">
            <div class="category-discription category-search">
                <div class="category-name">
                    <div class="name">@if(!blank($category_name)) {{ucwords(str_replace('-', ' ', $category_name))}}@endif @if($category_name != 'all-books')
                        <i class="fas fa-pencil-alt" data-toggle="modal" data-target="#editCategoryModal"></i> @endif
                    </div>
                    <div class="number">12 books</div>
                </div>
                @if($category_name != 'all-books')
                <div class="category-action">
                    <span>
                <form method="POST" action="{{ url('admin/books/category' . '/' . $category->id) }}" accept-charset="UTF-8" enctype="multipart/form-data" style="display:inline">
                  {{ csrf_field() }}
                  <div style="text-align: right;cursor: pointer;" class="delete"  data-toggle = 'modal' data-target = '#confirmDelete' data-title = 'Delete Category' data-message = 'Are you sure you want to delete this Category ?'><i class="far fa-trash-alt"></i> Delete category</div>
                </form>
              </span>
                </div>
                @endif
            </div>
            <select id="userSorting">
                <option>A-Z</option>
                <option>B-Z</option>
                <option>C-Z</option>
                <option>D-Z</option>
                <option>E-Z</option>
                <option>F-Z</option>
            </select>
            <div class="right-row-one">
                <div class="row add-banner">
                    <div class="plus-banner">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="text"><a href="/book/create">Create E-Book</a></div>
                </div>
                @if(!$records->isEmpty()) @foreach($records as $book)
                <div class="row item">
                    <div class="edit-delete">
                        <div class="edit"><a href="{{ url('/book/' . $book->id . '/edit') }}" title="Edit Book"><i class="fas fa-pencil-alt"></i></a></div>
                        <form method="POST" action="{{ url('/book' . '/' . $book->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }} {{ csrf_field() }}
                            <div class="delete" data-toggle='modal' data-target='#confirmDelete' data-title='Delete Book' data-message='Are you sure you want to delete this e-Book ?'><i class="far fa-trash-alt"></i></div>
                        </form>
                    </div>
                    <div class="image">
                        @if($book->type == 'free')
                        <img src="{{($book->ebook_logo) ? '/uploads/ebook_logo/'.$book->ebook_logo : '/uploads/ebook_logo/image10.jpg' }}" alt="img1" /> @else
                        <img src="{{$book->ebook_logo}}" alt="img1" /> @endif
                    </div>
                    <!-- <div class="ample-button"><button>FREE</button></div> -->
                    <div class="title">{{$book->ebooktitle}}</div>
                    <div class="writer">{{$book->first_name}} {{$book->last_name}}</div>
                </div>
                @endforeach @else Data not available @endif
            </div>
        </div>
    </div>
    <!-- modal -->
    <div id="editCategoryModal" class="modal fade createbook-Modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-text">Category Info</div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="ample-login-signup">
                        <div class="ample-login-section">
                            <form method="POST" action="{{ url('/admin/categories/' . $category->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                {{ method_field('PATCH') }} {{ csrf_field() }} @include ('admin.categories.form', ['submitButtonText' => 'Update'])
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
</div>
</div>
@include('modals.modal-delete') @endsection @section('footer_scripts') @include('scripts.delete-modal-script') @endsection
<style type="text/css">
    .ample-login-signup {
        padding: 0px, 25px !important;
    }
    
    .createbook-Modal .modal-body .ample-login-section {
        margin-top: 0px !important
    }
    
    .createbook-Modal .modal-footer {
        border: 0px !important
    }
</style>