@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{route('staff-events.create')}}" class="btn btn-sm btn-dark">Add Event</a>
                        </div>
                        <div class="col-md-12 mb-3 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th> CATEGORY</th>
                                    <th> TITLE</th>
                                    <th>IMAGE</th>

                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($infos as $i => $post)
                                    <tr>
                                        <td>{{$i + 1}}</td>
                                        <td>{{$post->category()->name ?? ''}}</td>
                                        <td>{{$post->title}}</td>

                                        <td>
                                            <img src="{{url($post->image)}}" width="100px">

                                        </td>
                                        <td>
                                            <a href="{{route('staff-events.edit', $post->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                                            <form method="POST" action="{{route('staff-events.delete',$post->id)}}" onsubmit="return confirm('Are You sure you want to delete')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn  btn-sm btn-danger mt-1"><i class="fas fa-trash"></i>Delete </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button data-toggle="modal" data-target="#newSlideModal" class="btn btn-primary"> Add Category</button>

                        </div>
                        <div class="col-md-12 mb-3 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>

                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $i => $cat)
                                    <tr>
                                        <td>{{$i + 1}}</td>
                                        <td>{{$cat->name}}</td>

                                        <td>
{{--                                            <a href="{{route('event-categories.edit', $cat->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>--}}
                                            <form method="POST" action="{{route('event-categories.delete',$post->id)}}" onsubmit="return confirm('Are You sure you want to delete')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn  btn-sm btn-danger mt-1"><i class="fas fa-trash"></i>Delete </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newSlideModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="slideForm" action="{{route('event-categories.store')}}" method="post" >
                        @csrf
                        <div class="row">


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Category Name</label>
                                    <input type="text" name="name" class="form-control"  required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="slideForm" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@section('style')
@endsection

@section('script')
@endsection
