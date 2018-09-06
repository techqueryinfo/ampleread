@extends('layouts.app')
@section('free-book-css')<link rel="stylesheet" href="/css/help.css">@endsection
@section('content')
<div class="contact-section">
    <div class="header">Contact us</div>
    <div class="contact-queries">
        <div class="unit">
            <div class="head">General questions</div>
            <div class="email">info@amplereads.com</div>
        </div>
        <div class="unit">
            <div class="head">General questions</div>
            <div class="email">info@amplereads.com</div>
        </div>
        <div class="unit">
            <div class="head">General questions</div>
            <div class="email">info@amplereads.com</div>
        </div>
    </div>
    <form method="POST" action="{{ url('/contact') }}" accept-charset="UTF-8" class="form-horizontal">{{ csrf_field() }}
        <div class="contact-form">
            <div class="form-unit">
                <div class="heading">Your Name</div>
                <div class="content">
                    <input name="name" type="text" />{!! $errors->first('name', '
                    <p class="help-block">:message</p>') !!}</div>
            </div>
            <div class="form-unit">
                <div class="heading">Your Email</div>
                <div class="content">
                    <input name="email" type="text" />{!! $errors->first('email', '
                    <p class="help-block">:message</p>') !!}</div>
            </div>
            <div class="form-unit">
                <div class="heading">Your Message</div>
                <div class="content">
                    <textarea name="msg"></textarea>{!! $errors->first('msg', '
                    <p class="help-block">:message</p>') !!}</div>
            </div>
            <div class="form-unit save">
                <input type="submit" value="Submit">
            </div>
        </div>
    </form>
    <div class="contact-help">
        <div class="shape">
            <img src="images/shape.png" alt="" />
        </div>
        <div class="header-help">Help & Support</div>
        <div class="content-help">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec imperdiet nisi. Vivamus in auctor metus.</div>
        <div class="button">
            <a id="visitPage" href="{{url('/help')}}" style="display: none;"></a>
            <input type="submit" value="Visit Help & Support page" onclick="document.getElementById('visitPage').click();">
        </div>
    </div>
</div>
@endsection