@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">

                        <button data-toggle="modal" data-target="#allGroupMessageModal" class="btn btn-dark "><i class="fas fa-comments"></i> Message All Groups</button>

                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>IMAGE</th>
                                    <th>NAME</th>
                                    <th>MEMBERS</th>
                                    <th> KC LINK</th>
                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($families as $i => $fam)
                                <tr>
                                    <td>{{$i + 1}}</td>
                                    <td>
                                        <img src="{{url('images/families/' . $fam->image)}}" width="100px">

                                    </td>
                                    <td> {{$fam->name}}</td>
                                    <td>  <a href="{{route('jobFamily.members',$fam->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-users"></i> {{$fam->membersCount()}} Members</a>
                                    </td>
                                    <td>  <a href="{{$fam->kc_group}}" class="btn btn-success btn-sm">Join</a></td>
                                    <td>
                                        <a href="{{route('jobFamily.show', $fam->id)}}"> <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</button></a>
                                        <button    data-name="{{$fam->name}}"
                                                   data-kcgroup="{{$fam->kc_group}}"
                                                   data-id="{{$fam->id}}"
                                                   data-image="{{url('images/families/' . $fam->image)}}"

                                                   type="button" class="btn btn-info  btn-sm editModalBtn"><i class="fas fa-pencil-alt"></i> Edit</button>
                                      <button data-name="{{$fam->name}}" data-family="{{$fam->id}}" class="btn btn-sm btn-dark messageBtn"><i class="fas fa-comments"></i> Message </button>
                                        <form method="POST" action="{{route('jobFamily.delete',$fam->id)}}" onsubmit="return confirm('Are You sure you want to delete')">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <button type="submit" class="btn  btn-sm btn-danger mt-1"><i class="fas fa-trash"></i> Delete</button>
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

    <div class="modal fade" id="editmodal">

        <div class="modal-dialog modal-lg">
            <form class="modal-content" method="post" enctype="multipart/form-data"  action="{{route('jobFamily.update')}}">
                <input type="hidden" name="id" id="id" required>
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="modalTitle" class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Job Family</label>
                                        <input type="text" class="form-control" name="name"  id="name" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label >KC Group</label>
                                        <input type="text" class="form-control" name="kc_group" id="kcgroup" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="customFile">Image</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </form>
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="singleGroupMessageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg">

                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea id="" class="form-control" placeholder="Enter message to group"></textarea>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="sendSingleMsgBtn" type="button" class="btn btn-primary">Send Message</button>
                    </div>
                </div>
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="allGroupMessageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title">Sending message to ALL GROUPS</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea id="" class="form-control" placeholder="Enter message to group"></textarea>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="sendMultipleMsgBtn" type="button" class="btn btn-primary">Send Message</button>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>

    @endsection

@section('style')
@endsection

@section('script')

@endsection
