@extends('layouts.admin')

@section('template_title')
  Editing User {{ $user->name }}
@endsection

@section('content')
{!! Form::model($user, array('action' => array('UsersManagementController@update', $user->id), 'method' => 'PUT')) !!}
    {!! csrf_field() !!}
<div class="admin-edit">
<div class="edit-one">
    <div class="image"><img src="../images/image1.jpg" /></div>
    <div class="button"><input type="submit" value="CHANGE IMAGE"></div>
</div>
<div class="edit-two">
    <div class="unit-1">
        <div class="form-unit {{ $errors->has('name') ? ' has-error ' : '' }}"" >
            <div class="heading">Name</div>
            <div class="content">
                {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('forms.ph-username'))) !!}
            </div>
        </div>
        <div class="form-unit">
            <div class="heading">Country</div>
            <div class="content">
                <select name="country" class="form-control" id="country" >
                    <option value="" selected="">Please select country</option>
                    @if(isset($countries))
                        @foreach ($countries as $optionKey => $optionValue)
                            <option value="{{ $optionValue->code }}"><img src="/flags/{{ $optionValue->code }}.png'"/> {{ $optionValue->countryname }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-unit">
            <div class="heading">Profile Pic</div>
            <div class="content">
                <input type="file" name="avatar" value="">
            </div>
        </div>
    </div>
    <div class="unit-2">
        <div class="form-unit">
            <div class="heading">Email</div>
            <div class="content">
                {!! Form::text('email', old('email'), array('id' => 'email', 'class' => 'form-control', 'placeholder' => trans('forms.ph-useremail'), 'readonly' => true)) !!}
            </div>
        </div>
        <div class="form-unit">
            <div class="heading">Subscription</div>
            <div class="content">
                <select id="subcription" class="form-control">
                    <option value="" selected="">Please select Plan</option>
                    @if(isset($plans))
                        @foreach ($plans as $optionKey => $optionValue)
                            <option value="{{ $optionValue->id }}">{{ $optionValue->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-unit">
            <div class="heading">Status</div>
            <div class="content">
                <select id="status" name="status" class="form-control">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
        </div>
    </div>
</div>


</div>
<div class="save-cancel-btn">
    <div class="save">
        <input type="submit" value="Save" data-toggle="modal" data-target="#confirmSave" data-title="Confirm Save" data-message="Please confirm your changes."/>
    </div>
    <div class="cancel">
        <label>Cancel</label>
    </div>
</div>
{!! Form::close() !!}


  @include('modals.modal-save')
  @include('modals.modal-delete')

@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
  @include('scripts.check-changed')

@endsection