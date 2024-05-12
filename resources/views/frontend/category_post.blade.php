@extends('frontend.master')
@section('content')
    <section class="page-header">
        <div class="container-xl">
            <div class="text-center">
                <h1 class="mt-0 mb-2">{{ $category_name->name }}</h1>
				@php
					$breads = Request::segments();
					array_pop($breads);
				@endphp
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center mb-0">
						<li class="breadcrumb-item">
							<a href="{{ route('index') }}">Home</a>
						</li>
						@foreach ( $breads as $segment)
							<li class="breadcrumb-item active" aria-current="page">{{ ucwords($segment) }}</li>
						@endforeach
					</ol>
				</nav>
            </div>
        </div>
    </section>

	<!-- section main content -->
	<section class="main-content">
		<div class="container-xl">

			<div class="row gy-4">

				<div class="col-lg-8">

                    <div class="row gy-4">
                        @forelse ($posts as $post)
                            <div class="col-sm-6">
                                <!-- post -->
                                <div class="post post-grid rounded bordered">
                                    <div class="thumb top-rounded">
                                        <a href="{{ route('category.post', $post->category_id) }}" class="category-badge position-absolute">{{ $post->rel_to_cat->name }}</a>
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
                                                <li class="list-inline-item"><a href="#https://www.linkedin.com/sharing/share-offsite/?url={{ URL::current() }}"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li class="list-inline-item"><a href="https://pinterest.com/pin/create/button/?url={{ URL::current() }}"><i class="fab fa-pinterest"></i></a></li>
                                                <li class="list-inline-item"><a href="https://t.me/share/url?url={{ URL::current() }}"><i class="fab fa-telegram-plane"></i></a></li>
                                                <li class="list-inline-item"><a href="sms:?&body={{ URL::current() }}"><i class="far fa-envelope"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="more-button float-end">
                                            <a href="{{ route('single.blog', $post->slug) }}"><span class="icon-options"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
						@empty
						<div class="text-center"><strong>No Post Avalable</strong></div>
                        @endforelse
                    </div>
                    {{ $posts->links() }}
				</div>
				<div class="col-lg-4">

					<!-- sidebar -->
					<div class="sidebar">
						<!-- widget popular posts -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Popular Posts</h3>
								<img src="{{ asset('frontend/assets') }}/images/wave.svg" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<!-- post -->
								@foreach ($popular_posts->take(3) as $popular_post)
									<div class="post post-list-sm circle">
										<div class="thumb circle">
											<span class="number">{{ $popular_post->sum }}</span>
											<a href="{{ route('single.blog', $popular_post->rel_to_post->slug) }}">
												<div class="inner">
													<img class="inner_img" src="{{ asset('uploads/blog') }}/{{ $popular_post->rel_to_post->blog_image }}" alt="post-title" />
												</div>
											</a>
										</div>
										<div class="details clearfix">
											<h6 class="post-title my-0"><a href="{{ route('single.blog', $popular_post->rel_to_post->slug) }}">{{ $popular_post->rel_to_post->title }}</a></h6>
											<ul class="meta list-inline mt-1 mb-0">
												<li class="list-inline-item">{{ $popular_post->rel_to_post->created_at->format('d M Y') }}</li>
											</ul>
										</div>
									</div>
								@endforeach
								<!-- post -->
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
						<!-- widget post carousel -->

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