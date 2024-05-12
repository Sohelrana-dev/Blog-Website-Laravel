@extends('layouts.admin')
@section('content')
<div class="row">
    @can('show_user_list')
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">User List</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 table-hover table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $sl=>$user)
                            <tr>
                                <td>{{ $sl+1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{-- <img width="50" src="{{ asset('uploads/user') }}/{{ $user->profile_photo }}" alt=""> --}}
                                    @if ($user->profile_photo == NULL)
                                    <img width="50" class="author"
                                        src="{{ Avatar::create($user->name)->toBase64() }}" alt="author"/>
                                    @else
                                    <img width="50" class="author"
                                        src="{{ asset('uploads/user') }}/{{ $user->profile_photo }}" alt="author" />
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light"><i class="mdi mdi-trash-can"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div>
    @endcan
</div>
@endsection
@section('footer_content')
    @if (session('user_delete'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('user_delete') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endsection
