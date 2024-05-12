@extends('layouts.admin')
@section('content')
    <div class="row">
        @can('contact_info')
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-blue">
                    <h2 class="text-white">Contact Info</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>SL</th>
                            <th>Number</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($contacts as $sl=>$contact)
                            <tr>
                                <td>{{ $sl+1 }}</td>
                                <td>{{ $contact->number }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->location }}</td>
                                <td>
                                    <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-success rounded-pill waves-effect waves-light">Edit</a>
                                    <a href="{{ route('contact.delete', $contact->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-blue">
                    <h2 class="text-white">Contact Information</h2>
                </div>
                <div class="card-body bg-body-tertiary">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" placeholder="Enter Your Number" name="number">
                            @error('number')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Enter Your Email" name="email">
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Location</label>
                            <input type="text" class="form-control" placeholder="Enter Your Location" name="location">
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
@section('footer_content')
		@if (session('contact_suc'))
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "{{ session('contact_suc') }}",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @endif
		@if (session('contact_del'))
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "{{ session('contact_del') }}",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @endif
@endsection