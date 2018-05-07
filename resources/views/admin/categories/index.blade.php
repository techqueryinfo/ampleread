@extends('layouts.admin')

@section('template_title')
  Showing Users
@endsection


@section('content')
    <form method="GET" action="{{ url('/admin/categories') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
    <div class="search-section">
        <div class="search-icon">
            <i class="fas fa-search"></i>
        </div>
        <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
    </div>
    </form>
    <div class="sorting-section">
        <div class="sorting-left">
            <!-- <select id="userSorting">
                <option>A-Z</option>
                <option>B-Z</option>
                <option>C-Z</option>
                <option>D-Z</option>
                <option>E-Z</option>
                <option>F-Z</option>

            </select> -->
        </div>
        <div class="sorting-right" style="width:125px">
            <a href="{{ url('/admin/categories/create') }}">
            <div class="circle">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <label>Add Category</label>
            </a>
        </div>
    </div>
        <div class="listing">
            <div class="listing-2">#</div>
            <div class="listing-1">Name</div>
            <div class="listing-2">Status</div>
            <div class="listing-4">
                <div class="edit">Action</div>
            </div>
        </div>
                @foreach($categories as $item)
                    <div class="listing">
                        <div class="listing-2">{{ $loop->iteration or $item->id }}</div>
                        <div class="listing-1">{{ $item->name }}</div>
                        <div class="listing-2">{{ $item->status }}</div>
                        <div class="listing-4">
                            <div class="edit">
                                <a href="{{ url('/admin/categories/' . $item->id . '/edit') }}" title="Edit Category">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </div>
                            <form method="POST" action="{{ url('/admin/categories' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <div class="delete" data-toggle = 'modal' data-target = '#confirmDelete' data-title = 'Delete Category' data-message = 'Are you sure you want to delete this Category ?'><i class="far fa-trash-alt"></i></div>
                            </form>
                        </div>
                    </div>
                @endforeach

        <span id="user_count"></span>
        <span id="user_pagination">
            {!! $categories->appends(['search' => Request::get('search')])->render() !!}
        </span>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    {{--
        @include('scripts.tooltips')
    --}}


@endsection
