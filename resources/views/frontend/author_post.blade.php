@extends('frontend.master')
@section('content')
 <!--author-->
 <section class="authors">
    <div class="container-fluid">
        <div class="row">
            <!--author-image-->
            <div class="col-lg-12 col-md-12 ">
                    <div class="authors-info">
                    <div class="image">
                        <a href="author.html" class="image">
                            @if ($author_info->image == null)
                            <img src="{{ Avatar::create($author_info->name)->toBase64() }}" />
                            @else
                            <img src="{{ asset('uploads/user') }}/{{ $author_info->image }}" alt="">
                            @endif
                        </a>
                    </div>
                    <div class="content">
                        <h4 >{{ $author_info->name }}</h4>
                        <p>
                             Etiam vitae dapibus rhoncus. Eget etiam aenean nisi montes felis pretium donec veni. Pede vidi condimentum et aenean hendrerit.
                            Quis sem justo nisi varius.
                        </p>
                        <div class="social-media">
                            <ul class="list-inline">
                                <li>
                                    <a href="#">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" >
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" >
                                        <i class="fab fa-pinterest"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/-->
            </div>
        </div>
    </div>
</section>

<!-- blog-author-->
<section class="blog-author mt-30">
    <div class="container-fluid">
        <div class="row">
            <!--content-->
            <div class="col-lg-8 oredoo-content">
                <div class="theiaStickySidebar">
                    <!--post1-->
                    @foreach ($author_posts as $auth_post)
                    <div class="post-list post-list-style4 pt-0">
                        <div class="post-list-image">
                            <a href="post-single.html">
                                <img src="{{ asset('uploads/post') }}/{{ $auth_post->feat_image }}" alt="">
                            </a>
                        </div>
                        <div class="post-list-content">
                            <ul class="entry-meta">
                                <li class="entry-cat">
                                    <a href="{{ route('category.post', $auth_post->category_id) }}" class="category-style-1">{{ $auth_post->rel_to_category->category_name }}</a>
                                </li>
                                <li class="post-date"> <span class="line"></span> {{ $auth_post->created_at->format('M-d-Y')}}</li>
                            </ul>
                            <h5 class="entry-title">
                                <a href="post-single.html">{{ $auth_post->title }}</a>
                            </h5>
                            <div class="post-btn">
                                <a href="post-single.html" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!--/-->

                    <!--pagination-->
                    <div class="pagination">
                        <div class="pagination-area text-left">
                            <div class="pagination-list">
                                <ul class="list-inline">
                                    <li><a href="#" ><i class="las la-arrow-left"></i></a></li>
                                    <li><a href="#" class="active">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#" ><i class="las la-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/-->

            <!--Sidebar-->
            <div class="col-lg-4 oredoo-sidebar">
                <div class="theiaStickySidebar">
                    <div class="sidebar">
                        <!--search-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>Search</h5>
                            </div>
                            <div class=" widget-search">
                                <form action="https://oredoo.assiagroupe.net/Oredoo/search.html">
                                    <input type="search" id="gsearch" name="gsearch" placeholder="Search ....">
                                    <a href="search.html" class="btn-submit"><i class="las la-search"></i></a>
                                </form>
                            </div>
                         </div>

                        <!--categories-->
                        <div class="widget ">
                            <div class="widget-title">
                                <h5>Categories</h5>
                            </div>
                            <div class="widget-categories">
                                @foreach ($categories_info as $cat)
                                <a class="category-item" href="#">
                                    <div class="image">
                                        <img src="{{ asset('uploads/category') }}/{{ $cat->rel_to_category->cat_image }}" alt="">
                                    </div>
                                    <p>{{ $cat->rel_to_category->category_name }}</p>
                                </a>
                                @endforeach
                            </div>
                        </div>

                         <!--newslatter-->
                         <div class="widget widget-newsletter">
                            <h5>Subscribe To OurNewsletter</h5>
                            <p>No spam, notifications only about new products, updates.</p>
                            <form action="#" class="newslettre-form">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email Adress" required="required">
                                    </div>
                                    <button class="btn-custom" type="submit"> Subscribe now</button>
                                </div>
                            </form>
                         </div>

                         <!--stay connected-->
                         <div class="widget ">
                            <div class="widget-title">
                                <h5>Stay connected</h5>
                            </div>

                            <div class="widget-stay-connected">
                                <div class="list">
                                    <div class="item color-facebook">
                                        <a href="#"><i class="fab fa-facebook"></i></a>
                                        <p>Facebook</p>
                                    </div>

                                    <div class="item color-instagram">
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <p>instagram</p>
                                    </div>

                                    <div class="item color-twitter">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <p>twitter</p>
                                    </div>

                                    <div class="item color-youtube">
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                        <p>Youtube</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                         <!--Tags-->
                         <div class="widget">
                             <div class="widget-title">
                                 <h5>Tags</h5>
                             </div>
                             <div class="tags">
                                <ul class="list-inline">
                                    @foreach ($tags as $tag)
                                    <li>
                                        <a href="#">{{ $tag->tag_name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                             </div>
                         </div>

                         <!--popular-posts-->
                         <div class="widget">
                             <div class="widget-title">
                                 <h5>popular Posts</h5>
                             </div>

                             <ul class="widget-popular-posts">
                                <!--post1-->
                                <li class="small-post">
                                    <div class="small-post-image">
                                         <a href="post-single.html">
                                             <img src="assets/img/blog/1.jpg" alt="">
                                             <small class="nb">1</small>
                                         </a>
                                    </div>
                                    <div class="small-post-content">
                                         <p>
                                             <a href="post-single.html">Everything is designed. Few things are designed well.</a>
                                         </p>
                                         <small> <span class="slash"></span>3 mounth ago</small>
                                    </div>
                                 </li>

                                 <!--post2-->
                                 <li class="small-post">
                                     <div class="small-post-image">
                                         <a href="post-single.html">
                                             <img src="assets/img/blog/5.jpg" alt="">
                                             <small class="nb">2</small>
                                         </a>
                                     </div>
                                     <div class="small-post-content">
                                         <p>
                                             <a href="post-single.html">Brand yourself for the career you want, not the job you </a>
                                         </p>
                                         <small> <span class="slash"></span>3 mounth ago</small>
                                     </div>
                                 </li>

                                 <!--post3-->
                                 <li class="small-post">
                                     <div class="small-post-image">
                                         <a href="post-single.html">
                                             <img src="assets/img/blog/13.jpg" alt="">
                                             <small class="nb">3</small>
                                         </a>
                                     </div>
                                     <div class="small-post-content">
                                         <p>
                                             <a href="post-single.html">It’s easier to ask forgiveness than it is to get permission.</a>
                                         </p>
                                         <small> <span class="slash"></span>3 mounth ago</small>

                                     </div>
                                 </li>
                                 <!--post4-->
                                 <li class="small-post">
                                     <div class="small-post-image">
                                        <a href="post-single.html">
                                            <img src="assets/img/blog/16.jpg" alt="">
                                            <small class="nb">4</small>
                                        </a>
                                     </div>
                                     <div class="small-post-content">
                                         <p>
                                             <a href="post-single.html">All happiness depends on a leisurely breakfast</a>
                                         </p>
                                         <small> <span class="slash"></span>3 mounth ago</small>
                                     </div>
                                 </li>
                                 <!--/-->
                             </ul>
                         </div>

                         <!--/-->
                     </div>
                </div>
            </div>
            <!--/-->
        </div>
    </div>
</section>
@endsection
