<div>
    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
        <label for="user_id" class="control-label">{{ 'User Id' }}</label>
        <input class="form-control" name="user_id" type="number" id="user_id"
            value="{{ isset($leaverequest->user_id) ? $leaverequest->user_id : '' }}" readonly>
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('leave_type_name') ? 'has-error' : '' }}">
        <label for="leave_type_name" class="control-label">{{ 'Leave Type Name' }}</label>
        <select name="leave_type_name" class="form-control" id="leave_type_name">
            @foreach (json_decode('{"sick":"sick","personal":"personal","vacation":"vacation"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}"
                    {{ isset($leaverequest->leave_type_name) && $leaverequest->leave_type_name == $optionKey ? 'selected' : '' }}>
                    {{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('leave_type_name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
        <label for="start_date" class="control-label">{{ 'Start Date' }}</label>
        <input class="form-control" name="start_date" type="date" id="start_date"
            value="{{ isset($leaverequest->start_date) ? $leaverequest->start_date : '' }}">
        {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
        <label for="end_date" class="control-label">{{ 'End Date' }}</label>
        <input class="form-control" name="end_date" type="date" id="end_date"
            value="{{ isset($leaverequest->end_date) ? $leaverequest->end_date : '' }}">
        {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('total_leave') ? 'has-error' : '' }}">
        <label for="total_leave" class="control-label">{{ 'Total Leave' }}</label>
        <input class="form-control" name="total_leave" type="number" id="total_leave"
            value="{{ isset($leaverequest->total_leave) ? $leaverequest->total_leave : '1' }}">
        {!! $errors->first('total_leave', '<p class="help-block">:message</p>') !!}
    </div>
    @if (Auth()->user()->role == 'admin')
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status" class="control-label">{{ 'Status' }}</label>
            <select name="status" class="form-control" id="status">
                @foreach (json_decode('{"pending":"pending","approved":"approved","rejected":"rejected"}', true) as $optionKey => $optionValue)
                    <option value="{{ $optionKey }}"
                        {{ isset($leaverequest->status) && $leaverequest->status == $optionKey ? 'selected' : '' }}>
                        {{ $optionValue }}</option>
                @endforeach
            </select>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    @endif
    <div class="form-group {{ $errors->has('comments') ? 'has-error' : '' }}">
        <label for="comments" class="control-label">{{ 'Comments' }}</label>
        <textarea class="form-control" rows="5" name="comments" type="textarea" id="comments">{{ isset($leaverequest->comments) ? $leaverequest->comments : '' }}</textarea>
        {!! $errors->first('comments', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('approver_id') ? 'has-error' : '' }}">
        <label for="approver_id" class="control-label">{{ 'Approver Id' }}</label>
        <input class="form-control" name="approver_id" type="number" id="approver_id"
            value="{{ isset($leaverequest->approver_id) ? $leaverequest->approver_id : '' }}" readonly>
        {!! $errors->first('approver_id', '<p class="help-block">:message</p>') !!}
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
</div>
