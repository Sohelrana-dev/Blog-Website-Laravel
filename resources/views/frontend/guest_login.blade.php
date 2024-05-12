@extends('frontend.master')
@section('content')
    <section class="main-content">
    <div class="container-xl">

        <div class="spacer" data-height="50"></div>

        <!-- section header -->
        <div class="section-header text-center">
            <h3 class="section-title ">Login</h3>
            <img src="{{ asset('frontend/assets') }}/images/wave.svg" class="wave" alt="wave" />
        </div>

        <!-- Contact Form -->


        <div class="row">
            <div class="column col-lg-6 m-auto">
                 @if(session('guest_wrong'))
                        <div class="alert alert-danger text-danger">{{ session('guest_wrong') }}</div>
                    @endif
                <!-- Name input -->
                <form class="contact-form" action="{{ route('guest.login.req') }}" method="post">
                    @csrf
                    <div class="messages"></div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Your Email">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
                    </div>
                    <div class="orm-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </form>
                    <div class="form-group">
                         <p>Login With<a href="{{ route('google.redirect') }}" class="mt-2 mx-3 lgn-btnn"> <img src="https://i.postimg.cc/prqHpRpV/003-google.png" alt=""></a>  <a href="{{ route('github.redirect') }}"><img src="https://i.postimg.cc/J7qmTcPw/002-github.png" alt=""></a></p>
                       
                    </div>
                    <div class="form-group">
                       <li>Don't Have account? &nbsp;<a href="{{ route('guest.register') }}">Sign Up</a></li>
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