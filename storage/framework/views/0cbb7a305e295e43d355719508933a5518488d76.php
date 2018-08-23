 <?php $__env->startSection('template_title'); ?> <?php echo e($user->name); ?>'s Profile <?php $__env->stopSection(); ?> <?php $__env->startSection('template_fastload_css'); ?> #map-canvas{ min-height: 300px; height: 100%; width: 100%; } <?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
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
    <?php echo Form::model($user, array('action' => array('ProfilesController@updateUserAccount', $user->id), 'method' => 'PUT', 'id' => 'user_basics_form', 'files' => true, 'enctype' =>"multipart/form-data")); ?> <?php echo csrf_field(); ?>

    <div class="user-general active">
        <div class="user-image">
            <div class="image"><img src="<?php echo e(($user->profile && $user->profile->avatar) ? '/uploads/avatar/'.$user->profile->avatar : '/images/image1.jpg'); ?>" />
                <input type="file" id="user_avatar" name="avatar" style="display:none" />
            </div>
        </div>
        <div class="user-button">
            <input type="button" value="Change image" id="OpenImgUpload">
        </div>
        <div class="form-group">
            <div class="form-unit form-group <?php echo e($errors->has('name') ? ' has-error ' : ''); ?>">
                <?php echo Form::label('name', 'Username' , array('class' => 'heading'));; ?>

                <div class="content">
                    <?php echo Form::text('name', $user->name , array('id' => 'name', 'placeholder' => trans('forms.ph-username'))); ?>

                </div>
                <?php if($errors->has('name')): ?>
                <span class="help-block">
              <strong><?php echo e($errors->first('name')); ?></strong>
            </span> <?php endif; ?>
            </div>
            <div class="form-unit form-group <?php echo e($errors->has('email') ? ' has-error ' : ''); ?>">
                <?php echo Form::label('email', 'E-mail' , array('class' => 'heading'));; ?>

                <div class="content">
                    <?php echo Form::text('email', $user->email, array('id' => 'email','placeholder' => trans('forms.ph-useremail'))); ?>

                </div>
                <?php if($errors->has('email')): ?>
                <span class="help-block">
              <strong><?php echo e($errors->first('email')); ?></strong>
            </span> <?php endif; ?>
            </div>
            <div class="form-unit form-group <?php echo e($errors->has('first_name') ? ' has-error ' : ''); ?>">
                <?php echo Form::label('first_name', trans('forms.create_user_label_firstname'), array('class' => 'heading'));; ?>

                <div class="content">
                    <?php echo Form::text('first_name', $user->first_name, array('id' => 'first_name', 'placeholder' => trans('forms.create_user_ph_firstname'))); ?>

                </div>
                <?php if($errors->has('first_name')): ?>
                <span class="help-block">
              <strong><?php echo e($errors->first('first_name')); ?></strong>
            </span> <?php endif; ?>
            </div>
            <div class="form-unit form-group <?php echo e($errors->has('last_name') ? ' has-error ' : ''); ?>">
                <?php echo Form::label('last_name', trans('forms.create_user_label_lastname'), array('class' => 'heading'));; ?>

                <div class="content">
                    <?php echo Form::text('last_name', $user->last_name, array('id' => 'last_name', 'placeholder' => trans('forms.create_user_ph_lastname'))); ?>

                </div>
                <?php if($errors->has('last_name')): ?>
                <span class="help-block">
              <strong><?php echo e($errors->first('last_name')); ?></strong>
            </span> <?php endif; ?>
            </div>
            <div class="form-unit">
                <div class="heading">Country</div>
                <div class="content">
                    <select name="country_id" class="form-control" id="country">
                        <option value="" selected="">Please select country</option>
                        <?php if(isset($countries)): ?> <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($optionValue->id); ?>" <?php echo e($user->country_id == $optionValue->id ? 'selected="selected"' : ''); ?>><img src="/flags/<?php echo e($optionValue->code); ?>.png'" /> <?php echo e($optionValue->countryname); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
                    </select>
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
    </div>
    <?php echo Form::close(); ?> <?php echo Form::model($user, array('action' => array('ProfilesController@updateUserPassword', $user->id), 'method' => 'PUT', 'autocomplete' => 'new-password')); ?>

    <div class="user-password">
        <div class="form-group">
            <div class="form-unit form-group <?php echo e($errors->has('password') ? ' has-error ' : ''); ?>">
                <?php echo Form::label('password', trans('forms.create_user_label_password'), array('class' => 'heading'));; ?>

                <div class="content">
                    <?php echo Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('forms.create_user_ph_password'), 'autocomplete' => 'new-password')); ?> <?php if($errors->has('password')): ?>
                    <span class="help-block">
              <strong><?php echo e($errors->first('password')); ?></strong>
            </span> <?php endif; ?>
                </div>
            </div>
            <div class="form-unit <?php echo e($errors->has('password_confirmation') ? ' has-error ' : ''); ?>">
                <?php echo Form::label('password_confirmation', trans('forms.create_user_label_pw_confirmation'), array('class' => 'heading'));; ?>

                <div class="content">
                    <?php echo Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_pw_confirmation'))); ?>

                    <span id="pw_status"></span> <?php if($errors->has('password_confirmation')): ?>
                    <span class="help-block">
              <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
            </span> <?php endif; ?>
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
                    <input type="submit" value="Save" data-toggle="modal" data-title="Confirm Save" data-message="Please confirm your changes." />
                </div>
                <div class="cancel">
                    <label>Cancel</label>
                </div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

    <div class="user-subscription">
        <div class="sub-form">
            <div class="month-sub"><?php if(!blank($plan) && !blank($plan->name)): ?> <?php echo e($plan->name); ?> </div>
            <div class="sub-text"><?php if(!blank($transaction) && !blank($transaction->created_at)): ?> <?php if($plan->id == '2'): ?> Your plan will automatically renew on <strong><?php echo e(date('d.m.Y',strtotime('+30 days',strtotime($transaction->created_at)))); ?> </strong> and you'll be charged <strong>$<?php echo e($plan->amount); ?></strong> <?php elseif($plan->id == '3'): ?> Your plan will automatically renew on <strong> <?php echo e(date('d.m.Y',strtotime('+365 days',strtotime($transaction->created_at)))); ?> </strong> and you'll be charged <strong>$<?php echo e($plan->amount); ?></strong> <?php elseif($plan->id == '4'): ?> <strong>Unlimited benefits </strong> <strong>$<?php echo e($plan->amount); ?></strong> <?php else: ?> <strong> No benefits </strong> <?php endif; ?> <?php endif; ?> <?php endif; ?></div>
            <input type="button" class="button" id="changePlan" value="change plan">
            <div class="section-1">
                <div class="text">Subscription Details</div>
                <div class="icon"><i class="fas fa-angle-right"></i></div>
            </div>
            <div class="section-2">
                <div class="unit-1"><img src="/images/invalid-name.png"></div>
                <div class="unit-2">
                    <div class="one">XXXX XXXX XXXX 1464</div>
                    <div class="two">09/21</div>
                </div>
                <div class="unit-3">
                    <input type="button" value="Edit" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="plan-listing">
    <?php if(!$all_plans->isEmpty()): ?> <?php $__currentLoopData = $all_plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="listing">
        <div class="head">
            <div class="price">$<?php echo e($all_plan->amount); ?></div>
            <div class="membership"><?php echo e($all_plan->name); ?></div>
        </div>
        <div class="content">
              <ul>
                <li><?php echo e($all_plan->access_time_period); ?> <?php echo e($all_plan->access_period_type); ?> access</li>
                <li>
                    <?php if($all_plan->no_of_book_download == 0): ?>
                        Unlimited 
                    <?php else: ?> 
                        <?php echo e($all_plan->no_of_book_download); ?> 
                    <?php endif; ?> eBook downloads
                </li>
                <li>Publish and submit eBooks for downloads</li>
                <?php if($all_plan->read_ebook_directly == 0): ?>
                    <li>Read eBooks directly from your account with no need to dowload it</li>
                <?php endif; ?>
                <?php if($all_plan->create_books == 0): ?>
                    <li>Create a new eBook using our editor</li>
                <?php endif; ?>
                <?php if($all_plan->share_books == 0): ?>
                    <li>Share eBooks</li>
                <?php endif; ?>
                <?php if($all_plan->access_discount == 0): ?>
                    <li>Access discounts available on our paid eBooks</li>
                <?php endif; ?>    
              </ul>
        </div>
        <div class="foot">
          <?php if(!blank($plan) && $plan->id == $all_plan->id): ?>
          <input type="button" plan-id="<?php echo e($all_plan->id); ?>" charge-value="<?php echo e($all_plan->amount); ?>" class="first-btn" value="CURRENT PLAN">
          <?php else: ?>
          <input type="button" plan-id="<?php echo e($all_plan->id); ?>" charge-value="<?php echo e($all_plan->amount); ?>" class="first-btn" data-toggle="modal" data-target="#paymentModal" value="GET STARTED - $<?php echo e($all_plan->amount); ?>"><?php endif; ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
