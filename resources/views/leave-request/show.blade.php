<x-bootstrap-theme title="">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">LeaveRequest {{ $leaverequest->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/leave-request') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/leave-request/' . $leaverequest->id . '/edit') }}" title="Edit LeaveRequest"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('leaverequest' . '/' . $leaverequest->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete LeaveRequest" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $leaverequest->id }}</td>
                                    </tr>
                                    <tr><th> User Id </th><td> {{ $leaverequest->user_id }} </td></tr><tr><th> Leave Type Name </th><td> {{ $leaverequest->leave_type_name }} </td></tr><tr><th> Start Date </th><td> {{ $leaverequest->start_date }} </td></tr><tr><th> End Date </th><td> {{ $leaverequest->end_date }} </td></tr><tr><th> Total Leave </th><td> {{ $leaverequest->total_leave }} </td></tr><tr><th> Status </th><td> {{ $leaverequest->status }} </td></tr><tr><th> Comments </th><td> {{ $leaverequest->comments }} </td></tr><tr><th> Approver Id </th><td> {{ $leaverequest->approver_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-bootstrap-theme>