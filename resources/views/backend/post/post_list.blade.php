@extends('layouts.admin')

@section('content')
<div class="row">
    @can('show_post')
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Post List</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>Title</th>
                        <th>Blog Image</th>
                        <th>Action</th>
                    </tr>

                    @forelse ($posts as $sl=>$post)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $post->rel_to_cat->name }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <img width="50" src="{{ asset('uploads/blog') }}/{{ $post->blog_image }}" alt="">
                        </td>
                        <td class="ms-6">
                            <a href="{{ route('post.show', $post->id) }}" title="view full post"
                                class="btn ms-4 btn-success rounded-pill waves-effect waves-light "><i
                                    class="mdi mdi-eye"></i></i></a>
                            <a href="{{ route('post.edit', $post->id) }}"
                                class="btn ms-3 btn-primary rounded-pill waves-effect waves-light "><i
                                    class="mdi mdi-pencil"></i></i></a>
                            <a href="{{ route('post.delete', $post->id) }}"
                                class="btn ms-3 btn-danger rounded-pill waves-effect waves-light"><i
                                    class="mdi mdi-trash-can"></i></a>
                        </td>
                    </tr>
                    @empty
                    <td class="text-center" colspan="3">No Data Found</td>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection
@section('footer_content')
@if (session('post_delete'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('post_delete') }}",
        showConfirmButton: false,
        timer: 1500
    });
</script>
@endif
@endsection
