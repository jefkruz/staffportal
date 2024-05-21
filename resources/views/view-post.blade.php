
@extends('layouts.main')

@section('content')

    <div id="appCapsule">

        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="card">
                        <img src="{{url($post->banner ?? '') }}" class="img-thumbnail"  alt="">
                        <div class="card-body">
                            <h6 class="card-title">{{ (Str::limit($post->title, 50)) }}</h6>
                            {!! html_entity_decode($post->body) !!}

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                   <div class="card">

                       <div class="card-body">
                           <div class="section">
                               <div class="section-title mb-1">
                                   <h3 class="mb-0">Comments (3)</h3>
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
                                       <!--item -->
                                       <div class="item">
                                           <div class="avatar">
                                               <img src="assets/img/sample/avatar/avatar3.jpg" alt="avatar" class="imaged w32 rounded">
                                           </div>
                                           <div class="in">
                                               <div class="comment-header">
                                                   <h4 class="title">Henry Itondo</h4>
                                                   <span class="time">05:50 PM</span>
                                               </div>
                                               <div class="text">
                                                   Sed laoreet leo eget maximus ultricies.
                                               </div>
                                               <div class="comment-footer">
                                                   <a href="#" class="comment-button">
                                                       <ion-icon name="heart" class="text-danger"></ion-icon>
                                                       Like (4)
                                                   </a>
                                                   <a href="#" class="comment-button">
                                                       <ion-icon name="chatbubble-outline"></ion-icon>
                                                       Reply
                                                   </a>
                                               </div>
                                           </div>
                                       </div>
                                       <!-- * item -->
                                       <!--item -->
                                       <div class="item">
                                           <div class="avatar">
                                               <img src="assets/img/sample/avatar/avatar4.jpg" alt="avatar" class="imaged w32 rounded">
                                           </div>
                                           <div class="in">
                                               <div class="comment-header">
                                                   <h4 class="title">Carmelita Marsham</h4>
                                                   <span class="time">Sep 23, 2020</span>
                                               </div>
                                               <div class="text">
                                                   Vivamus lobortis, orci et commodo pulvinar, eros nibh volutpat ipsum, in rhoncus risus
                                                   dolor.
                                               </div>
                                               <div class="comment-footer">
                                                   <a href="#" class="comment-button">
                                                       <ion-icon name="heart-outline"></ion-icon>
                                                       Like (5)
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
                                               <input type="text" class="form-control" id="name5" placeholder="Name">
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



            </div>

        </div>
    </div>
@endsection
