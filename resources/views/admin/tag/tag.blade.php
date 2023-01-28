@extends('layouts.dashboard')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tag</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            @can('show_tag')
            <div class="card">
                <div class="card-header">
                    <h3>Tag List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Tag</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($tags as $sl=>$tag)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $tag->tag_name }}</td>
                            <td><a href="" class="btn btn-danger">Delete</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endcan
        </div>
        <div class="col-lg-4">
            @can('add_tag')
            <div class="card">
                <div class="card-header">
                    <h3>Add New Tag</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('tag.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tag Name</label>
                            <input type="text" name="tag_name" class="form-control" id="exampleInputPassword1">
                            @error('tag_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            @endcan
        </div>
    </div>
</div>
@endsection
