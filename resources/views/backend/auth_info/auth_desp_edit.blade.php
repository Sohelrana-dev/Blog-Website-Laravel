@extends('layouts.admin')
@section('content')
<div class="row">
    @can('show_author_info')
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Update Your Information</h2>
            </div>
            <div class="card-body bg-body-tertiary">
                <form action="{{ route('auth.desp.update', $auth_desps->first()->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Author Information</label>
                        <textarea name="auth_desp" id="" cols="30" rows="4" class="form-control"
                            placeholder="Enter Your Description...">{{ $auth_desps->first()->auth_desp }}</textarea>
                        @error('auth_desp')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success rounded-pill waves-effect waves-light">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection
@section('footer_content')
@if (session('desp_edit_suc'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('desp_edit_suc') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@endsection
