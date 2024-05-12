@extends('layouts.admin')
@section('content')
<div class="row">
    @can('admin_info')
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Admin Description</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>SL</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($admin_desp as $sl=>$admin_des)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $admin_des->admin_desp }}</td>
                        <td>
                            <a href="{{ route('admin.desp.edit', $admin_des->id) }}" class="btn rounded-pill btn-success waves-effect waves-light"
                                type="submit">Edit</a>
                            <a href="{{ route('admin.desp.delete', $admin_des->id) }}" class="btn rounded-pill btn-danger waves-effect waves-light"
                                type="submit">delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Admin Information</h2>
            </div>
            <div class="card-body bg-body-tertiary">
                <form action="{{ route('admin.desp.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Admin Description</label>
                        <textarea name="admin_desp" id="" cols="30" rows="4" class="form-control"
                            placeholder="Enter Your Description..."></textarea>
                        @error('admin_desp')
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
<div class="row">
    @can('admin_info')
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
                    @foreach ($admin_icons as $sl=>$admin_icon)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td><button class="btn btn-blue" type="button"><i class="{{ $admin_icon->icon }}"></i></button>
                        </td>
                        <td>{{ $admin_icon->link }}</td>
                        <td>
                            <a href="{{ route('admin.icon.edit', $admin_icon->id) }}" class="btn rounded-pill btn-success waves-effect waves-light"
                                type="submit">Edit</a>
                            <a href="{{ route('admin.icon.delete', $admin_icon->id) }}" class="btn rounded-pill btn-danger waves-effect waves-light"
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
                <form action="{{ route('admin.icon.store') }}" method="POST">
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
                        <button class="btn btn-success rounded-pill">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection
@section('footer_content')
<script>
    $('.socile_btn').click(function () {
        var icon = $(this).attr('data-icon');
        $('#icon').attr('value', icon);
    })

</script>

@if (session('admin_desp_suc'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('admin_desp_suc') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@if (session('admin_icon_suc'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('admin_icon_suc') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@if (session('admin_desp_del'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('admin_desp_del') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@if (session('admin_icon_del'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('admin_icon_del') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@endsection
