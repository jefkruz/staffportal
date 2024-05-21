@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4><small>Job Family: </small>{{$family->name}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button data-toggle="modal" data-target="#newRoleModal" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> Add Job Role</button>
                        </div>

                        <div class="col-md-12">
                            <ul class="list-group">
                                @foreach($roles as $role)
                                <li class="list-group-item">
                                    {{$role->name}}
                                    <button data-form="deleteForm-{{$role->id}}" class="btn btn-sm btn-danger fa-pull-right deleteBtn"><i class="fa fa-trash"></i></button>
                                    <form id="deleteForm-{{$role->id}}" method="post" action="{{route('jobFamily.deleteRole', $role->id)}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </li>
                                    @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newRoleModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Role</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="chapterForm" action="{{route('jobFamily.addRole')}}" method="post">
                        @csrf
                        <input type="hidden" name="family_id" value="{{$family->id}}" required>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Role Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="e.g Systems Engineering" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="chapterForm" class="btn btn-dark">Add Role</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endsection

@section('script')
    <script>
        const deleteBtn = $('.deleteBtn');
        deleteBtn.on('click', function(e){
            e.preventDefault();
            const fm = $(this).data('form');

            if(confirm('Are you sure you want to delete?')){
                $('#' + fm).submit();
            }
        });
    </script>
    @endsection
