@extends('frontend.layouts.master')
@section('title', $newsDetails->title)
{{-- Meta tag --}}
@section('meta_description', $newsDetails->meta_description)
@section('meta_og_title', $newsDetails->meta_title)
@section('meta_og_description', $newsDetails->meta_description)
@section('meta_og_image', asset($newsDetails->image))
@section('meta_tw_title', $newsDetails->meta_title)
@section('meta_tw_description', $newsDetails->meta_description)
@section('meta_tw_image', asset($newsDetails->image))
{{-- End Meta Tags --}}


@section('contain')
    <section class="pb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- breaddcrumb -->
                    <!-- Breadcrumb -->
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="{{ url('/') }}" class="breadcrumbs__url">
                                <i class="fa fa-home"></i> {{ __('Home') }}</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="javascript:;" class="breadcrumbs__url">{{ __('News') }}</a>
                        </li>

                    </ul>
                    <!-- end breadcrumb -->
                </div>
                <div class="col-md-8">
                    <!-- content article detail -->
                    <!-- Article Detail -->
                    <div class="wrap__article-detail">
                        <div class="wrap__article-detail-title">
                            <h1>
                                {!! $newsDetails->title !!}
                            </h1>

                        </div>
                        <hr>
                        <div class="wrap__article-detail-info">
                            <ul class="list-inline d-flex flex-wrap justify-content-start">
                                <li class="list-inline-item">
                                    {{ __('By') }}
                                    <a href="#">
                                        {{ $newsDetails->auther->name }},
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <span class="text-dark text-capitalize ml-1">
                                        {{ date('M D, Y', strtotime($newsDetails->created_at)) }}
                                    </span>
                                </li>
                                <li class="list-inline-item">
                                    <span class="text-dark text-capitalize">
                                        {{ __('in') }}
                                    </span>
                                    <a href="#">
                                        {{ $newsDetails->category->name }}
                                    </a>


                                </li>
                            </ul>
                        </div>

                        <div class="wrap__article-detail-image mt-4">
                            <figure>
                                <img src="{{ asset($newsDetails->image) }}" alt="" class="img-fluid">
                            </figure>
                        </div>
                        <div class="wrap__article-detail-content">
                            <div class="total-views">
                                <div class="total-views-read">
                                    {{ convertToKFormat($newsDetails->views) }}
                                    <span>
                                        {{ __('views') }}
                                    </span>
                                </div>


                                <ul class="list-inline">
                                    <span class="share">{{ __('share on') }}:</span>
                                    <li class="list-inline-item">
                                        <a class="btn btn-social-o facebook"
                                            href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                            target="_blank">
                                            <i class="fa fa-facebook-f"></i>
                                            <span>{{ __('facebook') }}</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-social-o twitter"
                                            href="https://twitter.com/intent/tweet?text={{ $newsDetails->title }}&url={{ url()->current() }}"
                                            target="_blank">
                                            <i class="fa fa-twitter"></i>
                                            <span>{{ __('twitter') }}</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-social-o whatsapp"
                                            href="https://wa.me/?text={{ $newsDetails->title }}%20{{ url()->current() }}"
                                            target="_blank">
                                            <i class="fa fa-whatsapp"></i>
                                            <span>{{ __('whatsapp') }}</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-social-o telegram"
                                            href="https://t.me/share/url?url={{ url()->current() }}&text={{ $newsDetails->title }} "
                                            target="_blank">
                                            <i class="fa fa-telegram"></i>
                                            <span>{{ __('telegram') }}</span>
                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a class="btn btn-linkedin-o linkedin"
                                            href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $newsDetails->title }}"
                                            target="_blank">
                                            <i class="fa fa-linkedin"></i>
                                            <span>{{ __('linkedin') }}</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <p class="has-drop-cap-fluid">
                                {!! $newsDetails->content !!}
                            </p>

                        </div>

                    </div>

                    <div class="blog-tags">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <i class="fa fa-tags">
                                </i>
                            </li>
                            @foreach ($newsDetails->tags as $tag)
                                <li class="list-inline-item">
                                    <a href="#">
                                        #{{ $tag->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- end tags-->

                    <!-- authors-->
                    <!-- Profile author -->
                    <div class="wrap__profile">
                        <div class="wrap__profile-author">
                            <figure>
                                <img style="width:200px;height:200px;object-fit:cover;"
                                    src="{{ asset($newsDetails->auther->image) }}" alt=""
                                    class="img-fluid rounded-circle">
                            </figure>
                            <div class="wrap__profile-author-detail">
                                <div class="wrap__profile-author-detail-name">{{ __('author') }}</div>
                                <h4>{{ $newsDetails->auther->name }}</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis laboriosam ad
                                    beatae itaque ea non
                                    placeat officia ipsum praesentium! Ullam?</p>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-social btn-social-o facebook ">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-social btn-social-o twitter ">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-social btn-social-o instagram ">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-social btn-social-o telegram ">
                                            <i class="fa fa-telegram"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-social btn-social-o linkedin ">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end author-->

                    <!-- Comment  -->


                    @auth
                        <div id="comments" class="comments-area">
                            <h3 class="comments-title">{{ $newsDetails->comments->count() }} {{ __('Comments') }}:</h3>

                            <ol class="comment-list">
                                @foreach ($newsDetails->comments->whereNull('parent_id') as $comment)
                                    <li class="comment">
                                        <aside class="comment-body">
                                            <div class="comment-meta">
                                                <div class="comment-author vcard">
                                                    <img src="{{ asset('frontend/assets/images/defald_img.jpg') }}"
                                                        class="avatar" alt="image">
                                                    <b class="fn">{{ $comment->user->name }}</b>
                                                    <span class="says">{{ __('says') }}:</span>
                                                </div>

                                                <div class="comment-metadata">
                                                    <a href="#">
                                                        <span>{{ date('M, d, Y H:i', strtotime($comment->created_at)) }}</span>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="comment-content">
                                                <p>{!! $comment->comment !!}
                                                </p>
                                            </div>

                                            <div class="reply">
                                                <a href="#" class="comment-reply-link" data-toggle="modal"
                                                    data-target="#exampleModal-{{ $comment->id }}">{{ __('Reply') }}</a>
                                                <span class="delete-msg" data-id="{{ $comment->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                            </div>
                                        </aside>

                                        @if ($comment->replay()->count() > 0)
                                            @foreach ($comment->replay as $replay)
                                                <ol class="children">
                                                    <li class="comment">
                                                        <aside class="comment-body">
                                                            <div class="comment-meta">
                                                                <div class="comment-author vcard">
                                                                    <img src="{{ asset('frontend/assets/images/defald_img.jpg') }}"
                                                                        class="avatar" alt="image">
                                                                    <b class="fn">{{ $replay->user->name }}</b>
                                                                    <span class="says">{{ __('says') }}:</span>
                                                                </div>

                                                                <div class="comment-metadata">
                                                                    <a href="javascript:;">
                                                                        <span>{{ date('M,d, Y H:i', strtotime($replay->created_at)) }}</span>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <div class="comment-content">
                                                                <p>{{ $replay->comment }}</p>
                                                            </div>

                                                            <div class="reply">
                                                                @if ($loop->last)
                                                                    <a href="#" class="comment-reply-link"
                                                                        data-toggle="modal"
                                                                        data-target="#exampleModal-{{ $comment->id }}">{{ __('Reply') }}</a>
                                                                @endif
                                                                <span class="delete-msg" data-id="{{ $replay->id }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </span>
                                                            </div>
                                                        </aside>
                                                    </li>
                                                </ol>
                                            @endforeach
                                        @endif
                                    </li>
                                    <!-- Modal -->
                                    <div class="comment_modal">
                                        <div class="modal fade" id="exampleModal-{{ $comment->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ __('Write Your Comment') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('news-comment-reply') }}">
                                                            @csrf
                                                            <input type="hidden" name="news_id"
                                                                value="{{ $newsDetails->id }}">
                                                            <input type="hidden" name="parent_id"
                                                                value="{{ $comment->id }}">
                                                            <textarea cols="30" rows="7" name="reply" placeholder="Type. . ."></textarea>

                                                            <button type="submit">{{ __('submit') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- end comment -->
                                @endforeach
                            </ol>

                            <div class="comment-respond">
                                <h3 class="comment-reply-title">{{ __('Leave a Reply') }}</h3>

                                <form class="comment-form" action="{{ route('news-comment') }}" method="POST">

                                    @csrf
                                    <p class="comment-notes">

                                    </p>
                                    <input type="hidden" name="news_id" value="{{ $newsDetails->id }}">
                                    <input type="hidden" name="parent_id" value="">
                                    <p class="comment-form-comment">
                                        <label for="comment">{{ __('Comment') }}</label>
                                        <textarea name="comment" id="comment" cols="45" rows="5" maxlength="65525"></textarea>

                                        @error('comment')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </p>

                                    <p class="form-submit mb-0">
                                        <button type="submit" class="submit btn btn-primary">
                                            {{ __('Post Comment') }}
                                        </button>
                                    </p>

                                </form>
                            </div>
                        </div>
                    @else
                        <div class="card my-5">
                            <div class="card-body">
                                <h5 class="p-0">{{ __('Please') }} <a style="text-decoration: none;color:brown"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                    {{ __('to comment in the post !') }}
                                </h5>
                            </div>
                        </div>
                    @endauth



                    <div class="row">
                        <div class="col-md-6">
                            <div class="single_navigation-prev">
                                @if ($previousPost)
                                    <a href="{{ route('news.details', $previousPost->slug) }}">
                                        <span>{{ __('previous post') }}</span>
                                        {!! truncate($previousPost->title, 100) !!}
                                    </a>
                                @else
                                    <span class="text-muted">{{ __('No previous post') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single_navigation-next text-left text-md-right">
                                @if ($nextPost)
                                    <a href="{{ route('news.details', $nextPost->slug) }}">
                                        <span>{{ __('next post') }}</span>
                                        {!! truncate($nextPost->title, 100) !!}
                                    </a>
                                @else
                                    <span class="text-muted">{{ __('No next post') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($ads->view_page_ad_status == 1)
                        <div class="small_add_banner mb-5 pb-4">
                            <div class="small_add_banner_img">
                                <img src="{{ asset($ads->view_page_ad) }}" alt="adds">
                            </div>
                        </div>
                    @endif


                    <div class="clearfix"></div>

                    @if (count($relatedPosts) > 0)
                        <div class="related-article">
                            <h4>
                                {{ __('you may also like') }}
                            </h4>

                            <div class="article__entry-carousel-three">
                                @foreach ($relatedPosts as $post)
                                    <div class="item">
                                        <!-- Post Article -->
                                        <div class="article__entry">
                                            <div class="article__image">
                                                <a href="{{ route('news.details', $post->slug) }}">
                                                    <img src="{{ asset($post->image) }}" alt=""
                                                        class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="article__content">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            {{ __('by') }} {{ $post->auther->name }}
                                                        </span>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <span>
                                                            {{ date('M d, Y', strtotime($post->created_at)) }}
                                                        </span>
                                                    </li>

                                                </ul>
                                                <h5>
                                                    <a href="{{ route('news.details', $post->slug) }}">
                                                        {!! truncate($post->title) !!}
                                                    </a>
                                                </h5>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @endif

                </div>
                <div class="col-md-4">
                    <div class="sticky-top">
                        <aside class="wrapper__list__article ">
                            <!-- <h4 class="border_section">Sidebar</h4> -->
                            <div class="mb-4">
                                <div class="widget__form-search-bar  ">
                                    <div class="row no-gutters">
                                        <div class="col">
                                            <input class="form-control border-secondary border-right-0 rounded-0"
                                                value="" placeholder="Search">
                                        </div>
                                        <div class="col-auto">
                                            <button
                                                class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wrapper__list__article-small">
                                @foreach ($recentNews as $recent)
                                    @if ($loop->index <= 2)
                                        <div class="mb-3">
                                            <!-- Post Article -->
                                            <div class="card__post card__post-list">
                                                <div class="image-sm">
                                                    <a href="{{ route('news.details', $recent->slug) }}l">
                                                        <img src="{{ asset($recent->image) }}" class="img-fluid"
                                                            alt="">
                                                    </a>
                                                </div>


                                                <div class="card__post__body ">
                                                    <div class="card__post__content">

                                                        <div class="card__post__author-info mb-2">
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
                                                                    <span class="text-primary">
                                                                        {{ __('by') }} {{ $recent->auther->name }}
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span class="text-dark text-capitalize">
                                                                        {{ date('M d, Y', strtotime($recent->created_at)) }}
                                                                    </span>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a href="{{ route('news.details', $recent->slug) }}">
                                                                    {!! $recent->title !!}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($loop->index === 3)
                                        <div class="article__entry">
                                            <div class="article__image">
                                                <a href="#">
                                                    <img src="{{ asset($recent->image) }}" alt=""
                                                        class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="article__content">
                                                <div class="article__category">
                                                    {{ $recent->category->name }}
                                                </div>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            {{ __('by') }} {{ $recent->auther->name }}
                                                        </span>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <span class="text-dark text-capitalize">
                                                            {{ date('M d, Y', strtotime($recent->created_at)) }}
                                                        </span>
                                                    </li>

                                                </ul>
                                                <h5>
                                                    <a href="{{ route('news.details', $recent->slug) }}">
                                                        {!! truncate($recent->title) !!}

                                                    </a>
                                                </h5>
                                                <p>
                                                    {!! truncate($recent->content, 160) !!}

                                                </p>
                                                <a href="#" class="btn btn-outline-primary mb-4 text-capitalize">
                                                    {{ __('read more') }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach


                                <!-- Post Article -->

                            </div>
                        </aside>

                        <!-- social media -->
                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{ __('stay conected') }}</h4>
                            <!-- widget Social media -->
                            <div class="wrap__social__media">
                                <a href="#" target="_blank">
                                    <div class="social__media__widget facebook">
                                        <span class="social__media__widget-icon">
                                            <i class="fa fa-facebook"></i>
                                        </span>
                                        <span class="social__media__widget-counter">
                                            19,243 fans
                                        </span>
                                        <span class="social__media__widget-name">
                                            like
                                        </span>
                                    </div>
                                </a>
                                <a href="#" target="_blank">
                                    <div class="social__media__widget twitter">
                                        <span class="social__media__widget-icon">
                                            <i class="fa fa-twitter"></i>
                                        </span>
                                        <span class="social__media__widget-counter">
                                            2.076 followers
                                        </span>
                                        <span class="social__media__widget-name">
                                            follow
                                        </span>
                                    </div>
                                </a>
                                <a href="#" target="_blank">
                                    <div class="social__media__widget youtube">
                                        <span class="social__media__widget-icon">
                                            <i class="fa fa-youtube"></i>
                                        </span>
                                        <span class="social__media__widget-counter">
                                            15,200 followers
                                        </span>
                                        <span class="social__media__widget-name">
                                            {{ __('subscribe') }}
                                        </span>
                                    </div>
                                </a>

                            </div>
                        </aside>
                        <!-- End social media -->

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{ __('tags') }}</h4>
                            <div class="blog-tags p-0">
                                <ul class="list-inline">
                                    @foreach ($mostCommonTags as $tag)
                                        <li class="list-inline-item">
                                            <a href="{{ route('news', ['tag' => $tag->name]) }}">
                                                #{{ $tag->name }} ({{ $tag->count }})
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{ __('newsletter') }}</h4>
                            <!-- Form Subscribe -->
                            <div class="widget__form-subscribe bg__card-shadow">
                                <h6>
                                    {{ __('The most important world news and events of the day') }}.
                                </h6>
                                <p><small>{{ __('Get magzrenvi daily newsletter on your inbox') }}.</small></p>
                                <form action="" class="newsletter-form">
                                    <div class="input-group ">
                                        <input type="text" class="form-control" placeholder="Your email address"
                                            name="email">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary newsletter-button"
                                                type="submit">{{ __('sign up') }}</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </aside>


                        @if ($ads->side_bar_ad_status == 1)
                            <aside class="wrapper__list__article">
                                <h4 class="border_section">{{ __('Advertise') }}</h4>
                                <a href="#">
                                    <figure>
                                        <img src="{{ asset($ads->side_bar_ad) }}" alt="" class="img-fluid">
                                    </figure>
                                </a>
                            </aside>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('body').on('click', '.delete-msg', function(event) {
                event.preventDefault();

                let id = $(this).data('id')

                // let deleteUrl = $(this).attr('href');

                Swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('You want delete this comment!') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'DELETE',
                            url: "{{ route('news-comment-destroy') }}",
                            data: {
                                id: id
                            },

                            success: function(data) {

                                if (data.status == 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        data.message,
                                        'success'
                                    )
                                    window.location.reload();
                                } else if (data.status == 'error') {
                                    Swal.fire(
                                        'Cant Delete',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        })
                    }
                });
            });


        });
    </script>
@endpush
