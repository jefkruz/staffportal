@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">


                        <div class="card-header">
                            <button data-toggle="modal" data-target="#newMeetingModal" class="btn btn-dark btn-sm">Create Region</button>
                        </div>

                            <div class="card-body table-responsive">

                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>ACTIONS</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($regions as $i => $region)
                                    <tr>

                                        <td>{{$region->regionID}}</td>
                                        <td>{{ucwords($region->regionName)}}</td>

                                        <td>


                                            <form method="POST" action="{{route('regions.delete',$region->regionID)}}" onsubmit="return confirm('Are You sure you want to delete')">
                                                {{ csrf_field() }}
                                                <a href="{{route('regions.edit', $region->regionID)}}" class="btn btn-sm mt-2 btn-success"><i class="fa fa-edit"></i> Edit</a>

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

    <div class="modal fade" id="newMeetingModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Region</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="meetingForm" action="{{route('regions.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Region ID</label>
                                    <input type="text" class="form-control" name="region_id" placeholder="Region ID" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Region Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Region Name" required>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="submitBtn" class="btn btn-dark">Create</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endsection


@section('style')
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <!-- DataTables  & Plugins -->

    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": [ "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
@endsection

