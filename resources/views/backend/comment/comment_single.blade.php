@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-blue">
                    <h2 class="text-white">Comment List</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Sl</th>
                            <th>User Name</th>
                            <th>User Photo</th>
                            <th>Comment</th>
                            <th>Acton</th>
                        </tr>

                        @foreach ($comments as $sl=>$comment)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $comment->rel_to_guest->name }}</td>
                            <td>
                                @if ($comment->rel_to_guest->photo == NULL)
                                <img class="inner_img_dash"
                                    src="{{ Avatar::create($comment->rel_to_guest->name)->toBase64() }}" />
                                @else
                                <img class="inner_img_dash"
                                    src="{{ asset('uploads/user') }}/{{ $comment->rel_to_guest->photo}}" alt="" />
                                @endif
                            </td>
                            <td>{{ $comment->comment }}</td>
                            <td>
                                <a href="{{ route('comment.delete', $comment->id) }}" class="btn btn-danger rounded-pill">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_content')
@if (session('comment_del'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('comment_del') }}",
        showConfirmButton: false,
        timer: 1500
    });

</script>
@endif
@endsection