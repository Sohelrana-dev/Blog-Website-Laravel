@extends('frontend.master')
@section('content')

<section class="hero-carousel">
    <div class="container-xl">
        <div class="post-carousel-lg">
            <!-- post -->
            @foreach ($posts as $post)
            <div class="post featured-post-xl">
                <div class="details clearfix">
                    <a href="{{ route('category.post', $post->category_id) }}" class="category-badge lg">{{ $post->rel_to_cat->name }}</a>
                    <h4 class="post-title"><a href="{{ route('single.blog', $post->slug) }}">{{ $post->title }}</a>
                    </h4>
                    <ul class="meta list-inline mb-0">
                        <li class="list-inline-item"><a href="{{ route('author', $post->author_id) }}">{{ $post->rel_to_user->name }}</a></li>
                        <li class="list-inline-item">{{ $post->created_at->format('d M Y') }}</li>
                    </ul>
                </div>
                <a href="{{ route('single.blog', $post->slug) }}">
                    <div class="thumb rounded">
                        <div class="inner data-bg-image" data-bg-image="{{ asset('uploads/blog') }}/{{ $post->blog_image }}"></div>
                    </div>
                </a>
            </div>
            @endforeach
            <!-- post -->
        </div>
    </div>
</section>

<!-- section main content -->
<section class="main-content">
    <div class="container-xl">

        <div class="row gy-4">

            <div class="col-lg-8">

                <!-- post -->
                @foreach ($posts2 as $post)
                <div class="post post-classic rounded bordered">
                    <div class="thumb top-rounded">
                        <a href="{{ route('category.post', $post->category_id) }}" class="category-badge lg position-absolute">{{ $post->rel_to_cat->name }}</a>
                        <span class="post-format">
                            <i class="icon-picture"></i>
                        </span>
                        <a href="{{ route('single.blog', $post->slug) }}">
                            <div class="inner">
                                <img src="{{ asset('uploads/blog') }}/{{ $post->blog_image }}" alt="post-title" />
                            </div>
                        </a>
                    </div>
                    <div class="details">
                        <ul class="meta list-inline mb-0">
                            <li class="list-inline-item"><a href="{{ route('author', $post->author_id) }}">
                            @if ($post->rel_to_user->profile_photo == NULL)
                                <img class="author"
                                    src="{{ Avatar::create($post->rel_to_user->name)->toBase64() }}" alt="author"/>
                            @else
                                <img class="author"
                                    src="{{ asset('uploads/user') }}/{{ $post->rel_to_user->profile_photo }}" alt="author" />
                            @endif            
                            {{ $post->rel_to_user->name }}</a></li>
                            <li class="list-inline-item">{{ $post->created_at->format('d M Y') }}</li>
                            <li class="list-inline-item"><i class="icon-bubble"></i> (0)</li>
                        </ul>
                        <h5 class="post-title mb-3 mt-3"><a href="{{ route('single.blog', $post->slug) }}">{{ $post->title }}</a></h5>
                        <p class="excerpt mb-0">{{ $post->short_desp }}</p>
                    </div>
                    <div class="post-bottom clearfix d-flex align-items-center">
                        <div class="social-share me-auto">
                            <button class="toggle-button icon-share"></button>
                            <ul class="icons list-unstyled list-inline mb-0">
                                <li class="list-inline-item"><a href="https://www.facebook.com/sharer.php?u={{ URL::current() }}"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="https://twitter.com/intent/tweet?url={{ URL::current() }}"><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="https://www.linkedin.com/sharing/share-offsite/?url={{ URL::current() }}"><i class="fab fa-linkedin-in"></i></a></li>
                                <li class="list-inline-item"><a href="https://pinterest.com/pin/create/button/?url={{ URL::current() }}"><i class="fab fa-pinterest"></i></a></li>
                                <li class="list-inline-item"><a href="https://t.me/share/url?url={{ URL::current() }}"><i class="fab fa-telegram-plane"></i></a></li>
                                <li class="list-inline-item"><a href="sms:?&body={{ URL::current() }}"><i class="far fa-envelope"></i></a></li>
                            </ul>
                        </div>
                        <div class="float-end d-none d-md-block">
                            <a href="{{ route('single.blog', $post->slug) }}" class="more-link">Continue reading<i
                                    class="icon-arrow-right"></i></a>
                        </div>
                        <div class="more-button d-block d-md-none float-end">
                            <a href="blog-single.html"><span class="icon-options"></span></a>
                        </div>
                    </div>
                </div>
                @endforeach
                {{ $posts2->links() }}

            </div>
            <div class="col-lg-4">

                <!-- sidebar -->
                <div class="sidebar">
                    <!-- widget about -->
                    <div class="widget rounded">
                        <div class="widget-about data-bg-image text-center" data-bg-image="{{ asset('frontend/assets') }}/images/map-bg.png">
                            <img src="{{ asset('uploads/logo') }}/{{ App\Models\Logo::first()->logo }}" alt="logo" class="mb-4" />
                            @foreach ($admin_desp as $admin_des)
                            <p class="mb-4">{{ $admin_des->admin_desp }}</p>
                            @endforeach
                            <ul class="social-icons list-unstyled list-inline mb-0">
                                @foreach ($admin_icons as $admin_icon)
                        <li class="list-inline-item"><a href="{{ $admin_icon->link }}"><i class="{{ $admin_icon->icon }}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- widget categories -->
                    <div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Explore Topics</h3>
								<img src="{{ asset('frontend/assets') }}/images/wave.svg" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<ul class="list">
									@foreach ($categories as $category)
									<li><a href="{{ route('category.post', $category->id) }}">{{ $category->name }}</a><span>({{ App\Models\Post::where('category_id', $category->id)->count() }})</span></li>
									@endforeach
								</ul>
							</div>
							
						</div>

                    <!-- widget tags -->
                    <div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Tag Clouds</h3>
								<img src="{{ asset('frontend/assets') }}/images/wave.svg" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								@foreach ($tags as $tag)
								<a href="{{ route('tag.details', $tag->id) }}" class="tag">#{{ $tag->tag_name }}</a>
								@endforeach
							</div>		
						</div>

                </div>

            </div>

        </div>

    </div>
