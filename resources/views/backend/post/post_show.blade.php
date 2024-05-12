@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">View Full Post</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>1</th>
                        <th>Category Name</th>
                        <td>{{ $post->rel_to_cat->name }}</td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <th>Title</th>
                        <td>{{ $post->title }}</td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <th>Blog Description</th>
                        <td>{!! $post->blog_desp !!}</td>
                    </tr>
                    <tr>
                        <th>4</th>
                        <th>Summery Title</th>
                        <td>{{ $post->summery_title }}</td>
                    </tr>
                    <tr>
                        <th>5</th>
                        <th>Summery Description</th>
                        <td>{!! $post->sum_desp !!}</td>
                    </tr>
                    <tr>
                        <th>6</th>
                        <th>Tag</th>
                        @php
                        $after_exploads = explode(',', $post->tag);
                        @endphp
                        <td>
                            @foreach ($after_exploads as $tag)
                                {{ App\Models\Tag::find($tag)->tag_name }},
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>7</th>
                        <th>Blog Image</th>
                        <td>
                            <img width="200" src="{{ asset('uploads/blog') }}/{{ $post->blog_image }}" alt="">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
