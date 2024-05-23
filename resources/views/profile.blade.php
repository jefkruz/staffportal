
@extends('layouts.main')

@section('content')

    <div id="appCapsule">

        <div class="container">
            <div class="row">

                <div class="col-lg-3 p-2">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-head">
                                    <div class="avatar">
                                        <img src="{{url($user->picturePath)}}" alt="avatar" class="imaged w64 rounded">
                                    </div>
                                    <div class="in">
                                        <h3 class="name">{{ucwords($user->fullname())}}</h3>
                                        <h5 class="subtext">{{ucwords($user->department->deptName)}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <h2>Edit Profile</h2>
                            </div>
                            <div class="card-body">
                                <div class="section full">
                                    <div class="wide-block transparent p-0">
                                        <ul class="nav nav-tabs lined iconed" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#feed" role="tab">
                                                    <ion-icon name="person-outline"></ion-icon>
                                                    <strong>BASIC</strong>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#friends" role="tab">
                                                    <ion-icon name="people-outline"></ion-icon>
                                                    <strong>FAMILY</strong>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#bookmarks" role="tab">
                                                    <ion-icon name="bookmark-outline"></ion-icon>
                                                    <strong>ACADEMIC</strong>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#settings" role="tab">
                                                    <ion-icon name="settings-outline"></ion-icon>
                                                    <strong>MEDICAL</strong>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- tab content -->
                                <div class="section full mb-2">
                                    <div class="tab-content">

                                        <!-- feed -->

                                        <div class="tab-pane fade show active" id="feed" role="tabpanel">
                                            <div class="mt-2 p-2 pt-0 pb-0">

                                                <form>
                                                  <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group boxed">
                                                                <div class="input-wrapper">
                                                                    <label class="form-label" for="city5">Title</label>
                                                                    <select class="form-control form-select "  required name="title" >
                                                                        <option value="" {{ !$user->title ? 'selected' : '' }}>--Select--</option>
                                                                        <option value="Brother" {{ $user->title == 'Brother' ? 'selected' : '' }}>Brother</option>
                                                                        <option value="Sister" {{ $user->title == 'Sister' ? 'selected' : '' }}>Sister</option>
                                                                        <option value="Pastor" {{ $user->title == 'Pastor' ? 'selected' : '' }}>Pastor</option>
                                                                        <option value="Deacon" {{ $user->title == 'Deacon' ? 'selected' : '' }}>Deacon</option>
                                                                        <option value="Deaconess" {{ $user->title == 'Deaconess' ? 'selected' : '' }}>Deaconess</option>
                                                                        <option value="Evangelist" {{ $user->title == 'Evangelist' ? 'selected' : '' }}>Evangelist</option>
                                                                        <option value="Reverend" {{ $user->title == 'Reverend' ? 'selected' : '' }}>Reverend</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group boxed">
                                                                <div class="input-wrapper">
                                                                    <label class="form-label" for="name5">First Name</label>
                                                                    <input type="text" class="form-control"  disabled required  name="firstName" value="{{$user->firstName}}"
                                                                           autocomplete="off">
                                                                    <i class="clear-input">
                                                                        <ion-icon name="close-circle"></ion-icon>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group boxed">
                                                                <div class="input-wrapper">
                                                                    <label class="form-label" for="name5">Last Name</label>
                                                                    <input type="text" class="form-control" disabled  name="lastName" value="{{$user->lastName}}"
                                                                           autocomplete="off">
                                                                    <i class="clear-input">
                                                                        <ion-icon name="close-circle"></ion-icon>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group boxed">
                                                                <div class="input-wrapper">
                                                                    <label class="form-label" for="name5">Other Names</label>
                                                                    <input type="text" class="form-control"   name="otherName" value="{{$user->otherName}}"
                                                                           autocomplete="off">
                                                                    <i class="clear-input">
                                                                        <ion-icon name="close-circle"></ion-icon>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group boxed">
                                                                <div class="input-wrapper">
                                                                    <label class="form-label" for="email5"> Official E-mail</label>
                                                                    <input type="email" class="form-control" disabled name="emailAddress" value="{{$user->emailAddress}}" placeholder="E-mail address"
                                                                           autocomplete="off">
                                                                    <i class="clear-input">
                                                                        <ion-icon name="close-circle"></ion-icon>
                                                                    </i>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group boxed">
                                                                <div class="input-wrapper">
                                                                    <label class="form-label" for="email5"> Private E-mail</label>
                                                                    <input type="email" class="form-control"  name="emailAddress" value="{{$user->emailAddress}}" placeholder="E-mail address"
                                                                           autocomplete="off">
                                                                    <i class="clear-input">
                                                                        <ion-icon name="close-circle"></ion-icon>
                                                                    </i>
                                                                </div>
                                                            </div>

                                                        </div>
                                                      <div class="col-md-6">
                                                          <div class="form-group boxed">
                                                              <div class="input-wrapper">
                                                                  <label class="form-label" for="phone5">Portal ID</label>
                                                                  <input type="text" class="form-control"  name="phoneNum" disabled value="{{$user->portalID}}" >
                                                                  <i class="clear-input">
                                                                      <ion-icon name="close-circle"></ion-icon>
                                                                  </i>
                                                              </div>
                                                          </div>

                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="form-group boxed">
                                                              <div class="input-wrapper">
                                                                  <label class="form-label" for="phone5">Phone Number</label>
                                                                  <input type="text"  inputmode="tel" class="form-control"  name="phoneNum" value="{{$user->phoneNum}}" placeholder="Enter your phone number">
                                                                  <i class="clear-input">
                                                                      <ion-icon name="close-circle"></ion-icon>
                                                                  </i>
                                                              </div>
                                                          </div>

                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="form-group boxed">
                                                              <div class="input-wrapper">
                                                                  <label class="form-label" for="phone5">KingsChat Username</label>
                                                                  <input type="text" class="form-control"  name="kcUsername" disabled value="{{$user->kcUsername}}" >
                                                                  <i class="clear-input">
                                                                      <ion-icon name="close-circle"></ion-icon>
                                                                  </i>
                                                              </div>
                                                          </div>

                                                      </div>
                                                        <div class="col-md-6">

                                                            <div class="form-group boxed">
                                                                <div class="input-wrapper">
                                                                    <label class="form-label" for="city5">City</label>
                                                                    <select class="form-control form-select" id="city5">
                                                                        <option value="0">Select a city</option>
                                                                        <option value="1">New York City</option>
                                                                        <option value="2">Austin</option>
                                                                        <option value="3">Colorado</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>



                                                     </div>
                                                </form>


                                            </div>
                                            <div class="p-2 pt-0 pb-0 mt-2">
                                                <button href="#" class="btn btn-primary btn-block">Submit</button>
                                            </div>

                                        </div>
                                        <!-- * feed -->

                                        <!-- * friends -->
                                        <div class="tab-pane fade" id="friends" role="tabpanel">
                                        </div>
                                        <!-- * friends -->

                                        <!--  bookmarks -->
                                        <div class="tab-pane fade" id="bookmarks" role="tabpanel">
                                        </div>
                                        <!-- * bookmarks -->
                                        <!-- settings -->
                                        <div class="tab-pane fade" id="settings" role="tabpanel">
                                        </div>
                                        <!-- * settings -->
                                    </div>
                                </div>
                                <!-- * tab content -->
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.country').select2();
        });
    </script>
@endsection
