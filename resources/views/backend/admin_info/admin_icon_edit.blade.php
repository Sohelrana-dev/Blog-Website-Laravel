@extends('layouts.admin')
@section('content')
@can('admin_info')
<div class="col-lg-6 mt-2">
    <div class="card">
        <div class="card-header bg-blue">
            <h2 class="text-white">Admin Social Media</h2>
        </div>
        <div class="card-body bg-body-tertiary">
            <div>
                <label for="" class="form-label">Icon List</label>
            </div>
            @php
            $fonts = array(
            'fab fa-twitter',
            'fab fa-facebook-f',
            'fab fa-linkedin',
            'fab fa-instagram',
            'fab fa-github-square',
            'fab fa-github-alt',
            'fab fa-github',
            'fab fa-pinterest-square',
            'fab fa-pinterest-p',
            'fab fa-youtube',
            'fab fa-youtube-square',
            'fab fa-linkedin-in',
            'fab fa-linkedin',
            );
            @endphp
            @foreach ($fonts as $font)
            <button class="btn btn-primary socile_btn mt-2 mb-2" data-icon="{{ $font }}"><i
                    class="{{ $font }}"></i></button>
            @endforeach
            <form action="{{ route('admin.icon.update', $admin_icon->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Admin Social Icon</label>
                    <input type="text" class="form-control" name="icon" id="icon" placeholder="fab fa-facebook-f"
                        value="{{ $admin_icon->icon }}">
                    @error('icon')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Social Link</label>
                    <input type="url" class="form-control" name="link" placeholder="Social Media Link"
                        value="{{ $admin_icon->link }}">
                    @error('link')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 d-flex justify-content-end">
                    <button class="btn btn-success rounded-pill waves-effect waves-light">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection
@section('footer_content')
@if (session('admin_icons_update'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('admin_icons_update') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
<script>
    $('.socile_btn').click(function () {
        var icon = $(this).attr('data-icon');
        $('#icon').attr('value', icon);
    })

</script>
@endsection