</div>
<!-- Modal -->
<div id="paymentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">PAYMENT INFO</h4>
            </div>
            <div class="modal-body">
                <form action="payment" method="POST" id="payment-form" class="form-horizontal">
                    <?php echo csrf_field(); ?>

                    <div class="row row-centered">
                        <div class="col-md-6 col-md-offset-3 secure-form-wrapper">
                            <div class="page-header">
                                <h2>Secure Payment Form</h2>
                            </div>
                            <noscript>
                                <div class="bs-callout bs-callout-danger">
                                    <h4>JavaScript is not enabled!</h4>
                                    <p>This payment form requires your browser to have JavaScript enabled. Please activate JavaScript and reload this page. Check <a href="http://enable-javascript.com" target="_blank">enable-javascript.com</a> for more informations.</p>
                                </div>
                            </noscript>
                            <fieldset>
                                <!-- Form Name -->
                                <legend>Billing Details</legend>
                                <!-- Street -->
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="textinput">Street</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="street" placeholder="Street" class="address form-control">
                                    </div>
                                </div>
                                <input type="hidden" name="charge_value" id="charge_value">
                                <input type="hidden" name="plan_id" id="plan_id">
                                <!-- City -->
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="textinput">City</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="city" placeholder="City" class="city form-control">
                                    </div>
                                </div>
                                <!-- State -->
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="textinput">State</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="state" maxlength="65" placeholder="State" class="state form-control">
                                    </div>
                                </div>
                                <!-- Postcal Code -->
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="textinput">Postal Code</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="zip" maxlength="9" placeholder="Postal Code" class="zip form-control">
                                    </div>
                                </div>
                                <!-- Country -->
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="textinput">Country</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" name="country" placeholder="Country" class="country form-control">
                                        <select id="select_country" class="input-medium form-control bfh-countries" name="country_code" placeholder="Select Country" data-flags="true" data-filter="true">
                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="textinput">Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="email" maxlength="65" placeholder="Email" class="email form-control">
                                    </div>
                                </div>
                                <!-- Phone no. -->
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="textinput">Phone No. (format: xxx-xxx-xxxx)</label>
                                    <div class="col-sm-8">
                                        <input type="tel" pattern="^\d{3}-\d{3}-\d{4}$" name="phone_no" maxlength="12" placeholder="Phone No." class="form-control">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Card Details</legend>
                                <!-- Card Holder Name -->
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="textinput">Card Holder's Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="cardholdername" maxlength="70" placeholder="Card Holder Name" class="card-holder-name form-control">
                                    </div>
                                </div>
                                <!-- Card Number -->
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="textinput">Card Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="cardnumber" maxlength="19" placeholder="Card Number" class="card-number form-control">
                                    </div>
                                </div>
                                <!-- Expiry-->
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="textinput">Card Expiry Date</label>
                                    <div class="col-sm-8">
                                        <div class="form-inline">
                                            <select name="select2" data-stripe="exp-month" class="card-expiry-month stripe-sensitive required form-control">
                                                <option value="01" selected="selected">01</option>
                                                <option value="02">02</option>
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                            <span> / </span>
                                            <select name="select2" data-stripe="exp-year" class="card-expiry-year stripe-sensitive required form-control">
                                            </select>
                                            <script type="text/javascript">
                                                var select = $(".card-expiry-year"),
                                                    year = new Date().getFullYear();

                                                for (var i = 0; i < 12; i++) {
                                                    select.append($("<option value='" + (i + year) + "' " + (i === 0 ? "selected" : "") + ">" + (i + year) + "</option>"))
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <!-- CVV -->
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="textinput">CVV/CVV2</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="cvv" placeholder="CVV" maxlength="4" class="card-cvc form-control">
                                    </div>
                                </div>
                                <!-- Important notice -->
                                <div class="form-group">
                                    <div class="control-group">
                                        <div class="controls">
                                            <center>
                                                <button class="btn btn-success" type="submit">Pay Now</button>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css" />
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js"></script>
<script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
<script>
    $(".user-sections .unit").click(function() {
        $(".user-sections .unit").removeClass("active");
        $(this).addClass("active");

        var dataAttr = $(this).attr("data-attr");
        $(".user-general,.user-password,.user-subscription").removeClass("active");
        $("." + dataAttr).addClass("active");

    });
    $("#changePlan").click(function() {
        $(".plan-listing").show();
        $(".user-subscription").hide();
    });
    // Called when token created successfully.
    var successCallback = function(data) {
        var form$ = $("#payment-form");
        // token contains id, last4, and card type
        var token = data.response.token.token;
        alert(token);
        // insert the token into the form so it gets submitted to the server
        form$.append("<input type='hidden' name='token' value='" + token + "' />");
        // and submit
        form$.get(0).submit();
    };
    // Called when token creation fails.
    var errorCallback = function(data) {
        if (data.errorCode === 200) {
            tokenRequest();
        } else {
            alert(data.errorMsg);
        }
    };
    var tokenRequest = function() {
        // Setup token request arguments
        alert("hello");
        var args = {
            sellerId: "901379979",
            publishableKey: "BACDB929-E778-466A-B2C1-0133FC43097F",
            ccNo: $('.card-number').val(),
            cvv: $('.card-cvc').val(),
            expMonth: $('.card-expiry-month').val(),
            expYear: $('.card-expiry-year').val()
        };
        // Make the token request
        TCO.requestToken(successCallback, errorCallback, args);
    };
    $(document).ready(function() {

        $('#select_country').change(function(event) {
            var selected_country = $('select.bfh-countries option:selected').text();
            console.log(selected_country);
            $('input[name=country]').val(selected_country);
        });

        $('[data-toggle="modal"]').on('click', function() {
            var charge_value = $(this).attr('charge-value');
            var plan_id = $(this).attr('plan-id');
            $('#charge_value').val(charge_value);
            $('#plan_id').val(plan_id);
        });

        $('#payment-form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            // submitHandler: function(validator, form, submitButton) {

            //     alert("submit");
            //     tokenRequest();
            //     return false;

            // },
            fields: {
                street: {
                    validators: {
                        notEmpty: {
                            message: 'The street is required and cannot be empty'
                        },
                        stringLength: {
                            min: 6,
                            max: 96,
                            message: 'The street must be more than 6 and less than 96 characters long'
                        }
                    }
                },
                city: {
                    validators: {
                        notEmpty: {
                            message: 'The city is required and cannot be empty'
                        }
                    }
                },
                state: {
                    validators: {
                        notEmpty: {
                            message: 'The state is required and cannot be empty'
                        }
                    }
                },
                country_code: {
                    validators: {
                        notEmpty: {
                            message: 'The country is required and cannot be empty'
                        }
                    }
                },
                zip: {
                    validators: {
                        notEmpty: {
                            message: 'The zip is required and cannot be empty'
                        },
                        stringLength: {
                            min: 3,
                            max: 9,
                            message: 'The zip must be more than 3 and less than 9 characters long'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required and can\'t be empty'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        },
                        stringLength: {
                            min: 6,
                            max: 65,
                            message: 'The email must be more than 6 and less than 65 characters long'
                        }
                    }
                },
                phone_no: {
                    validators: {
                        notEmpty: {
                            message: 'The phone no. is required and can\'t be empty'
                        }
                    }
                },
                cardholdername: {
                    validators: {
                        notEmpty: {
                            message: 'The card holder name is required and can\'t be empty'
                        },
                        stringLength: {
                            min: 6,
                            max: 70,
                            message: 'The card holder name must be more than 6 and less than 70 characters long'
                        }
                    }
                },
                cardnumber: {
                    selector: '#cardnumber',
                    validators: {
                        notEmpty: {
                            message: 'The credit card number is required and can\'t be empty'
                        },
                        creditCard: {
                            message: 'The credit card number is invalid'
                        },
                    }
                },
                expMonth: {
                    selector: '[data-stripe="exp-month"]',
                    validators: {
                        notEmpty: {
                            message: 'The expiration month is required'
                        },
                        digits: {
                            message: 'The expiration month can contain digits only'
                        },
                        callback: {
                            message: 'Expired',
                            callback: function(value, validator) {
                                value = parseInt(value, 10);
                                var year = validator.getFieldElements('expYear').val(),
                                    currentMonth = new Date().getMonth() + 1,
                                    currentYear = new Date().getFullYear();
                                if (value < 0 || value > 12) {
                                    return false;
                                }
                                if (year == '') {
                                    return true;
                                }
                                year = parseInt(year, 10);
                                if (year > currentYear || (year == currentYear && value > currentMonth)) {
                                    validator.updateStatus('expYear', 'VALID');
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        }
                    }
                },
                expYear: {
                    selector: '[data-stripe="exp-year"]',
                    validators: {
                        notEmpty: {
                            message: 'The expiration year is required'
                        },
                        digits: {
                            message: 'The expiration year can contain digits only'
                        },
                        callback: {
                            message: 'Expired',
                            callback: function(value, validator) {
                                value = parseInt(value, 10);
                                var month = validator.getFieldElements('expMonth').val(),
                                    currentMonth = new Date().getMonth() + 1,
                                    currentYear = new Date().getFullYear();
                                if (value < currentYear || value > currentYear + 100) {
                                    return false;
                                }
                                if (month == '') {
                                    return false;
                                }
                                month = parseInt(month, 10);
                                if (value > currentYear || (value == currentYear && month > currentMonth)) {
                                    validator.updateStatus('expMonth', 'VALID');
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        }
                    }
                },
                cvv: {
                    selector: '#cvv',
                    validators: {
                        notEmpty: {
                            message: 'The cvv is required and can\'t be empty'
                        },
                        cvv: {
                            message: 'The value is not a valid CVV',
                            creditCardField: 'cardnumber'
                        }
                    }
                },
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            tokenRequest();

        });
        TCO.loadPubKey('sandbox');
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>