@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12"><br></div>
	</div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Contact Us</div>

                <form method="POST" action="{{ url('/contact') }}" accept-charset="UTF-8" class="form-horizontal" >
                    {{ csrf_field() }}

                <div class="panel-body">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <label for="name" class="col-md-4 control-label">Your Name</label>
                        <div class="col-md-6">
                            <input class="form-control" name="name" type="text">
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <label for="name" class="col-md-4 control-label">Your Email</label>
                        <div class="col-md-6">
                            <input class="form-control" name="email" type="text">
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <label for="name" class="col-md-4 control-label">Your Message</label>
                        <div class="col-md-6">
                            <textarea name="msg"></textarea>
                            {!! $errors->first('msg', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4 save">
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
