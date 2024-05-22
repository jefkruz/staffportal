@extends('layouts.main')

@section('content')

    <div id="appCapsule">

        <div class="container">
            <div class="row">

                @foreach($videos as  $video)

                    <div class="col-md-4 col-sm-6 col-xs-12 p-1 ">
                        <div class="card">
                            <a href="{{route('viewVideo', [$video->id, $video->slug])}}">
                            <img src="{{url('video/video.jpeg')}}" class="card-img-top"  alt="">
                            </a>
                            <div class="card-body">
                                <h6 class="card-title">{{ ucwords($video->name) }}</h6>
                                {!!$video->description !!}
                                <a href="{{route('viewVideo',[$video->id, $video->slug])}}" class="btn  btn-sm btn-primary">Watch  </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class=" d-flex justify-content-center mt-4">
                {{ $videos->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
