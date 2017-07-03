@extends('backend.index')

@section('content')


    <section class="content">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Appointments List</h3>
                    <form id="appointment">
                        <span>
                            {!! $timezone !!}
                        </span>
                    </form>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Reason</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Appointment time</th>
                            <th>Request Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($appointments as $list)
                            <tr>
                                <td>{{$list->name}}</td>
                                <td>{{$list->reason}}</td>
                                <td>{{$list->age}}</td>
                                <td>
                                    @if($list->gender == 'F')
                                        Female
                                    @else
                                        Male
                                    @endif
                                </td>
                                <td>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $list->appointment_time)->timezone($selected)}}</td>
                                <td>
                                    @if($list->status == 'REQUEST')
                                    <a href="javascript:void(0)" onclick="approveRequest('{{$list->uuid}}')">
                                        <span class="label label-warning">Click to Accept</span>
                                    </a>
                                    @elseif($list->status == 'ACCEPTED')
                                        <span class="label label-success">ACCEPTED</span>
                                    @elseif($list->status == 'CANCELLED')
                                        <span class="label label-danger">CANCELLED</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>


            <!-- /.box -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

    <!-- page script -->

    <script>

        $(document).ready(function () {
            $('#example1').DataTable({

                "ordering": false,

            });
        });

    </script>

@endsection