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
                                    <a href="{{ url('/movie/create') }}" class="btn btn-success btn-sm"
                                        title="Add New Movie">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                    </a>
                                </div>
                                <div class="col-lg-3">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="fa fa-filter"></i> Filter
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Price</h5>
                                                    <div class="row ">
                                                        <div class="col-sm-3">
                                                            <input type="number" name="priceMin" min="0" value="{{ request('priceMin') ? request('priceMin') : '0' }}"
                                                                class="form-control" required/>
                                                        </div>
                                                        <div class="col-sm-1 text-center">
                                                            -
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="number" name="priceMax" min="0" value="{{ request('priceMax') ? request('priceMax') : '10000' }}"
                                                                class="form-control" required />
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <h5>หมวดหมู่</h5>
                                                    <div class="row ">
                                                        @foreach ($category as $c)                                                        
                                                            <div class="col-sm-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="{{ $c->id }}" name="category_ids[]" {{ in_array($loop->iteration, request('category_ids',[])) ? "checked" : "" }}
                                                                        >
                                                                    <label class="form-check-label"> {{ $c->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    {{-- <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button> --}}
                                                    <button type="submit" class="btn btn-primary">Filter</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-select" name="sort" id="sort">
                                        <option value="best-seller">Best Seller</option>
                                        <option value="price-asc">Price : Low - High</option>
                                        <option value="price-desc">Price : High - Low</option>
                                    </select>
                                    <script>
                                        document.querySelector("#sort").value = "{{ request('sort') ? request('sort') : 'best-seller' }}";
                                    </script>
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