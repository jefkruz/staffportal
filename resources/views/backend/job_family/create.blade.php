@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('jobFamily.store')}}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="">Job Family Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button class="btn btn-dark fa-pull-right" type="submit">Create</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @endsection

@section('style')
@endsection

@section('script')
@endsection
