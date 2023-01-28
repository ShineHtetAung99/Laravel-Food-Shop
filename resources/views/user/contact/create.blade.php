@extends('user.layouts.master')

@section('content')
    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
        <div class="row px-xl-5">
            @if(session('createSuccess'))
                <div class="col-4 offset-4 mb-3">
                    <div class="alert alert-success alert-dismissible fade show py-3" role="alert">
                        <i class="fa-solid fa-circle-check"></i> {{ session('createSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form action="{{ route('user#create') }}" method="post" id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="control-group">
                            <label for="cc-payment" class="control-label ">Name</label>
                            <input name="contactName" type="text" value="{{ old('name',Auth::user()->name) }}" class="form-control @error('contactName') is-invalid @enderror" id="name" placeholder="Your Name" />
                            <p class="help-block text-danger"></p>
                            @error('contactName')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="control-group">
                            <label for="cc-payment" class="control-label ">Email</label>
                            <input name="contactEmail" type="email" value="{{ old('email',Auth::user()->email) }}" class="form-control @error('contactEmail') is-invalid @enderror" id="email" placeholder="Your Email" />
                            <p class="help-block text-danger"></p>
                            @error('contactEmail')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="control-group">
                            <label for="cc-payment" class="control-label ">Message</label>
                            <textarea name="contactMessage" value="{{ old('contactMessage') }}" class="form-control @error('contactMessage') is-invalid @enderror" rows="9" id="message" placeholder="Message"></textarea>
                            <p class="help-block text-danger"></p>
                            @error('contactMessage')
                                <div class="invalid-feedback mb-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 300px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3819.9836047004596!2d96.15614391481736!3d16.77749128844673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ec86c64627b3%3A0xf629281949864a5c!2sSule%20Square!5e0!3m2!1smy!2smm!4v1672063630209!5m2!1smy!2smm"
                    frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection


