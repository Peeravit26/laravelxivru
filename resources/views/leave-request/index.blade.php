<x-bootstrap-theme title="">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Leaverequest</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9">
                                <a href="{{ url('/leave-request/create') }}" class="btn btn-success btn-sm"
                                    title="Add New LeaveRequest">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <form method="GET" action="{{ url('/leave-request') }}" accept-charset="UTF-8"
                                    class="form-inline my-2 my-lg-0 float-right" role="search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                            placeholder="Search..." value="{{ request('search') }}">
                                        <span class="input-group-append">
                                            <button class="btn btn-secondary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Id</th>
                                        <th>Leave Type Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Total Leave</th>
                                        <th>Status</th>
                                        <th>Comments</th>
                                        <th>Approver Id</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaverequest as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->user_id }}</td>
                                            <td>{{ $item->leave_type_name }}</td>
                                            <td>{{ $item->start_date }}</td>
                                            <td>{{ $item->end_date }}</td>
                                            <td>{{ $item->total_leave }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->comments }}</td>
                                            <td>{{ $item->approver_id }}</td>
                                            <td>
                                                @if (Auth()->user()->role == 'admin')
                                                    <a href="{{ url('/leave-request/' . $item->id) }}"
                                                        title="View LeaveRequest"><button class="btn btn-info btn-sm"><i
                                                                class="fa fa-eye" aria-hidden="true"></i>
                                                            View</button></a>
                                                    <a href="{{ url('/leave-request/' . $item->id . '/edit') }}"
                                                        title="Edit LeaveRequest"><button
                                                            class="btn btn-primary btn-sm"><i
                                                                class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            Edit</button></a>
                                                @endif

                                                <form method="POST"
                                                    action="{{ url('/leave-request' . '/' . $item->id) }}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete LeaveRequest"
                                                        onclick="return confirm('Confirm delete?')"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i>
                                                        Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $leaverequest->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-bootstrap-theme>