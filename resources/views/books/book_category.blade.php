@extends('layouts.admin')
@section('content')
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
              <div class="text">Add banner</div>
              <div class="listing-category">
                <ul>
                  @foreach ($category_list as $optionKey => $optionValue)
                    @if(!blank($optionValue->is_delete) && $optionValue->is_delete==0)
                    <li @if($optionValue->category_slug == $category_name) class="active" @endif ><a style="color:black;" href="/books/category/{{$optionValue->category_slug}}">{{$optionValue->name}}</a></li>
                    @endif
                  @endforeach
                </ul>
              </div>
        </div>
        <div class="right">
          <div class="category-discription category-search">
            <div class="category-name">
              <div class="name">@if(!blank($category_name)) {{ucwords(str_replace('-', ' ', $category_name))}} @endif<i class="fas fa-pencil-alt" data-toggle="modal" data-target="#editCategoryModal"></i></div>
              <div class="number">12 books</div>
            </div>
            <div class="category-action">
              <span>
                <form method="POST" action="{{ url('/book/updateCategory' . '/' . $category->id) }}" accept-charset="UTF-8" style="display:inline">
                  {{ csrf_field() }}
                  <div style="text-align: right;cursor: pointer;" class="delete"  data-toggle = 'modal' data-target = '#confirmDelete' data-title = 'Delete Category' data-message = 'Are you sure you want to delete this Category ?'><i class="far fa-trash-alt"></i> Delete category</div>
                </form>
              </span>
            </div>
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
                <div class="text">Upload Book</div>
              </div>
              @if(!$books->isEmpty())
              @foreach($books as $book)
              <div class="row item">
                <div class="edit-delete">
                  <div class="edit"><a href="{{ url('/book/' . $book->id . '/edit') }}" title="Edit Book"><i class="fas fa-pencil-alt"></i></a></div>
                  <form method="POST" action="{{ url('/book' . '/' . $book->id) }}" accept-charset="UTF-8" style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="delete"  data-toggle = 'modal' data-target = '#confirmDelete' data-title = 'Delete Book' data-message = 'Are you sure you want to delete this e-Book ?'><i class="far fa-trash-alt"></i></div>
                  </form>
                </div>
                <div class="image"><img src="{{($book->ebook_logo) ? '/uploads/ebook_logo/'.$book->ebook_logo : '/images/image10.jpg' }}" alt="img1" /></div>
                <!-- <div class="ample-button"><button>FREE</button></div> -->
                <div class="title">{{$book->ebooktitle}}</div>
                <div class="writer">{{$book['user_name']['first_name']}} {{$book['user_name']['last_name']}}</div>
              </div>
              @endforeach
              @else
                Data not available
              @endif
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