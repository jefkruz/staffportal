@extends('layouts.main')

@section('content')

    <div id="appCapsule">

{{--        <div class="container">--}}
{{--           <div class="card">--}}
{{--               <div class="card-header">--}}
{{--                   <h3>Staff Counselling</h3>--}}
{{--               </div>--}}
{{--               <div class="card-body">--}}
{{--                   @include('includes.alerts')--}}
{{--                   <div class="row">--}}
{{--                       <div class="section mt-1 mb-5">--}}
{{--                           <form action="{{route('bookCounselling')}}" method="POST">--}}
{{--                              @csrf--}}

{{--                               <div class="form-group boxed">--}}
{{--                                   <div class="input-wrapper">--}}
{{--                                       <h3 >Choose the topic you will require Counselling or Mentoring on--}}
{{--                                       </h3>--}}
{{--                                       <select class="form-control form-select" id="topic" name="topic" required>--}}
{{--                                           <option value="">--Select a topic--</option>--}}
{{--                                           <option value="Job Satisfaction">Job Satisfaction</option>--}}
{{--                                           <option value="Work-Life balance">Work-Life balance</option>--}}
{{--                                           <option value="Increasing productivity on the job">Increasing productivity on the job</option>--}}
{{--                                           <option value="How to build your faith to grow your finances">How to build your faith to grow your finances</option>--}}
{{--                                           <option value="Dealing with a difficult or an uninspiring boss">Dealing with a difficult or an uninspiring boss</option>--}}
{{--                                           <option value="Ways to attract Promotion on the job">Ways to attract Promotion on the job</option>--}}
{{--                                           <option value="others">others</option>--}}
{{--                                       </select>--}}
{{--                                   </div>--}}
{{--                               </div>--}}

{{--                               <div class="form-group boxed" id="manual" style="display: none">--}}
{{--                                   <div class="input-wrapper">--}}
{{--                                       <input type="text" class="form-control" name="title"  placeholder="Enter Topic">--}}
{{--                                       <i class="clear-input">--}}
{{--                                           <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>--}}
{{--                                       </i>--}}
{{--                                   </div>--}}
{{--                               </div>--}}

{{--                               <div class="form-button-group">--}}
{{--                                   <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>--}}
{{--                               </div>--}}

{{--                           </form>--}}
{{--                       </div>--}}
{{--                   </div>--}}
{{--               </div>--}}
{{--           </div>--}}
{{--        </div>--}}
        <div class="error-page">
            <div class="mb-2">
                <img src="{{url('images/coming_soon.png')}}" alt="alt" class="imaged square w200">
            </div>
            <h1 class="title">Coming Soon!</h1>
            <div class="text mb-3">
                The Staff Counseling feature would be out shortly.
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
    <script>
        $(document).ready(function() {

            // Show or hide sections based on the selected options
            $('#topic').change(function() {
                var mode = $(this).val();
                if (mode === 'others') {
                    $('#manual').show();

                } else  {
                    $('#manual').hide();

                }
            });

        });
    </script>
@endsection
