@extends('layouts.frontend.app')

@section('title')
{{ $posts->title }}
@endsection

@push('css')
<link href="{{ asset('assets/frontend/css/single_post/styles.css') }}" rel="stylesheet">

<link href="{{ asset('assets/frontend/css/single_post/responsive.css') }}" rel="stylesheet">

<style>
    .header-bg{
            height: 400px;
            width: 100%;
            background-image: url('{{ url('storage/post/'.$posts->image) }}');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
    }

    .favorite_posts{
        color: blue;
    }
    
    
</style>
@endpush

@section('content')
<div class="header-bg">
</div><!-- slider -->

<section class="post-area section">
    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-12 no-right-padding">

                <div class="main-post">

                    <div class="blog-post-inner">

                        <div class="post-info">

                            <div class="left-area">
                                <a class="avatar" href="{{ route('author.profile',$posts->user->username) }}"><img src="{{ url('/storage/profile/'.$posts->user->image) }}" alt="Profile Image"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="#"><b>{{ $posts->user->name }}</b></a>
                                <h6 class="date">{{ $posts->created_at->diffForHumans() }}</h6>
                            </div>

                        </div><!-- post-info -->

                        <h3 class="title"><a href="#"><b>{{ $posts->title }}</b></a></h3>

                        {{-- <div class="post-image"><img src="{{ url('/storage/post/'.$posts->image) }}" alt="Blog Image"></div> --}}

                        <p class="para">{!! $posts->body !!}</p>

                        <ul class="tags">
                            @foreach ($posts->tags as $tag)
                            <li><a href="{{ route('tag.posts',$tag->slug) }}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- blog-post-inner -->

                    <div class="post-icons-area">
                        <ul class="post-icons">
                            <li>
                                @guest
                                <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                    closeButton: true,
                                    progressBar: true,
                                })"><i class="ion-heart"></i>{{ $posts->favorite_to_user->count() }}</a>
                                    @else
                                    <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $posts->id }}').submit();"
                                        class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$posts->id)->count()  == 0 ? 'favorite_posts' : ''}}"><i class="ion-heart"></i>{{ $posts->favorite_to_user->count() }}</a>

                                     <form id="favorite-form-{{ $posts->id }}" method="POST" action="{{ route('post.favorite',$posts->id) }}" style="display: none;">
                                         @csrf
                                     </form>
                                @endguest
                                
                            </li>
                            <li><a href="#"><i class="ion-chatbubble"></i>{{ $posts->comments->count() }}</a></li>
                            <li><a href="#"><i class="ion-eye"></i>{{ $posts->view_count }}</a></li>
                        </ul>

                        <ul class="icons">
                            <li>SHARE : </li>
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                        </ul>
                    </div>


                </div><!-- main-post -->
            </div><!-- col-lg-8 col-md-12 -->

            <div class="col-lg-4 col-md-12 no-left-padding">

                <div class="single-post info-area">

                    <div class="sidebar-area about-area">
                        <h4 class="title"><b>ABOUT AUTHOR</b></h4>
                        <p>{{ $posts->user->about }}</p>
                    </div>

                    <div class="tag-area">

                        <h4 class="title"><b>CATEGORIES</b></h4>
                        <ul>
                            @foreach ($posts->categories as $category)
                            <li><a href="{{ route('category.posts',$category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                            
                        </ul>

                    </div><!-- subscribe-area -->

                </div><!-- info-area -->

            </div><!-- col-lg-4 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section><!-- post-area -->


<section class="recomended-area section">
    <div class="container">
        <div class="row">

            @foreach ($randomPosts as $randomPost)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="{{ url('/storage/post/'.$randomPost->image) }}" alt="Blog Image"></div>

                        <a class="avatar" href="{{ route('author.profile',$randomPost->user->username) }}"><img src="{{ url('/storage/profile/'.$randomPost->user->image) }}" alt="Profile Image"></a>

                        <div class="blog-info">

                            <h4 class="title"><a href="{{ route('post.details',$randomPost->slug) }}"><b>{{ $randomPost->title }}</b></a></h4>

                            <ul class="post-footer">
                                <li>
                                    @guest
                                    <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                        closeButton: true,
                                        progressBar: true,
                                    })"><i class="ion-heart"></i>{{ $randomPost->favorite_to_user->count() }}</a>
                                        @else
                                        <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $randomPost->id }}').submit();"
                                            class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$randomPost->id)->count()  == 0 ? 'favorite_posts' : ''}}"><i class="ion-heart"></i>{{ $randomPost->favorite_to_user->count() }}</a>
    
                                         <form id="favorite-form-{{ $randomPost->id }}" method="POST" action="{{ route('post.favorite',$randomPost->id) }}" style="display: none;">
                                             @csrf
                                         </form>
                                    @endguest
                                    
                                </li>
                                <li><a href="#"><i class="ion-chatbubble"></i>{{ $randomPost->comments->count() }}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{ $randomPost->view_count }}</a></li>
                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-md-6 col-sm-12 -->
            @endforeach

        </div><!-- row -->

    </div><!-- container -->
</section>

<section class="comment-section">
    <div class="container">
        <h4><b>POST COMMENT</b></h4>
        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div class="comment-form">
                    @guest
                            <p>For post a new comment. You need to login first. <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a></p>
                        @else
                            <form method="post" action="{{ route('comment.store',$posts->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <textarea name="comment" rows="2" class="text-area-messge form-control"
                                                  placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                                    </div><!-- col-sm-12 -->
                                    <div class="col-sm-12">
                                        <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                    </div><!-- col-sm-12 -->

                                </div><!-- row -->
                            </form>
                        @endguest
                </div><!-- comment-form -->

                <h4><b>COMMENTS({{ $posts->comments()->count() }})</b></h4>
                @if ($posts->comments->count() > 0)
                    
                    @foreach ($posts->comments as $comment)
                        <div class="commnets-area ">

                            <div class="comment">

                                <div class="post-info">

                                    <div class="left-area">
                                        <a class="avatar" href="#"><img src="{{ url('/storage/profile/'.$comment->user->image) }}" alt="Profile Image"></a>
                                    </div>

                                    <div class="middle-area">
                                        <a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
                                        <h6 class="date">{{ $comment->created_at->diffForHumans() }}</h6>
                                    </div>
                                </div><!-- post-info -->

                                <p>{{ $comment->comment }}</p>

                            </div>

                        </div><!-- commnets-area -->
                    @endforeach

                @else
                    <div class="commnets-area">

                        <span>No Comments Found</span>
                    </div>
                @endif

            </div><!-- col-lg-8 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section>

@endsection

@push('js')

@endpush