@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{$job_families}}</h3>

                    <p>Job Families</p>
                </div>
                <div class="icon">
                    <i class="fa fa-people-roof"></i>
                </div>
                <a href="{{route('jobFamily.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-fuchsia">

                <div class="inner">
                    <h3>{{$job_families}}</h3>

                    <p>Information Center</p>
                </div>
                <div class="icon">
                    <i class="fa fa-bullhorn"></i>
                </div>
                <a href="{{route('announcements.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-indigo">
                <div class="inner">
                    <h3>{{$regions}}</h3>

                    <p>Regions</p>
                </div>
                <div class="icon">
                    <i class="fa fa-globe"></i>
                </div>
                <a href="{{route('regions.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$meetings}}</h3>

                    <p>Live Meetings</p>
                </div>
                <div class="icon">
                    <i class="fa fa-tv"></i>
                </div>
                <a href="{{route('meetings.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-lightblue">
                <div class="inner">
                    <h3>{{$staffevents}}</h3>

                    <p>Staff Events</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar-days"></i>
                </div>
                <a href="{{route('staff-events.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-purple">
                <div class="inner">
                    <h3>{{$videos}}</h3>

                    <p>Videos</p>
                </div>
                <div class="icon">
                    <i class="fa fa-video"></i>
                </div>
                <a href="{{route('videos.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$streams}}</h3>

                    <p>Stream Links</p>
                </div>
                <div class="icon">
                    <i class="fa fa-play"></i>
                </div>
                <a href="{{route('streams.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
{{--        <div class="col-lg-3 col-6">--}}
{{--            <!-- small box -->--}}
{{--            <div class="small-box bg-warning">--}}
{{--                <div class="inner">--}}
{{--                    <h3>{{$events}}</h3>--}}

{{--                    <p>Events</p>--}}
{{--                </div>--}}
{{--                <div class="icon">--}}
{{--                    <i class="fa fa-tasks"></i>--}}
{{--                </div>--}}
{{--                <a href="{{route('events.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-3 col-6">--}}
{{--            <!-- small box -->--}}
{{--            <div class="small-box bg-secondary">--}}
{{--                <div class="inner">--}}
{{--                    <h3>{{$forums}}</h3>--}}

{{--                    <p>Forums</p>--}}
{{--                </div>--}}
{{--                <div class="icon">--}}
{{--                    <i class="fa fa-commenting"></i>--}}
{{--                </div>--}}
{{--                <a href="{{route('forums.create')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--      --}}

{{--        <div class="col-lg-3 col-6">--}}
{{--            <!-- small box -->--}}
{{--            <div class="small-box bg-lightblue">--}}
{{--                <div class="inner">--}}
{{--                    <h3>{{$assessments}}</h3>--}}

{{--                    <p>Assessments</p>--}}
{{--                </div>--}}
{{--                <div class="icon">--}}
{{--                    <i class="fa fa-question-circle"></i>--}}
{{--                </div>--}}
{{--                <a href="{{route('assessment.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-pink">
                <div class="inner">
                    <h3>{{$slides}}</h3>

                    <p>Slides</p>
                </div>
                <div class="icon">
                    <i class="fa fa-image"></i>
                </div>
                <a href="{{route('slides.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

{{--        <div class="col-lg-3 col-6">--}}
{{--            <!-- small box -->--}}
{{--            <div class="small-box bg-gradient-purple">--}}
{{--                <div class="inner">--}}
{{--                    <h3>{{$videos}}</h3>--}}

{{--                    <p>Videos</p>--}}
{{--                </div>--}}
{{--                <div class="icon">--}}
{{--                    <i class="fa fa-video"></i>--}}
{{--                </div>--}}
{{--                <a href="{{route('videos.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3>{{$staffs}}</h3>

                    <p>Staff</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{route('staff.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
{{--        <div class="col-lg-3 col-6">--}}
{{--            <!-- small box -->--}}
{{--            <div class="small-box bg-gradient-info">--}}
{{--                <div class="inner">--}}
{{--                    <h3>{{$birthdays->count()}}</h3>--}}

{{--                    <p>{{date('F')}} Birthdays</p>--}}
{{--                </div>--}}
{{--                <div class="icon">--}}
{{--                    <i class="fas fa-birthday-cake "></i>--}}
{{--                </div>--}}
{{--                <a href="{{route('birthdays')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-3 col-6">--}}
{{--            <!-- small box -->--}}
{{--            <div class="small-box bg-gradient-primary">--}}
{{--                <div class="inner">--}}
{{--                    <h3>{{$announcements}}</h3>--}}

{{--                    <p>Information Center</p>--}}
{{--                </div>--}}
{{--                <div class="icon">--}}
{{--                    <i class="fas fa-bullhorn"></i>--}}
{{--                </div>--}}
{{--                <a href="{{route('announcements.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="col-lg-3 col-6">--}}
{{--            <!-- small box -->--}}
{{--            <div class="small-box bg-gradient-dark">--}}
{{--                <div class="inner">--}}
{{--                    <h3>{{$notifiers}}</h3>--}}

{{--                    <p>Push Notifications</p>--}}
{{--                </div>--}}
{{--                <div class="icon">--}}
{{--                    <i class="fas fa-signal"></i>--}}
{{--                </div>--}}
{{--                <a href="{{route('adminNotification')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="col-lg-3 col-6">--}}
{{--            <!-- small box -->--}}
{{--            <div class="small-box bg-success">--}}
{{--                <div class="inner">--}}
{{--                    <h3>2</h3>--}}

{{--                    <p>Analytics</p>--}}
{{--                </div>--}}
{{--                <div class="icon">--}}
{{--                    <i class="fas fa-chart-bar"></i>--}}
{{--                </div>--}}
{{--                <a href="{{route('analytics.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
    @endsection

@section('style')
@endsection

@section('script')
@endsection
