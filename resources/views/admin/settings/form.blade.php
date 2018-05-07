<div class="form-group {{ $errors->has('site_tite') ? 'has-error' : ''}}">
    <label for="site_tite" class="col-md-4 control-label">{{ 'Site Tite' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="site_tite" type="text" id="site_tite" value="{{ $setting->site_tite or ''}}" >
        {!! $errors->first('site_tite', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('site_meta_keyword') ? 'has-error' : ''}}">
    <label for="site_meta_keyword" class="col-md-4 control-label">{{ 'Site Meta Keywork' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="site_meta_keyword" type="text" id="site_meta_keyword" value="{{ $setting->site_meta_keyword or ''}}" >
        {!! $errors->first('site_meta_keyword', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('site_meta_desc') ? 'has-error' : ''}}">
    <label for="site_meta_desc" class="col-md-4 control-label">{{ 'Site Meta Desc' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="site_meta_desc" type="text" id="site_meta_desc" value="{{ $setting->site_meta_desc or ''}}" >
        {!! $errors->first('site_meta_desc', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('admin_email') ? 'has-error' : ''}}">
    <label for="admin_email" class="col-md-4 control-label">{{ 'Admin Email' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="admin_email" type="text" id="admin_email" value="{{ $setting->admin_email or ''}}" >
        {!! $errors->first('admin_email', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('from_email') ? 'has-error' : ''}}">
    <label for="from_email" class="col-md-4 control-label">{{ 'From Email' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="from_email" type="text" id="from_email" value="{{ $setting->from_email or ''}}" >
        {!! $errors->first('from_email', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('from_name') ? 'has-error' : ''}}">
    <label for="from_name" class="col-md-4 control-label">{{ 'From Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="from_name" type="text" id="from_name" value="{{ $setting->from_name or ''}}" >
        {!! $errors->first('from_name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('site_logo') ? 'has-error' : ''}}">
    <label for="site_logo" class="col-md-4 control-label">{{ 'Site Logo' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="site_logo" type="file" id="site_logo" value="{{ $setting->site_logo or ''}}" >
        {!! $errors->first('site_logo', '<p class="help-block">:message</p>') !!}
    </div>
    @if ($setting->site_logo)
    <div class="col-md-2"><img src="/public/uploads/site_logo/{{ $setting->site_logo }}" width="80px" /></div>
    @endif
</div><div class="form-group {{ $errors->has('payment_api_key') ? 'has-error' : ''}}">
    <label for="payment_api_key" class="col-md-4 control-label">{{ 'Payment Api Key' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="payment_api_key" type="text" id="payment_api_key" value="{{ $setting->payment_api_key or ''}}" >
        {!! $errors->first('payment_api_key', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('payment_api_token') ? 'has-error' : ''}}">
    <label for="payment_api_token" class="col-md-4 control-label">{{ 'Payment Api Token' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="payment_api_token" type="text" id="payment_api_token" value="{{ $setting->payment_api_token or ''}}" >
        {!! $errors->first('payment_api_token', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4 save">
        <input type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
