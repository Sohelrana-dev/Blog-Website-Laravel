@extends('layouts.admin')
@section('content')
@can('visitor_message')
<div class="col-lg-10">
    <div class="card">
        <div class="card-header bg-blue">
            <h2 class="text-white">Visitor Message</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>

                @foreach ($messages as $sl=>$message)
                <tr>
                    <td>{{ $sl+1 }}</td>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>{{ $message->message }}</td>
                    <td>
                        <a href="{{ route('visitor.message.delete', $message->id) }}"
                            class="btn btn-danger rounded-pill waves-effect waves-light">Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endcan
@endsection
@section('footer_content')
@if (session('visitor_mes_del'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('visitor_mes_del') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@endsection
