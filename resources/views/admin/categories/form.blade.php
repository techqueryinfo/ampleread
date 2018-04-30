<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $category->name or ''}}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('desc') ? 'has-error' : ''}}">
    <label for="desc" class="col-md-4 control-label">{{ 'Desc' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="3" name="desc" type="textarea" id="desc" >{{ $category->desc or ''}}</textarea>
        {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('parent') ? 'has-error' : ''}}">
    <label for="parent" class="col-md-4 control-label">{{ 'Parent' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="parent" type="number" id="parent" value="{{ $category->parent or ''}}" >
        {!! $errors->first('parent', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div style="display: none;" class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select name="status" class="form-control" id="status" >
    @foreach (json_decode('{"Active": "Active", "Inactive": "Inactive", "Deleted": "Deleted"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($category->status) && $category->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- <div class="form-group {{ $errors->has('category_img') ? 'has-error' : ''}}">
    <label for="category_img" class="col-md-4 control-label">{{ 'Category Img' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="category_img" type="file" id="category_img" value="{{ $category->category_img or ''}}" >
        {!! $errors->first('category_img', '<p class="help-block">:message</p>') !!}
    </div>
</div> -->

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
