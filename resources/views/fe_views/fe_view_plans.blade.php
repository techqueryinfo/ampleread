@extends('layouts.app')

@section('content')
<?php //print_r($plans); ?>

<form id="payment_form" method="post" accept-charset="UTF-8">
	{{ csrf_field() }}
    <input id="token" name="token" type="hidden" value="">
    <div>
      <label>
        <span>Card Number</span>
        <input id="ccNo" type="text" value="" autocomplete="off" required />
      </label>
    </div>
    <div>
      <label>
        <span>Expiration Date (MM/YYYY)</span>
        <input id="expMonth" type="text" size="2" required />
      </label>
      <span> / </span>
      <input id="expYear" type="text" size="4" required />
    </div>
    <div>
      <label>
        <span>CVC</span>
        <input id="cvv" type="text" value="" autocomplete="off" required />
      </label>
    </div>
    <input type="submit" value="Create Token">
  </form>

  <script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>

  <script>
    // Called when token created successfully.
    var successCallback = function(data) {
      var myForm = document.getElementById('payment_form');
      myForm.token.value = data.response.token.token;
      prompt("Copy token to clipboard: Ctrl+C, Enter", data.response.token.token);
      $.ajaxSetup({
      	headers: {
      		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      	}
      });
      $.ajax({
      	url: "payment",
      	data : {token : data.response.token.token},
      	type: 'POST',
      }).done(function(html) {
      	// return $("#results").append(html);
      });
    };
    
    // Called when token creation fails.
    var errorCallback = function(data) {
      // Retry the token request if ajax call fails
      if (data.errorCode === 200) {
        tokenRequest();
      } else {
        alert(data.errorMsg);
      }
    };

    var tokenRequest = function() {
      // Setup token request arguments
      var args = {
        sellerId: "901379979",
        publishableKey: "BACDB929-E778-466A-B2C1-0133FC43097F",
        ccNo: $("#ccNo").val(),
        cvv: $("#cvv").val(),
        expMonth: $("#expMonth").val(),
        expYear: $("#expYear").val()
      };

      // Make the token request
      TCO.requestToken(successCallback, errorCallback, args);
    };

    $(function() {
      // Pull in the public encryption key for our environment
      TCO.loadPubKey('sandbox');

      $("#payment_form").submit(function(e) {
        // Call our token request function
        tokenRequest();

        // Prevent form from submitting
        return false;
      });
    });
  </script>
@endsection