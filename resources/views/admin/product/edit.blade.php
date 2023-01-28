@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
                    @if(session('updateSuccess'))
                        <div class="col-4 offset-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-check"></i> {{ session('updateSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                                <a href="{{ route('product#list') }}" class="text-decoration-none">
                                    <i class="fa-solid fa-arrow-left fs-3 text-dark"></i>
                                </a>
                                {{-- <i class="fa-solid fa-arrow-left fs-3 text-dark" onclick="history.back()"></i> --}}
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Pizza Details</h3>
                            </div>

                            <div class="mt-5">
                                <div class="row">
                                    <div class="col-3 offset-1">
                                            <img src="{{ asset('storage/'.$pizza->image) }}" class="img-thubnail shadow-sm" />
                                    </div>
                                    <div class="col-8 ">
                                        <div class="my-3 btn bg-danger text-white d-block w-50 fs-5 text-center">{{ $pizza->name }}</div>
                                        <span class="my-3 btn bg-dark text-white"><i class="fa-solid fa-money-bill-1-wave me-2 fs-4"></i>{{ $pizza->price }} MMK</span>
                                        <span class="my-3 btn bg-dark text-white"><i class="fa-solid fa-clock me-2 fs-4"></i>{{ $pizza->waiting_time }}mins</span>
                                        <span class="my-3 btn bg-dark text-white"><i class="fa-solid fa-eye me-2 fs-4"></i>{{ $pizza->view_count }}</span>
                                        <span class="my-3 btn bg-dark text-white"><i class="fa-solid fa-clone me-2 fs-4"></i>{{ $pizza->category_name }}</span>
                                        <span class="my-3 btn bg-dark text-white"><i class="fa-solid fa-user-clock me-2 fs-4"></i>{{ $pizza->created_at->format('j-F-Y') }}</span>
                                        <div class="my-3"><i class="fa-solid fa-file-lines me-2 fs-4"></i>Details</div>
                                        <div>{{ $pizza->description }}</div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 offset-2 mt-3">
                                        <a href="{{ route('product#updatePage',$pizza->id) }}">
                                            <button class="btn btn-dark text-white">
                                                <i class="fa-solid fa-pen-to-square mt-2 me-2"></i>Edit Profile
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
