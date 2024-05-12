@extends('layouts.admin')
@section('content')
<div class="row">
    @can('show_category')
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Category Edit</h2>
            </div>
            <div class="card-body bg-body-tertiary">
                <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" class="form-control" placeholder="Enter Category Name" name="name" value="{{ $category->name }}">
                        @error('name')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Category Image</label>
                        <input type="file" class="form-control" name="image"
                            onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('image')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        <img class="mt-2" width="100" src="{{ asset('uploads/category') }}/{{ $category->image }}" id="blah" alt="">
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-info rounded-pill waves-effect waves-light">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection

@section('footer_content')
    @if (session('cat_up_suc'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('cat_up_suc') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endsection
