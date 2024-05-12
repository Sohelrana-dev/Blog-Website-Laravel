@extends('layouts.admin')
@section('content')
    <div class="row">
        @can('contact_info')
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header bg-blue">
                    <h2 class="text-white">Contact Information</h2>
                </div>
                <div class="card-body bg-body-tertiary">
                    <form action="{{ route('contact.update', $contact->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" placeholder="Enter Your Number" name="number" value="{{ $contact->number }}">
                            @error('number')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Enter Your Email" name="email" value="{{ $contact->email }}">
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Location</label>
                            <input type="text" class="form-control" placeholder="Enter Your Location" name="location" value="{{ $contact->location }}">
                            @error('location')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3 d-flex justify-content-end">
                           <button class="btn btn-success rounded-pill waves-effect waves-light" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endcan
    </div>
@endsection