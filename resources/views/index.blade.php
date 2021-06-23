@extends('layouts.app')
@section('title', 'Premium Scripts, Plugins & Mobile, Nulled CMS | Freecodecanyon.net')
@section('description', 'Premium Scripts, Plugins & Mobile, Nulled CMS')
@section('content')
<section class="section-sm">
    <div class="container">
        <div class="row mt-5 mt-lg-2">
            <div class="col-md-9">
                <div class="row">
                    @foreach($posts as $result)
                    <div class="col-6 mb-3">
                        <div class="card-2 shadow-sm">
                            <img src="/storage/{{$result->thumb}}" height="250" class="img-responsive center-block" alt="{{$result->title}}">
                            <div class="news-title">
                                <div class="new-title"><a href="/{{$result->cate_slug}}/{{$result->slug}}" title="{{$result->title}}">{{$result->title}}</a></div>
                            </div>
                            <div class="card-body-2">
                                <p>{{$result->description}}</p>
                            </div>
                            <div class="short-bot">
                                Upload by <b style="color : red">Admin</b>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-calendar"></i> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $result->created_at)->format('m/d/Y')}}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{ $posts->links('pagination.default') }}
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