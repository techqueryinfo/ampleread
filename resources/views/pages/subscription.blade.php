@extends('layouts.app')
@section('content')
<div class="plan-listing" style="display: block;">
    @if(!$all_plans->isEmpty()) @foreach($all_plans as $all_plan)
    <div class="listing">
        <div class="head">
            <div class="price">${{$all_plan->amount}}</div>
            <div class="membership">{{$all_plan->name}}</div>
        </div>
        @if($all_plan->name == 'Free Membership')
        <div class="content">
          <ul>
            <li>Endless access</li>
            <li>Up to 5 books downloads each month</li>
            <li>Publish and submit eBooks for review</li>
          </ul>
        </div>
        @elseif($all_plan->name == 'Monthly Subscription')
        <div class="content">
          <ul>
            <li>1 month access</li>
            <li>Unlimited eBook downloads</li>
            <li>Publish and submit eBooks for downloads</li>
            <li>Read eBooks directly from your account with no need to dowload it</li>
            <li>Create a new eBook using our editor</li>
            <li>Share eBooks</li>
            <li>Access discounts available on our paid eBooks</li>
          </ul>
        </div>
        @elseif($all_plan->name == 'Yearly Subscription')
        <div class="content">
            <ul>
                <li>1 year access</li>
                <li>Unlimited eBook downloads</li>
                <li>Publish and submit eBooks for downloads</li>
                <li>Read eBooks directly from your account with no need to dowload it</li>
                <li>Create a new eBook using our editor</li>
                <li>Share eBooks</li>
                <li>Access discounts available on our paid eBooks</li>
            </ul>
        </div>
        @elseif($all_plan->name == 'Three Year subscription')
        <div class="content">
          <ul>
            <li>Endless access</li>
            <li>Unlimited eBook downloads</li>
            <li>Publish and submit eBooks for downloads</li>
            <li>Read eBooks directly from your account with no need to dowload it</li>
            <li>Create a new eBook using our editor</li>
            <li>Share eBooks</li>
            <li>Access discounts available on our paid eBooks</li>
          </ul>
        </div>
        @endif
        <div class="foot">
          <input type="button" plan-id="{{$all_plan->id}}" charge-value="{{$all_plan->amount}}" class="first-btn" data-toggle="modal" data-target="#paymentModal" value="GET STARTED - ${{$all_plan->amount}}">
        </div>
    </div>
    @endforeach @endif
</div>
@endsection