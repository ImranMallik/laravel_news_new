<section class="pt-0 mt-5">
    <div class="popular__section-news">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="wrapper__list__article">
                        <h4 class="border_section">{{ __('recent post') }}</h4>
                    </div>
                    <div class="row ">
                        @foreach ($recentNewsPosts as $recentNewsPost)
                            @if ($loop->index <= 1)
                                <div class="col-sm-12 col-md-6 mb-4">
                                    <div class="card__post ">
                                        <div class="card__post__body card__post__transition">
                                            <a href="{{ route('news.details', $recentNewsPost->slug) }}">
                                                <img src="{{ asset($recentNewsPost->image) }}" class="img-fluid"
                                                    alt="">
                                            </a>
                                            <div class="card__post__content bg__post-cover">
                                                <div class="card__post__category">
                                                    {{ $recentNewsPost->category->name }}
                                                </div>
                                                <div class="card__post__title">
                                                    <h5>
                                                        <a href="{{ route('news.details', $recentNewsPost->slug) }}">
                                                            {!! truncate($recentNewsPost->title) !!}</a>
                                                    </h5>
                                                </div>
                                                <div class="card__post__author-info">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <a href="blog_details.html">
                                                                {{ __('by') }} {{ $recentNewsPost->auther->name }}
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                {{ $recentNewsPost->created_at->format('M d, Y') }}
                                                            </span>

                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="row ">
                        <div class="col-sm-12 col-md-6">
                            <div class="wrapp__list__article-responsive">
                                @foreach ($recentNewsPosts as $recentNewsPost)
                                    @if ($loop->index > 1 && $loop->index <= 3)
                                        <div class="mb-3">
                                            <!-- Post Article -->
                                            <div class="card__post card__post-list">
                                                <div class="image-sm">
                                                    <a href="{{ route('news.details', $recentNewsPost->slug) }}">
                                                        <img src="{{ asset($recentNewsPost->image) }}" class="img-fluid"
                                                            alt="">
                                                    </a>
                                                </div>


                                                <div class="card__post__body ">
                                                    <div class="card__post__content">

                                                        <div class="card__post__author-info mb-2">
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
                                                                    <span class="text-primary">
                                                                        {{ __('by') }}
                                                                        {{ $recentNewsPost->auther->name }}
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span class="text-dark text-capitalize">
                                                                        {{ $recentNewsPost->created_at->format('M d, Y') }}
                                                                    </span>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a
                                                                    href="{{ route('news.details', $recentNewsPost->slug) }}">
                                                                    {!! truncate($recentNewsPost->title) !!}</a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 ">
                            <div class="wrapp__list__article-responsive">
                                @foreach ($recentNewsPosts as $recentNewsPost)
                                    @if ($loop->index > 4 && $loop->index <= 5)
                                        <div class="mb-3">
                                            <!-- Post Article -->
                                            <div class="card__post card__post-list">
                                                <div class="image-sm">
                                                    <a href="{{ route('news.details', $recentNewsPost->slug) }}">
                                                        <img src="{{ asset($recentNewsPost->image) }}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                </div>


                                                <div class="card__post__body ">
                                                    <div class="card__post__content">

                                                        <div class="card__post__author-info mb-2">
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
                                                                    <span class="text-primary">
                                                                        {{ __('by') }}
                                                                        {{ $recentNewsPost->auther->name }}
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span class="text-dark text-capitalize">
                                                                        {{ $recentNewsPost->created_at->format('M d, Y') }}
                                                                    </span>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a
                                                                    href="{{ route('news.details', $recentNewsPost->slug) }}">
                                                                    {!! truncate($recentNewsPost->title) !!}</a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 col-lg-4">
                    <aside class="wrapper__list__article">
                        <h4 class="border_section">{{ __('popular post') }}</h4>
                        <div class="wrapper__list-number">

                            <!-- List Article -->
                            @foreach ($popularNews as $popularNews)
                                <div class="card__post__list">
                                    <div class="list-number">
                                        <span>
                                            {{ ++$loop->index }}
                                        </span>
                                    </div>
                                    <a href="javascript:;" class="category">
                                        {{ $popularNews->category->name }}
                                    </a>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <h5>
                                                <a href="{{ route('news.details', $popularNews->slug) }}">
                                                    {!! truncate($popularNews->title) !!}

                                                </a>
                                            </h5>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach

                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <!-- Post news carousel -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <aside class="wrapper__list__article">
                    <h4 class="border_section">{{ @$categorySectionOne->first()->category->name }}</h4>
                </aside>
            </div>
            <div class="col-md-12">

                <div class="article__entry-carousel">
                    @foreach ($categorySectionOne as $categoryOne)
                        <div class="item">
                            <!-- Post Article -->
                            <div class="article__entry">
                                <div class="article__image">
                                    <a href="{{ route('news.details', $categoryOne->slug) }}">
                                        <img src="{{ asset($categoryOne->image) }}" alt="" class="img-fluid">
                                    </a>
                                </div>
                                <div class="article__content">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <span class="text-primary">
                                                {{ __('by') }} {{ $categoryOne->auther->name }}
                                            </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span>
                                                {{ date('M d, Y', strtotime($categoryOne->created_at)) }}
                                            </span>
                                        </li>

                                    </ul>
                                    <h5>
                                        <a href="{{ route('news.details', $categoryOne->slug) }}">
                                            {!! truncate($categoryOne->title, 40) !!}
                                        </a>
                                    </h5>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- End Popular news category -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <aside class="wrapper__list__article">
                    <h4 class="border_section">{{ @$categorySectionTwo->first()->category->name }}</h4>
                </aside>
            </div>
            <div class="col-md-12">

                <div class="article__entry-carousel">
                    @foreach ($categorySectionTwo as $categoryTwo)
                        <div class="item">
                            <!-- Post Article -->
                            <div class="article__entry">
                                <div class="article__image">
                                    <a href="{{ route('news.details', $categoryTwo->slug) }}">
                                        <img src="{{ $categoryTwo->image }}" alt="" class="img-fluid">
                                    </a>
                                </div>
                                <div class="article__content">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <span class="text-primary">
                                                {{ __('by') }} {{ $categoryTwo->auther->name }}
                                            </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span>
                                                {{ date('M d, Y', strtotime($categoryTwo->created_at)) }}
                                            </span>
                                        </li>

                                    </ul>
                                    <h5>
                                        <a href="{{ route('news.details', $categoryTwo->slug) }}">
                                            {!! truncate($categoryTwo->title, 40) !!}
                                        </a>
                                    </h5>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <!-- Popular news category -->
    <div class="mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <aside class="wrapper__list__article mb-0">
                        <h4 class="border_section">{{ @$categorySectionThree->first()->category->name }}</h4>
                        <div class="row">
                            <div class="col-md-6">
                                @foreach ($categorySectionThree as $categoryThree)
                                    @if ($loop->index <= 2)
                                        <div class="mb-4">
                                            <!-- Post Article -->
                                            <div class="article__entry">
                                                <div class="article__image">
                                                    <a href="{{ route('news.details', $categoryThree->slug) }}">
                                                        <img src="{{ asset($categoryThree->image) }}" alt=""
                                                            class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="article__content">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                {{ __('by') }} {{ $categoryThree->auther->name }}
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                {{ date('M d, Y', strtotime($categoryThree->created_at)) }}
                                                            </span>
                                                        </li>

                                                    </ul>
                                                    <h5>
                                                        <a href="{{ route('news.details', $categoryThree->slug) }}">
                                                            {!! truncate($categoryThree->title) !!}
                                                        </a>
                                                    </h5>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                            <div class="col-md-6">
                                @foreach ($categorySectionThree as $categoryThree)
                                    @if ($loop->index > 2 && $loop->index <= 5)
                                        <div class="mb-4">
                                            <!-- Post Article -->
                                            <div class="article__entry">
                                                <div class="article__image">
                                                    <a href="{{ route('news.details', $categoryThree->slug) }}">
                                                        <img src="{{ asset($categoryThree->image) }}" alt=""
                                                            class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="article__content">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                {{ __('by') }} {{ $categoryThree->auther->name }}
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                {{ date('M d, Y', strtotime($categoryThree->created_at)) }}
                                                            </span>
                                                        </li>

                                                    </ul>
                                                    <h5>
                                                        <a href="{{ route('news.details', $categoryThree->slug) }}">
                                                            {!! truncate($categoryThree->title) !!}
                                                        </a>
                                                    </h5>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </aside>

                    @if ($ads->home_middle_ad_status == 1)
                        <div class="small_add_banner">
                            <div class="small_add_banner_img">
                                <a href="{{ $ads->home_middle_ad_url }}">
                                    <img src="{{ asset($ads->home_middle_ad) }} " alt="adds">

                                </a>
                            </div>
                        </div>
                    @endif


                    <aside class="wrapper__list__article mt-5">
                        <h4 class="border_section">{{ $categorySectionFour->first()->category->name }}</h4>

                        <div class="wrapp__list__article-responsive">
                            <!-- Post Article List -->
                            @foreach ($categorySectionFour as $categoryFour)
                                <div class="card__post card__post-list card__post__transition mt-30">
                                    <div class="row ">
                                        <div class="col-md-5">
                                            <div class="card__post__transition">
                                                <a href="{{ route('news.details', $categoryFour->slug) }}">
                                                    <img src="{{ $categoryFour->image }}" class="img-fluid w-100"
                                                        alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-7 my-auto pl-0">
                                            <div class="card__post__body ">
                                                <div class="card__post__content  ">
                                                    <div class="card__post__category ">
                                                        {{ $categoryFour->category->name }}
                                                    </div>
                                                    <div class="card__post__author-info mb-2">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item">
                                                                <span class="text-primary">
                                                                    {{ __('by') }}
                                                                    {{ $categoryFour->auther->name }}
                                                                </span>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <span class="text-dark text-capitalize">
                                                                    {{ date('M d, Y', strtotime($categoryFour->created_at)) }}
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="card__post__title">
                                                        <h5>
                                                            <a
                                                                href="{{ route('news.details', $categoryFour->slug) }}">
                                                                {!! truncate($categoryFour->title) !!}
                                                            </a>
                                                        </h5>
                                                        <p class="d-none d-lg-block d-xl-block mb-0">
                                                            {!! truncate($categoryFour->content, 100) !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </aside>
                </div>

                <div class="col-md-4">
                    <div class="sticky-top">
                        <aside class="wrapper__list__article">
                            <h4 class="border_section">
                                {{ __('Most Viewed') }}</h4>
                            <div class="wrapper__list__article-small">
                                @foreach ($mostViewedPosts as $mostViewedPost)
                                    @if ($loop->index === 0)
                                        <div class="article__entry">
                                            <div class="article__image">
                                                <a href="{{ route('news.details', $mostViewedPost->slug) }}">
                                                    <img src="{{ asset($mostViewedPost->image) }}" alt=""
                                                        class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="article__content">
                                                <div class="article__category">
                                                    {{ $mostViewedPost->category->name }}
                                                </div>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            {{ __('by') }} {{ $mostViewedPost->auther->name }}
                                                        </span>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <span class="text-dark text-capitalize">
                                                            {{ date('M d, Y', strtotime($mostViewedPost->created_at)) }}
                                                        </span>
                                                    </li>

                                                </ul>
                                                <h5>
                                                    <a href="{{ route('news.details', $mostViewedPost->slug) }}">
                                                        {!! truncate($mostViewedPost->title) !!}
                                                    </a>
                                                </h5>
                                                <p>
                                                    {!! truncate($mostViewedPost->content, 100) !!}
                                                    <a href="{{ route('news.details', $mostViewedPost->slug) }}"
                                                        class="btn btn-outline-primary mb-4 text-capitalize">
                                                        {{ __('read more') }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <!-- Post Article -->
                                @foreach ($mostViewedPosts as $mostViewedPost)
                                    @if ($loop->index > 0)
                                        <div class="mb-3">
                                            <!-- Post Article -->
                                            <div class="card__post card__post-list">
                                                <div class="image-sm">
                                                    <a href="blog_details.html">
                                                        <img src="{{ asset($mostViewedPost->image) }}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                </div>

                                                <div class="card__post__body ">
                                                    <div class="card__post__content">
                                                        <div class="card__post__author-info mb-2">
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
                                                                    <span class="text-primary">
                                                                        {{ __('by') }}
                                                                        {{ $mostViewedPost->auther->name }}
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span class="text-dark text-capitalize">
                                                                        {{ date('M d, Y', strtotime($mostViewedPost->created_at)) }}
                                                                    </span>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a
                                                                    href="{{ route('news.details', $mostViewedPost->slug) }}">
                                                                    {!! truncate($mostViewedPost->title) !!}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{ __('stay conected') }}</h4>
                            <!-- widget Social media -->
                            <div class="wrap__social__media">
                                @foreach ($socialCounts as $socialCount)
                                    <a href="{{ $socialCount->url }}" target="_blank">
                                        <div class="social__media__widget mt-2"
                                            style="background-color: {{ $socialCount->color }}">
                                            <span class="social__media__widget-icon">
                                                <i class="{{ $socialCount->icon }}"></i>
                                            </span>
                                            <span class="social__media__widget-counter">
                                                {{ $socialCount->fan_count }} {{ __('fans') }}
                                            </span>
                                            <span class="social__media__widget-name">
                                                {{ $socialCount->fan_type }}
                                            </span>
                                        </div>
                                    </a>
                                @endforeach


                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{ __('tags') }}</h4>
                            <div class="blog-tags p-0">
                                <ul class="list-inline">
                                    @foreach ($mostCommonTags as $tag)
                                        <li class="list-inline-item">
                                            <a href="#">
                                                #{{ $tag->name }} ({{ $tag->count }})
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </aside>

                        @if ($ads->side_bar_ad_status == 1)
                            <aside class="wrapper__list__article">
                                <h4 class="border_section">{{ __('Advertise') }}</h4>
                                <a href="{{ $ads->side_bar_ad_url }}">
                                    <figure>
                                        <img src="{{ asset($ads->side_bar_ad) }}" alt="" class="img-fluid">
                                    </figure>
                                </a>
                            </aside>
                        @endif


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
                    </div>
                </div>
                <div class="mx-auto">
                    <!-- Pagination -->
                    <div class="pagination-area">
                        <div class="pagination wow fadeIn animated" data-wow-duration="2s" data-wow-delay="0.5s"
                            style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                            <a href="#">
                                «
                            </a>
                            <a href="#">
                                1
                            </a>
                            <a class="active" href="#">
                                2
                            </a>
                            <a href="#">
                                3
                            </a>
                            <a href="#">
                                4
                            </a>
                            <a href="#">
                                5
                            </a>

                            <a href="#">
                                »
                            </a>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>
