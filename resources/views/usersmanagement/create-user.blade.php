@extends('layouts.admin')
@section('template_title')
  Create New User
@endsection
@section('template_fastload_css')
@endsection
@section('content')
{!! Form::open(array('action' => 'UsersManagementController@store',  'files' => true, 'enctype' =>"multipart/form-data")) !!}
<div class="admin-edit">
<div class="edit-one">
    <div class="image"><img src="../images/image1.jpg" id="profilePic" />
      <input type="file" id="user_avatar" name="avatar" style="display:none"/> 
    </div>
    <div class="button"><input type="button" id="OpenImgUpload" value="CHANGE IMAGE"></div>
</div>
<div class="edit-two">
    <!-- <div class="unit-1" style="width: 100%">
        <div class="form-unit">
            <div class="heading">Is Author</div>
            <div class="content" style="width: 48%">
                <select name="is_author" id="is_author">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
        </div>
    </div> -->
    <div class="unit-1">
        
        <div class="form-unit {{ $errors->has('name') ? ' has-error ' : '' }}">
            <div class="heading">Name</div>
            <div class="content">
              {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'Name')) !!}
              @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
        </div>
        <div class="form-unit {{ $errors->has('country_id') ? ' has-error ' : '' }}">
            <div class="heading">Country</div>
            <div class="content">
                <select name="country_id" class="form-control" id="selectcountry" >
                  <option value="">Please select Country</option>
                    @if(isset($countries))
                        @foreach ($countries as $optionKey => $optionValue)
                            <option data-value="{{ $optionValue->code }}" id="{{ $optionValue->code }}" value="{{ $optionValue->id }}"><img src="/flags/{{ strtolower($optionValue->code) }}.png"/> {{ $optionValue->countryname }}</option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('country_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('country_id') }}</strong>
                    </span>
                  @endif
            </div>
        </div>
        <div class="form-unit {{ $errors->has('password') ? ' has-error ' : '' }}">
            <div class="heading">Password</div>
            <div class="content">
                {!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('forms.create_user_ph_password'))) !!}
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
            </div>
        </div>
        
    </div>
    <div class="unit-2">
         
        <div class="form-unit {{ $errors->has('email') ? ' has-error ' : '' }}">
            <div class="heading">Email</div>
            <div class="content">
                {!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_email'))) !!}
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-unit">
            <div class="heading">Subscription</div>
            <div class="content">
                <select id="subscription" name="plan_id" class="form-control">
                    <option value="" selected="">Please select Plan</option>
                    @if(isset($plans))
                        @foreach ($plans as $optionKey => $optionValue)
                            <option value="{{ $optionValue->id }}">{{ $optionValue->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-unit {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">
            <div class="heading">Confirm Password</div>
            <div class="content">
                {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_pw_confirmation'))) !!}
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                  @endif
            </div>
        </div>
        <select class="form-control" name="role" id="role" style="display: none;">
          <option value="">{{ trans('forms.create_user_ph_role') }}</option>
          @if ($roles->count())
            @foreach($roles as $role)
              <option value="{{ $role->id }}" {{ 2 == $role->id ? 'selected="selected"' : '' }}>{{ $role->name }}</option>
            @endforeach
          @endif
        </select>
    </div>
    <div class="form-unit">
            <div class="heading">Author</div>
            <div class="checkbox">
                <input type="radio" name="is_author" value="1" /> Yes
                <input type="radio" name="is_author" value="0" checked="checked"  /> No
            </div>
        </div>
    <div class="form-unit">
            <div class="heading">Description</div>
            <div class="content">
                <textarea name="about_us" rows="6"></textarea>
            </div>
        </div>
</div>


</div>
<div class="save-cancel-btn">
    <div class="save">
        <input type="submit" value="Save" />
    </div>
    <div class="cancel">
        <label>Cancel</label>
    </div>
</div>
{!! Form::close() !!}

              

@endsection

@section('footer_scripts')

<script type="text/javascript">
$(document).ready(function(){
  function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        // console.log('e.target.result', e.target.result);
        $('#profilePic').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#user_avatar").change(function() {
    readURL(this);
  });

  $('#is_author').on('change', function() {
    if(this.value == 1)
    {

    }
  });
});
</script>

@endsection
