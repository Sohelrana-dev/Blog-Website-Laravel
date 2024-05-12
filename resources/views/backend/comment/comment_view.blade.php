@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header bg-blue">
                    <h2 class="text-white">Comment</h2>
                </div>
                <div class="card-body">
                    <tr>
                        <th>
                            <span style="font-size: 25px;">Name:</span>
                        </th>
                        <td>
                            <span style="font-size: 25px;">{{ $comment->rel_to_guest->name }}</span>
                        </td>
                    </tr>
                    <br>
                    <tr>
                        <th>
                            <span style="font-size: 25px;">comment:</span>
                        </th>
                        <td>
                            <span style="font-size: 25px;">{{ $comment->comment }}</span>
                        </td>
                    </tr>
                </div>
            </div>
        </div>
    </div>
@endsection