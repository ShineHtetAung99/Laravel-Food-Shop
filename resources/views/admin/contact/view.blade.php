@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                                <a href="{{ route('admin#contactList') }}" class="text-decoration-none">
                                    <i class="fa-solid fa-arrow-left fs-3 text-dark"></i>
                                </a>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center">Contact Info</h3>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6 offset-3">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" value="{{ $contact->name }}" class="form-control " aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name..." disabled>

                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="email" value="{{ $contact->email }}" class="form-control " aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price..." disabled>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Message</label>
                                        <textarea name="message" class="form-control " cols="30" rows="10" placeholder="Enter Description..." disabled>{{ $contact->message }}</textarea>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                        <input id="cc-pament" name="created_at" type="text" value="{{ $contact->created_at->format('j-F-Y') }}" class="form-control" aria-required="true" aria-invalid="false" disabled>
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
