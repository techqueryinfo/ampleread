<div class="admin-edit">
    <div class="edit-two">
          <div class="unit-1">
            <div class="form-unit {{ $errors->has('name') ? 'has-error' : ''}}">
                <div class="heading">Name</div>
                <div class="content">
                   <input class="form-control" name="name" type="text" id="name" value="{{ $category->name or ''}}" required>
                   {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
               </div>
           </div>
       </div>
       <div class="unit-2">
        <div class="form-unit {{ $errors->has('status') ? 'has-error' : ''}}">
            <div class="heading">Status</div>
            <div class="content">
                <select name="status" class="form-control" id="status" >
                    @foreach (json_decode('{"Active": "Active", "Inactive": "Inactive", "Deleted": "Deleted"}', true) as $optionKey => $optionValue)
                    <option value="{{ $optionKey }}" {{ (isset($category->status) && $category->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                    @endforeach
                </select>
                {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>
</div>
<div class="save-cancel-btn">
    <div class="save">
        <input type="submit" value="Save" />
    </div>
    <!-- <div class="cancel">
        <label>Cancel</label>
    </div> -->
</div>