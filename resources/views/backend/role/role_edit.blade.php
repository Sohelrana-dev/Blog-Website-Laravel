@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Role Edit</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('update.role', $role->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <span style="font-size: 20px;" class="text-primary">Role Name: <strong class="badge bg-blue"
                                style="font-size: 20px;">
                                {{ $role->name }}
                            </strong></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 25px;">Permission Name</label>
                        @foreach ($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input" {{($role->hasPermissionTo($permission->name))?"checked":''}}
                                name="permissions[]" type="checkbox" value="{{ $permission->name }}"
                                id="{{ $permission->id }}">
                            <label class="form-check-label" for="{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                            @error('permissions')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        @endforeach
                        <div class="mb-3 d-flex justify-content-end">
                            <button class="btn btn-success rounded-pill waves-effect waves-light"
                                type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_content')
    @if (session('role_update'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('role_update') }}",
            showConfirmButton: false,
            timer: 1500
        });

    </script>
    @endif
@endsection