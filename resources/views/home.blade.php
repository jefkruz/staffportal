@extends('layouts.main')

@section('content')






    <!-- App Capsule -->
    <div id="appCapsule">


        <div class="section full mb-3">

            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($slides as $key => $slide)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ url($slide->image) }}" class="d-block w-100 img-fluid" alt="alt">
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- * carousel single -->
        </div>


            <div class="row">

                <div class="col-lg-9 ">

                    <div class="section full ">
{{--                        @if(Session::get('user')->cateID ==8)--}}

{{--                        @else--}}
{{--                            <div class="container p-2">--}}
{{--                                <div class="card ">--}}
{{--                                    <div class="card-header">--}}
{{--                                        <h2>--}}
{{--                                            Blue Elite TV--}}
{{--                                        </h2>--}}
{{--                                    </div>--}}
{{--                                    <div class="card-body ">--}}

{{--                                        <a  href="{{route('attendMeeting', $meeting->unique_code)}}">--}}
{{--                                            <img src="{{url('video/video.jpeg')}}" class="card-img-top"  alt="">--}}
{{--                                        </a>--}}

{{--                                    </div>--}}
{{--                                    <div class="card-footer">--}}
{{--                                        <h4 class="card-title">{{$meeting->title}}</h4>--}}

{{--                                        <a   href="{{route('attendMeeting', $meeting->unique_code)}}" class="btn btn-primary btn-sm float-end "><i class="fa fa-play"></i>  Watch </a>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        <div class="container p-2">
                            <div class="card ">
                                <div class="card-header">
                                    <h2>
                                        Blue Elite TV
                                    </h2>
                                </div>
                                <div class="card-body ">

                                    <video id="video" class="video-js">
                                        <source src="{{url($video->link)}}" type="video/mp4">
                                    </video>

                                </div>
                                <div class="card-footer">
                                    <h3>{{ucwords($video->name)}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="container p-2">
                            <div class="card ">
                                <div class="card-header">
                                    <h2>
                                        Information Center
                                    </h2>
                                </div>
                                <div class="card-body border-top">
                                    <div class="row">

                                        @foreach($announcements as  $post)

                                            <div class="col-md-4 col-sm-6 col-xs-12 p-1 ">
                                                <div class="card">
                                                    <img src="{{ url($post->banner) }}" class="card-img-top"  alt="{{ $post->title }}">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ (Str::limit($post->title, 50)) }}</h6>
                                                        {{--                                                <p class="card-text">{!! html_entity_decode(Str::limit($post->body, 100)) !!}</p>--}}
                                                        <a href="{{route('posts.show',$post->id)}}" class="btn  btn-sm btn-primary">Read More   </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>


                </div>


                <div class="col-lg-3">
                    <div class="section full mt-3 mb-3">
                        <div class="container">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="">
                                        My Meetings
                                    </h2>
                                </div>
                                <div class="card-body">
                                    <div class="overflow-auto" style="max-height: 200px; overflow-y: scroll; scrollbar-width: thin;">
                                        @if(Session::get('user')->cateID ==8)
                                            @foreach($special_meetings as $meeting)
                                                <ul class="listview image-listview media flush">
                                                    <li>
                                                        <div class="card" >

                                                            <div class="card-body ">
                                                                <h3 ><b>{{ ucwords($meeting->meetingTitle) }}</b></h3>
                                                                <p class="mb-0">{{ $meeting->meetingDesc }}</p>
                                                                @if($meeting->accepted())
                                                                    <a href="#" class="btn btn-sm btn-success mt-2 float-end">ACCEPTED</a>
                                                                @else
                                                                    <button data-id="{{$meeting->meetingID}}"  data-bs-toggle="modal" data-bs-target="#acceptMeetingBtn"  class="btn btn-sm btn-danger mt-2 float-end acceptMeetingBtn"> Accept Meeting</button>

                                                                @endif
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            @endforeach
                                        @else
                                            @foreach($meetings as $meeting)
                                            <ul class="listview image-listview media flush">
                                                <li>
                                                    <div class="card" >

                                                        <div class="card-body ">
                                                            <h3 ><b>{{ ucwords($meeting->meetingTitle) }}</b></h3>
                                                            <p class="mb-0">{{ $meeting->meetingDesc }}</p>
                                                            @if($meeting->accepted())
                                                                <a href="#" class="btn btn-sm btn-success mt-2 float-end">ACCEPTED</a>
                                                            @else
                                                                <button data-id="{{$meeting->meetingID}}" data-bs-toggle="modal" data-bs-target="#acceptMeetingBtn"  class="btn btn-sm btn-danger mt-2 float-end acceptMeetingBtn"> Accept Meeting</button>

                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Session::get('user')->cateID ==8)

                        @else
                      <div class="section full mt-3 mb-3 ">
                          <div class="container">

                              <div class="card">
                                  <div class="card-header">
                                      <h2 class="">
                                          Today's Celebrants
                                      </h2>
                                  </div>
                                  <div class="card-body">
                                      <div class=" overflow-auto"  style="max-height: 300px; overflow-y: scroll; scrollbar-width: thin;">

                                          <ul class="listview image-listview media flush ">
                                              @foreach($birthdays as $birthday)
                                                  <li>
                                                      <a href="#" class="item">
                                                          <div class="imageWrapper">
                                                              <img src="{{url($birthday->picturePath)}}" alt="image"  style="max-height: 60px" class="img-thumbnail imaged w64">
                                                          </div>
                                                          <div class="in">
                                                              <div class="flex-column">
                                                                  {{ucwords($birthday->fullname())}}
                                                                  <div class="text-muted">{{ucwords($birthday->department->deptName)}}</div>
                                                                  <button onclick="window.location.href='{{ route('greetings', $birthday->portalID) }}'" class="btn btn-sm btn-primary">SEND GREETINGS</button>

                                                              </div>
                                                          </div>
                                                      </a>
                                                  </li>
                                              @endforeach

                                          </ul>
                                      </div>

                                  </div>
                              </div>

                          </div>
                          <br>
                          <div class="container">

                              <div class="card">
                                  <div class="card-header">
                                      <h2 class="">
                                          Staff Events
                                      </h2>
                                  </div>
                                  <div class="card-body">
                                      <div class=" overflow-auto"  style="max-height: 500px;overflow-y: scroll; scrollbar-width: thin;">

                                          <ul class="listview image-listview media flush ">
                                              @if($cats)
                                                  @foreach($cats as $cat)
                                                   <h3>{{ucwords($cat->name)}}</h3>

                                                      @foreach($cat->events() as $event)

                                                          <li>
                                                              <a href="#" class="item">
                                                                  <div class="imageWrapper">
                                                                      <img src="{{url($event->image)}}" alt="image"   class="img-thumbnail">
                                                                  </div>
                                                                  <div class="in">
                                                                      <div class="flex-column">
                                                                          {{ucwords($event->title)}}
                                                                          <div class="text-muted"> {!! html_entity_decode($event->content) !!}</div>
                                                                        <br> <button onclick="window.location.href='{{ route('greetings', $birthday->portalID) }}'" class="btn btn-sm btn-success">READ MORE</button>
                                                                      </div>
                                                                  </a>
                                                              </li>

                                                      @endforeach

                                                  @endforeach


                                                  @endif

                                          </ul>
                                      </div>

                                  </div>
                              </div>

                          </div>
                      </div>
                        @endif
                </div>
            </div>




        <!-- app footer -->
        <div class="appFooter">
{{--            <img src="{{url('assets/img/icon/96x96.png')}}" alt="icon" class="footer-logo mb-2">--}}
{{--            <div class="footer-title">--}}
{{--                ©  <span class="yearNow"></span> LW STAFF PORTAL.--}}
{{--            </div>--}}


                <a href="#" class="btn btn-icon btn-sm btn-secondary goTop float-end ">
                    <ion-icon name="arrow-up-outline"></ion-icon>
                </a>


        </div>
        <!-- * app footer -->

    </div>
    <!-- * App Capsule -->

    <div class="modal fade" id="acceptEventModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Accept Event</h4>
                </div>
                <div class="modal-body">
                    <form id="acceptForm" action="{{route('acceptEvent')}}" method="post">
                        @csrf
                        <input type="hidden" id="event_id" name="event_id" required>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Kingschat Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{session('user')->phoneNum}}" placeholder="+234xxx..." required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <span></span>
                    <button type="submit" form="acceptForm" class="btn btn-primary">Accept Meeting</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



@endsection
@section('styles')
    <link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet" />
@endsection
@section('scripts')


    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>

    <script>

        const player = videojs('video', {
            controls: true,
            fluid: true,
            liveui: true,
            // autoplay: true,
            loop: true
        });
        player.on('contextmenu', function (e) {
            // Prevent the default right-click context menu
            e.preventDefault();
        });

        </script>

    <script>
        const acceptMeetingBtn = $('.acceptMeetingBtn');
        const scanCodeBtn = $('.scanCodeBtn');
        const eventID = $('#event_id');

        acceptMeetingBtn.on('click', function(){
            const evID = $(this).data('id');
            eventID.val(evID);
            const modal = new bootstrap.Modal(document.getElementById('acceptEventModal'));
            modal.show();
        });

        // scanCodeBtn.on('click', function(){
        //     const evID = $(this).data('id');
        //     eventID.val(evID);
        //     const modal = new bootstrap.Modal(document.getElementById('showQrModal'));
        //     modal.show();
        // });
    </script>
@endsection
