@extends('frontend.master')
@section('content')
    <!-- hero section -->
	<section id="hero">

		<div class="container-xl">

			<div class="row gy-4">

				<div class="col-lg-8">
					
					<!-- featured post large -->
					@foreach ($banner_posts->take(1) as $post)
					<div class="post featured-post-lg">
						<div class="details clearfix">
							<a href="{{ route('category.post', $post->category_id) }}" class="category-badge">{{ $post->rel_to_cat->name }}</a>
							<h2 class="post-title"><a href="{{ route('single.blog', $post->slug) }}">{{ $post->title }}</a></h2>
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

				</div>

				<div class="col-lg-4">

					<!-- post tabs -->
					<div class="post-tabs rounded bordered">
						<!-- tab navs -->
						<ul class="nav nav-tabs nav-pills nav-fill" id="postsTab" role="tablist">
							<li class="nav-item" role="presentation"><button aria-controls="popular" aria-selected="true" class="nav-link active" data-bs-target="#popular" data-bs-toggle="tab" id="popular-tab" role="tab" type="button">Popular</button></li>
							<li class="nav-item" role="presentation"><button aria-controls="recent" aria-selected="false" class="nav-link" data-bs-target="#recent" data-bs-toggle="tab" id="recent-tab" role="tab" type="button">Recent</button></li>
						</ul>
						<!-- tab contents -->
						<div class="tab-content" id="postsTabContent">
							<!-- loader -->
							<div class="lds-dual-ring"></div>
							<!-- popular posts -->
							<div aria-labelledby="popular-tab" class="tab-pane fade show active" id="popular" role="tabpanel">
								<!-- post -->
								@foreach ($popular_posts->take(4) as $popular_post)
								<div class="post post-list-sm circle">
									<div class="thumb circle">
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
								{{-- <div class="post post-list-sm circle">
									<div class="thumb circle">
										<a href="blog-single.html">
											<div class="inner">
												<img src="{{ asset('frontend/assets') }}/images/posts/tabs-2.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">An Incredibly Easy Method That Works For All</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">29 March 2021</li>
										</ul>
									</div>
								</div>
								<!-- post -->
								<div class="post post-list-sm circle">
									<div class="thumb circle">
										<a href="blog-single.html">
											<div class="inner">
												<img src="{{ asset('frontend/assets') }}/images/posts/tabs-3.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">10 Ways To Immediately Start Selling Furniture</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">29 March 2021</li>
										</ul>
									</div>
								</div>
								<!-- post -->
								<div class="post post-list-sm circle">
									<div class="thumb circle">
										<a href="blog-single.html">
											<div class="inner">
												<img src="{{ asset('frontend/assets') }}/images/posts/tabs-4.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">15 Unheard Ways To Achieve Greater Walker</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">29 March 2021</li>
										</ul>
									</div>
								</div> --}}
							</div>
							<!-- recent posts -->
							<div aria-labelledby="recent-tab" class="tab-pane fade" id="recent" role="tabpanel">
								<!-- post -->

								@foreach ($all_posts->take(4) as $all_post)
								<div class="post post-list-sm circle">
									<div class="thumb circle">
										<a href="{{ route('single.blog', $all_post->slug) }}">
											<div class="inner">
												<img src="{{ asset('uploads/blog/') }}/{{ $all_post->blog_image }}"class="inner_img" alt="post-title"/>
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="{{ route('single.blog', $all_post->slug) }}">{{ $all_post->title }}</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">{{ $all_post->created_at->format('d M Y') }}</li>
										</ul>
									</div>
								</div>
								@endforeach
								<!-- post -->
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</section>

	<!-- section main content -->
	<section class="main-content">
		<div class="container-xl">

			<div class="row gy-4">

				<div class="col-lg-8">

					<!-- section header -->
					<div class="section-header">
						<h3 class="section-title">Editor's Pick</h3>
						<img src="{{ asset('frontend/assets') }}/images/wave.svg" class="wave" alt="wave" />
					</div>

					<div class="padding-30 rounded bordered">
						<div class="row gy-5">
							<div class="col-sm-6">
								<!-- post -->
								@foreach ($editor_post->take(1) as $post)
								<div class="post">
									<div class="thumb rounded">
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
									<ul class="meta list-inline mt-4 mb-0">
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
								@endforeach
							</div>
							<div class="col-sm-6">
								<!-- post -->
								@foreach ($editor_post2->take(4) as $post)
								<div class="post post-list-sm square">
									<div class="thumb rounded">
										<a href="{{ route('single.blog', $post->slug) }}">
											<div class="inner">
												<img src="{{ asset('uploads/blog') }}/{{ $post->blog_image }}" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="{{ route('single.blog', $post->slug) }}">{{ $post->title }}</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">{{ $post->created_at->format('d M Y') }}</li>
										</ul>
									</div>
								</div>
								@endforeach
								<!-- post -->
							</div>
						</div>
					</div>

					<div class="spacer" data-height="50"></div>

					<!-- horizontal ads -->
					<div class="ads-horizontal text-md-center">
						<span class="ads-title">- Sponsored Ad -</span>
						<a href="#">
							<img src="{{ asset('frontend/assets') }}/images/ads/ad-750.png" alt="Advertisement" />
						</a>
					</div>

					<div class="spacer" data-height="50"></div>

					<!-- section header -->
					<div class="section-header">
						<h3 class="section-title">Trending</h3>
						<img src="{{ asset('frontend/assets') }}/images/wave.svg" class="wave" alt="wave" />
					</div>

					<div class="padding-30 rounded bordered">
						<div class="row gy-5">
							<div class="col-sm-6">
								<!-- post large -->
								@foreach ($trending_posts->take(1) as $trending_post)
								<div class="post">
									<div class="thumb rounded">
										<a href="{{ route('category.post', $trending_post->category_id) }}" class="category-badge position-absolute">{{ $trending_post->rel_to_cat->name }}</a>
										<span class="post-format">
											<i class="icon-picture"></i>
										</span>
										<a href="{{ route('single.blog', $trending_post->slug) }}">
											<div class="inner">
												<img src="{{ asset('uploads/blog') }}/{{ $trending_post->blog_image }}" alt="post-title" />
											</div>
										</a>
									</div>
									<ul class="meta list-inline mt-4 mb-0">
										<li class="list-inline-item"><a href="{{ route('author', $trending_post->author_id) }}">
											@if ($trending_post->rel_to_user->profile_photo == NULL)
											<img class="author"
												src="{{ Avatar::create($trending_post->rel_to_user->name)->toBase64() }}" alt="author"/>
											@else
											<img class="author"
												src="{{ asset('uploads/user') }}/{{ $trending_post->rel_to_user->profile_photo }}" alt="author" />
											@endif
											{{ $trending_post->rel_to_user->name }}</a></li>
										<li class="list-inline-item">{{ $trending_post->created_at->format('d M Y') }}</li>
									</ul>
									<h5 class="post-title mb-3 mt-3"><a href="{{ route('single.blog', $trending_post->slug) }}">{{ $trending_post->title }}</a></h5>
									<p class="excerpt mb-0">{{ $trending_post->short_desp }}</p>
								</div>
								@endforeach
								<!-- post -->
								@foreach ($trending_post2->take(2) as $trending_post)
								<div class="post post-list-sm square before-seperator">
									<div class="thumb rounded">
										<a href="{{ route('single.blog', $trending_post->slug) }}">
											<div class="inner">
												<img src="{{ asset('uploads/blog') }}/{{ $trending_post->blog_image }}" alt="post-title"/>
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="{{ route('single.blog', $trending_post->slug) }}">{{ $trending_post->title }}</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">{{ $trending_post->created_at->format('d M Y') }}</li>
										</ul>
									</div>
								</div>
								@endforeach
								<!-- post -->
							</div>
							<div class="col-sm-6"> 
								<!-- post large -->
								@foreach ($trending_post3->take(1) as $trending_post)
									<div class="post">
										<div class="thumb rounded">
											<a href="{{ route('category.post', $trending_post->category_id) }}" class="category-badge position-absolute">{{ $trending_post->rel_to_cat->name }}</a>
											<span class="post-format">
												<i class="icon-picture"></i>
											</span>
											<a href="{{ route('single.blog', $trending_post->slug) }}">
												<div class="inner">
													<img src="{{ asset('uploads/blog') }}/{{ $trending_post->blog_image }}" alt="post-title" />
												</div>
											</a>
										</div>
										<ul class="meta list-inline mt-4 mb-0">
											<li class="list-inline-item"><a href="{{ route('author', $trending_post->author_id) }}">
												@if ($trending_post->rel_to_user->profile_photo == NULL)
												<img class="author"
													src="{{ Avatar::create($trending_post->rel_to_user->name)->toBase64() }}" alt="author"/>
												@else
												<img class="author"
													src="{{ asset('uploads/user') }}/{{ $trending_post->rel_to_user->profile_photo }}" alt="author" />
												@endif
												{{ $trending_post->rel_to_user->name }}</a></li>
											<li class="list-inline-item">{{ $trending_post->created_at->format('d M Y') }}</li>
										</ul>
										<h5 class="post-title mb-3 mt-3"><a href="{{ route('single.blog', $trending_post->slug) }}">{{ $trending_post->title }}</a></h5>
										<p class="excerpt mb-0">{{ $trending_post->short_desp }}</p>
									</div>
								@endforeach
								<!-- post -->
								@foreach ($trending_post4->take(2) as $trending_post)
									<div class="post post-list-sm square before-seperator">
										<div class="thumb rounded">
											<a href="{{ route('single.blog', $trending_post->slug) }}">
												<div class="inner">
													<img src="{{ asset('uploads/blog') }}/{{ $trending_post->blog_image }}" alt="post-title"/>
												</div>
											</a>
										</div>
										<div class="details clearfix">
											<h6 class="post-title my-0"><a href="{{ route('single.blog', $trending_post->slug) }}">{{ $trending_post->title }}</a></h6>
											<ul class="meta list-inline mt-1 mb-0">
												<li class="list-inline-item">{{ $trending_post->created_at->format('d M Y') }}</li>
											</ul>
										</div>
									</div>
								@endforeach
								<!-- post -->
							</div>
						</div>
					</div>

					<div class="spacer" data-height="50"></div>

					<!-- section header -->
					<div class="section-header">
						<h3 class="section-title">{{ $category_name }}</h3>
						<img src="{{ asset('frontend/assets') }}/images/wave.svg" class="wave" alt="wave" />
						<div class="slick-arrows-top">
							<button type="button" data-role="none" class="carousel-topNav-prev slick-custom-buttons" aria-label="Previous"><i class="icon-arrow-left"></i></button>
							<button type="button" data-role="none" class="carousel-topNav-next slick-custom-buttons" aria-label="Next"><i class="icon-arrow-right"></i></button>
						</div>
					</div>

					<div class="row post-carousel-twoCol post-carousel">
						<!-- post -->
						@foreach ($banner_posts as $banner_post)
							<div class="post post-over-content col-md-6">
								<div class="details clearfix">
									<a href="{{ route('category.post', $banner_post->category_id) }}" class="category-badge">{{  $banner_post->rel_to_cat->name }}</a>
									<h4 class="post-title"><a href="{{ route('single.blog', $banner_post->slug) }}">{{  $banner_post->title }}</a></h4>
									<ul class="meta list-inline mb-0">
										<li class="list-inline-item"><a href="{{ route('author', $banner_post->author_id) }}">{{  $banner_post->rel_to_user->name }}</a></li>
										<li class="list-inline-item">{{  $banner_post->created_at->format('d M Y') }}</li>
									</ul>
								</div>
								<a href="{{ route('single.blog', $banner_post->slug) }}">
									<div class="thumb rounded">
										<div class="inner">
											<img src="{{ asset('uploads/blog') }}/{{  $banner_post->blog_image }}" alt="thumb" />
										</div>
									</div>
								</a>
							</div>
						@endforeach
						<!-- post -->
						{{-- <div class="post post-over-content col-md-6">
							<div class="details clearfix">
								<a href="category.html" class="category-badge">Inspiration</a>
								<h4 class="post-title"><a href="blog-single.html">Feel Like A Pro With The Help Of These 7 Tips</a></h4>
								<ul class="meta list-inline mb-0">
									<li class="list-inline-item"><a href="#">Katen Doe</a></li>
									<li class="list-inline-item">29 March 2021</li>
								</ul>
							</div>
							<a href="blog-single.html">
								<div class="thumb rounded">
									<div class="inner">
										<img src="{{ asset('frontend/assets') }}/image/posts/inspiration-2.jpg" alt="thumb" />
									</div>
								</div>
							</a>
						</div>
						<!-- post -->
						<div class="post post-over-content col-md-6">
							<div class="details clearfix">
								<a href="category.html" class="category-badge">Inspiration</a>
								<h4 class="post-title"><a href="blog-single.html">Your Light Is About To Stop Being Relevant</a></h4>
								<ul class="meta list-inline mb-0">
									<li class="list-inline-item"><a href="#">Katen Doe</a></li>
									<li class="list-inline-item">29 March 2021</li>
								</ul>
							</div>
							<a href="blog-single.html">
								<div class="thumb rounded">
									<div class="inner">
										<img src="{{ asset('frontend/assets') }}/images/posts/inspiration-3.jpg" alt="thumb" />
									</div>
								</div>
							</a>
						</div> --}}
					</div>

					<div class="spacer" data-height="50"></div>

					<!-- section header -->
					<div class="section-header">
						<h3 class="section-title">Latest Posts</h3>
						<img src="{{ asset('frontend/assets') }}/images/wave.svg" class="wave" alt="wave" />
					</div>

					<div class="padding-30 rounded bordered">

						<div class="row">
							
							<div class="col-md-12 col-sm-6">
								<!-- post -->
								@foreach ($all_posts->take(4) as $all_post)
								<div class="post post-list clearfix">
									<div class="thumb rounded">
										<span class="post-format-sm">
											<i class="icon-picture"></i>
										</span>
										<a href="{{ route('single.blog', $all_post->slug) }}">
											<div class="inner">
												<img src="{{ asset('uploads/blog') }}/{{ $all_post->blog_image }}" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details">
										<ul class="meta list-inline mb-3">
											<li class="list-inline-item"><a href="{{ route('author', $all_post->author_id) }}">
											@if ($all_post->rel_to_user->profile_photo == NULL)
											<img class="author"
												src="{{ Avatar::create($all_post->rel_to_user->name)->toBase64() }}" alt="author"/>
											@else
											<img class="author"
												src="{{ asset('uploads/user') }}/{{ $all_post->rel_to_user->profile_photo }}" alt="author" />
											@endif
												{{ $all_post->rel_to_user->name }}</a></li>
											<li class="list-inline-item"><a href="{{ route('category.post', $all_post->category_id) }}">{{ $all_post->rel_to_cat->name }}</a></li>
											<li class="list-inline-item">{{ $all_post->created_at->format('d M Y') }}</li>
										</ul>
										<h5 class="post-title"><a href="{{ route('single.blog', $all_post->slug) }}">{{ $all_post->title }}</a></h5>
										<p class="excerpt mb-0">{{ $all_post->short_desp }}</p>
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
											<div class="more-button float-end">
												<a href="{{ route('single.blog', $all_post->slug) }}"><span class="icon-options"></span></a>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
							
						</div
						>
						<!-- load more button -->
						<div class="text-center">
							<a href="{{ route('all.post') }}" class="btn btn-simple">Load More</a>
						</div>

					</div>

				</div>
				<div class="col-lg-4">

					<!-- sidebar -->
					<div class="sidebar">
						<!-- widget about -->
						<div class="widget rounded">
							<div class="widget-about data-bg-image text-center" data-bg-image="{{ asset('frontend/assets') }}/images/map-bg.png">
								<img src="{{ asset('uploads/logo') }}/{{ App\Models\Logo::first()->logo }}" alt="logo" class="mb-4" />
								@foreach ($admin_desps->take(1) as $admin_desp)
										@if ($admin_desp)
											<p class="mb-4">{{ $admin_desp->admin_desp }}</p>
										@endif
								@endforeach
								<ul class="social-icons list-unstyled list-inline mb-0">
									@foreach ($admin_icons as $admin_icon)
									<li class="list-inline-item"><a href="{{ $admin_icon->link }}"><i class="{{ $admin_icon->icon }}"></i></a></li>
									@endforeach
								</ul>
							</div>
						</div>

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

						<!-- widget newsletter -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Newsletter</h3>
								<img src="{{ asset('frontend/assets') }}/images/wave.svg" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<span class="newsletter-headline text-center mb-3">Join {{ App\Models\subscribe::count() }} subscribers!</span>
								<form action="{{ route('subscribe.store') }}" method="POST">
									@csrf
									<div class="mb-2">
										<input class="form-control w-100 text-center" placeholder="Email address…" type="email" name="email">
										@error('email')
											<strong class="text-danger">{{ $message }}</strong>
										@enderror
									</div>
									<button class="btn btn-default btn-full" type="submit">Subscribe</button>
								</form>
								<span class="newsletter-privacy text-center mt-3">By signing up, you agree to our <a href="#">Privacy Policy</a></span>
							</div>		
						</div>

						<!-- widget post carousel -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">{{ $category_name }}</h3>
								<img src="{{ asset('frontend/assets') }}/images/wave.svg" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<div class="post-carousel-widget">
									<!-- post -->
									@foreach ($banner_posts as $banner_post)
									<div class="post post-carousel">
										<div class="thumb rounded">
											<a href="{{ route('category.post', $banner_post->category_id) }}" class="category-badge position-absolute">{{ $category_name }}</a>
											<a href="{{ route('single.blog', $banner_post->slug) }}">
												<div class="inner">
													<img src="{{ asset('uploads/blog') }}/{{ $banner_post->blog_image }}" alt="post-title" />
												</div>
											</a>
										</div>
										<h5 class="post-title mb-0 mt-4"><a href="{{ route('single.blog', $banner_post->slug) }}">{{ $banner_post->title }}</a></h5>
										<ul class="meta list-inline mt-2 mb-0">
											<li class="list-inline-item"><a href="{{ route('author', $banner_post->author_id) }}">{{ $banner_post->rel_to_user->name }}</a></li>
											<li class="list-inline-item">{{ $banner_post->created_at->format('d M Y') }}</li>
										</ul>
									</div>
									@endforeach
									<!-- post -->
								</div>
								<!-- carousel arrows -->
								<div class="slick-arrows-bot">
									<button type="button" data-role="none" class="carousel-botNav-prev slick-custom-buttons" aria-label="Previous"><i class="icon-arrow-left"></i></button>
									<button type="button" data-role="none" class="carousel-botNav-next slick-custom-buttons" aria-label="Next"><i class="icon-arrow-right"></i></button>
								</div>
							</div>		
						</div>

						<!-- widget advertisement -->
						<div class="widget no-container rounded text-md-center">
							<span class="ads-title">- Sponsored Ad -</span>
							<a href="#" class="widget-ads">
								<img src="{{ asset('frontend/assets') }}/images/ads/ad-360.png" alt="Advertisement" />	
							</a>
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
	@if (session('sub_add'))
		<script>
			Swal.fire({
				position: "top-end",
				icon: "success",
				title: "{{ session('sub_add') }}",
				showConfirmButton: false,
				timer: 1500
			});
		</script>
	@endif
	@if (session('guest_suc'))
		<script>
			Swal.fire({
				position: "top-end",
				icon: "success",
				title: "{{ session('guest_suc') }}",
				showConfirmButton: false,
				timer: 1500
			});
		</script>
	@endif

	<script>
		$('.btn-search').click(function(){
				var search_input = $('#search_input').val();
				var link = "{{ route('all.post') }}"+"?search_input="+search_input;
				window.location.href = link;
		});
	</script>
@endsection