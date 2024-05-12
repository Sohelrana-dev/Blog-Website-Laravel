
<!DOCTYPE html>
<html lang="en-US">

<!-- Mirrored from themeger.shop/html/katen/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Nov 2023 05:32:38 GMT -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Sohel - Minimal Blog & Magazine</title>
	<meta name="description" content="Katen - Minimal Blog & Magazine HTML Theme">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets') }}/images/favicon.png">

	<!-- STYLES -->
	<link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/bootstrap.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/all.min.css" type="text/css" media="all">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/slick.css" type="text/css" media="all">
	<link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/simple-line-icons.css" type="text/css" media="all">
	<link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/style.css" type="text/css" media="all">

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<style>
.author{
	width: 40px !important;
	height: 40px !important;
	border-radius: 50%;
}
.author2{
	width: 100px !important;
	height: 100px !important;
	border-radius: 50%;
}
.lgn-btnn{
	color: green !important;
}

.inner_img{
	width: 60px !important;
	height: 60px !important;
	border-radius: 50%;
}
.author_single{
	width: 60px !important;
	height: 60px !important;
	border-radius: 50%;
}
</style>

<body>

<!-- preloader -->
<div id="preloader">
	<div class="book">
		<div class="inner">
			<div class="left"></div>
			<div class="middle"></div>
			<div class="right"></div>
		</div>
		<ul>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</div>

<!-- site wrapper -->
<div class="site-wrapper">

<div class="main-overlay"></div>

	<!-- header -->
	<header class="header-default">
		<nav class="navbar navbar-expand-lg">
			<div class="container-xl">
				<!-- site logo -->
				<a class="navbar-brand" href="{{ route('index') }}"><img src="{{ asset('uploads/logo') }}/{{ App\Models\Logo::first()->logo }}" alt="logo"/></a> 

				<div class="collapse navbar-collapse">
					<!-- menus -->
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="{{ route('index') }}">Home</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#">Category</a>
							<ul class="dropdown-menu">
								@foreach (App\Models\Category::all() as $category)
								<li><a class="dropdown-item" href="{{ route('category.post', $category->id) }}">{{ $category->name }}</a></li>
								@endforeach
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('all.post.sec') }}">All Post</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('contact') }}">Contact</a>
						</li>
						@auth('guestlogin')
							<li class="nav-item active">
								<a class="nav-link" target="blank" href="{{ route('login') }}">Dashboard</a>
							</li>
						@endauth
					</ul>
				</div>

				<!-- header right section -->
				<div class="header-right">
					<!-- social icons -->
					<ul class="social-icons list-unstyled list-inline mb-0">
						@foreach (App\Models\Adminicon::all() as $icon)
						<li class="list-inline-item"><a href="{{ $icon->link }}"><i class="{{ $icon->icon }}"></i></a></li>
						@endforeach
					</ul>
					<!-- header buttons -->
					<div class="header-buttons">
						<button class="btn border">
							@auth('guestlogin')
							<a href="{{ route('guest.logout') }}">LogOut</a>
							@else
							<a href="{{ route('guest.register') }}">Sign Up</a>
							@endauth
						</button>
						<button class="search icon-button">
							<i class="icon-magnifier"></i>
						</button>
						<button class="burger-menu icon-button">
							<span class="burger-icon"></span>
						</button>
					</div>
				</div>
			</div>
		</nav>
	</header>
	{{-- header end  --}}

	@yield('content')

	<!-- footer -->
	<footer>
		<div class="container-xl">
			<div class="footer-inner">
				<div class="row d-flex align-items-center gy-4">
					<!-- copyright text -->
					<div class="col-md-4">
						<span class="copyright">© 2024 Sohel. Template by ThemeGer.</span>
					</div>

					<!-- social icons -->
					<div class="col-md-4 text-center">
						<ul class="social-icons list-unstyled list-inline mb-0">
							@foreach (App\Models\Adminicon::all() as $icon)
							   <li class="list-inline-item"><a href="{{ $icon->link }}"><i class="{{ $icon->icon }}"></i></a></li>
							@endforeach
						</ul>
					</div>

					<!-- go to top button -->
					<div class="col-md-4">
						<a href="#" id="return-to-top" class="float-md-end"><i class="icon-arrow-up"></i>Back to Top</a>
					</div>
				</div>
			</div>
		</div>
	</footer>

</div><!-- end site wrapper -->

<!-- search popup area -->
<div class="search-popup">
	<!-- close button -->
	<button type="button" class="btn-close" aria-label="Close"></button>
	<!-- content -->
	<div class="search-content">
		<div class="text-center">
			<h3 class="mb-4 mt-0">Press ESC to close</h3>
		</div>
		<!-- form -->
		<div class="d-flex search-form">
			<input class="form-control me-2" id="search_input" type="search" placeholder="Search and press enter ..." aria-label="Search">
			<button class="btn btn-default btn-lg btn-search" type="button"><i class="icon-magnifier"></i></button>
		</div>
	</div>
</div>

<!-- canvas menu -->
<div class="canvas-menu d-flex align-items-end flex-column">
	<!-- close button -->
	<button type="button" class="btn-close" aria-label="Close"></button>

	<!-- logo -->
	<div class="logo">
		<img src="{{ asset('uploads/logo') }}/{{ App\Models\Logo::first()->logo }}" alt="sohel" />
	</div>

	<!-- menu -->
	<nav>
		<ul class="vertical-menu">
			<li class="active">
				<a href="{{ route('index') }}">Home</a>
			</li>
			<li>
				<a href="category.html">Category</a>
				<ul class="submenu">
					@foreach (App\Models\Category::all() as $category)
					<li><a class="dropdown-item" href="{{ route('category.post', $category->id) }}">{{ $category->name }}</a></li>
					@endforeach
				</ul>
			</li>
			<li><a href="{{ route('all.post.sec') }}">All Post</a></li>
			<li><a href="{{ route('contact') }}">Contact</a></li>
		</ul>
	</nav>

	<!-- social icons -->
	<ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">
		@foreach (App\Models\Adminicon::all() as $icon)
		<li class="list-inline-item"><a href="{{ $icon->link }}"><i class="{{ $icon->icon }}"></i></a></li>
		@endforeach
	</ul>
</div>

<!-- JAVA SCRIPTS -->
<script src="{{ asset('frontend/assets') }}/js/jquery.min.js"></script>
<script src="{{ asset('frontend/assets') }}/js/popper.min.js"></script>
<script src="{{ asset('frontend/assets') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('frontend/assets') }}/js/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{ asset('frontend/assets') }}/js/jquery.sticky-sidebar.min.js"></script>
<script src="{{ asset('frontend/assets') }}/js/custom.js"></script>

@yield('footer_script')
</body>

<!-- Mirrored from themeger.shop/html/katen/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Nov 2023 05:32:47 GMT -->
</html>