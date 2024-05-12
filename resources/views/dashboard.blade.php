@extends('layouts.admin')

@section('content')
<h1>Welcome Mr, <strong class="text-blue">
@auth
    {{ auth()->user()->name }}
@endauth
</strong></h1>

<div class="row">
    @can('show_dashboard_item')
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-primary float-end">All Time</span>
                    <h5 class="card-title mb-0">Total User In Your Website</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            {{ $user }} {{ Str::plural('People', $user) }}
                        </h2>
                    </div>
                    <div class="col-4 text-end">
                        @php
                        $percentage = (1 / $user) * 100;
                        @endphp
                        <span class="text-muted">{{ $percentage  }}% <i
                                class="mdi mdi-arrow-up text-success"></i></span>
                    </div>
                </div>
                <div class="progress shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentage }}%;">
                    </div>
                </div>
            </div>
            <!--end card body-->
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-primary float-end">All Time</span>
                    <h5 class="card-title mb-0">Total Post In Your Website</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            {{ $post }} {{ Str::plural('Post', $post) }}
                        </h2>
                    </div>
                    <div class="col-4 text-end">
                        @php
                        $post_parcent = (1 / $post) * 100;
                        @endphp
                        <span class="text-muted">{{ $post_parcent }}% <i
                                class="mdi mdi-arrow-up text-success"></i></span>
                    </div>
                </div>

                <div class="progress shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $post_parcent }}%;">
                    </div>
                </div>
            </div>
            <!--end card body-->
        </div><!-- end card-->
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-primary float-end">All Time</span>
                    <h5 class="card-title mb-0">Total Subscriber</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            {{ $subscriber }} {{ Str::plural('Subscriber', $subscriber) }}
                        </h2>
                    </div>
                    <div class="col-4 text-end">
                        @php
                        $subscriber_parcent = (1 / $subscriber) * 100;
                        @endphp
                        <span class="text-muted">{{ $subscriber_parcent }}% <i
                                class="mdi mdi-arrow-up text-success"></i></span>
                    </div>
                </div>

                <div class="progress shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $subscriber_parcent }}%;">
                    </div>
                </div>
            </div>
            <!--end card body-->
        </div><!-- end card-->
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-primary float-end">Daily</span>
                    <h5 class="card-title mb-0">Total Message</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            {{ $guest_message }} {{ Str::plural('Message', $guest_message) }}
                        </h2>
                    </div>
                    <div class="col-4 text-end">
                        @php
                        $guest_message_parcent = (1 / $guest_message) * 100;
                        @endphp
                        <span class="text-muted">{{ $guest_message_parcent }}% <i
                                class="mdi mdi-arrow-up text-success"></i></span>
                    </div>
                </div>

                <div class="progress shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 57%;">
                    </div>
                </div>
            </div>
            <!--end card body-->
        </div><!-- end card-->
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">POST</h4>
                <p class="card-subtitle mb-4">Post Details</p>

                <div class="text-center">
                    <input data-plugin="knob" data-width="165" data-height="165" data-linecap=round
                        data-fgColor="#7a08c2" value="{{ $post }}" data-skin="tron" data-angleOffset="180"
                        data-readOnly=true data-thickness=".15" />
                    <h5 class="text-muted mt-3">Total Post</h5>


                    <p class="text-muted w-75 mx-auto sp-line-2">Traditional heading
                        elements are
                        designed to work best in the meat of your page content.</p>

                    <div class="row mt-3">
                        <div class="col-6">
                            <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                            <h4><i class="fas fa-arrow-up text-success me-1"></i>Post: 8.5k</h4>

                        </div>
                        <div class="col-6">
                            <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                            <h4><i class="fas fa-arrow-down text-danger me-1"></i>Post: {{ $post }}</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Top 5 Author</h4>
                <p class="card-subtitle mb-4 font-size-13">Sohel Rana Minimal Blogsite</p>

                <div class="table-responsive">
                    <table class="table table-centered table-striped table-nowrap table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>profile Photo</th>
                                <th>Create Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($top_authors->take(5) as $sl=>$top_author)
                            <tr>
                               <td>{{ $sl+1 }}</td>
                               <td>{{ $top_author->name }}</td>
                               <td>{{ $top_author->email }}</td>
                               <td>
                                    @if ($top_author->profile_photo == NULL)
                                    <img class="inner_img_dash"
                                        src="{{ Avatar::create($top_author->name)->toBase64() }}" />
                                    @else
                                    <img class="inner_img_dash"
                                        src="{{ asset('uploads/user') }}/{{ $top_author->profile_photo }}" alt="" />
                                    @endif
                               </td>
                               <td>{{ $top_author->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <!--end card body-->

        </div>
        <!--end card-->
    </div>
    @endcan

    @can('show_author_item')
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-primary float-end">All Time</span>
                    <h5 class="card-title mb-0">Your Total Post</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            {{ $post_count }} {{ Str::plural('Post', $post_count) }}
                        </h2>
                    </div>
                </div>
                <div class="progress shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width:{{ $post_count }}%;">
                    </div>
                </div>
            </div>
            <!--end card body-->
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-primary float-end">All Time</span>
                    <h5 class="card-title mb-0">Total View In Your Posts</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            {{ $total_views }} {{ Str::plural('view', $total_views) }}
                        </h2>
                    </div>
                </div>

                <div class="progress shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $total_views }}%;">
                    </div>
                </div>
            </div>
            <!--end card body-->
        </div><!-- end card-->
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-primary float-end">All Time</span>
                    <h5 class="card-title mb-0">Total Comment On Your Post</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            {{ $comment }} {{ Str::plural('Comment', $comment) }}
                        </h2>
                    </div>
                    <div class="col-4 text-end">
                        @php
                        $subscriber_parcent = (1 / $subscriber) * 100;
                        @endphp
                        <span class="text-muted">{{ $subscriber_parcent }}% <i
                                class="mdi mdi-arrow-up text-success"></i></span>
                    </div>
                </div>

                <div class="progress shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $subscriber_parcent }}%;">
                    </div>
                </div>
            </div>
            <!--end card body-->
        </div><!-- end card-->
    </div>
    {{-- <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-primary float-end">Daily</span>
                    <h5 class="card-title mb-0">Total Message</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            {{ $guest_message }} {{ Str::plural('Message', $guest_message) }}
                        </h2>
                    </div>
                    <div class="col-4 text-end">
                        @php
                        $guest_message_parcent = (1 / $guest_message) * 100;
                        @endphp
                        <span class="text-muted">{{ $guest_message_parcent }}% <i
                                class="mdi mdi-arrow-up text-success"></i></span>
                    </div>
                </div>

                <div class="progress shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 57%;">
                    </div>
                </div>
            </div>
            <!--end card body-->
        </div><!-- end card-->
    </div> --}}
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">View</h4>
                <p class="card-subtitle mb-4">View Details</p>

                <div class="text-center">
                    <input data-plugin="knob" data-width="165" data-height="165" data-linecap=round
                        data-fgColor="#7a08c2" value="{{ $total_views }}" data-skin="tron" data-angleOffset="180"
                        data-readOnly=true data-thickness=".15" />
                    <h5 class="text-muted mt-3">Total View</h5>


                    <p class="text-muted w-75 mx-auto sp-line-2">Traditional heading
                        elements are
                        designed to work best in the meat of your page content.</p>

                    <div class="row mt-3">
                        <div class="col-6">
                            <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                            <h4><i class="fas fa-arrow-up text-success me-1"></i>View: 8.5k</h4>

                        </div>
                        <div class="col-6">
                            <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                            <h4><i class="fas fa-arrow-down text-danger me-1"></i>View: {{ $total_views }}</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Latest 5 Posts</h4>
                <p class="card-subtitle mb-4 font-size-13">Sohel Rana Minimal Blogsite</p>

                <div class="table-responsive">
                    <table class="table table-centered table-striped table-nowrap table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Category Name</th>
                                <th>title</th>
                                <th>Photo</th>
                                <th>Create Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($top_posts->take(5) as $sl=>$top_post)
                            <tr>
                               <td>{{ $sl+1 }}</td>
                               <td>{{ $top_post->rel_to_cat->name }}</td>
                               <td>{{ $top_post->title }}</td>
                               <td>
                                  <img width="80" src="{{ asset('uploads/blog') }}/{{ $top_post->blog_image }}" alt="">
                               </td>
                               <td>{{ $top_post->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <!--end card body-->

        </div>
        <!--end card-->
    </div>
    @endcan
</div>
@endsection

@section('footer_content')
     <script>
        $('.sohel').click(function(){
            var comment_id = $(this).attr('data-comment-id');
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/getnotifyComment',
                type: 'post',
                data: { 'comment_id': comment_id},
                success: function (data) {
                   
                }
            })
        });
    </script>
@endsection

