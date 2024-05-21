
@extends('layouts.main')

@section('content')

    <div id="appCapsule">

        <div class="container">
            <div class="row">

                @foreach($posts as  $post)

                    <div class="col-md-4 col-sm-6 col-xs-12 p-1 ">
                        <div class="card">
                            <img src="{{url($post->banner ?? '') }}" class="card-img-top"  alt="">
                            <div class="card-body">
                                <h6 class="card-title">{{ (Str::limit($post->title, 50)) }}</h6>
{{--                                {!! html_entity_decode(Str::limit($post->body, 100)) !!}--}}
                                <a href="{{route('posts.show',$post->id)}}" class="btn  btn-sm btn-primary">Read More   </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class=" d-flex justify-content-center mt-4">
                {{ $posts->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
