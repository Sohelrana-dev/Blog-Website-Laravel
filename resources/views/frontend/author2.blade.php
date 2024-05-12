@extends('frontend.master')
@section('content')
<div class="site-wrapper">

    <div class="main-overlay"></div>

    <!-- header -->
    <header class="header-personal">
        <div class="container-xl header-top">
            <div class="row align-items-center">
                <div class="col-md-4 col-sm-12 col-xs-12 text-center m-auto">
                    <!-- site logo -->
                    <a class="navbar-brand" href="{{ route('author', $users->id) }}">
                        @if ($users->profile_photo == NULL)
                        <img class="author2"
                            src="{{ Avatar::create($users->name)->toBase64() }}" alt="author"/>
                        @else
                        <img class="author2"
                            src="{{ asset('uploads/user') }}/{{ $users->profile_photo }}" alt="author" />
                        @endif
                    </a>
                    <a href="{{ route('author', $users->id) }}" class="d-block text-logo">{{ $users->name }}<span class="dot">.</span></a>
            <span class="slogan d-block">
                @if ($author_desp)
                    {{ $author_desp->auth_desp }}
                @endif
            </span>
                </div>
            </div>
        </div>
    </header>

    <section class="hero-carousel">
        <div class="row post-carousel-featured post-carousel">
            <!-- post -->
            @foreach ($author_posts1 as $author_post)
            <div class="post featured-post-md">
                <div class="details clearfix">
                    <a href="{{ route('category.post', $author_post->category_id) }}" class="category-badge">{{ $author_post->rel_to_cat->name }}</a>
                    <h4 class="post-title"><a href="{{ route('single.blog', $author_post->slug) }}">{{ $author_post->title }}</a>
                    </h4>
                    <ul class="meta list-inline mb-0">
                        <li class="list-inline-item"><a href="{{ route('author', $author_post->author_id) }}">{{ $author_post->rel_to_user->name }}</a></li>
                        <li class="list-inline-item">{{ $author_post->created_at->format('d M Y') }}</li>
                    </ul>
                </div>
                <a href="{{ route('single.blog', $author_post->slug) }}">
                    <div class="thumb rounded">
                        <div class="inner data-bg-image"
                            data-bg-image="{{ asset('uploads/blog') }}/{{ $author_post->blog_image }}"></div>
                    </div>
                </a>
            </div>
             @endforeach
            <!-- post -->
        </div>
    </section>

    <!-- section main content -->
    <section class="main-content">
        <div class="container-xl">

            <div class="row gy-4">

                <div class="col-lg-8">

                    <div class="row gy-4">
                        @foreach ($author_posts2 as $author_post)
                        <div class="col-sm-6">
                            <!-- post -->
                            <div class="post post-grid rounded bordered">
                                <div class="thumb top-rounded">
                                    <a href="{{ route('category.post', $author_post->category_id) }}" class="category-badge position-absolute">{{ $author_post->rel_to_cat->name }}</a>
                                    <span class="post-format">
                                        <i class="icon-picture"></i>
                                    </span>
                                    <a href="{{ route('single.blog', $author_post->slug) }}">
                                        <div class="inner">
                                            <img src="{{ asset('uploads/blog') }}/{{ $author_post->blog_image }}"
                                                alt="post-title" />
                                        </div>
                                    </a>
                                </div>
                                <div class="details">
                                    <ul class="meta list-inline mb-0">
                                        <li class="list-inline-item"><a href="{{ route('author', $author_post->author_id) }}">
                                             @if ($author_post->rel_to_user->profile_photo == NULL)
											<img class="author"
												src="{{ Avatar::create($author_post->rel_to_user->name)->toBase64() }}" alt="author"/>
											@else
											<img class="author"
												src="{{ asset('uploads/user') }}/{{ $author_post->rel_to_user->profile_photo }}" alt="author" />
											@endif
                                                    {{ $author_post->rel_to_user->name }}</a></li>
                                        <li class="list-inline-item">{{ $author_post->created_at->format('d M Y') }}</li>
                                    </ul>
                                    <h5 class="post-title mb-3 mt-3"><a href="{{ route('single.blog', $author_post->slug) }}">{{ $author_post->title }}</a></h5>
                                    <p class="excerpt mb-0">{{ $author_post->short_desp }}</p>
                                </div>
                                <div class="post-bottom clearfix d-flex align-items-center">
                                    <div class="social-share me-auto">
                                        <button class="toggle-button icon-share"></button>
                                        <ul class="icons list-unstyled list-inline mb-0">
                                            <li class="list-inline-item"><a href="https://www.facebook.com/sharer.php?u={{ URL::current() }}"><i
                                                        class="fab fa-facebook-f"></i></a></li>
                                            <li class="list-inline-item"><a href="https://twitter.com/intent/tweet?url={{ URL::current() }}"><i class="fab fa-twitter"></i></a>
                                            </li>
                                            <li class="list-inline-item"><a href="https://www.linkedin.com/sharing/share-offsite/?url={{ URL::current() }}"><i
                                                        class="fab fa-linkedin-in"></i></a></li>
                                            <li class="list-inline-item"><a href="https://pinterest.com/pin/create/button/?url={{ URL::current() }}"><i
                                                        class="fab fa-pinterest"></i></a></li>
                                            <li class="list-inline-item"><a href="https://t.me/share/url?url={{ URL::current() }}"><i
                                                        class="fab fa-telegram-plane"></i></a></li>
                                            <li class="list-inline-item"><a href="sms:?&body={{ URL::current() }}"><i class="far fa-envelope"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="more-button float-end">
                                        <a href="{{ route('single.blog', $author_post->slug) }}"><span class="icon-options"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                         @endforeach         
                    </div>
                    {{ $author_posts2->links() }}
                    {{-- <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">1</span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                        </ul>
                    </nav> --}}

                </div>
                <div class="col-lg-4">

                    <!-- sidebar -->
                    <div class="sidebar">
                        <!-- widget about -->
                        <div class="widget rounded">
                            <div class="widget-about data-bg-image text-center"
                                data-bg-image="{{ asset('frontend/assets') }}/images/map-bg.png">
                                <img src="{{ asset('uploads/logo') }}/{{ App\Models\Logo::first()->logo }}" alt="logo" class="mb-4" />
                                @if ($author_desp)
                                <p class="mb-4">{{ $author_desp->auth_desp }}</p>
                                @endif
                                <ul class="social-icons list-unstyled list-inline mb-0">
                                   @foreach ($author_icons as $author_icon)
                                       <li class="list-inline-item"><a href="{{ $author_icon->link }}"><i class="{{ $author_icon->icon }}"></i></a></li>
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

                    </div>

                </div>

            </div>

        </div>
    </section>
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