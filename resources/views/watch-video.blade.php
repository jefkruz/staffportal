
@extends('layouts.main')

@section('content')

    <div id="appCapsule">

        <div class="container">
            <div class="row">

                @if ($video->count() < 1)
                    <div class="alert alert-danger solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        <strong>Sorry!</strong> No Uploaded Video.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        </button>
                    </div>
                @else
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            {{ucwords($video->title)}}
                        </div>
                        <div class="card-body">
                            <video id="video" class="video-js">
                                <source src="{{url($video->link)}}" type="video/mp4">
                            </video>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                   <div class="card">

                       <div class="card-body">
                           <div class="section">
                               <div class="section-title mb-1">
                                   <h3 class="mb-0">Comments </h3>
                               </div>
                               <div class="pt-2 pb-2">
                                   <!-- comment block -->
                                   <div class="comment-block">
                                       <!--item -->
                                       <div class="item">
                                           <div class="avatar">
                                               <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w32 rounded">
                                           </div>
                                           <div class="in">
                                               <div class="comment-header">
                                                   <h4 class="title">Diego Morata</h4>
                                                   <span class="time">just now</span>
                                               </div>
                                               <div class="text">
                                                   Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                               </div>
                                               <div class="comment-footer">
                                                   <a href="#" class="comment-button">
                                                       <ion-icon name="heart-outline"></ion-icon>
                                                       Like (523)
                                                   </a>
                                                   <a href="#" class="comment-button">
                                                       <ion-icon name="chatbubble-outline"></ion-icon>
                                                       Reply
                                                   </a>
                                               </div>
                                           </div>
                                       </div>
                                       <!-- * item -->

                                   </div>
                                   <!-- * comment block -->
                               </div>
                           </div>

                           <div class="divider mt-2 mb-3"></div>

                           <div class="section mt-2">
                               <h3 class="mb-0">Send a Comment</h3>
                               <div class="pt-2 pb-2">
                                   <form>
                                       <div class="form-group boxed">
                                           <div class="input-wrapper">
                                               <input type="text" class="form-control" id="name5" value="{{ucwords(Session::get('user')->fullname())}}">
                                               <i class="clear-input">
                                                   <ion-icon name="close-circle"></ion-icon>
                                               </i>
                                           </div>
                                       </div>



                                       <div class="form-group boxed">
                                           <div class="input-wrapper">
                                               <textarea id="comment" rows="4" class="form-control" placeholder="Comment"></textarea>
                                               <i class="clear-input">
                                                   <ion-icon name="close-circle"></ion-icon>
                                               </i>
                                           </div>
                                       </div>

                                       <div class="mt-1">
                                           <button type="submit" class="btn btn-primary btn-lg btn-block">
                                               Send
                                           </button>
                                       </div>

                                   </form>

                               </div>
                           </div>
                           <!-- * chat footer -->
                       </div>


                   </div>
                </div>


                @endif
            </div>

        </div>
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
            liveui: true
        });
        player.on('contextmenu', function (e) {
            // Prevent the default right-click context menu
            e.preventDefault();
        });
    </script>
    <script>
        const ps5 = new PerfectScrollbar('#commentList', {
            useBothWheelAxes: true,
            suppressScrollX: true
        });
    </script>
@endsection
