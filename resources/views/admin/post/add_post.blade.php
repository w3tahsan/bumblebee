@extends('layouts.dashboard')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Post</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Add New Post</h3>
        </div>
        <div class="card-body">
           <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <select name="category_id" class="form-control">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Post Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="">Post Short Description</label>
                        <input type="text" class="form-control" name="short_desp">
                    </div>
                    <div class="mb-3">
                        <label for="">Post Description</label>
                        <textarea name="desp" class="form-control" cols="30" id="summernote" rows="20"></textarea>
                    </div>
                    <div class="mb-3">
                        <h4>Select Tags</h4>
                        <div class="form-group d-flex flex-wrap">
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="tag_id[]" class="form-check-input" value="{{ $tag->id }}">
                                        {{ $tag->tag_name }}
                                    <i class="input-frame"></i></label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Featured Image</label>
                        <input type="file" class="form-control" name="feat_image">
                    </div>

                </div>
                <div class="col-lg-4 m-auto">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary form-control">Add Post</button>
                    </div>
                </div>
            </div>
           </form>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
@endsection
