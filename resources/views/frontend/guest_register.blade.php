@extends('frontend.master')
@section('content')
<!-- section main content -->
<section class="main-content">
    <div class="container-xl">

        <div class="spacer" data-height="50"></div>

        <!-- section header -->
        <div class="section-header text-center">
            <h3 class="section-title ">Sign Up</h3>
            <img src="{{ asset('frontend/assets') }}/images/wave.svg" class="wave" alt="wave" />
        </div>

        <!-- Contact Form -->


        <div class="row">
            <div class="column col-lg-6 m-auto">
                <!-- Name input -->
                <form class="contact-form" action="{{ route('guest.store') }}" method="post">
                    @csrf
                    <div class="messages"></div>
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Your name">
                        @error('name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Your Email">
                         @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
                         @error('password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                       <li>Already Have an account? &nbsp;<a href="{{ route('guest.login') }}"> Login</a></li>
                    </div>
                    <div class="orm-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </form>
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