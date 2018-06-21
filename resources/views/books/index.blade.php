@extends('layouts.admin')
@section('content')
	@if(Session::has('flash_message'))
    <div class="alert alert-success alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success!</strong> {{Session::get('flash_message')}}.
    </div>
    @endif
    <form method="GET" action="{{ url('/book/') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
		<div class="search-section">
			<div class="search-icon">
				<i class="fas fa-search"></i>
			</div>
			<input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
		</div>
	</form>
	<div class="sorting-section">
        <div class="sorting-left">
        </div>
        <div class="sorting-right" style="width: 100px !important;">
            <a href="{{ url('/book/create') }}">
            <div class="circle">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <label>Add Book</label>
            </a>
        </div>
    </div>
    <div class="container">        
      <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>E-Book Title</th>
                    <th>Sub Title</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $item)
                <tr>
                    <td>{{ $loop->iteration or $item->id }}</td>
                    <td>{{ $item->ebooktitle }}</td>
                    <td>{{ $item->subtitle }}</td>
                    <td>{{ ucfirst($item->type) }}</td>
                    <td>
                        <div class="edit">
                            <a href="{{ url('/book/' . $item->id . '/edit') }}" title="Edit Book">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </div>
                        <form method="POST" action="{{ url('/book' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <div class="delete" data-toggle = 'modal' data-target = '#confirmDelete' data-title = 'Delete Book' data-message = 'Are you sure you want to delete this e-Book ?'><i class="far fa-trash-alt"></i></div>
                        </form>
                    </td>
                </tr>
                @endforeach
                <span id="user_count"></span>
                <span id="user_pagination">
                    {!! $books->appends(['search' => Request::get('search')])->render() !!}
                </span>
            </tbody>
        </table>
    </div>
@include('modals.modal-delete')
@endsection
@section('footer_scripts')
    @include('scripts.delete-modal-script')
@endsection