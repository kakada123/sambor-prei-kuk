@extends('frontend/layout/master')
@section('title', __('app.home'))
@section('content')
    <!-- header nav end-->
    <!-- top bar start -->
    <section class="top-bar v4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center">
                    <div class="ts-breaking-news clearfix">
                        <h2 class="breaking-title float-left">
                            <i class="fa fa-bolt"></i>@lang('app.news') :
                        </h2>
                        <div class="breaking-news-content float-left">
                            <marquee width="100%" direction="left" height="100px" onmouseover="this.stop();"
                                onmouseout="this.start();">
                                <p>{{ latestNews()->short_description ?? '' }}</p>
                            </marquee>
                        </div>
                    </div>
                </div>
                <!-- end col-->

                <!--end col -->


            </div>
            <!-- end row -->
        </div>
    </section>
    <!-- end top bar-->

    <!-- start block wrapper -->
    @if ($banners->count() > 0)
        <section class="block-wrapper"
            style="background: url({{ asset('front-end/images/banner-bg.png') }}) no-repeat center center/cover">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ts-overlay-style featured-post owl-carousel" id="featured-slider-5">

                            @foreach ($banners as $banner)
                                <div class="item" style="background-image:url({{ $banner->thumbnail_src ?? '' }})">
                                </div>
                            @endforeach
                        </div>
                        <!-- ts overlay style end-->
                    </div>
                </div>
            </div>
        </section>
        <!-- end  blog wrapper -->
    @endif
    <section class="section-bg">
        <div class="container">
            <div class="row">
                @foreach ($underSliders as $article)
                    <div class="col-md-3 mb-1 mt-1">
                        <a href="{{ $article->link ?? '' }}">
                            <div class="text-feature">
                                <p>{{ $article->name ?? '' }}</p>
                            </div>
                            <img class="borders" src="{{ $article->thumbnail_src ?? '' }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- start blog wrapper -->
    <section class="block-wrapper mt-15">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 pr-10">
                    @foreach ($leftArticles as $article)
                        <div class="ts-box">
                            <div class="head-color">
                                <h3 class="title-color">
                                    <a href="{{ $article->link ?? '' }}">{{ $article->name ?? '' }}</a>
                                </h3>
                            </div>
                            <div class="ts-post-thumb">
                                <a href="{{ $article->link ?? '' }}">
                                    <img class="img-fluid" src="{{ $article->thumbnail_src ?? '' }}" alt="">
                                </a>
                            </div>
                            <!-- item end-->
                        </div>
                    @endforeach
                    <!-- ts overlay style end-->
                    <!-- ts-grid-box end-->
                    <div class="fb-page fb-wrapper"
                        data-href="https://www.facebook.com/samborpreikukauthority?mibextid=zbwkwl" tabs="timeline"
                        height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
                        data-show-facepile="false">
                        <blockquote cite="https://www.facebook.com/samborpreikukauthority?mibextid=zbwkwl"
                            class="fb-xfbml-parse-ignore">
                            <a href="https://www.facebook.com/samborpreikukauthority?mibextid=zbwkwl">អាជ្ញាធរជាតិសំបូរព្រៃគុក
                                National Authority For Sambor Prei Kuk</a>
                        </blockquote>
                    </div>
                </div>
                <!-- col end-->
                <div class="col-lg-6 pl-0 pr-10">
                    <div class="clearfix">
                        <h2 class="event-title float-left">
                            @lang('app.news_and_events')
                        </h2>
                    </div>
                    <div class="post-list">
                        @foreach ($newsAndEvents as $article)
                            <div class="row mb-10 shadow-post">
                                <div class="col-md-4 item">
                                    <div class="ts-post-thumb">
                                        <a href="{{ $article->link ?? '' }}">
                                            <img class="img-fluid" src="{{ $article->thumbnail_src ?? '' }}">
                                        </a>
                                    </div>
                                </div>
                                <!-- col lg end-->
                                <div class="col-md-8">
                                    <div class="post-content">
                                        <h3 class="post-title tt">
                                            <a href="{{ $article->link ?? '' }}">{{ $article->name ?? '' }}</a>
                                        </h3>
                                        <p class="content">
                                            {!! $article->short_description ?? '' !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- row end-->
                        @endforeach
                    </div>
                    <!-- row end-->
                    {{ $newsAndEvents->links('pagination::bootstrap-5') }}
                    <!-- Featured owl carousel end-->
                </div>
                <!-- col end-->
                <div class="col-lg-3 pl-0">
                    <div class="ts-post-overlay-style-1">
                        @foreach ($rightArticles as $article)
                            <div class="ts-box ts-grid-content">
                                <div class="head-color">
                                    <h3 class="title-color">
                                        <a href="{{ $article->link ?? '' }}">{{ $article->name ?? '' }}</a>
                                    </h3>
                                </div>
                                <div class="ts-post-thumb">
                                    <a href="{{ $article->link ?? '' }}">
                                        <img class="img-fluid" src="{{ $article->thumbnail_src ?? '' }}" alt="">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        <!-- ts overlay style end-->
                        @include('frontend/components/visitor/index')
                    </div>
                </div>
                <!--col end-->
            </div>
        </div>
    </section>
    <!-- end  blog wrapper -->
@endsection
