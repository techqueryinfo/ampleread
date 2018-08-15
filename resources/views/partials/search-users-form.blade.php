{!! Form::open(['route' => 'search-users', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'id' => 'search_users']) !!}
    {!! csrf_field() !!}
    <div class="search-section">
        <div class="search-icon" id="search_trigger">
            <i class="fas fa-search"></i>
        </div>
        {!! Form::text('user_search_box', NULL, ['id' => 'user_search_box', 'class' => 'form-control', 'placeholder' => trans('usersmanagement.search.search-users-ph'), 'aria-label' => trans('usersmanagement.search.search-users-ph'), 'required' => false]) !!}
        <a href="#" class="input-group-addon btn btn-warning clear-search" data-toggle="tooltip" title="@lang('lusersmanagement.tooltips.clear-search')" style="display:none;">
            <i class="fa fa-times" aria-hidden="true"></i>
            <span class="sr-only">
                @lang('lusersmanagement.tooltips.clear-search')
            </span>
        </a>
    </div>
{!! Form::close() !!}    

