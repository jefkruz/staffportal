@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('staff-events.update', $res->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">--Select Category--</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for=""> Title</label>
                                    <input type="text" class="form-control" name="title" value="{{$res->title}}" placeholder="Announcements Title" required>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Content</label>
                                    <textarea name="post_body" class="summernote">{{$res->content}}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Select Featured Image</label>
                                    <input type="file" name="file" class="form-control"
{{--                                           id="imageSelect" --}}
                                           accept="image/*">
                                </div>
                            </div>

{{--                            <div class="col-md-4">--}}
{{--                                <img id="displayImage" src="{{($res->image ? url($res->image) : '')}}" class="img-fluid">--}}
{{--                            </div>--}}


                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button class="btn btn-dark fa-pull-right"><i class="fa fa-save"></i> Update</button>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button data-toggle="modal" data-target="#newImageModal" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> Upload Image</button>
                        </div>

                        <div class="col-md-12">
                            @if($res->images->count())
                                <div class="row">
                                    @foreach($res->images as $image)
                                        <div class="col-md-3 col-sm-6">
                                            <div class="card flex-fill">
                                                <img style="cursor: zoom-in" src="{{$image->path}}" class="card-img-top">

                                                <button data-view="confirmDiv-{{$image->id}}" class="btn btn-danger  mt-2 toggleDelete"><i class="fa fa-trash"></i></button>
                                                <div id="confirmDiv-{{$image->id}}" class="card-body text-center" style="display:none">
                                                    <p class="card-text">Are you sure you want to delete?</p>
                                                    <button form="deleteImageForm-{{$image->id}}" type="submit" class="btn btn-danger"><i class="fa fa-check fa-2x"></i></button>
                                                    <button data-view="confirmDiv-{{$image->id}}" class="btn btn-dark toggleDelete"><i class="fa fa-times"></i></button>

                                                    <form id="deleteImageForm-{{$image->id}}" action="{{route('staff-events.deleteImage', $image->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            @else
                                <h4 class="text-center"><i class="fa fa-exclamation-triangle"></i> No images uploaded</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form id="uploadForm" method="post" action="{{route('staff-events.uploadImage')}}">
            @csrf
            <input type="hidden" name="staff_event_id" value="{{$res->id}}" required>
            <input type="hidden" name="image" id="croppedInput" required>
        </form>
    </div>
    <div class="modal fade" tabindex="-1" id="newImageModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Upload Image</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Select Image</label>
                                <input type="file" id="imageSelect" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="cropperDiv"></div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="uploadBtn" style="display:none" type="button" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" integrity="sha512-2eMmukTZtvwlfQoG8ztapwAH5fXaQBzaMqdljLopRSA0i6YKM8kBAOrSSykxu9NN9HrtD45lIqfONLII2AFL/Q==" crossorigin="anonymous" />

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>
    <script>
        $('.summernote').summernote();
        const newImageModal = $('#newImageModal');
        const uploadBtn = $('#uploadBtn');
        const imageSelect = $('#imageSelect');
        const cropperDiv = $('#cropperDiv');
        const croppedInput = $('#croppedInput');
        const uploadForm = $('#uploadForm');
        let isCropperLoaded = false;

        const toggleDelete = $('.toggleDelete');

        toggleDelete.on('click', function(e){
            e.preventDefault();
            const div = $(this).data('view');
            $('#' + div).toggle(500);
        });

        imageSelect.on('change', function(e){
            const file = e.target.files[0];
            const accepted = ["image/jpeg", "image/jpg", "image/png"];
            if(accepted.includes(file.type)){
                var reader = new FileReader();
                if(isCropperLoaded === false){
                    loadCropper();
                }

                reader.addEventListener('load', function(ev){
                    cropperDiv.croppie('bind', {
                        url: ev.target.result
                    }).then(function(){});
                });

                reader.readAsDataURL(file);
                uploadBtn.show();
            }
        });

        uploadBtn.on('click', function(e){
            e.preventDefault();
            cropperDiv.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp){
                croppedInput.val(resp);
                uploadBtn.attr('disabled', true);
                uploadForm.submit();
            });
        });

        function loadCropper() {
            cropperDiv.croppie({
                enableExif: true,
                viewport: {
                    width: 650,
                    height: 450,
                    type: 'square'
                },
                boundary: {
                    width: 700,
                    height: 500
                }
            });
            isCropperLoaded = true;
        }

    </script>
{{--    <script>--}}
{{--       --}}
{{--        const displayImage = $('#displayImage');--}}
{{--        const imageSelect = $('#imageSelect');--}}

{{--        imageSelect.on('change', function(e){--}}
{{--            const file = e.target.files[0];--}}

{{--            const accepted = ['image/jpg', 'image/jpeg', 'image/png'];--}}
{{--            if(accepted.includes(file.type)){--}}
{{--                const fr = new FileReader();--}}

{{--                fr.onload = () => {--}}
{{--                    displayImage.attr('src', fr.result);--}}
{{--                };--}}

{{--                fr.readAsDataURL(file);--}}
{{--            }--}}
{{--        });--}}

{{--    </script>--}}
@endsection
