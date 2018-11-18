@extends('layouts.app') @section('template_title') {{ $user->name }}'s Profile @endsection @section('template_fastload_css') #map-canvas{ min-height: 300px; height: 100%; width: 100%; } @endsection @section('content')
    <script src="/js/jquery.creditCardValidator.js"></script>
    <div class="user-container">
        <div class="user-sections">
            <div class="unit active" data-attr="user-general"> <a href="#">General</a>
            </div>
            <div class="unit" data-attr="user-password"> <a href="#">Password</a>
            </div>
            <div class="unit" data-attr="user-subscription"> <a href="#">Subscription</a>
            </div>
        </div>{!! Form::model($user, array('action' => array('ProfilesController@updateUserAccount', $user->id), 'method' => 'PUT', 'id' => 'user_basics_form', 'files' => true, 'enctype' =>"multipart/form-data")) !!} {!! csrf_field() !!}
        <div class="user-general active">
            <div class="user-image">
                <div class="image">
                    <img src="{{($user->profile && $user->profile->avatar) ? '/uploads/avatar/'.$user->profile->avatar : '/images/image1.jpg'}}" />
                    <input type="file" id="user_avatar" name="avatar" style="display:none" />
                </div>
            </div>
            <div class="user-button">
                <input type="button" value="Change image" id="OpenImgUpload">
            </div>
            <div class="form-group">
                <div class="form-unit form-group {{ $errors->has('name') ? ' has-error ' : '' }}">{!! Form::label('name', 'Username' , array('class' => 'heading')); !!}
                    <div class="content">{!! Form::text('name', $user->name , array('id' => 'name', 'placeholder' => trans('forms.ph-username'))) !!}</div>@if ($errors->has('name')) <span class="help-block">
              <strong>{{ $errors->first('name') }}</strong>
            </span> @endif</div>
                <div class="form-unit form-group {{ $errors->has('email') ? ' has-error ' : '' }}">{!! Form::label('email', 'E-mail' , array('class' => 'heading')); !!}
                    <div class="content">{!! Form::text('email', $user->email, array('id' => 'email','placeholder' => trans('forms.ph-useremail'))) !!}</div>@if ($errors->has('email')) <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span> @endif</div>
                <div class="form-unit form-group {{ $errors->has('first_name') ? ' has-error ' : '' }}">{!! Form::label('first_name', trans('forms.create_user_label_firstname'), array('class' => 'heading')); !!}
                    <div class="content">{!! Form::text('first_name', $user->first_name, array('id' => 'first_name', 'placeholder' => trans('forms.create_user_ph_firstname'))) !!}</div>@if ($errors->has('first_name')) <span class="help-block">
              <strong>{{ $errors->first('first_name') }}</strong>
            </span> @endif</div>
                <div class="form-unit form-group {{ $errors->has('last_name') ? ' has-error ' : '' }}">{!! Form::label('last_name', trans('forms.create_user_label_lastname'), array('class' => 'heading')); !!}
                    <div class="content">{!! Form::text('last_name', $user->last_name, array('id' => 'last_name', 'placeholder' => trans('forms.create_user_ph_lastname'))) !!}</div>@if ($errors->has('last_name')) <span class="help-block">
              <strong>{{ $errors->first('last_name') }}</strong>
            </span> @endif</div>
                <div class="form-unit">
                    <div class="heading">Country</div>
                    <div class="content">
                        <select name="country_id" class="form-control" id="country">
                            <option value="" selected="">Please select country</option>@if(isset($countries)) @foreach ($countries as $optionKey => $optionValue)
                                <option value="{{ $optionValue->id }}" {{ $user->country_id == $optionValue->id ? 'selected="selected"' : '' }}>
                                    <img src="/flags/{{ $optionValue->code }}.png'" />{{ $optionValue->countryname }}</option>@endforeach @endif</select>
                    </div>
                </div>
                <div class="form-unit">
                    <div class="heading">Description</div>
                    <div class="content">
                        <textarea name="about_us" rows="8" id="comment" placeholder="Enter Description..." required="required">{{$user->about_us}}</textarea>
                    </div>
                </div>
                <div class="save-cancel-btn">
                    <div class="save">
                        <input type="submit" value="Save" data-toggle="modal" data-title="Confirm Save" data-message="Please confirm your changes." />
                    </div>
                    <div class="cancel">
                        <label>Cancel</label>
                    </div>
                </div>
            </div>
        </div>{!! Form::close() !!} {!! Form::model($user, array('action' => array('ProfilesController@updateUserPassword', $user->id), 'method' => 'PUT', 'autocomplete' => 'new-password')) !!}
        <div class="user-password">
            <div class="form-group">
                <div class="form-unit form-group {{ $errors->has('password') ? ' has-error ' : '' }}">{!! Form::label('password', trans('forms.create_user_label_password'), array('class' => 'heading')); !!}
                    <div class="content">{!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('forms.create_user_ph_password'), 'autocomplete' => 'new-password')) !!} @if ($errors->has('password')) <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span> @endif</div>
                </div>
                <div class="form-unit {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">{!! Form::label('password_confirmation', trans('forms.create_user_label_pw_confirmation'), array('class' => 'heading')); !!}
                    <div class="content">{!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_pw_confirmation'))) !!} <span id="pw_status"></span> @if ($errors->has('password_confirmation')) <span class="help-block">
              <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span> @endif</div>
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
                        <input type="submit" value="Save" data-toggle="modal" data-title="Confirm Save" data-message="Please confirm your changes." />
                    </div>
                    <div class="cancel">
                        <label>Cancel</label>
                    </div>
                </div>
            </div>
        </div>{!! Form::close() !!}
        <div class="user-subscription">
            <div class="sub-form">
                <div class="month-sub">@if(!blank($plan) && !blank($plan->name)) {{$plan->name}}</div>
                <div class="sub-text">@if(!blank($transaction) && !blank($transaction->created_at)) @if($plan->id == '2') Your plan will automatically renew on <strong>{{date('d.m.Y',strtotime('+30 days',strtotime($transaction->created_at)))}} </strong> and you'll be charged <strong>${{$plan->amount}}</strong> @elseif($plan->id == '3') Your plan will automatically renew on <strong> {{date('d.m.Y',strtotime('+365 days',strtotime($transaction->created_at)))}} </strong> and you'll be charged <strong>${{$plan->amount}}</strong> @elseif($plan->id == '4') <strong>Unlimited benefits </strong>  <strong>${{$plan->amount}}</strong> @else <strong> No benefits </strong> @endif @endif @endif</div>
                <input type="button" class="button" id="changePlan" value="change plan">
                <div class="section-1">
                    <div class="text">Subscription Details</div>
                    <div class="icon"><i class="fas fa-angle-right"></i>
                    </div>
                </div>
                <div class="section-2">
                    @if(!$all_plans->isEmpty()) @foreach($all_plans as $all_plan)
                        @if(!blank($transaction) && !blank($transaction->created_at) && $plan->id == $all_plan->id)
                            <div class="listing">
                                <div class="head">
                                <!-- <div class="price">${{$all_plan->amount}}</div> -->
                                    <div class="membership">{{$all_plan->name}} : ${{$all_plan->amount}}</div>
                                </div>
                                <div class="content">
                                    <ul>
                                        <li>{{$all_plan->access_time_period}} {{$all_plan->access_period_type}} access</li>
                                        <li>@if($all_plan->no_of_book_download == 0) Unlimited @else {{$all_plan->no_of_book_download}} @endif eBook downloads</li>
                                        <li>Publish and submit eBooks for downloads</li>@if($all_plan->read_ebook_directly == 0)
                                            <li>Read eBooks directly from your account with no need to dowload it</li>@endif @if($all_plan->create_books == 0)
                                            <li>Create a new eBook using our editor</li>@endif @if($all_plan->share_books == 0)
                                            <li>Share eBooks</li>@endif @if($all_plan->access_discount == 0)
                                            <li>Access discounts available on our paid eBooks</li>@endif</ul>
                                </div>
                            </div>@endif @endforeach @endif
                <!-- <div class="unit-1">
                    <img src="/images/invalid-name.png">
                </div>
                <div class="unit-2">
                    <div class="one">XXXX XXXX XXXX 1464</div>
                    <div class="two">09/21</div>
                </div>
                <div class="unit-3">
                    <input type="button" value="Edit" />
                </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="plan-listing">
        <div class="row">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 plan-listing-padding">
                <?php
                $b = $optionValue->id;
                $subcategory = DB::select("select * from plans where id='1'");
                foreach ($subcategory as $sKey => $all_plan){
                ?>
                <div class="plan-listing-box">
                    <div class="plan-head">
                        <div class="plan-membership">
                            {{$all_plan->name}}
                        </div>
                        <div class="plan-price">
                            ${{$all_plan->amount}}
                            <p style="visibility: hidden;">Save 50%</p>
                        </div>
                    </div>
                    <div class="trangle"></div>
                    <div class="plan-content">
                        <ul>
                            <li> {{$all_plan->no_of_book_download}} free eBook Downloads per month</li>
                            <?php
                            $publish = $all_plan->publish_submit_book;
                            if($publish == 'Yes'){
                            ?>
                            <li>Publish eBooks for Free</li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="foot" style="bottom: 0;">
                        <input type="button" plan-id="1" charge-value="{{$all_plan->amount}}" class="first-btn"  value="GET STARTED - FREE">
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 plan-listing-padding">
                <?php
                $b = $optionValue->id;
                $subcategory = DB::select("select * from plans where id='2'");
                foreach ($subcategory as $sKey => $all_plan){
                ?>
                <div class="plan-listing-box">
                    <div class="plan-head1">
                        <div class="plan-membership">
                            {{$all_plan->name}}
                        </div>
                        <div class="plan-price">
                            ${{$all_plan->amount}}
                            <p style="visibility: hidden;">Save 50%</p>
                        </div>
                    </div>
                    <div class="orange-trangle"></div>
                    <div class="plan-content">
                        <ul>
                            <?php
                            $publish = $all_plan->online_reader;
                            if($publish == 'Yes'){
                            ?>
                            <li>Online reader access</li><?php } ?>
                                <?php
                                $publish = $all_plan->ebook_create;
                                if($publish == 'Yes'){
                                ?>

                            <li>Create your own eBook using our create an eBook tool</li><?php } ?>
                                <?php
                                $publish = $all_plan->cloud_storage;
                                if($publish == 'Yes'){
                                ?>
                            <li>Unlimited Cloud Storage </li><?php } ?>
                                <?php
                                $publish = $all_plan->no_of_book_download;
                                if($publish == ''){
                                ?>
                            <li>Unlimited ebook Downloads per month</li><?php }else{ ?>
                                <li>{{$all_plan->no_of_book_download}} ebook Downloads per month</li><?php } ?>
                                <?php
                                $publish = $all_plan->priority;
                                if($publish == 'Yes'){
                                ?>
                            <li>Priority Support Service</li><?php } ?>
                        </ul>
                    </div>
                    <div class="foot">
                        <input type="button" plan-id="2" charge-value="{{$all_plan->amount}}" class="first-btn" data-toggle="modal" data-target="#paymentModal" value="GET STARTED - ${{$all_plan->amount}}">
                    </div>
                </div>
                    <?php } ?>
            </div>

            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 plan-listing-padding">
                <?php
                $b = $optionValue->id;
                $subcategory = DB::select("select * from plans where id='3'");
                foreach ($subcategory as $sKey => $all_plan){
                ?>
                <div class="plan-listing-box" style="height: 649px;">
                    <div class="plan-head2">
                        <div class="plan-membership">
                            {{$all_plan->name}}
                        </div>
                        <div class="plan-price">
                            <div class="most">Most Popular</div>
                            ${{$all_plan->amount}}
                            <div class="save">Save 15%</div>
                        </div>
                    </div>
                    <div class="red-trangle"></div>
                    <div class="plan-content">
                        <ul>
                            <?php
                            $publish = $all_plan->online_reader;
                            if($publish == 'Yes'){
                            ?>
                            <li>Online reader access</li><?php } ?>
                            <?php
                            $publish = $all_plan->ebook_create;
                            if($publish == 'Yes'){
                            ?>

                            <li>Create your own eBook using our create an eBook tool</li><?php } ?>
                            <?php
                            $publish = $all_plan->cloud_storage;
                            if($publish == 'Yes'){
                            ?>
                            <li>Unlimited Cloud Storage </li><?php } ?>
                            <?php
                            $publish = $all_plan->no_of_book_download;
                            if($publish == ''){
                            ?>
                            <li>Unlimited ebook Downloads per month</li><?php }else{ ?>
                            <li>{{$all_plan->no_of_book_download}} ebook Downloads per month</li><?php } ?>
                            <?php
                            $publish = $all_plan->priority;
                            if($publish == 'Yes'){
                            ?>
                            <li>Priority Support Service</li><?php } ?>
                        </ul>
                    </div>
                    <div class="foot">
                        <input type="button" plan-id="3" charge-value="{{$all_plan->amount}}" class="first-btn" data-toggle="modal" data-target="#paymentModal"  value="GET STARTED - ${{$all_plan->amount}}">
                    </div>
                </div>
                    <?php } ?>
            </div>

            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 plan-listing-padding">
                <?php
                $b = $optionValue->id;
                $subcategory = DB::select("select * from plans where id='4'");
                foreach ($subcategory as $sKey => $all_plan){
                ?>
                <div class="plan-listing-box">
                    <div class="plan-head1">
                        <div class="plan-membership">
                            {{$all_plan->name}}
                        </div>
                        <div class="plan-price">
                            ${{$all_plan->amount}}
                            <p>Save 50%</p>
                        </div>
                    </div>
                    <div class="orange-trangle"></div>
                    <div class="plan-content">
                        <ul>
                            <?php
                            $publish = $all_plan->online_reader;
                            if($publish == 'Yes'){
                            ?>
                            <li>Online reader access</li><?php } ?>
                            <?php
                            $publish = $all_plan->ebook_create;
                            if($publish == 'Yes'){
                            ?>

                            <li>Create your own eBook using our create an eBook tool</li><?php } ?>
                            <?php
                            $publish = $all_plan->cloud_storage;
                            if($publish == 'Yes'){
                            ?>
                            <li>Unlimited Cloud Storage </li><?php } ?>
                            <?php
                            $publish = $all_plan->no_of_book_download;
                            if($publish == ''){
                            ?>
                            <li>Unlimited ebook Downloads per month</li><?php }else{ ?>
                            <li>{{$all_plan->no_of_book_download}} ebook Downloads per month</li><?php } ?>
                            <?php
                            $publish = $all_plan->priority;
                            if($publish == 'Yes'){
                            ?>
                            <li>Priority Support Service</li><?php } ?>
                        </ul>
                    </div>
                    <div class="foot">
                        <input type="button" plan-id="4" charge-value="{{$all_plan->amount}}" class="first-btn" data-toggle="modal" data-target="#paymentModal"  value="GET STARTED - ${{$all_plan->amount}}">
                    </div>
                </div>
                    <?php } ?>
            </div>
        </div>
    </div>
    {{--<div class="plan-listing manishnigam">@if(!$all_plans->isEmpty()) @foreach($all_plans as $all_plan)
        <div class="listing">
            <div class="head">
                <div class="price">${{$all_plan->amount}}</div>
                <div class="membership">{{$all_plan->name}}</div>
            </div>
            <div class="content">
                <ul>
                    <li>{{$all_plan->access_time_period}} {{$all_plan->access_period_type}} access</li>
                    <li>@if($all_plan->no_of_book_download == 0) Unlimited @else {{$all_plan->no_of_book_download}} @endif eBook downloads</li>
                    <li>Publish and submit eBooks for downloads</li>@if($all_plan->read_ebook_directly == 0)
                    <li>Read eBooks directly from your account with no need to dowload it</li>@endif @if($all_plan->create_books == 0)
                    <li>Create a new eBook using our editor</li>@endif @if($all_plan->share_books == 0)
                    <li>Share eBooks</li>@endif @if($all_plan->access_discount == 0)
                    <li>Access discounts available on our paid eBooks</li>@endif</ul>
            </div>
            <div class="foot">@if(!blank($plan) && $plan->id == $all_plan->id)
                <input type="button" plan-id="{{$all_plan->id}}" charge-value="{{$all_plan->amount}}" class="first-btn" value="CURRENT PLAN">@else
                @if($all_plan->amount  > 0)
                <input type="button" plan-id="{{$all_plan->id}}" charge-value="{{$all_plan->amount}}" class="first-btn" data-toggle="modal" data-target="#paymentModal" value="GET STARTED - ${{$all_plan->amount}}">@endif @endif</div>
        </div>@endforeach @endif</div>--}}
    <!-- Modal -->
    <div id="paymentModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">PAYMENT Via PayPal</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" id="payment-form"  class="form-horizontal" action="{{url('payment/paymentProcess')}}" onSubmit="return validate();">
                        {{ csrf_field() }}
                        <div class="row-fluid">
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" >Payment Via</label>
                                    <div class="controls">
                                        <div class="radio">
                                            <label><input type="radio" class="pay_type" name="pay_type" checked value="cc" checked>Credit Card</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" class="pay_type" name="pay_type" value="paypal">PayPal</label>
                                        </div>
                                    </div>
                                </div>
                                <span class="cc_form">
                      <!-- Name -->
                      <div class="control-group">
                        <label class="control-label"  for="card-holder-name">Card Holder's Name</label>
                        <div class="controls">
                          <input type="text" id="card-holder-name" name="card-holder-name" placeholder="" class="input-xlarge demoInputBox">
                        </div>
                      </div>
                                    <!-- CVV -->
                      <div class="control-group">
                        <label class="control-label"  for="card_type">Card CVV</label>
                        <div class="controls">
                          <select name="card_type" required>
                            <option value="visa">Visa</option>
                            <option value="mastercard">Mastercard</option>
                            <option value="discover">Discover</option>
                            <option value="amex">Amex</option>
                          </select>
                        </div>
                      </div>
                                    <!-- Card Number -->
                      <div class="control-group">
                        <label class="control-label" for="card-number">Card Number</label>
                        <div class="controls">
                          <input type="text" id="card-number" name="card-number" placeholder="" class="input-xlarge demoInputBox">
                        </div>
                      </div>

                                    <!-- Expiry-->
                      <div class="control-group">
                        <label class="control-label" for="password">Card Expiry Date</label>
                        <div class="controls">
                          <select class="span3 demoInputBox" name="expiry_month" id="expiry_month">
                            <option value=""> Month</option>
                              <?php
                              for ($i = date("m"); $i <= 12; $i ++) {
                              $monthValue = $i;
                              if (strlen($i) < 2) {
                                  $monthValue = "0" . $monthValue;
                              }
                              ?>
                              <option value="<?php echo $monthValue; ?>"><?php echo $i; ?></option>
                              <?php
                              }
                              ?>
                          </select>
                          <select class="span2 demoInputBox" name="expiry_year">
                            <?php
                              for ($i = date("Y"); $i <= date("Y")+10; $i ++) {
                              // $yearValue = substr($i, 4);
                              ?>
                              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php
                              }
                              ?>
                          </select>
                        </div>
                      </div>

                                    <!-- CVV -->
                      <div class="control-group">
                        <label class="control-label"  for="cvv">Card CVV</label>
                        <div class="controls">
                          <input type="number" min="3" id="cvv" name="cvv" placeholder="" class="span2 demoInputBox">
                        </div>
                      </div>


                                    <!-- Submit -->
                      <div class="control-group">
                        <div class="controls">
                          <button class="btn btn-success" >Pay Now</button>
                          <div id="error-message"></div>
                        </div>
                      </div>
                      </span>
                            </fieldset>
                        </div>
                        <input id="amount" name="amount" type="hidden">
                        <input type="hidden" name="plan_id" id="plan_id"/>
                        <span class="paypal_form" style="display: none;">
                    <div class="control-group">
                        <div class="controls">
                          <button class="btn btn-default" type="submit">Pay with PayPal</button>
                        </div>
                      </div>
                            </p>
                    </span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".user-sections .unit").click(function() {
            $(".user-sections .unit").removeClass("active");
            $(this).addClass("active");
            var dataAttr = $(this).attr("data-attr");
            $(".user-general,.user-password,.user-subscription").removeClass("active");
            $("." + dataAttr).addClass("active");
            if(dataAttr == 'user-subscription')
            {
                $(".plan-listing").hide();
                $(".user-subscription").show();
            }
        });
        $("#changePlan").click(function() {
            $(".plan-listing").show();
            $(".user-subscription").hide();
        });
        $(document).ready(function() {
            $('[data-toggle="modal"]').on('click', function() {
                var charge_value = $(this).attr('charge-value');
                var plan_id = $(this).attr('plan-id');
                $('#amount').val(charge_value);
                $('#plan_id').val(plan_id);
            });

            $("input[name='pay_type']").click(function(){
                if($('input:radio[name=pay_type]:checked').val() == "cc"){
                    $('.cc_form').show();
                    $('.paypal_form').hide();
                    // console.log('test', $('input:radio[name=pay_type]:checked').val());
                }
                else
                {
                    $('.cc_form').hide();
                    $('.paypal_form').show();
                }
            });

        });

        function validate() {
            var valid = true;
            if($('input:radio[name=pay_type]:checked').val() == "cc"){
                $(".demoInputBox").css('background-color', '');
                var message = "";

                var cardHolderNameRegex = /^[a-z ,.'-]+$/i;
                var cvvRegex = /^[0-9]{3,3}$/;

                var cardHolderName = $("#card-holder-name").val();
                var cardNumber = $("#card-number").val();
                var cvv = $("#cvv").val();

                if (cardHolderName == "" || cardNumber == "" || cvv == "") {
                    message += "<div>All Fields are Required.</div>";
                    if (cardHolderName == "") {
                        $("#card-holder-name").css('background-color', '#FFFFDF');
                    }
                    if (cardNumber == "") {
                        $("#card-number").css('background-color', '#FFFFDF');
                    }
                    if (cvv == "" || (cvv != "" && !cvvRegex.test(cvv))) {
                        $("#cvv").css('background-color', '#FFFFDF');
                    }
                    valid = false;
                }

                if (cardHolderName != "" && !cardHolderNameRegex.test(cardHolderName)) {
                    message += "<div>Card Holder Name is Invalid</div>";
                    $("#card-holder-name").css('background-color', '#FFFFDF');
                    valid = false;
                }

                if (cardNumber != "") {
                    $('#card-number').validateCreditCard(function(result) {
                        if (!(result.valid)) {
                            message += "<div>Card Number is Invalid</div>";
                            $("#card-number").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                    });
                }

                else if (cvv != "" && !cvvRegex.test(cvv)) {
                    message += "<div>CVV is Invalid</div>";
                    $("#cvv").css('background-color', '#FFFFDF');
                    valid = false;
                }

                if (message != "") {
                    $("#error-message").show();
                    $("#error-message").html(message);
                }
            }
            return valid;
        }
    </script>@endsection