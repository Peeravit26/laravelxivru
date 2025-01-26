<x-bootstrap-theme title="">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Movie</div>
                    <div class="card-body">
                        <form method="GET" action="{{ url('/movie') }}">
                            <div class="row">
                                <div class="col-lg-3">
                                    
                                </div>
                                <div class="col-lg-3">
                                    
                                </div>
                                <div class="col-lg-3">
                                    
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                            placeholder="Search..." value="{{ request('search') }}">
                                        <span class="input-group-append">
                                            <button class="btn btn-secondary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Id</th>
                                        <th>Title</th>
                                        <th>Actor</th>
                                        <th>Price</th>
                                        <th>Special</th>
                                        <th>Common Id</th>
                                        <th>Sold</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($movie as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->category_id }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->actor }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->special }}</td>
                                            <td>{{ $item->common_id }}</td>
                                            <td>{{ $item->sold }}</td>
                                            <td>
                                                <a href="{{ url('/movie/' . $item->id) }}" title="View Movie"><button
                                                        class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                            aria-hidden="true"></i> View</button></a>
                                                <a href="{{ url('/movie/' . $item->id . '/edit') }}"
                                                    title="Edit Movie"><button class="btn btn-primary btn-sm"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        Edit</button></a>

                                                <form method="POST" action="{{ url('/movie' . '/' . $item->id) }}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete Movie"
                                                        onclick="return confirm('Confirm delete?')"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i>
                                                        Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $movie->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-bootstrap-theme>