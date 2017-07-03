@extends('backend.index')

@section('content')

    <section class="content">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Doctors List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Doctor Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Gender</th>
                            <th>Available Start Time</th>
                            <th>Available End Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($doctor as $list)
                            <tr>
                                <td>
                                    <a href="{{ url('doctor').'/'.$list->uuid.'/appointment' }}" target="_blank">
                                        {{$list->name}}
                                    </a>
                                </td>
                                <td>{{$list->email}}</td>
                                <td>{{$list->department}}</td>
                                <td>
                                    @if($list->gender == 'F')
                                        Female
                                    @else
                                        Male
                                    @endif
                                </td>
                                <td>{{$list->available_start_time}}</td>
                                <td>{{$list->available_end_time}}</td>
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