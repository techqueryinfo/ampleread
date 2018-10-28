<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use Auth;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
// use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use App\Plan;
use App\Transaction;
use App\Models\User;

class PaymentController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

      /** PayPal api context **/
      $this->PROXY_HOST = '127.0.0.1';
      $this->PROXY_PORT = '808';

      $this->SandboxFlag = true;

      $this->API_UserName="laitkor_testing-facilitator_api1.yahoo.in";
      $this->API_Password="1368515833";
      $this->API_Signature="AFcWxV21C7fd0v3bYYYRCpSSRl31AJ7FT1CWxwQvg-ESXRwC.Xk6h8Rd";
      
      if ($this->SandboxFlag == true) 
      {
        $this->API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
        $this->PAYPAL_URL = "https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=";
      }
      else
      {
        $this->API_Endpoint = "https://api-3t.paypal.com/nvp";
        $this->PAYPAL_URL = "https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=";
      }

      $this->USE_PROXY = false;
      $this->version="64";
    }

    private function GetShippingDetails( $token )
    {
      //'--------------------------------------------------------------
      //' At this point, the buyer has completed authorizing the payment
      //' at PayPal.  The function will call PayPal to obtain the details
      //' of the authorization, incuding any shipping information of the
      //' buyer.  Remember, the authorization is not a completed transaction
      //' at this state - the buyer still needs an additional step to finalize
      //' the transaction
      //'--------------------------------------------------------------
       
        //'---------------------------------------------------------------------------
      //' Build a second API request to PayPal, using the token as the
      //'  ID to get the details on the payment authorization
      //'---------------------------------------------------------------------------
      $nvpstr="&TOKEN=" . $token;

      //'---------------------------------------------------------------------------
      //' Make the API call and store the results in an array.  
      //' If the call was a success, show the authorization details, aGetExpressnd provide
      //'   an action to complete the payment.  
      //' If failed, show the error
      //'---------------------------------------------------------------------------
      $resArray=$this->hash_call("GetExpressCheckoutDetails",$nvpstr);
      $ack = strtoupper($resArray["ACK"]);

      if($ack == "SUCCESS" || $ack=="SUCCESSWITHWARNING")
      { 
        $_SESSION['payer_id'] = $resArray['PAYERID'];
        $_SESSION['email'] =  $resArray['EMAIL'];
        $_SESSION['firstName'] = $resArray["FIRSTNAME"]; 
        $_SESSION['lastName'] = $resArray["LASTNAME"]; 
        $_SESSION['shipToName'] = $resArray["SHIPTONAME"]; 
        $_SESSION['shipToStreet'] = $resArray["SHIPTOSTREET"]; 
        $_SESSION['shipToCity'] = $resArray["SHIPTOCITY"];
        $_SESSION['shipToState'] = $resArray["SHIPTOSTATE"];
        $_SESSION['shipToZip'] = $resArray["SHIPTOZIP"];
        $_SESSION['shipToCountry'] = $resArray["SHIPTOCOUNTRYCODE"];
      } 
      return $resArray;
    }

    public function review(Request $request, $plan_id)
    {
      $currentUser = Auth::user();
      $reqData = $request->all();
      $plan = Plan::find($plan_id);
      $reqData = $request->all();
      // exit;
      $token = $reqData['token'];
      $finalPaymentAmount = $plan->amount;
      $resArray = $this->GetShippingDetails( $token );
      $ack = strtoupper($resArray["ACK"]);
      if( $ack == "SUCCESS" || $ack == "SUCESSWITHWARNING") 
      {
        $resArray = $this->ConfirmPayment ( $finalPaymentAmount, $token );
        // print_r($resArray);
        // exit;
        $ack = strtoupper($resArray["ACK"]);
        if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
        {
          $transactionId = $resArray['TRANSACTIONID'];
          $arrayData = array(
            'plan_id' => $plan_id, 
            'user_id' => $currentUser->id,
            'transactionId' => $transactionId,
            'amount' => $finalPaymentAmount
          );
          $transactionRes  = Transaction::create($arrayData);

          $user = User::findOrFail($currentUser->id);
          $user->plan_id = $plan_id;
          $user->save();
          return redirect('profile/'.$currentUser->name)->with('flash_message', 'Payment successfully completed !'); 
        } 
        else  
        {
          //Display a user friendly Error on the page using any of the following error information returned by PayPal
          $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
          $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
          $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
          $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
          return redirect('profile/'.$currentUser->name)->with('flash_error', $ErrorLongMsg);  
        }
      }
    }

    public function cancel(Request $request)
    {
      $currentUser = Auth::user();
      return redirect('profile/'.$currentUser->name)->with('flash_error', 'Payment cancelled !'); 
    }

    private function ConfirmPayment( $FinalPaymentAmt , $token)
    {
      /* Gather the information to make the final call to
         finalize the PayPal payment.  The variable nvpstr
         holds the name value pairs
         */
      
      $currencyCodeType = "USD";
      $paymentType = "Sale";
      //Format the other parameters that were stored in the session from the previous calls 
      $paymentType    = urlencode($paymentType);
      $currencyCodeType   = urlencode($currencyCodeType);
      $payerID    = urlencode($_SESSION['payer_id']);

      $serverName     = urlencode($_SERVER['SERVER_NAME']);

      $nvpstr  = '&TOKEN=' . $token . '&PAYERID=' . $payerID . '&PAYMENTACTION=' . $paymentType . '&AMT=' . $FinalPaymentAmt;
      $nvpstr .= '&CURRENCYCODE=' . $currencyCodeType . '&IPADDRESS=' . $serverName; 

       /* Make the call to PayPal to finalize payment
          If an error occured, show the resulting errors
          */
      $resArray=$this->hash_call("DoExpressCheckoutPayment",$nvpstr);

      // $_SESSION['billing_agreemenet_id']  = $resArray["BILLINGAGREEMENTID"];

      /* Display the API response back to the browser.
         If the response from PayPal was a success, display the response parameters'
         If the response was an error, display the errors received using APIError.php.
         */
      $ack = strtoupper($resArray["ACK"]);

      return $resArray;
    }

    public function paymentProcess(Request $request)
    {
      // echo "<pre>"; 
      // print_r($request->all()); 
      // echo "</pre>"; die();
      $currentUser = Auth::user();
      $reqData = $request->all();
      $currencyCodeType = "USD";
      $paymentType = "Sale";
      $_SESSION['PaymentType'] = $paymentType;
      $_SESSION['currencyCodeType'] = $currencyCodeType;
      if($reqData['pay_type'] == 'cc')
      {
        $expDate = $reqData['expiry_month'].''.$reqData['expiry_year'];
        $resArray = $this->DirectPayment( $paymentType, $reqData['amount'], $reqData['card_type'], $reqData['card-number'], $expDate, $reqData['cvv'], $reqData['card-holder-name'], $currencyCodeType );
        // print_r($resArray);
        $ack = strtoupper($resArray["ACK"]);
        if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
        {
          $transactionId = $resArray['TRANSACTIONID'];
          $arrayData = array(
            'plan_id' => $reqData['plan_id'], 
            'user_id' => $currentUser->id,
            'transactionId' => $transactionId,
            'amount' => $reqData['amount']
          );
          $transactionRes  = Transaction::create($arrayData);

          $user = User::findOrFail($currentUser->id);
          $user->plan_id = $reqData['plan_id'];
          $user->save();
          return redirect('profile/'.$currentUser->name)->with('flash_message', 'Payment successfully completed !'); 
        } 
        else  
        {
          //Display a user friendly Error on the page using any of the following error information returned by PayPal
          $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
          $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
          $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
          $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
          return redirect('profile/'.$currentUser->name)->with('flash_message', $ErrorLongMsg);  
        }
      }
      else
      {
        $returnURL = "https://".$_SERVER['HTTP_HOST']."/payment/review/".$reqData['plan_id'];
        $cancelURL = "https://".$_SERVER['HTTP_HOST']."/payment/cancel";
        $resArray = $this->CallShortcutExpressCheckout ($reqData['amount'], $currencyCodeType, $paymentType, $returnURL, $cancelURL);

        $ack = strtoupper($resArray["ACK"]);
        if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
        {
          $this->RedirectToPayPal ( $resArray["TOKEN"] );
        } 
        else  
        {
          $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
          return redirect('profile/'.$currentUser->name)->with('flash_error', $ErrorLongMsg);  
        }
      }
    }

  private function RedirectToPayPal ( $token )
  {
    // Redirect to paypal.com here
    $payPalURL = $this->PAYPAL_URL . $token;
    header("Location: ".$payPalURL);
    exit;
  }

  private function CallShortcutExpressCheckout( $paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL) 
  {
    //------------------------------------------------------------------------------------------------------------------------------------
    // Construct the parameter string that describes the SetExpressCheckout API call in the shortcut implementation

    $nvpstr="&AMT=". $paymentAmount;
    $nvpstr = $nvpstr . "&PAYMENTACTION=" . $paymentType;
    $nvpstr = $nvpstr . "&BILLINGAGREEMENTDESCRIPTION=".urlencode("Test Recurring Payment($1 monthly)");
    $nvpstr = $nvpstr . "&BILLINGTYPE=RecurringPayments";
    $nvpstr = $nvpstr . "&RETURNURL=" . $returnURL;
    $nvpstr = $nvpstr . "&CANCELURL=" . $cancelURL;
    $nvpstr = $nvpstr . "&CURRENCYCODE=" . $currencyCodeType;

    $_SESSION["currencyCodeType"] = $currencyCodeType;    
    $_SESSION["PaymentType"] = $paymentType;

    //'--------------------------------------------------------------------------------------------------------------- 
    //' Make the API call to PayPal
    //' If the API call succeded, then redirect the buyer to PayPal to begin to authorize payment.  
    //' If an error occured, show the resulting errors
    //'---------------------------------------------------------------------------------------------------------------
  
    $resArray=$this->hash_call("SetExpressCheckout", $nvpstr);
    $ack = strtoupper($resArray["ACK"]);
    if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
    {
      $token = urldecode($resArray["TOKEN"]);
      $_SESSION['TOKEN']=$token;
    }

      return $resArray;
  }

    /*
    '-------------------------------------------------------------------------------------------------------------------------------------------
    ' Purpose:  This function makes a DoDirectPayment API call
    '
    ' Inputs:  
    '   paymentType:    paymentType has to be one of the following values: Sale or Order or Authorization
    '   paymentAmount:    total value of the shopping cart
    '   currencyCode:   currency code value the PayPal API
    '   firstName:      first name as it appears on credit card
    '   lastName:     last name as it appears on credit card
    '   street:       buyer's street address line as it appears on credit card
    '   city:       buyer's city
    '   state:        buyer's state
    '   countryCode:    buyer's country code
    '   zip:        buyer's zip
    '   creditCardType:   buyer's credit card type (i.e. Visa, MasterCard ... )
    '   creditCardNumber: buyers credit card number without any spaces, dashes or any other characters
    '   expDate:      credit card expiration date
    '   cvv2:       Card Verification Value 
    '   
    '-------------------------------------------------------------------------------------------
    '   
    ' Returns: 
    '   The NVP Collection object of the DoDirectPayment Call Response.
    '-------------------------------------------------------------------------------------------------------------------------------------------- 
    */
    private function DirectPayment( $paymentType, $paymentAmount, $creditCardType, $creditCardNumber,
                $expDate, $cvv2, $firstName, $currencyCode, $lastName='', $street='', $city='', $state='', $zip='', 
                $countryCode='' )
    {
      //Construct the parameter string that describes DoDirectPayment
      $nvpstr = "&AMT=" . $paymentAmount;
      $nvpstr = $nvpstr . "&CURRENCYCODE=" . $currencyCode;
      $nvpstr = $nvpstr . "&PAYMENTACTION=" . $paymentType;
      $nvpstr = $nvpstr . "&CREDITCARDTYPE=" . $creditCardType;
      $nvpstr = $nvpstr . "&ACCT=" . $creditCardNumber;
      $nvpstr = $nvpstr . "&EXPDATE=" . $expDate;
      $nvpstr = $nvpstr . "&CVV2=" . $cvv2;
      $nvpstr = $nvpstr . "&FIRSTNAME=" . $firstName;
      // $nvpstr = $nvpstr . "&LASTNAME=" . $lastName;
      // $nvpstr = $nvpstr . "&STREET=" . $street;
      // $nvpstr = $nvpstr . "&CITY=" . $city;
      // $nvpstr = $nvpstr . "&STATE=" . $state;
      // $nvpstr = $nvpstr . "&COUNTRYCODE=" . $countryCode;
      $nvpstr = $nvpstr . "&IPADDRESS=" . $_SERVER['REMOTE_ADDR'];
      
      $resArray=$this->hash_call("DoDirectPayment", $nvpstr);

      return $resArray;
    }

    /**
      '-------------------------------------------------------------------------------------------------------------------------------------------
      * hash_call: Function to perform the API call to PayPal using API signature
      * @methodName is name of API  method.
      * @nvpStr is nvp string.
      * returns an associtive array containing the response from the server.
      '-------------------------------------------------------------------------------------------------------------------------------------------
    */
    private function hash_call($methodName,$nvpStr)
    {
      //setting the curl parameters.
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$this->API_Endpoint);
      curl_setopt($ch, CURLOPT_VERBOSE, 1);

      //turning off the server and peer verification(TrustManager Concept).
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch, CURLOPT_POST, 1);
      
        //if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
       //Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php 
      if($this->USE_PROXY)
        curl_setopt ($ch, CURLOPT_PROXY, $this->PROXY_HOST. ":" . $this->PROXY_PORT); 

      //NVPRequest for submitting to server
      $nvpreq="METHOD=" . urlencode($methodName) . "&VERSION=" . urlencode($this->version) . "&PWD=" . urlencode($this->API_Password) . "&USER=" . urlencode($this->API_UserName) . "&SIGNATURE=" . urlencode($this->API_Signature) . $nvpStr;

      // var_dump($nvpreq);
      //setting the nvpreq as POST FIELD to curl
      curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

      //getting response from server
      $response = curl_exec($ch);

      //convrting NVPResponse to an Associative Array
      $nvpResArray=$this->deformatNVP($response);
      $nvpReqArray=$this->deformatNVP($nvpreq);
      $_SESSION['nvpReqArray']=$nvpReqArray;

      if (curl_errno($ch)) 
      {
        // moving to display page to display curl errors
          $_SESSION['curl_error_no']=curl_errno($ch) ;
          $_SESSION['curl_error_msg']=curl_error($ch);

          //Execute the Error handling module to display errors. 
      } 
      else 
      {
         //closing the curl
          curl_close($ch);
      }

      return $nvpResArray;
    }

    /*'----------------------------------------------------------------------------------
     * This function will take NVPString and convert it to an Associative Array and it will decode the response.
      * It is usefull to search for a particular key and displaying arrays.
      * @nvpstr is NVPString.
      * @nvpArray is Associative Array.
       ----------------------------------------------------------------------------------
      */
    private function deformatNVP($nvpstr)
    {
      $intial=0;
      $nvpArray = array();

      while(strlen($nvpstr))
      {
        //postion of Key
        $keypos= strpos($nvpstr,'=');
        //position of value
        $valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

        /*getting the Key and Value values and storing in a Associative Array*/
        $keyval=substr($nvpstr,$intial,$keypos);
        $valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
        //decoding the respose
        $nvpArray[urldecode($keyval)] =urldecode( $valval);
        $nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
         }
      return $nvpArray;
    }

    public function index()
    {
        return view('paywithpaypal');
    }
    public function payWithpaypal(Request $request)
    {
        //echo "<pre>"; print_r($request->all()); echo "</pre>"; die();
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
            ->setCancelUrl(URL::to('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
         // dd($payment->create($this->_api_context));exit; 
        try {

            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('error', 'Connection timeout');
                return Redirect::to('/');

            } else {

                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');

    }

    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            \Session::put('error', 'Payment failed');
            return Redirect::to('/');

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {

            \Session::put('success', 'Payment success');
            return Redirect::to('/');

        }

        \Session::put('error', 'Payment failed');
        return Redirect::to('/');
    }
}