@extends('layouts.admin')

@section('template_title')
  Showing Users
@endsection

@section('template_linked_css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <style type="text/css" media="screen">
        .users-table {
            border: 0;
        }
        .users-table tr td:first-child {
            padding-left: 15px;
        }
        .users-table tr td:last-child {
            padding-right: 15px;
        }
        .users-table.table-responsive,
        .users-table.table-responsive table {
            margin-bottom: 0;
        }

    </style>
@endsection

@section('content')
    <div class="sorting-section">
        <div class="sorting-left">
            <select id="userSorting">
                <option>A-Z</option>
                <option>B-Z</option>
                <option>C-Z</option>
                <option>D-Z</option>
                <option>E-Z</option>
                <option>F-Z</option>

            </select>
        </div>
        <div class="sorting-right">
            <div class="circle">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <label>Add user</label>
        </div>
    </div>
    @include('partials.search-users-form')
        <div class="listing">
            <div class="listing-1">
                <div class="image"></div>
                <div class="name">Name</div>
                <div class="sub-name">@email</div>
            </div>
            <div class="listing-2">Membership</div>
            <div class="listing-3">
                <div class="map"></div>
                <div class="name">Country</div>
            </div>
            <div class="listing-4">
                <div class="edit">Action</div>
            </div>
        </div>
                @foreach($users as $user)
                    <div class="listing">
                        <div class="listing-1">
                            <div class="image"><img src="../images/image1.jpg"></div>
                            <div class="name">{{$user->name}}</div>
                            <div class="sub-name">{{$user->email}}</div>
                        </div>
                        <div class="listing-2">Free Member</div>
                        <div class="listing-3">
                            <div class="map"><img src="./flags/{{strtolower($user->country->code)}}.png"/></div>
                            <div class="name">{{$user->country->countryname}}</div>
                        </div>
                        <div class="listing-4">
                            <div class="edit">
                                <a href="{{ URL::to('users/' . $user->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </div>
                            @if (!$user->isAdmin())
                                {!! Form::open(array('url' => 'users/' . $user->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    <div class="delete" data-toggle = 'modal' data-target = '#confirmDelete' data-title = 'Delete User' data-message = 'Are you sure you want to delete this user ?'><i class="far fa-trash-alt"></i></div>
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                @endforeach

        <span id="user_count"></span>
        <span id="user_pagination">
            {{ $users->links() }}
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

    {{-- @if(config('laravelusers.enableSearchUsers')) --}}
        @include('scripts.search-users')
    {{-- @endif --}}

@endsection
