@extends('layouts.app')
@section('content')
    <div class="plan-listing" style="display: block;">
        <div class="row">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 plan-listing-padding">
                <?php
                $subcategory = DB::select("select * from plans where id='1'");
                foreach ($subcategory as $sKey => $all_plan1){
                ?>
                <div class="plan-listing-box">
                    <div class="plan-head">
                        <div class="plan-membership">
                            {{$all_plan1->name}}
                        </div>
                        <div class="plan-price">
                            ${{$all_plan1->amount}}
                            <p style="visibility: hidden;">Save 50%</p>
                        </div>
                    </div>
                    <div class="trangle"></div>
                    <div class="plan-content">
                        <ul>
                            <li> {{$all_plan1->no_of_book_download}} free eBook Downloads per month</li>
                            <?php
                            $publish = $all_plan1->publish_submit_book;
                            if($publish == 'Yes'){
                            ?>
                            <li>Publish eBooks for Free</li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="foot" style="bottom: 0;">
                        <input type="button" plan-id="1" charge-value="{{$all_plan1->amount}}" class="first-btn"  value="GET STARTED - FREE">
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 plan-listing-padding">
                <?php
                $subcategory = DB::select("select * from plans where id='2'");
                foreach ($subcategory as $sKey => $all_plan1){
                ?>
                <div class="plan-listing-box">
                    <div class="plan-head1">
                        <div class="plan-membership">
                            {{$all_plan1->name}}
                        </div>
                        <div class="plan-price">
                            ${{$all_plan1->amount}}
                            <p style="visibility: hidden;">Save 50%</p>
                        </div>
                    </div>
                    <div class="orange-trangle"></div>
                    <div class="plan-content">
                        <ul>
                            <?php
                            $publish = $all_plan1->online_reader;
                            if($publish == 'Yes'){
                            ?>
                            <li>Online reader access</li><?php } ?>
                            <?php
                            $publish = $all_plan1->ebook_create;
                            if($publish == 'Yes'){
                            ?>

                            <li>Create your own eBook using our create an eBook tool</li><?php } ?>
                            <?php
                            $publish = $all_plan1->cloud_storage;
                            if($publish == 'Yes'){
                            ?>
                            <li>Unlimited Cloud Storage </li><?php } ?>
                            <?php
                            $publish = $all_plan1->no_of_book_download;
                            if($publish == ''){
                            ?>
                            <li>Unlimited ebook Downloads per month</li><?php }else{ ?>
                            <li>{{$all_plan1->no_of_book_download}} ebook Downloads per month</li><?php } ?>
                            <?php
                            $publish = $all_plan1->priority;
                            if($publish == 'Yes'){
                            ?>
                            <li>Priority Support Service</li><?php } ?>
                        </ul>
                    </div>
                    <div class="foot">
                        <?php if (Auth::User()){ ?>
                        <input type="button" plan-id="2" charge-value="{{$all_plan1->amount}}" class="first-btn" data-toggle="modal" data-target="#paymentModal"  value="GET STARTED - ${{$all_plan1->amount}}">
                        <?php }else{ ?>
                        <input type="button" class="first-btn" data-toggle="modal" data-target="#myModal"  value="GET STARTED - ${{$all_plan1->amount}}">
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 plan-listing-padding">
                <?php
                $subcategory = DB::select("select * from plans where id='3'");
                foreach ($subcategory as $sKey => $all_plan1){
                ?>
                <div class="plan-listing-box" style="height: 649px;">
                    <div class="plan-head2">
                        <div class="plan-membership">
                            {{$all_plan1->name}}
                        </div>
                        <div class="plan-price">
                            <div class="most">Most Popular</div>
                            ${{$all_plan1->amount}}
                            <div class="save">Save 15%</div>
                        </div>
                    </div>
                    <div class="red-trangle"></div>
                    <div class="plan-content">
                        <ul>
                            <?php
                            $publish = $all_plan1->online_reader;
                            if($publish == 'Yes'){
                            ?>
                            <li>Online reader access</li><?php } ?>
                            <?php
                            $publish = $all_plan1->ebook_create;
                            if($publish == 'Yes'){
                            ?>

                            <li>Create your own eBook using our create an eBook tool</li><?php } ?>
                            <?php
                            $publish = $all_plan1->cloud_storage;
                            if($publish == 'Yes'){
                            ?>
                            <li>Unlimited Cloud Storage </li><?php } ?>
                            <?php
                            $publish = $all_plan1->no_of_book_download;
                            if($publish == ''){
                            ?>
                            <li>Unlimited ebook Downloads per month</li><?php }else{ ?>
                            <li>{{$all_plan1->no_of_book_download}} ebook Downloads per month</li><?php } ?>
                            <?php
                            $publish = $all_plan1->priority;
                            if($publish == 'Yes'){
                            ?>
                            <li>Priority Support Service</li><?php } ?>
                        </ul>
                    </div>
                    <div class="foot">
                        <?php if (Auth::User()){ ?>
                        <input type="button" plan-id="3" charge-value="{{$all_plan1->amount}}" class="first-btn" data-toggle="modal" data-target="#paymentModal"  value="GET STARTED - ${{$all_plan1->amount}}">
                        <?php }else{ ?>
                        <input type="button" class="first-btn" data-toggle="modal" data-target="#myModal"  value="GET STARTED - ${{$all_plan1->amount}}">
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 plan-listing-padding">
                <?php
                $subcategory = DB::select("select * from plans where id='4'");
                foreach ($subcategory as $sKey => $all_plan1){
                ?>
                <div class="plan-listing-box">
                    <div class="plan-head1">
                        <div class="plan-membership">
                            {{$all_plan1->name}}
                        </div>
                        <div class="plan-price">
                            ${{$all_plan1->amount}}
                            <p>Save 50%</p>
                        </div>
                    </div>
                    <div class="orange-trangle"></div>
                    <div class="plan-content">
                        <ul>
                            <?php
                            $publish = $all_plan1->online_reader;
                            if($publish == 'Yes'){
                            ?>
                            <li>Online reader access</li><?php } ?>
                            <?php
                            $publish = $all_plan1->ebook_create;
                            if($publish == 'Yes'){
                            ?>

                            <li>Create your own eBook using our create an eBook tool</li><?php } ?>
                            <?php
                            $publish = $all_plan1->cloud_storage;
                            if($publish == 'Yes'){
                            ?>
                            <li>Unlimited Cloud Storage </li><?php } ?>
                            <?php
                            $publish = $all_plan1->no_of_book_download;
                            if($publish == ''){
                            ?>
                            <li>Unlimited ebook Downloads per month</li><?php }else{ ?>
                            <li>{{$all_plan1->no_of_book_download}} ebook Downloads per month</li><?php } ?>
                            <?php
                            $publish = $all_plan1->priority;
                            if($publish == 'Yes'){
                            ?>
                            <li>Priority Support Service</li><?php } ?>
                        </ul>
                    </div>
                    <div class="foot">
                        <?php if (Auth::User()){ ?>
                            <input type="button" plan-id="4" charge-value="{{$all_plan1->amount}}" class="first-btn" data-toggle="modal" data-target="#paymentModal"  value="GET STARTED - ${{$all_plan1->amount}}">
                        <?php }else{ ?>
                            <input type="button" class="first-btn" data-toggle="modal" data-target="#myModal"  value="GET STARTED - ${{$all_plan1->amount}}">
                        <?php } ?>
                    </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

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
        </script>
    @endsection