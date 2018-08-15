<div class="admin-edit">

    <div class="edit-two">
        <div class="unit-1">
            <div class="form-unit {{ $errors->has('site_tite') ? 'has-error' : ''}}">
                <div class="heading">Site Title</div>
                <div class="content">
                     <input class="form-control" name="site_tite" type="text" id="site_tite" value="{{ $setting->site_tite or ''}}" >
                    {!! $errors->first('site_tite', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-unit {{ $errors->has('site_tite') ? 'has-error' : ''}}">
                <div class="heading">Site Meta Desc</div>
                <div class="content">
                     <input class="form-control" name="site_meta_desc" type="text" id="site_meta_desc" value="{{ $setting->site_meta_desc or ''}}" >
        {!! $errors->first('site_meta_desc', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-unit {{ $errors->has('from_email') ? 'has-error' : ''}}">
                <div class="heading">From Email</div>
                <div class="content">
                     <input class="form-control" name="from_email" type="text" id="from_email" value="{{ $setting->from_email or ''}}" >
        {!! $errors->first('from_email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-unit {{ $errors->has('site_logo') ? 'has-error' : ''}}">
                <div class="heading">Site Title</div>
                <div class="content">
                     <input class="form-control" name="site_logo" type="file" id="site_logo" value="{{ $setting->site_logo or ''}}" >
        {!! $errors->first('site_logo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-unit {{ $errors->has('site_tite') ? 'has-error' : ''}}">
                <div class="heading">Payment API Key</div>
                <div class="content">
                     <input class="form-control" name="payment_api_key" type="text" id="payment_api_key" value="{{ $setting->payment_api_key or ''}}" >
        {!! $errors->first('payment_api_key', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="unit-2">
            <div class="form-unit {{ $errors->has('site_meta_keyword') ? 'has-error' : ''}}">
                <div class="heading">Meta Keyword</div>
                <div class="content">
                    <input class="form-control" name="site_meta_keyword" type="text" id="site_meta_keyword" value="{{ $setting->site_meta_keyword or ''}}" >
                    {!! $errors->first('site_meta_keyword', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-unit {{ $errors->has('admin_email') ? 'has-error' : ''}}">
                <div class="heading">Admin Email</div>
                <div class="content">
                     <input class="form-control" name="admin_email" type="text" id="admin_email" value="{{ $setting->admin_email or ''}}" >
        {!! $errors->first('admin_email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-unit {{ $errors->has('from_name') ? 'has-error' : ''}}">
                <div class="heading">From Name</div>
                <div class="content">
                     <input class="form-control" name="from_name" type="text" id="from_name" value="{{ $setting->from_name or ''}}" >
        {!! $errors->first('from_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-unit {{ $errors->has('site_tite') ? 'has-error' : ''}}">
                <div class="heading">Site Logo</div>
                <div class="content">
                     @if ($setting->site_logo)
    <div class="col-md-2"><img src="/public/uploads/site_logo/{{ $setting->site_logo }}" width="80px" /></div>
    @endif
                </div>
            </div>
            <div class="form-unit {{ $errors->has('payment_api_token') ? 'has-error' : ''}}">
                <div class="heading">Payment API Token</div>
                <div class="content">
                     <input class="form-control" name="payment_api_token" type="text" id="payment_api_token" value="{{ $setting->payment_api_token or ''}}" >
        {!! $errors->first('payment_api_token', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>


</div>
<div class="save-cancel-btn">
    <div class="save">
        <input type="submit" value="Save" />
    </div>
    <div class="cancel">
        <label>Cancel</label>
    </div>
</div>
