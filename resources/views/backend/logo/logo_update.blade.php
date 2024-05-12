@extends('layouts.admin')
@section('content')
<div class="row">
    @can('show_logo_form')
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Logo Update</h2>
            </div>
            <div class="card-body bg-body-tertiary">
                <form action="{{ route('logo.store', $logos->first()->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Logo Update</label>
                        <input type="file" class="form-control" name="logo"
                            onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <img src="{{ asset('uploads/logo') }}/{{ $logos->first()->logo }}" width="100" class="mt-2"
                            id="blah" alt="">
                        @error('logo')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success rounded-pill waves-effect waves-light"
                            type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection
@section('footer_content')
@if (session('logo_suc'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('logo_suc') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@endsection
