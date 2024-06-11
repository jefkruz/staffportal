@extends('layouts.main')

@section('content')

    <div id="appCapsule">

        <div class="error-page">
            <div class="mb-2">
                <img src="{{url('images/coming_soon.png')}}" alt="alt" class="imaged square w200">
            </div>
            <h1 class="title">Coming Soon!</h1>
            <div class="text mb-3">
                The Updated Staff Handbook is Coming Soon.
            </div>
{{--            <div id="countDown" class="mb-5">--}}
{{--                <span class="spinner-border mt-3" role="status"></span>--}}
{{--            </div>--}}

            <div class="fixed-footer">
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('home')}}" class="btn btn-primary btn-lg btn-block">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
