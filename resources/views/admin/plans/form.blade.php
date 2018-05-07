<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $plan->name or ''}}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!--<div class="form-group {{ $errors->has('desc') ? 'has-error' : ''}}">
    <label for="desc" class="col-md-4 control-label">{{ 'Desc' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="desc" type="textarea" id="desc" >{{ $plan->desc or ''}}</textarea>
        {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
    </div>
</div>-->
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="col-md-4 control-label">{{ 'Amount' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="amount" type="text" id="amount" value="{{ $plan->amount or ''}}" required>
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select name="status" class="form-control" id="status" >
    @foreach (json_decode('{"Active": "Active", "Inactive": "Inactive", "Deleted": "Deleted"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($plan->status) && $plan->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('access_time_period') ? 'has-error' : ''}}">
    <label for="access_time_period" class="col-md-4 control-label">{{ 'Access Time Period' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="access_time_period" type="number" id="access_time_period" value="{{ $plan->access_time_period or ''}}" >
        {!! $errors->first('access_time_period', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('access_period_type') ? 'has-error' : ''}}">
    <label for="access_period_type" class="col-md-4 control-label">{{ 'Access Period Type' }}</label>
    <div class="col-md-6">
        <select name="access_period_type" class="form-control" id="access_period_type" >
    @foreach (json_decode('{"Month":"Month", "Year":"Year"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($plan->access_period_type) && $plan->access_period_type == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('access_period_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!--<div class="form-group {{ $errors->has('no_of_book_download') ? 'has-error' : ''}}">
    <label for="no_of_book_download" class="col-md-4 control-label">{{ 'No Of Book Download' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="no_of_book_download" type="number" id="no_of_book_download" value="{{ $plan->no_of_book_download or ''}}" >
        {!! $errors->first('no_of_book_download', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('publish_submit_book') ? 'has-error' : ''}}">
    <label for="publish_submit_book" class="col-md-4 control-label">{{ 'Publish Submit Book' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="publish_submit_book" type="text" id="publish_submit_book" value="{{ $plan->publish_submit_book or ''}}" >
        {!! $errors->first('publish_submit_book', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('read_ebook_directly') ? 'has-error' : ''}}">
    <label for="read_ebook_directly" class="col-md-4 control-label">{{ 'Read Ebook Directly' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="read_ebook_directly" type="number" id="read_ebook_directly" value="{{ $plan->read_ebook_directly or ''}}" >
        {!! $errors->first('read_ebook_directly', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('create_books') ? 'has-error' : ''}}">
    <label for="create_books" class="col-md-4 control-label">{{ 'Create Books' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="create_books" type="number" id="create_books" value="{{ $plan->create_books or ''}}" >
        {!! $errors->first('create_books', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('share_books') ? 'has-error' : ''}}">
    <label for="share_books" class="col-md-4 control-label">{{ 'Share Books' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="share_books" type="number" id="share_books" value="{{ $plan->share_books or ''}}" >
        {!! $errors->first('share_books', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('access_discount') ? 'has-error' : ''}}">
    <label for="access_discount" class="col-md-4 control-label">{{ 'Access Discount' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="access_discount" type="number" id="access_discount" value="{{ $plan->access_discount or ''}}" >
        {!! $errors->first('access_discount', '<p class="help-block">:message</p>') !!}
    </div>
</div>
-->
<div class="form-group">
    <div class="col-md-offset-4 col-md-4 save">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
