@extends('layouts.dashboard')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Category</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        @can('show_category')
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Category List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($categories as $sl=>$category)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                @if ($category->cat_image == null)
                                <img src="{{ Avatar::create($category->category_name)->toBase64() }}" />
                                @else
                                    <img src="{{ asset('/uploads/category') }}/{{ $category->cat_image }}" alt="">
                                @endif
                            </td>
                            <td>
                                <div class="dropdown mb-2">
                                    <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @can('category_update')
                                      <a class="dropdown-item d-flex align-items-center" href="{{ route('category.edit', $category->id) }}"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                                    @endcan
                                      <a class="dropdown-item d-flex align-items-center del" data-link="{{ route('category.del', $category->id) }}" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>

                                    </div>
                                  </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        @else
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>There are 700 million people in this world! only few people can access this page! <br>    unfortunately you are not one of them
                            <br>
                            <img width="40" src="https://i.postimg.cc/638jyLHt/5a24123c6003f508dd5d5b39-3.png" alt=""></h3>
                    </div>
                </div>
            </div>
        @endcan
        @can('add_category')
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Add Category</h6>
                    <form class="forms-sample" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Category Name</label>
                            <input type="text" name="category_name" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{ old('category_name') }}">
                            @error('category_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Category Image</label>
                            <input type="file" name="cat_image" class="form-control" id="exampleInputPassword1" autocomplete="off">
                            @error('cat_image')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
             </div>
        </div>
        @endcan
    </div>
</div>
@endsection

@section('footer_script')
<script>
    $('.del').click(function(){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            var link = $(this).attr('data-link');
            window.location.href = link;
        }
        })
    })
</script>

@if (session('success'))
    <script>
        Swal.fire(
            'Deleted!',
            '{{ session('success') }}',
            'success'
            )
    </script>
@endif
@endsection
