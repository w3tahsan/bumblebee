@extends('layouts.dashboard')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Post</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Post List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Tags</th>
                            <th>Feat Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($mypost as $sl=>$post)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $post->rel_to_category->category_name }}</td>
                            <td>{{ $post->title }}</td>
                            <td>
                                @php
                                    $after_explode = explode(',', $post->tag_id);
                                @endphp
                                @foreach ($after_explode as $tag_id)
                                    @php
                                         $tags = App\Models\Tag::where('id', $tag_id)->get();
                                    @endphp
                                    @foreach ($tags as $tag)
                                        <span class="badge badge-primary">{{ $tag->tag_name }}</span>
                                    @endforeach
                                @endforeach

                            </td>
                            <td>
                                <img width="100" src="{{ asset('uploads/post') }}/{{ $post->feat_image }}" alt="">
                            </td>
                            <td>
                                <a href="{{ route('post.view', $post->id) }}" class="btn btn-success">View</a>
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('post.delete', $post->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
