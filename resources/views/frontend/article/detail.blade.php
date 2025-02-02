@extends('frontend/layout/master')
@section('title', $articleDetail->name ?? '')
@section('content')
    {{-- {!! $article->full_description ?? '' !!} --}}
    <!-- start blog wrapper -->
    <section class="block-wrapper mt-15">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ts-box">
                        <div class="head-color">
                            <h3 class="title-color">
                                <a href="#">{{ $leftMenuCategory->name ?? '' }}</a>
                            </h3>
                        </div>
                        <div class="list-group">
                            @foreach ($leftMenus as $menu)
                                <a href="{{ $menu->link ?? '' }}" class="list-group-item">
                                    <img src="{{ asset('front-end/images/icon/arrow.png') }}">
                                    {{ $menu->name ?? '' }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @foreach ($leftArticlesDetail as $article)
                        <div class="ts-box">
                            <div class="head-color">
                                <h3 class="title-color">
                                    <a href="#">{{ $article->name ?? '' }}</a>
                                </h3>
                            </div>
                            <div class="ts-post-thumb panel p-3">
                                {!! $article->short_description ?? '' !!}
                                <div class="btn-seemore">
                                    <a class="btn btn-color" href="{{ $article->link ?? 'javascript:void(0);' }}"
                                        role="button">@lang('app.read_more')</a>
                                </div>
                            </div>
                            <!-- item end-->
                        </div>
                    @endforeach
                    @include('frontend/components/visitor/index')
                    <!-- ts overlay style end-->
                    <!-- ts-grid-box end-->
                    <div class="fb-page" data-href="https://www.facebook.com/samborpreikukauthority?mibextid=zbwkwl"
                        tabs="timeline" width="" height="" data-small-header="false"
                        data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
                        <blockquote cite="https://www.facebook.com/samborpreikukauthority?mibextid=zbwkwl"
                            class="fb-xfbml-parse-ignore">
                            <a href="https://www.facebook.com/samborpreikukauthority?mibextid=zbwkwl">អាជ្ញាធរជាតិសំបូរព្រៃគុក
                                National Authority For Sambor Prei Kuk</a>
                        </blockquote>
                    </div>
                </div>
                <!-- col end-->
                <div class="col-lg-8">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('home') }}">
                                <i class="fa fa-home"></i>
                                @lang('app.home')
                            </a>
                        </li>
                        <li class="d-none">
                            <a href="javascript:void(0);">{{ $articleDetail->category?->name ?? '' }}</a>
                        </li>
                        <li><span class="default-font latest-breadcrumb">{{ $articleDetail->name ?? '' }}</span></li>
                    </ol>
                    <!-- breadcump end-->
                    <div class="content-wrapper">
                        <div class="entry-header">
                            <h2 class="post-title lg">{{ $articleDetail->name ?? '' }}</h2>
                            <ul class="post-meta-info">
                                <li>
                                    <i class="fa fa-clock-o"></i>
                                    {{ $articleDetail->created_at_format ?? '' }}
                                </li>
                            </ul>
                        </div>
                        <!-- single post header end-->
                        <div class="post-content-area">
                            <div class="post-media post-featured-image entry-content">
                                {!! $articleDetail->full_description ?? '' !!}
                            </div>
                            <!-- entry content end-->
                        </div>
                    </div>
                    <!--single post end -->
                    @if ($relatedArticles->count() > 0)
                        <div class="ts-grid-box mb-30">
                            <h2 class="ts-title">@lang('app.related_articles')</h2>

                            <div class="most-populers owl-carousel">
                                @foreach ($relatedArticles as $article)
                                    <div class="item">
                                        <div class="ts-post-thumb">
                                            <a href="{{ $article->link ?? '' }}">
                                                <img class="img-fluid" src="{{ asset($article->thumbnail_src ?? '') }}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <h3 class="post-title">
                                                <a href="{{ $article->link ?? '' }}">{{ $article->name ?? '' }}</a>
                                            </h3>
                                            <span class="post-date-info">
                                                <i class="fa fa-clock-o"></i>
                                                {{ $article->created_at_format ?? '' }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- ts-grid-box end-->
                            </div>
                            <!-- most-populers end-->
                        </div>
                        <!-- col end-->
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- end  blog wrapper -->
@endsection