</section>

<!-- instagram feed -->
<div class="instagram">
    <div class="container-xl">
        <!-- button -->
        <a href="#" class="btn btn-default btn-instagram">@Katen on Instagram</a>
        <!-- images -->
        <div class="instagram-feed d-flex flex-wrap">
            <div class="insta-item col-sm-2 col-6 col-md-2">
                <a href="#">
                    <img src="{{ asset('frontend/assets') }}/images/insta/insta-1.jpg" alt="insta-title" />
                </a>
            </div>
            <div class="insta-item col-sm-2 col-6 col-md-2">
                <a href="#">
                    <img src="{{ asset('frontend/assets') }}/images/insta/insta-2.jpg" alt="insta-title" />
                </a>
            </div>
            <div class="insta-item col-sm-2 col-6 col-md-2">
                <a href="#">
                    <img src="{{ asset('frontend/assets') }}/images/insta/insta-3.jpg" alt="insta-title" />
                </a>
            </div>
            <div class="insta-item col-sm-2 col-6 col-md-2">
                <a href="#">
                    <img src="{{ asset('frontend/assets') }}/images/insta/insta-4.jpg" alt="insta-title" />
                </a>
            </div>
            <div class="insta-item col-sm-2 col-6 col-md-2">
                <a href="#">
                    <img src="{{ asset('frontend/assets') }}/images/insta/insta-5.jpg" alt="insta-title" />
                </a>
            </div>
            <div class="insta-item col-sm-2 col-6 col-md-2">
                <a href="#">
                    <img src="{{ asset('frontend/assets') }}/images/insta/insta-6.jpg" alt="insta-title" />
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
    <script>
		$('.btn-search').click(function(){
				var search_input = $('#search_input').val();
				var link = "{{ route('all.post') }}"+"?search_input="+search_input;
				window.location.href = link;
		});
	</script>
@endsection
