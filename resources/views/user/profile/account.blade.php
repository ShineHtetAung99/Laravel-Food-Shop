@extends('user.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-5">
                                <a href="{{ route('user#home') }}" class="text-decoration-none">
                                    <i class="fa-solid fa-arrow-left fs-3 text-dark"></i>
                                </a>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Profile</h3>
                        </div>
                        <br>

                        <div class="col-6 offset-3">
                            @if(session('updateSuccess'))
                                <div class="col-12">
                                    <div class="mb-5 alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-circle-check"></i> {{ session('updateSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <form action="{{ route('user#accountChange',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('image/default_user.png') }}" class="col-12 img-thubnail shadow-sm" />
                                        @else
                                            <img src="{{ asset('image/female_default.png') }}" class="col-12 img-thumbnail shadow-sm" />
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}"  class="col-12 img-thumbnail shadow-sm"  />
                                    @endif

                                    <div class="mt-3">
                                        <input type="file" name="image" id="" class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <button id="payment-button" type="submit" class="btn btn-dark col-12">
                                            <span id="payment-button-amount">Update</span>
                                            <i class="fa-solid fa-circle-right"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class=" col-6">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label ">Name</label>
                                        <input id="cc-pament" name="name" type="text" value="{{ old('name',Auth::user()->name) }}" class="mb-3 form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="New Password">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label ">Email</label>
                                        <input id="cc-pament" name="email" type="email" value="{{ old('email',Auth::user()->email) }}" class="mb-3 form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="New Password">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label ">Phone</label>
                                        <input id="cc-pament" name="phone" type="number" value="{{ old('phone',Auth::user()->phone) }}" class="mb-3 form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="New Password">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label ">Gender</label>
                                        <select name="gender" class="mb-3 form-control @error('gender') is-invalid @enderror">
                                            <option value="">Choose gender...</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label ">Address</label>
                                        <textarea name="address" class="mb-3 form-control @error('address') is-invalid @enderror" cols="30" rows="10" placeholder="Address">{{ old('address',Auth::user()->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label ">Role</label>
                                        <input id="cc-pament" name="role" type="text" value="{{ old('role',Auth::user()->role) }}" class="mb-3 form-control" aria-required="true" aria-invalid="false" disabled>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
