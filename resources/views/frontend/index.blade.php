@extends('frontend.layouts.master')
@section('contain')
    <!-- Tranding news  carousel-->
    @include('frontend.section.breaking_news')
    <!-- End Tranding news carousel -->

    <!-- Popular news -->
    @include('frontend.section.hero_slider')
    <!-- End Popular news -->


    @if ($ads->home_top_bar_ad_status == 1)
        <a href="{{ $ads->home_top_bar_ad_url }}">
            <div class="large_add_banner">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="large_add_banner_img">
                                <img src="{{ asset($ads->home_top_bar_ad) }}" alt="adds">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </a>
    @endif

    <!-- Popular news category -->
    @include('frontend.section.main-news')
    <!-- End Popular news category -->
@endsection
