@extends('layouts.dashboard')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Category</li>
        <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Add Category</h6>
                    <form class="forms-sample" action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Category Name</label>
                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                            <input type="text" name="category_name" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{ $category->category_name }}">
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
                            <div class="mt-2">
                                <img src="{{ asset('uploads/category') }}/{{ $category->cat_image }}" alt="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
             </div>
        </div>
    </div>
</div>
@endsection
