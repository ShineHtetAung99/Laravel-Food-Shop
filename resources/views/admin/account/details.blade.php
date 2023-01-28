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
                                <a href="{{ route('category#list') }}" class="text-decoration-none">
                                    <i class="fa-solid fa-arrow-left fs-3 text-dark"></i>
                                </a>
                            </div>
                            <div class="card-title">
                                <h2 class="text-center ">Account Info</h2>
                            </div>

                            <div class="mt-5">
                                <div class="row">
                                    <div class="col-3 offset-2">
                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                                <img src="{{ asset('image/default_user.png') }}" class="img-thumbnail shadow-sm">
                                            @else
                                                <img src="{{ asset('image/female_default.png') }}" class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm"  />
                                        @endif
                                    </div>
                                    <div class="col-5 offset-1">
                                        <h4 class="my-3"><i class="fa-solid fa-user-pen me-2"></i>{{ Auth::user()->name }}</h4>
                                        <h4 class="my-3"><i class="fa-solid fa-envelope me-2"></i>{{ Auth::user()->email }}</h4>
                                        <h4 class="my-3"><i class="fa-solid fa-phone me-2"></i>{{ Auth::user()->phone }}</h4>
                                        <h4 class="my3"><i class="fa-solid fa-venus-mars me-2"></i>{{ Auth::user()->gender }}</h4>
                                        <h4 class="my-3"><i class="fa-solid fa-location-dot me-3"></i>{{ Auth::user()->address }}</h4>
                                        <h4 class="my-3"><i class="fa-solid fa-user-clock me-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}</h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 offset-2 mt-3">
                                        <a href="{{ route('admin#edit') }}">
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
