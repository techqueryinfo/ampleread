 @extends('layouts.app')

@section('template_title')
	
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
	@if($invoice_details)

	<h3>Invoice # {{$invoice_details['transactionId']}}</h3>
	Date {{ date('F d,Y')}} <br>
	Invoice Number {{$invoice_details['transactionId']}} <br>
	Price ${{$invoice_details['price']}} <br>
	Total ${{$invoice_details['price']}}
	@endif

</div>

@endsection