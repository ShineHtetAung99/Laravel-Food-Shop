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
                                <h2 class="title-1">Contact List</h2>

                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-2">
                            {{-- <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span></h4> --}}
                            <h4>Total - [ {{ $contact->total() }} ] </h4>
                        </div>
                        <div class="col-3 offset-7">
                            <form action="{{ route('admin#contactList') }}" method="get" class="d-flex">
                                <input type="text" name="key" class="form-control" placeholder="Search for Data..." value="{{ request('key') }}">
                                <button type="submit" class="btn btn-dark">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <hr>

                    @if (count($contact) != 0)
                    <div class="table-responsive table-responsive-data2 mt-4">
                        @if(session('deleteSuccess'))
                            <div class="col-4 offset-4">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-circle-check"></i> {{ session('deleteSuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Created Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($contact as $c)
                                    <tr class="tr-shadow">
                                        <td>{{ $c->user_id }}</td>
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->email }}</td>
                                        <td>{{ $c->message }}</td>
                                        <td>{{ $c->created_at->format('j-F-Y') }}</td>
                                        <td class="col-2">
                                            <div class="table-data-feature">
                                                <a href="{{ route('admin#contactView', $c->id) }}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                        title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('admin#contactDelete', $c->id) }}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">
                            {{-- {{ $categories->appends(request()->query())->links() }} --}}
                            {{ $contact->links() }}
                        </div>
                    </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no Contact Message Here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection

