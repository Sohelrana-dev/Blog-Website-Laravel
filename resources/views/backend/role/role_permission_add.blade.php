@extends('layouts.admin')
@section('content')
<div class="row">
    @can('show_role_manage')        
    <div class="col-lg-9">
        <div class="row">
            <div class="card">
                <div class="card-body bg-blue">
                    <h2 class="text-white">Role List</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($roles as $sl=>$role)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>
                                <span class="badge bg-primary" style="font-size: 25px;">{{ $role->name }}</span>
                            </td>
                            <td>
                                @foreach ($role->getAllPermissions() as $permission)
                                   <span style="font-size: 15px;" class=" mt-2 badge bg-success"> {{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-info rounded-pill">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body bg-blue">
                    <h2 class="text-white">User Role List</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>SL</th>
                            <th>User Name</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($user_with_role as $sl=>$user)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td style="width: 110px;">{{ $user->name }}</td>
                            <td>
                                @foreach ($user->getRoleNames() as $role)
                                  <span class="badge bg-primary" style="font-size: 20px;">{{ $role }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($user->getAllPermissions() as $permission)
                                   <span style="font-size: 15px;" class=" mt-2 badge bg-success"> {{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td style="width: 180px;">
                                <a href="{{ route('add.indivitual.permission', $user->id) }}" class="btn btn-info rounded-pill">Edit</a>
                                <a href="{{ route('remove.permission', $user->id) }}" class="btn btn-danger rounded-pill">Remove</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $user_with_role->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Add Permission</h2>
            </div>
            <div class="card-body bg-body-tertiary">
                <form action="{{ route('add.permission') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Permission Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Permission Name">
                        @error('name')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success rounded-pill waves-effect waves-light" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Add Role</h2>
            </div>
            <div class="card-body bg-body-tertiary">
                <form action="{{ route('add.role') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Role Name</label>
                        <input type="text" class="form-control" name="role_name" placeholder="Enter role Name">
                        @error('role_name')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <label class="form-label">Permission Name</label>
                    @foreach ($permissions as $permission)
                    <div class="form-check">
                        <input class="form-check-input" name="permissions[]" type="checkbox" value="{{ $permission->name }}" id="{{ $permission->id }}">
                        <label class="form-check-label" for="{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                        @error('permissions')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    @endforeach
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success rounded-pill waves-effect waves-light" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Assign Role</h2>
            </div>
            <div class="card-body bg-body-tertiary">
                <form action="{{ route('assign.role') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">User </label>
                        <select name="user_id" class="form-select user_select">
                            <option value=""> -- Select User --</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Role</label>
                        <select name="role_name" class="form-select">
                            <option value=""> -- Select Role --</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-success rounded-pill waves-effect waves-light" type="submit">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection

@section('footer_content')
@if (session('permission_suc'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('permission_suc') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@if (session('remove_role'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('remove_role') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@if (session('role_suc'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('role_suc') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@if (session('assign_role'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('assign_role') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif

<script>
    $(document).ready(function() {
        $('.user_select').select2();
    });
</script>
@endsection
