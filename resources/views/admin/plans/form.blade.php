<div class="admin-edit">

    <div class="edit-two">
        <div class="unit-1">
            <div class="form-unit {{ $errors->has('name') ? 'has-error' : ''}}">
                <div class="heading">Name</div>
                <div class="content">
                    <input class="form-control" name="name" type="text" id="name" value="{{ $plan->name or ''}}" required>
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-unit {{ $errors->has('access_time_period') ? 'has-error' : ''}}">
                <div class="heading">Access Time Period</div>
                <div class="content">
                    <input class="form-control" name="access_time_period" type="number" id="access_time_period" value="{{ $plan->access_time_period or ''}}" >
                    {!! $errors->first('access_time_period', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-unit">
                <div class="heading">Status</div>
                <div class="content">
                    <select name="status" class="form-control" id="status" >
                        @foreach (json_decode('{"Active": "Active", "Inactive": "Inactive", "Deleted": "Deleted"}', true) as $optionKey => $optionValue)
                            <option value="{{ $optionKey }}" {{ (isset($plan->status) && $plan->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="unit-2">
            <div class="form-unit {{ $errors->has('amount') ? 'has-error' : ''}}">
                <div class="heading">Amount</div>
                <div class="content">
                    <input class="form-control" name="amount" type="text" id="amount" value="{{ $plan->amount or ''}}" required>
                    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-unit {{ $errors->has('access_period_type') ? 'has-error' : ''}}">
                <div class="heading">Access Period Type</div>
                <div class="content">
                    <select name="access_period_type" class="form-control" id="access_period_type" >
                    @foreach (json_decode('{"Month":"Month", "Year":"Year"}', true) as $optionKey => $optionValue)
                        <option value="{{ $optionKey }}" {{ (isset($plan->access_period_type) && $plan->access_period_type == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                    @endforeach
                </select>
                        {!! $errors->first('access_period_type', '<p class="help-block">:message</p>') !!}
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
