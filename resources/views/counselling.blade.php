@extends('layouts.main')

@section('content')

    <div id="appCapsule">

        <div class="container">
           <div class="card">
               <div class="card-header">
                   <h3>Staff Counselling</h3>
               </div>
               <div class="card-body">
                   <div class="row">
                       <div class="section mt-1 mb-5">
                           <form action="{{route('bookCounselling')}}" method="POST">
                              @csrf

                               <div class="form-group boxed">
                                   <div class="input-wrapper">
                                       <h3 >Choose the topic you will require Counselling or Mentoring on
                                       </h3>
                                       <select class="form-control form-select" id="topic" name="topic" required>
                                           <option value="">--Select a topic--</option>
                                           <option value="Job Satisfaction">Job Satisfaction</option>
                                           <option value="Work-Life balance">Work-Life balance</option>
                                           <option value="Increasing productivity on the job">Increasing productivity on the job</option>
                                           <option value="How to build your faith to grow your finances">How to build your faith to grow your finances</option>
                                           <option value="Dealing with a difficult or an uninspiring boss">Dealing with a difficult or an uninspiring boss</option>
                                           <option value="Ways to attract Promotion on the job">Ways to attract Promotion on the job</option>
                                           <option value="others">others</option>
                                       </select>
                                   </div>
                               </div>

                               <div class="form-group boxed" id="manual" style="display: none">
                                   <div class="input-wrapper">
                                       <input type="text" class="form-control"  placeholder="Enter Topic">
                                       <i class="clear-input">
                                           <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                                       </i>
                                   </div>
                               </div>

                               <div class="form-button-group">
                                   <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
                               </div>

                           </form>
                       </div>
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
