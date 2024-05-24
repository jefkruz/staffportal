@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('meetings.update', $meeting->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Meeting Title</label>
                                    <input type="text" class="form-control" name="title" value="{{$meeting->title}}" placeholder="Meeting Title" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Stream Link</label>
                                    <input type="text" class="form-control" name="stream_link" value="{{$meeting->stream_link}}" placeholder="Stream Link" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Programme Accessibility</label>
                                    <select name="accessibility" class="form-control" required>
                                        <option value="{{$meeting->accessibility}}">{{$meeting->accessibility}}</option>
                                        @if ($meeting->accessibility == 'all')
                                            <option value="heads">Departmental Heads</option>
                                        @elseif ($meeting->accessibility == 'heads')
                                            <option value="all">Every Staff Member</option>
                                        @endif
                                    </select>
                                </div>
                            </div>



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
    </div>
@endsection


