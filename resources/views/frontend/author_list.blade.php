@extends('frontend.master')

@section('content')
<!--section-heading-->
<div class="section-heading " >
    <div class="container-fluid">
        <div class="section-heading-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading-2-title ">
                        <h1>All Authors</h1>
                        <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> pages</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--blog-layout-1-->
<div class="authors ">
    <div class="container-fluid">
        <div class="authors-area">
            <div class="row">
                <!--author-1-->
                @foreach ($authorlists as $author)
                <div class="col-md-6 ">
                    <div class="authors-single">
                        <div class="authors-single-image">
                            <a href="author.html">
                                @if ($author->rel_to_user->image == null)
                                <img src="{{ Avatar::create($author->rel_to_user->name)->toBase64() }}" />
                                @else
                                <img src="{{ asset('uploads/user') }}/{{ $author->rel_to_user->image }}" alt="">
                                @endif

                            </a>
                        </div>
                        <div class="authors-single-content ">
                            <div class="left">
                                <h6> <a href="author.html">{{ $author->rel_to_user->name }}</a></h6>
                                <p>{{ App\Models\Post::where('author_id', $author->author_id)->count() }} articles</p>
                            </div>
                            <div class="right">
                                <div class="more-icon">
                                    <i class="las la-angle-double-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
