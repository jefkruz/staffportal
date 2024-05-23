@extends('layouts.main')

@section('content')

    <div id="appCapsule">

        <div class="container">
            <div class="row">

                @foreach($programmes as  $meeting)

                    <div class="col-md-4 col-sm-6 col-xs-12 p-1 ">
                        <div class="card">
                            <a  href="{{route('attendMeeting', $meeting->unique_code)}}">
                            <img src="{{url('video/video.jpeg')}}" class="card-img-top"  alt="">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">{{$meeting->title}}</h4>

                            </div>
                            <div class="card-footer">
                                <a   href="{{route('attendMeeting', $meeting->unique_code)}}" class="btn btn-primary btn-sm float-end "><i class="fa fa-play"></i>  Watch </a>

                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection

@section('scripts')

@endsection
