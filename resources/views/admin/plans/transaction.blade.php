@extends('layouts.admin')

@section('template_title')
  Showing Transactions
@endsection

@section('content')
<!-- {{$transactions}} -->
<div class="listing">
            <div class="listing-1">Transaction ID</div>
                <div class="listing-2">Username</div>
                <div class="listing-3">Membership</div>
                <div class="listing-4">Total Amount</div>
            </div>
                @foreach($transactions as $key => $transaction)
                    <div class="listing">
                        <div class="listing-1">{{$transaction['transactionId']}}</div>
                        <div class="listing-2">{{$transaction['user_record']['name']}}</div>
                        <div class="listing-3">{{$transaction['plan_transaction']['name']}}</div>
                        <div class="listing-4">${{$transaction['plan_transaction']['amount']}}</div>
                    </div>
                @endforeach



@endsection