@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{$member->profile_pic}}" alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{$member->title}} {{$member->firstname}} {{$member->lastname}}</h3>

                    <p class="text-muted text-center mb-0 bg-info">{{$member->department()->name}}</p>
                    @if($isDeptHead)
                    <p class="text-muted text-center mb-0 bg-dark"><small class="text-warning">DEPARTMENT HEAD</small></p>
                    @endif
                    @if($isDirector)
                        <p class="text-muted text-center mb-0 bg-maroon"><small class="text-bold">DIRECTOR</small></p>
                    @endif
                    <p class="text-muted text-center"><small class="text-danger">PORTAL ID: </small>{{$member->portal_id}}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <span>Designation</span> <b class="float-right">{{$member->designation}}</b>
                        </li>
                        <li class="list-group-item">
                            <span>Rank</span> <b class="float-right">{{$member->rank}}</b>
                        </li>
                    </ul>

                    @if(!$isDeptHead && !$isDirector)
                    <button data-toggle="modal" data-target="#deptHeadModal" class="btn bg-navy btn-block"><b>Set As DEPARTMENT HEAD</b> <i class="fa fa-person-chalkboard"></i></button>
                    <button data-toggle="modal" data-target="#directorModal" class="btn bg-maroon btn-block"><b>Set As DIRECTOR</b> <i class="fa fa-person-military-pointing"></i></button>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">FULL PROFILE</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" value="{{$member->firstname}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" value="{{$member->lastname}}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" value="{{$member->email}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Kingschat Username</label>
                                <input type="text" class="form-control" placeholder="No username set" value="{{$member->kc_username}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Kingschat Phone Number</label>
                                <input type="text" class="form-control" placeholder="No phone number set" value="{{$member->phone}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Department</label>
                                <input type="text" class="form-control" value="{{$member->department()->name}}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Birth Day</label>
                                <input type="text" class="form-control" value="{{$member->birth_date}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Birth Month</label>
                                <input type="text" class="form-control" value="{{ date('F', mktime(0, 0, 0, $member->birth_month, 1)) }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Job Family</label>
                                <input type="text" class="form-control" value="{{($member->family()) ? $member->family()->name: ''}}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Rank</label>
                                <input type="text" class="form-control" value="{{$member->rank}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Employment Date</label>
                                <input type="text" id="emp_date" class="form-control" value="{{$member->employment_date}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Wedding Anniversary</label>
                                <input type="text" class="form-control" value="{{$member->anniversary}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Number of Children</label>
                                <input type="text" class="form-control" value="{{$member->children}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Next of Kin</label>
                                <input type="text" class="form-control" value="{{$member->nok}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Next of Kin's Phone Number</label>
                                <input type="text" class="form-control" value="{{$member->nok_phone}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">University</label>
                                <input type="text" class="form-control" value="{{$member->university}}" placeholder="University" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Age Range</label>
                                <input type="text" class="form-control" value="{{$member->age_range}}" disabled>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Residential Address</label>
                                <textarea  class="form-control" rows="3" placeholder="" disabled>{{$member->residential_address}}</textarea>

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Official Address</label>
                                <textarea  class="form-control" rows="3" placeholder="" disabled>{{$member->office_address}}</textarea>

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                               <p> <label>Qualification</label></p>
                                @if ($member->qualifications)
                                    @foreach (json_decode($member->qualifications, true) as $index => $award)
                                        <span class="badge badge-primary p-2"> {{$award}}</span>

                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <p><label>Ministry Awards</label></p>
                            @if ($member->ministry_awards)
                                @foreach (json_decode($member->ministry_awards, true) as $index => $award)
                                    <span class="badge badge-primary p-2"> {{$award}}</span>

                                @endforeach
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="deptHeadModal">

        <div class="modal-dialog modal-lg">
            <form class="modal-content" method="post" enctype="multipart/form-data" action="{{route('staff.setDeptHead', $member->id)}}">

                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Set As Department Head</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 offset-md-3">
{{--                                <p>--}}
{{--                                    <small>Current Head of <strong>{{$member->department()->name}}</strong>:</small>--}}
{{--                                    @if($deptHead)--}}
{{--                                    <span>{{$deptHead->profile()->title}} {{$deptHead->profile()->firstname}} {{$deptHead->profile()->lastname}}</span>--}}
{{--                                        @else--}}
{{--                                        <span class="text-danger text-bold">NONE ASSIGNED</span>--}}
{{--                                        @endif--}}
{{--                                </p>--}}

                                @php($name = $member->title . ' ' . $member->firstname . ' ' . $member->lastname)

                                <button class="btn btn-app bg-navy">
                                    <i class="fa fa-person-chalkboard fa-2x"></i>
                                    Add {{strtoupper($name)}} as departmental head
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </form>
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="directorModal">

        <div class="modal-dialog modal-lg">
            <form class="modal-content" method="post" enctype="multipart/form-data" action="{{route('staff.setDirector', $member->id)}}">

                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Set As Director</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 offset-md-3">
                                <p>
                                    <small>Current Director of <strong>{{$member->department()->name}}</strong>:</small>
                                    @if($director)
                                        <span>{{$director->profile()->title}} {{$director->profile()->firstname}} {{$director->profile()->lastname}}</span>
                                    @else
                                        <span class="text-danger text-bold">NONE ASSIGNED</span>
                                    @endif
                                </p>

                                @php($name = $member->title . ' ' . $member->firstname . ' ' . $member->lastname)

                                <button class="btn btn-app bg-navy">
                                    <i class="fa fa-person-military-pointing fa-2x"></i>
                                    Set {{strtoupper($name)}} as Director
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </form>
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endsection

@section('style')
@endsection

@section('script')
@endsection
