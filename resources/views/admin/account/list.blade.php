@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            <h4>Total - [ {{ $admin->total() }} ] </h4>
                        </div>
                        <div class="col-3 offset-7">
                            <form action="{{ route('admin#list') }}" method="get" class="d-flex">
                                <input type="text" name="key" class="form-control" placeholder="Search for Data..." value="{{ request('key') }}">
                                <button type="submit" class="btn btn-dark">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div><hr>

                    @if(session('createSuccess'))
                        <div class="col-4 offset-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-check"></i> {{ session('createSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if(session('deleteSuccess'))
                        <div class="col-4 offset-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-check"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if(session('changeSuccess'))
                        <div class="col-4 offset-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-check"></i> {{ session('changeSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                <tr class="tr-shadow">
                                    <td class="col-1">
                                        @if ($a->image == null)
                                            @if ($a->gender == 'male')
                                                <img src="{{ asset('image/default_user.png') }}" class="img-thumbnail shadow-sm">
                                            @else
                                                <img src="{{ asset('image/female_default.png') }}" class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/'.$a->image) }}" class="img-thumbnail shadow-sm">
                                        @endif
                                    </td>
                                    <input type="hidden" id="userId" value="{{ $a->id }}">
                                    <td>{{ $a->name}}</td>
                                    <td>{{ $a->email }}</td>
                                    <td>{{ $a->gender }}</td>
                                    <td>{{ $a->phone }}</td>
                                    <td>{{ $a->address }}</td>
                                    <td class="col-2">
                                        <div class="table-data-feature">
                                            @if (Auth::user()->id == $a->id)

                                            @else
                                                {{-- <a href="{{ route('admin#changeRole',$a->id) }}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                    title="Admin Role Change">
                                                    <i class="fa-solid fa-person-circle-minus"></i>
                                                    </button>
                                                </a> --}}
                                                <select class="form-control statusChange">
                                                    <option value="admin" @if ($a->role == 'admin') selected @endif>Admin</option>
                                                    <option value="user" @if ($a->role == 'user') selected @endif>User</option>
                                                </select>
                                                <a href="{{ route('admin#delete',$a->id) }}" class="ms-3">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Delete">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="">
                            {{-- {{ $categories->appends(request()->query())->links() }} --}}
                            {{ $admin->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            // change status
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find('#userId').val();
                $data = {
                    'userId': $userId,
                    'role'  : $currentStatus
                };
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/change/role',
                    data: $data,
                    dataType: 'json',
                })
                location.reload();
            })
   
        })
    </script>
@endsection
