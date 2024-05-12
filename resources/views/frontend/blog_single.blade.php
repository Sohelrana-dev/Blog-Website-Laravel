@extends('frontend.master')
@section('content')

<section class="main-content mt-3">
    <div class="container-xl">
        @php
            $breads = Request::segments();
            array_pop($breads);
        @endphp
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                @foreach ( $breads as $segment)
                    <li class="breadcrumb-item active" aria-current="page">{{ ucwords($segment) }}</li>
                @endforeach
            </ol>
        </nav>

        <div class="row gy-4">

            <div class="col-lg-8">
                <!-- post single -->
                <div class="post post-single">
                    <!-- post header -->
                    <div class="post-header">
                        <h1 class="title mt-0 mb-3">{{ $single_posts->title }}</h1>
                        <ul class="meta list-inline mb-0">
                            <li class="list-inline-item"><a href="{{ route('author', $single_posts->author_id) }}">
                                @if ($single_posts->rel_to_user->profile_photo == NULL)
                                 <img class="author"
                                    src="{{ Avatar::create($single_posts->rel_to_user->name)->toBase64() }}" alt="author"/>
                                @else
                                 <img class="author"
                                    src="{{ asset('uploads/user') }}/{{ $single_posts->rel_to_user->profile_photo }}" alt="author" />
                                @endif
                                {{ $single_posts->rel_to_user->name }}</a></li>
                            <li class="list-inline-item"><a href="{{ route('category.post', $single_posts->category_id) }}">{{ $single_posts->rel_to_cat->name }}</a></li>
                            <li class="list-inline-item">{{ $single_posts->created_at->format('d M Y') }}</li>
                        </ul>
                    </div>
                    <!-- featured image -->
                    <div class="featured-image">
                        <img src="{{ asset('uploads/blog') }}/{{ $single_posts->blog_image }}" alt="post-title" />
                    </div>
                    <!-- post content -->
                    <div class="post-content clearfix">
                        <p>{{ $single_posts->short_desp }}</p>

                        <p>{!! $single_posts->blog_desp !!}</p>

                        <h5>{{ $single_posts->summery_title }}</h5>

                        <p>{!! $single_posts->sum_desp !!}</p>
                    </div>
                    <!-- post bottom section -->
                    <div class="post-bottom">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-6 col-12 text-center text-md-start">
                                <!-- tags -->
                                @php
                                    $after_explode = explode(',', $single_posts->tag);
                                @endphp
                                @foreach ($after_explode as $tag)
                                <a href="{{ route('tag.details', $tag) }}" class="tag">#{{ App\Models\Tag::find($tag)->tag_name }}</a>
                                @endforeach
                            </div>
                            <div class="col-md-6 col-12">
                                <!-- social icons -->
                                <ul class="social-icons list-unstyled list-inline mb-0 float-md-end">
                                    <li class="list-inline-item"><a href="https://www.facebook.com/sharer.php?u={{ URL::current() }}"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="list-inline-item"><a href="https://twitter.com/intent/tweet?url={{ URL::current() }}"><i class="fab fa-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="https://www.linkedin.com/sharing/share-offsite/?url={{ URL::current() }}"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li class="list-inline-item"><a href="https://pinterest.com/pin/create/button/?url={{ URL::current() }}"><i class="fab fa-pinterest"></i></a></li>
                                    <li class="list-inline-item"><a href="https://t.me/share/url?url={{ URL::current() }}"><i class="fab fa-telegram-plane"></i></a>
                                    </li>
                                    <li class="list-inline-item"><a href="sms:?&body={{ URL::current() }}"><i class="far fa-envelope"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="spacer" data-height="50"></div>

                <div class="about-author padding-30 rounded">
                    <div class="thumb">
                        @if ($single_posts->rel_to_user->profile_photo == NULL)
                            <img class="author_single"
                            src="{{ Avatar::create($single_posts->rel_to_user->name)->toBase64() }}" alt="author"/>
                        @else
                            <img class="author_single"
                            src="{{ asset('uploads/user') }}/{{ $single_posts->rel_to_user->profile_photo }}" alt="author" />
                        @endif
                    </div>
                    <div class="details">
                        <h4 class="name"><a href="#">{{ $single_posts->rel_to_user->name }}</a></h4>
                        @if ($author_desp)
                        <p>{{ $author_desp->auth_desp }}</p>
                        @endif
                        <!-- social icons -->
                        <ul class="social-icons list-unstyled list-inline mb-0">
                            @foreach ($author_social_icons as $author_social_icon)
                            <li class="list-inline-item"><a href="{{ $author_social_icon->link }}"><i class="{{ $author_social_icon->icon }}"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="spacer" data-height="50"></div>

                <!-- section header -->
                <div class="section-header">

                    <h3 class="section-title">{{ Str::plural('comment', $comments->count()) }} ({{ $comments->count() }})</h3>
                    <img src="{{ asset('frontend/assets') }}/images/wave.svg" class="wave" alt="wave"/>
                </div>
                <!-- post comments -->
                <div class="comments bordered padding-30 rounded">

                    <ul class="comments">
                        <!-- comment item -->
                        @foreach ($comments as $comment)                            
                        <li class="comment rounded">
                            <div class="thumb">
                                @if ($comment->rel_to_guest->photo == NULL)
                                    <img class="author_single"
                                    src="{{ Avatar::create($comment->rel_to_guest->name)->toBase64() }}" alt="author"/>
                                @else
                                    <img class="author_single"
                                    src="{{ asset('uploads/user') }}/{{ $comment->rel_to_guest->photo }}" alt="author" />
                                @endif
                            </div>
                            <div class="details">
                                <h4 class="name"><a href="#">{{ $comment->rel_to_guest->name }}</a></h4>
                                <span class="date">{{ $comment->created_at->diffForHumans() }}</span>
                                <p>{{ $comment->comment }}</p>
                                <button class="btn btn-default btn-sm reply_btn" type="button" data-bs-toggle="modal" comment-id="{{ $comment->id }}" comment-name="{{ $comment->rel_to_guest->name }}" data-bs-target="#exampleModal">Reply</button>
                            </div>
                        </li>

                        @foreach ($comment->replies as $reply)
                            <li class="comment child rounded">
                                <div class="thumb">
                                     @if ($reply->rel_to_guest->photo == NULL)
                                        <img class="author_single"
                                        src="{{ Avatar::create($reply->rel_to_guest->name)->toBase64() }}" alt="author"/>
                                    @else
                                        <img class="author_single"
                                        src="{{ asset('uploads/user') }}/{{ $reply->rel_to_guest->photo }}" alt="author" />
                                    @endif
                                </div>
                                <div class="details">
                                    <h4 class="name"><a href="#">{{ $reply->rel_to_guest->name }}</a></h4>
                                    <span class="date">{{ $reply->created_at->diffForHumans() }}</span>
                                    <p>{{ $reply->comment }}</p>
                                    <button class="btn btn-default btn-sm reply_btn" type="button" data-bs-toggle="modal" comment-id="{{ $reply->id }}" comment-name="{{ $reply->rel_to_guest->name }}" data-bs-target="#exampleModal">Reply</button>
                                </div>
                            </li>

                        @foreach ($reply->replies as $replys)
                            <li class="comment child rounded" style="padding-left: 80px">
                                <div class="thumb">
                                     @if ($replys->rel_to_guest->photo == NULL)
                                        <img class="author_single"
                                        src="{{ Avatar::create($replys->rel_to_guest->name)->toBase64() }}" alt="author"/>
                                    @else
                                        <img class="author_single"
                                        src="{{ asset('uploads/user') }}/{{ $replys->rel_to_guest->photo }}" alt="author" />
                                    @endif
                                </div>
                                <div class="details">
                                    <h4 class="name"><a href="#">{{ $replys->rel_to_guest->name }}</a></h4>
                                    <span class="date">{{ $replys->created_at->diffForHumans() }}</span>
                                    <p>{{ $replys->comment }}</p>
                                    <button class="btn btn-default btn-sm reply_btn" type="button" data-bs-toggle="modal" comment-id="{{ $replys->id }}" comment-name="{{ $replys->rel_to_guest->name }}"  data-bs-target="#exampleModal">Reply</button>
                                </div>
                            </li>

                        @foreach ($replys->replies as $repli)
                        <li class="comment child rounded" style="padding-left: 80px">
                            <div class="thumb">
                                    @if ($repli->rel_to_guest->photo == NULL)
                                    <img class="author_single"
                                    src="{{ Avatar::create($repli->rel_to_guest->name)->toBase64() }}" alt="author"/>
                                @else
                                    <img class="author_single"
                                    src="{{ asset('uploads/user') }}/{{ $repli->rel_to_guest->photo }}" alt="author" />
                                @endif
                            </div>
                            <div class="details">
                                <h4 class="name"><a href="#">{{ $repli->rel_to_guest->name }}</a></h4>
                                <span class="date">{{ $repli->created_at->diffForHumans() }}</span>
                                <p>{{ $repli->comment }}</p>
                                <button class="btn btn-default btn-sm reply_btn" type="button" data-bs-toggle="modal" comment-id="{{ $replys->id }}" comment-name="{{ $repli->rel_to_guest->name }}"  data-bs-target="#exampleModal">Reply</button>
                            </div>
                        </li>
                        @endforeach
                        @endforeach
                        @endforeach
                        @endforeach
                        <!-- comment item --> 
                        

                        <!-- Modal -->
                                 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 id="exampleModalLabel">Reply To: <span class="parent_name"></span></h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    <form action="{{ route('comment.store', $single_posts->id) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            @auth('guestlogin')
                                                <div class="row">
                                                    <div class="column col-md-6">
                                                        <!-- Email input -->
                                                        <div class="form-group">
                                                            <input type="email" class="form-control" disabled readonly value="{{ Auth::guard('guestlogin')->user()->name }}">
                                                            <input type="hidden" class="parent_id" name="parent_id">
                                                        </div>
                                                    </div>
                                                    <div class="column col-md-6">
                                                        <!-- Name input -->
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" disabled readonly>
                                                        </div> 
                                                    </div>

                                                    <div class="column col-md-12">
                                                        <!-- Comment textarea -->
                                                        <div class="form-group">
                                                            <textarea name="comment" id="InputComment" class="form-control" rows="4"
                                                                placeholder="Your comment here..." required="required"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-default">Send</button>
                                                </div>
                                            @else
                                            <div>
                                                <h4>To reply Login First, &nbsp;<a href="{{ route('guest.login') }}">Login</a></h4>
                                            </div>
                                            @endauth
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                        {{-- modal  --}}
                        <!-- comment item -->
                        {{-- <li class="comment rounded">
                            <div class="thumb">
                                <img src="{{ asset('frontend/assets') }}/images/other/comment-3.png" alt="John Doe" />
                            </div>
                            <div class="details">
                                <h4 class="name"><a href="#">Anna Doe</a></h4>
                                <span class="date">Jan 08, 2021 14:41 pm</span>
                                <p>Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in
                                    faucibus orci luctus et ultrices posuere cubilia.</p>
                                <a href="#" class="btn btn-default btn-sm">Reply</a>
                            </div>
                        </li> --}}
                    </ul>
                </div>

                <div class="spacer" data-height="50"></div>

                <!-- section header -->
                
                <!-- comment form -->
                @auth('guestlogin')
                    <div class="section-header">
                        <h3 class="section-title">Leave Comment</h3>
                        <img src="{{ asset('frontend/assets') }}/images/wave.svg" class="wave" alt="wave" />
                    </div>
                    <div class="comment-form rounded bordered padding-30">

                        <form id="comment-form" action="{{ route('comment.store', $single_posts->id) }}" class="comment-form" method="post">
                            @csrf
                            <div class="messages"></div>

                            <div class="row">
                                <div class="column col-md-6">
                                    <!-- Email input -->
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="InputEmail" disabled readonly value="{{ Auth::guard('guestlogin')->user()->name }}">
                                    </div>
                                </div>
                                <div class="column col-md-6">
                                    <!-- Name input -->
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled readonly value="{{ Auth::guard('guestlogin')->user()->email }}">
                                    </div>
                                </div>

                                <div class="column col-md-12">
                                    <!-- Comment textarea -->
                                    <div class="form-group">
                                        <textarea name="comment" id="InputComment" class="form-control" rows="4"
                                            placeholder="Your comment here..." required="required"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="column col-md-12 d-flex justify-content-end">
                               <button type="submit" id="submit" value="Submit" class="btn btn-default">Submit</button>
                            </div> 
                        </form>
                    </div>
                @else
                   <div><h3>To Leave Comment Please, <a href="{{ route('guest.register') }}">Sign Up </a></h3></div>
                @endauth
            </div>

            <div class="col-lg-4">

                <!-- sidebar -->
                <div class="sidebar">
                    <!-- widget about -->
                    <div class="widget rounded">
                        <div class="widget-about data-bg-image text-center" data-bg-image="{{ asset('frontend/assets') }}/images/map-bg.png">
                            <img src="{{ asset('uploads/logo') }}/{{ App\Models\Logo::first()->logo }}" alt="logo" class="mb-4" />
                            @foreach ($admin_desp->take(1) as $admin_des)
                            @if ($admin_des)
                            <p class="mb-4">{{ $admin_des->admin_desp }}</p>
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
	<script>
		$('.btn-search').click(function(){
				var search_input = $('#search_input').val();
				var link = "{{ route('all.post') }}"+"?search_input="+search_input;
				window.location.href = link;
		});


        $('.reply_btn').click(function(){
            var comment_id = $(this).attr('comment-id');
            var comment_name = $(this).attr('comment-name');
            $('.parent_id').val(comment_id);
            $('.parent_name').text(comment_name).addClass('text-primary');
        });


         $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever') 
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
        })
	</script>

    @if (session('reply_login'))
        <script>
            Swal.fire({
                title: "{{ session('reply_login') }}",
                showClass: {
                    popup: `
                    animate__animated
                    animate__fadeInUp
                    animate__faster
                    `
                },
                hideClass: {
                    popup: `
                    animate__animated
                    animate__fadeOutDown
                    animate__faster
                    `
                    }
            });
        </script>
    @endif
@endsection
