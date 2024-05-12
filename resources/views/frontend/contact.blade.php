@extends('frontend.master')
@section('content')

<section class="page-header">
    <div class="container-xl">
        <div class="text-center">
            <h1 class="mt-0 mb-2">Contact</h1>
            {{-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav> --}}
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

        <div class="row">

            <div class="col-md-4">
                <!-- contact info item -->
                <div class="contact-item bordered rounded d-flex align-items-center">
                    <span class="icon icon-phone"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0">Phone</h3>
                        @foreach ($contacts as $contact)
                        <p class="mb-0">0{{ $contact->number }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="spacer d-md-none d-lg-none" data-height="30"></div>
            </div>

            <div class="col-md-4">
                <!-- contact info item -->
                <div class="contact-item bordered rounded d-flex align-items-center">
                    <span class="icon icon-envelope-open"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0">E-Mail</h3>
                        @foreach ($contacts as $contact)
                        <p class="mb-0">{{ $contact->email }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="spacer d-md-none d-lg-none" data-height="30"></div>
            </div>

            <div class="col-md-4">
                <!-- contact info item -->
                <div class="contact-item bordered rounded d-flex align-items-center">
                    <span class="icon icon-map"></span>
                    <div class="details">
                        <h3 class="mb-0 mt-0">Location</h3>
                        @foreach ($contacts as $contact)
                           <p class="mb-0">{{ $contact->location }}</p>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        <div class="spacer" data-height="50"></div>

        <!-- section header -->
        <div class="section-header">
            <h3 class="section-title">Send Message</h3>
            <img src="{{ asset('frontend/assets') }}/images/wave.svg" class="wave" alt="wave"/>
        </div>

        <!-- Contact Form -->
        <form id="contact-form" action="{{ route('guest.message') }}" class="contact-form" method="post">
            @csrf
            <div class="messages"></div>

            <div class="row">
                <div class="column col-md-6">
                    <!-- Name input -->
                    <div class="form-group">
                        <input type="text" class="form-control"  id="InputName" placeholder="Your name"
                            required="required" data-error="Name is required." name="name">
                            @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="column col-md-6">
                    <!-- Email input -->
                    <div class="form-group">
                        <input type="email" class="form-control" id="InputEmail"
                            placeholder="Email address" required="required" data-error="Email is required." name="email">
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="column col-md-12">
                    <!-- Email input -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="InputSubject"
                            placeholder="Subject" required="required" data-error="Subject is required." name="subject">
                            @error('subject')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="column col-md-12">
                    <!-- Message textarea -->
                    <div class="form-group">
                        <textarea id="InputMessage" class="form-control" name="message" rows="4"
                            placeholder="Your message here..." required="required"
                            data-error="Message is required."></textarea>
                            @error('message')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <div class="column col-md-12 d-flex justify-content-end">
            <button type="submit"  class="btn btn-default">Submit Message</button>
            </div>
        </form>
        <!-- Contact Form end -->
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
    @if (session('message_suc'))
		<script>
			Swal.fire({
				position: "top-end",
				icon: "success",
				title: "{{ session('message_suc') }}",
				showConfirmButton: false,
				timer: 1500
			});
		</script>
	@endif
@endsection
