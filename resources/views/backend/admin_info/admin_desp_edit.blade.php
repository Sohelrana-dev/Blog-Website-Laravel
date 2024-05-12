@extends('layouts.admin')
@section('content')
<div class="row">
    @can('admin_info')
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Update Your Information</h2>
            </div>
            <div class="card-body bg-body-tertiary">
                <form action="{{ route('admin.desp.update', $admin_desp->first()->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Admin Information</label>
                        <textarea name="admin_desp" id="" cols="30" rows="4" class="form-control"
                            placeholder="Enter Your Description...">{{ $admin_desp->first()->admin_desp }}</textarea>
                        @error('admin_desp')
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
@if (session('admin_desp_edit_suc'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('admin_desp_edit_suc') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@endsection
