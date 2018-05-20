 @extends('layouts.app')

@section('template_title')
	{{ $user->name }}'s Profile
@endsection

@section('template_fastload_css')

	#map-canvas{
		min-height: 300px;
		height: 100%;
		width: 100%;
	}

@endsection

@section('content')
<div class="user-container">
    <div class="user-sections">
      <div class="unit active" data-attr="user-general">
        <a href="#">General</a>
      </div>
      <div class="unit" data-attr="user-password">
        <a href="#">Password</a>
      </div>
      <div class="unit" data-attr="user-subscription">
        <a href="#">Subscription</a>
      </div>
    </div>
    {!! Form::model($user, array('action' => array('ProfilesController@updateUserAccount', $user->id), 'method' => 'PUT', 'id' => 'user_basics_form', 'files' => true, 'enctype' =>"multipart/form-data")) !!}

	{!! csrf_field() !!}
    <div class="user-general active">
      <div class="user-image">
        <div class="image"><img src="{{($user->profile && $user->profile->avatar) ? '/uploads/avatar/'.$user->profile->avatar : '/images/image1.jpg'}}" />
        <input type="file" id="user_avatar" name="avatar" style="display:none"/>
    </div>
      </div>
      <div class="user-button">
      <input type="button" value="Change image" id="OpenImgUpload">
      </div>
      <div class="form-group">
      	<div class="form-unit form-group {{ $errors->has('name') ? ' has-error ' : '' }}">
      		{!! Form::label('name', 'Username' , array('class' => 'heading')); !!}
      			<div class="content">
      				{!! Form::text('name', $user->name , array('id' => 'name',  'placeholder' => trans('forms.ph-username'))) !!}
      			</div>
              @if ($errors->has('name'))
            <span class="help-block">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
      	</div>

      	<div class="form-unit form-group {{ $errors->has('email') ? ' has-error ' : '' }}">
      		{!! Form::label('email', 'E-mail' , array('class' => 'heading')); !!}
      			<div class="content">
      				{!! Form::text('email', $user->email, array('id' => 'email','placeholder' => trans('forms.ph-useremail'))) !!}
      			</div>
              @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
      	</div>

      	<div class="form-unit form-group {{ $errors->has('first_name') ? ' has-error ' : '' }}">
      		{!! Form::label('first_name', trans('forms.create_user_label_firstname'), array('class' => 'heading')); !!}
      			<div class="content">
      				{!! Form::text('first_name', $user->first_name, array('id' => 'first_name',  'placeholder' => trans('forms.create_user_ph_firstname'))) !!}
      			</div>
      			@if ($errors->has('first_name'))
      			<span class="help-block">
      				<strong>{{ $errors->first('first_name') }}</strong>
      			</span>
      			@endif
      	</div>

      	<div class="form-unit form-group {{ $errors->has('last_name') ? ' has-error ' : '' }}">
      		{!! Form::label('last_name', trans('forms.create_user_label_lastname'), array('class' => 'heading')); !!}
      			<div class="content">
      				{!! Form::text('last_name', $user->last_name, array('id' => 'last_name', 'placeholder' => trans('forms.create_user_ph_lastname'))) !!}
      			</div>
      			@if ($errors->has('last_name'))
      			<span class="help-block">
      				<strong>{{ $errors->first('last_name') }}</strong>
      			</span>
      			@endif
      	</div>

      	<div class="form-unit">
            <div class="heading">Country</div>
            <div class="content">
                <select name="country_id" class="form-control" id="country" >
                    <option value="" selected="">Please select country</option>
                    @if(isset($countries))
                        @foreach ($countries as $optionKey => $optionValue)
                            <option value="{{ $optionValue->id }}" {{ $user->country_id == $optionValue->id ? 'selected="selected"' : '' }}><img src="/flags/{{ $optionValue->code }}.png'"/> {{ $optionValue->countryname }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="save-cancel-btn">
    <div class="save">
        <input type="submit" value="Save" data-toggle="modal" data-title="Confirm Save" data-message="Please confirm your changes."/>
    </div>
    <div class="cancel">
        <label>Cancel</label>
    </div>
</div>

      
      </div>
    </div>
    {!! Form::close() !!}

    {!! Form::model($user, array('action' => array('ProfilesController@updateUserPassword', $user->id), 'method' => 'PUT', 'autocomplete' => 'new-password')) !!}
    <div class="user-password">
      <div class="form-group">
      	<div class="form-unit form-group {{ $errors->has('password') ? ' has-error ' : '' }}">
      		{!! Form::label('password', trans('forms.create_user_label_password'), array('class' => 'heading')); !!}
      		<div class="content">
      			{!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('forms.create_user_ph_password'), 'autocomplete' => 'new-password')) !!}
      			@if ($errors->has('password'))
      			<span class="help-block">
      				<strong>{{ $errors->first('password') }}</strong>
      			</span>
      			@endif
      		</div>
      	</div>

      	<div class="form-unit {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">
      		{!! Form::label('password_confirmation', trans('forms.create_user_label_pw_confirmation'), array('class' => 'heading')); !!}
      		<div class="content">
      			{!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_pw_confirmation'))) !!}
      			<span id="pw_status"></span>
      			@if ($errors->has('password_confirmation'))
      			<span class="help-block">
      				<strong>{{ $errors->first('password_confirmation') }}</strong>
      			</span>
      			@endif
      		</div>
      	</div>

      	<div class="form-unit">
             <div class="sub-text">
                 <ul>
                    <li>6 characters minimum</li>
                    <li>1 number required</li>
                 </ul>
             </div>

         </div>

      	<div class="save-cancel-btn">
      		<div class="save">
      			<input type="submit" value="Save" data-toggle="modal" data-title="Confirm Save" data-message="Please confirm your changes."/>
      		</div>
      		<div class="cancel">
      			<label>Cancel</label>
      		</div>
      	</div>

       
      </div>
    </div>
    {!! Form::close() !!}
    <div class="user-subscription">
    	{{$plan}}
        <div class="sub-form">
           <div class="month-sub">Monthly Subscription</div>
           <div class="sub-text">Your plan will automatically renew on <strong>31.03.2018</strong>
and you'll be charged <strong>$9.99</strong> </div>
<input type="button" class="button" value="change plan">
<div class="section-1">
<div class="text">Subscription Details</div>
<div class="icon"><i class="fas fa-angle-right"></i></div>
</div>
<div class="section-2">
    <div class="unit-1"><img src="images/invalid-name.png"></div>
    <div class="unit-2">
    <div class="one">XXXX XXXX XXXX 1464</div>
<div class="two">09/21</div>
  </div>
    <div class="unit-3">
<input type="button" value="Edit"/>
    </div>
</div>
        </div>
    </div>
</div>
</div>
<script>
$(".user-sections .unit").click(function(){
  $(".user-sections .unit").removeClass("active");
  $(this).addClass("active");

  var dataAttr=$(this).attr("data-attr");
  $(".user-general,.user-password,.user-subscription").removeClass("active");
  $("."+dataAttr).addClass("active");

});
</script>
@endsection