
@extends('layouts.main')

@section('content')

    <div id="appCapsule">

        <div class="container">
            <div class="row">

                <div class="col-lg-8 p-2">
                    <div class="card">
                        <img src="{{url($post->banner ?? '') }}" class="img-thumbnail"  alt="">
                        <div class="card-body">
                            <h6 class="card-title">{{ (Str::limit($post->name, 50)) }}</h6>
                            {!! html_entity_decode($post->body) !!}

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">Comments</h3>
                        </div>

                        <div class="card-body ">
                            <div class="overflow-auto" style="max-height: 300px;">



                                @foreach($post->comments() as $comment)
                                    <div class="pt-2 pb-2" >
                                        <!-- comment block -->
                                        <div class="comment-block">
                                            <!--item -->
                                            <div class="item">
                                                <div class="avatar">
                                                    <img src="{{url($comment->picture)}}" alt="avatar" class="imaged w32 rounded">
                                                </div>
                                                <div class="in">
                                                    <div class="comment-header">
                                                        <h4 class="title">{{$comment->name}}</h4>
                                                        <span class="time">{{$comment->created_at->diffForHumans()}}</span>
                                                    </div>
                                                    <div class="text">
                                                        {{$comment->comment}}
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- * item -->

                                        </div>
                                        <!-- * comment block -->
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="divider mt-2 mb-3"></div>

                        <div class="section mt-2">
                            <h3 class="mb-0">Send a Comment</h3>
                            <div class="pt-2 pb-2">
                                <form method="post">
                                    @csrf
                                    <div class="form-group boxed">
                                        <div class="input-wrapper">
                                            <input type="text" class="form-control" readonly value="{{ucwords(Session::get('user')->fullname())}}">
                                            <i class="clear-input">
                                                <ion-icon name="close-circle"></ion-icon>
                                            </i>
                                        </div>
                                    </div>



                                    <div class="form-group boxed">
                                        <div class="input-wrapper">
                                            <textarea id="comment" rows="4"  name="comment" class="form-control" placeholder="Comment"></textarea>
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


                    </div>

                </div>



            </div>

        </div>
    </div>
@endsection
