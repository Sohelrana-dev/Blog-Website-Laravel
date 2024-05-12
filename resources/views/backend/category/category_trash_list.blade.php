@extends('layouts.admin')
@section('content')
<div class="row">
    @can('show_category')
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-blue">
                <h2 class="text-white">Trash Category List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    @forelse($trash_category as $sl=>$category)
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <img width="60" src="{{ asset('uploads/category') }}/{{ $category->image }}" alt="">
                        </td>
                        <td>
                            <a href="{{ route('category.trash.restore', $category->id) }}"
                                class="btn btn-success rounded-pill ms-3 waves-effect waves-light"><i class="mdi mdi-restore"></i></a>

                            <a data-link="{{ route('category.trash.delete', $category->id) }}"
                                class="btn btn-danger rounded-pill ms-3 waves-effect waves-light category_trash_del"><i
                                    class="mdi mdi-trash-can"></i></a>
                        </td>
                    </tr>
                    @empty
                    <td class="text-center" colspan="4">No Data Found</td>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection
@section('footer_content')
    <script>
        $('.category_trash_del').click(function(){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    var link = $(this).attr('data-link');
                    window.location.href = link;
                    
                }
            });
        })
    </script>

     @if (session('cat_del_succ'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('cat_del_succ') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
     @if (session('cat_restore_succ'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('cat_restore_succ') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endsection