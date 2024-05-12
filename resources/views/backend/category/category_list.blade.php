@extends('layouts.admin')
@section('content')
<div class="row">
    @can('show_category')
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Category List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($categories as $sl=>$category)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <img width="60" src="{{ asset('uploads/category') }}/{{ $category->image }}" alt="">
                        </td>
                        <td>
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-success rounded-pill waves-effect waves-light "><i class="mdi mdi-pencil"></i></i></a>
                            <a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger rounded-pill ms-3 waves-effect waves-light category_del"><i class="mdi mdi-trash-can"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Add Category</h2>
            </div>
            <div class="card-body bg-body-tertiary">
                <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" class="form-control" placeholder="Enter Category Name" name="name">
                        @error('name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Category Image</label>
                        <input type="file" class="form-control" name="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('image')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        <img class="mt-2" width="100" src="" id="blah" alt="">
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-info rounded-pill waves-effect waves-light">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection
@section('footer_content')
    @if (session('category_suc'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('category_suc') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    @if (session('cat_del_suc'))
        <script>
             Swal.fire({
                    title: "Deleted!",
                    text: "{{ session('cat_del_suc') }}",
                    icon: "success"
                    });
        </script>
    @endif
@endsection




