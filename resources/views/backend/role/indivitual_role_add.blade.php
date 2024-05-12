@extends('layouts.admin')
@section('content')
<div class="row">
    @can('show_role_manage')
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Add Indivitual Permission</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('update.indivitual.permission', $user->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <span style="font-size: 20px;" class="text-primary">User Name: <strong class="badge bg-blue"
                                style="font-size: 20px;">{{ $user->name }}</strong></span> <br><br>
                        <span style="font-size: 20px;" class="text-primary">Role Name: <strong class="badge bg-blue"
                                style="font-size: 20px;">
                                @foreach ($user->getRoleNames() as $role)
                                 {{ $role }}
                                @endforeach
                            </strong></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 25px;">Permission Name</label>
                        @foreach ($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input" {{($user->hasPermissionTo($permission->name))?"checked":''}}
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
    @endcan
</div>
@endsection
@section('footer_content')
    @if (session('indivitual_role_add'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('indivitual_role_add') }}",
            showConfirmButton: false,
            timer: 1500
        });

    </script>
    @endif
@endsection