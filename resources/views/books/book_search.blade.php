@extends('layouts.admin') @section('content')
    <div class="admin-home">
        <!-- search bar-->
        <div class="search-section book-search">
            <div class="search-icon">
                <i class="fas fa-search"></i>
            </div>
            <input type="text"  placeholder="Search by Title, Author, ISBN" id="bookSearchInput1"  name="book_search" value="{{(!empty($search_text)) ? $search_text : ''}}">
    </div>
    <!-- section three-->
    <script>
        $(document).ready(function() {
            $('#bookSearchInput1').keypress(function (e) {
                if (e.which == 13) {
                    // $('form#login').submit();
                    console.log($(this).val());
                    var stext = $(this).val();
                    if(stext){
                        window.location.href='/book/search1/'+stext;
                    }
                    return false;    // Add this line
                }
            });
        });
    </script>
        <!-- section three-->
        <div class="section-three">
            <div class="left">
                <div class="circle">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </div>
                <div class="text" style="cursor: pointer;"><a data-toggle="modal" data-target="#creatcategoryModal">Add Category</a></div>
                <div class="listing-category">
                    <ul>
                        <li @if($category_name == 'all-books') class="active" @endif ><a style="color:black;" href="/books/category/all-books">All Books</a></li>
                        @if(!$categories->isEmpty()) @foreach ($categories as $optionKey => $optionValue) @if(!blank($optionValue->is_delete) && $optionValue->is_delete==0)
                            <li @if($optionValue->category_slug == $category_slug) class="active" @endif ><a style="color:black;" href="/books/category/{{$optionValue->category_slug}}">{{$optionValue->name}}</a></li>
                            @if($subcategory && $category_slug == $optionValue->category_slug)
                                <ul style="padding-left: 50px">
                                    @foreach ($subcategory as $sKey => $sValue)
                                        @if(!blank($sValue->is_delete) && $sValue->is_delete==0)
                                            <li @if($sValue->id == $category->id) class="active" @endif ><a style="color:black;" href="/books/category/{{$optionValue->category_slug}}/{{$sValue->category_slug}}">{{$sValue->name}}</a></li>
                                        @endif @endforeach
                                </ul>
                            @endif
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
                        <div class="number">{{$total}} books</div>
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
                        <a href="{{ url('book/ebookupload') }}"><div class="plus-banner">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="text">Upload E-Book</div></a>
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
                                @if(substr($book->ebook_logo, 0, 4) == "http")
                                    <img src="{{$book->ebook_logo}}" alt="img1" />
                                @else
                                    <img src="/uploads/ebook_logo/{{$book->ebook_logo}}" alt="img1" />
                                @endif
                            </div>
                            <div class="title">{{$book->ebooktitle}}</div>
                            <div class="writer">{{$book->first_name}} {{$book->last_name}}</div>
                        </div>
                    @endforeach @else Data not available @endif
                </div>
            </div>
        </div>
        <!-- modal -->
        @if($category_name != 'all-books')
            <div id="editCategoryModal" class="modal fade createbook-Modal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-text">Edit Category</div>
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
        @endif
        <div id="creatcategoryModal" class="modal fade createbook-Modal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-text">Add Category / Sub Category</div>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="ample-login-signup">
                            <div class="ample-login-section">
                                <form method="POST" action="{{ url('/admin/categories') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="form-group">
                                            <label for="category" class="col-sm-3 control-label">Add Category</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="answerInput" list="categories" name="name" placeholder="e.g. JavaScript" autocomplete="false" required>
                                                <datalist id="categories">
                                                    @if(!$categories->isEmpty()) @foreach ($categories as $optionKey => $optionValue) @if(!blank($optionValue->is_delete) && $optionValue->is_delete==0)
                                                        <option data-value="{{$optionValue->id}}">{{$optionValue->name}}</option>
                                                    @endif @endforeach @endif
                                                </datalist>
                                                <input type="hidden" name="parent_category_id" id="answerInput-hidden">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="subcategory" class="col-sm-3 control-label">Add Sub Category</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="subcategory" id="subcategory" placeholder="Type Sub Category">
                                            </div>
                                        </div>

                                    </div>





                                    {{-- <div class="unit1" style="width: 30%">
                                         <div class="form-group">
                                             <div class="heading">Name</div>
                                         </div>
                                     </div>--}}
                                    {{--<div class="unit2">
                                        <div class="form-group">
                                            <input class="form-control" name="status" type="hidden" id="status" value="Active" required="required">
                                            <input class="form-control" name="name" type="text" id="name" required="required"> {!! $errors->first('name', '
                                            <p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>--}}
                                    <div class="unit1" style="width: 100%; text-align: center;">
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
    @include('modals.modal-delete') @endsection
@section('footer_scripts')
    <script type="text/javascript">
        document.querySelector('input[list]').addEventListener('input', function(e) {
            var input = e.target,
                list = input.getAttribute('list'),
                options = document.querySelectorAll('#' + list + ' option'),
                hiddenInput = document.getElementById(input.id + '-hidden'),
                inputValue = input.value;

            hiddenInput.value = inputValue;

            for(var i = 0; i < options.length; i++) {
                var option = options[i];

                if(option.innerText === inputValue) {
                    hiddenInput.value = option.getAttribute('data-value');
                    break;
                }
            }
        });
    </script>
    @include('scripts.delete-modal-script')
@endsection
<style type="text/css">
    .ample-login-signup { padding: 0px, 25px !important; }.createbook-Modal .modal-body .ample-login-section { margin-top: 0px !important }.createbook-Modal .modal-footer { border: 0px !important }
    .admin-container .admin-right .save-cancel-btn {
        width: 100%;
        float: left;
        margin: 0px !important;
    }
</style>
