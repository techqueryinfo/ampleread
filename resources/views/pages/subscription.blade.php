@extends('layouts.app')
@section('content')
<div class="plan-listing" style="display: block;">
    @if(!$all_plans->isEmpty()) @foreach($all_plans as $all_plan)
    <div class="listing">
        <div class="head">
            <div class="price">${{$all_plan->amount}}</div>
            <div class="membership">{{$all_plan->name}}</div>
        </div>
        <div class="content">
          <ul>
            <li>{{$all_plan->access_time_period}} {{$all_plan->access_period_type}} access</li>
            <li>
                @if($all_plan->no_of_book_download == 0)
                    Unlimited 
                @else 
                    {{$all_plan->no_of_book_download}} 
                @endif eBook downloads
            </li>
            <li>Publish and submit eBooks for downloads</li>
            @if($all_plan->read_ebook_directly == 0)
                <li>Read eBooks directly from your account with no need to dowload it</li>
            @endif
            @if($all_plan->create_books == 0)
                <li>Create a new eBook using our editor</li>
            @endif
            @if($all_plan->share_books == 0)
                <li>Share eBooks</li>
            @endif
            @if($all_plan->access_discount == 0)
                <li>Access discounts available on our paid eBooks</li>
            @endif    
          </ul>
        </div>
        <div class="foot">
          <input type="button" plan-id="{{$all_plan->id}}" charge-value="{{$all_plan->amount}}" class="first-btn" data-toggle="modal" data-target="#paymentModal" value="GET STARTED - ${{$all_plan->amount}}">
        </div>
    </div>
    @endforeach @endif
</div>
@endsection