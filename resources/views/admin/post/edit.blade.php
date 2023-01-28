@extends('layouts.dashboard')
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Post Edit</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Edit Post</h3>
        </div>
        <div class="card-body">
           <form action="{{ route('post.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <input type="hidden" name="post_id" value="{{ $post_info->id }}">
                    <div class="mb-3">
                        <select name="category_id" class="form-control">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option {{ ($post_info->category_id == $category->id?'selected':'' ) }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Post Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $post_info->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="">Post Short Desp</label>
                        <input type="text" class="form-control" name="short_desp" value="{{ $post_info->short_desp }}">
                    </div>
                    <div class="mb-3">
                        <label for="">Post Description</label>
                        <textarea name="desp" class="form-control" cols="30" id="summernote" rows="20">
                            {!! $post_info->desp !!}
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <h4>Select Tags</h4>
                        <div class="form-group d-flex flex-wrap">
                            @php
                                $explode = explode(',', $post_info->tag_id);
                            @endphp

                            @foreach ($tags_main as $tag_main)
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox"
                                            @foreach ($explode as $tag_id)
                                                {{ $tag_id==$tag_main->id?'checked':''}}
                                            @endforeach
                                         name="tag_id[]" class="form-check-input" value="{{ $tag_main->id }}">
                                        {{ $tag_main->tag_name }}
                                    <i class="input-frame"></i></label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Featured Image</label>
                        <input type="file" class="form-control" name="feat_image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-2">
                            <img id="blah" width="200" src="{{ asset('uploads/post') }}/{{ $post_info->feat_image }}" alt="">
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 m-auto">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary form-control">Update Post</button>
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
