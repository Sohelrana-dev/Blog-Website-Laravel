@extends('layouts.admin')
@section('content')
<div class="row">
    @can('show_author_info')
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Your Description</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>SL</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($auth_desps as $sl=>$auth_desp)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $auth_desp->auth_desp }}</td>
                        <td style="width: 200px">
                            <a href="{{ route('desp.edit', $auth_desp->id) }}" class="btn btn-success rounded-pill waves-effect waves-light"
                                type="submit">Edit</a>
                            <a href="{{ route('desp.delete', $auth_desp->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light"
                                type="submit">delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        @php
        $userAuthDesp = $auth_desps->where('author_id', auth()->id())->first();
        @endphp
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Add Your Information</h2>
            </div>
            <div class="card-body bg-body-tertiary">
                @if ($userAuthDesp)
                <div class="text-center">
                    <h4 style="color: green">You Add a Description</h4>
                </div>
                @else
                <form action="{{ route('auth.desp.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Author Information</label>
                        <textarea name="auth_desp" id="" cols="30" rows="4" class="form-control"
                            placeholder="Enter Your Description..."></textarea>
                        @error('auth_desp')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success rounded-pill waves-effect waves-light">Add</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endcan
</div>
<div class="row">
    @can('show_author_info')
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Icon List</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Sl</th>
                        <th>Icon</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($auth_icons as $sl=>$auth_icon)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td><button class="btn btn-blue" type="button"><i class="{{ $auth_icon->icon }}"></i></button></td>
                        <td>{{ $auth_icon->link }}</td>
                        <td>
                            <a href="{{ route('icon.edit', $auth_icon->id) }}" class="btn btn-success rounded-pill waves-effect waves-light"
                                type="submit">Edit</a>
                            <a href="{{ route('icon.delete', $auth_icon->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light"
                                type="submit">delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mt-2">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Author Social Media</h2>
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
                <form action="{{ route('auth.icon.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Author Social Icon</label>
                        <input type="text" class="form-control" name="icon" id="icon" placeholder="fab fa-facebook-f">
                        @error('icon')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Social Link</label>
                        <input type="url" class="form-control" name="link" placeholder="Social Media Link">
                        @error('link')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success rounded-pill waves-effect waves-light">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection
@section('footer_content')
@if (session('desp_suc'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('desp_suc') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@if (session('icon_del'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('icon_del') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@if (session('desp_del'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('desp_del') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@if (session('icon_suc'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('icon_suc') }}",
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
