@extends('layouts.app')
@section('title', $posts->title)
@section('title_post', $posts->title)
@section('description', $posts->description)
@section('thumb', $posts->thumb)
@section('content')
<section class="section section-lg overflow-hidden z-2">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/category/{{$category->slug}}">{{$category->name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$posts->title}}</li>
                    </ol>
                </nav>
                <h1>{{$posts->title}}</h1>
                <p>Upload by <span style="color: red; font-weight:bolt">Admin</span> on {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $posts->created_at)->format('m/d/Y')}}</p>
                <div class="mt-5 mb-5 mt-md-0">
                    <img src="/storage/{{$posts->thumb}}" alt="{{$posts->title}}">
                    <p class="mt-5 mb-5">{{$posts->content}}</p>
                    <h3>Demo</h3>
                    <p><a href="{{$posts->demo}}">{{$posts->demo}}</a></p>
                    <h3>Download</h3>
                    <pre>{{$posts->download_content}}</pre>
                    <h3>Related articles</h3>
                    @foreach($posts_related as $result)
                    <li><a href="/{{$result->cate_slug}}/{{$result->slug}}" title="{{$result->title}}">{{$result->title}}</a></li>
                    @endforeach
                </div>
            </div>
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">
                        CATEGORY
                    </a>
                    <a href="/category/scripts" class="list-group-item list-group-item-action">
                        <i class="fa fa-camera"></i> PHP SCRIPT <span class="badge bg-secondary badge-pill badge-primary float-right">{{$count_script}}</span>
                    </a>
                    <a href="/category/mobile" class="list-group-item list-group-item-action">
                        <i class="fa fa-music"></i> APP/MOBILE <span class="badge bg-secondary badge-pill badge-primary float-right">{{$count_app}}</span>
                    </a>
                    <a href="/category/plugins" class="list-group-item list-group-item-action">
                        <i class="fa fa-film"></i> PLUGIN/ADDONS <span class="badge bg-secondary badge-pill badge-primary float-right">{{$count_plugin}}</span>
                    </a>
                    <a href="/category/nulled-cms" class="list-group-item list-group-item-action">
                        <i class="fa fa-film"></i> NULLED CMS <span class="badge bg-secondary badge-pill badge-primary float-right">{{$count_cms}}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection