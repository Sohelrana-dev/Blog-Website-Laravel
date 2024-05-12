@extends('layouts.admin')
@section('content')
<div class="row">
    @can('show_subscriber_list')
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white text-center">Subscriber List</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>SL</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($subscribers as $sl=>$subscriber)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $subscriber->email }}</td>
                        <td>
                            <a href="{{ route('subscriber.delete', $subscriber->id) }}"
                                class="btn btn-danger rounded-pill ms-3 waves-effect waves-light category_del mx-3"><i
                                    class="mdi mdi-trash-can"></i></a>
                            <a href="" class="btn btn-success rounded-pill waves-effect waves-light "><i
                                    class="mdi mdi-email-send"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection
@section('footer_content')
@if (session('email_del'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('email_del') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@endsection
