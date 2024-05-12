@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-10 m-auto">
        <div class="card">
            <div class="card-header text-center bg-blue">
                <h2 class="text-white">Edit Your Post</h2>
            </div>
            <div class="card-body bg-body-tertiary">
                <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Select Category</label>
                                <select name="category_id" class="form-select">
                                    <option value=""> -- Select Category -- </option>
                                    @foreach ($categories as $category)
                                    <option {{ $category->id == $post->category_id?'selected':'' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Title Name"
                                    value="{{ $post->title }}">
                                @error('title')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                         <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Short Desp</label>
                                <textarea name="short_desp" id="" cols="30" rows="4" placeholder="Enter Short Description" class="form-control">{!! $post->short_desp !!}</textarea>
                                @error('short_desp')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Blog Description</label>
                                <textarea name="blog_desp" id="summernote" cols="30"
                                    rows="10">{!! $post->blog_desp !!}</textarea>
                                @error('blog_desp')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Summery Title</label>
                                <input type="text" class="form-control" name="summery_title"
                                    placeholder="Enter Summery Title" value="{{ $post->summery_title }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Summery Description</label>
                                <textarea name="sum_desp" id="summernote2" cols="30"
                                    rows="10">{!! $post->sum_desp !!}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Tag</label>
                                <div class="row">
                                    @php
                                      $after_exploads = explode(',', $post->tag);
                                    @endphp
                                    @foreach ($tags as $tag)
                                    <div class="col-lg-2">
                                        <div class="form-check">
                                            <input class="form-check-input" {{ in_array($tag->id, $after_exploads) ? 'checked' : '' }}  name="tag_id[]"
                                                type="checkbox" value="{{ $tag->id }}" id="{{ $tag->id }}">
                                            <label class="form-check-label" for="{{ $tag->id }}">
                                                {{ $tag->tag_name }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                    @error('tag_id')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Blog Image</label>
                                <input type="file" name="blog_image" class="form-control"
                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                <img width="100" src="{{ asset('uploads/blog') }}/{{ $post->blog_image }}" id="blah" alt="">
                                @error('blog_image')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3 d-flex justify-content-end">
                                <button class="btn btn-success rounded-pill waves-effect waves-light" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_content')
<script>
    $(document).ready(function () {
        $('#summernote').summernote();
    });
    $(document).ready(function () {
        $('#summernote2').summernote();
    });

</script>
@if (session('post_up_suc'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('post_up_suc') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@endsection
