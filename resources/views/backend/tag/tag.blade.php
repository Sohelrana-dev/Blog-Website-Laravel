@extends('layouts.admin')
@section('content')
<div class="row">
    @can('show tag')
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Tag List</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <th>SL</th>
                        <th>Tag Name</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($tags as $sl=>$tag)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $tag->tag_name }}</td>
                        <td>
                            <a href="{{ route('tag.delete', $tag->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light">Delete</a>
                        </td>
                    </tr>
                    @empty
                        <td class="text-center" colspan="3">No Data Found</td>
                    @endforelse
                </table>
                {{ $tags->links() }}
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Add Tag</h2>
            </div>
            <div class="card-body bg-body-tertiary">
                <form action="{{ route('tag.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Tag</label>
                        <input type="text" class="form-control" name="tag_name" placeholder="Enter Tag">
                        @error('tag_name')
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
@if (session('tag_suc'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('tag_suc') }}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
@if (session('tag_del'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('tag_del') }}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
@endsection
